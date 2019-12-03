<?php 
$db = mysqli_connect('localhost', 'root') or 
die ('Unable to connect. Check your connection parameters.');
mysqli_select_db($db,'EquiposFutbol') or die(mysqli_error($db));
?>
<html>
 <head>
  <title>Formularios</title>
  <style type="text/css">
  <!--
td {vertical-align: top;}
  -->
  </style>
 </head>
 <body>
  <form action="NP113formprocess.php" method="post">
    Introdue>ce una palabra: <input type="text" name="n1"><br>
    Introduce una palabra: <input type="text" name="n2"><br>
    Introduce una palabra: <input type="text" name="n3"><br>
    Introduce una palabra: <input type="text" name="n4"><br>
    Introduce una palabra: <input type="text" name="n5"><br>
    <input type="submit" value="Enviar">
  </form>
 </body>
</html>