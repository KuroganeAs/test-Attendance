FROM php:8.2-apache

# Fix Apache MPM conflict - ensure only prefork MPM is loaded
RUN a2dismod mpm_event mpm_worker 2>/dev/null; \
    a2enmod mpm_prefork

RUN docker-php-ext-install pdo pdo_mysql mysqli

COPY php-login-register/ /var/www/html/

RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html

RUN a2enmod rewrite

EXPOSE 80
CMD ["apache2-foreground"]
