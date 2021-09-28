$(document).ready(function(){


	$('.mb-grid-gutter').on("change", '#tamanho-prod', function(){
		var tamanho = $(this).val();
		var id = $(this).attr('data-id');

		$.post('ajax/controle.php', {acao: 'qntprod', id: id, tamanho: tamanho}, function(retorno){
			var tbody = $('#qntp');
			tbody.html(retorno);
		});
		
		document.getElementById('qntp').removeAttribute('disabled');
	});

	$('.col-md-5').on("submit", 'form[name="form_comentario"]', function(){
		var dados = $(this);
		var botao = dados.find(':button');

		$.ajax({
			url: 'ajax/controle.php',
			type: 'POST',
			data: 'acao=cad_comentario&'+dados.serialize(),
			beforeSend: function(){
				botao.attr('disable', true);
			},
			success: function(retorno){
				botao.attr('disable', false);

				if(retorno === 'cadastrou'){
					msgfun3('Avaliação enviada com sucesso!', 'sucesso');
					$('textarea').val('');
					$('select').val('');
					setTimeout(function(){
						location.reload(true);
					},2000);
					
				}else {
					msgfun3('Erro ao enviar avaliação!', 'erro');	
				}
			}
		});
		return false;
	});


	$('.col-lg-5').on("submit", 'form[name="addcarrinho"]',function(){
		var dados = $(this);
		var botao = dados.find(':button');

		$.ajax({
			url: 'ajax/controle.php',
			type: 'POST',
			data: 'acao=addcarrinho&'+dados.serialize(),
			beforeSend: function(){
				botao.attr('disabled', true);
			},
			success: function(retorno){

				if(retorno === 'adicionou'){
					msgfun4('Produto adicionado ao seu carrinho!', 'sucesso');
					setTimeout(function(){
							location.reload(true);
						},2000);
					
				} else if('removeu'){
					msgfun4('Produto removido do seu carrinho!', 'alerta');
					setTimeout(function(){
							location.reload(true);
						},2000);
					
				}else {
					msgfun4('Oops, ocorreu um erro ao adicionar o produto. tente novamente em instantes!', 'erro');
				}
			}
		});
		return false;
	});
	


	//Funções de Mensagem
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

	//Funções de Mensagem
	function msgfun4(msg, tipo){
		var retorno = $('.aviso4');
		var tipo = (tipo === 'sucesso') ? 'success' : (tipo === 'alerta') ? 'warning' : (tipo === 'erro') ? 'danger' : (tipo === 'info') ? 'info' : alert('INFORME MENSAGENS DE SUCESSO, ALERTA, ERRO E INFO');
	
		retorno.empty().fadeOut('fast', function(){
			return $(this).html('<div class="alert alert-'+tipo+'">'+msg+'</div>').fadeIn('slow');
		});

		setTimeout(function(){
			retorno.fadeOut('slow').empty();
		},4000);
	}
});