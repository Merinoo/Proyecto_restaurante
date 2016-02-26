<!DOCTYPE html>

<?php
//Crear variable de session
session_start();
?>

<html>
  <head>
    <meta charset="UTF-8">
    <title></title>
    <link href="./Css/menu.css" rel="stylesheet" type="text/css">
    <link href="./Css/login.css" rel="stylesheet" type="text/css"> <!-- Tenemos que poner el css del login sino el cuadro no aparecera -->
  </head>

    <body  style="background-image:url('./logo/fondo.jpg');">

      <div id='global'>
          <div id='menucabecera'>
              <div id="logo">
              </div>

              <div id="menu">
                <ul>
                  <li><a class="active" href="./index.php">Inicio</a></li>
                  <li><a href="./menu.php">Menú</a></li>
                  <li><a href="./ubicacion.php">Ubicación</a></li>
                    <ul style="float:right; list-style-type:none;">
                  <li><a href="#about">Acerca de nosotros</a></li>

                  <!-- Aqui miramos si al darle al login esta logueado  o no -->
                  <!-- Si no esta logueado muestra el boton de login y mostrara luego el menú para loguearnos -->
                      <?php if(empty($_SESSION["user"])) : ?>
                           <li><a href="#login">Login</a></li>
                  <!-- Si esta logueado mostrara el menu del usuario que se logueo -->
                  <!-- Añadimos al boton el enlace con valor logout yes-->
                      <?php else : ?>
                          <li><a href="#"><?php echo $_SESSION["user"]; ?></a></li>
                          <li><a href="index.php?logout=yes"><img id="cerrar_sesion" src="./logo/logout.png" /></a></li>
                      <?php endif ?>


                    <?php
                      if(empty($_GET["logout"])){
                      }else{
                        session_destroy();
                        header("Location: index.php");
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
                    $connection = new mysqli("localhost", "merino", "1234", "proyecto");
                    if ($connection->connect_errno) {
                          printf("Connection failed: %s\n", $connection->connect_error);
                          exit();
                      }

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
                                  header("Location: index.php");

                              }else{
                                  header("Location: indexadmin.php");
                              }

                          }

                      } else {

                      }

                }

            ?>

            <div id='submenucabecera2'>
                <div id="submenu">
                  <ul>
                      <li class="">
                        <img src="./Imagenes_menu/bebidas.jpg"/>
                        <a href="./menu.php?tipo=Bebidas">Bebidas</a>
                      </li>

                      <li class="color_submenu2">
                        <img src="./Imagenes_menu/comidas.jpg"/>
                        <a href="./menu.php?tipo=Comida">Comidas</a>
                      </li>

                      <li class="color_submenu3">
                        <img src="./Imagenes_menu/postres.jpg"/>
                        <a href="./menu.php?tipo=Postres">Postres</a>
                      </li>

                      <li class="color_submenu4">
                        <img src="./Imagenes_menu/complementos.jpg"/>
                        <a href="./menu.php?tipo=Complementos">Complementos</a>
                      </li>
                  </ul>
                </div>
              </div>

          <div id='slidercentral' style="padding-left:5%; padding-top:2%">
            <!-- se cargaran tantos divs como productos haya en la base de datos -->

            <?php
            //Conexion con la base de datos
            $connection = new mysqli("localhost", "merino", "1234", "proyecto");
            if ($connection->connect_errno) {
                  printf("Connection failed: %s\n", $connection->connect_error);
                  exit();
              }

            //Aqui ponemos $user y $pass porque recogemos las variables arriba por eso no usamos $_POST.
            $consulta="select * from producto ";
            if(isset($_GET["tipo"])){
              if($_GET["tipo"]=="Comida" || $_GET["tipo"]=="Bebida" || $_GET["tipo"]=="Postres" || $_GET["tipo"]=="Complementos" ){
                $consulta=$consulta . " WHERE Tipo_producto='".$_GET['tipo']."'";
              }
            }

            if ($result = $connection->query($consulta)) {

                  //Si te devuelve 0 es que el usuario no esta en la base de datos.Sino si existe y mira en else
                  if ($result->num_rows==0) {
                    //echo "EL USUARIO NO EXISTE";
                  } else {
                      //Coge los datos devueltos por la consulta.
                      while($fila=$result->fetch_object()){
                          echo '<div style="border:solid black 1px;width:18%;margin-right:1.5%;height:280px;float:left;padding:5px 0px;margin-bottom:10px">
                          <img src="./Imagenes_menu/'.$fila->Imagen.'" style="width:70%;height:80%;margin-left:15%">
                          <center><a href="./ver_detalles_prod.php?codigoprod='.$fila->IdProducto.'"><h1 style="margin-top:0px">'.$fila->Nombre.'</h1></a></center>
                        </div>';
                      }


                  }

              } else {

              }


            ?>






          </div>

          <div id='pie'>
            © 2015 BAR MERI España. Todos los derechos reservados.
          </div>

      </div>
    </body>
</html>
