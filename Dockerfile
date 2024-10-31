# Используем официальный образ PHP с версией 8 и поддержкой FPM
FROM php:8.3-fpm

ENV DEBIAN_FRONTEND=noninteractive

# Установка необходимых пакетов и расширений PHP
RUN apt-get update && apt-get install -y \
    git \
    curl \
    zip \
    unzip \
    libpq-dev \
    libzip-dev \
    sudo \
    vim \
    nano \
    && docker-php-ext-install pdo pdo_pgsql

# Установка Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Копирование файлов проекта
WORKDIR /var/www/html
COPY . /var/www/html

# Установка зависимостей Laravel
RUN composer install --ignore-platform-reqs

# Копирование файлов окружения и генерация ключа приложения
COPY .env .env
RUN php artisan key:generate

# Копирование entrypoint скрипта
COPY entrypoint.sh /usr/local/bin/entrypoint.sh
RUN chmod +x /usr/local/bin/entrypoint.sh


# Открытие порта для приложений
EXPOSE 8000

# Установка команды запуска
CMD ["entrypoint.sh"]
