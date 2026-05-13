{{-- Template: Rosa Floral --}}
@props([
    'destinatario' => '',
    'remitente'    => '',
    'mensajeHtml'  => '',
    'ocasionEmoji' => '🌸',
    'imagenUrl'    => null,
    'estiloForma'  => '',
    'estiloMarco'  => '',
    'preview'      => false,
])

<div class="relative min-h-screen bg-gradient-to-br from-pink-50 via-rose-50 to-fuchsia-50 flex items-center justify-center p-4 sm:p-8 font-app-body overflow-hidden">

    {{-- Flores de fondo --}}
    <div class="absolute inset-0 pointer-events-none overflow-hidden opacity-15">
        @foreach([['top-0','left-0',120],['top-0','right-0',100,true],['bottom-0','left-0',90,false,true],['bottom-0','right-0',110,true,true]] as [$t,$l,$s,$fx=false,$fy=false])
        <svg style="{{ $t }}:0;{{ $l }}:0;width:{{ $s }}px;height:{{ $s }}px;position:absolute;{{ $fx ? 'transform:scaleX(-1)' : '' }}{{ $fy ? ';transform:scaleY(-1)' : '' }}" viewBox="0 0 120 120" fill="none">
            <circle cx="60" cy="60" r="15" fill="#F9A8D4"/>
            @foreach([0,45,90,135,180,225,270,315] as $a)
            <ellipse cx="60" cy="30" rx="10" ry="20" fill="#FDA4AF" transform="rotate({{ $a }} 60 60)" opacity="0.8"/>
            @endforeach
        </svg>
        @endforeach
    </div>

    <div class="relative w-full max-w-2xl">

        {{-- Tarjeta principal --}}
        <div class="bg-white/90 backdrop-blur-sm rounded-[2rem] shadow-2xl border-2 border-pink-100 overflow-hidden">

            {{-- Encabezado rosado --}}
            <div class="bg-gradient-to-r from-pink-400 to-rose-400 px-8 py-8 text-center text-white relative overflow-hidden">
                <div class="absolute inset-0 opacity-20"
                     style="background-image: radial-gradient(circle at 20% 50%, white 1px, transparent 1px), radial-gradient(circle at 80% 20%, white 1px, transparent 1px), radial-gradient(circle at 50% 80%, white 1px, transparent 1px); background-size: 30px 30px;">
                </div>
                <div class="relative">
                    <div class="text-5xl mb-2">{{ $ocasionEmoji }}</div>
                    <p class="text-pink-100 text-xs uppercase tracking-widest mb-1">Para ti,</p>
                    <h1 class="font-app-heading text-3xl sm:text-4xl font-extrabold">{{ $destinatario }}</h1>
                    <div class="flex justify-center gap-2 mt-3 text-pink-200 text-lg">🌸 🌹 🌸</div>
                </div>
            </div>

            <div class="p-8 sm:p-10">

                {{-- Imagen --}}
                @if($imagenUrl)
                <div class="flex justify-center -mt-12 mb-6">
                    <div style="{{ $estiloMarco }}" class="ring-4 ring-white">
                        <div class="w-24 h-24 overflow-hidden" style="{{ $estiloForma ?: 'border-radius:50%;' }}">
                            <img src="{{ $imagenUrl }}" alt="Foto" class="w-full h-full object-contain bg-white">
                        </div>
                    </div>
                </div>
                @endif

                {{-- Mensaje --}}
                <div class="relative mb-8">
                    <div class="absolute -top-2 -left-2 text-6xl text-pink-200 leading-none font-serif select-none">"</div>
                    <div class="mensaje-contenido text-gray-600 leading-loose text-base sm:text-lg px-6 pt-4">{!! $mensajeHtml !!}</div>
                    <div class="absolute -bottom-2 -right-2 text-6xl text-pink-200 leading-none font-serif select-none rotate-180">"</div>
                </div>

                {{-- Separador flores --}}
                <div class="flex items-center gap-3 my-6">
                    <div class="flex-1 h-px bg-pink-100"></div>
                    <span class="text-pink-300 text-lg">🌸 🌷 🌸</span>
                    <div class="flex-1 h-px bg-pink-100"></div>
                </div>

                {{-- Firma --}}
                <div class="text-center">
                    <p class="text-gray-400 text-sm mb-1">Con todo mi amor y cariño,</p>
                    <p class="font-app-heading text-2xl font-bold text-rose-500 italic">{{ $remitente }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
