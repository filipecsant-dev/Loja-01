<?php
//Função de cadastro
function cadastrouser($nome,$endereco,$referencia,$email,$telefone,$senha){
	$pdo = conectar();


	try{
		$cadastro = $pdo->prepare("INSERT INTO usuarios (usuario, senha, email, telefone, cargo, endereco, referencia, token, img) VALUES (?,?,?,?,0,?,?,'-','semfoto.png')");
		$cadastro->bindValue(1, $nome, PDO::PARAM_STR);
		$cadastro->bindValue(2, md5(strrev($senha)), PDO::PARAM_STR);
		$cadastro->bindValue(3, $email, PDO::PARAM_STR);
		$cadastro->bindValue(4, $telefone, PDO::PARAM_STR);
		$cadastro->bindValue(5, $endereco, PDO::PARAM_STR);
		$cadastro->bindValue(6, $referencia, PDO::PARAM_STR);	
		$cadastro->execute();

		if($cadastro->rowCount() > 0):
			return TRUE;
		else:
			return FALSE;
		endif;

	}catch(PDOException $e){
		echo $e->getMessage();
	}
}

function atualizarinfo($nome,$endereco,$telefone,$referencia,$id){
	$pdo = conectar();


	try{
		$atualizarinfo = $pdo->prepare("UPDATE usuarios SET usuario=?, telefone=?, endereco=?, referencia=? WHERE id=?");
		$atualizarinfo->bindValue(1, $nome, PDO::PARAM_STR);
		$atualizarinfo->bindValue(2, $telefone, PDO::PARAM_STR);
		$atualizarinfo->bindValue(3, $endereco, PDO::PARAM_STR);
		$atualizarinfo->bindValue(4, $referencia, PDO::PARAM_STR);
		$atualizarinfo->bindValue(5, $id, PDO::PARAM_INT);	
		$atualizarinfo->execute();

		if($atualizarinfo->rowCount() == 1):
			return TRUE;
		else:
			return FALSE;
		endif;

	}catch(PDOException $e){
		echo $e->getMessage();
	}
}

//VERIFICAR SE EXISTE FUNCIONARIO
function verifuser($email){
	$pdo = conectar();

	try{
		$verifuser = $pdo->prepare("SELECT * FROM usuarios WHERE email = ?");
		$verifuser->bindValue(1,$email,PDO::PARAM_STR);
		$verifuser->execute();

		if($verifuser->rowCount() == 1):
			return true;
		else:
			return FALSE;
		endif;

	}catch(PDOException $e){
		echo $e->getMessage();
	}
}


//FUNCAO DE LISTAR FUNCIONARIO
function listarfuncionarios(){
	$pdo = conectar();

	try{
		$listarfun = $pdo->query("SELECT * FROM usuarios");

		if($listarfun->rowCount() > 0):
			return $listarfun->fetchAll(PDO::FETCH_OBJ);
		else:
			return FALSE;
		endif;

	}catch(PDOException $e){
		echo $e->getMessage();
	}
}

//FUNCAO EDITAR FUNCIONARIO
function edituser($id){
	$pdo = conectar();

	try{
		$edituser = $pdo->prepare("SELECT * FROM usuarios WHERE id = ?");
		$edituser->bindValue(1,$id,PDO::PARAM_INT);
		$edituser->execute();

		if($edituser->rowCount() > 0):
			return $edituser->fetch(PDO::FETCH_OBJ);
		else:
			return FALSE;
		endif;

	}catch(PDOException $e){
		echo $e->getMessage();
	}
}

//FUNCAO ATUALIZAR FUNCIONARIO
function atualizaruser($id,$usuario,$cargo){
	$pdo = conectar();

	try{
		$atualizaruser = $pdo->prepare("UPDATE usuarios SET usuario=?, cargo=? WHERE id=?");
		$atualizaruser->bindValue(1,$usuario,PDO::PARAM_STR);
		$atualizaruser->bindValue(2,$cargo,PDO::PARAM_STR);
		$atualizaruser->bindValue(3,$id,PDO::PARAM_INT);
		$atualizaruser->execute();

		if($atualizaruser->rowCount() == 1):
			return TRUE;
		else:
			return FALSE;
		endif;

	}catch(PDOException $e){
		echo $e->getMessage();
	}

}


