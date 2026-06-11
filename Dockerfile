# 1. Image de base PHP 8.2 avec FPM
FROM php:8.4-fpm

# 2. Définir le répertoire de travail
WORKDIR /var/www/html

# 3. Installer les dépendances système AVANT les extensions PHP
# C'est l'étape cruciale pour éviter les erreurs de compilation (exit code 1)
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libonig-dev \
    libxml2-dev \
    libzip-dev \
    unzip \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# 4. Installer les extensions PHP requises par Laravel
RUN docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) \
        pdo_mysql \
        mbstring \
        exif \
        pcntl \
        bcmath \
        gd \
        zip

# 5. Installer Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# 6. Copier les fichiers du projet
COPY . /var/www/html

# 7. Installer les dépendances (sans --no-dev pour le local)
RUN composer install --optimize-autoloader

# 8. Droits d'écriture pour Laravel
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# 9. Exposer le port 9000 (port par défaut de PHP-FPM)
EXPOSE 9000

# 10. Démarrer PHP-FPM
CMD ["php-fpm"]
