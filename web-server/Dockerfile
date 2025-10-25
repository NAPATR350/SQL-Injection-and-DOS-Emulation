FROM php:8.1-apache

# ติดตั้ง extensions
RUN docker-php-ext-install mysqli pdo pdo_mysql

# เปิดใช้งาน mod_rewrite
RUN a2enmod rewrite

# คัดลอกไฟล์เว็บไซต์
COPY . /var/www/html/

# ตั้งค่า permissions
RUN chown -R www-data:www-data /var/www/html
RUN chmod -R 755 /var/www/html

EXPOSE 80

CMD ["apache2-foreground"]
