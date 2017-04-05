Proyecto PHP con el framework Codeigniter para gestionar las valoraciones de películas.

Para el uso y verificación de este proyecto es recomendable seguir las instrucciones:

Dentro de la carpeta \application\config esta el archivo de configuracion config.php y databese.php. Con el primero se configura el proyecto de codeigniter y con el segundo se configura la conexion a la base de datos. Si se va verificar de manera local o en un servidor remoto se debe cambiar la url base del proyecto en el archivo config.php

<code>$config['base_url'] = 'http://localhost/Valoraciones/';</code><br>
Actualmente esta asi pero si se verifica en un servidor remoto, se modifica localhost por la ip del servidor

Si el administrador de base de datos de mysql usa contraseña, esta se agregar al archivo database.php en la linea de codigo:

<code>$db['default']['password'] = '';</code><br>
Actualmente no se usa contraseña porque el administrador de base datos usado no tenia contraseña para el acceso a las bases de datos.
