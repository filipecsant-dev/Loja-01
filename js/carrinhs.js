$(document).ready(function(){
	$('body').on("click", '#removecar', function(){
		var botao = $(this);
		var id = $(this).attr('data-id');
		var usuario = $(this).attr('data-usu');



			$.ajax({
				url: 'ajax/controle.php',
				type: "POST",
				data: {acao: 'addcarrinho', id: id, usuario: usuario},
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


	$('.col-lg-4').on("click", '#appcupom', function(){
		var button = document.getElementById('appcupom');
		var inpcupom = $('.col-lg-4').find('#cupom');
		var cupom = $('.col-lg-4').find('#cupom').val();
		var valor = $('.col-lg-4').find('#subtotal').val();
		
		$.ajax({
			url: 'ajax/controle.php',
			type: 'POST',
			data: {acao: 'validacupom', cupom: cupom, valor: valor},
			beforeSend: function(){
				button.disabled=true;
			},
			success: function(retorno){

				if(retorno === 'naoexiste'){
					msgfun3('Este cupom não existe!', 'erro');
					button.disabled=false;
				} else if(retorno === 'incompativel'){
					msgfun3('Este cupom não é válido para este valor em compras!', 'alerta');
					button.disabled=false;
				} else {
					msgfun32('Cupom de '+retorno+'% aplicado com sucesso!', 'sucesso');
					button.disabled=true;
					inpcupom.attr('disabled', true);
					$('.col-lg-4').find('#valorcupom').val(retorno);
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

	function msgfun32(msg, tipo){
		var retorno = $('.aviso3');
		var tipo = (tipo === 'sucesso') ? 'success' : (tipo === 'alerta') ? 'warning' : (tipo === 'erro') ? 'danger' : (tipo === 'info') ? 'info' : alert('INFORME MENSAGENS DE SUCESSO, ALERTA, ERRO E INFO');
	
		retorno.empty().fadeOut('fast', function(){
			return $(this).html('<div class="alert alert-'+tipo+'">'+msg+'</div>').fadeIn('slow');
		});


	}

});