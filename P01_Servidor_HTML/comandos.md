FASE 0 - Preparación

sudo apt update && sudo apt install git

sudo apt update && sudo apt install curl

git clone "repositorio"

FASE 1 - Descargar Nginx:alpine

$docker pull nginx:alpine
$docker images

FASE 2 - Crear container

$docker create --name web-server -it -p 8080:80 nginx:alpine 

FASE 3 - Levantar y comprobar

$docker start web-server
$curl localhost:8080

Fase 4 - Copiar la pagina web

Desde la carpeta P01_servidor_html
$docker cp ./html/index.html web-server:/usr/share/nginx/html


