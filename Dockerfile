FROM php:8.2-fpm

# Set working directory in the container
WORKDIR /var/www

# Install system dependencies
RUN apt-get update && apt-get upgrade -y && apt-get install -y \
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
    curl \
    libzip-dev

RUN apt-get install -y libonig-dev

RUN apt-get clean && rm -rf /var/lib/apt/lists/*

RUN docker-php-ext-install pdo_mysql mbstring zip exif pcntl
RUN apt-get update && apt-get install -y default-mysql-client

RUN docker-php-ext-configure gd --with-jpeg=/usr/include/ --with-freetype=/usr/include/
RUN docker-php-ext-install gd
# Install composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

RUN wget https://get.symfony.com/cli/installer -O - | bash \
  && mv /root/.symfony*/bin/symfony /usr/local/bin/symfony
# Remove existing www-data user and add our own with the same name
RUN userdel -f www-data &&\
    if getent group www-data ; then groupdel www-data; fi &&\
    groupadd -g 33 www-data &&\
    useradd -l -u 33 -g www-data www-data &&\
    install -d -m 0755 -o www-data -g www-data /home/www-data &&\
    chown --changes --silent --no-dereference --recursive --from=33:33 33:33 /home/www-data

# Copy existing application directory permissions

COPY . /var/www/html
WORKDIR /var/www/html
# Change current user to www
RUN composer install --optimize-autoloader
USER www-data
RUN chown -R www-data:www-data /var/www/html/var /var/www/html/public

# Expose port 8000 and start php-fpm server
EXPOSE 8000
CMD ["symfony", "server:start", "--port=8000", "--dir=/app"]