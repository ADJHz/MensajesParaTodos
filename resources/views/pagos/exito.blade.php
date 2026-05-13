@extends('layouts.app')
@section('title', '¡Pago exitoso! 🎉')

@section('content')
<div class="max-w-lg mx-auto px-4 py-16 text-center">
    {{-- Confetti emoji --}}
    <div class="text-7xl mb-6 animate-bounce">🎉</div>
    <h1 class="font-app-heading text-3xl font-bold text-gray-800 mb-3">¡Listo! Tu mensaje está activo</h1>
    <p class="text-gray-500 mb-8">El pago fue procesado correctamente. Ahora comparte el link con <strong>{{ $mensaje->destinatario }}</strong>.</p>

    {{-- Link compartible --}}
    <div class="bg-violet-50 border-2 border-violet-200 rounded-2xl p-6 mb-6">
        <p class="text-sm font-semibold text-violet-600 mb-3">🔗 Link de tu mensaje</p>
        <div class="bg-white rounded-xl border border-violet-100 px-4 py-3 text-sm font-mono text-gray-600 break-all mb-4">
            {{ route('mensajes.show', $mensaje->code) }}
        </div>
        <button onclick="copiarLink()"
                class="w-full py-3 bg-violet-600 text-white font-bold rounded-full hover:bg-violet-700 transition">
            📋 Copiar link
        </button>
    </div>

    {{-- Vista previa --}}
    <a href="{{ route('mensajes.show', $mensaje->code) }}" target="_blank"
       class="inline-block w-full py-4 border-2 border-violet-200 text-violet-700 font-bold rounded-full hover:bg-violet-50 transition mb-6">
        👀 Ver cómo ve el mensaje
    </a>

    {{-- Compartir --}}
    <div class="bg-white rounded-2xl border border-gray-100 shadow p-5 mb-8">
        <p class="text-sm font-semibold text-gray-600 mb-4">Comparte en redes sociales</p>
        <div class="flex justify-center gap-3">
            <a href="https://wa.me/?text={{ urlencode('💌 Te envío este mensaje especial: ' . route('mensajes.show', $mensaje->code)) }}"
               target="_blank" rel="noopener"
               class="flex items-center gap-2 px-4 py-2 bg-emerald-500 text-white text-sm font-bold rounded-full hover:bg-emerald-600 transition">
                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347z"/><path d="M12 0C5.373 0 0 5.373 0 12s5.373 12 12 12 12-5.373 12-12S18.627 0 12 0zm5.562 16.646c-.247.694-1.437 1.328-2.006 1.413-.512.078-1.16.11-1.871-.118-.432-.136-.985-.319-1.694-.625-2.981-1.287-4.928-4.289-5.077-4.487-.148-.199-1.213-1.612-1.213-3.074 0-1.463.768-2.182 1.04-2.479.272-.298.594-.372.792-.372.199 0 .397.002.57.01.182.01.427-.069.669.51.247.595.841 2.058.916 2.207.075.149.124.322.025.52-.1.199-.149.323-.298.497-.148.173-.312.387-.446.52-.148.148-.303.309-.13.606.173.298.77 1.271 1.653 2.059 1.135 1.012 2.093 1.325 2.39 1.475.297.148.471.124.644-.075.173-.198.743-.867.94-1.164.199-.298.397-.249.67-.15.272.1 1.733.818 2.03.967.298.149.496.223.57.347.075.124.075.719-.173 1.413z"/></svg>
                WhatsApp
            </a>
        </div>
    </div>

    <a href="{{ route('dashboard') }}" class="text-sm text-gray-400 hover:text-violet-600 underline transition">
        Volver a Mi Estudio
    </a>
</div>
@endsection

@push('scripts')
<script>
function copiarLink() {
    navigator.clipboard.writeText('{{ route('mensajes.show', $mensaje->code) }}').then(() => {
        const btn = event.target;
        btn.textContent = '✅ ¡Copiado!';
        setTimeout(() => btn.textContent = '📋 Copiar link', 2000);
    });
}
</script>
@endpush
