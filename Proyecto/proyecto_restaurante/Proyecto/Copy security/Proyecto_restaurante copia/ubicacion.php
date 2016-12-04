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
                  <li class="active"><a href="./ubicacion.php">Ubicación</a></li>
                    <ul style="float:right; list-style-type:none;">

                  <!-- Aqui miramos si al darle al login esta logueado  o no -->
                  <!-- Si no esta logueado muestra el boton de login y mostrara luego el menú para loguearnos -->
                      <?php if(empty($_SESSION["user"])) : ?>
                           <li><a href="#login">Login</a></li>
                  <!-- Si esta logueado mostrara el menu del usuario que se logueo -->
                  <!-- Añadimos al boton el enlace con valor logout yes-->
                      <?php else : ?>
                        <li ><a href="./pedidos_usuario_logeado.php">Mis pedidos</a></li>
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
                    $consulta="select * from usuarios where Username='".$user."' and Password=md5('".$pass."');";

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


          <div id='slidercentral' style="background-image:url('./logo/fondo.jpg')" >


            <div id="mapa">
              <center>
                <h1>Ubicación del sitio</h1>
              <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d5487.584321657481!2d-6.040182601360675!3d37.38870278352804!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xd126c9a58c43309%3A0x554e1ff58b68838e!2sCalle+Almer%C3%ADa%2C+41910+Camas%2C+Sevilla!5e0!3m2!1ses!2ses!4v1454677864634" width="700" height="550" frameborder="0" style="border:0" allowfullscreen></iframe>
              <p><b>Email:</b>barmeri@gmail.com <b>Teléfono:</b>954-39-18-11</p>
              </center>
            </div>
          </div>

          <div id='pie'>
            © 2015 BAR MERI España. Todos los derechos reservados.
          </div>

      </div>
    </body>
</html>
