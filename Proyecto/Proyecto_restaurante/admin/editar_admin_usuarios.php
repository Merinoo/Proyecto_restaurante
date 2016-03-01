<!DOCTYPE html>
<?php
  ob_start();
   session_start();
  if(isset($_SESSION["tipo"])){
    if( $_SESSION["tipo"]=="admin"){

    }elseif($_SESSION["tipo"]=="user"){
      header("Location: ../indexuser.php");
    }
  }else{
    header("Location: ../index.php");
  }
?>
<html>
  <head>
    <meta charset="UTF-8">
    <title></title>
    <link href="../Css/indexhtml.css" rel="stylesheet" type="text/css">
      <link href="../Css/login.css" rel="stylesheet" type="text/css">

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

    <body style="background-image:url('../logo/fondo.jpg')">

      <div id='global'>
          <div id='menucabecera'>

              <div id="logo">

              </div>

              <div id="menu">
                <ul>
                  <li><a  href="../admin/indexadmin.php">Inicio</a></li>
                  <li class="active"><a href="../admin/admin_usuarios.php">Usuarios</a></li>
                  <li><a href="../admin/admin_usuarios.php">Productos</a></li>
                  <li><a href="../admin/admin_pedidos.php">Pedidos</a></li>

                    <ul style="float:right;list-style-type:none;">

                  <!-- Aqui miramos si al darle al login esta logueado  o no -->
                  <!-- Si no esta logueado muestra el boton de login y mostrara luego el menú para loguearnos -->
                      <?php if(empty($_SESSION["user"])) : ?>
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
                        header("Location: ../admin/index.php");
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
                    include("../conexion.php");


                    //Aqui ponemos $user y $pass porque recogemos las variables arriba por eso no usamos $_POST.
                    $consulta="select * from usuarios where Username='".$user."' and Password=md5('".$pass."');";

  //UPDATE usuarios SET idusuario=,Username=,Password=,Email=,Actividad=,Tipo=,Dni_usuario=,Nombre=,Apellidos=,Cpostal=,Telefono=,Sexo=,FNacimiento=,Direccion WHERE 1
                }

            ?>


      <div id='slidercentral'>
        <center>

          <form method="POST" action="#">
        <?php

        include("../conexion.php");
          $valor=$_GET ["idusuario"];
          $consulta="select * FROM usuarios where idusuario=$valor";
          $result=$connection->query($consulta);
          $fila=$result->fetch_object();


    echo'<table border=0>

          <h2>Datos personales</h2>

          <table border=0>

            <tr>
              <td>DNI:</td>
              <td><input type="text" name="Dni_usuario" maxlength="9" size="18" placeholder="53344470H" value="'.$fila->Dni_usuario.'" required>
              <input type="hidden" name="idusu" maxlength="9" size="18" placeholder="53344470H" value="'.$valor.'" required></td><br>
            </tr>

            <tr>
              <td>Nombre:</td>
              <td><input type="text" name="Nombre" maxlength="25" size="18" placeholder="Antonio Manuel"  value="'.$fila->Nombre.'" required></td>
            </tr>

            <tr>
              <td>Apellidos:</td>
              <td><input type="text" name="Apellidos" maxlength="25" size="18" placeholder="Merino Soto" value="'.$fila->Apellidos.'" required></td>
            </tr>

            <tr>
              <td>Direccion:</td>
              <td><input type="text" name="Direccion" maxlength="25" size="18"  placeholder="C/Argantonio Nº6" value="'.$fila->Direccion.'" required></td>
            </tr>

            <tr>
              <td>Teléfono:</td>
              <td><input type="text" name="Telefono" maxlength="9" size="18" placeholder="679210535" value="'.$fila->Telefono.'" required></td><br>
            </tr>

            <tr>
              <td>C.Postal:</td>
              <td><input type="text" name="CPostal" maxlength="5" size="18" placeholder="41900" value="'.$fila->Cpostal.'" required></td>
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
              <td><input type="date" name="FNacimiento" size="18" placeholder="1990-12-27" value="'.$fila->FNacimiento.'" /></td>
            </tr>

            <tr>
              <td>Email:</td>
              <td><input type="text" name="Email" maxlength="35" size="18" placeholder="amerino96@gmail.com"  value="'.$fila->Email.'" required></td>
            </tr>

            <tr>
            <td colspan="2" align="right"><input type="submit" value="Enviar"></td>
            </tr>

          </table>';

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
          $idusu=$_POST["idusu"];
          //UPDATE usuarios SET Password=md5('$Password'),Email='$Email',Dni_usuario='$DNI',Nombre='$Nombre',Apellidos="$Apellidos",Cpostal=$CPostal,Telefono=$Telefono,Sexo=$Sexo,FNacimiento='$FNacimiento',Direccion='$Direccion' WHERE Idusuario=$idusu
          //var_dump($Usuario,$Password,$DNI,$Nombre,$Apellidos,$Direccion,$Telefono,$CPostal,$Sexo,$FNacimiento,$Email);

          //Conexion con la base de datos
          include("../conexion.php");

          $consulta="UPDATE usuarios SET Email='$Email',Dni_usuario='$DNI',Nombre='$Nombre',Apellidos='$Apellidos',Cpostal=$CPostal,Telefono=$Telefono,Sexo='$Sexo',FNacimiento='$FNacimiento',Direccion='$Direccion' WHERE idusuario=$idusu";
          if($result=$connection->query($consulta)){
            //header("Location: admin_usuarios.php");

            //echo $consulta;
            echo '<p><b>Consulta actualizada</b></p>';
            header("Location: ../admin/admin_usuarios.php");


          }else{
            echo $connection->error;
          }
        }
          ?>

        </center>
      </div>

          <div id='pie'>
            © 2015 BAR MERI España. Todos los derechos reservados.
          </div>

      </div>
    </body>
</html>
