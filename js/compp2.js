$(document).ready(function(){
	$('.container').on("click", '#retirada',function(){
		var conteudo = $('.modal-body');
		var id = $(this).attr('data-id');

		$.post('ajax/controle.php', {acao: 'retirada', id: id},function(retorno){
			$('#ExemploModalCentralizado').modal({backdrop: 'static'});
			$('#TituloModalCentralizado').html('Pagar na retirada');
			conteudo.html(retorno);	
		});

	});
});