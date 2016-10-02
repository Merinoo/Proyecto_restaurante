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
                          <li class="active"><a href="#"><?php echo $_SESSION["user"]; ?></a></li>
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
                            <li><a href="./index.php?logout=yes"><img id="cerrar_sesion" src="./logo/logout.png" /></a></li>
                      <?php endif ?>


                    <?php
                      if(empty($_GET["logout"])){
                      }else{
                        session_destroy();
                        header("Location: ./admin/index.php");
                      }
                    ?>


                      <div id="login" class="loginDialog">
                          <div>	<a href="#close" title="Close" class="close">X</a>
                               <h2><center>Login</center></h2>
                               <form method="post" action="../admin/indexadmin.php">
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
                    $consulta="select * from usuarios where Username='".$user."' and Password=md5('".$pass."');";

  //UPDATE usuarios SET idusuario=,Username=,Password=,Email=,Actividad=,Tipo=,Dni_usuario=,Nombre=,Apellidos=,Cpostal=,Telefono=,Sexo=,FNacimiento=,Direccion WHERE 1
                }

            ?>


      <div id='slidercentral'>
        <center>
          <form class="" action="#" method="post">
            <h2 style="margin-top:20px">Cambiar contraseña</h2>

            <table border=0 style="width:400px;">
              <tr>
                <td>Antigua contraseña:</td>
                <td> <input type="password" name="apass" style="width:100%;" value=""> </td>
              </tr>
              <tr>
                <td>Nueva contraseña: </td>
                <td> <input type="password" name="npass1" style="width:100%;" value=""> </td>
              </tr>
              <tr>
                <td>Repetir contraseña:</td>
                <td> <input type="password" name="npass2" style="width:100%;" value=""> </td>
              </tr>
              <tr>
                <td colspan="2"> <input type="submit" name="name" value="cambiar" style="float:right;"> </td>
              </tr>
            </table>


          <?php
            if(isset($_POST["apass"])){
                 $apass=$_POST["apass"]; //12345
                 $npass1=$_POST["npass1"]; //12
                 $npass2=$_POST["npass2"]; //12

                 if($npass1==$npass2){
                   $connection = new mysqli("localhost", "merino", "1234", "proyecto");
                   if ($connection->connect_errno) {
                         printf("Connection failed: %s\n", $connection->connect_error);
                         exit();
                   }
                   $consulta="SELECT * FROM usuarios WHERE Username='".$_SESSION["user"]."' AND Password=md5('$apass')";
                   if($result=$connection->query($consulta)){
                     if($result->num_rows==0){
                       echo '<p>El usuario tiene una pass diferente</p>';
                     }else{
                       echo "<p>El usuario tiene la pass $apass</p>";
                       $consultaModificarPass="UPDATE usuarios SET Password=md5('$npass1') WHERE Username='".$_SESSION["user"]."'";
                       $connection->query($consultaModificarPass);
                      header("Location: ./index.php");
                     }
                   }
                 }else{
                   echo '<p>No coinciden las nuevas contraseñas</p>';
                 }
            }
          ?>





          <form method="POST" action="#">

        <?php

          $connection = new mysqli("localhost", "merino", "1234", "proyecto");
          $consulta="select * FROM usuarios where Username='".$_SESSION["user"]."'";
          $result=$connection->query($consulta);
          while($fila=$result->fetch_object()){


    echo'

          <h2>Datos personales</h2>

          <table border=0 style="width:400px;">

            <tr>
              <td>DNI:</td>
              <td><input type="text" style="width:100%;" name="Dni_usuario" maxlength="9" size="18" placeholder="53344470H" value="'.$fila->Dni_usuario.'" required>
              <input type="hidden" name="idusu" maxlength="9" size="18" placeholder="53344470H" value="'.$fila->idusuario.'" required></td><br>
            </tr>

            <tr>
              <td>Nombre:</td>
              <td><input type="text" style="width:100%;" name="Nombre" maxlength="25" size="18" placeholder="Antonio Manuel"  value="'.$fila->Nombre.'" required></td>
            </tr>

            <tr>
              <td>Apellidos:</td>
              <td><input type="text" style="width:100%;" name="Apellidos" maxlength="25" size="18" placeholder="Merino Soto" value="'.$fila->Apellidos.'" required></td>
            </tr>

            <tr>
              <td>Direccion:</td>
              <td><input type="text" style="width:100%;" name="Direccion" maxlength="25" size="18"  placeholder="C/Argantonio Nº6" value="'.$fila->Direccion.'" required></td>
            </tr>

            <tr>
              <td>Teléfono:</td>
              <td><input type="text" style="width:100%;" name="Telefono" maxlength="9" size="18" placeholder="679210535" value="'.$fila->Telefono.'" required></td><br>
            </tr>

            <tr>
              <td>C.Postal:</td>
              <td><input type="text"  style="width:100%;" name="CPostal" maxlength="5" size="18" placeholder="41900" value="'.$fila->Cpostal.'" required></td>
            </tr>

            <tr>
              <td>Sexo:</td>';
              if($fila->Sexo=='Hombre'){
              echo    '<td><input type="radio" name="Sexo" value="Hombre" checked>Hombre<Input type="radio" name="Sexo" value="Mujer">Mujer </td>';
              }else{
              echo    '<td><input type="radio" name="Sexo" value="Hombre">Hombre<Input type="radio" name="Sexo" value="Mujer" checked>Mujer </td>';
              }
              echo '
            </tr>

            <tr>
              <td>F.Nacimiento:</td>
              <td><input type="date" style="width:100%;" name="FNacimiento" size="18" placeholder="1990-12-27" value="'.$fila->FNacimiento.'" /></td>
            </tr>

            <tr>
              <td>Email:</td>
              <td><input type="text" style="width:100%;" name="Email" maxlength="35" size="18" placeholder="amerino96@gmail.com"  value="'.$fila->Email.'" required></td>
            </tr>

            <tr>
              <td>Tema:</td>
              <td><input type="number" min="1" max="3" style="width:100%;" name="Tema" maxlength="35" size="18" placeholder="amerino96@gmail.com"  value="'.$fila->Tema.'" required></td>
            </tr>

            <tr>
            <td colspan="2" align="right"><input type="submit" value="Enviar"></td>
            </tr>

          </table>';
}
          ?>
          </form>
          <?php

          if(isset($_POST["Nombre"])){


          $DNI=$_POST["Dni_usuario"];
          $Nombre=$_POST["Nombre"];
          $Apellidos=$_POST["Apellidos"];
          $Direccion=$_POST["Direccion"];
          $Telefono=$_POST["Telefono"];
          $CPostal=$_POST["CPostal"];
          $Sexo=$_POST["Sexo"];
          $FNacimiento=$_POST["FNacimiento"];
          $Email=$_POST["Email"];
          $Tema=$_POST["Tema"];
          $idusu=$_POST["idusu"];
          //UPDATE usuarios SET Password=md5('$Password'),Email='$Email',Dni_usuario='$DNI',Nombre='$Nombre',Apellidos="$Apellidos",Cpostal=$CPostal,Telefono=$Telefono,Sexo=$Sexo,FNacimiento='$FNacimiento',Direccion='$Direccion' WHERE Idusuario=$idusu
          //var_dump($Usuario,$Password,$DNI,$Nombre,$Apellidos,$Direccion,$Telefono,$CPostal,$Sexo,$FNacimiento,$Email);

          //Conexion con la base de datos
          $connection = new mysqli("localhost", "merino", "1234", "proyecto");
          if ($connection->connect_errno) {
                printf("Connection failed: %s\n", $connection->connect_error);
                exit();
            }
          $consulta="UPDATE usuarios SET Email='$Email',Dni_usuario='$DNI',Nombre='$Nombre',Apellidos='$Apellidos',Cpostal=$CPostal,Telefono=$Telefono,Sexo='$Sexo',FNacimiento='$FNacimiento',Direccion='$Direccion',Tema=$Tema WHERE idusuario=$idusu";
          if($result=$connection->query($consulta)){
            //header("Location: admin_usuarios.php");
            $_SESSION["tema"]=$Tema;
            //echo $consulta;
            echo '<p><b>Consulta actualizada</b></p>';
            header("Location: ./index.php");


          }else{
            echo $connection->error;
          }
        }
          ?>

          <form class="" action="#" method="post">
            <input type="submit" value="Darse de baja" id="baja" name="baja">
          </form>

          <?php
          if(isset($_POST["baja"])){
            include("conexion.php");
            $consulta="UPDATE usuarios SET Actividad='Inactivo' WHERE Username='".$_SESSION["user"]."'";
            $connection->query($consulta);
            echo $connection->error;
            session_destroy();
            header("Location: index.php");

          }else{
          }
          ?>
        </center>
      </div>
    </div>

          <div id='pie'>
            © 2015 BAR MERI España. Todos los derechos reservados.
          </div>

      </div>
    </body>
</html>
