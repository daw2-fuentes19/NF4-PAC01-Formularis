<?php
$name = $_POST["name"];
$coments = $_POST["coments"];   
$rating = $_POST["rating"];   
$fecha = date("Y-m-d");
$id = $_POST["id"];
echo "Este es mi id";
echo "</br>";
echo $id;
$db = mysqli_connect('localhost', 'root') or 
    die ('Unable to connect. Check your connection parameters.');
mysqli_select_db($db,'EquiposFutbol') or die(mysqli_error($db));

$query = "INSERT INTO reviews (review_equipo_id,review_date, reviewer_name, review_comment,review_rating) VALUES ('$id','$fecha','$name','$coments','$rating')";   

  $result = mysqli_query($db,$query) or die(mysqli_error($db));

echo "Los datos se han guardado";  
?>