@extends('layouts.app')
@section('title', 'Mensajes para Todos — Palabras que llegan al corazón')

@push('head')
<style>
.categoria-card { transition: transform .2s, box-shadow .2s; }
.categoria-card:hover { transform: translateY(-6px); }
.blur-section { position: relative; }
.blur-overlay {
    position: fixed; inset: 0; z-index: 40;
    backdrop-filter: blur(8px);
    background: rgba(124,58,237,0.15);
    display: flex; align-items: center; justify-content: center;
    padding: 1rem;
}
</style>
@endpush

@section('content')

<div x-data="guestHome()" x-init="init()">

    {{-- ===== HERO ===== --}}
    <section class="relative overflow-hidden bg-gradient-to-br from-violet-600 via-purple-600 to-pink-500 text-white py-24 px-4">
        {{-- Decorative blobs --}}
        <div class="absolute top-0 left-0 w-72 h-72 bg-white/10 rounded-full -translate-x-1/2 -translate-y-1/2 blur-3xl"></div>
        <div class="absolute bottom-0 right-0 w-96 h-96 bg-pink-300/20 rounded-full translate-x-1/3 translate-y-1/3 blur-3xl"></div>
        <div class="absolute top-1/2 left-1/2 w-64 h-64 bg-violet-300/10 rounded-full -translate-x-1/2 -translate-y-1/2 blur-2xl"></div>

        <div class="relative max-w-4xl mx-auto text-center">
            <div class="text-5xl sm:text-6xl mb-6 animate-bounce-slow">💌</div>
            <h1 class="font-app-heading text-4xl sm:text-5xl lg:text-6xl font-extrabold leading-tight mb-4">
                Mensajes que llegan<br class="hidden sm:block" />
                <span class="text-yellow-300">al corazón</span>
            </h1>
            <p class="text-lg sm:text-xl text-purple-100 max-w-2xl mx-auto mb-8">
                Crea mensajes únicos y personalizados para las personas más especiales de tu vida.
                Con música, animaciones y un link que nunca olvidarán. 🎵
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="{{ route('register') }}" class="px-8 py-4 bg-white text-violet-700 font-bold rounded-full text-lg hover:bg-yellow-50 transition shadow-lg">
                    ✨ Crear mi mensaje
                </a>
                <a href="#categorias" class="px-8 py-4 border-2 border-white/60 text-white font-semibold rounded-full text-lg hover:bg-white/10 transition">
                    Explorar gratis 👀
                </a>
            </div>

            {{-- Stats --}}
            <div class="mt-12 grid grid-cols-3 gap-4 max-w-sm mx-auto text-center">
                <div><div class="text-2xl font-extrabold text-yellow-300">15+</div><div class="text-xs text-purple-200">Ocasiones</div></div>
                <div><div class="text-2xl font-extrabold text-yellow-300">$5</div><div class="text-xs text-purple-200">USD por mensaje</div></div>
                <div><div class="text-2xl font-extrabold text-yellow-300">∞</div><div class="text-xs text-purple-200">Amor enviado</div></div>
            </div>
        </div>
    </section>

    {{-- ===== CÓMO FUNCIONA ===== --}}
    <section class="py-16 px-4 bg-white">
        <div class="max-w-5xl mx-auto">
            <h2 class="font-app-heading text-3xl font-bold text-center text-gray-800 mb-2">¿Cómo funciona?</h2>
            <p class="text-center text-gray-500 mb-12">En 3 simples pasos</p>
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-8">
                @foreach([
                    ['emoji' => '🎯', 'paso' => '1', 'titulo' => 'Elige la ocasión', 'desc' => 'Selecciona para quién es el mensaje y qué estás celebrando.'],
                    ['emoji' => '✍️', 'paso' => '2', 'titulo' => 'Personaliza', 'desc' => 'Escribe tu mensaje, agrega una canción de YouTube y el nombre del destinatario.'],
                    ['emoji' => '🚀', 'paso' => '3', 'titulo' => 'Envía el link', 'desc' => 'Paga $5 USD y comparte el link mágico con quien amas. ¡Lo recordará para siempre!'],
                ] as $step)
                <div class="text-center p-6 rounded-2xl bg-violet-50 border border-violet-100">
                    <div class="text-4xl mb-3">{{ $step['emoji'] }}</div>
                    <div class="inline-block bg-violet-600 text-white text-xs font-bold px-3 py-1 rounded-full mb-3">Paso {{ $step['paso'] }}</div>
                    <h3 class="font-bold text-lg text-gray-800 mb-2">{{ $step['titulo'] }}</h3>
                    <p class="text-gray-500 text-sm">{{ $step['desc'] }}</p>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ===== CATEGORÍAS ===== --}}
    <section id="categorias" class="py-16 px-4 bg-gradient-to-b from-violet-50 to-white">
        <div class="max-w-6xl mx-auto">
            <h2 class="font-app-heading text-3xl font-bold text-center text-gray-800 mb-2">¿Para quién es tu mensaje?</h2>
            <p class="text-center text-gray-500 mb-12">Elige una categoría para explorar las ocasiones</p>

            <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-3 gap-5">
                @foreach($categorias as $cat)
                <div class="categoria-card bg-white rounded-2xl shadow-md border border-gray-100 p-6 text-center cursor-pointer hover:shadow-xl"
                     @click="@guest seleccionarCategoria('{{ $cat->slug }}') @else window.location='{{ route('dashboard') }}?categoria={{ $cat->slug }}' @endguest">
                    <div class="text-5xl mb-3">{{ $cat->emoji }}</div>
                    <h3 class="font-bold text-gray-800 text-base mb-1">{{ $cat->nombre }}</h3>
                    <p class="text-xs text-gray-400">{{ $cat->descripcion }}</p>
                    <div class="mt-3 inline-flex items-center gap-1 text-xs font-semibold px-3 py-1 rounded-full text-white"
                         style="background-color: {{ $cat->color }};">
                        {{ $cat->ocasiones->count() }} ocasiones
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ===== PREVIEW OCASIONES (free) ===== --}}
    <section class="py-16 px-4 bg-white">
        <div class="max-w-5xl mx-auto">
            <h2 class="font-app-heading text-3xl font-bold text-center text-gray-800 mb-2">Algunas ocasiones populares</h2>
            <p class="text-center text-gray-500 mb-10">Para inspirarte 🌟</p>

            <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-4">
                @foreach($categorias->flatMap->ocasiones->take(4) as $ocasion)
                <div class="bg-gradient-to-br from-violet-50 to-pink-50 rounded-xl p-4 text-center border border-violet-100">
                    <div class="text-3xl mb-2">{{ $ocasion->emoji }}</div>
                    <p class="font-semibold text-gray-700 text-sm">{{ $ocasion->nombre }}</p>
                    <p class="text-xs text-gray-400 mt-1">{{ $ocasion->descripcion }}</p>
                </div>
                @endforeach
            </div>

            {{-- Trigger para el blur --}}
            <div id="blur-trigger" class="mt-8"></div>

            {{-- Contenido bloqueado --}}
            <div class="relative mt-6 blur-section">
                <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-4 pointer-events-none select-none filter blur-sm opacity-60">
                    @foreach($categorias->flatMap->ocasiones->skip(4)->take(8) as $ocasion)
                    <div class="bg-gradient-to-br from-amber-50 to-orange-50 rounded-xl p-4 text-center border border-amber-100">
                        <div class="text-3xl mb-2">{{ $ocasion->emoji }}</div>
                        <p class="font-semibold text-gray-700 text-sm">{{ $ocasion->nombre }}</p>
                        <p class="text-xs text-gray-400 mt-1">{{ $ocasion->descripcion }}</p>
                    </div>
                    @endforeach
                </div>
                {{-- Gradient overlay --}}
                <div class="absolute inset-0 bg-gradient-to-b from-transparent via-white/60 to-white pointer-events-none"></div>
            </div>
        </div>
    </section>

    {{-- ===== BLUR OVERLAY (aparece al scroll) ===== --}}
    @guest
    <div x-show="mostrarBlur"
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         class="blur-overlay"
         style="display:none;">
        <div class="bg-white rounded-3xl shadow-2xl p-8 max-w-md w-full text-center border border-violet-100">
            <div class="text-5xl mb-4">🔒</div>
            <h3 class="font-app-heading text-2xl font-bold text-gray-800 mb-2">¡Desbloquea más ocasiones!</h3>
            <p class="text-gray-500 mb-6 text-sm">Regístrate gratis para ver todas las ocasiones y crear tu primer mensaje especial.</p>
            <div class="flex flex-col gap-3">
                <a href="{{ route('register') }}" class="w-full py-3 bg-violet-600 text-white font-bold rounded-full hover:bg-violet-700 transition text-center">
                    ✨ Crear cuenta gratis
                </a>
                <a href="{{ route('login') }}" class="w-full py-3 border-2 border-violet-200 text-violet-700 font-semibold rounded-full hover:bg-violet-50 transition text-center">
                    Ya tengo cuenta — Iniciar sesión
                </a>
            </div>
            <button @click="cerrarBlur()" class="mt-4 text-xs text-gray-400 hover:text-gray-600 underline">
                Continuar explorando sin cuenta
            </button>
        </div>
    </div>
    @endguest

    {{-- ===== CTA FINAL ===== --}}
    <section class="py-20 px-4 bg-gradient-to-r from-violet-600 to-pink-500 text-white text-center">
        <div class="max-w-2xl mx-auto">
            <div class="text-5xl mb-4">💝</div>
            <h2 class="font-app-heading text-3xl sm:text-4xl font-extrabold mb-4">
                Regala palabras que duran para siempre
            </h2>
            <p class="text-purple-100 mb-8 text-lg">Solo $5 USD (~$100 MXN) · Un link único · Música incluida</p>
            <a href="{{ route('register') }}" class="px-10 py-4 bg-white text-violet-700 font-extrabold text-lg rounded-full hover:bg-yellow-50 transition shadow-lg inline-block">
                🚀 Empezar ahora
            </a>
        </div>
    </section>

</div>

@endsection

@push('scripts')
<script>
function guestHome() {
    return {
        mostrarBlur: false,
        ignorarBlur: false,
        observer: null,

        init() {
            @guest
            const trigger = document.getElementById('blur-trigger');
            if (!trigger) return;

            this.observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (!entry.isIntersecting && !this.ignorarBlur && window.scrollY > 300) {
                        this.mostrarBlur = true;
                    }
                });
            }, { threshold: 0 });

            this.observer.observe(trigger);
            @endguest
        },

        seleccionarCategoria(slug) {
            if (!this.ignorarBlur) {
                this.mostrarBlur = true;
            }
        },

        cerrarBlur() {
            this.mostrarBlur = false;
            this.ignorarBlur = true;
        }
    }
}
</script>
@endpush
