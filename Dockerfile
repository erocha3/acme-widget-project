# Use the official PHP 8.0 CLI image as the base image
FROM php:8.0-cli

# Set working directory inside the container
WORKDIR /app

# Install system dependencies required for Composer and PHP extensions
RUN apt-get update && apt-get install -y \
    git \
    zip \
    unzip \
    libzip-dev \
    && rm -rf /var/lib/apt/lists/*

# Install PHP extensions that might be needed
RUN docker-php-ext-install zip pdo pdo_mysql

# Copy Composer executable from the official Composer image
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copy the application's composer.json and composer.lock
COPY composer.json composer.lock ./

# Install Composer dependencies (including dev dependencies)
RUN composer install --no-interaction --prefer-dist --optimize-autoloader

# Copy the rest of the application code to the container
COPY . .

# Run PHPStan analysis
RUN ./vendor/bin/phpstan analyse

# Run the tests with PHPUnit
RUN ./vendor/bin/phpunit --configuration phpunit.xml