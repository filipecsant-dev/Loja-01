$(document).ready(function(){

	$('.cadprod').on("submit", 'form[name="cadastrar_produto"]', function(){
		var dados = $(this);
		var botao = dados.find(':button');
		
		$.ajax({
			url: "ajax/upload.php", 
			type: "POST",            
			data: new FormData(this),
			contentType: false,      
			cache: false,            
			processData:false,
			beforeSend: function(){
				botao.attr('disable', true);

			},        
			success: function(retorno){
				botao.attr('disable', false);

					if(retorno === 'tamanho1'){
						$('html, body').animate({
				            scrollTop: 0
				        }, 200);
						msgfun2('Tamanho ou tipo de imagem inválida! (Imagem 1)', 'alerta');

					} else if(retorno === 'erro1'){
						$('html, body').animate({
				            scrollTop: 0
				        }, 200);
						msgfun2('Ocorreu um erro nesta imagem! (Imagem 1)', 'erro');
					} else if(retorno === 'existe1'){
						$('html, body').animate({
				            scrollTop: 0
				        }, 200);
						msgfun2('Está imagem ou nome já existe! (Imagem 1)', 'alerta');

					} else if(retorno === 'tamanho2'){
						$('html, body').animate({
				            scrollTop: 0
				        }, 200);
						msgfun2('Tamanho ou tipo de imagem inválida! (Imagem 2)', 'alerta');

					} else if(retorno === 'erro2'){
						$('html, body').animate({
				            scrollTop: 0
				        }, 200);
						msgfun2('Ocorreu um erro nesta imagem! (Imagem 2)', 'erro');
					} else if(retorno === 'existe2'){
						$('html, body').animate({
				            scrollTop: 0
				        }, 200);
						msgfun2('Está imagem ou nome já existe! (Imagem 2)', 'alerta');

					} else if(retorno === 'tamanho3'){
						$('html, body').animate({
				            scrollTop: 0
				        }, 200);
						msgfun2('Tamanho ou tipo de imagem inválida! (Imagem 3)', 'alerta');

					} else if(retorno === 'erro3'){
						$('html, body').animate({
				            scrollTop: 0
				        }, 200);
						msgfun2('Ocorreu um erro nesta imagem! (Imagem 3)', 'erro');
					} else if(retorno === 'existe3'){
						$('html, body').animate({
				            scrollTop: 0
				        }, 200);
						msgfun2('Está imagem ou nome já existe! (Imagem 3)', 'alerta');

					} else {
						//CADASTRAR O PRODUTO
						$.ajax({
							url: "ajax/controle.php", 
							type: "POST",           
							data: "acao=cadastroprod&id="+retorno+"&"+dados.serialize(),
							beforeSend: function(){
								botao.attr('disable', true);

							},
							success: function(retorno){
								botao.attr('disable', false);
								$('html, body').animate({
						            scrollTop: 0
						        }, 200);

								if(retorno === 'cadastrou'){
									msgfun2('Produto cadastrado com sucesso!', 'sucesso');
									$('input').val('');
									$('select').val('');
								}else {
									msgfun2('Erro ao cadastrar produto', 'erro');
										
								}

								
							}
						});
						//FIM CADASTRAR O PRODUTO
					}
			}
		});

		return false;
	});

	


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
});