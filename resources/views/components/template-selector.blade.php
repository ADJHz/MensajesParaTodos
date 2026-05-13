{{--
  Componente: Selector de Template
  Props: modelValue (nombre del template seleccionado)
  Emite cambio via Alpine: $dispatch('template-changed', nombre)
--}}
@props(['selected' => 'clasico'])

@php
$templates = [
    ['id' => 'clasico',      'nombre' => 'Clásico',      'emoji' => '💜', 'desc' => 'Elegante y atemporal',
     'preview_bg' => 'from-violet-50 to-pink-50', 'preview_border' => 'border-violet-200', 'preview_accent' => 'bg-violet-500'],
    ['id' => 'rosa-floral',  'nombre' => 'Rosa Floral',  'emoji' => '🌸', 'desc' => 'Romántico y delicado',
     'preview_bg' => 'from-pink-50 to-rose-50',   'preview_border' => 'border-pink-200',   'preview_accent' => 'bg-pink-500'],
    ['id' => 'galaxia',      'nombre' => 'Galaxia',      'emoji' => '🌌', 'desc' => 'Misterioso y profundo',
     'preview_bg' => 'from-indigo-900 to-blue-900','preview_border' => 'border-indigo-700', 'preview_accent' => 'bg-violet-400',
     'text_color' => 'text-white'],
    ['id' => 'vintage',      'nombre' => 'Vintage',      'emoji' => '📜', 'desc' => 'Carta de papel clásica',
     'preview_bg' => 'from-amber-50 to-yellow-50', 'preview_border' => 'border-amber-200',  'preview_accent' => 'bg-amber-500'],
    ['id' => 'minimalista',  'nombre' => 'Minimalista',  'emoji' => '⬜', 'desc' => 'Moderno y limpio',
     'preview_bg' => 'from-white to-gray-50',      'preview_border' => 'border-gray-200',   'preview_accent' => 'bg-gray-900'],
    ['id' => 'fiesta',       'nombre' => 'Fiesta',       'emoji' => '🎉', 'desc' => 'Festivo y divertido',
     'preview_bg' => 'from-yellow-50 to-orange-50','preview_border' => 'border-orange-200', 'preview_accent' => 'bg-orange-500'],
];
@endphp

<div x-data="{ seleccionado: '{{ $selected }}' }"
     @template-changed.window="seleccionado = $event.detail"
     class="w-full">

    <p class="text-sm font-semibold text-gray-700 mb-3">
        🎨 Elige el diseño de tu mensaje
        <span class="font-normal text-gray-400 ml-1">(puedes cambiarlo en cualquier momento)</span>
    </p>

    {{-- Grid de miniaturas --}}
    <div class="grid grid-cols-2 sm:grid-cols-3 gap-3">
        @foreach($templates as $tpl)
        <button type="button"
                @click="seleccionado = '{{ $tpl['id'] }}'; $dispatch('template-changed', '{{ $tpl['id'] }}')"
                :class="seleccionado === '{{ $tpl['id'] }}' ? 'ring-2 ring-violet-500 border-violet-400 scale-[1.02]' : 'border-gray-200 hover:border-violet-200 hover:scale-[1.01]'"
                class="relative rounded-xl border-2 overflow-hidden transition-all duration-200 group text-left shadow-sm">

            {{-- Miniatura visual --}}
            <div class="bg-gradient-to-br {{ $tpl['preview_bg'] }} p-3 h-20 flex flex-col justify-between relative">
                {{-- Acento de color --}}
                <div class="absolute top-0 left-0 right-0 h-1 {{ $tpl['preview_accent'] }}"></div>
                {{-- Líneas simulando texto --}}
                <div class="mt-2 space-y-1">
                    <div class="{{ $tpl['preview_accent'] }} h-1.5 rounded-full w-3/4 opacity-40"></div>
                    <div class="{{ $tpl['preview_accent'] }} h-1 rounded-full w-1/2 opacity-25"></div>
                    <div class="{{ $tpl['preview_accent'] }} h-1 rounded-full w-2/3 opacity-20"></div>
                </div>
                {{-- Emoji --}}
                <div class="absolute top-2 right-2 text-lg">{{ $tpl['emoji'] }}</div>
                {{-- Badge seleccionado --}}
                <div x-show="seleccionado === '{{ $tpl['id'] }}'"
                     class="absolute bottom-1 right-1 w-5 h-5 bg-violet-600 rounded-full flex items-center justify-center shadow-sm">
                    <svg class="w-3 h-3 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                    </svg>
                </div>
            </div>

            {{-- Label --}}
            <div class="px-2 py-1.5 bg-white">
                <p class="text-xs font-bold text-gray-700 leading-tight">{{ $tpl['nombre'] }}</p>
                <p class="text-[10px] text-gray-400">{{ $tpl['desc'] }}</p>
            </div>
        </button>
        @endforeach
    </div>

    {{-- Hidden input sincronizado --}}
    <input type="hidden" name="template" :value="seleccionado">
</div>
