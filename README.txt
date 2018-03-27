# videostore

Tienda de video.

phalconphp version: (2.0.2)
php        version: (5.6.30)
postgres   version: (9.6.2)
apache     version: (1.3)

## Requerimientos

- Phalconphp framework >= 2.0 o superior
- Apache Server >= 1.3 o superior
- PHP >= 5.0 o superior
- Postgres >= 7.2 o superior

## Instalación

Descarga paquete.

- https://phalconphp.com/en/download
- https://httpd.apache.org/download.cgi
- http://php.net/downloads.php
- https://www.postgresql.org//download/

## Documentación

- https://docs.phalconphp.com/es/3.3/introduction
- https://httpd.apache.org/docs/
- http://php.net/docs.php
- https://www.postgresql.org/docs/

## Configuración

Al crear la instanciación de la tienda de video se debe parametrizar las siguientes lineas en archivo app/config/config.php:

Configurar función de conexión a servidor y base de datos -> línea 5:
  return new \Phalcon\Config(array(
    'database' => array(
        'adapter'     => 'Postgresql',
        'host'        => 'localhost',
        'username'    => 'postgres',
        'password'    => '',
        'dbname'      => 'videostore',
        'client_encoding' => 'UNICODE'
    ),

- Base de datos: videostore.backup

## Versión
v1.0

## Licencia
[MIT License](LICENSE)


# Documentación

#### Instalacion y ejecución
1. Descargar archivos del proyecto 

2. Colocar en ubicación del equipo donde este instalado el servidor web. 

3. Configurar archivo app/config/config.php 

4. Ejecutar aplicación:
- Abrir navegador de preferencia y ejecutar url de acuerdo a configuración del servidor web instalado en el equipo.