//FUNCAO DELETAR USUARIO
function delete($table,$id){
	$pdo = conectar();

	try{
		$deleteuser = $pdo->prepare("DELETE FROM $table WHERE id=?");
		$deleteuser->bindValue(1,$id,PDO::PARAM_INT);
		$deleteuser->execute();

		if($deleteuser->rowCount() == 1):
			return TRUE;
		else:
			return FALSE;
		endif;

	}catch(PDOException $e){
		echo $e->getMessage();
	}
}

//FUNCAO DELETAR USUARIO
function delete2($table,$id){
	$pdo = conectar();

	try{
		$deleteuser = $pdo->prepare("DELETE FROM $table WHERE produto=?");
		$deleteuser->bindValue(1,$id,PDO::PARAM_INT);
		$deleteuser->execute();

		if($deleteuser->rowCount() > 0):
			return TRUE;
		else:
			return FALSE;
		endif;

	}catch(PDOException $e){
		echo $e->getMessage();
	}
}

function listarprodutos($categoria){
	$pdo = conectar();

	try{
		$infantil = $pdo->prepare("SELECT * FROM produtos WHERE categoria=? ORDER BY id DESC");
		$infantil->bindValue(1, $categoria, PDO::PARAM_STR);
		$infantil->execute();

		if($infantil->rowCount() > 0){
			return $infantil->fetchAll(PDO::FETCH_OBJ);
		} else{
			return FALSE;
		}

	}catch(PDOException $e){
		echo $e->getMessage();
	}
}

function cadastroprod($titulo,$descrissao,$categoria,$valor,$valor2,$status,$tamanho1,$tamanho2,$tamanho3,$compo1,$compo2,$compo3,$tamanhounico,$fornecedor,$id){
	$pdo = conectar();


	try{
		$cadastro = $pdo->prepare("UPDATE produtos SET titulo=?, descrissao=?, categoria=?, valor=?, valor2=?, status=?, tamanho1=?, tamanho2=?, tamanho3=?, compo1=?, compo2=?, compo3=?, tamanhounico=?, fornecedor=? WHERE id=?");
		$cadastro->bindValue(1, $titulo, PDO::PARAM_STR);
		$cadastro->bindValue(2, $descrissao, PDO::PARAM_STR);
		$cadastro->bindValue(3, $categoria, PDO::PARAM_STR);
		$cadastro->bindValue(4, $valor, PDO::PARAM_INT);
		$cadastro->bindValue(5, $valor2, PDO::PARAM_INT);
		$cadastro->bindValue(6, $status, PDO::PARAM_STR);
		$cadastro->bindValue(7, $tamanho1, PDO::PARAM_INT);
		$cadastro->bindValue(8, $tamanho2, PDO::PARAM_INT);
		$cadastro->bindValue(9, $tamanho3, PDO::PARAM_INT);
		$cadastro->bindValue(10, $compo1, PDO::PARAM_STR);
		$cadastro->bindValue(11, $compo2, PDO::PARAM_STR);
		$cadastro->bindValue(12, $compo3, PDO::PARAM_STR);
		$cadastro->bindValue(13, $tamanhounico, PDO::PARAM_INT);
		$cadastro->bindValue(14, $fornecedor, PDO::PARAM_STR);	
		$cadastro->bindValue(15, $id, PDO::PARAM_INT);
		$cadastro->execute();

		if($cadastro->rowCount() > 0):
			return TRUE;
		else:
			return FALSE;
		endif;

	}catch(PDOException $e){
		echo $e->getMessage();
	}
}


//FUNCAO EDITAR PRODUTO
function editprod($id){
	$pdo = conectar();

	try{
		$editprod = $pdo->prepare("SELECT * FROM produtos WHERE id = ?");
		$editprod->bindValue(1,$id,PDO::PARAM_INT);
		$editprod->execute();

		if($editprod->rowCount() > 0):
			return $editprod->fetchAll(PDO::FETCH_OBJ);
		else:
			return FALSE;
		endif;

	}catch(PDOException $e){
		echo $e->getMessage();
	}
}


function verifinscrever($email){
	$pdo = conectar();

	try{
		$inscrever = $pdo->prepare("SELECT * FROM email WHERE email=?");

		$inscrever->bindValue(1,$email,PDO::PARAM_STR);
		$inscrever->execute();

		if($inscrever->rowCount() == 1){
			return TRUE;
		} else{
			return FALSE;
		}
	}catch(PDOException $e){
		echo $e->getMessage();
	}
}


function inscrever($email){
	$pdo = conectar();

	try{
		$inscrever = $pdo->prepare("INSERT INTO email (email) VALUES (?)");

		$inscrever->bindValue(1,$email,PDO::PARAM_STR);
		$inscrever->execute();

		if($inscrever->rowCount() > 0){
			return TRUE;
		} else {
			return FALSE;
		}
	}catch(PDOException $e){
		echo $e->getMessage();
	}
}

