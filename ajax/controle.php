<?php
ob_start(); session_start();
require '../funcoes/banco/conexao.php';
require '../funcoes/login/login.php';
require '../funcoes/crud/crud.php';

$acao = filter_input(INPUT_POST, 'acao', FILTER_SANITIZE_STRING);

switch ($acao) {
	
	case 'infantil':
	$categoria = 'infantil';
	if(listarprodutos($categoria)){
		$infantil = listarprodutos($categoria);
		foreach ($infantil as $in) {

		if($in->status != 'Indisponivel'){



		$totalavaliacao = (qntavaliacao2($in->id,'5')+qntavaliacao2($in->id,'4')+qntavaliacao2($in->id,'3')+qntavaliacao2($in->id,'2') * 100)/(0.220*10);
     	$avaliacaototal = number_format($totalavaliacao, 1, '.', '');
		
	?>
		<div class="col-lg-4 col-6 px-0 px-sm-2 me-sm-4">
	        <div class="card product-card card-static" style="width: 98%;">

	        <?php if(isset($_SESSION['logado'])){
	        	$usu = $_SESSION['logado'];
	        		if($usu->cargo == 1){ ?>

	        	<!-- DELETE -->
	        	<button id="produto-delete" data-id="<?php echo $in->id; ?>" class="btn-wishlist btn-sm" type="button" data-toggle="tooltip" title="Excluir" style="left:10px;"><svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-trash-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
				  <path fill-rule="evenodd" d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5a.5.5 0 0 0-1 0v7a.5.5 0 0 0 1 0v-7z"/>
				</svg></button>

				<!-- EDITAR -->
	        	<button id="produto-editar" data-id="<?php echo $in->id; ?>" class="btn-wishlist btn-sm" type="button" data-toggle="tooltip" title="Editar" style="left:55px;"><svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-gear-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
				  <path fill-rule="evenodd" d="M9.405 1.05c-.413-1.4-2.397-1.4-2.81 0l-.1.34a1.464 1.464 0 0 1-2.105.872l-.31-.17c-1.283-.698-2.686.705-1.987 1.987l.169.311c.446.82.023 1.841-.872 2.105l-.34.1c-1.4.413-1.4 2.397 0 2.81l.34.1a1.464 1.464 0 0 1 .872 2.105l-.17.31c-.698 1.283.705 2.686 1.987 1.987l.311-.169a1.464 1.464 0 0 1 2.105.872l.1.34c.413 1.4 2.397 1.4 2.81 0l.1-.34a1.464 1.464 0 0 1 2.105-.872l.31.17c1.283.698 2.686-.705 1.987-1.987l-.169-.311a1.464 1.464 0 0 1 .872-2.105l.34-.1c1.4-.413 1.4-2.397 0-2.81l-.34-.1a1.464 1.464 0 0 1-.872-2.105l.17-.31c.698-1.283-.705-2.686-1.987-1.987l-.311.169a1.464 1.464 0 0 1-2.105-.872l-.1-.34zM8 10.93a2.929 2.929 0 1 0 0-5.86 2.929 2.929 0 0 0 0 5.858z"/>
				</svg></button>

			<?php }
				}
			 ?>

				<!-- DESEJO -->
	          <button class="btn-wishlist btn-sm" id="desejo" data-id="<?php echo $in->id; ?>" data-usu="<?php echo $_SESSION['logado']->id; ?>" type="button" data-toggle="tooltip" data-placement="left" <?php if(!isset($_SESSION['logado'])){ echo 'onclick="fazerlog();"';} ?>><i class="ci-heart" <?php if(isset($_SESSION['logado'])){ if(verifdesejo($in->id, $_SESSION['logado']->id)){ echo 'style="color:#fe696a"';} } ?>></i></button>

	          <!-- PRODUTO -->
	          <a class="card-img-top d-block overflow-hidden" href="index.php?p=produto&id=<?php echo $in->id; ?>"><img style="width: 100%; height: 100%;" src="<?php echo "img/produtos/".$in->foto1; ?>" alt="<?php echo $in->titulo; ?>"></a>
	          <div class="card-body py-2">
	          	<a class="product-meta d-block font-size-xs pb-1" style="opacity: 0.70;"><?php echo $in->status; ?></a>
	            <h3 class="product-title font-size-sm"><a href="index.php?p=produto&id=<?php echo $in->id; ?>"><?php echo $in->titulo; ?></a></h3>
	            <div class="d-flex justify-content-between">
	              <div class="product-price"><span class="text-accent">R$<?php echo $in->valor; ?>,<small><?php if($in->valor2 === '0'){echo '00';}else{ echo $in->valor2;} ?></small></span></div>
	              <div class="star-rating"><i class="<?php if($avaliacaototal >= '1'){echo 'sr-star ci-star-filled active';}else{echo 'sr-star ci-star';}?>"></i><i class="<?php if($avaliacaototal >= '2'){echo 'sr-star ci-star-filled active';}else{echo 'sr-star ci-star';}?>"></i><i class="<?php if($avaliacaototal >= '3'){echo 'sr-star ci-star-filled active';}else{echo 'sr-star ci-star';}?>"></i><i class="<?php if($avaliacaototal >= '4'){echo 'sr-star ci-star-filled active';}else{echo 'sr-star ci-star';}?>"></i><i class="<?php if($avaliacaototal >= '5'){echo 'sr-star ci-star-filled active';}else{echo 'sr-star ci-star';}?>"></i>
	              </div>
	            </div>
	          </div>
	        </div>
	      </div>




	      
	
	<?php

			}
		}
	}

	break;


	case 'sandalias':
	$categoria = 'sandalias';
	if(listarprodutos($categoria)){
		$sandalias = listarprodutos($categoria);
		foreach ($sandalias as $in) {

		if($in->status != 'Indisponivel'){


		$totalavaliacao = (qntavaliacao2($in->id,'5')+qntavaliacao2($in->id,'4')+qntavaliacao2($in->id,'3')+qntavaliacao2($in->id,'2') * 100)/(0.220*10);
     	$avaliacaototal = number_format($totalavaliacao, 1, '.', '');
		
	?>
		<div class="col-lg-4 col-6 px-0 px-sm-2 me-sm-4">
	        <div class="card product-card card-static" style="width: 98%;">

	        <?php if(isset($_SESSION['logado'])){
	        	$usu = $_SESSION['logado'];
	        		if($usu->cargo == 1){ ?>

	        	<!-- DELETE -->
	        	<button id="produto-delete" data-id="<?php echo $in->id; ?>" class="btn-wishlist btn-sm" type="button" data-toggle="tooltip" title="Excluir" style="left:10px;"><svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-trash-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
				  <path fill-rule="evenodd" d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5a.5.5 0 0 0-1 0v7a.5.5 0 0 0 1 0v-7z"/>
				</svg></button>

				<!-- EDITAR -->
	        	<button id="produto-editar" data-id="<?php echo $in->id; ?>" class="btn-wishlist btn-sm" type="button" data-toggle="tooltip" title="Editar" style="left:55px;"><svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-gear-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
				  <path fill-rule="evenodd" d="M9.405 1.05c-.413-1.4-2.397-1.4-2.81 0l-.1.34a1.464 1.464 0 0 1-2.105.872l-.31-.17c-1.283-.698-2.686.705-1.987 1.987l.169.311c.446.82.023 1.841-.872 2.105l-.34.1c-1.4.413-1.4 2.397 0 2.81l.34.1a1.464 1.464 0 0 1 .872 2.105l-.17.31c-.698 1.283.705 2.686 1.987 1.987l.311-.169a1.464 1.464 0 0 1 2.105.872l.1.34c.413 1.4 2.397 1.4 2.81 0l.1-.34a1.464 1.464 0 0 1 2.105-.872l.31.17c1.283.698 2.686-.705 1.987-1.987l-.169-.311a1.464 1.464 0 0 1 .872-2.105l.34-.1c1.4-.413 1.4-2.397 0-2.81l-.34-.1a1.464 1.464 0 0 1-.872-2.105l.17-.31c.698-1.283-.705-2.686-1.987-1.987l-.311.169a1.464 1.464 0 0 1-2.105-.872l-.1-.34zM8 10.93a2.929 2.929 0 1 0 0-5.86 2.929 2.929 0 0 0 0 5.858z"/>
				</svg></button>

			<?php }
				}
			 ?>

				<!-- DESEJO -->
	          <button class="btn-wishlist btn-sm" id="desejo" data-id="<?php echo $in->id; ?>" data-usu="<?php echo $_SESSION['logado']->id; ?>" type="button" data-toggle="tooltip" data-placement="left" <?php if(!isset($_SESSION['logado'])){ echo 'onclick="fazerlog();"';} ?>><i class="ci-heart" <?php if(isset($_SESSION['logado'])){ if(verifdesejo($in->id, $_SESSION['logado']->id)){ echo 'style="color:#fe696a"';} } ?>></i></button>

	          <!-- PRODUTO -->
	          <a class="card-img-top d-block overflow-hidden" href="index.php?p=produto&id=<?php echo $in->id; ?>"><img style="width: 100%; height: 100%;" src="<?php echo "img/produtos/".$in->foto1; ?>" alt="<?php echo $in->titulo; ?>"></a>
	          <div class="card-body py-2">
	          	<a class="product-meta d-block font-size-xs pb-1" style="opacity: 0.70;"><?php echo $in->status; ?></a>
	            <h3 class="product-title font-size-sm"><a href="index.php?p=produto&id=<?php echo $in->id; ?>"><?php echo $in->titulo; ?></a></h3>
	            <div class="d-flex justify-content-between">
	              <div class="product-price"><span class="text-accent">R$<?php echo $in->valor; ?>,<small><?php if($in->valor2 === '0'){echo '00';}else{ echo $in->valor2;} ?></small></span></div>
	              <div class="star-rating"><i class="<?php if($avaliacaototal >= '1'){echo 'sr-star ci-star-filled active';}else{echo 'sr-star ci-star';}?>"></i><i class="<?php if($avaliacaototal >= '2'){echo 'sr-star ci-star-filled active';}else{echo 'sr-star ci-star';}?>"></i><i class="<?php if($avaliacaototal >= '3'){echo 'sr-star ci-star-filled active';}else{echo 'sr-star ci-star';}?>"></i><i class="<?php if($avaliacaototal >= '4'){echo 'sr-star ci-star-filled active';}else{echo 'sr-star ci-star';}?>"></i><i class="<?php if($avaliacaototal >= '5'){echo 'sr-star ci-star-filled active';}else{echo 'sr-star ci-star';}?>"></i>
	              </div>
	            </div>
	          </div>
	        </div>
	      </div>




	      
	
	<?php

			}
		}
	}

	break;

	case 'registrar':
		$nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_STRING);
		$endereco = filter_input(INPUT_POST, 'endereco', FILTER_SANITIZE_STRING);
		$referencia = filter_input(INPUT_POST, 'referencia', FILTER_SANITIZE_STRING);
		$email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING);
		$telefone = filter_input(INPUT_POST, 'telefone', FILTER_SANITIZE_STRING);
		$senha = filter_input(INPUT_POST, 'senha', FILTER_SANITIZE_STRING);

		if(verifuser($email)){
			echo 'possui';
		} else {
			
			if(cadastrouser($nome,$endereco,$referencia,$email,$telefone,$senha)){
				echo 'cadastrou';
				$_SESSION['logado'] = pegalogin($email);
			} else{
				echo 'erro';
			}
		}


	break;

	case 'login':
		$email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING);
		$senha = filter_input(INPUT_POST, 'senha', FILTER_SANITIZE_STRING);

		if(login($email,$senha)){
			echo 'logou';

			$_SESSION['logado'] = pegalogin($email);
		} else{
			echo 'errado';
		}


	break;

	case 'cadastroprod':
		$id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
		$titulo = filter_input(INPUT_POST, 'titulo', FILTER_SANITIZE_STRING);
		$descrissao = filter_input(INPUT_POST, 'descrissao', FILTER_SANITIZE_STRING);
		$categoria = filter_input(INPUT_POST, 'categoria', FILTER_SANITIZE_STRING);
		$valor = filter_input(INPUT_POST, 'valor', FILTER_SANITIZE_NUMBER_INT);
		$valor2 = filter_input(INPUT_POST, 'valor2', FILTER_SANITIZE_NUMBER_INT);
		$status = filter_input(INPUT_POST, 'status', FILTER_SANITIZE_STRING);
		$tamanho1 = filter_input(INPUT_POST, 'tamanho1', FILTER_SANITIZE_NUMBER_INT);
		$tamanho2 = filter_input(INPUT_POST, 'tamanho2', FILTER_SANITIZE_NUMBER_INT);
		$tamanho3 = filter_input(INPUT_POST, 'tamanho3', FILTER_SANITIZE_NUMBER_INT);
		$compo1 = filter_input(INPUT_POST, 'compo1', FILTER_SANITIZE_STRING);
		$compo2 = filter_input(INPUT_POST, 'compo2', FILTER_SANITIZE_STRING);
		$compo3 = filter_input(INPUT_POST, 'compo3', FILTER_SANITIZE_STRING);
		$tamanhounico = filter_input(INPUT_POST, 'tamanhounico', FILTER_SANITIZE_NUMBER_INT);
		$fornecedor = filter_input(INPUT_POST, 'fornecedor', FILTER_SANITIZE_STRING);


      	if(cadastroprod($titulo,$descrissao,$categoria,$valor,$valor2,$status,$tamanho1,$tamanho2,$tamanho3,$compo1,$compo2,$compo3,$tamanhounico,$fornecedor,$id)){
			echo 'cadastrou';
		} else{
			echo 'erro';
		}
	break;


	case 'inscrever':
		$email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);

		if(verifinscrever($email)){
			echo 'existe';
		} else {
			if(inscrever($email)){
				echo 'sucesso';
			} else {
				echo 'erro';
			}
		}
	break;

	case 'form_excluir':

		?>
		<div class="aviso"></div>
		<form action="" name="form_excluir" method="post">
		  <div class="form-group row">
		   	<label style="margin-left:30px;">Deseja realmente excluir este produto?</label>
		  </div>
		  <div class="col-auto my-1">
		      <button type="submit" class="btn btn-primary">Sim</button>
		      <img src="../img/load2.gif" align="center" id="load" style="display:none; width: 30px;">
		    </div>
		  <br />
		</form>

		<?php
	break;

	//EXCLUIR
	case 'excluir':
		$id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
		$table = filter_input(INPUT_POST, 'table', FILTER_SANITIZE_STRING);

		if (delete($table,$id)) {
	
				delete2('desejos',$id);
				delete2('carrinho',$id);
	
				echo "deletou";	

			
		} else{
			echo "nao deletou";
		}
		
	break;	



	case 'editarprod':
	$id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);

	if(editprod($id)){
		$listarprodutos = editprod($id);
		foreach ($listarprodutos as $list) {
		
	?>

		<div class="aviso2"></div>

	  <form class="needs-validation tab-pane" autocomplete="off" novalidate id="signup-tab" action="" name="editarprod" method="post" enctype="multipart/form-data">
	  	
	  <div class="form-group">
	    <input class="form-control" type="text" name="titulo" placeholder="Titulo" value="<?php echo $list->titulo; ?>" required>
	    <div class="invalid-feedback">Por favor informe o titulo</div>
	  </div>

	  <div class="form-group">
	    <input class="form-control" type="text" name="descrissao" placeholder="Descrissão" value="<?php echo $list->descrissao; ?>" required>
	    <div class="invalid-feedback">Por favor informe a descrissão</div>
	  </div>

	  <div class="form-group">
	    <select class="form-control" type="text" name="categoria" placeholder="Categoria" required>
	      <option selected value="">- Categoria -</option>
	      <option value="Infantil" <?php if($list->categoria === "Infantil"){echo 'selected';}?> >Infantil</option>
	    </select>
	    <div class="invalid-feedback">Por favor informe a categoria</div>
	  </div>
	  
	  <div class="form-group" >
	    <input class="form-control" type="number" maxlength="3" name="valor" placeholder="Valor Ex: 90 (reais)" value="<?php echo $list->valor; ?>" required style="width: 45%; float: left; margin-right: 10px;">
	    <input class="form-control" type="number" maxlength="2" name="valor2" placeholder="Valor Ex: 99 (centavos)" value="<?php echo $list->valor2; ?>" required style="width: 49%">
	    <div class="invalid-feedback">Por favor informe o valor</div>
	  </div>

	  <div class="form-group">
	    <select class="form-control" type="text" name="status" placeholder="Status" required>
	      <option value="Disponivel" <?php if($list->status === "Disponivel"){echo 'selected';}?> >Disponivel</option>
	      <option value="A caminho" <?php if($list->status === "A caminho"){echo 'selected';}?>>A caminho</option>
	      <option value="Indisponivel" <?php if($list->status === "Indisponivel"){echo 'selected';}?>>Indisponivel</option>
	    </select>
	    <div class="invalid-feedback">Por favor informe o status</div>
	  </div>

	  <div class="form-group">
	    <input class="form-control" type="number" maxlength="3" name="tamanho1" placeholder="Qnt. P" required style="width: 24%; float: left; margin-right: 3px;" value="<?php echo $list->tamanho1; ?>" >

	    <input class="form-control" type="number" maxlength="3" name="tamanho2" placeholder="Qnt. M" required style="width: 24%; float: left; margin-right: 3px;" value="<?php echo $list->tamanho2; ?>">

	    <input class="form-control" type="number" maxlength="3" name="tamanho3" placeholder="Qnt. G" required style="width: 24%; float: left; margin-right: 3px;" value="<?php echo $list->tamanho3; ?>">

	    <input class="form-control" type="number" maxlength="3" name="tamanhounico" placeholder="Qnt. unico" required style="width: 24%;" value="<?php echo $list->tamanhounico; ?>">

	    <div class="invalid-feedback">Por favor informe a quantiade</div>
	  </div>

	  <div class="form-group">
	    <input class="form-control" type="text" name="compo1" placeholder="Composição 01" required value="<?php echo $list->compo1; ?>" >

	    <input class="form-control" type="text" name="compo2" placeholder="Composição 02" value="<?php echo $list->compo2; ?>">

	    <input class="form-control" type="text" name="compo3" placeholder="Composição 03" value="<?php echo $list->compo3; ?>">


	    <div class="invalid-feedback">Por favor informe a composição</div>
	  </div>

	  <div class="form-group">
	    <input class="form-control" type="text" name="fornecedor" placeholder="Fornecedor" value="<?php echo $list->fornecedor; ?>" required>
	    <div class="invalid-feedback">Por favor informe o fornecedor</div>
	  </div>

		<div id="result"></div>

	<input type="hidden" name="id" value="<?php echo $list->id; ?>">
	  <button class="btn btn-primary btn-block btn-shadow" type="submit">Salvar</button>

	  </form>
	

	<?php

		}
	}

	break;


	case 'editprod':
		$id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_STRING);
		$titulo = filter_input(INPUT_POST, 'titulo', FILTER_SANITIZE_STRING);
		$descrissao = filter_input(INPUT_POST, 'descrissao', FILTER_SANITIZE_STRING);
		$categoria = filter_input(INPUT_POST, 'categoria', FILTER_SANITIZE_STRING);
		$valor = filter_input(INPUT_POST, 'valor', FILTER_SANITIZE_NUMBER_INT);
		$valor2 = filter_input(INPUT_POST, 'valor2', FILTER_SANITIZE_NUMBER_INT);
		$status = filter_input(INPUT_POST, 'status', FILTER_SANITIZE_STRING);
		$tamanho1 = filter_input(INPUT_POST, 'tamanho1', FILTER_SANITIZE_NUMBER_INT);
		$tamanho2 = filter_input(INPUT_POST, 'tamanho2', FILTER_SANITIZE_NUMBER_INT);
		$tamanho3 = filter_input(INPUT_POST, 'tamanho3', FILTER_SANITIZE_NUMBER_INT);
		$compo1 = filter_input(INPUT_POST, 'compo1', FILTER_SANITIZE_STRING);
		$compo2 = filter_input(INPUT_POST, 'compo2', FILTER_SANITIZE_STRING);
		$compo3 = filter_input(INPUT_POST, 'compo3', FILTER_SANITIZE_STRING);
		$tamanhounico = filter_input(INPUT_POST, 'tamanhounico', FILTER_SANITIZE_NUMBER_INT);
		$fornecedor = filter_input(INPUT_POST, 'fornecedor', FILTER_SANITIZE_STRING);


		if($titulo === '' || $descrissao === '' || $categoria === '' || $valor === '' || $valor2 === '' || $status === '' || $tamanho1 === '' || $tamanho2 === '' || $tamanho3 === '' || $tamanhounico === '' || $fornecedor === ''){
			echo 'faltou';
		} else {
			if(cadastroprod($titulo,$descrissao,$categoria,$valor,$valor2,$status,$tamanho1,$tamanho2,$tamanho3,$compo1,$compo2,$compo3,$tamanhounico,$fornecedor,$id)){
				echo 'editou';
			} else{
				echo 'erro';
			}	
		}
		
	break;



	case 'cad_comentario':
		$produto = filter_input(INPUT_POST, 'produto', FILTER_SANITIZE_NUMBER_INT);
		$nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_STRING);
		$img = filter_input(INPUT_POST, 'img', FILTER_SANITIZE_STRING);
		$star = filter_input(INPUT_POST, 'star', FILTER_SANITIZE_NUMBER_INT);
		$comentario = filter_input(INPUT_POST, 'comentario', FILTER_SANITIZE_STRING);
		$data = filter_input(INPUT_POST, 'data', FILTER_SANITIZE_STRING);

		if(cadcomentario($produto,$nome,$star,$comentario,$data,$img)){
			echo 'cadastrou';
		} else {
			echo 'erro';
		}
	break;


	case 'adddesejo':
		$id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
		$usuario = filter_input(INPUT_POST, 'usuario', FILTER_SANITIZE_NUMBER_INT);

		if(verifdesejo($id, $usuario)){
			if(removedesejo($id,$usuario)){
				echo 'removeu';
			} else {
				echo 'erro';
			}
		} else{
			if(adddesejo($id,$usuario)){
				echo 'adicionou';
			} else {
				echo 'erro';
			}
		}
		
	break;

	case 'addcarrinho':
		$id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
		$usuario = filter_input(INPUT_POST, 'usuario', FILTER_SANITIZE_NUMBER_INT);
		$tamanho = filter_input(INPUT_POST, 'tamanho', FILTER_SANITIZE_STRING);
		$qnt = filter_input(INPUT_POST, 'qnt', FILTER_SANITIZE_NUMBER_INT);

		if(verifcarrinho($id, $usuario)){
			if(removecarrinho($id,$usuario)){
				echo 'removeu';
			} else {
				echo 'erro';
			}
		} else{
			if(addcarrinho($id,$usuario,$tamanho,$qnt)){
				echo 'adicionou';
			} else {
				echo 'erro';
			}
		}
		
	break;


	case 'qntprod':
		$id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
		$tamanho = filter_input(INPUT_POST, 'tamanho', FILTER_SANITIZE_STRING);

		if($tamanho === 'P'){
			$meutamanho = 'tamanho1';
		} else if($tamanho === 'M'){
			$meutamanho = 'tamanho2';
		} else if($tamanho === 'G'){
			$meutamanho = 'tamanho3';
		} else{
			$meutamanho = 'tamanhounico';
		}

		if($tamanho === ''){
	    	?>
	    	<option value="">0</option>
	    	<?php
	    } else {


                     
		    if(editprod($id)){
		    	$edit = editprod($id);
		    	foreach ($edit as $e) {	    	

			    	$i = 1;
			    	while ($i <= $e->$meutamanho) {
			    		?>
			    		<option value="<?php echo $i; ?>"><?php echo $i; ?></option>
			    		<?php
			    		$i++;
			    	}
		    	}
		    } else {
		    	?>
		    	<option value="">0</option>
		    	<?php
		    }
		}

	break;

	case 'form_altinfo':
		$usu = $_SESSION['logado'];

		?>

		<form class="needs-validation tab-pane" autocomplete="off" novalidate action="" name="altinfo" method="post" enctype="multipart/form-data">
			<div class="aviso3"></div>
              <div class="form-group">
                <label for="su-name">Nome completo:</label>
                <input class="form-control" type="text" name="nome" value="<?php echo $usu->usuario; ?>" placeholder="Ex: Pedro Henrique Sobrenome.." required>
                <div class="invalid-feedback">Por favor informe seu nome completo</div>
              </div>
              <div class="form-group">
                <label for="su-name">Foto de perfil:</label>
                <input type="file" name="perfil" accept="image/*" class="form-control">
              </div>
              <div class="form-group">
                <label for="su-name">Celular:</label>
                <input class="form-control" type="number" name="telefone" placeholder="Ex: 71 98888-8888" value="<?php echo $usu->telefone; ?>" required >
                <div class="invalid-feedback">Por favor informe o número para contato</div>
              </div>
              <div class="form-group">
                <label for="su-name">Endereço</label>
                <input class="form-control" type="text" name="endereco" value="<?php echo $usu->endereco; ?>" placeholder="Ex: Rua do canal, nº 00, Bairro, Camaçari" required >
                <div class="invalid-feedback">Por favor informe seu endereço</div>
              </div>
              <div class="form-group">
                <label for="su-name">Ponto de Referência</label>
                <input class="form-control" type="text" name="referencia" value="<?php echo $usu->referencia; ?>"  placeholder="Ex: Perto ao mercado camaçari" required >
                <div class="invalid-feedback">Por favor informe um ponto de referência</div>
              </div>
              <input type="hidden" name="email" value="<?php echo $usu->email; ?>">
              <input type="hidden" name="id" value="<?php echo $usu->id; ?>">
              <button class="btn btn-primary btn-block btn-shadow" type="submit">Salvar</button>
            </form>


		<?php

	break;

	case 'atualizarinfo':
		$id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
		$email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING);
		$nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_STRING);
		$endereco = filter_input(INPUT_POST, 'endereco', FILTER_SANITIZE_STRING);
		$referencia = filter_input(INPUT_POST, 'referencia', FILTER_SANITIZE_STRING);
		$telefone = filter_input(INPUT_POST, 'telefone', FILTER_SANITIZE_STRING);

	
		if(atualizarinfo($nome,$endereco,$telefone,$referencia,$id)){

			echo 'atualizou';
		} else{
			echo 'erro';
		}

		$_SESSION['logado'] = pegalogin($email);

	break;

	case 'validacupom':
		$cupom = filter_input(INPUT_POST, 'cupom', FILTER_SANITIZE_STRING);
		$valor = filter_input(INPUT_POST, 'valor', FILTER_SANITIZE_NUMBER_INT);

		if(verifcupom($cupom)){
			if(verifcupom2($cupom,$valor)){
					echo verifcupom2($cupom,$valor);
				
			} else {
				echo 'incompativel';
			}
		} else {
			echo 'naoexiste';
		}

	break;


	case 'retirada':
		$id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
	?>
		<span class='font-weight-medium'>Obs¹:</span> Por este metódo o pagamente é em especie (à vista).
    	<br><span class='font-weight-medium'>Obs²:</span> Por este metódo o produto não estará reservado para você, somente quando realizar a retirada.</p>

    	<form action="index.php?p=comprar3" method="post">
    		<input type="hidden" name="idret" value="<?php echo $id; ?>">
    		<button class="btn btn-primary" type="submit" href="index.php?p=comprar3">Confirmar</button>
    	</form>

	<?php
	break;


	default:
		echo 'Erro';
	break;

}
ob_end_flush();