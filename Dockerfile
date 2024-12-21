FROM php:8.4-cli

# Install dependencies for Composer
RUN apt-get update && apt-get install -y \
    git unzip && \
    rm -rf /var/lib/apt/lists/*

# Install Composer
RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" && \
    php composer-setup.php --install-dir=/usr/local/bin --filename=composer && \
    rm composer-setup.php

# Set working directory
WORKDIR /var/www/html
