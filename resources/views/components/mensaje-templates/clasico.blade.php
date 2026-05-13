{{-- Template: Clásico Elegante --}}
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

<div class="relative min-h-screen bg-[#F8F6FF] flex items-center justify-center p-4 sm:p-8 font-app-body overflow-hidden">

    {{-- Fondo decorativo: líneas sutiles --}}
    <div class="absolute inset-0 pointer-events-none"
         style="background-image: repeating-linear-gradient(0deg, transparent, transparent 39px, rgba(124,58,237,0.06) 39px, rgba(124,58,237,0.06) 40px);">
    </div>

    <div class="relative w-full max-w-2xl bg-white rounded-3xl shadow-2xl border border-violet-100 overflow-hidden">

        {{-- Cinta superior --}}
        <div class="h-2 bg-gradient-to-r from-violet-600 via-purple-500 to-pink-500"></div>

        {{-- Sello lateral izquierdo --}}
        <div class="absolute left-0 top-1/2 -translate-y-1/2 w-3 flex flex-col gap-2 pl-1">
            @foreach(range(0,8) as $i)
            <div class="w-2 h-2 rounded-full bg-violet-100"></div>
            @endforeach
        </div>

        <div class="px-8 sm:px-14 py-10">

            {{-- Encabezado --}}
            <div class="text-center mb-8">
                <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-violet-50 text-4xl mb-3 shadow-inner">
                    {{ $ocasionEmoji }}
                </div>
                <p class="text-xs uppercase tracking-[0.2em] text-violet-400 font-semibold mb-1">Un mensaje especial para</p>
                <h1 class="font-app-heading text-3xl sm:text-4xl font-extrabold text-gray-800 leading-tight">{{ $destinatario }}</h1>
            </div>

            {{-- Imagen --}}
            @if($imagenUrl)
            <div class="flex justify-center mb-8">
                <div style="{{ $estiloMarco }}">
                    <div class="w-40 h-40 sm:w-48 sm:h-48 overflow-hidden" style="{{ $estiloForma }}">
                        <img src="{{ $imagenUrl }}" alt="Foto" class="w-full h-full object-cover">
                    </div>
                </div>
            </div>
            @endif

            {{-- Mensaje --}}
            <div class="bg-gradient-to-br from-violet-50/60 to-pink-50/60 rounded-2xl p-6 sm:p-8 mb-8 border border-violet-100 relative">
                <svg class="absolute top-3 left-4 w-8 h-8 text-violet-200 opacity-60" fill="currentColor" viewBox="0 0 24 24"><path d="M14.017 21v-7.391c0-5.704 3.731-9.57 8.983-10.609l.995 2.151c-2.432.917-3.995 3.638-3.995 5.849h4v10h-9.983zm-14.017 0v-7.391c0-5.704 3.748-9.57 9-10.609l.996 2.151c-2.433.917-3.996 3.638-3.996 5.849h3.983v10h-9.983z"/></svg>
                <div class="mensaje-contenido text-gray-700 leading-loose text-base sm:text-lg pl-6">{!! $mensajeHtml !!}</div>
            </div>

            {{-- Firma --}}
            <div class="flex items-center justify-between border-t border-violet-100 pt-6">
                <div>
                    <p class="text-xs text-gray-400 mb-0.5">Con todo mi cariño,</p>
                    <p class="font-app-heading text-xl font-bold text-violet-700 italic">{{ $remitente }}</p>
                </div>
                <div class="text-right">
                    <p class="text-xs text-gray-300">💌 Mensajes para Todos</p>
                </div>
            </div>
        </div>

        {{-- Cinta inferior --}}
        <div class="h-2 bg-gradient-to-r from-pink-500 via-purple-500 to-violet-600"></div>
    </div>
</div>
