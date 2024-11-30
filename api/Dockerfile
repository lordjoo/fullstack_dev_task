FROM php:8.3-apache

# Install the PDO MySQL extension
RUN apt-get update && apt-get install -y libpng-dev libjpeg-dev libfreetype6-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd pdo pdo_mysql


# Enable mod_rewrite
RUN a2enmod rewrite

# Allow .htaccess overrides
RUN echo '<Directory /var/www/html>' >> /etc/apache2/apache2.conf && \
    echo '    AllowOverride All' >> /etc/apache2/apache2.conf && \
    echo '</Directory>' >> /etc/apache2/apache2.conf

WORKDIR /var/www/html


# Expose Apache port
EXPOSE 80
