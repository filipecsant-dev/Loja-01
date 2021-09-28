<?php
//CONSTANTES
$teste = false;
if($teste == true){
	$conn = mysqli_connect("localhost", "root", "", "phstore");
}else{
	$conn = mysqli_connect("sql304.epizy.com", "epiz_27118468", "JGj7Lg5Cb1", "epiz_27118468_phstore");	
}

?>