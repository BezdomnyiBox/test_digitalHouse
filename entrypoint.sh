#!/bin/bash

# Выполнение миграций и сидеров с проверкой
echo "Выполнение миграций..."
php artisan migrate --force

echo "Выполнение сидеров..."
php artisan db:seed --force

# Запуск приложения
php artisan serve --host=0.0.0.0 --port=8000
