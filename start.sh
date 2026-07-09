#!/bin/bash

# Pastikan environment siap
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Jalankan migrasi database
php artisan migrate --force

# Jalankan Apache di foreground (agar container tetap hidup)
apache2-foreground
