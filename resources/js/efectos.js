// ─────────────────────────────────────────────────────────────────────────────
// Motor de efectos visuales por tema (tsParticles + canvas-confetti).
// Se inicializa automáticamente cuando un partial define <div data-fx-tema="...">
// ─────────────────────────────────────────────────────────────────────────────
import { tsParticles } from '@tsparticles/engine';
import { loadSlim } from '@tsparticles/slim';
import { loadFireworksPreset } from '@tsparticles/preset-fireworks';
import { loadConfettiPreset } from '@tsparticles/preset-confetti';
import { loadSnowPreset } from '@tsparticles/preset-snow';
import confetti from 'canvas-confetti';

let initialized = false;
async function ensureInit() {
    if (initialized) return;
    await loadSlim(tsParticles);
    await loadFireworksPreset(tsParticles);
    await loadConfettiPreset(tsParticles);
    await loadSnowPreset(tsParticles);
    initialized = true;
}

// ─────────────────── Configuración por tema ────────────────────
const TEMAS = {
    princesa: {
        background: { color: { value: 'transparent' } },
        fpsLimit: 60,
        particles: {
            number: { value: 70, density: { enable: true } },
            color: { value: ['#f9a8d4', '#fbcfe8', '#f472b6', '#fde68a', '#ffffff'] },
            shape: { type: ['circle', 'star'] },
            opacity: {
                value: { min: 0.3, max: 0.9 },
                animation: { enable: true, speed: 1, sync: false },
            },
            size: { value: { min: 1, max: 4 } },
            move: {
                enable: true,
                speed: { min: 0.4, max: 1.5 },
                direction: 'top',
                outModes: { default: 'out' },
                straight: false,
            },
            twinkle: {
                particles: { enable: true, frequency: 0.05, opacity: 1 },
            },
        },
        emitters: {
            position: { x: 50, y: 100 },
            rate: { delay: 0.4, quantity: 2 },
        },
    },

    superheroe: {
        background: { color: { value: 'transparent' } },
        fpsLimit: 60,
        particles: {
            number: { value: 60 },
            color: { value: ['#fbbf24', '#f59e0b', '#ef4444', '#3b82f6'] },
            shape: { type: 'star' },
            opacity: { value: 0.7 },
            size: { value: { min: 2, max: 5 } },
            move: { enable: true, speed: 2, direction: 'none', outModes: { default: 'bounce' } },
            links: { enable: true, distance: 120, color: '#fbbf24', opacity: 0.25, width: 1 },
        },
        interactivity: {
            events: { onHover: { enable: true, mode: 'repulse' } },
            modes: { repulse: { distance: 100 } },
        },
    },

    autos: {
        background: { color: { value: 'transparent' } },
        fpsLimit: 60,
        particles: {
            number: { value: 80 },
            color: { value: ['#ffffff', '#fbbf24'] },
            shape: { type: 'circle' },
            opacity: { value: 0.5 },
            size: { value: { min: 1, max: 2.5 } },
            move: { enable: true, speed: 8, direction: 'left', straight: true, outModes: { default: 'out' } },
        },
    },

    cuento: {
        background: { color: { value: 'transparent' } },
        fpsLimit: 60,
        particles: {
            number: { value: 50 },
            color: { value: ['#ffffff', '#fef3c7', '#bfdbfe'] },
            shape: { type: 'circle' },
            opacity: {
                value: { min: 0.2, max: 0.7 },
                animation: { enable: true, speed: 0.6, sync: false },
            },
            size: { value: { min: 1, max: 3 } },
            move: { enable: true, speed: 0.6, direction: 'top', outModes: { default: 'out' }, straight: false },
        },
    },

    mama: {
        background: { color: { value: 'transparent' } },
        fpsLimit: 60,
        particles: {
            number: { value: 50 },
            color: { value: ['#ec4899', '#f472b6', '#fbcfe8'] },
            shape: { type: 'character', character: { value: ['♥', '✿', '❀'], font: 'Verdana', weight: '700' } },
            opacity: { value: { min: 0.4, max: 0.9 } },
            size: { value: { min: 6, max: 16 } },
            move: { enable: true, speed: 1.2, direction: 'top', outModes: { default: 'out' }, straight: false },
        },
    },

    papa: {
        background: { color: { value: 'transparent' } },
        fpsLimit: 60,
        particles: {
            number: { value: 35 },
            color: { value: ['#1e3a8a', '#3b82f6', '#0f172a'] },
            shape: { type: 'circle' },
            opacity: { value: 0.5 },
            size: { value: { min: 2, max: 4 } },
            move: { enable: true, speed: 1, direction: 'none', outModes: { default: 'bounce' } },
            links: { enable: true, distance: 140, color: '#3b82f6', opacity: 0.2, width: 1 },
        },
    },

    abuelo: {
        background: { color: { value: 'transparent' } },
        fpsLimit: 60,
        particles: {
            number: { value: 35 },
            color: { value: ['#d97706', '#92400e', '#a16207'] },
            shape: { type: 'character', character: { value: ['🍂', '🍁', '🍃'], font: 'Verdana' } },
            opacity: { value: 0.85 },
            size: { value: { min: 10, max: 18 } },
            move: { enable: true, speed: 2, direction: 'bottom-right', outModes: { default: 'out' }, straight: false },
            rotate: { value: { min: 0, max: 360 }, animation: { enable: true, speed: 8, sync: false } },
            wobble: { enable: true, distance: 20, speed: 8 },
        },
    },

    amistad: {
        background: { color: { value: 'transparent' } },
        fpsLimit: 60,
        particles: {
            number: { value: 60 },
            color: { value: ['#fbbf24', '#34d399', '#60a5fa', '#f472b6', '#a78bfa'] },
            shape: { type: 'circle' },
            opacity: { value: 0.6 },
            size: { value: { min: 3, max: 6 } },
            move: { enable: true, speed: 1.5, direction: 'none', outModes: { default: 'bounce' } },
            links: { enable: true, distance: 130, color: '#ffffff', opacity: 0.35, width: 1 },
        },
        interactivity: {
            events: { onHover: { enable: true, mode: 'grab' } },
            modes: { grab: { distance: 160, links: { opacity: 0.6 } } },
        },
    },

    hermano: {
        background: { color: { value: 'transparent' } },
        fpsLimit: 60,
        particles: {
            number: { value: 70 },
            color: { value: ['#fbbf24', '#ef4444', '#3b82f6'] },
            shape: { type: ['star', 'circle'] },
            opacity: { value: { min: 0.4, max: 0.9 } },
            size: { value: { min: 2, max: 5 } },
            move: { enable: true, speed: 2.5, direction: 'none', outModes: { default: 'bounce' } },
            twinkle: { particles: { enable: true, frequency: 0.05, opacity: 1 } },
        },
    },

    amor: {
        background: { color: { value: 'transparent' } },
        fpsLimit: 60,
        particles: {
            number: { value: 70 },
            color: { value: ['#dc2626', '#e11d48', '#fb7185', '#f43f5e'] },
            shape: { type: 'character', character: { value: ['❤', '♥', '❥'], font: 'Verdana', weight: '700' } },
            opacity: { value: { min: 0.5, max: 1 } },
            size: { value: { min: 8, max: 18 } },
            move: { enable: true, speed: 1.4, direction: 'top', outModes: { default: 'out' }, straight: false },
        },
    },

    cumpleanos: {
        preset: 'confetti',
    },

    graduacion: {
        background: { color: { value: 'transparent' } },
        fpsLimit: 60,
        particles: {
            number: { value: 60 },
            color: { value: ['#fbbf24', '#fde68a', '#0f172a', '#ffffff'] },
            shape: { type: ['star', 'circle'] },
            opacity: { value: { min: 0.4, max: 1 } },
            size: { value: { min: 2, max: 5 } },
            move: { enable: true, speed: 1.6, direction: 'top', outModes: { default: 'out' }, straight: false },
            twinkle: { particles: { enable: true, frequency: 0.07, opacity: 1 } },
        },
    },

    navidad: {
        preset: 'snow',
    },

    'ano-nuevo': {
        preset: 'fireworks',
    },

    quinceanera: {
        background: { color: { value: 'transparent' } },
        fpsLimit: 60,
        particles: {
            number: { value: 80 },
            color: { value: ['#fde68a', '#f9a8d4', '#ec4899', '#ffffff'] },
            shape: { type: ['star', 'circle'] },
            opacity: { value: { min: 0.5, max: 1 } },
            size: { value: { min: 2, max: 6 } },
            move: { enable: true, speed: 1.2, direction: 'top', outModes: { default: 'out' }, straight: false },
            twinkle: { particles: { enable: true, frequency: 0.08, opacity: 1 } },
        },
    },

    'dia-nino': {
        background: { color: { value: 'transparent' } },
        fpsLimit: 60,
        particles: {
            number: { value: 50 },
            color: { value: ['#fbbf24', '#f472b6', '#60a5fa', '#34d399'] },
            shape: { type: 'circle' },
            opacity: { value: 0.7 },
            size: { value: { min: 4, max: 8 } },
            move: { enable: true, speed: 1.5, direction: 'top', outModes: { default: 'out' }, straight: false },
        },
    },

    hearts: {
        background: { color: { value: 'transparent' } },
        fpsLimit: 60,
        particles: {
            number: { value: 40 },
            color: { value: ['#ec4899', '#fb7185'] },
            shape: { type: 'character', character: { value: ['♥'], font: 'Verdana' } },
            opacity: { value: { min: 0.5, max: 1 } },
            size: { value: { min: 8, max: 18 } },
            move: { enable: true, speed: 1.2, direction: 'top', outModes: { default: 'out' }, straight: false },
        },
    },
};