function cadcomentario($produto,$nome,$star,$comentario,$data,$img){
	$pdo = conectar();

	try{
		$inscrever = $pdo->prepare("INSERT INTO avaliacao (produto, nome, star, comentario, data,img) VALUES (?,?,?,?,?,?)");

		$inscrever->bindValue(1,$produto,PDO::PARAM_INT);
		$inscrever->bindValue(2,$nome,PDO::PARAM_STR);
		$inscrever->bindValue(3,$star,PDO::PARAM_INT);
		$inscrever->bindValue(4,$comentario,PDO::PARAM_STR);
		$inscrever->bindValue(5,$data,PDO::PARAM_STR);
		$inscrever->bindValue(6,$img,PDO::PARAM_STR);
		$inscrever->execute();

		if($inscrever->rowCount() > 0){
			return TRUE;
		} else {
			return FALSE;
		}
	}catch(PDOException $e){
		echo $e->getMessage();
	}
}


//FUNCAO AVALIACAO
function avaliacao($id){
	$pdo = conectar();

	try{
		$qntavaliacao = $pdo->prepare("SELECT * FROM avaliacao WHERE produto = ? ORDER BY id DESC");
		$qntavaliacao->bindValue(1,$id,PDO::PARAM_INT);
		$qntavaliacao->execute();

		if($qntavaliacao->rowCount() > 0):
			return $qntavaliacao->fetchAll(PDO::FETCH_OBJ);
		else:
			return FALSE;
		endif;

	}catch(PDOException $e){
		echo $e->getMessage();
	}
}

//FUNCAO DE QNT AVALIACAO
function qntavaliacao($id){

	$pdo = conectar();

	try{

		$listarpedidos = $pdo->query("SELECT * FROM avaliacao WHERE produto=$id");

		return $listarpedidos->rowCount();

	}catch(PDOException $e){
		echo $e->getMessage();
	}
}

function qntavaliacao2($id,$star){

	$pdo = conectar();

	try{

		$listarpedidos = $pdo->query("SELECT * FROM avaliacao WHERE produto=$id AND star=$star");

		return $listarpedidos->rowCount();

	}catch(PDOException $e){
		echo $e->getMessage();
	}
}


function adddesejo($id,$usuario){
	$pdo = conectar();

	try{
		$adddesejo = $pdo->prepare("INSERT INTO desejos (usuario, produto) VALUES (?,?)");

		$adddesejo->bindValue(1,$usuario,PDO::PARAM_INT);
		$adddesejo->bindValue(2,$id,PDO::PARAM_INT);
		$adddesejo->execute();

		if($adddesejo->rowCount() > 0){
			return TRUE;
		} else {
			return FALSE;
		}
	}catch(PDOException $e){
		echo $e->getMessage();
	}
}

//FUNCAO DELETAR USUARIO
function removedesejo($id,$usuario){
	$pdo = conectar();

	try{
		$removedesejo = $pdo->prepare("DELETE FROM desejos WHERE produto=? AND usuario=?");
		$removedesejo->bindValue(1,$id,PDO::PARAM_INT);
		$removedesejo->bindValue(2,$usuario,PDO::PARAM_INT);
		$removedesejo->execute();

		if($removedesejo->rowCount() == 1):
			return TRUE;
		else:
			return FALSE;
		endif;

	}catch(PDOException $e){
		echo $e->getMessage();
	}
}

function verifdesejo($id, $usuario){
	$pdo = conectar();

	try{
		$inscrever = $pdo->prepare("SELECT * FROM desejos WHERE produto=? AND usuario=?");

		$inscrever->bindValue(1,$id,PDO::PARAM_INT);
		$inscrever->bindValue(2,$usuario,PDO::PARAM_INT);
		$inscrever->execute();

		if($inscrever->rowCount() == 1){
			return TRUE;
		} else{
			return FALSE;
		}
	}catch(PDOException $e){
		echo $e->getMessage();
	}
}


function pegadesejo($usuario){
	$pdo = conectar();

	try{
		$pegadesejo = $pdo->prepare("SELECT * FROM desejos WHERE usuario = ?");
		$pegadesejo->bindValue(1, $usuario, PDO::PARAM_INT);
		$pegadesejo->execute();

		if($pegadesejo->rowCount() > 0):
			return $pegadesejo -> fetchAll(PDO::FETCH_OBJ);
		else:
			return FALSE;
		endif;

	}catch(PDOException $e){
		echo $e->getMessage();
	}
}

