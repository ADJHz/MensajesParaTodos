<!DOCTYPE html>
@php
    $seoTitle       = trim($__env->yieldContent('title', 'Acceso')) . ' · Mensajes para Todos';
    $seoDescription = trim($__env->yieldContent('description', 'Accede a tu cuenta de Mensajes para Todos y crea dedicatorias únicas con música, animaciones y un link inolvidable. 💌'));
    $seoUrl         = url()->current();
    $seoImage       = url('/og-image.png');
    $siteName       = config('app.name', 'Mensajes para Todos');
@endphp
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>{{ $seoTitle }}</title>

    <meta name="description" content="{{ $seoDescription }}" />
    <meta name="robots" content="index, follow" />
    <meta name="author" content="{{ $siteName }}" />
    <link rel="canonical" href="{{ $seoUrl }}" />

    <meta property="og:locale" content="es_MX" />
    <meta property="og:type" content="website" />
    <meta property="og:site_name" content="{{ $siteName }}" />
    <meta property="og:title" content="{{ $seoTitle }}" />
    <meta property="og:description" content="{{ $seoDescription }}" />
    <meta property="og:url" content="{{ $seoUrl }}" />
    <meta property="og:image" content="{{ $seoImage }}" />

    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:title" content="{{ $seoTitle }}" />
    <meta name="twitter:description" content="{{ $seoDescription }}" />
    <meta name="twitter:image" content="{{ $seoImage }}" />

    <link rel="icon" type="image/svg+xml" href="/favicon.svg" />
    <link rel="apple-touch-icon" href="/favicon.svg" />
    <meta name="theme-color" content="#7C3AED" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700;800&family=Poppins:wght@600;700;800&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-gradient-to-br from-violet-50 via-purple-50 to-pink-50 font-app-body flex flex-col justify-center antialiased">

    <div class="text-center mb-6">
        <a href="{{ route('home') }}" class="inline-flex items-center gap-2 text-2xl font-bold text-violet-700">
            <span class="text-3xl">💌</span>
            <span class="font-app-heading">Mensajes para Todos</span>
        </a>
    </div>

    <main class="flex-1 flex items-start justify-center px-4">
        <div class="w-full max-w-md">
            @yield('content')
        </div>
    </main>

    <footer class="py-6 text-center text-sm text-gray-400">
        © {{ date('Y') }} Mensajes para Todos
    </footer>
</body>
</html>
