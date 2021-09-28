$(document).ready(function(){

	listarprodutos('ajax/controle.php', 'infantil');
	//listarprodutos('ajax/controle.php', 'sandalias');

	function listarprodutos(url, acao){
		$.post(url, {acao: acao}, function(retorno){

			if(acao === 'infantil'){
				var tbody = $('#infantil');
				tbody.html(retorno);
			/*} else {
				var tbody = $('#sandalias');
				tbody.html(retorno);*/
			}
				
		
			
				
		});
	}


	//REGISTRAR USUARIO
	$('.modal-body').on("submit", 'form[name="registrar"]', function(){
		var dados = $(this);
		var botao = dados.find(':button');

		$.ajax({
			url: 'ajax/controle.php',
			type: 'POST',
			data: 'acao=registrar&'+dados.serialize(),
			beforeSend: function(){
				botao.attr('disable', true);

			},
			success: function(retorno){
				botao.attr('disable', false);

				if(retorno === 'cadastrou'){
					dados.fadeOut('slow', function(){
						msgfun('Sua conta foi registrada com sucesso!', 'sucesso');
					});
					
				}else if(retorno === 'possui'){
					dados.fadeOut('slow', function(){
						msgfun('Este email já está cadastrado em nossa loja!', 'alerta');
					});
				}else {
					dados.fadeOut('slow', function(){
						msgfun('Oops, aconteceu um erro ao efetuar o cadastro, tente novamente em instantes!', 'erro');
					});
					
				}

				setTimeout(function(){
					dados.find('input').val('');
					location.reload(true);
				},2000);
			}
		});
		return false;
	});

	$('.modal-body').on("submit", 'form[name="login"]', function(){
		var dados = $(this);
		var botao = dados.find(':button');

		$.ajax({
			url: 'ajax/controle.php',
			type: 'POST',
			data: 'acao=login&'+dados.serialize(),
			beforeSend: function(){
				botao.attr('disable', true);

			},
			success: function(retorno){
				botao.attr('disable', false);

				if(retorno === 'logou'){
					dados.fadeOut('slow', function(){
						msgfun('Seja bem-vindo novamente!', 'sucesso');
					});
					setTimeout(function(){
						location.reload(true);
					},1500);
					
				}else {
					msgfun('Infelizmente não encontramos nenhum registro com essas informações.', 'erro');
					setTimeout(function(){
						dados.find('input').val('');
						dados.fadeIn('slow');
					},4000);
					
				}

				
			}
		});
		return false;
	});


	$('#finish').on("click", function(){
		location.reload(true);
	});


	$('.bg-dark').on("submit", 'form[name="inscrever"]', function(){
		var dados = $(this);
		var botao = dados.find(':button');

		$.ajax({
			url: 'ajax/controle.php',
			type: 'POST',
			data: 'acao=inscrever&'+dados.serialize(),
			beforeSend: function(){
				botao.attr('disable',true);
				botao.html('Salvando..');
			},
			success: function(retorno){
				botao.attr('disable',false);
				botao.html('Inscrever-se');
				$('input').val('');

				if(retorno === 'sucesso'){
					msginscrever('Seu email foi registrado com sucesso, você receberá mensagens de novos lançamentos.','sucesso');
				} else if(retorno === 'existe'){
					msginscrever('Esse email já está registrado para receber mensagens de lançamentos!', 'alerta');
				} else{
					msginscrever('Oops, ocorreu um erro ao registrar seu email, tente novamente em instantes!', 'erro');
				}

			}
		});
	});


	$('body').on("click", '#produto-delete', function(){
		var conteudo = $('.modal-body');
		var id = $(this).attr('data-id');

		$.post('ajax/controle.php', {acao: 'form_excluir'},function(retorno){
			$('#ExemploModalCentralizado').modal({backdrop: 'static'});
			$('#TituloModalCentralizado').html('Excluir Produto');
			conteudo.html(retorno);	
		});
		

		$('#ExemploModalCentralizado').on("submit", 'form[name="form_excluir"]', function(){
			var dados = $(this);
			var table = 'produtos';
			var botao = dados.find(':button');

			$.ajax({
				url: 'ajax/controle.php',
				type: "POST",
				data: {acao: 'excluir',  id: id, table: table},
				beforeSend: function(){
					botao.attr('disabled', true);
					$('#load').fadeIn('slow');
				},

				success: function(retorno){
					if(retorno === "deletou"){
						dados.fadeOut('slow', function(){
							msgfun('Produto excluido com sucesso!', 'sucesso');
						});
						setTimeout(function(){
							location.reload(true);
						},1500);
					} else {
						msgfun('Erro ao excluir produto!', 'erro');
					}
				}
			});
			return false;
		});
		return false;
	});

	$('body').on("click", '#produto-editar', function(){
		var conteudo = $('.modal-body');
		var id = $(this).attr('data-id');

		$.post('ajax/controle.php', {acao: 'editarprod', id: id},function(retorno){
			$('#ExemploModalCentralizado').modal({backdrop: 'static'});
			$('#TituloModalCentralizado').html('Editar Produto');
			conteudo.html(retorno);	
		});
		

		$('#ExemploModalCentralizado').on("submit", 'form[name="editarprod"]', function(){
			var dados = $(this);
			var botao = dados.find(':button');

			$.ajax({
				url: 'ajax/controle.php',
				type: "POST",
				data: 'acao=editprod&'+dados.serialize(),
				beforeSend: function(){
					botao.attr('disabled', true);
				},

				success: function(retorno){
					if(retorno === "editou"){
						dados.fadeOut('slow', function(){
							msgfun2('Produto salvo com sucesso!', 'sucesso');
						});
						setTimeout(function(){
							location.reload(true);
						},1500);
					} else if(retorno === 'faltou'){
						msgfun2('Algum item não preenchido!', 'alerta');
					} else {
						msgfun2('Erro ao salvar produto!', 'erro');
					}
				}
			});
			return false;
		});
		return false;
	});


	$('body').on("click", '#desejo', function(){
		var botao = $(this);
		var id = $(this).attr('data-id');
		var usuario = $(this).attr('data-usu');



			$.ajax({
				url: 'ajax/controle.php',
				type: "POST",
				data: {acao: 'adddesejo', id: id, usuario: usuario},
				beforeSend: function(){
					botao.attr('disabled', true);
				},

				success: function(retorno){
					botao.attr('disabled', false);

					if(retorno === "removeu"){
						
						location.reload(true);
				
					}
				}
			});
			return false;
	});




	$(".suave").click(function(event){
	    event.preventDefault();
	    $('html, body').animate({
	        scrollTop: $( $.attr(this, 'href') ).offset().top
	    }, 1000);
	});


	//Funções de Mensagem
	function msgfun(msg, tipo){
		var retorno = $('.aviso');
		var tipo = (tipo === 'sucesso') ? 'success' : (tipo === 'alerta') ? 'warning' : (tipo === 'erro') ? 'danger' : (tipo === 'info') ? 'info' : alert('INFORME MENSAGENS DE SUCESSO, ALERTA, ERRO E INFO');
	
		retorno.empty().fadeOut('fast', function(){
			return $(this).html('<div class="alert alert-'+tipo+'">'+msg+'</div>').fadeIn('slow');
		});

		setTimeout(function(){
			retorno.fadeOut('slow').empty();
		},4000);
	}

	//Funções de Mensagem
	function msgfun2(msg, tipo){
		var retorno = $('.aviso2');
		var tipo = (tipo === 'sucesso') ? 'success' : (tipo === 'alerta') ? 'warning' : (tipo === 'erro') ? 'danger' : (tipo === 'info') ? 'info' : alert('INFORME MENSAGENS DE SUCESSO, ALERTA, ERRO E INFO');
	
		retorno.empty().fadeOut('fast', function(){
			return $(this).html('<div class="alert alert-'+tipo+'">'+msg+'</div>').fadeIn('slow');
		});

		setTimeout(function(){
			retorno.fadeOut('slow').empty();
		},4000);
	}

	//MSG INSCREVER
	function msginscrever(msg, tipo){
		var retorno = $('.aviso-inscrever');
		var tipo = (tipo === 'sucesso') ? 'success' : (tipo === 'alerta') ? 'warning' : (tipo === 'erro') ? 'danger' : (tipo === 'info') ? 'info' : alert('INFORME MENSAGENS DE SUCESSO, ALERTA, ERRO E INFO');
	
		retorno.empty().fadeOut('fast', function(){
			return $(this).html('<div class="alert alert-'+tipo+'">'+msg+'</div>').fadeIn('slow');
		});

		setTimeout(function(){
			retorno.fadeOut('slow').empty();
		},4000);
	}


});