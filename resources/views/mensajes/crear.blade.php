@extends('layouts.app')
@section('title', 'Crear mensaje' . ($ocasion ? ' — ' . $ocasion->nombre : ''))
@section('robots', 'noindex, nofollow')

@section('content')

{{-- SVG Clip Paths globales --}}
<svg width="0" height="0" style="position:absolute;overflow:hidden;pointer-events:none;z-index:-1">
  <defs>
    <clipPath id="cp-heart" clipPathUnits="objectBoundingBox">
      <path d="M0.5,0.25 C0.5,0.1,0.65,0,0.75,0 C0.9,0,1,0.15,1,0.3 C1,0.5,0.8,0.7,0.5,0.9 C0.2,0.7,0,0.5,0,0.3 C0,0.15,0.1,0,0.25,0 C0.35,0,0.5,0.1,0.5,0.25"/>
    </clipPath>
    <clipPath id="cp-star" clipPathUnits="objectBoundingBox">
      <polygon points="0.5,0.05 0.61,0.35 0.95,0.35 0.68,0.54 0.79,0.88 0.5,0.68 0.21,0.88 0.32,0.54 0.05,0.35 0.39,0.35"/>
    </clipPath>
    <clipPath id="cp-hexagon" clipPathUnits="objectBoundingBox">
      <polygon points="0.5,0 1,0.25 1,0.75 0.5,1 0,0.75 0,0.25"/>
    </clipPath>
    <clipPath id="cp-diamond" clipPathUnits="objectBoundingBox">
      <polygon points="0.5,0 1,0.45 0.5,1 0,0.45"/>
    </clipPath>
  </defs>
</svg>

