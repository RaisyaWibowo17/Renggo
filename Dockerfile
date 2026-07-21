FROM php:8.2-cli

# Install PHP + Node
RUN apt-get update && apt-get install -y \
    libpq-dev \
    unzip \
    curl \
    nodejs \
    npm \
    && docker-php-ext-install pdo pdo_pgsql \
    && apt-get clean

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /app

COPY . .

# Install PHP dependencies
RUN composer install --no-dev --optimize-autoloader

# Install JS dependencies & build Vite
RUN npm install && npm run build

# Buat folder storage
RUN mkdir -p storage/framework/sessions \
    storage/framework/views \
    storage/framework/cache/data \
    storage/logs \
    bootstrap/cache \
    && chmod -R 775 storage bootstrap/cache

EXPOSE 8000

CMD php artisan config:clear && php artisan migrate --force && php artisan serve --host=0.0.0.0 --port=${PORT:-8000}