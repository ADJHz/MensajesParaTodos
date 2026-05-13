{{--
  Componente: Live Preview del mensaje
  Se monta como panel lateral en desktop, drawer bottom en móvil
  Escucha cambios en Alpine via @watch y events
--}}

<div x-data="livePreview()"
     @template-changed.window="template = $event.detail; renderPreview()"
     @preview-update.window="actualizarData($event.detail)"
     class="live-preview-root">

    {{-- ===== BOTÓN FLOTANTE (solo móvil y tablet) ===== --}}
    <button type="button"
            @click="abierto = !abierto"
            class="fixed bottom-5 right-4 z-50 lg:hidden flex items-center gap-2 px-4 py-3 bg-violet-600 text-white font-bold rounded-full shadow-2xl hover:bg-violet-700 transition-all hover:scale-105 active:scale-95">
        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
            <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
        </svg>
        <span x-text="abierto ? 'Cerrar vista previa' : 'Ver vista previa'">Ver vista previa</span>
        {{-- Indicador de pulso --}}
        <span class="relative flex h-2.5 w-2.5">
            <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-pink-300 opacity-75"></span>
            <span class="relative inline-flex rounded-full h-2.5 w-2.5 bg-pink-400"></span>
        </span>
    </button>

    {{-- ===== DRAWER MÓVIL / TABLET ===== --}}
    <div x-show="abierto"
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="translate-y-full opacity-0"
         x-transition:enter-end="translate-y-0 opacity-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="translate-y-0 opacity-100"
         x-transition:leave-end="translate-y-full opacity-0"
         class="fixed inset-x-0 bottom-0 z-50 lg:hidden"
         style="height: 85dvh; height: 85vh;"
         @click.outside="abierto = false">

        <div class="h-full bg-white rounded-t-3xl shadow-2xl flex flex-col overflow-hidden border-t-2 border-violet-100">

            {{-- Handle --}}
            <div class="flex justify-center pt-3 pb-1 flex-shrink-0">
                <div class="w-10 h-1 bg-gray-300 rounded-full"></div>
            </div>

            {{-- Header drawer --}}
            <div class="flex items-center justify-between px-5 pb-3 border-b border-gray-100 flex-shrink-0">
                <div class="flex items-center gap-2">
                    <div class="w-2 h-2 rounded-full bg-green-400 animate-pulse"></div>
                    <span class="font-bold text-gray-700 text-sm">Vista previa en vivo</span>
                </div>
                <button type="button" @click="abierto = false" class="text-gray-400 hover:text-gray-600 transition p-1">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>

            {{-- Contenido preview scrollable --}}
            <div class="flex-1 overflow-y-auto">
                <div id="live-preview-mobile" class="min-h-full preview-scale-mobile">
                    <x-preview-placeholder />
                </div>
            </div>
        </div>
    </div>

    {{-- Overlay backdrop móvil --}}
    <div x-show="abierto" @click="abierto = false"
         x-transition:enter="transition-opacity duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition-opacity duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         class="fixed inset-0 bg-black/30 z-40 lg:hidden backdrop-blur-sm">
    </div>
</div>

<style>
.preview-scale-mobile {
    transform-origin: top center;
}
</style>

