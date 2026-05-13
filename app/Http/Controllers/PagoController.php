<?php

namespace App\Http\Controllers;

use App\Models\MensajePlataforma;
use App\Models\Pago;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Stripe\StripeClient;
use Stripe\Webhook;

class PagoController extends Controller
{
    private function montoMxnCentavos(): int
    {
        $monto = (int) env('STRIPE_PRICE_MXN_CENTS', 5000); // 50.00 MXN
        return max(100, $monto);
    }

    private function tipoCambioReferencia(): float
    {
        $rate = (float) env('USD_MXN_RATE', 20);
        return $rate > 0 ? $rate : 20.0;
    }

    public function checkout(string $code)
    {
        $mensaje = MensajePlataforma::where('code', $code)
            ->where('user_id', Auth::id())
            ->with('ocasion.categoria')
            ->firstOrFail();

        if ($mensaje->isPagado()) {
            return redirect()->route('mensajes.show', $mensaje->code);
        }

        $montoMxn = $this->montoMxnCentavos() / 100;
        $aproxUsd = round($montoMxn / $this->tipoCambioReferencia(), 2);

        return view('pagos.checkout', compact('mensaje', 'montoMxn', 'aproxUsd'));
    }

    public function crearSesion(string $code)
    {
        $mensaje = MensajePlataforma::where('code', $code)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        $stripe = new StripeClient(config('services.stripe.secret'));
        $montoCentavosMxn = $this->montoMxnCentavos();

        $session = $stripe->checkout->sessions->create([
            'payment_method_types' => ['card'],
            'mode'                 => 'payment',
            'locale'               => 'es',
            'line_items'           => [[
                'price_data' => [
                    'currency'     => 'mxn',
                    'unit_amount'  => $montoCentavosMxn,
                    'product_data' => [
                        'name'        => '💌 Mensaje especial — ' . $mensaje->ocasion->nombre,
                        'description' => 'Para: ' . $mensaje->destinatario . ' · De: ' . $mensaje->remitente,
                    ],
                ],
                'quantity' => 1,
            ]],
            'success_url' => route('pago.exito', ['code' => $mensaje->code, 'session_id' => '{CHECKOUT_SESSION_ID}']),
            'cancel_url'  => route('pago.checkout', $mensaje->code),
            'metadata'    => ['mensaje_code' => $mensaje->code],
        ]);

        Pago::updateOrCreate(
            ['mensaje_id' => $mensaje->id],
            [
                'user_id'          => Auth::id(),
                'stripe_session_id'=> $session->id,
                'monto'            => $montoCentavosMxn,
                'moneda'           => 'mxn',
                'estado'           => 'pendiente',
            ]
        );

        return redirect($session->url);
    }

    public function exito(Request $request)
    {
        $mensaje = MensajePlataforma::where('code', $request->code)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        // Verificar con Stripe
        $stripe  = new StripeClient(config('services.stripe.secret'));
        $session = $stripe->checkout->sessions->retrieve($request->session_id);

        if ($session->payment_status === 'paid') {
            $mensaje->update(['estado' => 'pagado']);
            Pago::where('stripe_session_id', $session->id)->update([
                'stripe_payment_intent' => $session->payment_intent,
                'estado'                => 'completado',
            ]);
        }

        return view('pagos.exito', compact('mensaje'));
    }

    public function cancelado(Request $request)
    {
        return redirect()->route('dashboard')->with('info', 'El pago fue cancelado. Tu mensaje se guardó como borrador.');
    }

    public function webhook(Request $request)
    {
        $payload   = $request->getContent();
        $sigHeader = $request->header('Stripe-Signature');
        $secret    = config('services.stripe.webhook_secret');

        try {
            $event = Webhook::constructEvent($payload, $sigHeader, $secret);
        } catch (\Exception $e) {
            return response('Firma inválida', 400);
        }

        if ($event->type === 'checkout.session.completed') {
            $session = $event->data->object;
            $code    = $session->metadata->mensaje_code ?? null;

            if ($code) {
                $mensaje = MensajePlataforma::where('code', $code)->first();
                if ($mensaje) {
                    $mensaje->update(['estado' => 'pagado']);
                    Pago::where('stripe_session_id', $session->id)->update([
                        'stripe_payment_intent' => $session->payment_intent,
                        'estado'                => 'completado',
                    ]);
                }
            }
        }

        return response('OK', 200);
    }
}
