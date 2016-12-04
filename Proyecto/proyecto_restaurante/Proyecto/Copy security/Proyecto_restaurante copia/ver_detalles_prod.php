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
    <link href="./Css/contacto.css" rel="stylesheet" type="text/css">
    <link href="./Css/login.css" rel="stylesheet" type="text/css">

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

     <!-- Tenemos que poner el css del login sino el cuadro no aparecera -->
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
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
                            $connection = new mysqli("localhost", "merino", "1234", "proyecto");
                            if ($connection->connect_errno) {
                                  printf("Connection failed: %s\n", $connection->connect_error);
                                  exit();
                            }

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
                          <li><a href="ver_detalles_prod.php?logout=yes"><img id="cerrar_sesion" src="./logo/logout.png" /></a></li>
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


          <div id='slidercentral' >
              <div class="" style="position:relative;width:80%;height:40px;border:solid black 1px;top:30px;margin:0 auto;">
                <h2 style="position:relative;font-family:sans-serif;top:-10px">DETALLES DEL PRODUCTO</h2>
              </div>
              <div class="" style="position:relative;width:80%;height:300px;top:40px;margin:0 auto;">
                  <div class="" style="float:left;border:solid black 1px;width:40%;height:100%;">

                    <?php
                    include("./conexion.php");

                    $consulta="select * from producto where IdProducto='".$_GET["codigoprod"]."';";
                    if($result=$connection->query($consulta)){
                      while ($fila=$result->fetch_object()) {
                          echo '<img src="./Imagenes_menu/'.$fila->Imagen.'" style="width:100%;height:100%;" alt="" />';
                      }
                    }
                     ?>
                  </div>
                  <div style="float:right;border:solid black 1px;width:55%;height:100%;">
                    <table>
                      <?php
                      include("./conexion.php");

                        $consulta="select * from producto where IdProducto='".$_GET["codigoprod"]."';";
                        if($result=$connection->query($consulta)){
                          while ($fila=$result->fetch_object()) {
                              echo '<tr>
                                      <td>Tipo: </td>
                                      <td>'.$fila->Tipo_producto.'</td>
                                    </tr>
                                    <tr>
                                      <td>Nombre: </td>
                                      <td>'.$fila->Nombre.'</td>
                                    </tr>
                                    <tr>
                                      <td>Precio: </td>
                                      <td>'.$fila->Precio.'€</td>
                                    </tr>
                                    <tr>
                                      <td>Cantidad: </td>
                                      <td>'.$fila->Cantidad.'</td>
                                    </tr>';
                              if(isset($_SESSION["tipo"])){
                                    echo '<tr>
                                            <td>
                                                <form class="" action="#" method="post">
                                                  <input type="hidden" name="idproducto" value="'.$fila->IdProducto.'">
                                                  <input type="submit" name="añadircarrito" value="Añadir al carrito">
                                                </form>
                                            </td>
                                          </tr>';
                              }

                          }
                        }
                       ?>
                    </table>
                    <?php
                    if(isset($_POST["idproducto"])){
                      $idproducto=$_POST["idproducto"];

                      include("./conexion.php");

                      $consultaUser="SELECT idusuario FROM usuarios WHERE Username='".$_SESSION["user"]."'";
                      $result=$connection->query($consultaUser);
                      $fila=$result->fetch_object();

                      $idUsuarioLogeado=$fila->idusuario;

                      $consulta = "SELECT * FROM cesta,producto WHERE cesta.Producto_IdProducto = producto.IdProducto AND cesta.Usuarios_idusuario = $idUsuarioLogeado AND cesta.Producto_IdProducto = $idproducto";
                      if($result = $connection->query($consulta)){
                          if($result->num_rows==0){
                            $consultaInsertarCesta = "INSERT INTO cesta VALUES(".$idUsuarioLogeado.",".$idproducto.",1)";
                            $connection->query($consultaInsertarCesta);
                            header("Location: ./ver_detalles_prod.php?codigoprod=".$idproducto);
                          }else{
                            $consultaActualizarProductoCesta = "UPDATE cesta SET Cantidad = (Cantidad + 1) WHERE Producto_IdProducto = $idproducto AND Usuarios_idusuario = $idUsuarioLogeado";
                            $connection->query($consultaActualizarProductoCesta);
                            header("Location: ./ver_detalles_prod.php?codigoprod=".$idproducto);
                          }
                        }
                    }


                     ?>
                  </div>
              </div>

          </div>

          <div id='pie'>
            © 2015 BAR MERI España. Todos los derechos reservados.
          </div>

      </div>
    </body>
</html>
