#!/bin/bash

echo "🔄 Limpando cache de config, route, view e event..."
php artisan optimize:clear

echo "🗑️ Limpando cache de aplicação (storage/framework/cache/data)..."
php artisan cache:clear

echo "🗑️ Limpando views compiladas..."
php artisan view:clear

echo "🗑️ Limpando sessions (se houver)..."
rm -rf storage/framework/sessions/*

echo "🗑️ Limpando cache residual manual (se houver arquivos travados)..."
rm -rf storage/framework/cache/data/*

echo "✅ Limpeza completa!"
