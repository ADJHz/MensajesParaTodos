{{--
    Coreografía cinematográfica reutilizable para "abrir algo y mostrar la carta".

    Cómo usar:

      @include('mensajes.partials.reveal-fx')

    Luego en cualquier template:

      <section x-data="revealOpener({ delayHide: 1300, delayReveal: 2200 })"
               x-show="!hidden"
               class="reveal-opener">
          <div :class="{ 'opened': opened, 'leaving': leaving }"
               @click="abrir()"
               @keydown.enter="abrir()"
               role="button" tabindex="0">
              ... (sobre / caja / pergamino) ...
          </div>
      </section>

      <article x-data="revealLetter()"
               x-show="show"
               :class="{ 'is-revealing': show }"
               class="reveal-letter">
          ... contenido de la carta ...
      </article>

    Parámetros revealOpener:
      - delayHide:   ms hasta empezar a desvanecer el opener (default 1300)
      - delayReveal: ms hasta disparar el evento de mostrar la carta (default 2200)
      - delayUnmount: ms hasta remover el opener del DOM (default 2500)
      - event:       nombre del evento custom (default 'tpl-carta-abierta')
--}}
@once
<style>
    /* === Salida cinematográfica del opener (sobre/caja/pergamino/etc.) === */
    .reveal-opener { will-change: transform, opacity, filter; }
    .reveal-opener .reveal-opener-target,
    .reveal-opener > [data-reveal-target],
    .reveal-opener > div:first-child {
        transition: transform .5s cubic-bezier(.22,.61,.36,1), filter .6s ease;
    }
    @keyframes reveal-leave {
        0%   { transform: translateY(0)   rotate(0)    scale(1);  opacity: 1; filter: blur(0); }
        40%  { transform: translateY(-14px) rotate(-1.5deg) scale(1.01); opacity: 1; filter: blur(0); }
        100% { transform: translateY(-90px) rotate(2deg)   scale(.82); opacity: 0; filter: blur(1.5px); }
    }
    .reveal-opener.is-leaving > * { animation: reveal-leave 1.1s cubic-bezier(.45,.05,.35,1) forwards; }

    /* === Entrada de la carta === */
    @keyframes reveal-letter-rise {
        0%   { opacity: 0; transform: translateY(60px) scale(.96); filter: blur(3px); }
        60%  { opacity: 1; filter: blur(0); }
        100% { opacity: 1; transform: translateY(0)    scale(1);   filter: blur(0); }
    }
    .reveal-letter.is-revealing { animation: reveal-letter-rise 1.1s cubic-bezier(.22,.61,.36,1) both; }

    @keyframes reveal-letter-glow {
        0% { box-shadow: 0 0 0 rgba(255,255,255,0); }
        35% { box-shadow: 0 0 0 4px rgba(255,255,255,.15), 0 0 40px rgba(124,58,237,.22); }
        100% { box-shadow: 0 0 0 rgba(255,255,255,0); }
    }
    .reveal-letter.is-revealing { animation: reveal-letter-rise 1.1s cubic-bezier(.22,.61,.36,1) both, reveal-letter-glow 1.4s ease-out both; }

    @keyframes reveal-impact-flash {
        0% { opacity: 0; transform: scale(.98); }
        22% { opacity: .35; transform: scale(1); }
        100% { opacity: 0; transform: scale(1.03); }
    }
    body.reveal-impact::after {
        content: '';
        position: fixed;
        inset: 0;
        pointer-events: none;
        z-index: 90;
        background: radial-gradient(circle at center, rgba(255,255,255,.45) 0%, rgba(255,255,255,.2) 20%, rgba(124,58,237,.16) 52%, rgba(0,0,0,0) 72%);
        animation: reveal-impact-flash .9s ease-out forwards;
    }

    /* Si el usuario prefiere reduced motion, mostramos sin animar */
    @media (prefers-reduced-motion: reduce) {
        .reveal-opener.is-leaving > * { animation: none; opacity: 0; }
        .reveal-letter.is-revealing { animation: none; }
    }
</style>

<script>
    window.revealOpener = function (cfg = {}) {
        const delayHide    = cfg.delayHide    ?? 1300;
        const delayReveal  = cfg.delayReveal  ?? 2200;
        const delayUnmount = cfg.delayUnmount ?? 2500;
        const eventName    = cfg.event        ?? 'tpl-carta-abierta';
        const tema         = cfg.tema         ?? null;   // 'corazones'|'globos'|'cumple'|'amor'|'navidad'|'estrellas'|'fuegos'|'petalos'|'graduacion'|'nina'|'nino'
        const delayCelebra = cfg.delayCelebra ?? 100;    // ms desde el click hasta lanzar fx
        return {
            opened: false,
            leaving: false,
            hidden: false,
            abrir() {
                if (this.opened) return;
                this.opened = true;

                // Celebración temática (confeti + emojis flotantes)
                if (tema && typeof window.fxCelebrar === 'function') {
                    setTimeout(() => window.fxCelebrar(tema), delayCelebra);
                    setTimeout(() => window.fxCelebrar(tema), delayCelebra + 700);
                }

                // Impacto visual global al abrir (aplica a todos los templates que usan este partial)
                document.body.classList.add('reveal-impact');
                setTimeout(() => document.body.classList.remove('reveal-impact'), 950);

                if (typeof window.fxCartaApertura === 'function') {
                    setTimeout(() => window.fxCartaApertura({ tema }), Math.max(60, delayCelebra - 40));
                }

                setTimeout(() => {
                    this.leaving = true;
                    this.$el.classList.add('is-leaving');
                }, delayHide);
                setTimeout(() => {
                    window.dispatchEvent(new CustomEvent(eventName));
                }, delayReveal);
                setTimeout(() => { this.hidden = true; }, delayUnmount);
            }
        };
    };

    window.revealLetter = function (cfg = {}) {
        const eventName = cfg.event ?? 'tpl-carta-abierta';
        return {
            show: false,
            init() {
                window.addEventListener(eventName, () => { this.show = true; });
            }
        };
    };
</script>
@endonce
