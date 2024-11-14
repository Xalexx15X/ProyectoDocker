# correo
Ejemplo de uso de contenedores usando docker-compose, mailhog y mysql

`docker-compose up --build`

# Explicación del Comando
`docker-compose up`: Este comando inicia todos los servicios definidos en el archivo docker-compose.yml.

`--build`: Esta opción le dice a Docker Compose que construya las imágenes antes de iniciar los contenedores, asegurando que cualquier cambio en los Dockerfile se 
aplique.

# Acceso a la Aplicación
Una vez que los contenedores estén en funcionamiento, podrás acceder a tu aplicación PHP en http://localhost:8080 y a MailHog en http://localhost:8025.

Si necesitas detener los contenedores, puedes usar:

`docker-compose down`