function addcarrinho($id,$usuario,$tamanho,$qnt){
	$pdo = conectar();

	try{
		$adddesejo = $pdo->prepare("INSERT INTO carrinho (usuario, produto,tamanho,qnt) VALUES (?,?,?,?)");

		$adddesejo->bindValue(1,$usuario,PDO::PARAM_INT);
		$adddesejo->bindValue(2,$id,PDO::PARAM_INT);
		$adddesejo->bindValue(3,$tamanho,PDO::PARAM_STR);
		$adddesejo->bindValue(4,$qnt,PDO::PARAM_INT);
		$adddesejo->execute();

		if($adddesejo->rowCount() > 0){
			return TRUE;
		} else {
			return FALSE;
		}
	}catch(PDOException $e){
		echo $e->getMessage();
	}
}

//FUNCAO DELETAR USUARIO
function removecarrinho($id,$usuario){
	$pdo = conectar();

	try{
		$removedesejo = $pdo->prepare("DELETE FROM carrinho WHERE produto=? AND usuario=?");
		$removedesejo->bindValue(1,$id,PDO::PARAM_INT);
		$removedesejo->bindValue(2,$usuario,PDO::PARAM_INT);
		$removedesejo->execute();

		if($removedesejo->rowCount() == 1):
			return TRUE;
		else:
			return FALSE;
		endif;

	}catch(PDOException $e){
		echo $e->getMessage();
	}
}

function verifcarrinho($id, $usuario){
	$pdo = conectar();

	try{
		$inscrever = $pdo->prepare("SELECT * FROM carrinho WHERE produto=? AND usuario=?");

		$inscrever->bindValue(1,$id,PDO::PARAM_INT);
		$inscrever->bindValue(2,$usuario,PDO::PARAM_INT);
		$inscrever->execute();

		if($inscrever->rowCount() == 1){
			return TRUE;
		} else{
			return FALSE;
		}
	}catch(PDOException $e){
		echo $e->getMessage();
	}
}

function pegacarrinho($usuario){
	$pdo = conectar();

	try{
		$pegacarrinho = $pdo->prepare("SELECT * FROM carrinho WHERE usuario = ?");
		$pegacarrinho->bindValue(1, $usuario, PDO::PARAM_INT);
		$pegacarrinho->execute();

		if($pegacarrinho->rowCount() > 0):
			return $pegacarrinho -> fetchAll(PDO::FETCH_OBJ);
		else:
			return FALSE;
		endif;

	}catch(PDOException $e){
		echo $e->getMessage();
	}
}

function verifcarrinho2($usuario){
	$pdo = conectar();

	try{
		$pegacarrinho = $pdo->prepare("SELECT * FROM carrinho WHERE usuario = ?");
		$pegacarrinho->bindValue(1, $usuario, PDO::PARAM_INT);
		$pegacarrinho->execute();

		if($pegacarrinho->rowCount() > 0):
			return TRUE;
		else:
			return FALSE;
		endif;

	}catch(PDOException $e){
		echo $e->getMessage();
	}
}


function qntdesejo($id){

	$pdo = conectar();

	try{

		$qntdesejo = $pdo->query("SELECT * FROM desejos WHERE usuario=$id");

		return $qntdesejo->rowCount();

	}catch(PDOException $e){
		echo $e->getMessage();
	}
}

function qntcarrinho($id){

	$pdo = conectar();

	try{

		$qntcarrinho = $pdo->query("SELECT * FROM carrinho WHERE usuario=$id");

		return $qntcarrinho->rowCount();

	}catch(PDOException $e){
		echo $e->getMessage();
	}
}



//VERIFICAR SE EXISTE CUPOM
function verifcupom($cupom){
	$pdo = conectar();

	try{
		$verifcupom = $pdo->prepare("SELECT * FROM cupom WHERE codigo = ?");
		$verifcupom->bindValue(1,$cupom,PDO::PARAM_STR);
		$verifcupom->execute();

		if($verifcupom->rowCount() == 1):
			return true;
		else:
			return FALSE;
		endif;

	}catch(PDOException $e){
		echo $e->getMessage();
	}
}

