<!DOCTYPE html>
<?php
//Crear variable de session
session_start();
?>
<html>
  <head>
    <meta charset="UTF-8">
    <title></title>
    <link href="./Css/indexhtml.css" rel="stylesheet" type="text/css">
      <link href="./Css/login.css" rel="stylesheet" type="text/css">

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

    <body style="background-image:url('./logo/fondo.jpg')">

      <div id='global'>
          <div id='menucabecera'>

              <div id="logo">

              </div>

              <div id="menu">
                <ul>
                  <li><a class="active" href="./menu.html">USUARIOS</a></li>
                  <li><a href="./redes_sociales.html">PRODUCTOS</a></li>
                  <li><a href="./contacto.html">PEDIDOS</a></li>
                  <li><a href="./contacto.html">EMPLEADOS</a></li>
                    <ul style="float:right;list-style-type:none;">
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


      <div id='slidercentral'>
        <div class="col-md-offset-1 col-md-10 " style="margin-top:2%">
        <table class="table">
            <tr>
              <th>Usuario</th>
              <th>Email</th>
              <th>Tipo</th>
              <th>DNI</th>
              <th>Nombre</th>
              <th>Apellidos</th>
              <th>Telefono</th>
              <th>Operaciones</th>
            </tr>
        <?php
        $connection = new mysqli("localhost", "merino", "1234", "proyecto");
        if ($connection->connect_errno) {
              printf("Connection failed: %s\n", $connection->connect_error);
              exit();
          }

        //INSERT INTO `usuarios`(`idusuario`, `Username`, `Password`, `Email`, `Actividad`, `Tipo`, `Dni_usuario`, `Nombre`, `Apellidos`, `C.postal`, `Telefono`, `Sexo`, `F.Nacimiento`, `Direccion`)
        // VALUES ([value-1],[value-2],[value-3],[value-4],[value-5],[value-6],[value-7],[value-8],[value-9],[value-10],[value-11],[value-12],[value-13],[value-14])

        //Aqui ponemos $user y $pass porque recogemos las variables arriba por eso no usamos $_POST.
        $consulta="select * from usuarios";

        if ($result = $connection->query($consulta)) {

              //Si te devuelve 0 es que el usuario no esta en la base de datos.Sino si existe y mira en else
              if ($result->num_rows==0) {
                //echo "EL USUARIO NO EXISTE";
              } else {
                    while($fila=$result->fetch_object()){
                        echo "<tr>
                                <td>".$fila->Username."</td>
                                <td>".$fila->Email."</td>
                                <td>".$fila->Tipo."</td>
                                <td>".$fila->Dni_usuario."</td>
                                <td>".$fila->Nombre."</td>
                                <td>".$fila->Apellidos."</td>
                                <td>".$fila->Telefono."</td>
                                <td>
                                  <a href='admin_editar_usuarios.php?idusuario=".$fila->idusuario."'>Editar</a>
                                  <a href='admin_borrar_usuarios.php?idusuario=".$fila->idusuario."'>Borrar</a>
                              </td>
                              </tr>";
                    }
              }
        }

        ?>
      </table>
      </div>
      </div>

          <div id='pie'>
            © 2015 BAR MERI España. Todos los derechos reservados.
          </div>

      </div>
    </body>
</html>
