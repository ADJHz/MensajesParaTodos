@extends('layouts.app')

@section('title', 'Editar mensaje — '.$mensaje->destinatario)

@push('styles')
<style>
    [x-cloak] { display: none !important; }
    .shape-ninguna  { border-radius: 0.75rem; }
    .shape-cuadrado { border-radius: 0.5rem; }
    .shape-circulo  { border-radius: 9999px; }
    .shape-corazon  { clip-path: path('M50,90 C20,65 0,45 0,25 C0,10 12,0 25,0 C35,0 45,7 50,18 C55,7 65,0 75,0 C88,0 100,10 100,25 C100,45 80,65 50,90 Z'); }
    .shape-estrella { clip-path: polygon(50% 0%, 61% 35%, 98% 35%, 68% 57%, 79% 91%, 50% 70%, 21% 91%, 32% 57%, 2% 35%, 39% 35%); }
    .shape-hexagono { clip-path: polygon(25% 5%, 75% 5%, 100% 50%, 75% 95%, 25% 95%, 0% 50%); }
    .shape-diamante { clip-path: polygon(50% 0%, 100% 50%, 50% 100%, 0% 50%); }

    .marco-ninguno { box-shadow: none; }
    .marco-morado  { box-shadow: 0 0 0 4px #8b5cf6, 0 8px 20px -8px rgba(139,92,246,.6); }
    .marco-dorado  { box-shadow: 0 0 0 4px #f59e0b, 0 8px 20px -8px rgba(245,158,11,.6); }
    .marco-rosa    { box-shadow: 0 0 0 4px #ec4899, 0 8px 20px -8px rgba(236,72,153,.6); }
    .marco-verde   { box-shadow: 0 0 0 4px #10b981, 0 8px 20px -8px rgba(16,185,129,.6); }
    .marco-sombra  { box-shadow: 0 12px 32px -10px rgba(0,0,0,.45); }
    .marco-blanco  { box-shadow: 0 0 0 6px #fff, 0 10px 24px -10px rgba(0,0,0,.35); }

    .opt-card {
        cursor: pointer;
        transition: all .15s ease;
        border: 2px solid transparent;
    }
    .opt-card:hover { transform: translateY(-1px); }
    .opt-card.selected {
        border-color: #8b5cf6;
        background: #f5f3ff;
    }
    .tpl-card {
        cursor: pointer;
        transition: all .15s ease;
        border: 2px solid #e5e7eb;
    }
    .tpl-card:hover { transform: translateY(-2px); border-color: #c4b5fd; }
    .tpl-card.selected {
        border-color: #8b5cf6;
        box-shadow: 0 0 0 4px rgba(139,92,246,.18);
    }
</style>
@endpush

@section('content')
<div class="max-w-screen-xl mx-auto px-4 py-8" x-data="editarMensaje()" x-cloak>

    {{-- Breadcrumb --}}
    <nav class="text-sm text-gray-500 mb-4 flex items-center gap-2 flex-wrap">
        <a href="{{ route('mensajes.mios') }}" class="hover:text-violet-600">Mi Estudio</a>
        <span>/</span>
        <a href="{{ route('mensajes.mios') }}" class="hover:text-violet-600">Mis Mensajes</a>
        <span>/</span>
        <span class="text-gray-700 font-medium">Editar</span>
    </nav>

    {{-- Header --}}
    <header class="mb-6">
        <div class="flex items-start gap-3 flex-wrap">
            <div class="text-4xl leading-none">{{ $ocasion->emoji ?? '💌' }}</div>
            <div class="flex-1 min-w-0">
                <h1 class="text-2xl sm:text-3xl font-bold text-gray-900">
                    Editar mensaje — <span class="text-violet-700">{{ $mensaje->destinatario }}</span>
                </h1>
                <p class="text-gray-600 mt-1">
                    {{ $ocasion->nombre }} · Los cambios son gratis ✨
                </p>
            </div>
            <div>
                @if($mensaje->estado === 'pagado')
                    <span class="inline-flex items-center gap-1 px-3 py-1.5 rounded-full text-sm font-semibold bg-emerald-100 text-emerald-800">
                        ✅ Mensaje activo
                    </span>
                @else
                    <span class="inline-flex items-center gap-1 px-3 py-1.5 rounded-full text-sm font-semibold bg-amber-100 text-amber-800">
                        ⏳ Pendiente de pago
                    </span>
                @endif
            </div>
        </div>

        @if($mensaje->estado === 'pagado')
            <div class="mt-4 rounded-xl bg-emerald-50 border border-emerald-200 px-4 py-3 text-emerald-800 text-sm flex items-center gap-2">
                <span class="text-lg">💚</span>
                <span><strong>Editar es gratis ✨</strong> — ya pagaste por este mensaje. Cambia lo que quieras sin ningún cobro extra.</span>
            </div>
        @endif

        @if ($errors->any())
            <div class="mt-4 rounded-xl bg-red-50 border border-red-200 px-4 py-3 text-red-800 text-sm">
                <strong>Revisa los siguientes errores:</strong>
                <ul class="list-disc list-inside mt-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </header>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">

        {{-- ============== COLUMNA IZQUIERDA: FORMULARIO ============== --}}
        <div>
            <form method="POST"
                  action="{{ route('mensajes.update', $mensaje->code) }}"
                  enctype="multipart/form-data"
                  x-ref="form"
                  class="space-y-6 bg-white rounded-2xl shadow-sm border border-gray-200 p-5 sm:p-6">
                @csrf
                @method('PUT')

                {{-- 1. Destinatario --}}
                <div>
                    <label for="destinatario" class="block text-sm font-semibold text-gray-800 mb-1">
                        ¿Para quién es? <span class="text-red-500">*</span>
                    </label>
                    <input type="text"
                           name="destinatario"
                           id="destinatario"
                           required
                           maxlength="100"
                           x-model="destinatario"
                           value="{{ old('destinatario', $mensaje->destinatario) }}"
                           class="block w-full rounded-lg border-gray-300 focus:border-violet-500 focus:ring-violet-500 text-base px-4 py-3"
                           placeholder="Mamá, Sofía, Abuela…">
                    @error('destinatario')<p class="text-sm text-red-600 mt-1">{{ $message }}</p>@enderror
                </div>

                {{-- 2. Remitente --}}
                <div>
                    <label for="remitente" class="block text-sm font-semibold text-gray-800 mb-1">
                        Tu nombre (remitente) <span class="text-red-500">*</span>
                    </label>
                    <input type="text"
                           name="remitente"
                           id="remitente"
                           required
                           maxlength="100"
                           x-model="remitente"
                           value="{{ old('remitente', $mensaje->remitente) }}"
                           class="block w-full rounded-lg border-gray-300 focus:border-violet-500 focus:ring-violet-500 text-base px-4 py-3"
                           placeholder="Tu nombre o apodo">
                    @error('remitente')<p class="text-sm text-red-600 mt-1">{{ $message }}</p>@enderror
                </div>

                {{-- 3. Mensaje --}}
                <div>
                    <label for="mensaje" class="block text-sm font-semibold text-gray-800 mb-1">
                        Tu mensaje <span class="text-red-500">*</span>
                    </label>
                    <textarea name="mensaje"
                              id="mensaje"
                              required
                              maxlength="30000"
                              rows="10"
                              x-model="mensaje"
                              class="block w-full rounded-lg border-gray-300 focus:border-violet-500 focus:ring-violet-500 text-base px-4 py-3 leading-relaxed"
                              placeholder="Escribe desde el corazón…">{{ old('mensaje', strip_tags($mensaje->mensaje)) }}</textarea>
                    <p class="text-xs text-gray-500 mt-1">Soportamos negrita, cursiva y emoji. ✨</p>
                    @error('mensaje')<p class="text-sm text-red-600 mt-1">{{ $message }}</p>@enderror
                </div>

                {{-- 4. Música --}}
                <div>
                    @include('mensajes.partials.music-picker', ['audio' => [
                        'audio_url'     => old('audio_url',     $mensaje->audio_url),
                        'audio_titulo'  => old('audio_titulo',  $mensaje->audio_titulo),
                        'audio_artista' => old('audio_artista', $mensaje->audio_artista),
                        'audio_thumb'   => old('audio_thumb',   $mensaje->audio_thumb),
                        'audio_start'   => old('audio_start',   $mensaje->audio_start ?? 0),
                        'audio_end'     => old('audio_end',     $mensaje->audio_end ?? 15),
                        'audio_display_mode' => old('audio_display_mode', $mensaje->audio_display_mode ?? 'cover'),
                        'audio_lyrics'  => old('audio_lyrics',  $mensaje->audio_lyrics),
                        'audio_pos_x'   => old('audio_pos_x',   $mensaje->audio_pos_x ?? 24),
                        'audio_pos_y'   => old('audio_pos_y',   $mensaje->audio_pos_y ?? 24),
                        'audio_scale'   => old('audio_scale',   $mensaje->audio_scale ?? 100),
                    ],
                    'ocasionId' => $mensaje->ocasion_id,
                    'mensajeTexto' => old('mensaje', strip_tags($mensaje->mensaje)),
                    ])
                </div>

                {{-- 4.5 Personaje decorativo --}}
                <div class="p-4 rounded-2xl bg-pink-50 border border-pink-100"
                     x-data="{
                        origen: '{{ old('personaje_origen', $mensaje->personaje_origen ?? 'tema') }}',
                        estilo: '{{ old('personaje_estilo', $mensaje->personaje_estilo ?? 'adventurer') }}',
                        preview: null,
                        eliminar: false,
                     }">
                    <p class="text-sm font-semibold text-gray-800 mb-1">🦄 Personaje decorativo <span class="text-gray-400 font-normal">— opcional</span></p>
                    <p class="text-xs text-gray-500 mb-3">Aparecerá en una esquina del mensaje, animado.</p>

                    <input type="hidden" name="personaje_origen" :value="origen">
                    <input type="hidden" name="personaje_estilo" :value="estilo">
                    <input type="hidden" name="eliminar_personaje" :value="eliminar ? 1 : 0">

                    <div class="grid grid-cols-2 sm:grid-cols-4 gap-2 mb-3">
                        <button type="button" @click="origen='tema'"
                                :class="origen==='tema' ? 'ring-2 ring-pink-500 bg-white' : 'bg-white/60 hover:bg-white'"
                                class="p-2 rounded-xl border border-pink-200 text-xs font-semibold text-gray-700 transition">🎨 Del tema</button>
                        <button type="button" @click="origen='dicebear'"
                                :class="origen==='dicebear' ? 'ring-2 ring-pink-500 bg-white' : 'bg-white/60 hover:bg-white'"
                                class="p-2 rounded-xl border border-pink-200 text-xs font-semibold text-gray-700 transition">🤖 Generado</button>
                        <button type="button" @click="origen='custom'"
                                :class="origen==='custom' ? 'ring-2 ring-pink-500 bg-white' : 'bg-white/60 hover:bg-white'"
                                class="p-2 rounded-xl border border-pink-200 text-xs font-semibold text-gray-700 transition">📤 Mi imagen</button>
                        <button type="button" @click="origen='ninguno'"
                                :class="origen==='ninguno' ? 'ring-2 ring-pink-500 bg-white' : 'bg-white/60 hover:bg-white'"
                                class="p-2 rounded-xl border border-pink-200 text-xs font-semibold text-gray-700 transition">🚫 Ninguno</button>
                    </div>

                    <div x-show="origen==='dicebear'" x-transition class="space-y-2">
                        <p class="text-xs text-gray-500">Elige un estilo de avatar:</p>
                        <div class="grid grid-cols-3 sm:grid-cols-5 gap-2">
                            @foreach(['adventurer'=>'Aventurero','big-smile'=>'Sonrisa','lorelei'=>'Lorelei','micah'=>'Micah','notionists'=>'Notion','fun-emoji'=>'Emoji','miniavs'=>'Mini','pixel-art'=>'Pixel','croodles'=>'Croodle','bottts'=>'Robot'] as $k => $lb)
                                <button type="button" @click="estilo='{{ $k }}'"
                                        :class="estilo==='{{ $k }}' ? 'ring-2 ring-pink-500' : ''"
                                        class="bg-white rounded-lg p-1 border border-pink-100 hover:border-pink-300 transition flex flex-col items-center">
                                    <img src="https://api.dicebear.com/9.x/{{ $k }}/svg?seed={{ urlencode($mensaje->personaje_seed ?: $mensaje->destinatario) }}&size=80&radius=50" alt="" class="w-10 h-10">
                                    <span class="text-[10px] text-gray-600">{{ $lb }}</span>
                                </button>
                            @endforeach
                        </div>
                    </div>

                    <div x-show="origen==='custom'" x-transition class="space-y-2">
                        @if($mensaje->personaje_path)
                            <div class="flex items-center gap-3 p-2 rounded-xl bg-white border border-pink-200" x-show="!eliminar">
                                <img src="{{ \Storage::url($mensaje->personaje_path) }}" alt="" class="w-16 h-16 object-contain rounded-lg">
                                <div class="flex-1 min-w-0">
                                    <p class="text-xs font-medium text-gray-800">Personaje actual</p>
                                    <p class="text-[11px] text-gray-500">Sube otro abajo para reemplazar, o quítalo.</p>
                                </div>
                                <button type="button" @click="eliminar=true" class="text-xs font-semibold text-red-600 hover:text-red-700">Quitar</button>
                            </div>
                        @endif
                        <label class="cursor-pointer block bg-white border-2 border-dashed border-pink-300 rounded-xl p-4 text-center hover:bg-pink-50 transition">
                            <template x-if="preview">
                                <img :src="preview" class="mx-auto w-20 h-20 object-contain rounded-lg mb-2">
                            </template>
                            <template x-if="!preview">
                                <div class="text-3xl mb-1">📤</div>
                            </template>
                            <span class="text-xs font-semibold text-pink-600" x-text="preview ? 'Cambiar imagen' : 'Subir personaje (PNG/JPG)'"></span>
                            <input type="file" name="personaje_imagen" accept="image/png,image/jpeg,image/webp,image/gif" class="hidden"
                                   @change="const f=$event.target.files[0]; if(f){ const r=new FileReader(); r.onload=e=>preview=e.target.result; r.readAsDataURL(f); eliminar=false; }">
                        </label>
                        <p class="text-[11px] text-gray-400 text-center">⚠️ Solo sube imágenes propias o libres de derechos. Tú eres responsable del contenido.</p>
                    </div>
                </div>

                {{-- 5. Imagen --}}
                <div class="space-y-4">
                    <label class="block text-sm font-semibold text-gray-800">
                        Imagen del mensaje <span class="text-gray-400 font-normal">— opcional</span>
                    </label>

                    @if($mensaje->imagen_path)
                        <div class="flex items-center gap-4 p-3 rounded-xl bg-gray-50 border border-gray-200"
                             x-show="!eliminarImagen && imagenPreviewURL">
                            <img :src="imagenPreviewURL"
                                 alt="Imagen actual"
                                 class="w-20 h-20 object-contain rounded-lg bg-white">
                            <div class="flex-1 min-w-0">
                                <p class="text-sm font-medium text-gray-800">Imagen actual</p>
                                <p class="text-xs text-gray-500">Sube otra abajo para reemplazarla, o quítala.</p>
                            </div>
                            <button type="button"
                                    @click="quitarImagen()"
                                    class="text-sm font-semibold text-red-600 hover:text-red-700">
                                Quitar imagen
                            </button>
                        </div>
                        <div x-show="eliminarImagen"
                             class="p-3 rounded-xl bg-red-50 border border-red-200 text-sm text-red-700 flex items-center justify-between">
                            <span>Se eliminará la imagen actual al guardar.</span>
                            <button type="button"
                                    @click="eliminarImagen = false; imagenPreviewURL = @json($mensaje->imagen_path ? asset('storage/'.$mensaje->imagen_path) : null);"
                                    class="font-semibold underline">Deshacer</button>
                        </div>
                    @endif

                    <input type="hidden" name="eliminar_imagen" :value="eliminarImagen ? '1' : '0'">

                    <div>
                        <label for="imagen" class="block text-xs font-medium text-gray-700 mb-1">
                            {{ $mensaje->imagen_path ? 'Reemplazar con otra imagen' : 'Subir imagen' }}
                        </label>
                        <input type="file"
                               name="imagen"
                               id="imagen"
                               accept="image/*"
                               @change="onImagenChange($event)"
                               class="block w-full text-sm text-gray-700 file:mr-3 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-violet-50 file:text-violet-700 hover:file:bg-violet-100">
                        @error('imagen')<p class="text-sm text-red-600 mt-1">{{ $message }}</p>@enderror
                    </div>

                    {{-- Forma de imagen --}}
                    <div>
                        <p class="text-xs font-medium text-gray-700 mb-2">Forma de la imagen</p>
                        <div class="grid grid-cols-4 sm:grid-cols-7 gap-2">
                            @foreach(['ninguna' => 'Sin','cuadrado' => 'Cuadro','circulo' => 'Círculo','corazon' => 'Corazón','estrella' => 'Estrella','hexagono' => 'Hex','diamante' => 'Diamante'] as $val => $label)
                                <label class="opt-card rounded-xl p-2 text-center bg-white"
                                       :class="imagenForma === '{{ $val }}' ? 'selected' : ''">
                                    <input type="radio"
                                           name="imagen_forma"
                                           value="{{ $val }}"
                                           x-model="imagenForma"
                                           class="sr-only">
                                    <div class="mx-auto w-14 h-14 rounded-xl bg-violet-50 border border-violet-200 flex items-center justify-center">
                                        <div class="w-10 h-10 bg-gradient-to-br from-violet-300 to-pink-300 shape-{{ $val }}"></div>
                                    </div>
                                    <div class="text-xs mt-1 font-medium text-gray-700">{{ $label }}</div>
                                </label>
                            @endforeach
                        </div>
                        @error('imagen_forma')<p class="text-sm text-red-600 mt-1">{{ $message }}</p>@enderror
                    </div>

                    {{-- Marco --}}
                    <div>
                        <p class="text-xs font-medium text-gray-700 mb-2">Marco</p>
                        <div class="grid grid-cols-4 sm:grid-cols-7 gap-2">
                            @foreach(['ninguno' => 'Sin','morado' => 'Morado','dorado' => 'Dorado','rosa' => 'Rosa','verde' => 'Verde','sombra' => 'Sombra','blanco' => 'Blanco'] as $val => $label)
                                <label class="opt-card rounded-xl p-2 text-center bg-white"
                                       :class="imagenMarco === '{{ $val }}' ? 'selected' : ''">
                                    <input type="radio"
                                           name="imagen_marco"
                                           value="{{ $val }}"
                                           x-model="imagenMarco"
                                           class="sr-only">
                                    <div class="mx-auto w-14 h-14 rounded-xl bg-gray-100 border border-gray-200 flex items-center justify-center">
                                        <div class="w-10 h-10 rounded-lg bg-white border border-gray-200 marco-{{ $val }}"></div>
                                    </div>
                                    <div class="text-xs mt-1 font-medium text-gray-700">{{ $label }}</div>
                                </label>
                            @endforeach
                        </div>
                        @error('imagen_marco')<p class="text-sm text-red-600 mt-1">{{ $message }}</p>@enderror
                    </div>
                </div>

                {{-- 6. Template --}}
                <div>
                    <label class="block text-sm font-semibold text-gray-800 mb-2">
                        Diseño / Template
                    </label>
                    <input type="hidden" name="template" x-model="template">
                    <div class="grid grid-cols-2 md:grid-cols-3 gap-3">
                        @foreach($templates as $tpl)
                            <div class="tpl-card rounded-xl p-3 bg-white"
                                 :class="template === '{{ $tpl['id'] }}' ? 'selected' : ''"
                                 @click="template = '{{ $tpl['id'] }}'">
                                <div class="rounded-lg overflow-hidden mb-2 h-16 flex items-end"
                                     style="background: {{ $tpl['bg'] }}">
                                    <div class="w-full h-2" style="background: {{ $tpl['bar'] }}"></div>
                                </div>
                                <div class="flex items-center gap-1.5">
                                    <span class="text-lg leading-none">{{ $tpl['emoji'] }}</span>
                                    <span class="font-semibold text-sm text-gray-800">{{ $tpl['nombre'] }}</span>
                                </div>
                                <p class="text-[11px] text-gray-500 mt-1 line-clamp-2">{{ $tpl['desc'] }}</p>
                            </div>
                        @endforeach
                    </div>
                    @error('template')<p class="text-sm text-red-600 mt-1">{{ $message }}</p>@enderror
                </div>

                {{-- Botones --}}
                <div class="pt-4 border-t border-gray-200 flex flex-col-reverse sm:flex-row sm:items-center sm:justify-between gap-3">
                    <div class="flex items-center gap-3">
                        <a href="{{ route('mensajes.mios') }}"
                           class="text-sm font-semibold text-gray-600 hover:text-gray-900 px-3 py-2">
                            Cancelar
                        </a>
                        @if($mensaje->estado === 'pagado')
                            <a href="{{ route('mensajes.show', $mensaje->code) }}"
                               target="_blank"
                               class="text-sm font-semibold text-violet-600 hover:text-violet-800 px-3 py-2 inline-flex items-center gap-1">
                                Ver mensaje actual
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 3h7v7m0-7L10 14M5 5h6v2H7v10h10v-4h2v6H5V5z"/></svg>
                            </a>
                        @endif
                    </div>
                    <button type="submit"
                            class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-6 py-3 rounded-xl bg-violet-600 hover:bg-violet-700 text-white font-bold shadow-md hover:shadow-lg transition-all">
                        💾 Guardar cambios
                    </button>
                </div>
            </form>
        </div>

        {{-- ============== COLUMNA DERECHA: PREVIEW ============== --}}
        <div>
            <div class="lg:sticky lg:top-24">
                <div class="flex items-center justify-between mb-3">
                    <h2 class="text-sm font-semibold text-gray-700 uppercase tracking-wide">Vista previa en vivo</h2>
                    <span class="text-xs text-gray-500">Se actualiza al escribir</span>
                </div>

                {{-- Browser frame --}}
                <div class="rounded-2xl overflow-hidden shadow-2xl border border-gray-200 bg-white">
                    <div class="flex items-center gap-2 px-3 py-2 bg-gray-100 border-b border-gray-200">
                        <span class="w-3 h-3 rounded-full bg-red-400"></span>
                        <span class="w-3 h-3 rounded-full bg-yellow-400"></span>
                        <span class="w-3 h-3 rounded-full bg-green-400"></span>
                        <div class="flex-1 mx-2 px-3 py-1 rounded-md bg-white text-xs text-gray-600 truncate font-mono">
                            mensajes.para/{{ $mensaje->code }}
                        </div>
                    </div>

                    {{-- Wrapper con config dinámico --}}
                    <div :style="config().wrap" class="min-h-[420px] p-6 flex items-center justify-center">
                        <div :style="config().card"
                             class="relative w-full max-w-sm rounded-2xl overflow-hidden">

                            {{-- Barra superior --}}
                            <div :style="config().bar" class="h-2 w-full"></div>

                            {{-- Arte decorativo --}}
                            <div class="absolute inset-0 pointer-events-none" x-html="arte()" style="overflow:hidden;"></div>

                            <div class="relative p-6 space-y-4">
                                {{-- Destinatario --}}
                                <div class="text-center">
                                    <p class="text-xs uppercase tracking-widest opacity-70"
                                       :style="`color:${config().tc}`">Para</p>
                                    <p class="text-2xl font-bold mt-1"
                                       :style="`color:${config().tc}`"
                                       x-text="trunc(destinatario, 22) || 'Destinatario'"></p>
                                </div>

                                {{-- Imagen preview --}}
                                <template x-if="imagenPreviewURL && !eliminarImagen">
                                    <div class="flex justify-center">
                                        <div :class="`shape-${imagenForma} marco-${imagenMarco}`"
                                             class="w-24 h-24 overflow-hidden">
                                            <img :src="imagenPreviewURL" class="w-full h-full object-contain bg-white" alt="">
                                        </div>
                                    </div>
                                </template>

                                {{-- Mensaje --}}
                                <div class="rounded-lg bg-white/70 backdrop-blur p-3 text-sm leading-relaxed text-gray-800 max-h-40 overflow-y-auto whitespace-pre-wrap"
                                     x-text="mensaje || 'Tu mensaje aparecerá aquí…'">
                                </div>

                                {{-- Firma --}}
                                <div class="text-right">
                                    <p class="text-xs opacity-70" :style="`color:${config().fc}`">— con cariño,</p>
                                    <p class="text-base font-semibold italic"
                                       :style="`color:${config().fc}`"
                                       x-text="trunc(remitente, 28) || 'Remitente'"></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <p class="text-xs text-center text-gray-500 mt-3">
                    Esto es una vista aproximada. La página real puede incluir música, animaciones y más.
                </p>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    function editarMensaje() {
        return {
            destinatario:  @json($mensaje->destinatario),
            remitente:     @json($mensaje->remitente),
            mensaje:       @json(strip_tags($mensaje->mensaje)),
            template:      @json($mensaje->template ?? 'clasico'),
            imagenForma:   @json($mensaje->imagen_forma ?? 'circulo'),
            imagenMarco:   @json($mensaje->imagen_marco ?? 'ninguno'),
            eliminarImagen: false,
            imagenPreviewURL: @json($mensaje->imagen_path ? asset('storage/'.$mensaje->imagen_path) : null),
            PREVIEW_CONFIGS: @json($previewConfigs),
            PREVIEW_ARTE:    @json($previewArte),

            config() {
                return this.PREVIEW_CONFIGS[this.template] || this.PREVIEW_CONFIGS['clasico'] || { wrap:'', card:'', bar:'', tc:'#111', ac:'#8b5cf6', bg:'#fff', tx:'#333', fc:'#555' };
            },
            arte() {
                return this.PREVIEW_ARTE[this.template] || '';
            },
            onImagenChange(e) {
                const file = e.target.files[0];
                if (!file) return;
                const reader = new FileReader();
                reader.onload = ev => {
                    this.imagenPreviewURL = ev.target.result;
                    this.eliminarImagen = false;
                };
                reader.readAsDataURL(file);
            },
            quitarImagen() {
                this.eliminarImagen = true;
                this.imagenPreviewURL = null;
                const input = document.getElementById('imagen');
                if (input) input.value = '';
            },
            trunc(s, n) {
                return s && s.length > n ? s.slice(0, n - 1) + '…' : (s || '');
            },
            escapeHTML(s) {
                const d = document.createElement('div');
                d.textContent = s || '';
                return d.innerHTML;
            }
        };
    }
</script>
@endpush
