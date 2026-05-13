<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>@yield('title', 'Mensajes para Todos') · 💌</title>
    <link rel="icon" type="image/svg+xml" href="/favicon.svg" />
    <meta name="theme-color" content="#7C3AED" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700;800&family=Poppins:wght@600;700;800&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
    @stack('head')
</head>
<body class="bg-app-bg font-app-body text-app-text antialiased">

    {{-- Navbar --}}
    <nav class="sticky top-0 z-50 bg-white/90 backdrop-blur-md border-b border-violet-100 shadow-sm">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">
                <a href="{{ route('home') }}" class="flex items-center gap-2 font-bold text-xl text-violet-700">
                    <span class="text-2xl">💌</span>
                    <span class="font-app-heading">Mensajes para Todos</span>
                </a>

                <div class="flex items-center gap-3">
                    @auth
                        <a href="{{ route('dashboard') }}"
                           class="hidden sm:inline-flex items-center gap-1.5 text-sm font-semibold text-violet-700 hover:text-violet-900 transition px-3 py-2 rounded-lg hover:bg-violet-50">
                            <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                            Mi Estudio
                        </a>
                        <a href="{{ route('mensajes.mios') }}"
                           class="hidden sm:inline-flex items-center gap-1.5 text-sm font-semibold text-violet-700 hover:text-violet-900 transition px-3 py-2 rounded-lg hover:bg-violet-50">
                            <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                            Mis Mensajes
                        </a>

                        {{-- ── Dropdown de usuario (Flowbite) ── --}}
                        <button id="dropdownUserButton" data-dropdown-toggle="dropdownUser" data-dropdown-placement="bottom-end"
                                class="inline-flex items-center justify-center gap-2 text-white bg-gradient-to-br from-violet-600 to-pink-500 hover:from-violet-700 hover:to-pink-600 focus:ring-4 focus:ring-violet-200 shadow-sm font-medium rounded-full text-sm pl-1.5 pr-3 py-1.5 focus:outline-none transition-all"
                                type="button">
                            @if(Auth::user()->avatar)
                                <img src="{{ Auth::user()->avatar }}" alt="avatar" class="w-7 h-7 rounded-full border-2 border-white" />
                            @else
                                <span class="w-7 h-7 rounded-full bg-white text-violet-600 flex items-center justify-center font-bold text-xs">
                                    {{ mb_strtoupper(mb_substr(Auth::user()->name, 0, 1)) }}
                                </span>
                            @endif
                            <span class="hidden sm:inline max-w-[120px] truncate">{{ Auth::user()->name }}</span>
                            <svg class="w-3.5 h-3.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 9-7 7-7-7"/></svg>
                        </button>

                        <div id="dropdownUser" class="z-50 hidden bg-white border border-violet-100 rounded-2xl shadow-xl w-72">
                            <div class="p-2">
                                <div class="flex items-center px-3 py-2.5 space-x-2 text-sm bg-violet-50 rounded-xl">
                                    @if(Auth::user()->avatar)
                                        <img src="{{ Auth::user()->avatar }}" alt="avatar" class="w-9 h-9 rounded-full border-2 border-white shadow" />
                                    @else
                                        <div class="w-9 h-9 rounded-full bg-gradient-to-br from-violet-500 to-pink-500 text-white flex items-center justify-center font-bold">
                                            {{ mb_strtoupper(mb_substr(Auth::user()->name, 0, 1)) }}
                                        </div>
                                    @endif
                                    <div class="flex-1 min-w-0">
                                        <div class="font-semibold text-gray-900 truncate">{{ Auth::user()->name }}</div>
                                        <div class="truncate text-gray-500 text-xs">{{ Auth::user()->email }}</div>
                                    </div>
                                </div>
                            </div>
                            <ul class="px-2 pb-2 text-sm text-gray-700 font-medium" aria-labelledby="dropdownUserButton">
                                <li>
                                    <a href="{{ route('dashboard') }}" class="inline-flex items-center w-full p-2.5 hover:bg-violet-50 hover:text-violet-700 rounded-lg transition gap-2">
                                        <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                                        Mi Estudio Creativo
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('mensajes.mios') }}" class="inline-flex items-center w-full p-2.5 hover:bg-violet-50 hover:text-violet-700 rounded-lg transition gap-2">
                                        <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                                        Mis Mensajes
                                        <span class="ml-auto bg-violet-100 text-violet-700 text-xs font-bold px-2 py-0.5 rounded-full">{{ Auth::user()->mensajes()->count() ?? 0 }}</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('mensajes.crear') }}" class="inline-flex items-center w-full p-2.5 hover:bg-violet-50 hover:text-violet-700 rounded-lg transition gap-2">
                                        <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/></svg>
                                        Crear nuevo mensaje
                                    </a>
                                </li>
                                <li class="border-t border-gray-100 mt-1 pt-1">
                                    <form method="POST" action="{{ route('logout') }}" class="m-0">
                                        @csrf
                                        <button type="submit" class="inline-flex items-center w-full p-2.5 text-red-600 hover:bg-red-50 rounded-lg transition gap-2">
                                            <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                                            Cerrar sesión
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    @else
                        <a href="{{ route('login') }}" class="text-sm font-semibold text-violet-700 hover:text-violet-900 transition">Iniciar sesión</a>
                        <a href="{{ route('register') }}" class="px-4 py-2 rounded-full bg-violet-600 text-white text-sm font-bold hover:bg-violet-700 transition shadow">Registrarse</a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    {{-- Flash messages --}}
    @if(session('success'))
        <div class="max-w-6xl mx-auto px-4 mt-4">
            <div class="bg-emerald-50 border border-emerald-200 text-emerald-800 rounded-xl px-4 py-3 text-sm">✅ {{ session('success') }}</div>
        </div>
    @endif
    @if(session('info'))
        <div class="max-w-6xl mx-auto px-4 mt-4">
            <div class="bg-violet-50 border border-violet-200 text-violet-800 rounded-xl px-4 py-3 text-sm">ℹ️ {{ session('info') }}</div>
        </div>
    @endif
    @if(session('error'))
        <div class="max-w-6xl mx-auto px-4 mt-4">
            <div class="bg-red-50 border border-red-200 text-red-800 rounded-xl px-4 py-3 text-sm">❌ {{ session('error') }}</div>
        </div>
    @endif

    <main>
        @yield('content')
    </main>

    <footer class="mt-20 border-t border-violet-100 bg-white py-10 text-center text-sm text-gray-400">
        <p class="text-2xl mb-2">💌</p>
        <p><span class="font-bold text-violet-600">Mensajes para Todos</span> — Palabras que llegan al corazón</p>
        <p class="mt-1">© {{ date('Y') }} · Hecho con ❤️ en México</p>
    </footer>

    @stack('scripts')
</body>
</html>
