<?php

if(isset($_SESSION['logado'])){
  $usu = $_SESSION['logado'];
} else {
  header('Location: index.php');
}

$comentario = filter_input(INPUT_POST, 'comentario', FILTER_SANITIZE_STRING);
$cupom = filter_input(INPUT_POST, 'valorcupom', FILTER_SANITIZE_STRING);
?>
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
              <div class="step-label"><i class="czi-cart"></i>Carrinho</div></a><a class="step-item active current" href="index.php?p=comprar1">
              <div class="step-progress"><span class="step-count">2</span></div>
              <div class="step-label"><i class="czi-user-circle"></i>Detalhes do pedido</div></a><a class="step-item" href="index.php?p=comprar2">
              <div class="step-progress"><span class="step-count">3</span></div>
              <div class="step-label"><i class="czi-card"></i>Pagamento</div></a>
            </div>
          <!-- Autor info-->
          <div class="d-sm-flex justify-content-between align-items-center bg-secondary p-4 rounded-lg mb-grid-gutter">
            <div class="media align-items-center">
              <div class="img-thumbnail rounded-circle position-relative" style="width: 6.375rem;height: 6.375rem;"><img style="width: 6.375rem;height: 5.700rem;" class="rounded-circle" src="img/usuarios/<?php echo $usu->img; ?>"></div>
              <div class="media-body pl-3">
                <h3 class="font-size-base mb-0"><?php echo $usu->usuario; ?></h3><span class="text-accent font-size-sm"><?php echo $usu->email; ?></span>
              </div>
            </div><a class="btn btn-light btn-sm btn-shadow mt-3 mt-sm-0" href="index.php?p=minhaconta"><i class="czi-edit mr-2"></i>Editar perfil</a>
          </div>
          <!-- Shipping address-->
          <h2 class="h6 pt-1 pb-3 mb-3 border-bottom">Detalhes do pedido</h2>
          <div class="row">
            <div class="col-sm-6">
              <div class="form-group">
                <label for="checkout-fn">Nome:</label>
                <h3 class="font-size-base mb-0"><?php echo $usu->usuario; ?></h3>
              </div>
            </div>
            <div class="col-sm-6">
              <div class="form-group">
                <label for="checkout-ln">Telefone:</label>
                <h3 class="font-size-base mb-0"><?php echo $usu->telefone; ?></h3>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-6">
              <div class="form-group">
                <label for="checkout-email">Endereço:</label>
                <h3 class="font-size-base mb-0"><?php echo $usu->endereco." - ".$usu->referencia; ?></h3>
              </div>
            </div>
            <div class="col-sm-6">
              <div class="form-group">
                <label for="checkout-country">Cidade:</label>
                <h3 class="font-size-base mb-0">Camaçari</h3>
              </div>
            </div>
          </div>



      
          <!-- Navigation (desktop)-->
          <div class="d-none d-lg-flex pt-4 mt-3">
            <div class="w-50 pr-3"><a class="btn btn-secondary btn-block" href="index.php?p=carrinho"><i class="czi-arrow-left mt-sm-0 mr-1"></i><span class="d-none d-sm-inline">Voltar ao carrinho</span><span class="d-inline d-sm-none">Voltar</span></a></div>
            <div class="w-50 pl-2"><a class="btn btn-primary btn-block" href="index.php?p=comprar2"><span class="d-none d-sm-inline">Prosseguir a compra</span><span class="d-inline d-sm-none">Próximo</span><i class="czi-arrow-right mt-sm-0 ml-1"></i></a></div>
          </div>
        </section>
        <!-- Sidebar-->
        <aside class="col-lg-4 pt-4 pt-lg-0">
          <div class="cz-sidebar-static rounded-lg box-shadow-lg ml-lg-auto">
            <div class="widget mb-3">
              <h2 class="widget-title text-center">Resumo do pedido</h2>

               <?php
              if(pegacarrinho($usu->id)){
              $pegacarrinho = pegacarrinho($usu->id);
              foreach ($pegacarrinho as $pe) {

                global $subtotal;
              
                if(editprod($pe->produto)){
                  $editprod = editprod($pe->produto);
                    foreach ($editprod as $p) {
      
                    $subtotal += ($p->valor.".".$p->valor2) * $pe->qnt;
          		?>

              <div class="media align-items-center pb-2 border-bottom"><a class="d-block mr-2" href="index.php?p=produto&id=<?php echo $p->id; ?>"><img width="64" src="img/produtos/<?php echo $p->foto1; ?>"/></a>
                <div class="media-body">
                  <h6 class="widget-product-title"><a href="img/produtos/<?php echo $p->foto1; ?>"><?php echo $p->titulo; ?></a></h6>
                  <div class="widget-product-meta"><span class="text-muted mr-2">Tamanho:</span><span class="text-muted"><?php echo $pe->tamanho; ?></span></div>
                  <div class="widget-product-meta"><span class="text-accent mr-2">R$<?php echo $p->valor; ?>,<small><?php echo $p->valor2; ?></small></span><span class="text-muted">x <?php echo $pe->qnt; ?></span></div>
                </div>
              </div>
              

            <?php
                  }
                }
              }

              list($subtotal1, $subtotal2) = explode('.',$subtotal);
              if($cupom != ''){
                 $meucupom = ($cupom / 100) * $subtotal1;
                 list($meucupom1, $meucupom2) = explode('.', $meucupom);
                 if(strlen($meucupom1) === 1){$meucupom1 = $meucupom1."0";}
                 if(strlen($meucupom2) === 1){$meucupom2 = $meucupom2."0";}
              } else {
                $meucupom = 0;
              }
             
            ?>
         </div>

            <ul class="list-unstyled font-size-sm pb-2 border-bottom">
              <li class="d-flex justify-content-between align-items-center"><span class="mr-2">Subtotal:</span><span class="text-right">R$ <?php echo $subtotal1; ?>,<small><?php echo $subtotal2; ?></small></span></li>
              <li class="d-flex justify-content-between align-items-center"><span class="mr-2">Entrega:</span><span class="text-right"><?php if($subtotal1 != '80'){$entrega = 0; echo 'Grátis'; }else{$entrega = 9.99; echo 'R$ 9,<small>99</small>';} ?></span></li>
              <li class="d-flex justify-content-between align-items-center"><span class="mr-2">Desconto:</span><span class="text-right"><?php if($meucupom === 0){echo '-';} else { echo $meucupom1.',<small>'.$meucupom2.'</small>'; } ?></span></li>
            </ul>
            <?php 

            	$total = ($subtotal - $meucupom) + $entrega;
             	list($total1, $total2) = explode('.', $total);

             ?>
            <div class="text-center mb-4">
	            <h2 class="h6 mb-3 pb-1">Total</h2>
	            <h3 class="font-weight-normal text-center my-4">R$ <?php echo $total1; ?>,<small><?php if(strlen($total2) === 1){echo $total2."0";} else { echo $total2; } ?></small></h3>
        	</div>
          </div>
        </aside>
      </div>
      <!-- Navigation (mobile)-->
      <form action="index.php?p=comprar2" method="post">
      <div class="row d-lg-none">
        <div class="col-lg-8">
          <div class="d-flex pt-4 mt-3">
            <div class="w-50 pr-3"><a class="btn btn-secondary btn-block" href="index.php?p=carrinho"><i class="czi-arrow-left mt-sm-0 mr-1"></i><span class="d-none d-sm-inline">Voltar ao carrinho</span><span class="d-inline d-sm-none">Voltar</span></a></div>


            
              <input type="hidden" name="comentario" value="<?php echo $comentario; ?>">
              <input type="hidden" name="cupom" value="<?php echo $cupom; ?>">
              <input type="hidden" name="valor" value="<?php echo $subtotal; ?>">
              <input type="hidden" name="entrega" value="<?php echo $entrega; ?>">
              <input type="hidden" name="total" value="<?php echo $total; ?>">

            <div class="w-50 pl-2"><button type="submit" class="btn btn-primary btn-block"><span class="d-none d-sm-inline">Prosseguir a compra</span><span class="d-inline d-sm-none">Próximo</span><i class="czi-arrow-right mt-sm-0 ml-1"></i></button></div>

           

          </div>
        </div>
      </form>
        <?php
        
        } else{
              
              header('Location: index.php?p=carrinho');

            }

         ?>
      </div>
    </div>