//VERIFICAR SE EXISTE CUPOM
function verifcupom2($cupom,$valor){
	$pdo = conectar();

	try{
		$verifcupom2 = $pdo->prepare("SELECT * FROM cupom WHERE codigo = ? AND minimo <= ?");
		$verifcupom2->bindValue(1,$cupom,PDO::PARAM_STR);
		$verifcupom2->bindValue(2,$valor,PDO::PARAM_INT);
		$verifcupom2->execute();

		if($verifcupom2->rowCount() == 1):
			return $verifcupom2->fetch(PDO::FETCH_OBJ)->valor;
		else:
			return FALSE;
		endif;

	}catch(PDOException $e){
		echo $e->getMessage();
	}
}

function addpedido($id,$usuario,$produto,$tamanho,$qnt){
	$pdo = conectar();

	try{
		$adddesejo = $pdo->prepare("INSERT INTO pedido (id, usuario, produto,tamanho,qnt) VALUES (?,?,?,?,?)");

		$adddesejo->bindValue(1,$id,PDO::PARAM_INT);
		$adddesejo->bindValue(2,$usuario,PDO::PARAM_INT);
		$adddesejo->bindValue(3,$produto,PDO::PARAM_INT);
		$adddesejo->bindValue(4,$tamanho,PDO::PARAM_STR);
		$adddesejo->bindValue(5,$qnt,PDO::PARAM_INT);
		$adddesejo->execute();

		if($adddesejo->rowCount() > 0){
			return TRUE;
		} else {
			return FALSE;
		}
	}catch(PDOException $e){
		echo $e->getMessage();
	}
}

function addvenda($endereco,$comentario,$cupom,$valor,$entrega,$total,$status,$usuario,$data){
	$pdo = conectar();

	try{
		$addvenda = $pdo->prepare("INSERT INTO venda (endereco, comentario, cupom, valor, entrega, total, status, usuario, data) VALUES (?,?,?,?,?,?,?,?,?)");

		$addvenda->bindValue(1,$endereco,PDO::PARAM_STR);
		$addvenda->bindValue(2,$comentario,PDO::PARAM_STR);
		$addvenda->bindValue(3,$cupom,PDO::PARAM_INT);
		$addvenda->bindValue(4,$valor,PDO::PARAM_STR);
		$addvenda->bindValue(5,$entrega,PDO::PARAM_STR);
		$addvenda->bindValue(6,$total,PDO::PARAM_STR);
		$addvenda->bindValue(7,$status,PDO::PARAM_STR);
		$addvenda->bindValue(8,$usuario,PDO::PARAM_STR);
		$addvenda->bindValue(9,$data,PDO::PARAM_STR);
		$addvenda->execute();

		if($addvenda->rowCount() === 1){
			return $pdo->lastInsertId();
		} else {
			return FALSE;
		}
	}catch(PDOException $e){
		echo $e->getMessage();
	}
}

function verifvenda($id){
	$pdo = conectar();

	try{
		$verifvenda = $pdo->prepare("SELECT * FROM venda WHERE id = ?");
		$verifvenda->bindValue(1,$id,PDO::PARAM_STR);
		$verifvenda->execute();

		if($verifvenda->rowCount() == 1):
			return TRUE;
		else:
			return FALSE;
		endif;

	}catch(PDOException $e){
		echo $e->getMessage();
	}
}

function qntvenda($id){

	$pdo = conectar();

	try{

		$qntdesejo = $pdo->query("SELECT * FROM venda WHERE usuario=$id");

		return $qntdesejo->rowCount();

	}catch(PDOException $e){
		echo $e->getMessage();
	}
}


function pegavenda($usuario){
	$pdo = conectar();

	try{
		$pegavenda = $pdo->prepare("SELECT * FROM venda WHERE usuario = ? ORDER BY id DESC");
		$pegavenda->bindValue(1, $usuario, PDO::PARAM_INT);
		$pegavenda->execute();

		if($pegavenda->rowCount() > 0):
			return $pegavenda -> fetchAll(PDO::FETCH_OBJ);
		else:
			return FALSE;
		endif;

	}catch(PDOException $e){
		echo $e->getMessage();
	}
}

function attvenda($ref,$id){
	$pdo = conectar();

	try{
		$addvenda = $pdo->prepare("UPDATE venda SET ordem=? WHERE id=?");

		$addvenda->bindValue(1,$ref,PDO::PARAM_INT);
		$addvenda->bindValue(2,$id,PDO::PARAM_INT);
		$addvenda->execute();

		if($addvenda->rowCount() === 1){
			return TRUE;
		} else {
			return FALSE;
		}
	}catch(PDOException $e){
		echo $e->getMessage();
	}
}
//