// ─────────────────── Init para todos los overlays ────────────────────
function getIntensidad() {
    return document.body.dataset.fxIntensidad
        || localStorage.getItem('fx-intensidad')
        || 'normal';
}

function escalarConfig(cfg, factor) {
    // Clon profundo simple via JSON (los configs son serializables)
    const out = JSON.parse(JSON.stringify(cfg));
    if (out.particles?.number?.value != null) {
        out.particles.number.value = Math.max(4, Math.round(out.particles.number.value * factor));
    }
    if (out.emitters?.rate?.quantity != null) {
        out.emitters.rate.quantity = Math.max(1, Math.round(out.emitters.rate.quantity * factor));
    }
    if (Array.isArray(out.emitters)) {
        out.emitters.forEach(e => {
            if (e?.rate?.quantity != null) e.rate.quantity = Math.max(1, Math.round(e.rate.quantity * factor));
        });
    }
    return out;
}

let cargados = []; // {id}

async function initEfectos() {
    const nodos = document.querySelectorAll('[data-fx-tema]');
    if (!nodos.length) return;
    if (window.matchMedia('(prefers-reduced-motion: reduce)').matches) return;

    const intensidad = getIntensidad();
    if (intensidad === 'off') return; // sin partículas
    const factor = intensidad === 'suave' ? 0.4 : intensidad === 'fiesta' ? 1.8 : 1;

    await ensureInit();

    // Limpiar instancias previas (si re-inicializa)
    cargados.forEach(c => { try { tsParticles.dom().find(p => p.id === c.id)?.destroy(); } catch (_) {} });
    cargados = [];

    nodos.forEach(async (nodo, i) => {
        const tema = nodo.dataset.fxTema;
        const base = TEMAS[tema] || TEMAS.hearts;
        const cfg  = escalarConfig(base, factor);
        const id = `fx-particles-${i}`;
        nodo.id = id;
        try {
            await tsParticles.load({ id, element: nodo, options: cfg });
            cargados.push({ id });
        } catch (e) {
            console.warn('tsParticles falló para tema', tema, e);
        }
    });
}

