FROM php:8.2-fpm
WORKDIR /var/www
RUN apt-get update && apt-get upgrade -y && apt-get install -y wget\
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
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
RUN wget https://get.symfony.com/cli/installer -O - | bash \
  && mv /root/.symfony*/bin/symfony /usr/local/bin/symfony
RUN userdel -f www-data &&\
    if getent group www-data ; then groupdel www-data; fi &&\
    groupadd -g 33 www-data &&\
    useradd -l -u 33 -g www-data www-data &&\
    install -d -m 0755 -o www-data -g www-data /home/www-data &&\
    chown --changes --silent --no-dereference --recursive --from=33:33 33:33 /home/www-data
COPY . /var/www/html
WORKDIR /var/www/html
RUN composer install --optimize-autoloader
USER www-data
RUN chown -R www-data:www-data /var/www/html/var /var/www/html/public
EXPOSE 8000
CMD ["symfony", "server:start", "--port=8000", "--dir=/app"]