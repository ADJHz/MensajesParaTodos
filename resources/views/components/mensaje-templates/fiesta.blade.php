{{-- Template: Fiesta / Celebración --}}
@props([
    'destinatario' => '',
    'remitente'    => '',
    'mensajeHtml'  => '',
    'ocasionEmoji' => '🎉',
    'imagenUrl'    => null,
    'estiloForma'  => '',
    'estiloMarco'  => '',
    'preview'      => false,
])

<div class="relative min-h-screen flex items-center justify-center p-4 sm:p-8 font-app-body overflow-hidden"
     style="background: linear-gradient(135deg, #FFF7ED 0%, #FEF3C7 50%, #ECFDF5 100%);">

    {{-- Confetti SVG de fondo --}}
    <div class="absolute inset-0 pointer-events-none overflow-hidden">
        @php
        $formas = ['rect','circle','rect'];
        $colores = ['#F472B6','#818CF8','#34D399','#FB923C','#60A5FA','#A78BFA','#F87171'];
        @endphp
        @foreach(range(1,25) as $i)
        @php
            $x = ($i * 79) % 100;
            $y = ($i * 53) % 100;
            $c = $colores[$i % count($colores)];
            $r = ($i * 37) % 360;
            $s = 4 + ($i * 7) % 8;
        @endphp
        <div class="absolute rounded-sm animate-bounce"
             style="left:{{ $x }}%;top:{{ $y }}%;width:{{ $s }}px;height:{{ $s + 2 }}px;background:{{ $c }};transform:rotate({{ $r }}deg);opacity:0.7;animation-delay:{{ ($i*0.2) % 2 }}s;animation-duration:{{ 1.5 + ($i*0.1)%1.5 }}s;">
        </div>
        @endforeach
    </div>

    <div class="relative w-full max-w-2xl">

        {{-- Guirnalda de banderines --}}
        <div class="flex justify-center items-end mb-0 overflow-hidden">
            <svg width="100%" height="50" viewBox="0 0 400 50" preserveAspectRatio="none">
                <path d="M0 20 Q100 0 200 20 Q300 40 400 20" stroke="#FCD34D" stroke-width="2" fill="none" stroke-dasharray="none"/>
                @foreach([30,80,130,180,230,280,330,380] as $bx)
                @php $bc = $colores[$bx % count($colores)]; @endphp
                <polygon points="{{ $bx }},20 {{ $bx+10 }},20 {{ $bx+5 }},40" fill="{{ $bc }}" opacity="0.85"/>
                @endforeach
            </svg>
        </div>

        {{-- Tarjeta --}}
        <div class="bg-white/95 backdrop-blur-sm rounded-3xl shadow-2xl overflow-hidden border-2 border-amber-100">

            {{-- Header festivo --}}
            <div class="px-8 py-8 text-center relative overflow-hidden"
                 style="background: linear-gradient(135deg, #FDE68A, #FCA5A5, #A5B4FC);">
                <div class="absolute inset-0 opacity-20"
                     style="background-image: radial-gradient(circle, white 2px, transparent 2px); background-size: 20px 20px;">
                </div>
                <div class="relative">
                    <div class="text-5xl mb-2 animate-bounce">{{ $ocasionEmoji }}</div>
                    <p class="text-white/80 text-xs uppercase tracking-widest font-bold">¡Especialmente para ti!</p>
                    <h1 class="font-app-heading text-3xl sm:text-4xl font-extrabold text-white mt-1 drop-shadow"
                        style="text-shadow: 2px 2px 0 rgba(0,0,0,0.1);">
                        {{ $destinatario }}
                    </h1>
                </div>
            </div>

            <div class="px-8 sm:px-10 py-8">

                {{-- Imagen --}}
                @if($imagenUrl)
                <div class="flex justify-center -mt-12 mb-6">
                    <div style="{{ $estiloMarco ?: 'filter:drop-shadow(0 6px 12px rgba(0,0,0,0.2));' }}" class="ring-4 ring-white rounded-2xl">
                        <div class="w-24 h-24 overflow-hidden" style="{{ $estiloForma ?: 'border-radius:1rem;' }}">
                            <img src="{{ $imagenUrl }}" alt="Foto" class="w-full h-full object-cover">
                        </div>
                    </div>
                </div>
                @endif

                {{-- Mensaje --}}
                <div class="bg-gradient-to-br from-amber-50 to-pink-50 rounded-2xl p-6 mb-8 border-2 border-dashed border-amber-200">
                    <div class="mensaje-contenido text-gray-700 leading-loose text-base sm:text-lg">{!! $mensajeHtml !!}</div>
                </div>

                {{-- Firma --}}
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-400 text-xs mb-0.5">Con mucho amor,</p>
                        <p class="font-app-heading text-xl font-extrabold text-amber-600">{{ $remitente }}</p>
                    </div>
                    <div class="flex gap-1 text-2xl">🎈🎊🎉</div>
                </div>
            </div>
        </div>
    </div>
</div>
