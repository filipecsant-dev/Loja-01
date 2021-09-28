<?php

if(isset($_SESSION['logado'])){
  $usu = $_SESSION['logado'];
} else {
  header('Location: index.php');
}
?>
<div class="page-title-overlap bg-dark pt-4">
      <div class="container d-lg-flex justify-content-between py-2 py-lg-3">
        <div class="order-lg-2 mb-3 mb-lg-0 pt-lg-2">
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumb-light flex-lg-nowrap justify-content-center justify-content-lg-start">
              <li class="breadcrumb-item"><a class="text-nowrap" href="index.php"><i class="czi-home"></i>Inicio</a></li>
              <li class="breadcrumb-item text-nowrap active">Desejos</li>
            </ol>
          </nav>
        </div>
        <div class="order-lg-1 pr-lg-4 text-center text-lg-left">
          <h1 class="h3 text-light mb-0">Meus desejos</h1>
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
            if(pegadesejo($usu->id)){
              $pegadesejo = pegadesejo($usu->id);
              foreach ($pegadesejo as $pe) {
              
                if(editprod($pe->produto)){
                  $editprod = editprod($pe->produto);
                    foreach ($editprod as $p) {
      
                    
          ?>
          <!-- Item-->
          <div class="d-sm-flex justify-content-between align-items-center my-4 pb-3 border-bottom">
            <div class="media media-ie-fix d-block d-sm-flex align-items-center text-center text-sm-left"><a class="d-inline-block mx-auto mr-sm-4" href="?p=produto&id=<?php echo $p->id; ?>" style="width: 10rem;"><img src="img/produtos/<?php echo $p->foto1; ?>"></a>
              <div class="media-body pt-2">
                <h3 class="product-title font-size-base mb-2"><a href="?p=produto&id=<?php echo $p->id; ?>"><?php echo $p->titulo; ?></a></h3>
                <div class="font-size-sm"><span class="text-muted mr-2"><?php echo $p->status; ?></span></div>
                <div class="font-size-lg text-accent pt-2">R$<?php echo $p->valor; ?>,<small><?php echo $p->valor2; ?></small></div>
              </div>
            </div>
            <div class="pt-2 pt-sm-0 pl-sm-3 mx-auto mx-sm-0 text-center text-sm-left" style="max-width: 9rem;">
            
              <button class="btn btn-link px-0 text-danger"  id="desejo" data-id="<?php echo $p->id; ?>" data-usu="<?php echo $usu->id; ?>" type="button"><i class="czi-close-circle mr-2"></i><span class="font-size-sm">Remover</span></button>
            </div>
          </div>
         <!-- FIM Item -->

         <?php
                  }
                }
              }

            } else{
              ?>
            <div class="d-sm-flex justify-content-between align-items-center my-4 pb-3 border-bottom">
                <div class="media media-ie-fix d-block d-sm-flex align-items-center text-center text-sm-left">
              <br /><br />
                <h2 class="h6 mb-3 pb-1">Infelizmente você não tem nenhum item em seus desejos.</h2>
              </div>
            </div>

              <?php

            }

         ?>
          
        </section>
        <!-- Sidebar-->
      </div>
    </div>