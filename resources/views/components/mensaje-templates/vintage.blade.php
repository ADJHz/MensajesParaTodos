{{-- Template: Carta de Papel / Vintage --}}
@props([
    'destinatario' => '',
    'remitente'    => '',
    'mensajeHtml'  => '',
    'ocasionEmoji' => '📜',
    'imagenUrl'    => null,
    'estiloForma'  => '',
    'estiloMarco'  => '',
    'preview'      => false,
])

<div class="relative min-h-screen flex items-center justify-center p-4 sm:p-8 font-app-body overflow-hidden"
     style="background: #F5ECD7;">

    {{-- Textura papel --}}
    <div class="absolute inset-0 pointer-events-none opacity-40"
         style="background-image: url('data:image/svg+xml,<svg xmlns=\"http://www.w3.org/2000/svg\" width=\"300\" height=\"300\"><filter id=\"noise\"><feTurbulence type=\"fractalNoise\" baseFrequency=\"0.9\" numOctaves=\"4\" stitchTiles=\"stitch\"/><feColorMatrix type=\"saturate\" values=\"0\"/></filter><rect width=\"300\" height=\"300\" filter=\"url(%23noise)\" opacity=\"0.08\"/></svg>');
          background-repeat: repeat;background-size: 200px;">
    </div>

    <div class="relative w-full max-w-xl">

        {{-- Sobre abierto en la parte superior --}}
        <div class="flex justify-center mb-2">
            <svg width="80" height="40" viewBox="0 0 80 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                <rect x="2" y="2" width="76" height="36" rx="4" fill="#E8D5AA" stroke="#C8A96E" stroke-width="1.5"/>
                <path d="M2 6 L40 26 L78 6" stroke="#C8A96E" stroke-width="1.5" fill="none"/>
            </svg>
        </div>

        {{-- Carta principal --}}
        <div class="relative rounded-2xl overflow-visible shadow-2xl"
             style="background: #FFFBF0; border: 1px solid #DDD0A8; box-shadow: 4px 6px 20px rgba(0,0,0,0.15), inset 0 0 0 8px rgba(200,169,110,0.08);">

            {{-- Margen izquierdo rojo --}}
            <div class="absolute left-10 top-0 bottom-0 w-px bg-red-300/40"></div>
            {{-- Líneas de libreta --}}
            <div class="absolute inset-0 pointer-events-none rounded-2xl overflow-hidden opacity-30"
                 style="background-image: repeating-linear-gradient(0deg, transparent, transparent 31px, #C8A96E44 31px, #C8A96E44 32px);">
            </div>

            <div class="relative px-8 sm:px-14 py-10">

                {{-- Timbre postal --}}
                <div class="absolute top-4 right-4 w-14 h-18 rounded-sm border-2 border-amber-400 p-1 flex flex-col items-center gap-1 opacity-80">
                    <div class="text-xl">{{ $ocasionEmoji }}</div>
                    <div class="w-full h-px bg-amber-400"></div>
                    <div class="text-[8px] text-amber-700 font-bold tracking-wider">MENSAJE</div>
                </div>

                {{-- Destinatario --}}
                <div class="mb-8">
                    <p class="text-amber-700/70 text-xs mb-1" style="font-family:'Courier New',monospace;">Estimad@,</p>
                    <h1 class="font-app-heading text-3xl sm:text-4xl font-extrabold text-gray-800" style="font-family:'Georgia',serif;">
                        {{ $destinatario }}
                    </h1>
                    <div class="mt-2 w-24 h-0.5 bg-amber-400"></div>
                </div>

                {{-- Imagen --}}
                @if($imagenUrl)
                <div class="float-right ml-4 mb-4">
                    <div style="{{ $estiloMarco ?: 'filter:drop-shadow(2px 3px 8px rgba(0,0,0,0.3));' }}">
                        <div class="w-28 h-28 overflow-hidden" style="{{ $estiloForma ?: 'border-radius:4px;' }}">
                            <img src="{{ $imagenUrl }}" alt="Foto" class="w-full h-full object-cover">
                        </div>
                    </div>
                </div>
                @endif

                {{-- Mensaje --}}
                <div class="mensaje-contenido text-gray-700 leading-loose text-base sm:text-lg mb-8 clear-both"
                     style="font-family:'Georgia',serif;">{!! $mensajeHtml !!}
                </div>

                {{-- Firma manuscrita --}}
                <div class="mt-8 text-right">
                    <p class="text-amber-700/60 text-sm mb-1" style="font-family:'Courier New',monospace;">Con todo mi afecto,</p>
                    <p class="text-2xl sm:text-3xl font-bold text-amber-800 italic" style="font-family:'Dancing Script','cursive';">
                        {{ $remitente }}
                    </p>
                    <div class="inline-block mt-2">
                        <svg width="80" height="20" viewBox="0 0 80 20">
                            <path d="M5 15 Q20 5 40 10 Q60 15 75 8" stroke="#C8A96E" stroke-width="1.5" fill="none" stroke-linecap="round"/>
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        {{-- Matasellos --}}
        <div class="flex justify-end mt-3 pr-2 opacity-40">
            <div class="w-16 h-16 rounded-full border-2 border-gray-600 flex items-center justify-center text-center rotate-12">
                <span class="text-[7px] text-gray-600 font-bold leading-tight">SPECIAL<br>DELIVERY</span>
            </div>
        </div>
    </div>
</div>
