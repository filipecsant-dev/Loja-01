$(document).ready(function(){
	
	$('.col-lg-4').on("click", '#altinfo', function(){
		var conteudo = $('.modal-body');

		$.post('ajax/controle.php', {acao: 'form_altinfo'},function(retorno){
			$('#ExemploModalCentralizado').modal({backdrop: 'static'});
			$('#TituloModalCentralizado').html('Alterar informações');
			conteudo.html(retorno);	
		});

		return false;
	});

	$('.modal-body').on("submit", 'form[name="altinfo"]', function(){
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
			success: function(retorno1){
				botao.attr('disable', false);

					if(retorno1 === 'tamanho4'){
						msgfun3('Tamanho ou tipo de imagem inválida!', 'alerta');
					} else if(retorno1 === 'erro4'){
						msgfun3('Ocorreu um erro nesta imagem!', 'erro');
					} else if(retorno1 === 'existe4'){
						msgfun3('Está imagem ou nome já existe!', 'alerta');
					} else{
						$.ajax({
						url: 'ajax/controle.php',
						type: 'POST',
						data: 'acao=atualizarinfo&'+dados.serialize(),
						beforeSend: function(){
							botao.attr('disable', true);

						},
						success: function(retorno){
							botao.attr('disable', false);
							dados.fadeIn('slow');
							dados.find('input').val('');

							if(retorno1 === 'atualizou' || retorno === 'atualizou'){

									msgfun3('Seus dados foram atualizados!', 'sucesso');

									setTimeout(function(){
										location.reload(true);
									},1700);
								
							}else {

									msgfun3('Oops, aconteceu um erro ao atualizar seus dados, tente novamente em instantes!', 'erro');
								
							}

						}
					});
					}
				}
			});

		return false;
	});


	function msgfun3(msg, tipo){
		var retorno = $('.aviso3');
		var tipo = (tipo === 'sucesso') ? 'success' : (tipo === 'alerta') ? 'warning' : (tipo === 'erro') ? 'danger' : (tipo === 'info') ? 'info' : alert('INFORME MENSAGENS DE SUCESSO, ALERTA, ERRO E INFO');
	
		retorno.empty().fadeOut('fast', function(){
			return $(this).html('<div class="alert alert-'+tipo+'">'+msg+'</div>').fadeIn('slow');
		});

		setTimeout(function(){
			retorno.fadeOut('slow').empty();
		},4000);
	}

});