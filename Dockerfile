FROM php:7.4-apache

# 필수 패키지 및 확장 설치
RUN apt-get update && apt-get install -y \
    libzip-dev unzip \
    libpng-dev libjpeg-dev libfreetype6-dev \
    libonig-dev libxml2-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) \
        pdo pdo_mysql mysqli mbstring zip gd intl bcmath opcache xml \
    && a2enmod rewrite

# 소스 복사
COPY . /var/www/html
