FROM php:8.1-apache

# Activar mod_rewrite para URLs amigables (si lo necesitas)
RUN a2enmod rewrite

# Configurar Apache para escuchar en el puerto 81
RUN echo "Listen 81" >> /etc/apache2/ports.conf

# Copiar el código del frontend al directorio de Apache
COPY ./ /var/www/html/

# Exponer el puerto 81
EXPOSE 81