window.fxAplicarIntensidad = function (nivel) {
    const niveles = ['off', 'suave', 'normal', 'fiesta'];
    if (!niveles.includes(nivel)) nivel = 'normal';
    document.body.dataset.fxIntensidad = nivel;
    localStorage.setItem('fx-intensidad', nivel);
    initEfectos();
    if (nivel === 'fiesta') {
        window.fxConfettiBurst?.({ duration: 1500 });
    }
};

// ─────────────────── Confetti burst on demand ────────────────────
window.fxConfettiBurst = function (opts = {}) {
    const colors = opts.colors || ['#ec4899', '#fbbf24', '#60a5fa', '#34d399', '#a78bfa'];
    const duration = opts.duration ?? 1500;
    const end = Date.now() + duration;
    (function frame() {
        confetti({
            particleCount: 4,
            angle: 60,
            spread: 70,
            origin: { x: 0, y: 0.7 },
            colors,
        });
        confetti({
            particleCount: 4,
            angle: 120,
            spread: 70,
            origin: { x: 1, y: 0.7 },
            colors,
        });
        if (Date.now() < end) requestAnimationFrame(frame);
    })();
};

// ─────────────────── Celebraciones temáticas ────────────────────
// Capa para emojis flotantes (corazones, globos, pétalos, estrellas)
function getFloatLayer() {
    let layer = document.getElementById('fx-float-layer');
    if (!layer) {
        layer = document.createElement('div');
        layer.id = 'fx-float-layer';
        layer.setAttribute('aria-hidden', 'true');
        Object.assign(layer.style, {
            position: 'fixed', inset: '0', pointerEvents: 'none', zIndex: '9999',
            overflow: 'hidden',
        });
        document.body.appendChild(layer);

        // Inyectar keyframes una sola vez
        const style = document.createElement('style');
        style.textContent = `
            @keyframes fx-float-up {
                0%   { transform: translate(var(--tx-start, 0), 110vh) rotate(0) scale(var(--scale-start,1));   opacity: 0; }
                10%  { opacity: var(--max-opacity, .95); }
                50%  { transform: translate(calc(var(--tx-start, 0) + var(--sway, 30px)), 50vh) rotate(15deg); }
                100% { transform: translate(calc(var(--tx-start, 0) - var(--sway, 30px)), -15vh) rotate(-12deg) scale(var(--scale-end,1)); opacity: 0; }
            }
            @keyframes fx-balloon-rise {
                0%   { transform: translate(var(--tx,0), 110vh) rotate(0deg);  opacity: 0; }
                12%  { opacity: 1; }
                50%  { transform: translate(calc(var(--tx,0) + 18px), 45vh) rotate(4deg); }
                100% { transform: translate(calc(var(--tx,0) - 22px), -25vh) rotate(-6deg); opacity: 0; }
            }
            @keyframes fx-petal-fall {
                0%   { transform: translate(var(--tx,0), -10vh) rotate(0);    opacity: 0; }
                10%  { opacity: .9; }
                100% { transform: translate(calc(var(--tx,0) + var(--sway,40px)), 110vh) rotate(540deg); opacity: 0; }
            }
            @keyframes fx-star-pop {
                0%   { transform: translate(-50%,-50%) scale(0)   rotate(0);   opacity: 0; }
                25%  { transform: translate(-50%,-50%) scale(1.3) rotate(90deg);  opacity: 1; }
                100% { transform: translate(calc(-50% + var(--dx,0)), calc(-50% + var(--dy,0))) scale(.6) rotate(360deg); opacity: 0; }
            }
        `;
        document.head.appendChild(style);
    }
    return layer;
}

