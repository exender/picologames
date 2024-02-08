# Utiliser l'image officielle PHP 8.3
FROM php:8.3

# Installation des dépendances nécessaires
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libzip-dev \
    libonig-dev \
    nodejs \
    npm \
    mariadb-client

# Installation de Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Installation de Laravel Installer via Composer
RUN composer global require laravel/installer

# Configuration de l'extension PHP
RUN docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd pdo pdo_mysql mysqli zip exif pcntl

# Création d'un dossier pour l'application Laravel
WORKDIR /var/www/html

# Copie des fichiers de l'application Laravel dans le conteneur
COPY . .

# Copie du fichier d'environnement
COPY .env.example .env

COPY package.json package.json

COPY composer.json composer.json


# Installation des dépendances PHP
RUN composer install
# Configuration de l'accès à la base de données MySQL sans mot de passe
RUN echo -e "[client]\nuser=root" > ~/.my.cnf
# Génération de la clé d'application Laravel
RUN php artisan key:generate




# Commande à exécuter lors du démarrage du conteneur
CMD ["php", "artisan", "serve", "--host=localhost"]

# Exposition du port 8000 pour l'application Laravel
EXPOSE 8000
