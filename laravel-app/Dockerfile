
FROM php:8.4-cli

RUN apt-get update \
    && apt-get install -y --no-install-recommends \
       libpq-dev libicu-dev unzip git \
    && docker-php-ext-install pdo_pgsql intl \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

COPY . .

RUN composer install --no-dev --optimize-autoloader --no-interaction

RUN mkdir -p storage/framework/cache \
    storage/framework/sessions \
    storage/framework/views \
    storage/logs \
    bootstrap/cache \
    && chmod -R 775 storage bootstrap/cache

ENV PORT=10000

EXPOSE 10000

CMD php artisan serve --host=0.0.0.0 --port=${PORT}
