<p align="center"> Configuracion de entorno de desarrollo (Windows 10 y wampserver64), archivo httpd-vhosts :</p>

<VirtualHost *:80>
	DocumentRoot "c:/wamp64/www/proyecto-quadminds/public"
	ServerName quadminds-api.com
</VirtualHost>

<p align="center"> archivo hosts :</p>

127.0.0.1 quadminds-api.com

<p align="center"> Conexion a la BD :</p>

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=quadminds
DB_USERNAME=qminds
DB_PASSWORD=quadminds123
