# ══════════════════════════════════════════════════════════════
# GraciasMadre — Dockerfile de producción
# PHP 8.3 + Nginx + Supervisor — Multi-stage build
# ══════════════════════════════════════════════════════════════

# ─────────────────────────────────────────────────────────────
# STAGE 1: Compilar assets del frontend (Node.js)
# ─────────────────────────────────────────────────────────────
FROM node:22-alpine AS frontend

WORKDIR /app

COPY package*.json ./
RUN npm ci --prefer-offline

COPY vite.config.js ./
COPY resources/ ./resources/
COPY public/ ./public/

RUN npm run build

# ─────────────────────────────────────────────────────────────
# STAGE 2: Instalar dependencias PHP (Composer)
# ─────────────────────────────────────────────────────────────
FROM composer:2.8 AS composer

WORKDIR /app

COPY composer.json composer.lock ./

RUN composer install \
    --no-dev \
    --no-scripts \
    --no-interaction \
    --optimize-autoloader \
    --ignore-platform-reqs

# ─────────────────────────────────────────────────────────────
# STAGE 3: Imagen final de producción
# ─────────────────────────────────────────────────────────────
FROM php:8.3-fpm-alpine AS production

LABEL org.opencontainers.image.title="GraciasMadre"
LABEL org.opencontainers.image.description="Aplicación GraciasMadre — Día de las Mamás 💐"

# Dependencias del sistema
RUN apk add --no-cache \
    nginx \
    supervisor \
    curl \
    bash \
    tzdata \
    ca-certificates \
    netcat-openbsd \
    libpng-dev \
    libjpeg-turbo-dev \
    libwebp-dev \
    freetype-dev \
    libzip-dev \
    icu-dev \
    oniguruma-dev \
    postgresql-dev \
    && update-ca-certificates \
    && docker-php-ext-configure gd \
        --with-freetype \
        --with-jpeg \
        --with-webp \
    && docker-php-ext-install -j$(nproc) \
        pdo \
        pdo_mysql \
        pdo_pgsql \
        mbstring \
        exif \
        pcntl \
        bcmath \
        gd \
        zip \
        intl \
        opcache \
    && rm -rf /tmp/*

# Zona horaria de México
ENV TZ=America/Mexico_City
RUN cp /usr/share/zoneinfo/America/Mexico_City /etc/localtime \
    && echo "America/Mexico_City" > /etc/timezone

WORKDIR /var/www/html

# Copiar dependencias PHP desde stage composer
COPY --from=composer /app/vendor ./vendor

# Copiar código fuente de la aplicación
COPY . .

# Copiar assets compilados desde stage frontend
COPY --from=frontend /app/public/build ./public/build

# Copiar configuraciones Docker
COPY docker/nginx.conf      /etc/nginx/http.d/default.conf
COPY docker/nginx-main.conf /etc/nginx/nginx.conf
COPY docker/supervisord.conf /etc/supervisord.conf
COPY docker/php.ini          /usr/local/etc/php/conf.d/app.ini
COPY docker/entrypoint.sh    /entrypoint.sh

RUN chmod +x /entrypoint.sh

# Crear directorios de Laravel y ajustar permisos
# (los directorios de nginx los gestiona Alpine internamente)
RUN mkdir -p \
        storage/app/public \
        storage/framework/cache/data \
        storage/framework/sessions \
        storage/framework/testing \
        storage/framework/views \
        storage/logs \
        bootstrap/cache \
    && chown -R www-data:www-data /var/www/html \
    && chmod -R 755 storage bootstrap/cache

EXPOSE 80

HEALTHCHECK --interval=30s --timeout=10s --start-period=90s --retries=3 \
    CMD curl -fsS http://localhost/up || exit 1

ENTRYPOINT ["/entrypoint.sh"]
CMD ["/usr/bin/supervisord", "-c", "/etc/supervisord.conf"]
