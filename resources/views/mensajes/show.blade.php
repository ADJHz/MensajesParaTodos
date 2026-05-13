@extends('layouts.app')
@section('title', 'Mensaje para ' . $mensaje->destinatario)

@section('content')
@php
use App\Helpers\TemplateHelper;

$configs    = TemplateHelper::configsParaPreview();
$artes      = TemplateHelper::svgArte();
$tplId      = $mensaje->template ?? 'clasico';
$cfg        = $configs[$tplId] ?? $configs['clasico'];
$arte       = $artes[$tplId] ?? '';
$isDark     = str_contains($cfg['wrap'], '#0') || str_contains($cfg['wrap'], '0f172') || str_contains($cfg['wrap'], '0B0B') || str_contains($cfg['wrap'], '111') || str_contains($cfg['wrap'], '1e0');

$formas = [
    'ninguna'  => '', 'cuadrado' => 'border-radius:16px;', 'circulo'  => 'border-radius:50%;',
    'corazon'  => 'clip-path:url(#cp-heart);', 'estrella' => 'clip-path:url(#cp-star);',
    'hexagono' => 'clip-path:url(#cp-hexagon);', 'diamante' => 'clip-path:url(#cp-diamond);',
];
$marcos = [
    'ninguno' => '', 'morado'  => 'filter:drop-shadow(0 0 10px #7C3AED) drop-shadow(0 0 20px rgba(124,58,237,0.4));',
    'dorado'  => 'filter:drop-shadow(0 0 10px #F59E0B) drop-shadow(0 0 20px rgba(245,158,11,0.4));',
    'rosa'    => 'filter:drop-shadow(0 0 10px #F472B6) drop-shadow(0 0 20px rgba(244,114,182,0.4));',
    'verde'   => 'filter:drop-shadow(0 0 10px #10B981) drop-shadow(0 0 20px rgba(16,185,129,0.4));',
    'sombra'  => 'filter:drop-shadow(4px 8px 20px rgba(0,0,0,0.5));',
    'blanco'  => 'filter:drop-shadow(0 0 10px #fff) drop-shadow(0 0 20px rgba(255,255,255,0.7));',
];
$estiloForma = $formas[$mensaje->imagen_forma ?? 'ninguna'] ?? '';
$estiloMarco = $marcos[$mensaje->imagen_marco ?? 'ninguno'] ?? '';

// Colores del template para la página completa
$wrapBg   = $cfg['wrap'];   // fondo de página
$cardCss  = $cfg['card'];   // estilo de la carta
$barCss   = $cfg['bar'];    // barra superior
$barContent = $cfg['bc'] ?? '';
$accentColor = $cfg['ac'];
$titleColor  = $cfg['tc'];
$bodyColor   = $cfg['tx'];
$firmaColor  = $cfg['fc'];
$msgBgColor  = $cfg['bg'] ?? '';
$decos       = $cfg['deco'] ?? '✨';

$textSoft = $isDark ? 'rgba(255,255,255,0.5)' : '#9ca3af';
$borderSoft = $isDark ? 'rgba(255,255,255,0.08)' : 'rgba(0,0,0,0.06)';
@endphp

