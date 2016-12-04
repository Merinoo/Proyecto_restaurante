




</body>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <title></title>
  </head>
  <body style="background-color:#58ACFA">
    <div class="span3" style="width:30%;margin: 0 auto;margin-top:60px">
    <h3 style="background-color: #0174DF; font-weight:bold;text-align:center; color: white; padding-top:7px;padding-bottom:7px; border-top-left-radius:4px; border-top-right-radius: 4px">INSTALACION</h3>
	<center>
    <form method="POST" action="">
      <table style="width:100%;height:250px;background-color: white;margin-top:-10px; border-bottom-left-radius:4px; border-bottom-right-radius: 4px">
        <tbody><tr>
          <td>
            <label style="margin-left:60px">Nombre DB</label>
          </td>
          <td>
            <input name="dbname" class="span3" type="text">
          </td>
        </tr>
        <tr>
          <td>
            <label style="margin-left:60px">Nombre usuario</label>
          </td>
          <td>
            <input name="dbuser" class="span3" type="text">
          </td>
        </tr>
        <tr>
          <td>
            <label style="margin-left:60px">Contraseña</label>
          </td>
          <td>
            <input name="dbpassword" class="span3" type="Password">
          </td>
        </tr>
        <tr>
          <td>
            <label style="margin-left:60px">Host</label>
          </td>
          <td>
            <input name="dbhost" class="span3" type="text">
          </td>
        </tr>
        <tr>
          <td colspan="2">
             <center>
            <input value="Instalar" class="btn btn-primary" style="width:50%" type="submit">
          </center>
          </td>
        </tr>
      </tbody></table>
    </form>
</center></div>
<?php
          if(isset($_POST["dbuser"])){
              $db_name=$_POST["dbname"];
              $db_user=$_POST["dbuser"];
              $db_password=$_POST["dbpassword"];
              $db_host=$_POST["dbhost"];

              $connection = new mysqli($db_host,$db_user,$db_password,$db_name);
                 //TESTING IF THE CONNECTION WAS RIGHT
              if ($connection->connect_errno) {
                   printf("Connection failed: %s\n", $connection->connect_error);
                   exit();
              }else{
                include("./database.php");
                $file = fopen("../datosdb.php", "a");
                fwrite($file, "<?php"."\n");
                fwrite($file, "$"."dbname="."'".$db_name."';"."\n");
                fwrite($file, "$"."dbuser="."'".$db_user."';"."\n");
                fwrite($file, "$"."dbpassword="."'".$db_password."';"."\n");
                fwrite($file, "$"."dbhost="."'".$db_host."';"."\n");

                fwrite($file, "?>"."\n");
                fclose($file);
                unlink("../install/database.php");
                unlink("../install/index.php");
                rmdir('../install');
                 header("Location: ./../index.php");
               }
              }
        ?>

  </body>
</html>
