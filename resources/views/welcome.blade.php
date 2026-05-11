<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Celebramos el Día de las Mamás - 10 de Mayo. GraciasMadre, un tributo especial para las mamás más increíbles del mundo.">
    <title>GraciasMadre — Feliz Día de las Mamás 💐</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,700;0,900;1,400;1,700&family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-body overflow-x-hidden" style="background-color: #FFF9F5; color: #4A3728;">

    <!-- ============================================================
         SECCIÓN 1: HERO
    ============================================================ -->
    <section class="relative min-h-screen flex flex-col items-center justify-center overflow-hidden px-4 py-20 text-center"
             aria-labelledby="hero-heading"
             style="background: linear-gradient(135deg, #FFD6E0 0%, #FFB8D0 40%, #FFE4BA 100%);">

        <!-- Flores flotantes -->
        <div class="hidden sm:block absolute top-10 left-10 w-16 sm:w-20 h-16 sm:h-20 opacity-70 animate-float-slow" style="animation-delay: 0s;">
            <svg viewBox="0 0 80 80" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" role="presentation">
                <g transform="translate(40,40)">
                    <ellipse rx="8" ry="20" fill="#FFB8D0" transform="rotate(0)"/>
                    <ellipse rx="8" ry="20" fill="#FFB8D0" transform="rotate(72)"/>
                    <ellipse rx="8" ry="20" fill="#F4A0BF" transform="rotate(144)"/>
                    <ellipse rx="8" ry="20" fill="#F4A0BF" transform="rotate(216)"/>
                    <ellipse rx="8" ry="20" fill="#FFB8D0" transform="rotate(288)"/>
                    <circle r="10" fill="#FFE4BA"/>
                </g>
            </svg>
        </div>

        <div class="hidden sm:block absolute top-24 right-16 w-14 h-14 opacity-60 animate-float-medium" style="animation-delay: 1.5s;">
            <svg viewBox="0 0 80 80" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" role="presentation">
                <g transform="translate(40,40)">
                    <ellipse rx="8" ry="20" fill="#FFB8D0" transform="rotate(0)"/>
                    <ellipse rx="8" ry="20" fill="#FFB8D0" transform="rotate(72)"/>
                    <ellipse rx="8" ry="20" fill="#F4A0BF" transform="rotate(144)"/>
                    <ellipse rx="8" ry="20" fill="#F4A0BF" transform="rotate(216)"/>
                    <ellipse rx="8" ry="20" fill="#FFB8D0" transform="rotate(288)"/>
                    <circle r="10" fill="#FFE4BA"/>
                </g>
            </svg>
        </div>

        <div class="hidden md:block absolute bottom-24 left-1/4 w-12 h-12 opacity-50 animate-float-slow" style="animation-delay: 2.5s;">
            <svg viewBox="0 0 80 80" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" role="presentation">
                <g transform="translate(40,40)">
                    <ellipse rx="8" ry="20" fill="#FFB8D0" transform="rotate(0)"/>
                    <ellipse rx="8" ry="20" fill="#FFB8D0" transform="rotate(72)"/>
                    <ellipse rx="8" ry="20" fill="#F4A0BF" transform="rotate(144)"/>
                    <ellipse rx="8" ry="20" fill="#F4A0BF" transform="rotate(216)"/>
                    <ellipse rx="8" ry="20" fill="#FFB8D0" transform="rotate(288)"/>
                    <circle r="10" fill="#FFE4BA"/>
                </g>
            </svg>
        </div>

        <div class="hidden sm:block absolute bottom-40 right-12 w-16 h-16 opacity-60 animate-float-medium" style="animation-delay: 0.8s;">
            <svg viewBox="0 0 80 80" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" role="presentation">
                <g transform="translate(40,40)">
                    <ellipse rx="8" ry="20" fill="#FFB8D0" transform="rotate(0)"/>
                    <ellipse rx="8" ry="20" fill="#FFB8D0" transform="rotate(72)"/>
                    <ellipse rx="8" ry="20" fill="#F4A0BF" transform="rotate(144)"/>
                    <ellipse rx="8" ry="20" fill="#F4A0BF" transform="rotate(216)"/>
                    <ellipse rx="8" ry="20" fill="#FFB8D0" transform="rotate(288)"/>
                    <circle r="10" fill="#FFE4BA"/>
                </g>
            </svg>
        </div>

        <div class="hidden md:block absolute top-1/2 left-6 w-10 h-10 opacity-40 animate-float-slow" style="animation-delay: 3.2s;">
            <svg viewBox="0 0 80 80" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" role="presentation">
                <g transform="translate(40,40)">
                    <ellipse rx="8" ry="20" fill="#FFB8D0" transform="rotate(0)"/>
                    <ellipse rx="8" ry="20" fill="#FFB8D0" transform="rotate(72)"/>
                    <ellipse rx="8" ry="20" fill="#F4A0BF" transform="rotate(144)"/>
                    <ellipse rx="8" ry="20" fill="#F4A0BF" transform="rotate(216)"/>
                    <ellipse rx="8" ry="20" fill="#FFB8D0" transform="rotate(288)"/>
                    <circle r="10" fill="#FFE4BA"/>
                </g>
            </svg>
        </div>

        <!-- Contenido principal del hero -->
        <div class="relative z-10 max-w-4xl w-full">

            <!-- Corazón animado -->
            <div class="animate-heartbeat mb-6 flex justify-center">
                <svg viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg" class="w-16 h-16" aria-hidden="true" role="presentation">
                    <path d="M16 28s-12-7.5-12-16a8 8 0 0 1 12-6.9A8 8 0 0 1 28 12c0 8.5-12 16-12 16z" fill="#F4A0BF"/>
                    <path d="M12 10a4 4 0 0 0-4 4" stroke="white" stroke-width="1.5" stroke-linecap="round" fill="none" opacity="0.5"/>
                </svg>
            </div>

            <!-- Título principal -->
            <h1 id="hero-heading" class="font-bold text-4xl sm:text-5xl md:text-7xl lg:text-8xl text-mama-text leading-tight mb-4 sm:mb-6"
                style="font-family: 'Playfair Display', Georgia, serif;">
                Feliz Día<br>
                <span style="color: #D4467A;">de las Mamás</span>
            </h1>

            <!-- Subtítulo -->
            <p class="text-base sm:text-xl md:text-2xl text-mama-text mb-8 sm:mb-10 opacity-90 px-2"
               style="font-family: 'Nunito', sans-serif;">
                10 de Mayo — Hoy celebramos a la mujer más importante de nuestra vida
            </p>

            <!-- Contador Alpine.js -->
            <div x-data="countdown()" class="mb-10" role="timer" aria-live="polite" aria-atomic="true">
                <template x-if="!finished">
                    <div class="flex flex-wrap gap-4 justify-center">
                        <div class="glass-card rounded-2xl px-6 py-4 min-w-20 text-center shadow-lg">
                            <div class="text-4xl font-bold text-mama-cta"
                                 style="font-family: 'Playfair Display', serif;" x-text="days"></div>
                            <div class="text-sm text-mama-text mt-1 font-semibold"
                                 style="font-family: 'Nunito', sans-serif;">Días</div>
                        </div>
                        <div class="glass-card rounded-2xl px-6 py-4 min-w-20 text-center shadow-lg">
                            <div class="text-4xl font-bold text-mama-cta"
                                 style="font-family: 'Playfair Display', serif;" x-text="hours"></div>
                            <div class="text-sm text-mama-text mt-1 font-semibold"
                                 style="font-family: 'Nunito', sans-serif;">Horas</div>
                        </div>
                        <div class="glass-card rounded-2xl px-6 py-4 min-w-20 text-center shadow-lg">
                            <div class="text-4xl font-bold text-mama-cta"
                                 style="font-family: 'Playfair Display', serif;" x-text="minutes"></div>
                            <div class="text-sm text-mama-text mt-1 font-semibold"
                                 style="font-family: 'Nunito', sans-serif;">Minutos</div>
                        </div>
                        <div class="glass-card rounded-2xl px-6 py-4 min-w-20 text-center shadow-lg">
                            <div class="text-4xl font-bold text-mama-cta"
                                 style="font-family: 'Playfair Display', serif;" x-text="seconds"></div>
                            <div class="text-sm text-mama-text mt-1 font-semibold"
                                 style="font-family: 'Nunito', sans-serif;">Segundos</div>
                        </div>
                    </div>
                </template>
                <template x-if="finished">
                    <div class="glass-card rounded-3xl px-10 py-8 text-center shadow-xl inline-block">
                        <p class="text-3xl md:text-4xl font-bold text-mama-cta"
                           style="font-family: 'Playfair Display', serif;">
                            ¡Hoy es tu día, mamá! <span aria-hidden="true">💐</span>
                        </p>
                        <p class="text-mama-text mt-3 text-lg"
                           style="font-family: 'Nunito', sans-serif;">
                            El día más especial del año
                        </p>
                    </div>
                </template>
            </div>

            <!-- Botón CTA -->
            <a href="#dedicatoria"
               class="inline-block px-8 sm:px-12 py-4 sm:py-5 rounded-full text-white font-bold text-lg sm:text-xl shadow-2xl transition-all duration-300 hover:scale-105 hover:shadow-[0_20px_60px_rgba(212,70,122,0.4)]"
               style="background: linear-gradient(135deg, #D4467A 0%, #F4A0BF 100%); font-family: 'Nunito', sans-serif;">
                Dedicarle un mensaje <span aria-hidden="true">💌</span>
            </a>
        </div>
    </section>

    <!-- ============================================================
         SECCIÓN 2: MENSAJE / POEMA
    ============================================================ -->
    <section class="py-16 sm:py-24 px-4" aria-labelledby="mensaje-heading" style="background-color: #FFF9F5;">
        <div class="max-w-3xl mx-auto">
            <h2 id="mensaje-heading" class="text-3xl md:text-4xl font-bold text-mama-text text-center mb-14"
                data-aos="fade-down"
                style="font-family: 'Playfair Display', Georgia, serif;">
                Un mensaje desde el corazón
            </h2>

            <div data-aos="fade-up" data-aos-duration="1000" class="relative glass-card rounded-3xl p-8 sm:p-10 md:p-16 shadow-2xl">
                <!-- Comillas decorativas -->
                <span class="absolute top-2 left-2 sm:left-5 text-[70px] sm:text-[140px] leading-none select-none pointer-events-none"
                      style="color: #FFB8D0; opacity: 0.5; font-family: Georgia, serif; line-height: 1;">"</span>
                <span class="absolute bottom-0 right-2 sm:right-5 text-[70px] sm:text-[140px] leading-none select-none pointer-events-none"
                      style="color: #FFB8D0; opacity: 0.5; font-family: Georgia, serif; line-height: 1;">"</span>

                <div class="relative z-10 text-center space-y-4">
                    <p class="text-xl md:text-2xl text-mama-text leading-relaxed italic"
                       style="font-family: 'Playfair Display', Georgia, serif;">
                        Mamá, eres el sol que me despertó cada mañana,
                    </p>
                    <p class="text-xl md:text-2xl text-mama-text leading-relaxed italic"
                       style="font-family: 'Playfair Display', Georgia, serif;">
                        la voz que me dio fuerza cuando el mundo era una tormenta.
                    </p>
                    <p class="text-xl md:text-2xl text-mama-text leading-relaxed italic"
                       style="font-family: 'Playfair Display', Georgia, serif;">
                        En tus manos encontré mi hogar,
                    </p>
                    <p class="text-xl md:text-2xl text-mama-text leading-relaxed italic"
                       style="font-family: 'Playfair Display', Georgia, serif;">
                        en tu amor, mi razón de existir.
                    </p>
                    <p class="text-xl md:text-2xl text-mama-text leading-relaxed italic"
                       style="font-family: 'Playfair Display', Georgia, serif;">
                        Gracias por cada sacrificio silencioso,
                    </p>
                    <p class="text-xl md:text-2xl text-mama-text leading-relaxed italic"
                       style="font-family: 'Playfair Display', Georgia, serif;">
                        por cada abrazo que curó todo.
                    </p>
                    <p class="text-2xl md:text-3xl font-bold pt-6" style="color: #D4467A; font-family: 'Playfair Display', Georgia, serif;">
                        Hoy y siempre... gracias, mamá.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- ============================================================
         SECCIÓN 3: GALERÍA DE MOMENTOS
    ============================================================ -->
    <section class="py-16 sm:py-24 px-4" aria-labelledby="momentos-heading" style="background-color: #E8D5F5;">
        <div class="max-w-6xl mx-auto">
            <h2 id="momentos-heading" class="text-4xl md:text-5xl font-bold text-mama-text text-center mb-4"
                data-aos="fade-down"
                style="font-family: 'Playfair Display', Georgia, serif;">
                Momentos Inolvidables
            </h2>
            <p class="text-center text-mama-text mb-16 text-lg opacity-80"
               data-aos="fade-down" data-aos-delay="100"
               style="font-family: 'Nunito', sans-serif;">
                Esos recuerdos que guarda el corazón para siempre
            </p>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <article class="glass-card rounded-2xl p-8 text-center shadow-lg transition-transform duration-300 hover:-translate-y-2"
                         data-aos="flip-left" data-aos-delay="0" data-aos-duration="800">
                    <div class="text-7xl mb-5" aria-hidden="true">🌅</div>
                    <h3 class="text-xl font-bold text-mama-text mb-3"
                        style="font-family: 'Playfair Display', serif;">Buenos Días</h3>
                    <p class="text-mama-text text-sm leading-relaxed opacity-80"
                       style="font-family: 'Nunito', sans-serif;">
                        Esas mañanas con desayuno listo y una sonrisa que iluminaba el día entero
                    </p>
                </article>

                <article class="glass-card rounded-2xl p-8 text-center shadow-lg transition-transform duration-300 hover:-translate-y-2"
                         data-aos="flip-left" data-aos-delay="150" data-aos-duration="800">
                    <div class="text-7xl mb-5" aria-hidden="true">🍲</div>
                    <h3 class="text-xl font-bold text-mama-text mb-3"
                        style="font-family: 'Playfair Display', serif;">Sus Recetas</h3>
                    <p class="text-mama-text text-sm leading-relaxed opacity-80"
                       style="font-family: 'Nunito', sans-serif;">
                        El sabor de hogar que ningún restaurante del mundo puede igualar
                    </p>
                </article>

                <article class="glass-card rounded-2xl p-8 text-center shadow-lg transition-transform duration-300 hover:-translate-y-2"
                         data-aos="flip-left" data-aos-delay="300" data-aos-duration="800">
                    <div class="text-7xl mb-5" aria-hidden="true">🤗</div>
                    <h3 class="text-xl font-bold text-mama-text mb-3"
                        style="font-family: 'Playfair Display', serif;">Sus Abrazos</h3>
                    <p class="text-mama-text text-sm leading-relaxed opacity-80"
                       style="font-family: 'Nunito', sans-serif;">
                        El refugio más seguro y cálido del mundo entero
                    </p>
                </article>

                <article class="glass-card rounded-2xl p-8 text-center shadow-lg transition-transform duration-300 hover:-translate-y-2"
                         data-aos="flip-left" data-aos-delay="450" data-aos-duration="800">
                    <div class="text-7xl mb-5" aria-hidden="true">⭐</div>
                    <h3 class="text-xl font-bold text-mama-text mb-3"
                        style="font-family: 'Playfair Display', serif;">Su Ejemplo</h3>
                    <p class="text-mama-text text-sm leading-relaxed opacity-80"
                       style="font-family: 'Nunito', sans-serif;">
                        La fuerza y la guía que nos hace mejores personas cada día
                    </p>
                </article>
            </div>
        </div>
    </section>

    <!-- ============================================================
         SECCIÓN 4: POR QUÉ LAS AMAMOS
    ============================================================ -->
    <section class="py-16 sm:py-24 px-4" aria-labelledby="razones-heading" style="background-color: #FFF9F5;">
        <div class="max-w-4xl mx-auto">
            <h2 id="razones-heading" class="text-4xl md:text-5xl font-bold text-mama-text text-center mb-4"
                data-aos="fade-up"
                style="font-family: 'Playfair Display', Georgia, serif;">
                Por Qué las Amamos
            </h2>
            <p class="text-center text-mama-text mb-16 text-lg opacity-80"
               data-aos="fade-up" data-aos-delay="100"
               style="font-family: 'Nunito', sans-serif;">
                Mil razones que el corazón conoce de memoria
            </p>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5">
                <div class="flex items-center gap-4 glass-card rounded-2xl p-6 shadow transition-transform duration-300 hover:-translate-y-1"
                     data-aos="fade-right" data-aos-delay="0">
                    <span class="text-4xl shrink-0" aria-hidden="true">💪</span>
                    <p class="text-mama-text font-semibold text-lg"
                       style="font-family: 'Nunito', sans-serif;">Su fortaleza inquebrantable</p>
                </div>

                <div class="flex items-center gap-4 glass-card rounded-2xl p-6 shadow transition-transform duration-300 hover:-translate-y-1"
                     data-aos="fade-left" data-aos-delay="100">
                    <span class="text-4xl shrink-0" aria-hidden="true">🎓</span>
                    <p class="text-mama-text font-semibold text-lg"
                       style="font-family: 'Nunito', sans-serif;">Su sabiduría infinita</p>
                </div>

                <div class="flex items-center gap-4 glass-card rounded-2xl p-6 shadow transition-transform duration-300 hover:-translate-y-1"
                     data-aos="fade-right" data-aos-delay="200">
                    <span class="text-4xl shrink-0" aria-hidden="true">❤️</span>
                    <p class="text-mama-text font-semibold text-lg"
                       style="font-family: 'Nunito', sans-serif;">Su amor incondicional</p>
                </div>

                <div class="flex items-center gap-4 glass-card rounded-2xl p-6 shadow transition-transform duration-300 hover:-translate-y-1"
                     data-aos="fade-left" data-aos-delay="300">
                    <span class="text-4xl shrink-0" aria-hidden="true">🛡️</span>
                    <p class="text-mama-text font-semibold text-lg"
                       style="font-family: 'Nunito', sans-serif;">Su protección constante</p>
                </div>

                <div class="flex items-center gap-4 glass-card rounded-2xl p-6 shadow transition-transform duration-300 hover:-translate-y-1"
                     data-aos="fade-right" data-aos-delay="400">
                    <span class="text-4xl shrink-0" aria-hidden="true">🌟</span>
                    <p class="text-mama-text font-semibold text-lg"
                       style="font-family: 'Nunito', sans-serif;">Su fe en nosotros</p>
                </div>

                <div class="flex items-center gap-4 glass-card rounded-2xl p-6 shadow transition-transform duration-300 hover:-translate-y-1"
                     data-aos="fade-left" data-aos-delay="500">
                    <span class="text-4xl shrink-0" aria-hidden="true">🌺</span>
                    <p class="text-mama-text font-semibold text-lg"
                       style="font-family: 'Nunito', sans-serif;">Su belleza interior</p>
                </div>
            </div>
        </div>
    </section>

    <!-- ============================================================
         SECCIÓN 5: DEDICATORIA (Alpine.js)
    ============================================================ -->
    <section id="dedicatoria" class="py-16 sm:py-24 px-4"
             aria-labelledby="dedicatoria-heading"
             style="background: linear-gradient(135deg, #FFD6E0 0%, #FFB8D0 60%, #E8D5F5 100%);">
        <div class="max-w-2xl mx-auto">
            <h2 id="dedicatoria-heading" class="text-4xl md:text-5xl font-bold text-mama-text text-center mb-4"
                data-aos="fade-down"
                style="font-family: 'Playfair Display', Georgia, serif;">
                Dédicale un Mensaje
            </h2>
            <p class="text-center text-mama-text mb-12 text-lg opacity-80"
               data-aos="fade-down" data-aos-delay="100"
               style="font-family: 'Nunito', sans-serif;">
                Escríbele desde el corazón <span aria-hidden="true">❤️</span>
            </p>

            <div x-data="{
                    name: '',
                    remitente: '',
                    message: '',
                    submitted: false,
                    loading: false,
                    mamaUrl: '',
                    mamaCode: '',
                    copied: false,
                    async submit() {
                        if (!this.name || !this.message) return;
                        this.loading = true;
                        try {
                            const res = await fetch('/dedicatoria', {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': document.querySelector('meta[name=\'csrf-token\']').content,
                                    'Accept': 'application/json'
                                },
                                body: JSON.stringify({ name: this.name, message: this.message, remitente: this.remitente })
                            });
                            const data = await res.json();
                            if (res.ok && data.success) {
                                this.mamaUrl  = data.url;
                                this.mamaCode = data.code;
                            }
                        } catch(e) {
                            // Continuar mostrando éxito aunque falle el servidor
                        }
                        this.submitted = true;
                        this.loading = false;
                    },
                    copyLink() {
                        if (!this.mamaUrl) return;
                        navigator.clipboard.writeText(this.mamaUrl).then(() => {
                            this.copied = true;
                            setTimeout(() => this.copied = false, 2500);
                        });
                    }
                 }"
                 data-aos="fade-up" data-aos-delay="200">

                <!-- Formulario -->
                <div x-show="!submitted">
                    <form @submit.prevent="submit()" aria-label="Formulario de dedicatoria" class="glass-card rounded-3xl p-8 md:p-12 shadow-2xl">
                        <div class="mb-6">
                            <label for="mama-nombre" class="block text-mama-text font-bold mb-2 text-xs uppercase tracking-widest"
                                   style="font-family: 'Nunito', sans-serif;">
                                Nombre de tu mamá
                            </label>
                            <input
                                id="mama-nombre"
                                type="text"
                                x-model="name"
                                placeholder="Escribe su nombre con amor..."
                                class="w-full px-5 py-4 rounded-xl border-2 focus:outline-none transition-colors text-mama-text text-lg"
                                style="border-color: #FFB8D0; background: rgba(255,255,255,0.8); font-family: 'Nunito', sans-serif;"
                                onfocus="this.style.borderColor='#D4467A'"
                                onblur="this.style.borderColor='#FFB8D0'"
                                required
                            >
                        </div>
                        <div class="mb-6">
                            <label for="mama-remitente" class="block text-mama-text font-bold mb-2 text-xs uppercase tracking-widest"
                                   style="font-family: 'Nunito', sans-serif;">
                                Tu nombre (de parte de...)
                                <span class="normal-case font-normal opacity-60 ml-1">opcional</span>
                            </label>
                            <input
                                id="mama-remitente"
                                type="text"
                                x-model="remitente"
                                placeholder="Tu nombre o 'Tu hij@'..."
                                class="w-full px-5 py-4 rounded-xl border-2 focus:outline-none transition-colors text-mama-text text-lg"
                                style="border-color: #FFB8D0; background: rgba(255,255,255,0.8); font-family: 'Nunito', sans-serif;"
                                onfocus="this.style.borderColor='#D4467A'"
                                onblur="this.style.borderColor='#FFB8D0'"
                            >
                        </div>
                        <div class="mb-8">
                            <label for="mama-mensaje" class="block text-mama-text font-bold mb-2 text-xs uppercase tracking-widest"
                                   style="font-family: 'Nunito', sans-serif;">
                                Tu mensaje especial
                            </label>
                            <textarea
                                id="mama-mensaje"
                                x-model="message"
                                rows="5"
                                placeholder="Escríbele todo lo que sientes..."
                                class="w-full px-5 py-4 rounded-xl border-2 focus:outline-none transition-colors text-mama-text text-lg resize-none"
                                style="border-color: #FFB8D0; background: rgba(255,255,255,0.8); font-family: 'Nunito', sans-serif;"
                                onfocus="this.style.borderColor='#D4467A'"
                                onblur="this.style.borderColor='#FFB8D0'"
                                required
                            ></textarea>
                        </div>
                        <button
                            type="submit"
                            :disabled="loading"
                            class="w-full py-5 rounded-full text-white font-bold text-xl shadow-xl transition-all duration-300 hover:scale-105 hover:shadow-2xl disabled:opacity-60 disabled:cursor-not-allowed disabled:hover:scale-100"
                            style="background: linear-gradient(135deg, #D4467A 0%, #F4A0BF 100%); font-family: 'Nunito', sans-serif;">
                            <span x-text="loading ? 'Creando tu carta...' : 'Crear carta para mamá 💌'"></span>
                        </button>
                    </form>
                </div>

                <!-- Estado enviado: muestra el link compartible -->
                <div x-show="submitted"
                     x-transition:enter="transition ease-out duration-500"
                     x-transition:enter-start="opacity-0 scale-95"
                     x-transition:enter-end="opacity-100 scale-100"
                     class="glass-card rounded-3xl p-10 md:p-12 shadow-2xl text-center">

                    <div class="text-7xl mb-5 animate-heartbeat inline-block" aria-hidden="true">💐</div>

                    <h3 class="text-2xl md:text-3xl font-bold mb-2"
                        style="color: #D4467A; font-family: 'Playfair Display', Georgia, serif;">
                        ¡Carta creada con amor!
                    </h3>
                    <p class="text-mama-text mb-8 opacity-80" style="font-family:'Nunito',sans-serif;">
                        Comparte este link con <strong x-text="name"></strong> para que abra su carta especial
                    </p>

                    <!-- Link compartible -->
                    <div class="mb-6" x-show="mamaUrl">
                        <div class="flex items-center gap-2 rounded-2xl overflow-hidden border-2 mb-4"
                             style="border-color: #FFB8D0; background: rgba(255,255,255,0.8);">
                            <input type="text"
                                   :value="mamaUrl"
                                   readonly
                                   class="flex-1 px-4 py-3 bg-transparent text-mama-text text-sm font-medium focus:outline-none truncate"
                                   style="font-family:'Nunito',sans-serif;"
                                   aria-label="Link de la carta">
                            <button @click="copyLink()"
                                    class="px-5 py-3 font-semibold text-white text-sm transition-all duration-200 hover:opacity-90 shrink-0"
                                    :style="copied ? 'background:#22c55e' : 'background:#D4467A'"
                                    style="font-family:'Nunito',sans-serif;"
                                    :aria-label="copied ? 'Link copiado' : 'Copiar link'">
                                <span x-text="copied ? '✓ Copiado' : 'Copiar'"></span>
                            </button>
                        </div>

                        <!-- Código de acceso grande -->
                        <div class="mb-4">
                            <p class="text-xs uppercase tracking-widest opacity-60 mb-1"
                               style="font-family:'Nunito',sans-serif;">Código de la carta</p>
                            <p class="font-bold text-4xl tracking-[0.3em] text-mama-cta"
                               style="font-family:'Playfair Display',serif;" x-text="mamaCode"></p>
                        </div>

                        <!-- Botón abrir carta -->
                        <a :href="mamaUrl"
                           target="_blank"
                           class="inline-block px-8 py-4 rounded-full text-white font-bold shadow-xl transition-all duration-300 hover:scale-105 mb-4"
                           style="background: linear-gradient(135deg, #D4467A 0%, #F4A0BF 100%); font-family:'Nunito',sans-serif;">
                            Ver la carta de mamá <span aria-hidden="true">🌸</span>
                        </a>
                    </div>

                    <!-- Si falló la BD, mostrar solo éxito visual -->
                    <div x-show="!mamaUrl" class="mb-6">
                        <p class="text-mama-text italic text-lg" style="font-family:'Playfair Display',serif;"
                           x-text="`&quot;${message}&quot;`"></p>
                    </div>

                    <button
                        @click="submitted = false; name = ''; remitente = ''; message = ''; mamaUrl = ''; mamaCode = ''; copied = false;"
                        class="px-8 py-3 rounded-full font-semibold text-sm border-2 transition-all duration-300 hover:scale-105"
                        style="border-color: #D4467A; color: #D4467A; font-family: 'Nunito', sans-serif;">
                        Crear otra carta
                    </button>
                </div>
            </div>
        </div>
    </section>

    <!-- ============================================================
         SECCIÓN 6: FOOTER
    ============================================================ -->
    <footer class="py-12 px-4 text-center relative" style="background-color: #4A3728;">
        <!-- Línea gradiente superior -->
        <div class="absolute top-0 left-0 right-0 h-1"
             style="background: linear-gradient(90deg, #FFD6E0, #FFB8D0, #F4A0BF, #D4467A, #F4A0BF, #FFB8D0, #FFD6E0);"></div>

        <!-- Flor giratoria -->
        <div class="flex justify-center mb-5">
            <div class="w-10 h-10 animate-petal-spin">
                <svg viewBox="0 0 80 80" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" role="presentation">
                    <g transform="translate(40,40)">
                        <ellipse rx="8" ry="20" fill="#FFB8D0" transform="rotate(0)"/>
                        <ellipse rx="8" ry="20" fill="#FFB8D0" transform="rotate(72)"/>
                        <ellipse rx="8" ry="20" fill="#F4A0BF" transform="rotate(144)"/>
                        <ellipse rx="8" ry="20" fill="#F4A0BF" transform="rotate(216)"/>
                        <ellipse rx="8" ry="20" fill="#FFB8D0" transform="rotate(288)"/>
                        <circle r="10" fill="#FFE4BA"/>
                    </g>
                </svg>
            </div>
        </div>

        <p class="font-bold text-2xl mb-2"
           style="color: #FFD6E0; font-family: 'Playfair Display', Georgia, serif;">
            GraciasMadre
        </p>
        <p class="text-sm opacity-70"
           style="color: #FFD6E0; font-family: 'Nunito', sans-serif;">
            © 2026 — Con amor para todas las mamás del mundo <span aria-hidden="true">💐</span>
        </p>
    </footer>

    <!-- ============================================================
         SCRIPTS
    ============================================================ -->
    <script>
        function countdown() {
            return {
                days: '00',
                hours: '00',
                minutes: '00',
                seconds: '00',
                finished: false,
                init() {
                    this.update();
                    setInterval(() => this.update(), 1000);
                },
                update() {
                    const target = new Date('2026-05-10T00:00:00');
                    const now = new Date();
                    const diff = target - now;

                    if (diff <= 0) {
                        this.finished = true;
                        return;
                    }

                    this.days    = String(Math.floor(diff / (1000 * 60 * 60 * 24))).padStart(2, '0');
                    this.hours   = String(Math.floor((diff % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60))).padStart(2, '0');
                    this.minutes = String(Math.floor((diff % (1000 * 60 * 60)) / (1000 * 60))).padStart(2, '0');
                    this.seconds = String(Math.floor((diff % (1000 * 60)) / 1000)).padStart(2, '0');
                }
            };
        }
    </script>

</body>
</html>
