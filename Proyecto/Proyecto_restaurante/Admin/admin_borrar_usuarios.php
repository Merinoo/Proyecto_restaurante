<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Borrar</title>
  </head>
  <body>
  <?php

  //Creamos la conexión 1=Localhost  2="usuario" 3="Contraseña" 4="Base_de_datos"
  $connection = new mysqli("localhost", "merino", "1234", "proyecto");


  $valor=$_GET ["idusuario"]; //Para guardar el parametro en una variable
  //$connection->query  //Para hacer consultas

  //Borro primero los datos de las primera 4 tablas para poder borrar reparaciones
  $connection->query ("DELETE FROM usuarios where idusuario=$valor");

  //  unset($connection);
  header("refresh:0; url=admin_usuarios.php");

  ?>


  </body>
</html>
