# Utiliser l'image de base PHP avec CLI et PHP 8.2
FROM php:8.2-cli

# Mettre à jour les paquets et installer les extensions nécessaires
RUN apt-get update && apt-get install -y \
    libicu-dev \
    libzip-dev \
    unzip \
    git \
    wget \
    && docker-php-ext-install intl pdo pdo_mysql zip \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Installer Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Installer le CLI Symfony
RUN wget https://get.symfony.com/cli/installer -O - | bash \
    && mv /root/.symfony*/bin/symfony /usr/local/bin/symfony

# Copier les fichiers de l'application
COPY . /var/www/html

# Définir le répertoire de travail
WORKDIR /var/www/html

# Définir la variable d'environnement pour autoriser les plugins Composer en tant que super utilisateur
ENV COMPOSER_ALLOW_SUPERUSER=1

# Installer les dépendances de développement pour éviter les erreurs liées aux bundles dev
RUN composer install --optimize-autoloader

# Donner les permissions appropriées
RUN chown -R www-data:www-data /var/www/html/var /var/www/html/public

# Exposer le port 8000 utilisé par le serveur Symfony
EXPOSE 8000

# Commande pour démarrer le serveur Symfony
CMD ["symfony", "server:start", "--no-tls", "--port=8000", "--allow-http"]
