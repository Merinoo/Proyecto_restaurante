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
    header("Location: index.php");
  }
?>
<html>
  <head>
    <meta charset="UTF-8">
    <title></title>
      <link href="./css/login.css" rel="stylesheet" type="text/css">

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

    <!-- Estas son las librerias de ajax y bootstrap online que necesito para el slidercentral -->

    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

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

    <body>

      <div id='global'>
          <div id='menucabecera'>

              <div id="logo">

              </div>

              <div id="menu">
                <ul>
                  <li><a href="./index.php">Inicio</a></li>
                  <li><a href="./menu.php">Menú</a></li>
                  <li><a href="./ubicacion.php">Ubicación</a></li>
                    <ul style="float:right;list-style-type:none;">

                  <!-- Aqui miramos si al darle al login esta logueado  o no -->
                  <!-- Si no esta logueado muestra el boton de login y mostrara luego el menú para loguearnos -->
                      <?php if(empty($_SESSION["user"])) : ?>
                           <li><a href="#login">Login</a></li>
                  <!-- Si esta logueado mostrara el menu del usuario que se logueo -->
                  <!-- Añadimos al boton el enlace con valor logout yes-->
                      <?php else : ?>
                          <li><a href="./pedidos_usuario_logeado.php">Mis pedidos</a></li>
                          <li><a href="./editar_usuario_logeado.php"><?php echo $_SESSION["user"]; ?></a></li>
                          <li class="active"><a href="./ver_cesta.php"><span class="glyphicon glyphicon-shopping-cart"></span>
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
                            <li><a href="./index.php?logout=yes"><img id="cerrar_sesion" src="./logo/logout.png" /></a></li>
                      <?php endif ?>


                    <?php
                      if(empty($_GET["logout"])){
                      }else{
                        session_destroy();
                        header("Location: ../index.php");
                      }
                    ?>


                      <div id="login" class="loginDialog">
                          <div>	<a href="#close" title="Close" class="close">X</a>
                               <h2><center>Login</center></h2>
                               <form method="post" action="./index.php">
                                 <table class="table">
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
              </div>
            </div>

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
                                  header("Location: ../index.php");

                              }else{
                                  header("Location: ../admin/indexadmin.php");
                              }

                          }

                      } else {

                      }

                }

            ?>


      <div id='slidercentral' style="border:solid red 1px">
        <center><H2>Cesta de <?php echo $_SESSION["user"] ?></H2> </center>
        <div id="tabla" class="container">
          <a href='./ver_cesta.php?hacerpedido=yes' ><button style="float:right;margin-bottom:10px;" type='button' class='btn btn-success'>Realizar pedido</button></a>

          <?php
              if(isset($_GET["hacerpedido"])){
                include("./conexion.php");

                $consultaRecuperarIdUsuario="SELECT idusuario FROM usuarios WHERE Username='".$_SESSION["user"]."'";
                $result= $connection->query($consultaRecuperarIdUsuario);
                $fila=$result->fetch_object();

                $idusuario=$fila->idusuario;

                $consultaRecogerCestaUsuario="SELECT cesta.Cantidad, producto.Precio,producto.IdProducto,cesta.Producto_IdProducto
                 FROM cesta,producto
                 WHERE cesta.Producto_IdProducto=producto.IdProducto AND cesta.Usuarios_idusuario='".$idusuario."'";

                if($result2=$connection->query($consultaRecogerCestaUsuario)){
                  if($result2->num_rows==0){
                    echo "No hay productos en la cesta para realizar el pedido";
                  }else{
                    $consultaPedido="INSERT INTO `pedidos`(`Usuario_idusuario`, `Fecha_pedido`,`Coste_total`) VALUES ($idusuario,CURRENT_TIMESTAMP(),0)";
                    $result= $connection->query($consultaPedido);

                    $consultaRecuperarMaxIdPedido="SELECT * FROM pedidos ORDER BY Num_pedido DESC LIMIT 1;";
                    $result3= $connection->query($consultaRecuperarMaxIdPedido);

                    $idNuevoPedido=0;
                    while($f=$result3->fetch_object()){
                      $idNuevoPedido=$f->Num_pedido;
                    }

                    echo $idNuevoPedido;
                    $precioTotalPedido=0;

                    while($fila=$result2->fetch_object()){
                      $consultaInsertDetallesLineaPedido="INSERT INTO `detalle_pedido`(`Cantidad`, `Pedidos_Num_pedido`, `Producto_IdProducto`)
                       VALUES (".$fila->Cantidad.",$idNuevoPedido,".$fila->Producto_IdProducto.")";
                      $connection->query($consultaInsertDetallesLineaPedido);
                      $cant=$fila->Cantidad;
                      $precio=$fila->Precio;
                      $precioTotalPedido= $precioTotalPedido +($cant*$precio);

                    }

                    $connection->query("UPDATE pedidos SET Coste_total = $precioTotalPedido WHERE Num_pedido=$idNuevoPedido");
                    $connection->query("DELETE FROM cesta WHERE Usuarios_idusuario=$idusuario");
                    header("Location: ./pedidos_usuario_logeado.php");

                  }
                }else{
                  echo $connection->error;
                }


              }
          ?>
        <table   style="margin-top:20px;text-align:center"  class="table">
            <tr class="active">
              <th style="text-align:center;">Imagen</th>
              <th style="text-align:center;">Producto</th>
              <th style="text-align:center;">Precio</th>
              <th style="text-align:center;">Cantidad</th>
              <th style="text-align:center;">Operaciones</th>

            </tr>

        <?php
        include("./conexion.php");

        //INSERT INTO `usuarios`(`idusuario`, `Username`, `Password`, `Email`, `Actividad`, `Tipo`, `Dni_usuario`, `Nombre`, `Apellidos`, `C.postal`, `Telefono`, `Sexo`, `F.Nacimiento`, `Direccion`)
        // VALUES ([value-1],[value-2],[value-3],[value-4],[value-5],[value-6],[value-7],[value-8],[value-9],[value-10],[value-11],[value-12],[value-13],[value-14])

        //Aqui ponemos $user y $pass porque recogemos las variables arriba por eso no usamos $_POST.
        $consulta="SELECT producto.Imagen,producto.Nombre,producto.Precio,cesta.Cantidad,producto.IdProducto FROM cesta,usuarios,producto WHERE producto.IdProducto=cesta.Producto_IdProducto AND cesta.Usuarios_idusuario=usuarios.idusuario AND usuarios.Username='".$_SESSION["user"]."'";

        if ($result = $connection->query($consulta)) {
              if ($result->num_rows==0) {
                //echo "EL USUARIO NO EXISTE";
              } else {
                    while($fila=$result->fetch_object()){
                        echo "<tr>
                                <td><img src='./Imagenes_menu/".$fila->Imagen."' style='width:40px;height:40px' alt='' /></td>
                                <td>$fila->Nombre</td>
                                <td>$fila->Precio</td>
                                <td>$fila->Cantidad</td>
                                <td>
                                  <a href='./ver_cesta.php?codproducto=".$fila->IdProducto."'><button type='button' class='btn btn-danger'>Borrar</button></a>
                                </td>
                              </tr>";
                    }
              }
        }else{
          echo $connection->error;
        }
        ?>
      </table>
      <?php
          if(isset($_GET["codproducto"])){
            $idproducto=$_GET["codproducto"];

            include("./conexion.php");

            $consultaRecuperarIdUsuario="SELECT idusuario FROM usuarios WHERE Username='".$_SESSION["user"]."'";
            $result= $connection->query($consultaRecuperarIdUsuario);
            $fila=$result->fetch_object();

            $idusuario=$fila->idusuario;

            $consultaBorrarCesta="DELETE FROM cesta WHERE Producto_IdProducto=$idproducto
            AND Usuarios_idusuario=$idusuario";

            $connection->query($consultaBorrarCesta);
            echo  $connection->error;
            echo  $consultaBorrarCesta;
            header("Location: ./ver_cesta.php");
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