<div x-data="crearMensaje()"
     x-init="init()"
     class="min-h-screen bg-[#F5F3FF]">

  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 lg:py-12">

    {{-- Breadcrumb --}}
    <div class="hidden sm:flex items-center gap-2 text-sm text-gray-400 mb-6">
      <a href="{{ route('dashboard') }}" class="hover:text-violet-600 transition">Mi Estudio</a>
      <span>/</span>
      @if($ocasion)
        <span class="text-gray-600">{{ $ocasion->categoria->emoji }} {{ $ocasion->categoria->nombre }}</span>
        <span>/</span>
        <span class="text-violet-600 font-semibold">{{ $ocasion->nombre }}</span>
      @else
        <span class="text-violet-600 font-semibold">Nuevo mensaje</span>
      @endif
    </div>

    {{-- Header --}}
    <div class="flex items-center gap-4 mb-8">
      @if($ocasion)
        <div class="text-4xl sm:text-5xl">{{ $ocasion->emoji }}</div>
        <div>
          <h1 class="font-app-heading text-2xl sm:text-3xl font-bold text-gray-800 leading-tight">{{ $ocasion->nombre }}</h1>
          <p class="text-gray-500 text-sm mt-0.5">{{ $ocasion->descripcion }}</p>
        </div>
      @else
        <div class="text-4xl">✍️</div>
        <h1 class="font-app-heading text-2xl sm:text-3xl font-bold text-gray-800">Crea tu mensaje</h1>
      @endif
    </div>

    {{-- Grid: wizard (izq) + preview (der en desktop, abajo en móvil) --}}
    <div class="grid grid-cols-1 lg:grid-cols-[minmax(0,1fr)_400px] xl:grid-cols-[minmax(0,1fr)_460px] gap-6 lg:gap-8 items-start">

      {{-- ===== COLUMNA IZQUIERDA: WIZARD ===== --}}
      <div class="w-full min-w-0">
        <div class="bg-white rounded-3xl shadow-lg border border-gray-100 overflow-hidden">

          {{-- Progress bar 4 pasos --}}
          <div class="bg-violet-50 px-5 sm:px-8 py-4 border-b border-violet-100">
            <div class="flex items-center">
              @foreach(['Destinatario', 'Diseño', 'Mensaje', 'Pagar'] as $i => $lbl)
              <div class="flex items-center {{ $i < 3 ? 'flex-1' : '' }}">
                <div class="flex items-center gap-1">
                  <div class="w-7 h-7 rounded-full flex items-center justify-center text-xs font-bold flex-shrink-0 transition-all duration-300"
                       :class="paso > {{ $i+1 }} ? 'bg-emerald-500 text-white shadow' : (paso === {{ $i+1 }} ? 'bg-violet-600 text-white shadow-md' : 'bg-violet-100 text-violet-400')">
                    <span x-show="paso <= {{ $i+1 }}">{{ $i+1 }}</span>
                    <span x-show="paso > {{ $i+1 }}">✓</span>
                  </div>
                  <span class="text-[10px] sm:text-[11px] font-semibold block max-w-12 sm:max-w-none truncate"
                        :class="paso === {{ $i+1 }} ? 'text-violet-700' : 'text-gray-400'">{{ $lbl }}</span>
                </div>
                @if($i < 3)
                <div class="flex-1 h-0.5 mx-1 sm:mx-2 transition-all duration-500"
                     :class="paso > {{ $i+1 }} ? 'bg-violet-400' : 'bg-violet-100'"></div>
                @endif
              </div>
              @endforeach
            </div>
          </div>

          <form method="POST" action="{{ route('mensajes.store') }}" x-ref="form" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="mensaje" x-bind:value="mensajeHTML">
            <input type="hidden" name="imagen_forma" x-model="imagenForma">
            <input type="hidden" name="imagen_marco" x-model="imagenMarco">
            <input type="hidden" name="template" x-model="templateSeleccionado">
            @if($ocasion)<input type="hidden" name="ocasion_id" value="{{ $ocasion->id }}">@endif

            {{-- PASO 1: Destinatario --}}
            <div x-show="paso === 1" class="p-6 sm:p-8">
              <h2 class="font-app-heading text-lg sm:text-xl font-bold text-gray-800 mb-6">👤 ¿Para quién es el mensaje?</h2>

              @if(!$ocasion)
              <div class="mb-5">
                <label class="block text-sm font-semibold text-gray-700 mb-1">Ocasión <span class="text-red-400">*</span></label>
                <select name="ocasion_id" required x-model="ocasionId" @change="cambiarOcasion($event)"
                        class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:outline-none focus:ring-2 focus:ring-violet-400 bg-white text-sm">
                  <option value="">Selecciona una ocasión...</option>
                  @foreach(\App\Models\Ocasion::with('categoria')->where('activo', true)->get()->groupBy('categoria.nombre') as $catNombre => $items)
                    <optgroup label="{{ $catNombre }}">
                      @foreach($items as $o)
                        <option value="{{ $o->id }}" data-slug="{{ $o->slug }}">{{ $o->emoji }} {{ $o->nombre }}</option>
                      @endforeach
                    </optgroup>
                  @endforeach
                </select>
                <p class="text-[11px] text-gray-400 mt-1">Al seleccionar una ocasión se cargarán sus plantillas específicas.</p>
                @error('ocasion_id')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
              </div>
              @endif

              <div class="space-y-4">
                <div>
                  <label class="block text-sm font-semibold text-gray-700 mb-1">Nombre del destinatario <span class="text-red-400">*</span></label>
                  <input type="text" name="destinatario" x-model="destinatario" @input="emitirPreview()"
                         required maxlength="100"
                         class="w-full px-4 py-3 rounded-xl border @error('destinatario') border-red-400 @else border-gray-200 @enderror focus:outline-none focus:ring-2 focus:ring-violet-400 transition text-sm"
                         placeholder="¿Para quién es? (ej. Mamá, Ana, Diego...)">
                  @error('destinatario')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                </div>
                <div>
                  <label class="block text-sm font-semibold text-gray-700 mb-1">Tu nombre <span class="text-red-400">*</span></label>
                  <input type="text" name="remitente" x-model="remitente" @input="emitirPreview()"
                         required maxlength="100"
                         class="w-full px-4 py-3 rounded-xl border @error('remitente') border-red-400 @else border-gray-200 @enderror focus:outline-none focus:ring-2 focus:ring-violet-400 transition text-sm"
                         placeholder="Tu nombre o firma">
                  @error('remitente')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                </div>
              </div>

              <button type="button" @click="siguientePaso()"
                      class="mt-8 w-full py-4 bg-violet-600 text-white font-bold rounded-full hover:bg-violet-700 active:scale-95 transition-all shadow-lg shadow-violet-200">
                Continuar → Elegir diseño
              </button>
            </div>

            {{-- PASO 2: Selector de template (dinámico por categoría) --}}
            <div x-show="paso === 2" x-cloak class="p-6 sm:p-8">
              <h2 class="font-app-heading text-lg sm:text-xl font-bold text-gray-800 mb-1">🎨 Elige el diseño</h2>
              <p class="text-gray-500 text-sm mb-1">
                @if($ocasion)
                  Diseños únicos para <span class="font-semibold text-violet-600">{{ $ocasion->nombre }}</span>.
                @else
                  El fondo y estilo visual de tu mensaje.
                @endif
                La preview se actualiza al instante.
              </p>
              @if($ocasion)
              <div class="inline-flex items-center gap-1.5 text-xs bg-violet-50 text-violet-600 border border-violet-100 rounded-full px-3 py-1 mb-5">
                <span>{{ $ocasion->categoria->emoji }}</span>
                <span class="font-semibold">{{ $ocasion->categoria->nombre }}</span>
                <span class="text-violet-300">·</span>
                <span>{{ count($templates) }} diseños exclusivos</span>
              </div>
              @endif

              <div class="grid grid-cols-2 {{ count($templates) >= 4 ? 'sm:grid-cols-3 lg:grid-cols-2 xl:grid-cols-3' : 'sm:grid-cols-3' }} gap-3 mb-6">
                @foreach($templates as $tpl)
                @php
                  $isDark = !empty($tpl['dark']);
                  $dotClass = $isDark ? 'bg-white/40' : 'bg-gray-800/20';
                @endphp
                <button type="button"
                        @click="templateSeleccionado = '{{ $tpl['id'] }}'; emitirPreview()"
                        :class="templateSeleccionado === '{{ $tpl['id'] }}' ? 'ring-2 ring-violet-500 ring-offset-2 border-violet-400 shadow-lg scale-[1.02]' : 'border-gray-200 hover:border-violet-300 hover:shadow-sm hover:scale-[1.01]'"
                        class="relative rounded-2xl border-2 overflow-hidden transition-all duration-200 cursor-pointer text-left">
                  {{-- Miniatura --}}
                  <div class="bg-gradient-to-br {{ $tpl['bg'] }} h-[4.5rem] relative overflow-hidden">
                    {{-- Barra de color en top --}}
                    <div class="{{ $tpl['bar'] }} absolute top-0 left-0 right-0 h-1.5"></div>
                    {{-- Líneas simuladas de texto --}}
                    <div class="absolute left-2.5 top-4 right-2.5 space-y-1">
                      <div class="{{ $dotClass }} rounded h-1.5 w-3/4"></div>
                      <div class="{{ $dotClass }} rounded h-1 w-1/2"></div>
                      <div class="{{ $dotClass }} rounded h-1 w-2/3"></div>
                    </div>
                    {{-- Emoji decorativo --}}
                    <div class="absolute top-2 right-2 text-lg leading-none">{{ $tpl['emoji'] }}</div>
                    {{-- Check activo --}}
                    <div x-show="templateSeleccionado === '{{ $tpl['id'] }}'"
                         class="absolute bottom-1.5 right-1.5 w-5 h-5 bg-violet-600 rounded-full flex items-center justify-center shadow">
                      <svg class="w-3 h-3 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                      </svg>
                    </div>
                  </div>
                  <div class="px-2.5 py-2 bg-white">
                    <p class="text-xs font-bold text-gray-800 leading-tight truncate">{{ $tpl['nombre'] }}</p>
                    <p class="text-[10px] text-gray-400 truncate">{{ $tpl['desc'] }}</p>
                  </div>
                </button>
                @endforeach
              </div>

              <div class="flex gap-3">
                <button type="button" @click="paso = 1"
                        class="px-5 py-3 border-2 border-gray-200 text-gray-600 font-semibold rounded-full hover:bg-gray-50 transition text-sm">← Atrás</button>
                <button type="button" @click="siguientePaso()"
                        class="flex-1 py-3 bg-violet-600 text-white font-bold rounded-full hover:bg-violet-700 transition shadow text-sm">
                  Continuar → Escribir mensaje
                </button>
              </div>
            </div>

            {{-- PASO 3: Mensaje --}}
            <div x-show="paso === 3" x-cloak class="p-6 sm:p-8">
              <h2 class="font-app-heading text-lg sm:text-xl font-bold text-gray-800 mb-5">✍️ Escribe tu mensaje</h2>

              <div class="grid grid-cols-1 xl:grid-cols-12 gap-5">
                <div class="xl:col-span-7 space-y-5">
                  {{-- Asistente IA: generar / corregir (arriba del editor) --}}
                  <div class="p-4 bg-gradient-to-br from-violet-50 via-fuchsia-50 to-pink-50 rounded-2xl border border-violet-100"
                       x-data
                       @click.outside="aiPanelAbierto = false">
                    <div class="flex items-start justify-between gap-3 flex-wrap">
                      <div class="flex items-center gap-2">
                        <span class="text-xl">✨</span>
                        <div>
                          <p class="text-sm font-semibold text-gray-800">Asistente de redacción</p>
                          <p class="text-xs text-gray-500">Genera un mensaje con IA o corrige tu ortografía.</p>
                        </div>
                      </div>
                      <div class="flex items-center gap-2">
                        <button type="button"
                                @click="aiPanelAbierto = !aiPanelAbierto"
                                :disabled="aiCargando"
                                class="px-3 py-2 bg-violet-600 text-white text-xs font-bold rounded-full hover:bg-violet-700 transition shadow disabled:opacity-50 disabled:cursor-not-allowed inline-flex items-center gap-1.5">
                          <span>✨</span><span>Generar con IA</span>
                        </button>
                        <button type="button"
                                @click="corregirOrtografia()"
                                :disabled="aiCargando"
                                class="px-3 py-2 bg-white border border-violet-200 text-violet-700 text-xs font-bold rounded-full hover:bg-violet-50 transition inline-flex items-center gap-1.5 disabled:opacity-50 disabled:cursor-not-allowed">
                          <template x-if="aiCargando && aiAccion === 'corregir'">
                            <span class="inline-block w-3 h-3 border-2 border-violet-300 border-t-violet-700 rounded-full animate-spin"></span>
                          </template>
                          <template x-if="!(aiCargando && aiAccion === 'corregir')">
                            <span>✏️</span>
                          </template>
                          <span>Corregir ortografía</span>
                        </button>
                      </div>
                    </div>

                    {{-- Panel de generación --}}
                    <div x-show="aiPanelAbierto" x-cloak x-transition.opacity class="mt-4 grid grid-cols-1 sm:grid-cols-2 gap-3">
                      <label class="block">
                        <span class="text-xs font-semibold text-gray-600">Tono del mensaje</span>
                        <select x-model="aiTono"
                                class="mt-1 w-full px-3 py-2 border border-violet-200 rounded-lg bg-white text-sm focus:outline-none focus:ring-2 focus:ring-violet-300">
                          <option value="cálido y sincero">💜 Cálido y sincero</option>
                          <option value="emotivo y profundo">🥺 Emotivo y profundo</option>
                          <option value="alegre y festivo">🎉 Alegre y festivo</option>
                          <option value="romántico">💖 Romántico</option>
                          <option value="divertido y con humor">😄 Divertido</option>
                          <option value="agradecido">🙏 Agradecido</option>
                          <option value="reflexivo y poético">🌸 Poético</option>
                          <option value="corto y directo">⚡ Corto y directo</option>
                        </select>
                      </label>
                      <label class="block">
                        <span class="text-xs font-semibold text-gray-600">Indicaciones extra <span class="text-gray-400 font-normal">(opcional)</span></span>
                        <input type="text" x-model="aiInstrucciones" maxlength="500"
                               placeholder="Ej: menciona nuestro viaje a la playa"
                               class="mt-1 w-full px-3 py-2 border border-violet-200 rounded-lg bg-white text-sm focus:outline-none focus:ring-2 focus:ring-violet-300">
                      </label>
                      <div class="sm:col-span-2 flex items-center justify-between gap-3 flex-wrap">
                        <p class="text-[11px] text-gray-500">
                          <template x-if="!destinatario || !ocasionId">
                            <span class="text-amber-600">⚠️ Completa destinatario y ocasión para mejores resultados.</span>
                          </template>
                          <template x-if="destinatario && ocasionId">
                            <span>Se reemplazará el contenido actual del editor.</span>
                          </template>
                        </p>
                        <button type="button"
                                @click="generarConIA()"
                                :disabled="aiCargando"
                                class="px-4 py-2 bg-gradient-to-r from-violet-600 to-fuchsia-600 text-white text-xs font-bold rounded-full hover:opacity-90 transition shadow inline-flex items-center gap-2 disabled:opacity-50 disabled:cursor-not-allowed">
                          <template x-if="aiCargando && aiAccion === 'generar'">
                            <span class="inline-block w-3 h-3 border-2 border-white/40 border-t-white rounded-full animate-spin"></span>
                          </template>
                          <template x-if="!(aiCargando && aiAccion === 'generar')">
                            <span>✨</span>
                          </template>
                          <span x-text="(aiCargando && aiAccion === 'generar') ? 'Generando...' : 'Generar mensaje'"></span>
                        </button>
                      </div>
                    </div>

                    <template x-if="aiError">
                      <p class="mt-3 text-xs text-red-500" x-text="aiError"></p>
                    </template>
                    <template x-if="aiAviso">
                      <p class="mt-3 text-xs text-emerald-600" x-text="aiAviso"></p>
                    </template>
                  </div>

                  {{-- Editor Rich Text --}}
                  <div class="p-4 bg-white rounded-2xl border border-gray-100 shadow-sm">
                    <div class="flex items-center justify-between mb-1.5">
                      <label class="text-sm font-semibold text-gray-700">Tu mensaje <span class="text-red-400">*</span></label>
                      <span class="text-xs text-gray-400" x-text="mensajeCharCount + ' car.'"></span>
                    </div>
                    {{-- Toolbar --}}
                    <div class="overflow-x-auto -mx-2 px-2 pb-2">
                      <div class="flex items-center gap-1 min-w-max px-2 py-1.5 bg-gray-50 border border-gray-200 rounded-t-xl select-none">
                        <button type="button" @mousedown.prevent="formatear('bold')" title="Negrita (Ctrl+B)"
                                class="min-h-10 min-w-10 flex items-center justify-center rounded-lg font-extrabold text-sm transition"
                                :class="activos.bold ? 'bg-violet-600 text-white shadow-md' : 'bg-white text-gray-700 hover:bg-violet-100'">B</button>
                        <button type="button" @mousedown.prevent="formatear('italic')" title="Cursiva (Ctrl+I)"
                                class="min-h-10 min-w-10 flex items-center justify-center rounded-lg italic text-sm transition"
                                :class="activos.italic ? 'bg-violet-600 text-white shadow-md' : 'bg-white text-gray-700 hover:bg-violet-100'">I</button>
                        <button type="button" @mousedown.prevent="formatear('underline')" title="Subrayado (Ctrl+U)"
                                class="min-h-10 min-w-10 flex items-center justify-center rounded-lg underline text-sm transition"
                                :class="activos.underline ? 'bg-violet-600 text-white shadow-md' : 'bg-white text-gray-700 hover:bg-violet-100'">U</button>
                        <button type="button" @mousedown.prevent="formatear('strikeThrough')" title="Tachado"
                                class="min-h-10 min-w-10 flex items-center justify-center rounded-lg line-through text-sm transition"
                                :class="activos.strikeThrough ? 'bg-violet-600 text-white shadow-md' : 'bg-white text-gray-700 hover:bg-violet-100'">S</button>
                        <div class="w-px h-5 bg-gray-200 mx-0.5"></div>
                        <label class="min-h-10 min-w-10 flex items-center justify-center rounded-lg cursor-pointer transition hover:bg-violet-100 relative" title="Color de texto">
                          <span class="text-sm font-bold relative" :style="'color:' + colorTexto">A
                            <span class="absolute -bottom-0.5 left-0 right-0 h-0.5 rounded-full" :style="'background:' + colorTexto"></span>
                          </span>
                          <input type="color" class="absolute inset-0 opacity-0 cursor-pointer w-full h-full" x-model="colorTexto" @change="formatear('foreColor', $event.target.value)">
                        </label>
                        <label class="min-h-10 min-w-10 flex items-center justify-center rounded-lg cursor-pointer transition hover:bg-violet-100 relative" title="Resaltar">
                          <span class="text-[11px] font-bold px-0.5 rounded" :style="'background:'+colorResaltado+';color:#333'">M</span>
                          <input type="color" class="absolute inset-0 opacity-0 cursor-pointer w-full h-full" x-model="colorResaltado" @change="formatear('hiliteColor', $event.target.value)">
                        </label>
                        <div class="hidden sm:flex items-center gap-1">
                          <div class="w-px h-5 bg-gray-200 mx-0.5"></div>
                          <button type="button" @mousedown.prevent="formatear('justifyLeft')" title="Izquierda"
                                  class="min-h-10 min-w-10 flex items-center justify-center rounded-lg text-gray-600 transition hover:bg-violet-100">
                            <svg viewBox="0 0 16 16" class="w-3.5 h-3.5" fill="currentColor"><rect x="1" y="2" width="14" height="1.5" rx=".5"/><rect x="1" y="6" width="9" height="1.5" rx=".5"/><rect x="1" y="10" width="12" height="1.5" rx=".5"/><rect x="1" y="14" width="7" height="1.5" rx=".5"/></svg>
                          </button>
                          <button type="button" @mousedown.prevent="formatear('justifyCenter')" title="Centrar"
                                  class="min-h-10 min-w-10 flex items-center justify-center rounded-lg text-gray-600 transition hover:bg-violet-100">
                            <svg viewBox="0 0 16 16" class="w-3.5 h-3.5" fill="currentColor"><rect x="1" y="2" width="14" height="1.5" rx=".5"/><rect x="3.5" y="6" width="9" height="1.5" rx=".5"/><rect x="2" y="10" width="12" height="1.5" rx=".5"/><rect x="4" y="14" width="8" height="1.5" rx=".5"/></svg>
                          </button>
                          <button type="button" @mousedown.prevent="formatear('justifyRight')" title="Derecha"
                                  class="min-h-10 min-w-10 flex items-center justify-center rounded-lg text-gray-600 transition hover:bg-violet-100">
                            <svg viewBox="0 0 16 16" class="w-3.5 h-3.5" fill="currentColor"><rect x="1" y="2" width="14" height="1.5" rx=".5"/><rect x="6" y="6" width="9" height="1.5" rx=".5"/><rect x="3" y="10" width="12" height="1.5" rx=".5"/><rect x="8" y="14" width="7" height="1.5" rx=".5"/></svg>
                          </button>
                        </div>
                        <div class="w-px h-5 bg-gray-200 mx-0.5"></div>
                        <button type="button" @mousedown.prevent="formatear('removeFormat')" title="Quitar formato"
                                class="min-h-10 min-w-10 flex items-center justify-center rounded-lg text-gray-500 transition hover:bg-red-100 hover:text-red-500">
                          <svg viewBox="0 0 20 20" class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"><path d="M3 17h6m1-8l4-4M5 15l10-10M8 17l9-9"/></svg>
                        </button>
                      </div>
                    </div>
                    <div id="mensaje-editor" contenteditable="true"
                         @input="sincronizarMensaje()" @keyup="actualizarActivos(); guardarSeleccionEditor()" @mouseup="actualizarActivos(); guardarSeleccionEditor()" @blur="guardarSeleccionEditor()"
                         @keydown.ctrl.b.prevent="formatear('bold')" @keydown.ctrl.i.prevent="formatear('italic')" @keydown.ctrl.u.prevent="formatear('underline')"
                         class="min-h-32 sm:min-h-40 w-full px-3 sm:px-4 py-2.5 sm:py-3 border border-t-0 border-gray-200 rounded-b-xl focus:outline-none focus:ring-2 focus:ring-violet-400 text-gray-700 leading-relaxed bg-white"
                         style="font-family:'Nunito',sans-serif;font-size:1rem;"
                         data-placeholder="Escribe aquí las palabras que vienen de tu corazón..."></div>
                    {{-- Helpers: Emojis & Stickers (debajo del editor para evitar recortes y dar aire visual) --}}
                    <div class="mt-3 flex flex-wrap items-center gap-2">
                      <span class="text-xs font-semibold text-gray-400 mr-1 hidden sm:inline">Agregar:</span>
                      <div class="relative" @click.outside="emojiPanelAbierto = false">
                        <button type="button"
                                @mousedown.prevent="guardarSeleccionEditor(); emojiPanelAbierto = !emojiPanelAbierto; stickerPanelAbierto = false"
                                class="inline-flex items-center gap-2 px-3.5 py-2 rounded-full border border-violet-200 bg-white text-violet-700 text-sm font-semibold shadow-sm hover:bg-violet-50 hover:border-violet-300 active:scale-95 transition">
                          <span class="text-base leading-none">😊</span><span>Emojis</span>
                        </button>
                        <div x-show="emojiPanelAbierto" x-cloak x-transition.opacity.duration.150ms
                             class="absolute left-0 bottom-full mb-2 z-30 w-[320px] max-w-[85vw] rounded-2xl border border-violet-100 bg-white shadow-2xl p-2">
                          <emoji-picker x-ref="crearEmojiPicker" class="light app-emoji-picker" locale="es"></emoji-picker>
                        </div>
                      </div>
                      <div class="relative" @click.outside="stickerPanelAbierto = false">
                        <button type="button"
                                @mousedown.prevent="guardarSeleccionEditor(); stickerPanelAbierto = !stickerPanelAbierto; emojiPanelAbierto = false"
                                class="inline-flex items-center gap-2 px-3.5 py-2 rounded-full border border-pink-200 bg-white text-pink-700 text-sm font-semibold shadow-sm hover:bg-pink-50 hover:border-pink-300 active:scale-95 transition">
                          <span class="text-base leading-none">🎀</span><span>Stickers</span>
                        </button>
                        <div x-show="stickerPanelAbierto" x-cloak x-transition.opacity.duration.150ms
                             class="absolute left-0 bottom-full mb-2 z-30 w-72 max-w-[85vw] rounded-2xl border border-pink-100 bg-white shadow-2xl p-3">
                          <p class="text-xs font-semibold text-gray-500 mb-2">Toca uno para insertarlo</p>
                          <div class="grid grid-cols-4 gap-2">
                            @foreach(['💖','✨','🌸','🎀','🦋','🥰','💐','🌷','💘','⭐','💕','🤍'] as $sticker)
                              <button type="button"
                                      @mousedown.prevent="insertarSticker('{{ $sticker }}')"
                                      class="h-11 rounded-xl border border-pink-100 bg-pink-50 hover:bg-pink-100 text-2xl transition">{{ $sticker }}</button>
                            @endforeach
                          </div>
                        </div>
                      </div>
                    </div>
                    @error('mensaje')<p class="text-red-500 text-xs mt-2">{{ $message }}</p>@enderror
                  </div>

                  {{-- Foto especial --}}
                  <div class="p-4 bg-violet-50 rounded-2xl border border-violet-100">
                <p class="text-sm font-semibold text-gray-700 mb-3">🖼️ Foto especial <span class="text-gray-400 font-normal">(opcional)</span></p>
                <div class="flex flex-col xl:flex-row gap-4">
                  <div class="flex flex-col items-center gap-2 flex-shrink-0">
                    <div :style="getMarcoStyle()" class="transition-all duration-300">
                      <div class="w-20 h-20 sm:w-24 sm:h-24 overflow-hidden transition-all duration-300" :style="getFormaStyle()">
                        <template x-if="imagenPreview">
                          <img :src="imagenPreview" class="w-full h-full object-contain bg-white" alt="">
                        </template>
                        <template x-if="!imagenPreview">
                          <div class="w-full h-full bg-violet-100 flex items-center justify-center text-3xl rounded-lg">🖼️</div>
                        </template>
                      </div>
                    </div>
                    <label class="cursor-pointer px-3 py-1.5 bg-violet-600 text-white text-xs font-bold rounded-full hover:bg-violet-700 transition">
                      <span x-text="imagenPreview ? '📸 Cambiar' : '📸 Subir foto'"></span>
                      <input type="file" name="imagen" accept="image/jpeg,image/png,image/webp,image/gif" class="hidden" @change="seleccionarImagen($event)">
                    </label>
                    <button type="button" x-show="imagenPreview" @click="quitarImagen()" class="text-xs text-red-400 hover:text-red-600 transition">✕ Quitar</button>
                  </div>
                  <div class="flex-1 space-y-3 min-w-0">
                    <div>
                      <p class="text-xs font-semibold text-gray-600 mb-1.5">Forma:</p>
                      <div class="grid grid-cols-4 sm:grid-cols-7 gap-1">
                        @foreach([['ninguna','▭','Normal'],['cuadrado','▢','Cuad.'],['circulo','◯','Círculo'],['corazon','♥','Corazón'],['estrella','★','Estrella'],['hexagono','⬡','Hex'],['diamante','◇','Diam.']] as [$v,$ic,$lb])
                        <button type="button" @click="imagenForma='{{ $v }}'; emitirPreview()"
                                :class="imagenForma==='{{ $v }}' ? 'bg-violet-600 text-white border-violet-600' : 'bg-white text-gray-600 border-gray-200 hover:border-violet-300'"
                                class="flex flex-col items-center gap-0.5 px-1.5 py-1 rounded-lg border-2 transition-all" title="{{ $lb }}">
                          <span class="text-base sm:text-lg leading-tight">{{ $ic }}</span>
                          <span class="text-[10px] sm:text-[11px]">{{ $lb }}</span>
                        </button>
                        @endforeach
                      </div>
                    </div>
                    <div>
                      <p class="text-xs font-semibold text-gray-600 mb-1.5">Marco / Efecto:</p>
                      <div class="grid grid-cols-4 sm:grid-cols-7 gap-1">
                        @foreach([['ninguno','#e5e7eb','Ninguno'],['morado','#7C3AED','Morado'],['dorado','#F59E0B','Dorado'],['rosa','#F472B6','Rosa'],['verde','#10B981','Verde'],['sombra','#374151','Sombra'],['blanco','#ffffff','Brillo']] as [$v,$c,$lb])
                        <button type="button" @click="imagenMarco='{{ $v }}'; emitirPreview()"
                                :class="imagenMarco==='{{ $v }}' ? 'ring-2 ring-offset-1 ring-violet-500 scale-110' : 'hover:scale-110'"
                                class="flex flex-col items-center gap-0.5 transition-all" title="{{ $lb }}">
                          <div class="w-5 h-5 rounded-full border border-gray-300 shadow-sm" style="background:{{ $c }}"></div>
                          <span class="text-[9px] text-gray-500">{{ $lb }}</span>
                        </button>
                        @endforeach
                      </div>
                    </div>
                  </div>
                </div>
                  </div>
                </div>

                <div class="xl:col-span-5 space-y-5">
                  {{-- 🦄 Personaje del mensaje --}}
                  <div class="p-4 bg-pink-50 rounded-2xl border border-pink-100" x-data="{ origen: '{{ old('personaje_origen','tema') }}', estilo: '{{ old('personaje_estilo','adventurer') }}', preview: null }">
                <p class="text-sm font-semibold text-gray-700 mb-3">🦄 Personaje decorativo <span class="text-gray-400 font-normal">(opcional)</span></p>

                <input type="hidden" name="personaje_origen" :value="origen">
                <input type="hidden" name="personaje_estilo" :value="estilo">

                <div class="grid grid-cols-2 sm:grid-cols-4 gap-1.5 mb-3">
                  <button type="button" @click="origen='tema'"
                          :class="origen==='tema' ? 'ring-2 ring-pink-500 bg-white' : 'bg-white/60 hover:bg-white'"
                          class="p-2 rounded-xl border border-pink-200 text-xs font-semibold text-gray-700 transition">
                    🎨 Del tema
                  </button>
                  <button type="button" @click="origen='dicebear'"
                          :class="origen==='dicebear' ? 'ring-2 ring-pink-500 bg-white' : 'bg-white/60 hover:bg-white'"
                          class="p-2 rounded-xl border border-pink-200 text-xs font-semibold text-gray-700 transition">
                    🤖 Generado
                  </button>
                  <button type="button" @click="origen='custom'"
                          :class="origen==='custom' ? 'ring-2 ring-pink-500 bg-white' : 'bg-white/60 hover:bg-white'"
                          class="p-2 rounded-xl border border-pink-200 text-xs font-semibold text-gray-700 transition">
                    📤 Mi imagen
                  </button>
                  <button type="button" @click="origen='ninguno'"
                          :class="origen==='ninguno' ? 'ring-2 ring-pink-500 bg-white' : 'bg-white/60 hover:bg-white'"
                          class="p-2 rounded-xl border border-pink-200 text-xs font-semibold text-gray-700 transition">
                    🚫 Ninguno
                  </button>
                </div>

                {{-- Modo dicebear: selector de estilo --}}
                <div x-show="origen==='dicebear'" x-transition class="space-y-2">
                  <p class="text-xs text-gray-500">Elige un estilo de avatar (gratuito, libre uso comercial):</p>
                  <div class="grid grid-cols-3 sm:grid-cols-5 gap-2">
                    @foreach(['adventurer'=>'Aventurero','big-smile'=>'Sonrisa','lorelei'=>'Lorelei','micah'=>'Micah','notionists'=>'Notion','fun-emoji'=>'Emoji','miniavs'=>'Mini','pixel-art'=>'Pixel','croodles'=>'Croodle','bottts'=>'Robot'] as $k => $lb)
                      <button type="button" @click="estilo='{{ $k }}'"
                              :class="estilo==='{{ $k }}' ? 'ring-2 ring-pink-500' : ''"
                              class="bg-white rounded-lg p-1 border border-pink-100 hover:border-pink-300 transition flex flex-col items-center">
                        <img src="https://api.dicebear.com/9.x/{{ $k }}/svg?seed={{ urlencode(old('destinatario','peque')) }}&size=80&radius=50" alt="" class="w-10 h-10">
                        <span class="text-[10px] text-gray-600">{{ $lb }}</span>
                      </button>
                    @endforeach
                  </div>
                </div>

                {{-- Modo custom: upload --}}
                <div x-show="origen==='custom'" x-transition>
                  <label class="cursor-pointer block bg-white border-2 border-dashed border-pink-300 rounded-xl p-4 text-center hover:bg-pink-50 transition">
                    <template x-if="preview">
                      <img :src="preview" class="mx-auto w-20 h-20 object-contain rounded-lg mb-2">
                    </template>
                    <template x-if="!preview">
                      <div class="text-3xl mb-1">📤</div>
                    </template>
                    <span class="text-xs font-semibold text-pink-600" x-text="preview ? 'Cambiar imagen' : 'Subir personaje (PNG/JPG)'"></span>
                    <input type="file" name="personaje_imagen" accept="image/png,image/jpeg,image/webp,image/gif" class="hidden"
                           @change="const f=$event.target.files[0]; if(f){ const r=new FileReader(); r.onload=e=>preview=e.target.result; r.readAsDataURL(f); }">
                  </label>
                  <p class="text-[11px] text-gray-400 mt-1 text-center">⚠️ Solo sube imágenes propias o libres de derechos. Tú eres responsable del contenido.</p>
                </div>
                  </div>

                  {{-- Música (buscador estilo stories) --}}
                  <div class="p-4 bg-indigo-50/60 rounded-2xl border border-indigo-100">
                    <p class="text-sm font-semibold text-gray-700 mb-3">🎵 Música <span class="text-gray-400 font-normal">(opcional)</span></p>
                    @include('mensajes.partials.music-picker', [
                      'ocasionId' => old('ocasion_id', $ocasion?->id),
                      'mensajeTexto' => old('mensaje', ''),
                    ])
                  </div>
                </div>
              </div>

              <div class="flex gap-3 mt-6">
                <button type="button" @click="paso = 2"
                        class="px-5 py-3 border-2 border-gray-200 text-gray-600 font-semibold rounded-full hover:bg-gray-50 transition text-sm">← Atrás</button>
                <button type="button" @click="siguientePaso()"
                        class="flex-1 py-3 bg-violet-600 text-white font-bold rounded-full hover:bg-violet-700 transition shadow text-sm">
                  Continuar → Revisar
                </button>
              </div>
            </div>

            {{-- PASO 4: Revisar y pagar --}}
            <div x-show="paso === 4" x-cloak class="p-6 sm:p-8">
              <h2 class="font-app-heading text-lg sm:text-xl font-bold text-gray-800 mb-4">✅ Revisa y confirma</h2>

              <div class="space-y-5 mb-6">
                <div class="p-4 bg-gray-50 rounded-2xl border border-gray-100">
                  <p class="text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">👤 Destinatario</p>
                  <div class="space-y-1.5">
                    <div class="flex items-center justify-between px-3 py-2.5 sm:px-4 sm:py-3 bg-white rounded-xl text-xs sm:text-sm border border-gray-100">
                      <span class="text-gray-500">Para:</span>
                      <span class="font-bold text-gray-800" x-text="destinatario || '—'"></span>
                    </div>
                    <div class="flex items-center justify-between px-3 py-2.5 sm:px-4 sm:py-3 bg-white rounded-xl text-xs sm:text-sm border border-gray-100">
                      <span class="text-gray-500">De:</span>
                      <span class="font-bold text-gray-800" x-text="remitente || '—'"></span>
                    </div>
                  </div>
                </div>

                <div class="p-4 bg-gray-50 rounded-2xl border border-gray-100">
                  <p class="text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">🎨 Diseño</p>
                  <div class="space-y-1.5">
                    <div class="flex items-center justify-between px-3 py-2.5 sm:px-4 sm:py-3 bg-white rounded-xl text-xs sm:text-sm border border-gray-100">
                      <span class="text-gray-500">Plantilla:</span>
                      <span class="font-bold text-gray-800 capitalize" x-text="templateSeleccionado.replace('-',' ')"></span>
                    </div>
                    <div x-show="imagenPreview" class="flex items-center justify-between px-3 py-2.5 sm:px-4 sm:py-3 bg-white rounded-xl text-xs sm:text-sm border border-gray-100">
                      <span class="text-gray-500">Foto:</span>
                      <span class="text-emerald-600 font-bold">✅ Incluida</span>
                    </div>
                  </div>
                </div>

                <div class="bg-gradient-to-r from-violet-600 to-indigo-600 text-white rounded-2xl p-5 text-center shadow-lg shadow-violet-200">
                  <p class="text-violet-200 text-xs mb-1">Precio único · Pago seguro</p>
                  <p class="text-4xl font-extrabold">$50 <span class="text-xl">MXN</span></p>
                  <div class="mt-3 grid grid-cols-2 sm:flex sm:flex-wrap sm:justify-center gap-2 sm:gap-4 text-xs text-violet-200">
                    <span>✅ Link único</span><span>✅ Diseño especial</span><span>✅ Para siempre</span>
                  </div>
                </div>
              </div>

              <div class="flex flex-col-reverse sm:flex-row gap-3 w-full">
                <button type="button" @click="paso = 3"
                        class="w-full sm:w-auto px-5 py-3 border-2 border-gray-200 text-gray-600 font-semibold rounded-full hover:bg-gray-50 transition text-sm">← Editar</button>
                <button type="submit"
                        class="w-full sm:flex-1 py-3 bg-gradient-to-r from-violet-600 to-pink-500 text-white font-extrabold rounded-full hover:opacity-90 active:scale-95 transition-all shadow-lg">
                  💳 Pagar y enviar →
                </button>
              </div>
              <p class="text-center text-xs text-gray-400 mt-2">🔒 Pago seguro con Stripe · No guardamos datos de tarjeta</p>
            </div>
          </form>
        </div>
      </div>{{-- /col izquierda --}}

      {{-- ===== COLUMNA DERECHA: LIVE PREVIEW (derecha en desktop, abajo en móvil) ===== --}}
      <div class="flex flex-col lg:sticky lg:top-6 min-w-0 lg:max-h-[calc(100vh-3rem)]">
        <div class="bg-white rounded-3xl shadow-lg border border-gray-100 overflow-hidden flex flex-col flex-1 min-h-[440px]">
          {{-- Barra de título estilo browser --}}
          <div class="flex items-center gap-2 px-4 py-3 bg-gray-50 border-b border-gray-100 shrink-0">
            <div class="flex gap-1.5">
              <div class="w-3 h-3 rounded-full bg-red-400/80"></div>
              <div class="w-3 h-3 rounded-full bg-yellow-400/80"></div>
              <div class="w-3 h-3 rounded-full bg-green-400/80"></div>
            </div>
            <div class="flex-1 mx-3 bg-gray-100 rounded-full px-3 py-1 text-xs text-gray-400 text-center">mensajes.para/tu-mensaje</div>
            <div class="flex items-center gap-1">
              <div class="w-1.5 h-1.5 rounded-full bg-green-400 animate-pulse"></div>
              <span class="text-[10px] text-gray-400 font-medium">EN VIVO</span>
            </div>
          </div>
          {{-- Área preview --}}
          <div class="bg-gray-100 overflow-hidden flex-1">
            <div id="live-preview-desktop" class="w-full h-full overflow-auto">
              <div class="flex flex-col items-center justify-center h-full text-center p-10">
                <div class="w-16 h-16 rounded-2xl bg-violet-50 flex items-center justify-center text-3xl mb-4">💌</div>
                <p class="font-semibold text-gray-400 text-sm">La vista previa aparecerá aquí</p>
                <p class="text-xs text-gray-300 mt-1">Comienza escribiendo o eligiendo un diseño</p>
              </div>
            </div>
          </div>
        </div>
        <p class="text-center text-xs text-gray-400 mt-2">
          Diseño: <span class="font-semibold text-violet-600 capitalize" x-text="templateSeleccionado.replace(/-/g,' ')"></span>
        </p>
      </div>{{-- /col derecha --}}

    </div>{{-- /grid --}}
  </div>

