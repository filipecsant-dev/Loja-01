<?php
//CONSTANTES
$teste = false;
if($teste === true){
	define('HOST', 'localhost');
	define('USUARIO', 'root');
	define('SENHA', '');
	define('DB', 'phstore');
} else {
	define('HOST', 'sql304.epizy.com');
	define('USUARIO', 'epiz_27118468');
	define('SENHA', 'JGj7Lg5Cb1');
	define('DB', 'epiz_27118468_phstore');
}

//CONEXÃO
function conectar(){
	$dns = "mysql:host=".HOST.";dbname=".DB;

	try{
		$conn = new PDO($dns, USUARIO, SENHA);
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		return $conn;
	}catch(PDOException $e) {
		//echo $erro->getMessage();
		return false;
	}
}
?>