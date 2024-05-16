# # Utiliser l'image de base PHP avec CLI et PHP 8.2
# FROM php:8.2-cli

# # Installez les extensions nécessaires
# RUN docker-php-ext-install pdo pdo_mysql zip

# # Autres étapes de configuration...


# # Mettre à jour les paquets et installer les extensions nécessaires
# RUN apt-get update && apt-get install -y \
#     libicu-dev \
#     libzip-dev \
#     unzip \
#     git \
#     wget \
#     && docker-php-ext-install intl pdo pdo_mysql zip \
#     && apt-get clean && rm -rf /var/lib/apt/lists/*

# # Installer Composer
# COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# # Installer le CLI Symfony
# RUN wget https://get.symfony.com/cli/installer -O - | bash \
#     && mv /root/.symfony*/bin/symfony /usr/local/bin/symfony

# # Install MySQL client
# RUN apt-get update && apt-get install -y default-mysql-client

# # Copier les fichiers de l'application
# COPY . /var/www/html

# # Définir le répertoire de travail
# WORKDIR /var/www/html

# # Définir la variable d'environnement pour autoriser les plugins Composer en tant que super utilisateur
# ENV COMPOSER_ALLOW_SUPERUSER=1

# RUN php bin/console cache:clear
# # Installer les dépendances de développement pour éviter les erreurs liées aux bundles dev
# RUN composer install --optimize-autoloader



# # Donner les permissions appropriées
# RUN chown -R www-data:www-data /var/www/html/var /var/www/html/public

# # Exposer le port 8000 utilisé par le serveur Symfony
# EXPOSE 8000

# # Commande pour démarrer le serveur Symfony
# CMD ["symfony", "server:start", "--port=8000", "--dir=/app"]

# Use an official PHP runtime as a parent image
FROM php:8.2-fpm

# Set working directory in the container
WORKDIR /var/www

# Install system dependencies
RUN apt-get update && apt-get install -y \
    build-essential \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    locales \
    zip \
    jpegoptim optipng pngquant gifsicle \
    vim \
    unzip \
    git \
    curl

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*
RUN apt-get update && apt-get upgrade -y
# Install extensions
RUN docker-php-ext-install pdo_mysql mbstring zip exif pcntl
RUN docker-php-ext-configure gd --with-jpeg=/usr/include/ --with-freetype=/usr/include/
RUN docker-php-ext-install gd

# Install composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Remove existing www-data user and add our own with the same name
RUN userdel -f www-data &&\
    if getent group www-data ; then groupdel www-data; fi &&\
    groupadd -g 33 www-data &&\
    useradd -l -u 33 -g www-data www-data &&\
    install -d -m 0755 -o www-data -g www-data /home/www-data &&\
    chown --changes --silent --no-dereference --recursive --from=33:33 33:33 /home/www-data

# Copy existing application directory permissions
COPY --chown=www-data:www-data . /var/www

# Change current user to www
USER www-data

# Expose port 8000 and start php-fpm server
EXPOSE 8000
CMD ["php-fpm"]