{{-- ════ PÁGINA CON ESTILO DEL TEMPLATE ════ --}}
<div style="{{ $wrapBg }} min-height:100vh; padding: 3rem 1rem 4rem;" class="relative overflow-hidden">

    {{-- SVG Clip Paths --}}
    <svg width="0" height="0" style="position:absolute;overflow:hidden;pointer-events:none">
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

    {{-- Partículas decorativas (usando emojis del tema) --}}
    <div class="fixed inset-0 pointer-events-none overflow-hidden z-0" aria-hidden="true">
        @foreach(range(0, 5) as $i)
        <div class="absolute" style="left:{{ [8,22,38,55,72,88][$i] }}%;top:-30px;animation:floatDown {{ 8 + $i }}s linear {{ $i * 1.2 }}s infinite;opacity:0.15;font-size:{{ 18 + ($i % 3) * 4 }}px;">
            {{ mb_substr($decos, $i % mb_strlen($decos), 1) ?: '✨' }}
        </div>
        @endforeach
    </div>

    <div class="max-w-2xl mx-auto relative z-10">

        {{-- Header: ocasión --}}
        <div class="text-center mb-8">
            <div class="text-6xl mb-3" style="animation:heartbeat 2s ease-in-out infinite;">
                {{ $mensaje->ocasion->emoji ?? '💌' }}
            </div>
            <h1 style="color:{{ $accentColor }};font-family:'Playfair Display',serif;font-size:1.75rem;font-weight:900;margin-bottom:0.25rem;">
                {{ $mensaje->ocasion->nombre ?? 'Mensaje especial' }}
            </h1>
            <p style="color:{{ $textSoft }};font-size:0.875rem;">
                {{ $mensaje->ocasion->categoria->nombre ?? '' }}
            </p>
        </div>

        {{-- ═══ LA CARTA ═══ --}}
        <div style="{{ $cardCss }} position:relative;overflow:hidden;">

            {{-- Barra superior del template --}}
            @if($barCss)
            <div style="{{ $barCss }}">{{ $barContent }}</div>
            @endif

            {{-- Arte SVG único del template (premium) - en área superior con desvanecido --}}
            <div style="position:absolute;top:0;left:0;right:0;height:60%;overflow:hidden;pointer-events:none;z-index:1;-webkit-mask-image:linear-gradient(to bottom,black 0%,black 75%,transparent 100%);mask-image:linear-gradient(to bottom,black 0%,black 75%,transparent 100%);">
                {!! $arte !!}
            </div>

            <div style="padding: clamp(1.5rem, 5vw, 3rem);position:relative;z-index:2;">

                {{-- Para: --}}
                <div style="text-align:center;margin-bottom:2rem;">
                    <p style="font-size:10px;text-transform:uppercase;letter-spacing:0.2em;color:{{ $accentColor }};font-weight:600;margin-bottom:4px;">
                        Un mensaje para
                    </p>
                    <h2 style="font-family:'Playfair Display',serif;font-size:clamp(1.6rem,5vw,2.6rem);font-weight:900;color:{{ $titleColor }};line-height:1.15;word-break:break-word;overflow-wrap:break-word;hyphens:auto;max-width:100%;">
                        {{ \Illuminate\Support\Str::limit($mensaje->destinatario, 40) }}
                    </h2>
                </div>

                {{-- Imagen especial --}}
                @if($mensaje->imagen_path)
                <div style="display:flex;justify-content:center;margin-bottom:2rem;">
                    <div style="{{ $estiloMarco }}">
                        <div style="width:clamp(140px,35vw,200px);height:clamp(140px,35vw,200px);overflow:hidden;{{ $estiloForma }}">
                            <img src="{{ Storage::url($mensaje->imagen_path) }}"
                                 alt="Foto especial"
                                 style="width:100%;height:100%;object-fit:cover;"
                                 loading="lazy">
                        </div>
                    </div>
                </div>
                @endif

                {{-- El mensaje --}}
                @php
                $msgBg = ($msgBgColor && $msgBgColor !== 'transparent' && $msgBgColor !== '')
                    ? "background:{$msgBgColor};border-radius:1rem;padding:1.25rem;"
                    : "padding: 0.5rem 0;";
                @endphp
                <div style="{{ $msgBg }} margin-bottom:1.5rem;">
                    <div style="color:{{ $bodyColor }};line-height:1.9;font-size:clamp(0.95rem,2.5vw,1.1rem);font-family:'Nunito',sans-serif;">
                        {!! $mensaje->mensaje !!}
                    </div>
                </div>

                {{-- Firma --}}
                <div style="text-align:right;margin-bottom:1.5rem;padding-top:1rem;border-top:1px solid {{ $borderSoft }};">
                    <p style="font-size:0.75rem;color:{{ $textSoft }};margin-bottom:4px;">Con todo mi amor,</p>
                    <p style="font-family:'Dancing Script',cursive;font-size:clamp(1.4rem,4vw,1.9rem);font-weight:700;color:{{ $firmaColor }};word-break:break-word;">
                        {{ \Illuminate\Support\Str::limit($mensaje->remitente, 50) }}
                    </p>
                </div>

                {{-- Footer de la carta --}}
                <div style="display:flex;align-items:center;justify-content:space-between;font-size:0.7rem;color:{{ $textSoft }};padding-top:0.75rem;border-top:1px solid {{ $borderSoft }};">
                    <span>💌 Mensajes para Todos</span>
                    <span>{{ $mensaje->created_at->translatedFormat('d \d\e F \d\e Y') }}</span>
                </div>
            </div>
        </div>

        {{-- Player de música --}}
        @if($mensaje->youtube_url)
        <div class="mt-6" x-data="musicPlayer()" x-init="init()">
            <div style="{{ $isDark ? 'background:rgba(255,255,255,0.08);border:1px solid rgba(255,255,255,0.12);' : 'background:white;border:1px solid #ede9fe;' }} border-radius:1rem;padding:1rem 1.25rem;display:flex;align-items:center;gap:1rem;box-shadow:0 4px 20px rgba(0,0,0,0.1);">
                <button @click="toggle()"
                        style="width:3rem;height:3rem;border-radius:50%;background:{{ $accentColor }};border:none;cursor:pointer;display:flex;align-items:center;justify-content:center;flex-shrink:0;transition:opacity 0.2s;"
                        onmouseenter="this.style.opacity='0.85'" onmouseleave="this.style.opacity='1'">
                    <svg x-show="!playing" style="width:1.25rem;height:1.25rem;color:white;margin-left:2px;" fill="white" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
                    <svg x-show="playing" style="width:1.25rem;height:1.25rem;" fill="white" viewBox="0 0 24 24"><path d="M6 19h4V5H6v14zm8-14v14h4V5h-4z"/></svg>
                </button>
                <div style="flex:1;min-width:0;">
                    <p style="font-weight:600;font-size:0.875rem;color:{{ $isDark ? 'rgba(255,255,255,0.9)' : '#374151' }};margin:0 0 2px;">🎵 Canción de fondo</p>
                    <p style="font-size:0.75rem;color:{{ $textSoft }};overflow:hidden;text-overflow:ellipsis;white-space:nowrap;margin:0;">{{ $mensaje->youtube_url }}</p>
                </div>
                <div style="width:0.6rem;height:0.6rem;border-radius:50%;flex-shrink:0;transition:background 0.3s;" :style="playing ? 'background:#34d399;box-shadow:0 0 6px #34d399' : 'background:#d1d5db'"></div>
            </div>
            <div class="hidden"><div id="yt-player"></div></div>
        </div>
        @endif

        {{-- CTA --}}
        <div style="margin-top:2.5rem;text-align:center;">
            <p style="color:{{ $textSoft }};font-size:0.875rem;margin-bottom:0.75rem;">¿Quieres crear uno para alguien especial?</p>
            <a href="{{ route('home') }}"
               style="display:inline-block;padding:0.875rem 1.75rem;background:{{ $accentColor }};color:white;font-weight:700;border-radius:9999px;text-decoration:none;font-size:0.9rem;transition:opacity 0.2s;box-shadow:0 4px 20px rgba(0,0,0,0.2);"
               onmouseenter="this.style.opacity='0.85'" onmouseleave="this.style.opacity='1'">
                💌 Crear mi mensaje
            </a>
        </div>

    </div>
