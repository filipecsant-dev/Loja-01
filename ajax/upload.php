<?php
ob_start(); session_start();
require '../funcoes/banco/conexao.php';
require '../funcoes/banco/conexao2.php';

if(isset($_FILES["foto1"]["name"])){

	if($_FILES["foto1"]["name"] != '')
	{
		$foto1 = $_FILES['foto1']['name'];

		$validextensions = array("jpeg", "jpg", "png");
		$temporary = explode(".", $_FILES["foto1"]["name"]);
		$file_extension = end($temporary);
		
		if ((($_FILES["foto1"]["type"] == "image/png") || ($_FILES["foto1"]["type"] == "image/jpg") || ($_FILES["foto1"]["type"] == "image/jpeg")
		) && in_array($file_extension, $validextensions))
		{
		
			if ($_FILES["foto1"]["error"] > 0){
				echo "erro1";
				exit;
		
			}else{
		
				if (file_exists("../img/produtos/" . $_FILES["foto1"]["name"])) {
					echo "existe1";
					exit;
				} else {
					$sourcePath = $_FILES['foto1']['tmp_name']; 
					$targetPath = "../img/produtos/".$_FILES['foto1']['name'];
					move_uploaded_file($sourcePath,$targetPath) ; 

					

				}
			}
		} else {
			echo 'tamanho1';
			exit;
		}
	}

	if(($_FILES["foto2"]["name"]) != '')
	{

		$foto2 = $_FILES['foto2']['name'];

		$validextensions = array("jpeg", "jpg", "png");
		$temporary = explode(".", $_FILES["foto2"]["name"]);
		$file_extension = end($temporary);
		
		if ((($_FILES["foto2"]["type"] == "image/png") || ($_FILES["foto2"]["type"] == "image/jpg") || ($_FILES["foto2"]["type"] == "image/jpeg")
		) && ($_FILES["foto2"]["size"] < 100000)//Approx. 100kb files can be uploaded.
		&& in_array($file_extension, $validextensions))
		{
		
			if ($_FILES["foto2"]["error"] > 0){
				echo "erro2";
				exit;
		
			}else{
		
				if (file_exists("../img/produtos/" . $_FILES["foto2"]["name"])) {
					echo "existe2";
					exit;
				} else {
					$sourcePath = $_FILES['foto2']['tmp_name'];
					$targetPath = "../img/produtos/".$_FILES['foto2']['name']; 
					move_uploaded_file($sourcePath,$targetPath) ; 

			
				}
			}
		} else {
			echo 'tamanho2';
			exit;
		}
	}

	if($_FILES["foto3"]["name"] != '')
	{
		$foto3 = $_FILES['foto3']['name'];

		$validextensions = array("jpeg", "jpg", "png");
		$temporary = explode(".", $_FILES["foto3"]["name"]);
		$file_extension = end($temporary);
		
		if ((($_FILES["foto3"]["type"] == "image/png") || ($_FILES["foto3"]["type"] == "image/jpg") || ($_FILES["foto3"]["type"] == "image/jpeg")
		) && ($_FILES["foto3"]["size"] < 100000)//Approx. 100kb files can be uploaded.
		&& in_array($file_extension, $validextensions))
		{
		
			if ($_FILES["foto3"]["error"] > 0){
				echo "erro3";
				exit;
			}else{
		
				if (file_exists("../img/produtos/" . $_FILES["foto3"]["name"])) {
					echo "existe3";
					exit;
				} else {
					$sourcePath = $_FILES['foto3']['tmp_name'];
					$targetPath = "../img/produtos/".$_FILES['foto3']['name'];
					move_uploaded_file($sourcePath,$targetPath) ;

					
				}
			}
		} else {
			echo 'tamanho3';
			exit;
		}
	}





	if($_FILES["foto2"]["name"] === '' && $_FILES["foto3"]["name"] === '')
	{

		//INSERIR BANCO
		try{
			$query = "INSERT INTO produtos (foto1) VALUES ('$foto1')";

			if(mysqli_query($conn, $query)){
				echo mysqli_insert_id($conn);
			}

		}catch(PDOException $e){
			echo $e->getMessage();
		}
		//FIM INSERIR


	}

	if($_FILES["foto2"]["name"] != '' && $_FILES["foto3"]["name"] === '')
	{

		//INSERIR BANCO
		try{
			$query = "INSERT INTO produtos (foto1, foto2) VALUES ('$foto1', '$foto2')";

			if(mysqli_query($conn, $query)){
				echo mysqli_insert_id($conn);
			}

		}catch(PDOException $e){
			echo $e->getMessage();
		}
		//FIM INSERIR

	}

	if($_FILES["foto2"]["name"] != '' && $_FILES["foto3"]["name"] != '')
	{
		//INSERIR BANCO
		try{
			$query = "INSERT INTO produtos (foto1,foto2,foto3) VALUES ('$foto1','$foto2','$foto3')";

			if(mysqli_query($conn, $query)){
				echo mysqli_insert_id($conn);
			}

		}catch(PDOException $e){
			echo $e->getMessage();
		}
		//FIM INSERIR

	}

	if($_FILES["foto2"]["name"] == '' && $_FILES["foto3"]["name"] != '')
	{
		//INSERIR BANCO
		try{
			$query = "INSERT INTO produtos (foto1,foto3) VALUES ('$foto1','$foto3')";

			if(mysqli_query($conn, $query)){
				echo mysqli_insert_id($conn);
			}

		}catch(PDOException $e){
			echo $e->getMessage();
		}
		//FIM INSERIR

	}
}


if(isset($_FILES['perfil']['name'])){
	if($_FILES['perfil']['name'] != '')
	{
		$perfil = $_FILES['perfil']['name'];
		$id =  $_POST["id"];

		$validextensions = array("jpeg", "jpg", "png");
		$temporary = explode(".", $_FILES["perfil"]["name"]);
		$file_extension = end($temporary);
		
		if ((($_FILES["perfil"]["type"] == "image/png") || ($_FILES["perfil"]["type"] == "image/jpg") || ($_FILES["perfil"]["type"] == "image/jpeg")
		) && in_array($file_extension, $validextensions))
		{
		
			if ($_FILES["perfil"]["error"] > 0){
				echo "erro4";
				exit;
		
			}else{
		
				if (file_exists("../img/usuarios/" . $_FILES["perfil"]["name"])) {
					echo "existe4";
					exit;
				} else {
					$sourcePath = $_FILES['perfil']['tmp_name']; 
					$targetPath = "../img/usuarios/".$_FILES['perfil']['name'];
					move_uploaded_file($sourcePath,$targetPath) ; 

					

				}
			}
		} else {
			echo 'tamanho4';
			exit;
		}
	}	


	if($_FILES["perfil"]["name"] != ''){
	
		//INSERIR BANCO
		try{
			$query = "UPDATE usuarios SET img='$perfil' WHERE id='$id'";

			if(mysqli_query($conn, $query)){
				echo 'atualizou';
			}

		}catch(PDOException $e){
			echo $e->getMessage();
		}
		//FIM INSERIR
	}
}





ob_end_flush();