function spawnEmoji(emoji, opts = {}) {
    const layer = getFloatLayer();
    const el = document.createElement('div');
    el.textContent = emoji;
    const size  = opts.size  ?? (24 + Math.random() * 28);
    const dur   = opts.dur   ?? (4 + Math.random() * 4);
    const left  = opts.left  ?? (Math.random() * 100);
    const sway  = opts.sway  ?? (20 + Math.random() * 60);
    const anim  = opts.anim  ?? 'fx-float-up';
    const tx    = (Math.random() * 40 - 20) + 'px';

    Object.assign(el.style, {
        position: 'absolute',
        left: left + '%',
        top: '0',
        fontSize: size + 'px',
        lineHeight: '1',
        filter: 'drop-shadow(0 4px 8px rgba(0,0,0,.18))',
        animation: `${anim} ${dur}s cubic-bezier(.22,.61,.36,1) forwards`,
        '--tx': tx,
        '--tx-start': tx,
        '--sway': sway + 'px',
        '--scale-start': (0.6 + Math.random() * 0.5).toFixed(2),
        '--scale-end':   (0.8 + Math.random() * 0.8).toFixed(2),
        '--max-opacity': (0.85 + Math.random() * 0.15).toFixed(2),
    });
    layer.appendChild(el);
    setTimeout(() => el.remove(), dur * 1000 + 200);
}

