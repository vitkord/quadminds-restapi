<h2 align="center"> Configuracion de entorno de desarrollo (Windows 10 y wampserver64), archivo httpd-vhosts :</h2>

<p>DocumentRoot "c:/wamp64/www/quadminds-restapi/public" </p>
<p>	ServerName quadminds-api.com </p>

<h2 align="center"> archivo hosts :</h2>

127.0.0.1 quadminds-api.com

<h2 align="center"> Conexion a la BD :</h2>

<p>DB_CONNECTION=mysql</p>
<p>DB_HOST=127.0.0.1</p>
<p>DB_PORT=3306</p>
<p>DB_DATABASE=quadminds</p>
<p>DB_USERNAME=qminds</p>
<p>DB_PASSWORD=quadminds123</p>

<h2 align="center"> Apache version</h2>

<p>2.4.37</p>
    
<h2 align="center"> PHP version</h2>

<p>7.2.14</p>

<h2 align="center"> MySQL version</h2>

<p>5.7.24</p>

<h2 align="center"> Pasos </h2>

<p>1- descargue el proyecto</p>
<p>2- ejecute el comando composer install para descargar las dependencias</p>
<p>3- ejecute el comando npm install para descargar la carpeta node_modules </p>
<p>4- ejecute npm run dev --save para hacer la build de la pagina en modo de desarrollo</p>

<p>5- Si le aparece el error 'No application encryption key has been specified.', ejecute "php artisan key:generate" dentro de la carpeta raiz del proyecto</p>

<p>http://quadminds-api.com/api/notes <-- Ruta de la API</p>

<p>http://quadminds-api.com/ <-- Ruta del Front</p>
    


