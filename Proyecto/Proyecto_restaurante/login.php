<!DOCTYPE html>

<?php
//Crear variable de session
session_start();
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body>
    <form method="post">
        <input type="text" id="user" name="user" placeholder="Introduce el usuario" required>
        <input type="password" id="pass" name="pass" placeholder="Introduce la contraseña" required>
        <input type="submit" value="ENTRAR">
    </form>

<?php
  //Recuperar los datos

    if (isset($_POST["user"])){

        //echo "<script languaje='javascript'>alert('Login incorrecto')</script>";
        //Recogiendo los datos del user y pass
        $user=$_POST["user"];
        $pass=$_POST["pass"];
        $tipouser="";

        //Conexion con la base de datos
        $connection = new mysqli("localhost", "merino", "1234", "proyecto");
        if ($connection->connect_errno) {
              printf("Connection failed: %s\n", $connection->connect_error);
              exit();
          }

        //Aqui ponemos $user y $pass porque recogemos las variables arriba por eso no usamos $_POST.
        $consulta="select * from usuarios where
          Username='".$user."' and Password=md5('".$pass."');";

        if ($result = $connection->query($consulta)) {

              //Si te devuelve 0 es que el usuario no esta en la base de datos.Sino si existe y mira en else
              if ($result->num_rows==0) {
                echo "EL USUARIO NO EXISTE";
              } else {
                  //Coge los datos devueltos por la consulta.
                  while($fila=$result->fetch_object()){
                      $tipouser=$fila->Tipo;
                    //Creamos la session
                    $_SESSION["user"]=$user;
                    $_SESSION["tipo"]=$tipouser;
                  }
                  //Si el tipo de usuario es administrador lo manda a indexadmin.php y si es usuario corriente lo manda indexuser.php .
                  if ($tipouser=="user"){
                      header("Location: indexuser.php");
                  }else{
                      header("Location: indexadmin.php");
                  }

              }

          } else {
            echo "Wrong Query";
          }

    }



?>
</body>
</html>