function spawnBatch(emojis, count, opts = {}) {
    const intensidad = (document.body.dataset.fxIntensidad || 'normal');
    if (intensidad === 'off') return;
    const factor = ({ suave: 0.4, normal: 1, fiesta: 1.8 })[intensidad] ?? 1;
    const total = Math.max(3, Math.round(count * factor));
    for (let i = 0; i < total; i++) {
        const emoji = Array.isArray(emojis) ? emojis[i % emojis.length] : emojis;
        const delay = (i / total) * (opts.spread ?? 1500);
        setTimeout(() => spawnEmoji(emoji, opts), delay);
    }
}

/**
 * Celebración cinematográfica al abrir algo. Combina confeti + emojis temáticos.
 *
 *   window.fxCelebrar('corazones')
 *   window.fxCelebrar('globos')
 *   window.fxCelebrar('petalos')
 *   window.fxCelebrar('estrellas')
 *   window.fxCelebrar('fuegos')
 *   window.fxCelebrar('cumple')   // confeti + globos + 🎉
 *   window.fxCelebrar('amor')     // corazones + pétalos + confeti rosa
 *   window.fxCelebrar('navidad')  // copos + estrellas + confeti rojo/verde
 */
window.fxCelebrar = function (tema = 'confeti') {
    const intensidad = (document.body.dataset.fxIntensidad || 'normal');
    if (intensidad === 'off') return;

    switch (tema) {
        case 'corazones':
            spawnBatch(['❤️','💖','💕','💗','💝','💞'], 22, { spread: 1800, anim: 'fx-float-up' });
            window.fxConfettiBurst({ duration: 1200, colors: ['#ec4899','#f472b6','#fb7185','#fda4af','#fff'] });
            break;
        case 'globos':
            spawnBatch(['🎈','🎈','🎈','🎈','🎀'], 18, { spread: 2000, anim: 'fx-balloon-rise', size: 42 });
            window.fxConfettiBurst({ duration: 1500 });
            break;
        case 'petalos':
            spawnBatch(['🌸','🌺','🌷','🌼','🏵️','🌹'], 26, { spread: 2200, anim: 'fx-petal-fall' });
            window.fxConfettiBurst({ duration: 1200, colors: ['#f472b6','#fb7185','#fbcfe8','#fda4af','#a7f3d0'] });
            break;
        case 'estrellas':
            spawnBatch(['⭐','✨','🌟','💫'], 24, { spread: 1500, anim: 'fx-float-up', size: 30 });
            window.fxConfettiBurst({ duration: 1500, colors: ['#fde047','#facc15','#fbbf24','#fff'] });
            break;
        case 'fuegos':
            for (let i = 0; i < 5; i++) {
                setTimeout(() => {
                    const x = 0.2 + Math.random() * 0.6;
                    const y = 0.3 + Math.random() * 0.3;
                    confetti({
                        particleCount: 60,
                        startVelocity: 35,
                        spread: 360,
                        origin: { x, y },
                        colors: ['#ec4899','#fbbf24','#60a5fa','#34d399','#a78bfa','#fb7185'],
                        ticks: 200,
                        scalar: 1.1,
                    });
                }, i * 250);
            }
            break;
        case 'cumple':
            spawnBatch(['🎉','🎊','🎁','🎂','🍰','🎈','⭐'], 24, { spread: 1800 });
            window.fxConfettiBurst({ duration: 2200 });
            break;
        case 'amor':
            spawnBatch(['❤️','💖','🌹','💕','🌸','💝'], 26, { spread: 2000 });
            window.fxConfettiBurst({ duration: 1500, colors: ['#ec4899','#f472b6','#fda4af','#fff','#dc2626'] });
            break;
        case 'navidad':
            spawnBatch(['❄️','⭐','🎄','🎁','🔔'], 22, { spread: 2000 });
            window.fxConfettiBurst({ duration: 1800, colors: ['#dc2626','#16a34a','#facc15','#fff'] });
            break;
        case 'graduacion':
            spawnBatch(['🎓','📜','⭐','🏆'], 18, { spread: 1500 });
            window.fxConfettiBurst({ duration: 1800, colors: ['#1e40af','#facc15','#dc2626','#fff'] });
            break;
        case 'nina':
            spawnBatch(['🦄','👑','🌸','💖','🌷','🦋'], 22, { spread: 1800 });
            window.fxConfettiBurst({ duration: 1500, colors: ['#f472b6','#a78bfa','#fbcfe8','#fff','#fde047'] });
            break;
        case 'nino':
            spawnBatch(['🦸','🚀','⭐','💥','🔥','🦖'], 20, { spread: 1700 });
            window.fxConfettiBurst({ duration: 1500, colors: ['#dc2626','#1e40af','#facc15','#16a34a'] });
            break;
        case 'confeti':
        default:
            window.fxConfettiBurst({ duration: 1800 });
    }
};

