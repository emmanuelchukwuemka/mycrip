# syntax=docker/dockerfile:1

# ---- Frontend build stage ----
FROM node:20-alpine AS frontend
WORKDIR /app
COPY package.json package-lock.json ./
RUN npm ci
COPY resources ./resources
COPY vite.config.js ./
COPY public ./public
RUN npm run build

# ---- PHP dependencies stage ----
FROM composer:2 AS vendor
WORKDIR /app
COPY composer.json composer.lock ./
RUN composer install \
    --no-dev \
    --no-scripts \
    --no-interaction \
    --optimize-autoloader \
    --ignore-platform-reqs

# ---- Runtime stage ----
FROM php:8.2-apache AS app

# System deps + PHP extensions Laravel/this app needs
RUN apt-get update && apt-get install -y --no-install-recommends \
        libpq-dev \
        libzip-dev \
        libicu-dev \
        libpng-dev \
        libjpeg62-turbo-dev \
        libfreetype6-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j"$(nproc)" \
        pdo_pgsql \
        pgsql \
        pdo_mysql \
        mysqli \
        zip \
        intl \
        bcmath \
        exif \
        pcntl \
        gd \
    && rm -rf /var/lib/apt/lists/*

RUN a2enmod rewrite

WORKDIR /var/www/html

COPY . .
COPY --from=vendor /app/vendor ./vendor
COPY --from=frontend /app/public/build ./public/build

# bootstrap/cache/*.php is excluded via .dockerignore (it reflects the local
# dev vendor tree, which includes require-dev packages not present here).
# Regenerate it now against the real --no-dev vendor/ we just copied in.
RUN php artisan package:discover --ansi

# Apache: serve from /public, allow .htaccess overrides, listen on $PORT
COPY docker/apache.conf /etc/apache2/sites-available/000-default.conf
COPY docker/entrypoint.sh /usr/local/bin/entrypoint.sh
RUN chmod +x /usr/local/bin/entrypoint.sh

RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache \
    && chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

ENV PORT=10000
EXPOSE 10000

ENTRYPOINT ["entrypoint.sh"]
