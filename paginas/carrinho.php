<?php

if(isset($_SESSION['logado'])){
  $usu = $_SESSION['logado'];
} else {
  header('Location: index.php');
}
?>
<script src="js/carrinhs.js"></script>
<div class="page-title-overlap bg-dark pt-4">
      <div class="container d-lg-flex justify-content-between py-2 py-lg-3">
        <div class="order-lg-2 mb-3 mb-lg-0 pt-lg-2">
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumb-light flex-lg-nowrap justify-content-center justify-content-lg-start">
              <li class="breadcrumb-item"><a class="text-nowrap" href="index.php"><i class="czi-home"></i>Inicio</a></li>
              <li class="breadcrumb-item text-nowrap active">Carrinho</li>
            </ol>
          </nav>
        </div>
        <div class="order-lg-1 pr-lg-4 text-center text-lg-left">
          <h1 class="h3 text-light mb-0">Meu carrinho</h1>
        </div>
      </div>
    </div>
    <!-- Page Content-->
    <div class="container pb-5 mb-2 mb-md-4">
      <div class="row">
        <!-- List of items-->
        <section class="col-lg-8">
          <div class="d-flex justify-content-between align-items-center pt-3 pb-2 pb-sm-5 mt-1">
            <h2 class="h6 text-light mb-0">Produtos</h2><a class="btn btn-outline-primary btn-sm pl-2" href="index.php"><i class="czi-arrow-left mr-2"></i>Continue comprando</a>
          </div>


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
          <!-- Item-->
          <div class="d-sm-flex justify-content-between align-items-center my-4 pb-3 border-bottom">
            <div class="media media-ie-fix d-block d-sm-flex align-items-center text-center text-sm-left"><a class="d-inline-block mx-auto mr-sm-4" href="index.php?p=produto&id=<?php echo $p->id; ?>" style="width: 10rem;"><img src="img/produtos/<?php echo $p->foto1; ?>"></a>
              <div class="media-body pt-2">
                <h3 class="product-title font-size-base mb-2"><a href="?p=produto&id=<?php echo $p->id; ?>"><?php echo $p->titulo; ?></a></h3>
                <div class="font-size-sm"><span class="text-muted mr-2"><?php echo $p->status; ?></span></div>
                <div class="font-size-sm"><span class="text-muted mr-2">Tamanho: </span><?php echo $pe->tamanho; ?></div>
                <div class="font-size-lg text-accent pt-2">R$<?php echo $p->valor; ?>,<small><?php echo $p->valor2; ?></small></div>
              </div>
            </div>
            <div class="pt-2 pt-sm-0 pl-sm-3 mx-auto mx-sm-0 text-center text-sm-left" style="max-width: 9rem;">
              <div class="form-group mb-0">
                <label class="font-weight-medium">Quantidade:</label>
                <input class="form-control" type="number" disabled="disabled" id="quantidade" style="width: 100px; margin-left: 22px; text-align: center; color: #696969;" value="<?php echo $pe->qnt; ?>">
              </div>
              <button class="btn btn-link px-0 text-danger"  id="removecar" data-id="<?php echo $p->id; ?>" data-usu="<?php echo $usu->id; ?>" type="button"><i class="czi-close-circle mr-2"></i><span class="font-size-sm">Remover</span></button>
            </div>
          </div>
         <!-- FIM Item -->

         <?php
                  }
                }
              }

              list($subtotal1, $subtotal2) = explode('.',$subtotal);

            ?>
          
        </section>
        <!-- Sidebar-->
        <aside class="col-lg-4 pt-4 pt-lg-0">
          <div class="cz-sidebar-static rounded-lg box-shadow-lg ml-lg-auto">
            <div class="text-center mb-4 pb-3 border-bottom">
              <h2 class="h6 mb-3 pb-1">Subtotal</h2>
              <h3 class="font-weight-normal">R$ <?php echo $subtotal1; ?>,<small><?php echo $subtotal2; ?></small></h3>
            </div>

              <div class="form-group mb-4">
                <form action="index.php?p=comprar1" method="post">
                <label class="mb-3" for="order-comments"><span class="badge badge-info font-size-xs mr-2">Nota</span><span class="font-weight-medium">Comentários adicionais</span></label>
                <textarea class="form-control" rows="6" id="order-comments" name="comentario"></textarea>
              </div>
              <div class="accordion" id="order-options">
                <div class="card">
                  <div class="card-header">
                    <h3 class="accordion-heading"><a href="#promo-code" role="button" data-toggle="collapse" aria-expanded="true" aria-controls="promo-code">Aplicar cupom de desconto<span class="accordion-indicator"></span></a></h3>
                  </div>
                  <div class="collapse show" id="promo-code" data-parent="#order-options">
                      
                      <div class="form-group">
                        <div class="card-body needs-validation">
                          <div class="aviso3"></div>
                        <input class="form-control" id="cupom" type="text" placeholder="Insira seu cupom" name="cupom">
                        <input type="hidden" id="subtotal" value="<?php echo $subtotal1; ?>">
                        <input type="hidden" name="valorcupom" id="valorcupom">
                      </div>
                    </div>
                      <div class="btn btn-outline-primary btn-block" id="appcupom">Aplicar cupom promocional</div>
          
                  </div>
                </div>
            
            </div><button type="submit" class="btn btn-primary btn-shadow btn-block mt-4" ><i class="czi-card font-size-lg mr-2"></i>Continuar a compra</a>
            </form>
          </div>
        </aside>

        <?php
        
        } else{
              ?>
            <div class="d-sm-flex justify-content-between align-items-center my-4 pb-3 border-bottom">
                <div class="media media-ie-fix d-block d-sm-flex align-items-center text-center text-sm-left">
              <br /><br />
                <h2 class="h6 mb-3 pb-1">Infelizmente você não tem nenhum item em seu carrinho.</h2>
              </div>
            </div>

              <?php

            }

         ?>
      </div>
    </div>