window.fxCartaApertura = function ({ tema = 'confeti' } = {}) {
    const intensidad = (document.body.dataset.fxIntensidad || 'normal');
    if (intensidad === 'off') return;

    const lateral = {
        particleCount: intensidad === 'fiesta' ? 65 : 45,
        spread: intensidad === 'fiesta' ? 95 : 78,
        startVelocity: intensidad === 'fiesta' ? 44 : 34,
        ticks: 180,
        scalar: 1.05,
    };

    confetti({ ...lateral, origin: { x: 0.08, y: 0.88 }, angle: 55 });
    confetti({ ...lateral, origin: { x: 0.92, y: 0.88 }, angle: 125 });

    setTimeout(() => {
        window.fxCelebrar(tema);
    }, 140);

    if (tema === 'amor' || tema === 'corazones') {
        setTimeout(() => spawnBatch(['💫', '✨', '💖'], 12, { spread: 900, anim: 'fx-float-up', size: 26 }), 220);
    }
};

// Lanza confetti grande al cargar la página si la marca lo pide
document.addEventListener('DOMContentLoaded', () => {
    // Restaurar intensidad guardada
    const guardada = localStorage.getItem('fx-intensidad');
    if (guardada && !document.body.dataset.fxIntensidad) {
        document.body.dataset.fxIntensidad = guardada;
    }
    initEfectos();

    if (document.querySelector('[data-fx-celebrate]')) {
        setTimeout(() => window.fxConfettiBurst({ duration: 2200 }), 600);
    }
});
