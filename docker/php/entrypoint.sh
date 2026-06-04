#!/bin/bash
set -e

echo "==> Esperando MySQL en mysql:3306..."
until nc -z mysql 3306; do
  echo "   MySQL no disponible aún — esperando 3s..."
  sleep 3
done
echo "==> MySQL disponible."

echo "==> Ejecutando migraciones..."
php artisan migrate --force

echo "==> Generando cache de configuración..."
php artisan config:cache
php artisan route:cache
php artisan view:cache

echo "==> Ajustando permisos de storage..."
chown -R www-data:www-data /app/storage /app/bootstrap/cache
chmod -R 775 /app/storage /app/bootstrap/cache

echo "==> Creando symlink de storage..."
php artisan storage:link || true

echo "==> Iniciando PHP-FPM..."
exec "$@"