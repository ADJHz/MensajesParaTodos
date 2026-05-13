{{-- Template: Moderno Minimalista --}}
@props([
    'destinatario' => '',
    'remitente'    => '',
    'mensajeHtml'  => '',
    'ocasionEmoji' => '💌',
    'imagenUrl'    => null,
    'estiloForma'  => '',
    'estiloMarco'  => '',
    'preview'      => false,
])

<div class="relative min-h-screen bg-white flex items-center justify-center p-4 sm:p-8 font-app-body overflow-hidden">

    {{-- Blob decorativo --}}
    <div class="absolute top-0 right-0 w-96 h-96 pointer-events-none"
         style="background: radial-gradient(circle at top right, rgba(124,58,237,0.08) 0%, transparent 70%);">
    </div>
    <div class="absolute bottom-0 left-0 w-80 h-80 pointer-events-none"
         style="background: radial-gradient(circle at bottom left, rgba(244,114,182,0.08) 0%, transparent 70%);">
    </div>

    <div class="relative w-full max-w-xl">

        {{-- Línea de acento izquierda --}}
        <div class="flex gap-8">
            <div class="hidden sm:flex flex-col items-center gap-1 pt-2">
                <div class="w-0.5 flex-1 bg-gradient-to-b from-violet-400 to-transparent"></div>
                <div class="text-violet-400 text-lg">{{ $ocasionEmoji }}</div>
                <div class="w-0.5 flex-1 bg-gradient-to-t from-violet-400 to-transparent"></div>
            </div>

            <div class="flex-1">
                {{-- Para: --}}
                <div class="mb-8">
                    <p class="text-[11px] uppercase tracking-[0.3em] text-gray-400 font-semibold mb-2">Para</p>
                    <h1 class="font-app-heading text-4xl sm:text-5xl font-black text-gray-900 leading-none">
                        {{ $destinatario }}
                    </h1>
                </div>

                {{-- Imagen --}}
                @if($imagenUrl)
                <div class="mb-8">
                    <div style="{{ $estiloMarco }}">
                        <div class="w-full max-w-xs h-48 sm:h-56 overflow-hidden rounded-2xl" style="{{ $estiloForma ?: 'border-radius:1rem;' }}">
                            <img src="{{ $imagenUrl }}" alt="Foto" class="w-full h-full object-contain bg-white">
                        </div>
                    </div>
                </div>
                @endif

                {{-- Mensaje --}}
                <div class="mb-8">
                    <div class="w-8 h-1 bg-violet-500 rounded-full mb-6"></div>
                    <div class="mensaje-contenido text-gray-700 text-lg leading-relaxed">{!! $mensajeHtml !!}</div>
                    <div class="w-8 h-1 bg-pink-400 rounded-full mt-6 ml-auto"></div>
                </div>

                {{-- Firma --}}
                <div class="flex items-center gap-4 border-t border-gray-100 pt-6">
                    <div class="w-10 h-10 rounded-full bg-gradient-to-br from-violet-500 to-pink-500 flex items-center justify-center text-white font-bold text-lg shadow-sm">
                        {{ mb_strtoupper(mb_substr($remitente ?: 'A', 0, 1)) }}
                    </div>
                    <div>
                        <p class="text-xs text-gray-400">Enviado por</p>
                        <p class="font-bold text-gray-800 text-base">{{ $remitente }}</p>
                    </div>
                    <div class="ml-auto text-xs text-gray-300">💌 Mensajes para Todos</div>
                </div>
            </div>
        </div>
    </div>
</div>
