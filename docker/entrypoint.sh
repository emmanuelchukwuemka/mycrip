#!/bin/sh
set -e

# Render assigns the listen port dynamically via $PORT
PORT="${PORT:-10000}"
sed -i "s/:10000/:${PORT}/g" /etc/apache2/sites-available/000-default.conf
sed -i "s/Listen 80/Listen ${PORT}/" /etc/apache2/ports.conf

cd /var/www/html

# Neon's pooled endpoint (DB_HOST) can abort mid-transaction on DDL statements,
# which breaks Laravel's migration runner (each migration file runs inside a
# transaction). Neon's direct endpoint doesn't have this limitation, so run
# migrations against it when provided, then switch back to the pooled host
# for normal app traffic.
if [ -n "$DB_HOST_DIRECT" ]; then
    DB_HOST="$DB_HOST_DIRECT" php artisan migrate --force
else
    php artisan migrate --force
fi

php artisan storage:link || true

# Cache config/views for production. Must happen AFTER migrate, since
# config:cache bakes env() values (including DB_HOST) into a static file —
# caching first would make the DB_HOST_DIRECT override above a no-op.
# Note: route:cache is intentionally skipped — this app has closure-based
# routes (e.g. /dashboard, /admin, /sitemap.xml), which Laravel cannot
# serialize for the route cache and would hard-fail here.
php artisan config:cache
php artisan view:cache

exec apache2-foreground
