FROM php:8.1-apache

WORKDIR /var/www/html

COPY . /var/www/html

RUN apt-get update && \
    apt-get install -y \
        libzip-dev \
        unzip \
        git \
        libpq-dev \
    && rm -rf /var/lib/apt/lists/* \
    && docker-php-ext-install zip pdo_mysql pdo_pgsql

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN composer install

RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 775 /var/www/html/var \
    && chown -R www-data:www-data /var/www/html/var/log

RUN a2enmod rewrite

COPY apache-config.conf /etc/apache2/sites-available/000-default.conf

RUN a2ensite 000-default.conf

EXPOSE 80

CMD ["apache2-foreground"]
