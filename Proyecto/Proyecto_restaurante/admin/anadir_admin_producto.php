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
                  <li><a href="../admin/admin_usuarios.php">Usuarios</a></li>
                  <li class="active"><a href="../admin/admin_producto.php">Productos</a></li>
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

          <form method="POST" enctype="multipart/form-data" action="#">
            <table border=0>

                  <h2>Añade tu Producto</h2>

                  <table border=0>

                    <tr>
                      <td>Tipo Producto:</td>
                      <td>
                        <select name="Productos">
                          <option value="Bebidas">Bebida</option>
                          <option value="Comida">Comida</option>
                          <option value="Postres">Postres</option>
                          <option value="Complementos">Complementos</option>
                        </select>
                      <input type="hidden" name="idproducto" maxlength="9" size="30" value="" required></td><br>
                    </tr>

                    <tr>
                      <td>Nombre:</td>
                      <td><input type="text" name="Nombre" maxlength="25" size="30" placeholder="Nombre del producto"  value="" required></td>
                    </tr>

                    <tr>
                      <td>Precio:</td>
                      <td><input type="number" name="Precio" min="1" step="any" placeholder="1.00" size="30" value="0" required></td>
                    </tr>

                    <tr>
                      <td>Cantidad:</td>
                      <td><input type="number" name="Cantidad" min="1" step="any" value="'0" placeholder="10"required></td>
                    </tr>
                    <tr>
                      <td>Imagen:</td>
                      <td>
                        <input type="file" name="imagen" id="imagen" />
                      </td>
                                <script language="javascript">
                                    function readURL(input) {
                                        if (input.files && input.files[0]) {
                                            var reader = new FileReader();
                                            reader.onload = function (e) {
                                                $('#imagen_movil').attr('src', e.target.result);
                                            }
                                            reader.readAsDataURL(input.files[0]);
                                        }
                                    }
                                    $("#imagen").change(function(){
                                        readURL(this);
                                    });
                                </script>
                      </tr>
                      <tr>
                        <td colspan="2">
                          <center>
                          <img src="" style="border:solid red 1px; width:150px; height:150px" id="imagen_movil"/>
                          </center>
                        </td>
                      </tr>

                    <tr>
                    <td colspan="2" align="right"><input type="submit" value="Enviar"></td>
                    </tr>

                  </table>


                  </form>
          <?php

          if(isset($_POST["Nombre"])){

          $idproducto=$_POST["idproducto"];
          $tipo=$_POST["Productos"];
          //$imagen=$_POST["imagen"];
          $Nombre=$_POST["Nombre"];
          $precio=$_POST["Precio"];
          $Cantidad=$_POST["Cantidad"];

          //UPDATE usuarios SET Password=md5('$Password'),Email='$Email',Dni_usuario='$DNI',Nombre='$Nombre',Apellidos="$Apellidos",Cpostal=$CPostal,Telefono=$Telefono,Sexo=$Sexo,FNacimiento='$FNacimiento',Direccion='$Direccion' WHERE Idusuario=$idusu
          //var_dump($Usuario,$Password,$DNI,$Nombre,$Apellidos,$Direccion,$Telefono,$CPostal,$Sexo,$FNacimiento,$Email);

          //Conexion con la base de datos
          include("../conexion.php");

            $ruta="";
              if ($_FILES["imagen"]["error"] > 0){
                      echo "ha ocurrido un error";
              } else {
                      //ahora vamos a verificar si el tipo de archivo es un tipo de imagen permitido.
                      //y que el tamano del archivo no exceda los 100kb
                      $permitidos = array("image/jpg", "image/jpeg", "image/gif", "image/png");
                      $limite_kb = 4000;
                      if (in_array($_FILES['imagen']['type'], $permitidos) && $_FILES['imagen']['size'] <= $limite_kb * 1024){
                        //esta es la ruta donde copiaremos la imagen
                        //recuerden que deben crear un directorio con este mismo nombre
                        //en el mismo lugar donde se encuentra el archivo subir.php
                        $ruta = "../imagenes_menu/" . $_FILES['imagen']['name'];
                        //comprovamos si este archivo existe para no volverlo a copiar.
                        //pero si quieren pueden obviar esto si no es necesario.
                        //o pueden darle otro nombre para que no sobreescriba el actual.
                        if (!file_exists($ruta)){
                            //aqui movemos el archivo desde la ruta temporal a nuestra ruta
                            //usamos la variable $resultado para almacenar el resultado del proceso de mover el archivo
                            //almacenara true o false
                            $resultado = @move_uploaded_file($_FILES["imagen"]["tmp_name"], $ruta);
                            if ($resultado){
                              echo "el archivo ha sido movido exitosamente";
                            } else {
                              echo "ocurrio un error al mover el archivo.";
                            }
                        } else {
                            echo $_FILES['imagen']['name'] . ", este archivo existe";
                        }
                      } else {
                        echo "archivo no permitido, es tipo de archivo prohibido o excede el tamano de $limite_kb Kilobytes";
                      }
          }
          $ruta=$_FILES['imagen']['name'];
          //INSERT INTO `producto`(`IdProducto`, `Tipo_producto`, `Nombre`, `Precio`, `Cantidad`, `imagen`) VALUES (null,'$tipo','$Nombre',$precio,$Cantidad,'')
          $consulta="INSERT INTO `producto`(`IdProducto`,`Tipo_producto`, `Nombre`, `Precio`, `Cantidad`,`Imagen`) VALUES (null,'$tipo','$Nombre',$precio,$Cantidad,'$ruta')";

          if($result=$connection->query($consulta)){
            //header("Location: admin_usuarios.php");

            //echo $consulta;
            echo '<p><b>Consulta actualizada</b></p>';
            header("Location: ../admin/admin_producto.php");


          }else{
            echo $connection->error;
            echo $consulta;
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
