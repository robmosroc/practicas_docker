#FASE 0 - Preparación

sudo apt update && sudo apt install git

sudo apt update && sudo apt install curl

git clone "repositorio"

#FASE 1 - Descargar Nginx:alpine

$docker pull nginx:alpine
$docker images

#FASE 2 - Crear container

$docker create --name web-server -it -p 8080:80 nginx:alpine 

#FASE 3 - Levantar y comprobar

$docker start web-server
$curl localhost:8080

#FASE 4 - Copiar la pagina web

Desde la carpeta P01_servidor_html
$docker cp ./html/index.html web-server:/usr/share/nginx/html

#FASE 5 Ejecutar comandos en el contenedor

$docker exec -it web-server sh
/ # chown -R root:root /usr/share/nginx/html
/ # find /usr/share/nginx/html -type d -exec chmod 755 {} \;
/ # find /usr/share/nginx/html -type f -exec chmod 644 {} \;
/ # ls -l /usr/share/nginx/html/
/ # exit

#FASE 6 - Logs

Deja el log abierto para actualizarlo en tiempo real.
$docker logs -f web-server 

#FASE 7 - Crear imagen propia a partir del contenedor

commit CONTAINER [REPOSITORY[:TAG]]
$docker commit web-server robmosroc/web-server:v1 

#FASE 8 - Exportar la imagen a un archivo TAR

$docker save -o web-server.tar  robmosroc/web-server:v1
cp web-server.tar ./Documentos/development/practicas_docker/P01_Servidor_HTML/

#FASE 9.- Eliminar imagen local 

Parar y eliminar contenedor y luego imagen
$docker stop web-server 
$docker rm web-server 
$docker rmi robmosroc/web-server:v1 

#FASE 10 - Importar imagen desde archivo y levantar servicio

Cargar imagen desde un .tar
$docker load -i web-server.tar
Comprobar si aparece la imagen
$docker images
Crear y arrancar contenedor
$docker run --name web-server -p 8080:80 robmosroc/web-server:v1 
Comprobar si esta levantado el contenedor
$docker ps

#FASE 11 - Image build

Crear Dockerfile
Comando FROM para elegir la imagen
FROM nginx:latest
Comando COPY para poner el archivo index
COPY ./html/index.html /usr/share/nginx/html
Comando EXPOSE para abrir el puerto 80
EXPOSE 80

$Docker build para crear la imagen
$docker build -t robmosroc/web-server .

