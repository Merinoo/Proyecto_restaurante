<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <title></title>
  </head>
  <body>
    <div class="span3">
    <h2>Sign Up</h2>
    <form method="POST" action="">
    <label>Nombre BD</label>
    <input type="text" name="dbname" class="span3">

    <label>Nombre usuario</label>
    <input type="text" name="dbuser" class="span3">

    <label>Contraseña</label>
    <input type="Password" name="dbpassword" class="span3">

    <label>Host</label>
    <input type="text" name="dbhost" class="span3">

    <input type="submit" value="Sign up" class="btn btn-primary pull-right">
    <div class="clearfix"></div>
    </form>
</div>

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
