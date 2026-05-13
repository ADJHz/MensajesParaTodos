@extends('layouts.app')
@section('title', 'Mi Estudio Creativo')

@section('content')
<div x-data="dashboard()" class="max-w-6xl mx-auto px-4 py-12">

    {{-- Bienvenida --}}
    <div class="mb-10 flex items-center gap-4">
        @if(Auth::user()->avatar)
            <img src="{{ Auth::user()->avatar }}" alt="avatar" class="w-14 h-14 rounded-full border-4 border-violet-200 shadow" />
        @else
            <div class="w-14 h-14 rounded-full bg-gradient-to-br from-violet-400 to-pink-400 flex items-center justify-center text-white text-2xl font-bold shadow">
                {{ mb_strtoupper(mb_substr(Auth::user()->name, 0, 1)) }}
            </div>
        @endif
        <div>
            <p class="text-sm text-gray-400">¡Hola de nuevo!</p>
            <h1 class="font-app-heading text-2xl font-bold text-gray-800">{{ Auth::user()->name }} 👋</h1>
        </div>
    </div>

    {{-- ===== WIZARD: Para quién es tu mensaje ===== --}}
    <section class="mb-14">
        <div class="text-center mb-8">
            <h2 class="font-app-heading text-3xl font-bold text-gray-800 mb-2">¿Para quién es tu mensaje? 💌</h2>
            <p class="text-gray-500">Selecciona una categoría y te guiaremos paso a paso</p>
        </div>

        {{-- Paso 1: Categorías (siempre visible hasta que Alpine elige paso 2) --}}
        <div x-show="paso == 1">
            <div class="grid grid-cols-2 sm:grid-cols-3 gap-5">
                @foreach($categorias as $cat)
                <button type="button"
                        @click="elegirCategoria({{ $cat->id }}, '{{ $cat->slug }}', '{{ addslashes($cat->nombre) }}', '{{ $cat->emoji }}')"
                        class="bg-white rounded-2xl shadow-md border-2 p-6 text-center transition-all hover:-translate-y-1 hover:shadow-xl cursor-pointer w-full"
                        :class="categoriaId === {{ $cat->id }} ? 'border-violet-500 ring-2 ring-violet-300' : 'border-gray-100 hover:border-violet-200'">
                    <div class="text-5xl mb-3">{{ $cat->emoji }}</div>
                    <h3 class="font-bold text-gray-800 text-base mb-1">{{ $cat->nombre }}</h3>
                    <p class="text-xs text-gray-400">{{ $cat->ocasiones->count() }} ocasiones</p>
                </button>
                @endforeach
            </div>
        </div>

        {{-- Paso 2: Ocasiones --}}
        <div x-show="paso === 2" x-cloak>
            <div class="flex items-center gap-3 mb-6">
                <button @click="volverPaso1()" class="flex items-center gap-2 text-violet-600 font-semibold hover:text-violet-800 transition">
                    ← Cambiar categoría
                </button>
                <span class="text-gray-400">·</span>
                <span class="text-gray-600" x-text="categoriaEmoji + ' ' + categoriaNombre"></span>
            </div>

            <h3 class="font-app-heading text-2xl font-bold text-gray-800 mb-6">¿Cuál es la ocasión?</h3>

            <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-4" x-show="ocasiones.length">
                <template x-for="ocasion in ocasiones" :key="ocasion.id">
                    <a :href="'/mensajes/crear?ocasion=' + ocasion.slug"
                       class="bg-white rounded-2xl shadow border border-gray-100 p-5 text-center hover:shadow-lg hover:-translate-y-1 transition-all hover:border-violet-200">
                        <div class="text-4xl mb-2" x-text="ocasion.emoji"></div>
                        <p class="font-semibold text-gray-700 text-sm" x-text="ocasion.nombre"></p>
                        <p class="text-xs text-gray-400 mt-1" x-text="ocasion.descripcion"></p>
                        <div class="mt-3 bg-violet-600 text-white text-xs font-bold px-3 py-1 rounded-full inline-block">Crear →</div>
                    </a>
                </template>
            </div>

            <div x-show="cargando" class="text-center py-12">
                <div class="inline-block w-10 h-10 border-4 border-violet-200 border-t-violet-600 rounded-full animate-spin"></div>
                <p class="text-gray-500 mt-3">Cargando ocasiones...</p>
            </div>
        </div>
    </section>

    {{-- ===== MIS MENSAJES ===== --}}
    @if($mensajes->isNotEmpty())
    <section>
        <h2 class="font-app-heading text-2xl font-bold text-gray-800 mb-6">Mis mensajes recientes 📬</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">
            @foreach($mensajes as $m)
            <div class="bg-white rounded-2xl shadow border border-gray-100 p-5">
                <div class="flex items-start justify-between mb-3">
                    <div>
                        <span class="text-2xl">{{ $m->ocasion->emoji ?? '💌' }}</span>
                        <p class="font-bold text-gray-800 mt-1">Para: {{ $m->destinatario }}</p>
                        <p class="text-xs text-gray-400">{{ $m->ocasion->nombre ?? '' }}</p>
                    </div>
                    <span class="px-3 py-1 rounded-full text-xs font-bold
                        {{ $m->estado === 'pagado' ? 'bg-emerald-100 text-emerald-700' : 'bg-amber-100 text-amber-700' }}">
                        {{ $m->estado === 'pagado' ? '✅ Enviado' : '⏳ Pendiente' }}
                    </span>
                </div>
                <p class="text-sm text-gray-500 line-clamp-2">{{ $m->mensaje }}</p>
                <div class="mt-4 flex gap-2">
                    @if($m->isPagado())
                        <a href="{{ route('mensajes.show', $m->code) }}" target="_blank"
                           class="flex-1 text-center py-2 bg-violet-600 text-white text-xs font-bold rounded-full hover:bg-violet-700 transition">
                            Ver mensaje
                        </a>
                        <button onclick="navigator.clipboard.writeText('{{ route('mensajes.show', $m->code) }}')"
                                class="px-3 py-2 bg-violet-50 text-violet-600 text-xs font-bold rounded-full hover:bg-violet-100 transition">
                            📋 Copiar link
                        </button>
                    @else
                        <a href="{{ route('pago.checkout', $m->code) }}"
                           class="flex-1 text-center py-2 bg-amber-500 text-white text-xs font-bold rounded-full hover:bg-amber-600 transition">
                            💳 Completar pago
                        </a>
                    @endif
                </div>
            </div>
            @endforeach
        </div>
    </section>
    @endif

</div>
@endsection

@push('scripts')
<script>
function dashboard() {
    return {
        paso: 1,
        categoriaId: null,
        categoriaNombre: '',
        categoriaEmoji: '',
        categoriaSlug: '',
        ocasiones: [],
        cargando: false,

        elegirCategoria(id, slug, nombre, emoji) {
            this.categoriaId   = id;
            this.categoriaSlug = slug;
            this.categoriaNombre = nombre;
            this.categoriaEmoji  = emoji;
            this.cargarOcasiones(slug);
            this.paso = 2;
        },

        volverPaso1() {
            this.paso = 1;
            this.categoriaId = null;
            this.ocasiones = [];
        },

        async cargarOcasiones(slug) {
            this.cargando = true;
            try {
                const res = await fetch(`/api/ocasiones/${slug}`);
                const data = await res.json();
                this.ocasiones = data.ocasiones;
            } catch(e) {
                console.error(e);
            } finally {
                this.cargando = false;
            }
        },

        init() {
            // No auto-select needed
        }
    }
}
</script>
@endpush
