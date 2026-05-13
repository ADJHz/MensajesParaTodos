#!/bin/sh
# ══════════════════════════════════════════════════════════════
# GraciasMadre — Entrypoint de Docker
# Ejecuta migraciones, caché y arranca la aplicación
# ══════════════════════════════════════════════════════════════
set -e

echo ""
echo "🌸 ═══════════════════════════════════════════ 🌸"
echo "       Mensajes para todos💐 — Iniciando servidor        "
echo "🌸 ═══════════════════════════════════════════ 🌸"
echo ""

# ── Esperar a que la base de datos esté disponible ──────────
if [ -n "$DB_HOST" ] && [ -n "$DB_PORT" ]; then
    echo "⏳ Esperando base de datos en $DB_HOST:$DB_PORT..."
    retries=30
    until nc -z "$DB_HOST" "$DB_PORT" 2>/dev/null; do
        retries=$((retries - 1))
        if [ "$retries" -le 0 ]; then
            echo "❌ No se pudo conectar a la base de datos en $DB_HOST:$DB_PORT"
            exit 1
        fi
        echo "   · Reintentando ($retries intentos restantes)..."
        sleep 2
    done
    echo "✅ Base de datos disponible"
fi

# ── Generar APP_KEY si no existe ────────────────────────────
if [ -z "$APP_KEY" ]; then
    echo "🔑 Generando APP_KEY..."
    php artisan key:generate --force
fi

# ── Ejecutar migraciones ─────────────────────────────────────
echo "🗃️  Ejecutando migraciones..."
php artisan migrate --force --no-interaction

# ── Enlace de almacenamiento público ─────────────────────────
echo "🔗 Verificando enlace public/storage..."

# Si existe como carpeta/archivo normal, rompe el symlink y causa 404 en imágenes.
if [ -e "public/storage" ] && [ ! -L "public/storage" ]; then
    echo "⚠️  public/storage existe y no es symlink. Reemplazando por enlace..."
    rm -rf public/storage
fi

php artisan storage:link --force

if [ ! -L "public/storage" ]; then
    echo "❌ No se pudo crear el enlace simbólico public/storage"
    exit 1
fi

echo "✅ Enlace public/storage listo"

# ── Optimizaciones de producción ─────────────────────────────
if [ "$APP_ENV" = "production" ]; then
    echo "⚡ Optimizando para producción..."
    php artisan config:cache
    php artisan route:cache
    php artisan view:cache
    php artisan event:cache
else
    echo "🛠️  Modo local — omitiendo caché de configuración"
    php artisan config:clear   2>/dev/null || true
    php artisan route:clear    2>/dev/null || true
    php artisan view:clear     2>/dev/null || true
fi

echo ""
echo "💐 Mensajes para todos lista! Escuchando en el puerto 80"
echo ""

exec "$@"
