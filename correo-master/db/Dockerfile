# Usar la imagen base de MySQL
FROM mysql:8.0

# Establecer variables de entorno
ENV MYSQL_ROOT_PASSWORD=root
ENV MYSQL_DATABASE=proyectodocker

# Copiar scripts de inicialización si es necesario
COPY ./init.sql /docker-entrypoint-initdb.d/


