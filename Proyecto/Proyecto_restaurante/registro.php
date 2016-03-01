<!DOCTYPE html>
<?php
  ob_start();
   session_start();
  if(isset($_SESSION["tipo"])){
    if( $_SESSION["tipo"]=="admin"){
        header("Location: ./admin/indexadmin.php");
    }elseif($_SESSION["tipo"]=="user"){

    }
  }else{
  }
?>
<html lang="">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <link rel="stylesheet" type="text/css" href=" ">
    </head>
    <body style="background-image:url('./logo/fondo.jpg')">

        <?php if (!isset($_POST["Nombre"])) : ?>
      <center>
      <h1>Registro de usuario</h1>

      <h2>Campos requerido para la conexión</h2>

      <form method="POST" action="registro.php">
      <table border=0>

        <tr>
          <td>Usuario:</td>
          <td><input type="text" name="Username" maxlength="25" size="18" placeholder="merino"  required></td>
        </tr>

        <tr>
          <td>Contraseña:</td>
          <td><input type="password" name="Password" maxlength="15"size="18" placeholder="*****" required></td>
        </tr>

      </table>

      <h2>Datos personales</h2>

      <table border=0>

        <tr>
          <td>DNI:</td>
          <td><input type="text" name="Dni_usuario" maxlength="9" size="18" placeholder="53344470H" required></td><br>
        </tr>

        <tr>
          <td>Nombre:</td>
          <td><input type="text" name="Nombre" maxlength="25" size="18" placeholder="Antonio Manuel" required></td>
        </tr>

        <tr>
          <td>Apellidos:</td>
          <td><input type="text" name="Apellidos" maxlength="25" size="18" placeholder="Merino Soto" required></td>
        </tr>

        <tr>
          <td>Direccion:</td>
          <td><input type="text" name="Direccion" maxlength="25" size="18"  placeholder="C/Argantonio Nº6" required></td>
        </tr>

        <tr>
          <td>Teléfono:</td>
          <td><input type="text" name="Telefono" maxlength="9" size="18" placeholder="679210535" required></td><br>
        </tr>

        <tr>
          <td>C.Postal:</td>
          <td><input type="text" name="CPostal" maxlength="5" size="18" placeholder="41900" required></td>
        </tr>

        <tr>
          <td>Sexo:</td>
          <td><input type="radio" name="Sexo" value="Hombre">Hombre<Input type="radio" name="Sexo" value="Mujer">Mujer </td>
        </tr>

        <tr>
          <td>F.Nacimiento:</td>
          <td><input type="date" name="FNacimiento" size="18" placeholder="1990-12-27" ></td>
        </tr>

        <tr>
          <td>Email:</td>
          <td><input type="text" name="Email" maxlength="35" size="18" placeholder="amerino96@gmail.com" required></td>
        </tr>

        <tr>
        <td colspan="2" align="right"><input type="submit" value="Enviar"></td>
        </tr>

      </table>
      </form>
      <a href="index.php"><input type="submit" value="Volver"></a>
    </center>

    <?php else: ?>

    <?php

    $Usuario=$_POST["Username"];
    $Password=$_POST["Password"];

    $DNI=$_POST["Dni_usuario"];
    $Nombre=$_POST["Nombre"];
    $Apellidos=$_POST["Apellidos"];
    $Direccion=$_POST["Direccion"];
    $Telefono=$_POST["Telefono"];
    $CPostal=$_POST["CPostal"];
    $Sexo=$_POST["Sexo"];
    $FNacimiento=$_POST["FNacimiento"];
    $Email=$_POST["Email"];
    //var_dump($Usuario,$Password,$DNI,$Nombre,$Apellidos,$Direccion,$Telefono,$CPostal,$Sexo,$FNacimiento,$Email);

    //Conexion con la base de datos
    include("./conexion.php");

    $consulta="SELECT * FROM usuarios where Username='$Usuario' or Dni_usuario='$DNI'";
    if ($result = $connection->query($consulta)) {

      //Si te devuelve 0 es que el usuario no esta en la base de datos.Sino si existe y mira en else
      if ($result->num_rows==0) {
        $consulta="INSERT INTO usuarios VALUES (null,'$Usuario',md5('$Password'),'$Email','Activo','user','$DNI','$Nombre','$Apellidos',$CPostal,$Telefono,'$Sexo',$FNacimiento,'$Direccion')";

       $connection->query($consulta);
       //var_dump($consulta);
       //echo $connection->error;
      } else {
        echo "El usuario ya exite o esta usando el mismo DNI de un usuario registrado anteriormente";
      }

      header('Location: index.php');

    }else {
      echo $connection->error;
    }

    ?>

    <?php endif ?>

    </body>
</html>
