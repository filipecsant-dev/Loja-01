<?php

if(isset($_SESSION['logado'])){
  $usu = $_SESSION['logado'];
} else {
  header('Location: index.php');
}

if(isset($_POST['valor'])){
  $vcomentario = filter_input(INPUT_POST, 'comentario', FILTER_SANITIZE_STRING);
  $vcupom= filter_input(INPUT_POST, 'cupom', FILTER_SANITIZE_STRING);
  $vvalor = filter_input(INPUT_POST, 'valor', FILTER_SANITIZE_STRING);
  $ventrega = filter_input(INPUT_POST, 'entrega', FILTER_SANITIZE_STRING);
  $total = filter_input(INPUT_POST, 'total', FILTER_SANITIZE_STRING);



} else {
  header('Location: index.php?p=carrinho');
}
global $ref;
setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
date_default_timezone_set('America/Sao_Paulo');

$data = strftime('%d de %B de %Y às %H:%M', strtotime('today'));

$id = addvenda($usu->endereco,$vcomentario,$vcupom,$vvalor,$ventrega,$total,'rascunho',$usu->id,$data);

$ref = rand($id, 9999999999);
attvenda($ref,$id);

if(pegacarrinho($usu->id)){
  $pegacarrinho = pegacarrinho($usu->id);
  foreach ($pegacarrinho as $pe) {
    addpedido($id,$pe->usuario,$pe->produto,$pe->tamanho,$pe->qnt);
    removecarrinho($pe->produto,$usu->id);
  }
}


// SDK de Mercado Pago
require 'lib/vendor/autoload.php';

// Configura credenciais
MercadoPago\SDK::setAccessToken('APP_USR-1135667050758244-110218-3e4fd3203c16a1c9524565cbc3996ab8-253669077');


// Cria um objeto de preferência
$preference = new MercadoPago\Preference();

// Cria um item na preferência
$item = new MercadoPago\Item();
$item->title = 'Roupas & Acessórios';
$item->quantity = 1;
$item->unit_price = $total;
$preference->items = array($item);
$preference->external_reference = $ref;
$preference->back_urls = array(
    "success" => "phstore.ga/index.php?p=comprar3",
    "failure" => "phstore.ga/index.php?p=comprar3",
    "pending" => "phstore.ga/index.php?p=comprar3"
);
$preference->auto_return = "approved";
$preference->save();

?>

  <script src="js/compp2.js"></script>
   <div class="page-title-overlap bg-dark pt-4">
      <div class="container d-lg-flex justify-content-between py-2 py-lg-3">
        <div class="order-lg-2 mb-3 mb-lg-0 pt-lg-2">
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumb-light flex-lg-nowrap justify-content-center justify-content-lg-start">
              <li class="breadcrumb-item"><a class="text-nowrap" href="index.php"><i class="czi-home"></i>Inicio</a></li>
              <li class="breadcrumb-item text-nowrap"><a href="index.php?p=carrinho">Carrinho</a>
              </li>
              <li class="breadcrumb-item text-nowrap active" aria-current="page">Dados do pedido</li>
            </ol>
          </nav>
        </div>
        <div class="order-lg-1 pr-lg-4 text-center text-lg-left">
          <h1 class="h3 text-light mb-0">Dados do pedido</h1>
        </div>
      </div>
    </div>
    <!-- Page Content-->
    <div class="container pb-5 mb-2 mb-md-4">
      <div class="row">
        <section class="col-lg-8">
          <!-- Steps-->
          <div class="steps steps-light pt-2 pb-3 mb-5"><a class="step-item active" href="index.php?p=carrinho">
              <div class="step-progress"><span class="step-count">1</span></div>
              <div class="step-label"><i class="czi-cart"></i>Carrinho</div></a><a class="step-item active" href="index.php?p=comprar1">
              <div class="step-progress"><span class="step-count">2</span></div>
              <div class="step-label"><i class="czi-user-circle"></i>Detalhes do pedido</div></a><a class="step-item active current" href="index.php?p=comprar2">
              <div class="step-progress"><span class="step-count">3</span></div>
              <div class="step-label"><i class="czi-card"></i>Pagamento</div></a>
            </div>
          <!-- Payment methods accordion-->
          <h2 class="h6 pb-3 mb-2">Escolha o método de pagamento</h2>

          <div class="accordion mb-2" id="payment-method" role="tablist">
            <div class="card">
              <div class="card-header" role="tab">
                <h3 class="accordion-heading"><a href="#card" data-toggle="collapse"><i class="czi-card font-size-lg mr-2 mt-n1 align-middle"></i>Pagar com cartão ou boleto<span class="accordion-indicator"></span></a></h3>
              </div>
              <div class="collapse show" id="card" data-parent="#payment-method" role="tabpanel">
                <div class="card-body">
                  <p class="font-size-sm" style="text-align: justify;">Para melhor segurança e práticidade todos os pagamentos (cartão e boleto) são realizados e processados pelo <span class='font-weight-medium'>Mercado Pago</span>, o sistema 100% seguro e confiavel para vendas.</p>

                  <div id="btnmp">
                    <script
                      src="https://www.mercadopago.com.br/integrations/v1/web-payment-checkout.js"
                      data-preference-id="<?php echo $preference->id; ?>"
                      data-button-label="Realizar pagamento"
                    ></script>
                  </div>

                  <div class="card-wrapper">


                     
      
                      




                  </div>
                </div>
              </div>
            </div>

            


            <div class="card">
              <div class="card-header" role="tab">
                <h3 class="accordion-heading"><a class="collapsed" href="#points" data-toggle="collapse"><i class="czi-gift mr-2"></i>Pagar na retirada<span class="accordion-indicator"></span></a></h3>
              </div>
              <div class="collapse" id="points" data-parent="#payment-method" role="tabpanel">
                <div class="card-body">
                   <p class="font-size-sm">Pague somente quando você retirar o produto. <br /><br />

                    <button class="btn btn-primary" id="retirada" data-id="<?php echo $ref; ?>">Pagar na retirada</button>

                    
                    
                </div>
              </div>
            </div>
          </div>
          <!-- Navigation (desktop)-->
          <div class="d-none d-lg-flex pt-4">
            <div class="w-50 pr-3"><a class="btn btn-secondary btn-block" href="index.php?p=comprar1"><i class="czi-arrow-left mt-sm-0 mr-1"></i><span class="d-none d-sm-inline">Voltar ao detalhes</span><span class="d-inline d-sm-none">Voltar</span></a></div>
      
          </div>
        </section>
        
      </div>
      <!-- Navigation (mobile)-->
      <div class="row d-lg-none">
        <div class="col-lg-8">
          <div class="d-flex pt-4 mt-3">
            <div class="w-50 pr-3"><a class="btn btn-secondary btn-block" href="index.php?p=comprar1"><i class="czi-arrow-left mt-sm-0 mr-1"></i><span class="d-none d-sm-inline">Voltar ao detalhes</span><span class="d-inline d-sm-none">Voltar</span></a></div>
         
          </div>
        </div>
      </div>
    </div>