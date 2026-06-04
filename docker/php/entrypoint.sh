#!/bin/sh
set -e

echo "==> Esperando MySQL en mysql:3306..."
until nc -z mysql 3306; do
  echo "   MySQL no disponible aun - esperando 3s..."
  sleep 3
done

echo "==> Puerto MySQL abierto. Verificando que acepte conexiones..."
until php -r "
try {
    \$pdo = new PDO('mysql:host=mysql;port=3306', getenv('DB_USERNAME'), getenv('DB_PASSWORD'));
    exit(0);
} catch (Exception \$e) {
    exit(1);
}
" 2>/dev/null; do
  echo "   MySQL iniciando - esperando 3s..."
  sleep 3
done
echo "==> MySQL listo."

echo "==> Ejecutando migraciones..."
php artisan migrate --force 2>&1 || echo "==> Aviso: algunas migraciones ya existian (no fatal)"

echo "==> Generando cache de configuracion..."
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
