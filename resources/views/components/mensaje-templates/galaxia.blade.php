{{-- Template: Galaxia / Noche Estrellada --}}
@props([
    'destinatario' => '',
    'remitente'    => '',
    'mensajeHtml'  => '',
    'ocasionEmoji' => '✨',
    'imagenUrl'    => null,
    'estiloForma'  => '',
    'estiloMarco'  => '',
    'preview'      => false,
])

<div class="relative min-h-screen bg-[#0B0B2B] flex items-center justify-center p-4 sm:p-8 font-app-body overflow-hidden">

    {{-- Estrellas animadas de fondo --}}
    <div class="absolute inset-0 overflow-hidden pointer-events-none">
        @foreach(range(1,40) as $i)
        @php
            $x = ($i * 73) % 100;
            $y = ($i * 47) % 100;
            $size = (($i * 13) % 3) + 1;
            $delay = ($i * 0.15) % 4;
            $dur = 2 + ($i * 0.2) % 3;
        @endphp
        <div class="absolute rounded-full bg-white animate-pulse"
             style="left:{{ $x }}%;top:{{ $y }}%;width:{{ $size }}px;height:{{ $size }}px;animation-delay:{{ $delay }}s;animation-duration:{{ $dur }}s;opacity:{{ 0.3 + ($i%5)*0.14 }}">
        </div>
        @endforeach

        {{-- Nebulosa de fondo --}}
        <div class="absolute top-1/4 left-1/4 w-64 h-64 rounded-full opacity-20"
             style="background: radial-gradient(circle, #7C3AED 0%, transparent 70%);filter:blur(40px);">
        </div>
        <div class="absolute bottom-1/4 right-1/4 w-80 h-80 rounded-full opacity-15"
             style="background: radial-gradient(circle, #3B82F6 0%, transparent 70%);filter:blur(50px);">
        </div>
    </div>

    <div class="relative w-full max-w-2xl">

        {{-- Tarjeta con glassmorphism --}}
        <div class="relative rounded-3xl overflow-hidden border border-white/10"
             style="background: rgba(255,255,255,0.05); backdrop-filter: blur(20px); box-shadow: 0 25px 60px rgba(0,0,0,0.5), inset 0 1px 0 rgba(255,255,255,0.1);">

            {{-- Halo superior --}}
            <div class="absolute top-0 left-1/2 -translate-x-1/2 w-3/4 h-1"
                 style="background: linear-gradient(90deg, transparent, #A78BFA, transparent);">
            </div>

            <div class="p-8 sm:p-12">

                {{-- Emoji + destinatario --}}
                <div class="text-center mb-8">
                    <div class="text-5xl mb-4">{{ $ocasionEmoji }}</div>
                    <p class="text-violet-300 text-xs uppercase tracking-[0.3em] mb-2">Un mensaje del universo para</p>
                    <h1 class="font-app-heading text-3xl sm:text-5xl font-extrabold text-white"
                        style="text-shadow: 0 0 20px rgba(167,139,250,0.8);">
                        {{ $destinatario }}
                    </h1>
                    <div class="flex justify-center gap-1 mt-3 text-violet-400">
                        @foreach(['✦','★','✦','★','✦'] as $s)<span>{{ $s }}</span>@endforeach
                    </div>
                </div>

                {{-- Imagen --}}
                @if($imagenUrl)
                <div class="flex justify-center mb-8">
                    <div style="{{ $estiloMarco ?: 'filter:drop-shadow(0 0 12px rgba(167,139,250,0.8));' }}">
                        <div class="w-40 h-40 overflow-hidden" style="{{ $estiloForma ?: 'border-radius:50%;' }}">
                            <img src="{{ $imagenUrl }}" alt="Foto" class="w-full h-full object-contain bg-white">
                        </div>
                    </div>
                </div>
                @endif

                {{-- Mensaje --}}
                <div class="rounded-2xl p-6 sm:p-8 mb-8 border border-white/10 relative"
                     style="background: rgba(255,255,255,0.05);">
                    <div class="mensaje-contenido text-white/90 leading-loose text-base sm:text-lg" style="text-shadow:0 1px 3px rgba(0,0,0,0.5)">
                        {!! $mensajeHtml !!}
                    </div>
                </div>

                {{-- Firma --}}
                <div class="flex items-center justify-between border-t border-white/10 pt-6">
                    <div>
                        <p class="text-violet-300/60 text-xs mb-0.5">Enviado con amor desde las estrellas,</p>
                        <p class="font-app-heading text-xl font-bold text-violet-300 italic">{{ $remitente }}</p>
                    </div>
                    <div class="text-2xl">🌙</div>
                </div>
            </div>
        </div>
    </div>
</div>
