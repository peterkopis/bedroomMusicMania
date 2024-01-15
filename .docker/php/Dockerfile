FROM php:8.2-fpm-buster
#ARG TIMEZONE

# Install dependencies

RUN apt-get update && apt-get install -y \
    curl \
    gnupg \
    g++ \
    procps \
    openssl \
    git \
    unzip \
    zlib1g-dev \
    libzip-dev \
    libfreetype6-dev \
    libpng-dev \
    libjpeg-dev \
    libicu-dev  \
    libonig-dev \
    libxslt1-dev \
    acl \
    libpq-dev \
    #postfix \
    && echo 'alias sf="php bin/console"' >> ~/.bashrc

RUN docker-php-ext-configure gd --with-jpeg --with-freetype 

RUN docker-php-ext-install \
    pdo pdo_pgsql zip xsl gd intl opcache exif mbstring


RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

WORKDIR /var/www/bedroomMusicMania/public

# Inicia el servidor PHP
CMD ["php", "-S", "0.0.0.0:8000"]