<script>
function livePreview() {
    return {
        abierto: false,
        template: 'clasico',
        data: {
            destinatario: '',
            remitente: '',
            mensajeHTML: '',
            imagenPreview: null,
            imagenForma: 'circulo',
            imagenMarco: 'ninguno',
        },
        debounceTimer: null,

        actualizarData(detail) {
            this.data = { ...this.data, ...detail };
            this.template = detail.template || this.template;
            clearTimeout(this.debounceTimer);
            this.debounceTimer = setTimeout(() => this.renderPreview(), 120);
        },

        renderPreview() {
            const containers = [
                document.getElementById('live-preview-mobile'),
                document.getElementById('live-preview-desktop'),
            ];

            const html = this.buildPreviewHTML();
            containers.forEach(c => { if (c) c.innerHTML = html; });
        },

        buildPreviewHTML() {
            const d = this.data;
            const t = this.template;

            const formas = {
                'ninguna': '', 'cuadrado': 'border-radius:16px;', 'circulo': 'border-radius:50%;',
                'corazon': 'clip-path:url(#cp-heart);', 'estrella': 'clip-path:url(#cp-star);',
                'hexagono': 'clip-path:url(#cp-hexagon);', 'diamante': 'clip-path:url(#cp-diamond);',
            };
            const marcos = {
                'ninguno': '', 'morado': 'filter:drop-shadow(0 0 8px #7C3AED);',
                'dorado': 'filter:drop-shadow(0 0 8px #F59E0B);', 'rosa': 'filter:drop-shadow(0 0 8px #F472B6);',
                'verde': 'filter:drop-shadow(0 0 8px #10B981);', 'sombra': 'filter:drop-shadow(4px 6px 14px rgba(0,0,0,0.45));',
                'blanco': 'filter:drop-shadow(0 0 8px #fff);',
            };

            const estiloForma = formas[d.imagenForma] || '';
            const estiloMarco = marcos[d.imagenMarco] || '';
            const imgHtml = d.imagenPreview
                ? `<div style="${estiloMarco}" class="flex justify-center my-3"><div style="width:80px;height:80px;overflow:hidden;${estiloForma}"><img src="${d.imagenPreview}" style="width:100%;height:100%;object-fit:cover;" alt=""></div></div>`
                : '';

            const configs = {
                'clasico': {
                    wrap: 'background:#F8F6FF;',
                    card: 'background:white;border-radius:1.5rem;border:1px solid #ede9fe;overflow:hidden;box-shadow:0 20px 40px rgba(0,0,0,0.08);',
                    header: `<div style="height:4px;background:linear-gradient(90deg,#7C3AED,#EC4899);"></div>`,
                    titleColor: '#1f2937', accent: '#7C3AED', bg: '#F5F3FF',
                    firma: `<p style="color:#7C3AED;font-style:italic;font-size:1.1em;font-weight:700;">${d.remitente || 'Tu nombre'}</p>`,
                },
                'rosa-floral': {
                    wrap: 'background:linear-gradient(135deg,#fdf2f8,#fff1f2);',
                    card: 'background:rgba(255,255,255,0.92);border-radius:2rem;border:2px solid #fce7f3;overflow:hidden;box-shadow:0 20px 40px rgba(244,114,182,0.15);',
                    header: `<div style="background:linear-gradient(90deg,#f472b6,#fb7185);padding:1rem;text-align:center;"><span style="font-size:2rem;">🌸</span></div>`,
                    titleColor: '#fff', titleBg: 'linear-gradient(90deg,#f472b6,#fb7185)', accent: '#f472b6', bg: '#fce7f3',
                    firma: `<p style="color:#f43f5e;font-style:italic;font-size:1.1em;font-weight:700;text-align:center;">${d.remitente || 'Tu nombre'}</p>`,
                },
                'galaxia': {
                    wrap: 'background:#0B0B2B;',
                    card: 'background:rgba(255,255,255,0.07);border-radius:1.5rem;border:1px solid rgba(255,255,255,0.1);backdrop-filter:blur(20px);box-shadow:0 25px 60px rgba(0,0,0,0.5);',
                    header: `<div style="height:1px;background:linear-gradient(90deg,transparent,#A78BFA,transparent);"></div>`,
                    titleColor: '#fff', accent: '#A78BFA', bg: 'rgba(255,255,255,0.05)', textColor: 'rgba(255,255,255,0.9)',
                    firma: `<p style="color:#A78BFA;font-style:italic;font-size:1.1em;font-weight:700;">${d.remitente || 'Tu nombre'}</p>`,
                },
                'vintage': {
                    wrap: 'background:#F5ECD7;',
                    card: 'background:#FFFBF0;border-radius:1rem;border:1px solid #DDD0A8;box-shadow:4px 6px 20px rgba(0,0,0,0.15);',
                    header: '',
                    titleColor: '#1f2937', accent: '#C8A96E', bg: 'transparent', titleFont: 'Georgia,serif',
                    firma: `<p style="color:#92400e;font-style:italic;font-size:1.2em;font-weight:700;font-family:'Dancing Script',cursive,Georgia;">${d.remitente || 'Tu nombre'}</p>`,
                },
                'minimalista': {
                    wrap: 'background:white;',
                    card: 'background:white;border-left:4px solid #7C3AED;padding-left:1.5rem;',
                    header: '',
                    titleColor: '#111827', accent: '#7C3AED', bg: 'transparent',
                    firma: `<div style="display:flex;align-items:center;gap:0.75rem;border-top:1px solid #f3f4f6;padding-top:1rem;"><div style="width:2rem;height:2rem;border-radius:50%;background:linear-gradient(135deg,#7C3AED,#EC4899);display:flex;align-items:center;justify-content:center;color:white;font-weight:700;">${(d.remitente||'A').charAt(0).toUpperCase()}</div><span style="font-weight:700;color:#1f2937;">${d.remitente || 'Tu nombre'}</span></div>`,
                },
                'fiesta': {
                    wrap: 'background:linear-gradient(135deg,#FFF7ED,#FEF3C7,#ECFDF5);',
                    card: 'background:rgba(255,255,255,0.95);border-radius:1.5rem;border:2px solid #fde68a;overflow:hidden;box-shadow:0 20px 40px rgba(0,0,0,0.1);',
                    header: `<div style="background:linear-gradient(135deg,#FDE68A,#FCA5A5,#A5B4FC);padding:1rem;text-align:center;"><span style="font-size:2rem;">🎉</span></div>`,
                    titleColor: '#fff', titleBg: 'linear-gradient(135deg,#FDE68A,#FCA5A5,#A5B4FC)', accent: '#F59E0B', bg: '#FFF7ED',
                    firma: `<p style="color:#d97706;font-weight:700;font-size:1.1em;">${d.remitente || 'Tu nombre'} 🎊</p>`,
                },
            };

            const cfg = configs[t] || configs['clasico'];
            const textColor = cfg.textColor || '#374151';
            const msgBg = cfg.bg !== 'transparent' ? `background:${cfg.bg};border-radius:1rem;padding:1.25rem;` : 'padding:0.5rem 0;';

            return `
<div style="${cfg.wrap}min-height:100%;padding:1.5rem;display:flex;align-items:center;justify-content:center;">
  <div style="${cfg.card}width:100%;max-width:480px;">
    ${cfg.header}
    <div style="padding:1.5rem;">
      <p style="font-size:10px;text-transform:uppercase;letter-spacing:0.15em;color:${cfg.accent};margin-bottom:4px;">Para</p>
      <h2 style="font-size:1.5em;font-weight:900;color:${cfg.titleColor};${cfg.titleFont ? 'font-family:'+cfg.titleFont+';' : ''}margin-bottom:1rem;line-height:1.2;">${d.destinatario || 'Nombre del destinatario'}</h2>
      ${imgHtml}
      <div style="${msgBg}margin-bottom:1rem;">
        <div style="color:${textColor};line-height:1.7;font-size:0.95em;">${d.mensajeHTML || '<span style="color:#9ca3af">Tu mensaje aparecerá aquí mientras escribes...</span>'}</div>
      </div>
      ${cfg.firma}
    </div>
  </div>
</div>`;
        },
    };
}
</script>
