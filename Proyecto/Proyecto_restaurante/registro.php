<!DOCTYPE html>
<html lang="">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <link rel="stylesheet" type="text/css" href=" ">
    </head>
    <body>

        <?php if (!isset($_POST["Nombre"])) : ?>
      <center>
      <h1>Registro de usuario</h1>

      <h2>Campos requerido para la conexión</h2>

      <table border=0>

        <tr>
          <td>Usuario:</td>
          <td><input type="text" name="Usuario" maxlength="25" size="18" placeholder="merino" required></td>
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
          <td><input type="text" name="DNI" maxlength="9" size="18" placeholder="53344470H" required></td><br>
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
          <td><input type="text" name="Dirección" maxlength="25" size="18"  placeholder="C/Argantonio Nº6" required></td>
        </tr>

        <tr>
          <td>Teléfono:</td>
          <td><input type="text" name="Teléfono" maxlength="9" size="18" placeholder="679210535" required></td><br>
        </tr>

        <tr>
          <td>C.Postal:</td>
          <td><input type="text" name="C.Postal" maxlength="5" size="18" placeholder="41900" required></td>
        </tr>

        <tr>
          <td>Sexo:</td>
          <td><input type="radio" name="Sexo" value="Hombre">Hombre<Input type="radio" name="Sexo" value="Mujer">Mujer </td>
        </tr>

        <tr>
          <td>F.Nacimiento:</td>
          <td><input type="date" name="F.Nacimiento" size="18" placeholder="1990-12-27" ></td>
        </tr>

        <tr>
          <td>Email:</td>
          <td><input type="text" name="email" maxlength="35" size="18" placeholder="amerino96@gmail.com" required></td>
        </tr>

        <tr>
        <td colspan="2" align="right"><input type="submit" value="Enviar"></td>
        </tr>

      </table>
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
    $C.Postal=$_POST["C.postal"];
    $Sexo=$_POST["Sexo"];
    $F.Nacimiento=$_POST["F.Nacimiento"];
    $Email=$_POST["Email"];

    ?>

    <?php endif ?>

    </body>
</html>