</div>{{-- /x-data --}}

<style>
  #mensaje-editor:empty::before { content: attr(data-placeholder); color: #9ca3af; pointer-events: none; }
  .app-emoji-picker {
    width: 100%;
    height: 360px;
    --border-size: 0;
    --border-radius: 1rem;
    --indicator-color: #8b5cf6;
    --input-border-radius: 0.75rem;
  }
  @keyframes preview-vinyl-spin {
    from { transform: rotate(0deg); }
    to { transform: rotate(360deg); }
  }
</style>
@endsection

@push('scripts')
<script>
function crearMensaje() {
    // Configs de preview inyectadas desde PHP (todos los templates)
    const PREVIEW_CONFIGS = @json($previewConfigs);
    // Arte SVG decorativo único por template (premium look)
    const PREVIEW_ARTE    = @json($previewArte);

    return {
        paso: 1,
        destinatario: '{{ old('destinatario') }}',
        remitente: '{{ old('remitente', Auth::user()->name ?? '') }}',
        mensajeHTML: '{{ old('mensaje') }}',
        mensajeCharCount: 0,
        ocasionId: '{{ old('ocasion_id', $ocasion?->id) }}',
        crearBaseUrl: @json(route('mensajes.crear')),
        borradorKey: 'crear-mensaje-borrador-v1',
        templateSeleccionado: '{{ old('template', $templateDefault) }}',
        imagenForma: '{{ old('imagen_forma', 'circulo') }}',
        imagenMarco: '{{ old('imagen_marco', 'ninguno') }}',
        imagenPreview: null,
        colorTexto: '#000000',
        colorResaltado: '#FFFF00',
        activos: { bold: false, italic: false, underline: false, strikeThrough: false },
        emojiPanelAbierto: false,
        stickerPanelAbierto: false,
        rangoMensaje: null,
        // Estado del asistente IA
        aiPanelAbierto: false,
        aiTono: 'cálido y sincero',
        aiInstrucciones: '',
        aiCargando: false,
        aiAccion: null,
        aiError: '',
        aiAviso: '',
        musicPreview: {
          hasAudio: false,
          titulo: 'Música',
          artista: '',
          thumb: '',
          displayMode: 'cover',
          lyrics: '',
          posX: {{ (int) old('audio_pos_x', 24) }},
          posY: {{ (int) old('audio_pos_y', 24) }},
          scale: {{ (int) old('audio_scale', 100) }},
          showGuide: true,
          snapGuide: true,
        },
        previewMobilAbierto: false,
        debounceTimer: null,

        init() {
          this.restaurarBorradorTemporal();

            window.addEventListener('template-changed', (e) => {
                this.templateSeleccionado = e.detail;
                this.emitirPreview();
            });

            window.addEventListener('music-preview-update', (e) => {
              this.musicPreview = {
                ...this.musicPreview,
                ...e.detail,
                posX: Math.max(5, Math.min(95, Math.round(Number(e.detail?.posX ?? this.musicPreview.posX)))),
                posY: Math.max(5, Math.min(95, Math.round(Number(e.detail?.posY ?? this.musicPreview.posY)))),
                scale: Math.max(70, Math.min(180, Math.round(Number(e.detail?.scale ?? this.musicPreview.scale ?? 100)))),
              };
              this.emitirPreview();
            });

            // Si hay mensaje previo, renderizar preview inicial
            if (this.mensajeHTML || this.destinatario || this.musicPreview.hasAudio) {
                this.$nextTick(() => {
                  const editor = document.getElementById('mensaje-editor');
                  if (editor && this.mensajeHTML && !editor.innerHTML.trim()) {
                    editor.innerHTML = this.mensajeHTML;
                    this.mensajeCharCount = editor.innerText.replace(/\n/g, '').length;
                  }
                  this.inicializarEmojiPicker();
                  this.emitirPreview();
                });
            } else {
                this.$nextTick(() => this.inicializarEmojiPicker());
            }
        },

        siguientePaso() {
            if (this.paso === 1) {
                if (!this.destinatario.trim() || !this.remitente.trim()) {
                    alert('Por favor completa el nombre del destinatario y tu nombre.');
                    return;
                }
                @if(!$ocasion) if (!this.ocasionId) { alert('Selecciona una ocasión.'); return; } @endif
            }
            if (this.paso === 3) {
                const editor = document.getElementById('mensaje-editor');
                if (!editor || !editor.innerText.trim()) {
                    alert('Por favor escribe tu mensaje.');
                    return;
                }
                this.sincronizarMensaje();
            }
            this.paso++;
            this.$nextTick(() => window.scrollTo({ top: 0, behavior: 'smooth' }));
        },

          cambiarOcasion(event) {
            const selected = event?.target?.selectedOptions?.[0];
            const slug = selected?.dataset?.slug;
            const id = event?.target?.value || '';
            this.ocasionId = id;

            if (!id || !slug) return;

            this.guardarBorradorTemporal();

            const url = new URL(this.crearBaseUrl, window.location.origin);
            url.searchParams.set('ocasion', slug);
            window.location.href = url.toString();
          },

        guardarBorradorTemporal() {
            const editor = document.getElementById('mensaje-editor');
            const html = editor?.innerHTML || this.mensajeHTML || '';
            const borrador = {
              destinatario: this.destinatario || '',
              remitente: this.remitente || '',
              mensajeHTML: html,
            };
            try {
              sessionStorage.setItem(this.borradorKey, JSON.stringify(borrador));
            } catch (_) {}
        },

        restaurarBorradorTemporal() {
            try {
              const raw = sessionStorage.getItem(this.borradorKey);
              if (!raw) return;
              const data = JSON.parse(raw);
              if (!this.destinatario && data?.destinatario) this.destinatario = data.destinatario;
              if (!this.remitente && data?.remitente) this.remitente = data.remitente;
              if (!this.mensajeHTML && data?.mensajeHTML) this.mensajeHTML = data.mensajeHTML;
              sessionStorage.removeItem(this.borradorKey);
            } catch (_) {}
        },

        sincronizarMensaje() {
            const el = document.getElementById('mensaje-editor');
            if (el) {
                this.mensajeHTML = el.innerHTML;
                this.mensajeCharCount = el.innerText.replace(/\n/g, '').length;
                this.emitirPreview();
            }
        },

        actualizarActivos() {
            this.activos.bold          = document.queryCommandState('bold');
            this.activos.italic        = document.queryCommandState('italic');
            this.activos.underline     = document.queryCommandState('underline');
            this.activos.strikeThrough = document.queryCommandState('strikeThrough');
        },

        formatear(cmd, valor) {
            document.execCommand(cmd, false, valor || null);
            const el = document.getElementById('mensaje-editor');
            if (el) el.focus();
            this.sincronizarMensaje();
            this.actualizarActivos();
          this.guardarSeleccionEditor();
        },

        inicializarEmojiPicker() {
          const picker = this.$refs.crearEmojiPicker;
          if (!picker || picker.dataset.bound === '1') return;
          picker.dataset.bound = '1';
          picker.addEventListener('emoji-click', (event) => {
            this.insertarEmoji(event.detail?.unicode || '');
          });
        },

        guardarSeleccionEditor() {
          const sel = window.getSelection();
          const editor = document.getElementById('mensaje-editor');
          if (!sel || !sel.rangeCount || !editor) return;
          const range = sel.getRangeAt(0);
          if (!editor.contains(range.commonAncestorContainer)) return;
          this.rangoMensaje = range.cloneRange();
        },

        restaurarSeleccionEditor() {
          const sel = window.getSelection();
          const editor = document.getElementById('mensaje-editor');
          if (!sel || !editor) return;

          if (this.rangoMensaje) {
            sel.removeAllRanges();
            sel.addRange(this.rangoMensaje);
            return;
          }

          const range = document.createRange();
          range.selectNodeContents(editor);
          range.collapse(false);
          sel.removeAllRanges();
          sel.addRange(range);
          this.rangoMensaje = range.cloneRange();
        },

        insertarEmoji(emoji) {
          if (!emoji) return;
          this.insertarTextoEnEditor(emoji);
          this.emojiPanelAbierto = false;
        },

        insertarSticker(sticker) {
          if (!sticker) return;
          this.insertarTextoEnEditor(` ${sticker} `);
          this.stickerPanelAbierto = false;
        },

        insertarTextoEnEditor(texto) {
          const editor = document.getElementById('mensaje-editor');
          if (!editor) return;

          editor.focus();
          this.restaurarSeleccionEditor();

          const sel = window.getSelection();
          if (sel && sel.rangeCount) {
            const range = sel.getRangeAt(0);
            range.deleteContents();
            const node = document.createTextNode(texto);
            range.insertNode(node);
            range.setStartAfter(node);
            range.collapse(true);
            sel.removeAllRanges();
            sel.addRange(range);
            this.rangoMensaje = range.cloneRange();
          } else {
            document.execCommand('insertText', false, texto);
          }

          this.sincronizarMensaje();
        },

        // ─── Asistente IA (OpenRouter) ──────────────────────────────────
        obtenerCsrf() {
            const inp = document.querySelector('input[name="_token"]');
            return inp ? inp.value : '';
        },

        textoPlanoEditor() {
            const el = document.getElementById('mensaje-editor');
            return el ? (el.innerText || '').trim() : '';
        },

        textoAHtml(txt) {
            const escape = (s) => String(s)
                .replace(/&/g, '&amp;')
                .replace(/</g, '&lt;')
                .replace(/>/g, '&gt;');
            return escape(txt)
                .split(/\n{2,}/)
                .map(p => '<p>' + p.replace(/\n/g, '<br>') + '</p>')
                .join('');
        },

        async llamarIA(url, payload) {
            const res = await fetch(url, {
                method: 'POST',
                credentials: 'same-origin',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': this.obtenerCsrf(),
                    'X-Requested-With': 'XMLHttpRequest',
                },
                body: JSON.stringify(payload),
            });
            const data = await res.json().catch(() => ({}));
            if (!res.ok) {
                throw new Error(data?.error || data?.message || 'Error de la IA (' + res.status + ')');
            }
            return data;
        },

        async generarConIA() {
            if (this.aiCargando) return;
            this.aiError = '';
            this.aiAviso = '';

            if (!this.destinatario.trim()) {
                this.aiError = 'Escribe el nombre del destinatario primero.';
                return;
            }
            const ocSlug = this.obtenerOcasionSlug();
            if (!this.ocasionId && !ocSlug) {
                this.aiError = 'Selecciona una ocasión primero.';
                return;
            }

            this.aiCargando = true;
            this.aiAccion = 'generar';
            try {
                const data = await this.llamarIA('{{ route('ia.generar') }}', {
                    ocasion_id: this.ocasionId || null,
                    ocasion_slug: ocSlug || null,
                    destinatario: this.destinatario,
                    remitente: this.remitente,
                    tono: this.aiTono,
                    instrucciones: this.aiInstrucciones,
                });
                const texto = (data?.mensaje || '').trim();
                if (!texto) throw new Error('La IA no devolvió texto.');
                this.aplicarTextoAlEditor(texto);
                this.aiAviso = '✨ Mensaje generado. Revísalo y edítalo a tu gusto.';
                this.aiPanelAbierto = false;
            } catch (e) {
                this.aiError = e.message || 'No se pudo generar el mensaje.';
            } finally {
                this.aiCargando = false;
                this.aiAccion = null;
            }
        },

        async corregirOrtografia() {
            if (this.aiCargando) return;
            this.aiError = '';
            this.aiAviso = '';
            const texto = this.textoPlanoEditor();
            if (!texto) {
                this.aiError = 'Escribe algo en el mensaje antes de corregir.';
                return;
            }
            this.aiCargando = true;
            this.aiAccion = 'corregir';
            try {
                const data = await this.llamarIA('{{ route('ia.corregir') }}', { texto });
                const corregido = (data?.mensaje || '').trim();
                if (!corregido) throw new Error('La IA no devolvió texto corregido.');
                this.aplicarTextoAlEditor(corregido);
                this.aiAviso = '✏️ Ortografía y redacción mejoradas.';
            } catch (e) {
                this.aiError = e.message || 'No se pudo corregir el texto.';
            } finally {
                this.aiCargando = false;
                this.aiAccion = null;
            }
        },

        aplicarTextoAlEditor(texto) {
            const html = this.textoAHtml(texto);
            const el = document.getElementById('mensaje-editor');
            if (el) {
                el.innerHTML = html;
                el.focus();
            }
            this.sincronizarMensaje();
        },

        obtenerOcasionSlug() {
            const sel = document.querySelector('select[name="ocasion_id"]');
            if (sel && sel.selectedOptions && sel.selectedOptions[0]) {
                return sel.selectedOptions[0].dataset.slug || '';
            }
            // Tomar de la URL si la ocasión vino preset
            try {
                const u = new URL(window.location.href);
                return u.searchParams.get('ocasion') || '';
            } catch (_) { return ''; }
        },

        emitirPreview() {
            clearTimeout(this.debounceTimer);
            this.debounceTimer = setTimeout(() => this.renderPreviewInline(), 120);
        },

        renderPreviewInline() {
            const html = this.buildPreviewHTML();
            ['live-preview-desktop', 'live-preview-mobile'].forEach(id => {
                const el = document.getElementById(id);
            if (el) {
              el.innerHTML = html;
              this.bindPreviewMusicDrag(el);
            }
            });
        },

        buildPreviewHTML() {
            const ef = this.getFormaStyleRaw();
            const em = this.getMarcoStyleRaw();
            const imgHtml = this.imagenPreview
              ? `<div style="display:flex;justify-content:center;margin:12px 0;"><div style="${em}"><div style="width:80px;height:80px;overflow:hidden;${ef}"><img src="${this.imagenPreview}" style="width:100%;height:100%;object-fit:contain;background:#fff;" alt=""></div></div></div>`
                : '';

            const t = this.templateSeleccionado;
            // Helper truncado para nombres largos
            const trunc = (s, n) => {
                if (!s) return s;
                const txt = String(s);
                return txt.length > n ? txt.slice(0, n).trim() + '…' : txt;
            };
            const destRaw = (this.destinatario || '').trim();
            const remRaw  = (this.remitente   || '').trim();
            const dest = destRaw
                ? this.escapeHTML(trunc(destRaw, 22))
                : '<span style="color:#9ca3af">Nombre del destinatario</span>';
            const rem  = remRaw ? this.escapeHTML(trunc(remRaw, 28)) : 'Tu nombre';
            const msg  = this.mensajeHTML || '<span style="color:#9ca3af">Tu mensaje aparecerá aquí...</span>';
            const inicial = (remRaw || 'A').charAt(0).toUpperCase();

            // Usar configs inyectadas por PHP (cubre todos los templates de todas las categorías)
            const fallback = { wrap:'background:#F8F6FF;', card:'background:white;border-radius:1.5rem;border:1px solid #ede9fe;box-shadow:0 20px 40px rgba(0,0,0,0.08);overflow:hidden;', bar:'background:linear-gradient(90deg,#7C3AED,#EC4899);height:4px;', bc:'', tc:'#1f2937', ac:'#7C3AED', bg:'#F5F3FF', tx:'#374151', fc:'#7C3AED', deco:'💜' };
            const c = PREVIEW_CONFIGS[t] || fallback;
            const arte = PREVIEW_ARTE[t] || '';

            const msgBg = c.bg && c.bg !== 'transparent' && c.bg !== ''
                ? `background:${c.bg};border-radius:0.75rem;padding:0.875rem;margin-bottom:0.75rem;`
                : 'margin-bottom:0.75rem;';
            const barHtml = c.bar ? `<div style="${c.bar}">${c.bc || ''}</div>` : '';
            // Decoración de esquina (emoji del tema)
            const decoEmojis = c.deco ? c.deco.split('') : [];
            const decoHtml = decoEmojis[0]
                ? `<div style="position:absolute;top:8px;left:10px;font-size:18px;opacity:0.35;pointer-events:none;">${decoEmojis[0]}</div>` : '';

            const musicHtml = this.musicPreview.hasAudio
              ? this.buildPreviewMusicHtml(c.ac)
              : '';

            const guideHtml = this.musicPreview.hasAudio && this.musicPreview.showGuide
              ? this.buildPreviewGuideHtml(c.ac)
              : '';

            return `<div style="${c.wrap}min-height:100%;padding:1.5rem;display:flex;align-items:flex-start;justify-content:center;">
  <div style="${c.card}width:100%;max-width:420px;position:relative;overflow:hidden;">
    ${barHtml}
    <div style="position:absolute;top:0;left:0;right:0;height:60%;overflow:hidden;pointer-events:none;z-index:1;-webkit-mask-image:linear-gradient(to bottom,black 0%,black 70%,transparent 100%);mask-image:linear-gradient(to bottom,black 0%,black 70%,transparent 100%);">${arte}</div>
    <div style="padding:1.25rem;position:relative;z-index:2;">
      <p style="font-size:10px;text-transform:uppercase;letter-spacing:0.15em;color:${c.ac};margin-bottom:3px;font-weight:600;">Para</p>
      <h2 style="font-size:1.3em;font-weight:900;color:${c.tc};margin-bottom:0.75rem;line-height:1.2;overflow:hidden;text-overflow:ellipsis;display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical;word-break:break-word;">${dest}</h2>
      ${imgHtml}
      <div style="${msgBg}"><div style="color:${c.tx};line-height:1.7;font-size:0.875em;">${msg}</div></div>
      <div style="display:flex;align-items:center;gap:0.5rem;border-top:1px solid rgba(128,128,128,0.15);padding-top:0.75rem;margin-top:0.5rem;">
        <div style="width:1.5rem;height:1.5rem;border-radius:50%;background:${c.ac};display:flex;align-items:center;justify-content:center;color:white;font-weight:700;font-size:0.7rem;flex-shrink:0;">${inicial}</div>
        <span style="font-weight:700;color:${c.fc};font-size:0.875em;min-width:0;flex:1;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;">${rem}</span>
      </div>
    </div>
      ${guideHtml}
      ${musicHtml}
  </div>
</div>`;
        },

        buildPreviewGuideHtml(accent) {
          const guideColor = accent || '#7C3AED';
          return `<div style="position:absolute;inset:10px;z-index:5;pointer-events:none;border-radius:16px;border:1px dashed rgba(124,58,237,.22);">
            <div style="position:absolute;left:33.333%;top:0;bottom:0;border-left:1px dashed rgba(124,58,237,.18);"></div>
            <div style="position:absolute;left:66.666%;top:0;bottom:0;border-left:1px dashed rgba(124,58,237,.18);"></div>
            <div style="position:absolute;top:33.333%;left:0;right:0;border-top:1px dashed rgba(124,58,237,.18);"></div>
            <div style="position:absolute;top:66.666%;left:0;right:0;border-top:1px dashed rgba(124,58,237,.18);"></div>
            <div style="position:absolute;left:50%;top:50%;width:14px;height:14px;border-radius:9999px;border:1px solid rgba(124,58,237,.45);transform:translate(-50%,-50%);box-shadow:0 0 0 2px rgba(255,255,255,.6)"></div>
            <div style="position:absolute;right:8px;top:8px;font-size:10px;font-weight:700;color:${guideColor};background:rgba(255,255,255,.86);padding:3px 6px;border-radius:999px;border:1px solid rgba(124,58,237,.25)">Guía activa</div>
          </div>`;
        },

        buildPreviewMusicHtml(accent) {
          const p = this.musicPreview;
          const x = Math.max(5, Math.min(95, Number(p.posX || 24)));
          const y = Math.max(5, Math.min(95, Number(p.posY || 24)));
          const scale = Math.max(70, Math.min(180, Number(p.scale || 100)));
          const fixedTopRight = true;
          const title = this.escapeHTML(p.titulo || 'Música');
          const artist = this.escapeHTML(p.artista || '');
          const lyrics = this.escapeHTML((p.lyrics || '').slice(0, 120));
          const thumb = p.thumb ? `<img src="${p.thumb}" alt="" style="width:34px;height:34px;border-radius:50%;object-fit:cover;border:2px solid #fff;box-shadow:0 2px 10px rgba(0,0,0,.2)">` : '';

          let body = `${thumb}<div style="min-width:0"><div style="font-size:11px;font-weight:800;color:${accent};white-space:nowrap;overflow:hidden;text-overflow:ellipsis;max-width:130px;">${title}</div><div style="font-size:10px;color:#6b7280;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;max-width:130px;">${artist}</div></div>`;

          if (p.displayMode === 'lyrics') {
            body = `<div style="min-width:0;max-width:220px"><div style="font-size:11px;font-weight:800;color:${accent};white-space:nowrap;overflow:hidden;text-overflow:ellipsis;max-width:210px;">${title}</div><div style="font-size:10px;line-height:1.45;color:#4b5563;max-height:78px;overflow:auto;margin-top:2px;white-space:pre-line;">${lyrics || 'Agrega un fragmento de letra para mostrarlo aquí.'}</div></div>`;
          }

          if (p.displayMode === 'cover_lyrics') {
            body = `${thumb}<div style="min-width:0"><div style="font-size:11px;font-weight:700;color:${accent};white-space:nowrap;overflow:hidden;text-overflow:ellipsis;max-width:120px;">${title}</div><div style="font-size:10px;line-height:1.35;color:#4b5563;max-width:120px;max-height:30px;overflow:hidden;">${lyrics || 'Letra...'}</div></div>`;
          }

          if (p.displayMode === 'vinyl') {
            body = `<div style="width:48px;height:48px;border-radius:9999px;background:radial-gradient(circle at center,#111827 0 26%,#030712 27% 100%);position:relative;box-shadow:0 8px 16px rgba(0,0,0,.25);animation:preview-vinyl-spin 3.2s linear infinite;"><div style="position:absolute;inset:14px;border-radius:9999px;overflow:hidden;border:2px solid #111827;">${p.thumb ? `<img src='${p.thumb}' style='width:100%;height:100%;object-fit:cover'>` : ''}</div></div><div style="font-size:11px;font-weight:800;color:${accent};white-space:nowrap;overflow:hidden;text-overflow:ellipsis;max-width:110px;">${title}</div>`;
          }

          const boxStyle = (p.displayMode === 'lyrics' || p.displayMode === 'cover_lyrics')
            ? 'border-radius:14px;padding:8px 10px;align-items:flex-start;max-width:250px;'
            : 'border-radius:999px;padding:7px 10px;align-items:center;max-width:210px;';

          const positionStyle = fixedTopRight
            ? `right:10px;top:10px;transform:scale(${Math.min((scale/100), 1.15).toFixed(2)});transform-origin:top right;`
            : `left:${x}%;top:${y}%;transform:translate(-50%,-50%) scale(${(scale/100).toFixed(2)});transform-origin:center center;`;

          return `<div data-preview-music style="position:absolute;${positionStyle}z-index:6;cursor:default;user-select:none;touch-action:none;background:rgba(255,255,255,.92);backdrop-filter:blur(8px);border:1px solid rgba(124,58,237,.35);display:flex;gap:8px;${boxStyle}box-shadow:0 12px 28px rgba(0,0,0,.16)">${body}</div>`;
        },

        bindPreviewMusicDrag(container) {
          if (['cover', 'cover_lyrics', 'lyrics', 'vinyl'].includes(this.musicPreview.displayMode)) {
            return;
          }

          const node = container.querySelector('[data-preview-music]');
          if (!node) return;

          let dragging = false;
          let moved = false;

          const move = (clientX, clientY) => {
            const rect = container.getBoundingClientRect();
            let x = Math.max(5, Math.min(95, Math.round(((clientX - rect.left) / rect.width) * 100)));
            let y = Math.max(5, Math.min(95, Math.round(((clientY - rect.top) / rect.height) * 100)));

            if (this.musicPreview.snapGuide) {
              const snapPoints = [16, 33, 50, 67, 84];
              const snap = (v) => {
                const near = snapPoints.find((p) => Math.abs(v - p) <= 3);
                return near ?? v;
              };
              x = snap(x);
              y = snap(y);
            }

            this.musicPreview.posX = x;
            this.musicPreview.posY = y;
            node.style.left = x + '%';
            node.style.top = y + '%';
            window.dispatchEvent(new CustomEvent('preview-music-position', { detail: { x, y } }));
          };

          node.onpointerdown = (ev) => {
            dragging = true;
            moved = false;
            node.style.cursor = 'grabbing';
            node.setPointerCapture?.(ev.pointerId);
            move(ev.clientX, ev.clientY);
          };

          node.onpointermove = (ev) => {
            if (!dragging) return;
            moved = true;
            move(ev.clientX, ev.clientY);
            ev.preventDefault();
          };

          node.onpointerup = () => {
            if (!dragging) return;
            dragging = false;
            node.style.cursor = 'grab';
            if (moved) this.emitirPreview();
          };

          node.onpointercancel = node.onpointerup;
        },

        getFormaStyleRaw() {
          const map = {
            'ninguna':'',
            'cuadrado':'border-radius:16px;',
            'circulo':'border-radius:50%;',
            'corazon':'clip-path:path("M50,90 C20,65 0,45 0,25 C0,10 12,0 25,0 C35,0 45,7 50,18 C55,7 65,0 75,0 C88,0 100,10 100,25 C100,45 80,65 50,90 Z");',
            'estrella':'clip-path:polygon(50% 0%, 61% 35%, 98% 35%, 68% 57%, 79% 91%, 50% 70%, 21% 91%, 32% 57%, 2% 35%, 39% 35%);',
            'hexagono':'clip-path:polygon(25% 5%, 75% 5%, 100% 50%, 75% 95%, 25% 95%, 0% 50%);',
            'diamante':'clip-path:polygon(50% 0%, 100% 50%, 50% 100%, 0% 50%);'
          };
            return map[this.imagenForma] || '';
        },
        escapeHTML(s) {
            return String(s).replace(/[&<>"']/g, m => ({'&':'&amp;','<':'&lt;','>':'&gt;','"':'&quot;',"'":'&#39;'}[m]));
        },
        getMarcoStyleRaw() {
            const map = { 'ninguno':'','morado':'filter:drop-shadow(0 0 8px #7C3AED);','dorado':'filter:drop-shadow(0 0 8px #F59E0B);','rosa':'filter:drop-shadow(0 0 8px #F472B6);','verde':'filter:drop-shadow(0 0 8px #10B981);','sombra':'filter:drop-shadow(4px 8px 16px rgba(0,0,0,0.45));','blanco':'filter:drop-shadow(0 0 8px #fff);' };
            return map[this.imagenMarco] || '';
        },
        getFormaStyle() { return this.getFormaStyleRaw(); },
        getMarcoStyle() { return this.getMarcoStyleRaw(); },

        seleccionarImagen(e) {
            const file = e.target.files[0];
            if (!file) return;
            if (file.size > 5 * 1024 * 1024) { alert('La imagen no debe superar 5MB.'); e.target.value = ''; return; }
            const lector = new FileReader();
            lector.onload = (ev) => { this.imagenPreview = ev.target.result; this.emitirPreview(); };
            lector.readAsDataURL(file);
        },

        quitarImagen() {
            this.imagenPreview = null;
            const input = document.querySelector('input[name="imagen"]');
            if (input) input.value = '';
            this.emitirPreview();
        },
    };
}
</script>
@endpush
