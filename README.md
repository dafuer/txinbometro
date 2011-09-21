Proyecto Desymfony
==================

Este repositorio alberga el código fuente de la aplicación creada para el
control del consumo de vehiculos. El nombre viene de la peña motera en sobre
la que la idea nacio, los Txinboraiders (http://www.txinboraiders.org)


Instalación y configuración
---------------------------

### Instalación ###

  1. Crea un directorio para el proyecto: `mkdir /proyectos/txinbometro`
  2. Clona el repositorio `desymfony` en ese directorio:
  `git clone git@github.com:dafuer/txinbometro.git /proyectos/txinbometro`
  3. Ejecuta el comando `/proyectos/desymfony/bin/vendors install` para descargar
  o actualizar las librerías externas de Symfony2. Este comando puede tardar
  un buen rato en completarse.

### Configuración de la base de datos ###

La aplicación necesita una base de datos de tipo SQL para guardar su 
información. Por defecto el proyecto utiliza una base de datos local llamada
`txinbometro` a la que puede acceder un usuario llamado también `txinbometro` y 
cuya contraseña es `txinbometro`.

Si quieres utilizar otros valores o tu base de datos no es MySQL, puedes 
configurarlo en las primeras líneas del archivo `app/config/parameters.ini`:

```ini
[parameters]
    database_driver="pdo_mysql"
    database_host="localhost"
    database_name="txinbometro"
    database_user="txinbometro"
    database_password="txinbometro"
```

Una vez configurado el acceso a la base de datos, debes crear la base de datos 
del proyecto y toda su estructura de tablas. Para ello, ejecuta los dos
siguientes comandos:

```
php app/console doctrine:database:create

Seguido crea la estructura de la base de datos. Para ello se dispone de un archivo
 *.sql almacenado en src/DS/TxinbometroBundle/resources/sql/txinbometro.sql . Si
te preguntas porque no se utiliza la tarea propuesta por doctrine (php app/console 
doctrine:schema:create) el motivo es que el SQL es capaz de personalizar mas y
optimizar el uso de MySQL. Si decides utilizar otro motor tal vez deberías probar
con la tarea ofrecida por Doctrine como mecanismo por defecto. En este caso, tal
vez surjan algunos problemas que deberás ir puliendo. Ya me contarás;)


```

### Configuración del servidor web ###

Para probar el proyecto fácilmente, es recomendable crear un *host virtual* en 
tu servidor web local. Añade en primer lugar la siguiente línea en el archivo 
`/etc/hosts`:

```
127.0.0.1    txinbometro.local
```

Después, configura el *host* en el servidor web. Si utilizas por ejemplo 
Apache, debes añadir lo siguiente en su archivo de configuración:

```
# Desymfony 2011
<VirtualHost *:80>
    DocumentRoot   "/proyectos/txinbometro/web"
    DirectoryIndex app.php
    ServerName     txinbometro.local

    <Directory "/proyectos/txinbometro/web">
        AllowOverride All
        Allow from All
    </Directory>
</VirtualHost>
```


Para terminar, no olvides reiniciar el servidor web. (sudo /etc/init.d/apache2 restart


### Probando el proyecto ###

Después de la configuración anterior, ya puedes acceder al entorno de 
desarrollo de la aplicación en `http://txinbometro.local/app_dev.php`. El 
entorno de producción es accesible en `http://txinbometro.local/`



Si se produce algún error, es posible que el servidor web no tenga permiso de 
escritura en los directorios de la caché y de los logs. Ejecuta `chmod -R 777 
/proyectos/desymfony/app/cache /proyectos/desymfony/app/logs` y el error ya no 
debería mostrarse. Pese a ello, esta tecnica no es la óptima pues es necesario
que tanto el usuario de apache como el tuyo sea capaz de escribir en estos 
directorios. Será necesario, por lo tanto, para configurarlo perfectamente hacer
uso de ACL. En el caso de ubunto deberás de instalar y activar estas funcionalidades
 y, hecho esto, deberás configurar los directorios con los siguientes permisos:

sudo setfacl -R -m u:www-data:rwx -m u:TuUsuario:rwx app/cache app/logs
sudo setfacl -dR -m u:www-data:rwx -m u:TuUsuario:rwx app/cache app/logs

Para probar mejor el proyecto, es muy recomendable cargar los datos de prueba
(*fixtures*) de la aplicación. 


- ESTA SECCION ESTA SIN TERMINAR
 FALTAN LAS FIXTURESSSS

Primero, recuerda que debes haber creado el schema en MySQL con el siguiente
comando:

```
php /proyectos/desymfony/app/console doctrine:schema:create
```

Ahora, ejecuta el siguiente comando para cargar los datos de prueba:

```
php /proyectos/desymfony/app/console doctrine:fixtures:load
```

QUE DATOS DE PRUEBA CREO? EXPLICARLOS AQUI


#### Parte pública o *frontend* ####

Puedes acceder a la parte pública en `http://txinbometro.local/app_dev.php` 
(entorno de desarrollo) y `http://txinbometro.local/` (entorno de producción).

Si quieres utilizar todas las características de la aplicación, debes acceder
como un usuario registrado. Para ello, pulsa el enlace *login*

Las credenciales por defecto para acceder al *frontend como usuario* son:

  * **usuario**: usuario**X**@desymfony.com
  * **password**: usuario**X**

  Donde la **X** es cualquier número del 1 al 100.

  **Nota**: Estos usuarios sólo funcionan si has usado el comando
  `doctrine:fixtures:load`, para cargar los datos de prueba (*fixtures*).

También puedes registrarte como nuevo usuario. Para ello pulsa el botón
*Regístrate* que se muestra en el lateral de todas las páginas.

#### Parte de administración o *backend* ####

La parte de administración de la aplicación se accede desde 
`http://desymfony.local/app_dev.php/admin` (entorno de desarrollo) o 
`http://desymfony.local/admin` (entorno de producción).

Por defecto existen dos usuarios de tipo administrador. Sus credenciales de
acceso son las siguientes:

  * Primer usuario:
      * **usuario**: `desymfony`
      * **password**: `desymfony`
  * Segundo usuario:
      * **usuario**: `admin`
      * **password**: `admin`

Puedes cambiar sus credenciales o crear nuevos usuarios de tipo administrador
en el archivo `app/config/security.yml`.


-- FIN DE SECCION SIN TERMINAR


Apuntes a Desarrolladores
-------------------------

- SECCIÓN POR HACER





Sobre los autores
-----------------

El proyecto ha sido desarrollado por:

  * David Fuertes @dafuer