FROM php:8.1-apache

# ติดตั้ง PDO MySQL extension
RUN docker-php-ext-install pdo pdo_mysql

# เปิดใช้งาน mod_rewrite
RUN a2enmod rewrite

# ตั้งค่า document root
ENV APACHE_DOCUMENT_ROOT /var/www/html
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# ตั้งค่าสิทธิ์
RUN chown -R www-data:www-data /var/www/html

EXPOSE 80 