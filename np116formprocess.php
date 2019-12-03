<?php
	if($_POST)
	{	
		$num1 = $_POST
		['numero'];
		$num2 = $_POST
		['numero2'];
		$num3 = $_POST
		['numero3'];
		$suma = $num1 
		+ $num2 + $num3;
		echo "La suma de ".$num1." , ".$num2." y ".$num3." es ".$suma; 
	}
?>