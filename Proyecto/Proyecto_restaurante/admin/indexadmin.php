<!DOCTYPE html>

<?php
//Crear variable de session
session_start();
?>

<html>
  <head>
    <meta charset="UTF-8">
    <title></title>
    <link href="../Css/indexhtml.css" rel="stylesheet" type="text/css">
    <link href="../Css/login.css" rel="stylesheet" type="text/css"> <!-- Tenemos que poner el css del login sino el cuadro no aparecera -->

    <!-- Estas son las librerias de ajax y bootstrap online que necesito para el slidercentral -->

    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>

    <style>
    .carousel-inner > .item > img,
    .carousel-inner > .item > a > img {
        width:1300px;
        height:740px;
        margin: auto;
        margin-top:0px;
    }
    </style>

  </head>

    <body style="background-image:url('../logo/fondo.jpg')">

      <div id='global'>
          <div id='menucabecera'>

              <div id="logo">
              </div>

              <div id="menu">
                <ul>
                  <li class="active"><a href="../admin/indexadmin.php">Inicio</a></li>
                  <li><a href="../admin/admin_usuarios.php">Usuarios</a></li>
                  <li><a href="../admin/admin_producto.php">Productos</a></li>
                  <li><a href="../admin/admin_pedidos.php">Pedidos</a></li>

                    <ul style="float:right; list-style-type:none;">

                  <!-- Aqui miramos si al darle al login esta logueado  o no -->
                  <!-- Si no esta logueado muestra el boton de login y mostrara luego el menú para loguearnos -->
                      <?php if(empty($_SESSION["user"])) : ?>
                          <li><a href="./registro.php">Registro</a></li>
                           <li><a href="#login">Login</a></li>

                  <!-- Si esta logueado mostrara el menu del usuario que se logueo -->
                  <!-- Añadimos al boton el enlace con valor logout yes-->
                      <?php else : ?>
                          <li><a href="./editar_admin_logeado.php"><?php echo $_SESSION["user"]; ?></a></li>
                          <li><a href="../index.php?logout=yes"><img id="cerrar_sesion" src="../logo/logout.png" /></a></li>
                      <?php endif ?>


                    <?php
                      if(empty($_GET["logout"])){
                      }else{
                        session_destroy();
                        header("Location: ../admin/indexadmin.php");
                      }
                    ?>


                      <div id="login" class="loginDialog">
                          <div>	<a href="#close" title="Close" class="close">X</a>
                               <h2><center>Login</center></h2>
                               <form method="post" action="./index.php">
                                 <table>
                                   <tr>
                                      <td><input type="text" id="user" name ="user" placeholder="Usuario"></td>
                                   </tr>
                                   <tr>
                                      <td><input type="password" id="pass" name="pass" placeholder="Contraseña"></td>
                                   </tr>
                                   <tr>
                                     <td><input class="btn-style" type="submit" value="Entrar"/></td>
                                   </tr>
                                   <tr><td><a href="#" id="olvido_contrasena">¿Olvido su Contraseña?</a></td></tr>
                                 </table>
                               </form>
                          </div>
                      </div>

                    </ul>
                </ul>
              </div> <!-- Cierra <div id="menu"> -->
            </div> <!-- Cierra <div id='menucabecera'> -->

            <?php
              //Recuperar los datos
                 if (isset($_POST["user"])){

                    //Recogiendo los datos del user y pass
                    $user=$_POST["user"];
                    $pass=$_POST["pass"];
                    $tipouser="";

                    //Conexion con la base de datos
                    include("../conexion.php");

                    //Aqui ponemos $user y $pass porque recogemos las variables arriba por eso no usamos $_POST.
                    $consulta="select * from usuarios where Username='".$user."' and Password=md5('".$pass."');";

                    if ($result = $connection->query($consulta)) {

                          //Si te devuelve 0 es que el usuario no esta en la base de datos.Sino si existe y mira en else
                          if ($result->num_rows==0) {
                            //echo "EL USUARIO NO EXISTE";
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
                                  header("Location: ../index.php");

                              }else{
                                  header("Location: ../admin/indexadmin.php");
                              }

                          }

                      } else {

                      }

                }

            ?>


      <div id='slidercentral'>

        <div style="width:100%:position:relative;">
          <center>
          ZONA DE ADMINISTRACION DE LA WEB
          <img src="../admin/area_administrativa.jpg"></img>
          </center>


      </div>
    </div>

          <div id='pie'>
            © 2015 BAR MERI España. Todos los derechos reservados.
          </div>

      </div>
    </body>
</html>
