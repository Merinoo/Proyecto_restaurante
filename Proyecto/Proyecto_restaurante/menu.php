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

<html>
  <head>
    <meta charset="UTF-8">
    <title></title>
    <link href="./css/menu.css" rel="stylesheet" type="text/css">
    <link href="./css/login.css" rel="stylesheet" type="text/css"> <!-- Tenemos que poner el css del login sino el cuadro no aparecera -->

    <?php
      if(isset($_SESSION["tipo"])){
        if($_SESSION["tema"]==1){
          echo '<link rel="stylesheet" href="./css/indexhtml.css">';
        }elseif($_SESSION["tema"]==2){
          echo '<link rel="stylesheet" href="./css/indexhtml2.css">';
        }elseif($_SESSION["tema"]==3){
          echo '<link rel="stylesheet" href="./css/indexhtml3.css">';
        }
      }else{
        echo '<link rel="stylesheet" href="./css/indexhtml.css">';
      }
    ?>

    <link rel="stylesheet" href="css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
    <script src="./js/bootstrap.min.js"></script>
  </head>

    <body>

      <div id='global'>
          <div id='menucabecera'>
              <div id="logo">
              </div>

              <div id="menu">
                <ul>
                  <li><a href="./index.php">Inicio</a></li>
                  <li class="active"><a href="./menu.php">Menú</a></li>
                  <li><a href="./ubicacion.php">Ubicación</a></li>
                    <ul style="float:right; list-style-type:none;">

                  <!-- Aqui miramos si al darle al login esta logueado  o no -->
                  <!-- Si no esta logueado muestra el boton de login y mostrara luego el menú para loguearnos -->
                      <?php if(empty($_SESSION["user"])) : ?>
                           <li><a href="#login">Login</a></li>
                  <!-- Si esta logueado mostrara el menu del usuario que se logueo -->
                  <!-- Añadimos al boton el enlace con valor logout yes-->
                      <?php else : ?>
                        <li><a href="./pedidos_usuario_logeado.php">Mis pedidos</a></li>
                          <li><a href="./editar_usuario_logeado.php"><?php echo $_SESSION["user"]; ?></a></li>
                          <li><a href="./ver_cesta.php"><span class="glyphicon glyphicon-shopping-cart"></span>
                            <?php
                            include("./conexion.php");

                            $user=$_SESSION["user"];
                            $consulta = "SELECT SUM(cesta.Cantidad) AS total FROM usuarios, cesta WHERE usuarios.idusuario = cesta.Usuarios_idusuario AND usuarios.Username = '".$user."';";
                            if($result = $connection->query($consulta)){
                                  $total=0;
                                  if($result->num_rows==0){
                                  }else{
                                      while($fila=$result->fetch_object()){
                                          $total=$total+$fila->total;
                                      }
                                  }
                                  echo " ($total)";
                            }
                             ?>
                          </a></li>
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
                    include("./conexion.php");

                    //Aqui ponemos $user y $pass porque recogemos las variables arriba por eso no usamos $_POST.
                    $consulta="select * from usuarios where Username='".$user."' and Password=md5('".$pass."') and Actividad='Activo';";

                    if ($result = $connection->query($consulta)) {

                          //Si te devuelve 0 es que el usuario no esta en la base de datos.Sino si existe y mira en else
                          if ($result->num_rows==0) {
                            //echo "EL USUARIO NO EXISTE";
                          } else {
                              //Coge los datos devueltos por la consulta.
                              while($fila=$result->fetch_object()){

                              $tipouser=$fila->Tipo;
                              $temauser=$fila->Tema;
                              //Creamos la session
                              $_SESSION["user"]=$user;
                              $_SESSION["tipo"]=$tipouser;
                              $_SESSION["tema"]=$temauser;
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

          <div id='slidercentral2' class="row" >
            <!-- se cargaran tantos divs como productos haya en la base de datos -->
            <div class="container" style="margin-botom:40px;margin-top:30px;">

            <?php
            //Conexion con la base de datos
            include("./conexion.php");

            //Aqui ponemos $user y $pass porque recogemos las variables arriba por eso no usamos $_POST.
            $consulta="select * from producto ";
            if(isset($_GET["tipo"])){
              if($_GET["tipo"]=="Comida" || $_GET["tipo"]=="Bebidas" || $_GET["tipo"]=="Postres" || $_GET["tipo"]=="Complementos" ){
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
                          <center><a style="text-decoration:none;font-weight:bold;" href="./ver_detalles_prod.php?codigoprod='.$fila->IdProducto.'"><h3 style="margin-top:0px">'.$fila->Nombre.'</h3></a></center>
                        </div>';
                      }


                  }

              } else {

              }


            ?>
            </div>
          </div>

          <div id='pie'>
            © 2015 BAR MERI España. Todos los derechos reservados.
          </div>

      </div>
    </body>
</html>
