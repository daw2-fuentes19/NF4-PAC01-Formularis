<?php

$link = mysqli_connect("localhost", "root")or die ('Unable to connect. Check your connection parameters.');//identifico el usuario
// make sure you're using the right database
mysqli_select_db($link,'EquiposFutbol') or die(mysqli_error($link));

$sql = "SELECT nombresEquipos, ciudadEquipos, anyoCreacion, categoriaEquipo, duenyoEquipo, equipo_running_time, equipo_cost, equipo_takings FROM Equipos WHERE idEquipos = " . $_GET['Equipos_id'];
        

$result = mysqli_query($link,$sql) or die(mysqli_error($link));
$row = mysqli_fetch_assoc($result);
$nombresEquipos         = $row['nombresEquipos'];
$duenyoEquipo     = get_duenyo($row['duenyoEquipo']);
$categoriaEquipo    = get_categoria($row['categoriaEquipo']);
$anyoCreacion         = $row['anyoCreacion'];
$equipo_running_time = $row['equipo_running_time'] .' mins';
$equipo_takings      = $row['equipo_takings'] . ' million';
$equipo_cost         = $row['equipo_cost'] . ' million';
$equipo_health       = calculate_differences($row['equipo_takings'],$row['equipo_cost']);
 






echo <<<ENDHTML
<html>
 <head>
  <title>Details and Reviews for: $nombresEquipos</title>
 </head>
 <body>
  <div style="text-align: center;">
   <h2>$nombresEquipos</h2>
   <h3><em>Details</em></h3>
   <table cellpadding="2" cellspacing="2"
    style="width: 70%; margin-left: auto; margin-right: auto;">
    <tr>
     <td><strong>Nombre</strong></strong></td>
     <td>$nombresEquipos</td>
     <td><strong>Anyo creacion</strong></strong></td>
     <td>$anyoCreacion</td>
    </tr><tr>
     <td><strong>Duenyo Equipo</strong></td>
     <td>$duenyoEquipo</td>
     <td><strong>Cost</strong></td>
     <td>$equipo_cost<td/>
    </tr><tr>
     <td><strong>Categoria</strong></td>
     <td>$categoriaEquipo</td>
     <td><strong>Takings</strong></td>
     <td>$equipo_takings<td/>
    </tr><tr>
     <td><strong>Running Time</strong></td>
     <td>$equipo_running_time</td>
     <td><strong>Health</strong></td>
     <td>$equipo_health<td/>
    </tr>
   </table>
ENDHTML;





 
 $sql = 'SELECT review_equipo_id, review_date, reviewer_name, review_comment, review_rating
    FROM
        reviews
    WHERE
        review_equipo_id = ' . $_GET['Equipos_id'] . '
    ORDER BY
        ' . $_GET['orden'] . ' DESC';
 
 
 
$result = mysqli_query($link,$sql) or die(mysqli_error($link));
 
$a=$_GET['Equipos_id'];

    echo <<<ENDHTML
   <h3><em>Reviews</em></h3>
   <table cellpadding="2" cellspacing="2"
    style="width: 90%; margin-left: auto; margin-right: auto;">
    <tr>
     <th style="width: 7em;" ><a href="N3P308detailsFuentes.php?Equipos_id=$a&orden=review_date">Date</a></th>
     <th style="width: 10em;"><a href="N3P308detailsFuentes.php?Equipos_id=$a&orden=reviewer_name">Reviewer</a></th>
     <th><a href="N3P308detailsFuentes.php?Equipos_id=$a&orden=review_comment">Comments</a></th>
     <th style="width: 5em;"><a href="N3P308detailsFuentes.php?Equipos_id=$a&orden=review_rating">Rating</a></th>
    </tr>
ENDHTML;
$i=0;
while ($row = mysqli_fetch_assoc($result)) {
    
    if($i%2==0){
        
        $class = "blue"; 
    }
    else{
        
        $class = "red"; 
    }
    $i++;
    $id=$row['review_equipo_id'];
    $date = $row['review_date'];
    $name = $row['reviewer_name'];
    
    $comment = $row['review_comment'];
    $rating = generate_ratings($row['review_rating']);
  
    $resultadoStar = $resultadoStar + $row['review_rating'];
    
    
    
    echo <<<ENDHTML
    <tr bgcolor='$class'>  
      <td style="vertical-align:top; text-align: center;">$date</td>
      <td style="vertical-align:top;">$name</td>
      <td style="vertical-align:top;">$comment</td>
      <td style="vertical-align:top;">$rating</td>
    </tr>
ENDHTML;
 
}

$resultadoStar= $resultadoStar/$i;
echo "</br>";
echo "El resultado de la media es: ";
echo $resultadoStar;
echo  generate_ratings($resultadoStar);
echo "</br>";
echo <<<ENDHTML
  </div>
  <form action="puntuacion.php" method="post">
      <input name="id" type="hidden" value="$id">
      Cual es tu nombre: <input type="text" name="name"><br>
      Comenta el equipo: <input type="text" name="coments"><br>
      Que valoracion le pondrias al equipo</p>
      <select name="rating">
       <option value="">Seleciona valoracion...</option>
       <option value="1">1</option>
       <option value="2">2</option>
       <option value="3">3</option>
       <option value="4">4</option>
       <option value="5">5</option>
      </select><br>
      <input type="submit" value="Enviar"><br>
  </form>
 </body>
</html>
ENDHTML;
  
 


function calculate_differences($takings, $cost) {
    $difference = $takings - $cost;
    if ($difference < 0) {     
        $color = 'red';
        $difference = '$' . abs($difference) . ' million';
    } else if ($difference > 0) {
        $color ='green';
        $difference = '$' . $difference . ' million';
    } else {
        $color = 'blue';
        $difference = 'broke even';
    }
    return '<span style="color:' . $color . ';">' . $difference . '</span>';
}


 function get_duenyo($duenyo_id) {
    global $link;
    $sql = 'SELECT 
            nombrePersona 
       FROM
           Personas
       WHERE
           idPersona = ' . $duenyo_id;
    $result = mysqli_query($link,$sql) or die(mysqli_error($link));
    $row = mysqli_fetch_assoc($result);
    extract($row);
    return $nombrePersona;
}
 
function get_categoria($categoria_id) {
    global $link;
    $sql = 'SELECT
            nombreCategoria
        FROM
            Categoria 
        WHERE
            idCategoria = ' . $categoria_id;
    $result = mysqli_query($link,$sql) or die(mysqli_error($link));
    $row = mysqli_fetch_assoc($result);
    extract($row);
    return $nombreCategoria;
}
  
 
 
 // function to generate ratings
function generate_ratings($rating) {
    $movie_rating = '';
    for ($i = 0; $i < $rating; $i++) {
        $equipo_rating .= '<img src="star.png" alt="star" width="20" height="20"/>';
        
    }
    return $equipo_rating;
}

 
 
 
 
 
?>