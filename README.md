# Aplicación de gestión de disciplina informativa ONEI

## Instalación

Crear una carpeta para el proyecto y copiar el contenido en la misma.

Conectado a internet ejecutar el comando `composer install` (este descargará todas las dependencias del proyecto y creará la carpeta vendor)

copiar `env` a `.env` y personaliza la app, específicamente las Secciones `ENVIROMENT` y `DATABASE` Ejemplo:

# ENVIRONMENT
CI_ENVIRONMENT = development

# DATABASE
database.default.hostname = localhost
database.default.database = indicadoresci
database.default.username = root
database.default.password = 
database.default.DBDriver = MySQLi
database.default.DBPrefix =
database.default.port = 3306

creas la base de dato ejecutando el siguiente comando desde la linea de comandos:

php spark db:create

esto creará la base de datos...

luego ejecutas las `migraciones` esto generará las tablas en la BD:

php spark migrate

Alimentar la base de datos (esto llena los nomencladores con los valores por defecto):

php spark db:seed UserSeeder
php spark db:seed MunicipioSeeder

Nota: se crea un usuario por defecto para la app

email: admin@onei.cu
password: 123456

cigniter trae su propio servidor web para desarrollo por lo que no tienes que configurar tu servidor local, para ejecutarlo es el siguiente comando:

php spark serve

con esto se levanta el server y puedes acceder website, si ves en la consola te indica como, pero puedes abrir en el navegador la url:

http://localhost:8080


Nota: He dejado una url para que puedes crear usuarios, con esta opción puedes `registrar` un usuario que puedes usar para loguearte y revisar el proyecto hasta donde está.


http://localhost:8080/auth/register


Revisa los requerimientos del servidor si tienes algún otro error, debe funcionar pero por si acaso...

## Server Requirements

PHP version 8.1 or higher is required, with the following extensions installed:

- [intl](http://php.net/manual/en/intl.requirements.php)
- [mbstring](http://php.net/manual/en/mbstring.installation.php)

> [!WARNING]
> The end of life date for PHP 7.4 was November 28, 2022.
> The end of life date for PHP 8.0 was November 26, 2023.
> If you are still using PHP 7.4 or 8.0, you should upgrade immediately.
> The end of life date for PHP 8.1 will be November 25, 2024.

Additionally, make sure that the following extensions are enabled in your PHP:

- json (enabled by default - don't turn it off)
- [mysqlnd](http://php.net/manual/en/mysqlnd.install.php) if you plan to use MySQL
- [libcurl](http://php.net/manual/en/curl.requirements.php) if you plan to use the HTTP\CURLRequest library