</div>

<style>
@keyframes floatDown {
    0%   { transform: translateY(-30px) rotate(0deg);   opacity: 0; }
    10%  { opacity: 0.15; }
    90%  { opacity: 0.15; }
    100% { transform: translateY(110vh) rotate(360deg); opacity: 0; }
}
@keyframes heartbeat {
    0%,100% { transform: scale(1); }
    14%     { transform: scale(1.15); }
    28%     { transform: scale(1); }
    42%     { transform: scale(1.08); }
    56%     { transform: scale(1); }
}
.mensaje-contenido a { color: {{ $accentColor }}; text-decoration: underline; }
</style>
@endsection

@push('scripts')
@if($mensaje->youtube_url)
<script>
function musicPlayer() {
    return {
        playing: false, player: null, videoId: null,
        init() {
            const url = '{{ addslashes($mensaje->youtube_url) }}';
            const match = url.match(/(?:v=|youtu\.be\/)([A-Za-z0-9_-]{11})/);
            if (!match) return;
            this.videoId = match[1];
            window.onYouTubeIframeAPIReady = () => {
                this.player = new YT.Player('yt-player', {
                    height: '1', width: '1', videoId: this.videoId,
                    playerVars: { autoplay: 0, loop: 1 },
                    events: { onStateChange: (e) => { this.playing = e.data === YT.PlayerState.PLAYING; } }
                });
            };
            const tag = document.createElement('script');
            tag.src = 'https://www.youtube.com/iframe_api';
            document.head.appendChild(tag);
        },
        toggle() {
            if (!this.player) return;
            this.playing ? this.player.pauseVideo() : this.player.playVideo();
        }
    }
}
</script>
@endif
@endpush
