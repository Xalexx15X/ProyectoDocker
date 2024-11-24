# Proyecto de API con Docker, MySQL y PHP

Este proyecto es una API simple construida con PHP que interactúa con una base de datos MySQL, todo gestionado por contenedores Docker. La aplicación permite gestionar productos de tipo "Kebab" a través de un frontend que se comunica con un backend PHP, que a su vez interactúa con una base de datos MySQL.

## Estructura del Proyecto
Estructura del Proyecto: 

correo-master/
│
├── front/                    # Frontend con HTML y JavaScript
│   ├── Dockerfile             # Dockerfile para construir la imagen del frontend
│   └── js.js                 # Código JavaScript para consumir la API
│
├── back/                     # Backend PHP
│   ├── Dockerfile             # Dockerfile para construir la imagen del backend
│   └── api.php               # API en PHP para gestionar productos (Kebab)
│
├── db/                       # Base de datos MySQL
│   ├── init.sql              # Script SQL para inicializar la base de datos
│   └── Dockerfile            # Dockerfile para crear la imagen de MySQL
│             
├── index.html                # Página de inicio con botón para mostrar productos
├── docker-compose.yml        # Configuración de los contenedores Docker
└── README.md                 # Documentación del proyecto

## Requisitos

- Tener Docker instalado en tu máquina.
- Tener Docker Compose instalado.

## Instalación y Ejecución

Para levantar todos los servicios (frontend, backend y base de datos), solo necesitas ejecutar el siguiente comando:

docker-compose up --build

Explicación del Comando: 
docker-compose up: Inicia todos los contenedores definidos en el archivo docker-compose.yml.
--build: Fuerza la reconstrucción de las imágenes de los contenedores antes de iniciar los servicios, asegurando que cualquier cambio en los Dockerfile se aplique.
Esto construirá y arrancará los siguientes servicios:

Frontend (UI): un index que se encuentra en el puerto 8081 donde puedes ver y agregar productos.
Backend (API PHP): Un servidor PHP que maneja la lógica de negocio para gestionar los productos. Se conecta a la base de datos MySQL.
Base de datos (MySQL): Se ejecuta una base de datos MySQL que se usa para almacenar los productos.

## Acceso a la Aplicación
Una vez que los contenedores estén en funcionamiento se podra hacer una petición a la API para obtener los productos y a la UI para agregar productos.

Frontend (HTML + JS): http://localhost:8081
API (Backend PHP): La API de PHP estará funcionando y escuchando peticiones en el contenedor, pero solo interactuará a través del frontend o mediante peticiones directas a su URL configurada (con el contenedor back).
Base de datos MySQL: El contenedor de la base de datos estará disponible en el puerto 3306 para interacciones a nivel de base de datos.
Detener los Contenedores
Para detener los contenedores y liberar los puertos, puedes ejecutar:

docker-compose down

## Estructura de los Contenedores

### Frontend

##### Usar una imagen ligera de Alpine con PHP
FROM alpine:latest

##### Crear el directorio donde se almacenarán los archivos estáticos
WORKDIR /var/www/html

##### Copiar el código del frontend
COPY ./ /var/www/html/

### Backend
##### Usar la imagen base de PHP con Apache
FROM php:8.1-apache

##### Instalar las extensiones necesarias para conectarse a MySQL
RUN docker-php-ext-install pdo pdo_mysql

##### Copiar el código del backend (API)
COPY ./ /var/www/html/

### Base de Datos
#### Usar la imagen base de MySQL
FROM mysql:5.7

##### Establecer variables de entorno
ENV MYSQL_ROOT_PASSWORD=root
ENV MYSQL_DATABASE=proyectodocker

##### Copiar el script de inicialización de la base de datos
COPY ./init.sql /docker-entrypoint-initdb.d/    


