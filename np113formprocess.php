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
<?php $n1 = $_POST["n1"] ?>
<?php $n2 = $_POST["n2"] ?>
<?php $n3 = $_POST["n3"] ?>
<?php $n4 = $_POST["n4"] ?>
<?php $n5 = $_POST["n5"] ?>
  <form>
    Has introducido los siguiente valores:
      <select>
       <option value=""><?php echo $n1; ?></option>
       <option value="Action"><?php echo $n2; ?></option>
       <option value="Drama"><?php echo $n3; ?></option>
       <option value="Comedy"><?php echo $n4; ?></option>
       <option value="Sci-Fi"><?php echo $n5; ?></option>
      </select>
  </form>
 </body>
</html>