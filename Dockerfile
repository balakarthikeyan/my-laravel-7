FROM php:7.4-fpm

# Arguments defined in docker-compose.yml
ARG user
ARG uid

# Install system dependencies for production
RUN apt-get update && apt-get install -y \
    bash \
    curl \
    g++ \
    gcc \ 
    git \
    imagemagick \
    libcurl4-openssl-dev \
    libfreetype6-dev \
    libjpeg-dev \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    libssl-dev \
    libicu-dev \
    libzip-dev \
    make \
    nodejs \
    yarn \
    openssh-client \
    rsync \
    zip \
    unzip \
    supervisor \
    nginx \
    build-essential

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Install PHP extensions
RUN docker-php-ext-install \
    bcmath \
    iconv \
    intl \
    exif \
    gd \
    pcntl \
    bcmath \
    mysqli \
    pdo \
    pdo_mysql \
    opcache \
    xml \
    mbstring \
    sockets \
    tokenizer \
    zip

# Install PECL and PEAR extensions
RUN pecl install apcu \
    redis
    # imagick \
    # xdebug

# Enable PECL and PEAR extensions
RUN docker-php-ext-enable apcu \
    redis
    # imagick \
    # xdebug

# Configure extensions
RUN docker-php-ext-configure zip
RUN docker-php-ext-configure gd --with-freetype --with-jpeg

# Change www-data user to match the host system UID and GID and chown www directory
RUN usermod --uid $uid $user \
    && groupmod --gid $uid $user \
    && chown -R $user:$user /var/www \
    && chgrp -R $user /var/www

# Get latest Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www/html

# Copy existing code to /var/www/html directory
COPY . .
COPY .env.example .env

# Install application dependencies
# RUN composer install

# Run composer to update
# RUN composer update --optimize-autoloader

# Generate an optimized autoloader
# RUN composer dump-autoload --optimize --classmap-authoritative

# Change chmod www directory
RUN chmod -R 777 /var/www/html \
    && chmod -R 777 /var/www/html/storage /var/www/html/bootstrap/cache

# Enable PHP short tags for Laravel
RUN echo "short_open_tag = On" > /usr/local/etc/php/conf.d/short-tags.ini

# Configure Git
RUN git config --global user.email "balakarthikeyan07@gmail.com" \ 
    && git config --global user.name "Balakarthikeyan"

# Change current user to $user
USER $user