<?php

if(isset($_GET['id'])){

  $id = $_GET['id'];

} else {
  header('Location: index.php');
}

if(editprod($id)){
  $edit = editprod($id);
  foreach ($edit as $p) {

     $tamanhos = $p->tamanho1+$p->tamanho2+$p->tamanho3+$p->tamanhounico;
     $totalavaliacao = (qntavaliacao2($id,'5')+qntavaliacao2($id,'4')+qntavaliacao2($id,'3')+qntavaliacao2($id,'2') * 100)/(0.220*10);
     $avaliacaototal = number_format($totalavaliacao, 1, '.', '');

     if(isset($_SESSION['logado']))
     { 
        if(verifcarrinho($p->id,$_SESSION['logado']->id))
        {
          $jaaddcarrinho = true;
        }else{
          $jaaddcarrinho = false;
        } 
      } else {
          $jaaddcarrinho = false;
      }
?>

<script src="js/prodt.js"></script>
<script src="https://cartzilla.createx.studio/vendor/lightgallery.js/dist/js/lightgallery.min.js"></script>
<div class="page-title-overlap bg-dark pt-4">
      <div class="container d-lg-flex justify-content-between py-2 py-lg-3">
        <div class="order-lg-2 mb-3 mb-lg-0 pt-lg-2">
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumb-light flex-lg-nowrap justify-content-center justify-content-lg-start">
              <li class="breadcrumb-item"><a class="text-nowrap" href="index.php"><i class="czi-home"></i>Inicio</a></li>
              <li class="breadcrumb-item text-nowrap active" aria-current="page"><?php echo $p->categoria; ?></li>
            </ol>
          </nav>
        </div>
        <div class="order-lg-1 pr-lg-4 text-center text-lg-left">
          <h1 class="h3 text-light mb-0"><?php echo $p->titulo; ?></h1>
        </div>
      </div>
    </div>
    <!-- Page Content-->
    <div class="container">
      <!-- Gallery + details-->
      <div class="bg-light box-shadow-lg rounded-lg px-4 py-3 mb-5">
        <div class="px-lg-3">
          <div class="row">
            <!-- Product gallery-->
            <div class="col-lg-7 pr-lg-0 pt-lg-4">
              <div class="cz-product-gallery">
                <!-- Imagens -->
                <div class="cz-preview order-sm-2">

                  <div class="cz-preview-item active" id="first"><img class="cz-image-zoom" src="<?php echo "img/produtos/".$p->foto1; ?>" data-zoom="<?php echo "img/produtos/".$p->foto1; ?>">
                    <div class="cz-image-zoom-pane"></div>
                  </div>

                  <?php if($p->foto2 != ''){ ?>

                  <div class="cz-preview-item" id="second"><img class="cz-image-zoom" src="<?php echo "img/produtos/".$p->foto2; ?>" data-zoom="<?php echo "img/produtos/".$p->foto2; ?>">
                    <div class="cz-image-zoom-pane"></div>
                  </div>

                <?php } if($p->foto3 != ''){ ?>

                  <div class="cz-preview-item" id="third"><img class="cz-image-zoom" src="<?php echo "img/produtos/".$p->foto3; ?>" data-zoom="<?php echo "img/produtos/".$p->foto3; ?>">
                    <div class="cz-image-zoom-pane"></div>
                  </div>

                <?php } ?>

                </div>

                <!-- Imagem baixo -->
                <div class="cz-thumblist order-sm-1">

                  <a class="cz-thumblist-item active" href="#first"><img src="<?php echo "img/produtos/".$p->foto1; ?>"></a>

                  <?php if($p->foto2 != ''){ ?>

                  <a class="cz-thumblist-item" href="#second"><img src="<?php echo "img/produtos/".$p->foto2; ?>"></a>

                  <?php } if($p->foto3 != ''){ ?>

                  <a class="cz-thumblist-item" href="#third"><img src="<?php echo "img/produtos/".$p->foto3; ?>"></a>

                  <?php }  ?>

                  <!-- VIDEO> <a class="cz-thumblist-item video-item" href="https://www.youtube.com/watch?v=1vrXpMLLK14">
                    <div class="cz-thumblist-item-text"><i class="czi-video"></i>Video</div></a></div> -->
              </div>
            </div>

            <!-- Product details-->
            
            <div class="col-lg-5 pt-4 pt-lg-0">
              <div class="product-details ml-auto pb-3">
                <div class="d-flex justify-content-between align-items-center mb-2"><a href="#reviews" data-scroll>
                    <div class="star-rating">
                      <i class="<?php if($avaliacaototal >= '1'){echo 'sr-star czi-star-filled active';}else{echo 'sr-star czi-star';}?>"></i>
                      <i class="<?php if($avaliacaototal >= '2'){echo 'sr-star czi-star-filled active';}else{echo 'sr-star czi-star';}?>"></i>
                      <i class="<?php if($avaliacaototal >= '3'){echo 'sr-star czi-star-filled active';}else{echo 'sr-star czi-star';}?>"></i>
                      <i class="<?php if($avaliacaototal >= '4'){echo 'sr-star czi-star-filled active';}else{echo 'sr-star czi-star';}?>"></i>
                      <i class="<?php if($avaliacaototal >= '5'){echo 'sr-star czi-star-filled active';}else{echo 'sr-star czi-star';}?>"></i>
                    </div><span class="d-inline-block font-size-sm text-body align-middle mt-1 ml-1"><?php echo qntavaliacao($id); ?> Avaliações</span></a>

                  <button class="btn-wishlist mr-0 mr-lg-n3" id="desejo" data-id="<?php echo $p->id; ?>" data-usu="<?php echo $_SESSION['logado']->id; ?>" type="button" data-toggle="tooltip" <?php if(!isset($_SESSION['logado'])){ echo 'onclick="fazerlog();"';}?>><i class="czi-heart" <?php if(isset($_SESSION['logado'])){ if(verifdesejo($p->id, $_SESSION['logado']->id)){ echo 'style="color:#fe696a"';} } ?>></i></button>

                </div>
                <div class="mb-3"><span class="h3 font-weight-normal text-accent mr-1">R$<?php echo $p->valor; ?>,<small><?php echo $p->valor2; ?></small></span>

                <label class="font-weight-medium" > &nbsp;&nbsp;<?php if($tamanhos == '0' || $p->status === 'Indisponivel'){ echo 'Indisponivel'; }else{echo $tamanhos." unidades disponivel.";  } ?></label>

                  <!-- PROMOÇÂO
                  <del class="text-muted font-size-lg mr-3">$25.<small>00</small></del><span class="badge badge-danger badge-shadow align-middle mt-n2">Sale</span>
                -->

                </div>

                <!-- CORES
                <div class="font-size-sm mb-4">
                  <span class="text-heading font-weight-medium mr-1">Cores:</span><span class="text-muted" id="colorOption">Red/Dark blue/White</span></div>
                <div class="position-relative mr-n4 mb-3">
                  <div class="custom-control custom-option custom-control-inline mb-2">
                    <input class="custom-control-input" type="radio" name="color" id="color1" data-label="colorOption" value="Red/Dark blue/White" checked>
                    <label class="custom-option-label rounded-circle" for="color1"><span class="custom-option-color rounded-circle" style="background-image: url(img/shop/single/color-opt-1.png)"></span></label>
                  </div>
                  <div class="custom-control custom-option custom-control-inline mb-2">
                    <input class="custom-control-input" type="radio" name="color" id="color2" data-label="colorOption" value="Beige/White/Dark grey">
                    <label class="custom-option-label rounded-circle" for="color2"><span class="custom-option-color rounded-circle" style="background-image: url(img/shop/single/color-opt-2.png)"></span></label>
                  </div>
                  <div class="custom-control custom-option custom-control-inline mb-2">
                    <input class="custom-control-input" type="radio" name="color" id="color3" data-label="colorOption" value="Dark grey/White/Orange">
                    <label class="custom-option-label rounded-circle" for="color3"><span class="custom-option-color rounded-circle" style="background-image: url(img/shop/single/color-opt-3.png)"></span></label>
                  </div>
                  <div class="product-badge product-available mt-n1"><i class="czi-security-check"></i>Product available</div>
                </div>
              -->
                <form class="mb-grid-gutter" method="post" action="" name="addcarrinho">
                    <div class="aviso4"></div>
                    <div class="d-flex justify-content-between align-items-center pb-1">
                      <label class="font-weight-medium">Tamanho:</label>
                    </div>
                    <select class="custom-select" required id="tamanho-prod" name="tamanho" data-id="<?php echo $p->id; ?>" <?php if($tamanhos == '0'){ echo 'disabled="disabled"'; } if($p->status === 'Indisponivel'){ echo 'disabled="disabled"';} if($jaaddcarrinho === true){ echo 'disabled="disabled"';} ?>>
                      <option value="" selected>Selecione o tamanho</option>
                      <?php if($p->tamanho1 >= '1'){ ?>
                      <option value="P">P</option>
                      <?php } if($p->tamanho2 >= '1'){ ?>
                      <option value="M">M</option>
                      <?php } if($p->tamanho3 >= '1'){ ?>
                      <option value="G">G</option>
                      <?php } if($p->tamanhounico >= '1'){ ?>
                      <option value="Unico">Unico</option>
                      <?php } ?>
                    </select>
                  </div>
                  <div class="form-group d-flex align-items-center">
                    <select class="custom-select mr-3" style="width: 5rem;" id="qntp" name="qnt" disabled="disabled" required>
    
                    </select>
                    <input type="hidden" name="id" value="<?php echo $p->id; ?>">
                    <input type="hidden" name="usuario" value="<?php echo $_SESSION['logado']->id; ?>">
                    <button class="btn btn-primary btn-shadow btn-block" type="submit" <?php if(!isset($_SESSION['logado'])){ echo 'onclick="fazerlog();"';}      if($tamanhos == '0'){ echo 'disabled="disabled"'; } if($p->status === 'Indisponivel'){ echo 'disabled="disabled"';} ?>><i class="czi-cart font-size-lg mr-2"></i><?php if($jaaddcarrinho === true){echo 'Remover do carrinho';}else{echo 'Adicionar ao carrinho';} ?></button>

                  </div>
                </form>
                
                <!-- Product panels-->
                <div class="accordion mb-4" id="productPanels">
                  <div class="card">
                    <div class="card-header">
                      <h3 class="accordion-heading"><a href="#productInfo" role="button" data-toggle="collapse" aria-expanded="true" aria-controls="productInfo"><i class="czi-announcement text-muted font-size-lg align-middle mt-n1 mr-2"></i>Informações do produto<span class="accordion-indicator"></span></a></h3>
                    </div>
                    <div class="collapse show" id="productInfo" data-parent="#productPanels">
                      <div class="card-body">
                        <h6 class="font-size-sm mb-2">Composição:</h6>
                        <ul class="font-size-sm pl-4">
                          <li><?php echo $p->compo1; ?></li>
                          <?php if($p->compo2 != ''){ ?>
                          <li><?php echo $p->compo2; ?></li>
                        <?php } if($p->compo3 != ''){ ?>
                          <li><?php echo $p->compo3; ?></li>
                          <?php } ?>
                        </ul>
                      </div>
                    </div>
                  </div>
                  <div class="card">
                    <div class="card-header">
                      <h3 class="accordion-heading"><a class="collapsed" href="#shippingOptions" role="button" data-toggle="collapse" aria-expanded="true" aria-controls="shippingOptions"><i class="czi-delivery text-muted lead align-middle mt-n1 mr-2"></i>Opções de entrega<span class="accordion-indicator"></span></a></h3>
                    </div>
                    <div class="collapse" id="shippingOptions" data-parent="#productPanels">
                      <div class="card-body font-size-sm">
                        <div class="d-flex justify-content-between border-bottom pb-2">
                          <div>
                            <div class="font-weight-semibold text-dark">Acima de R$ 80,00 (Camaçari)</div>
                            <div class="font-size-sm text-muted">1 - 2 dia(s) para entrega</div>
                          </div>
                          <div>Grátis</div>
                        </div>
                        <div class="d-flex justify-content-between border-bottom py-2">
                          <div>
                            <div class="font-weight-semibold text-dark">Abaixo de R$ 80,00 (camaçari)</div>
                            <div class="font-size-sm text-muted">1 - 2 dia(s) para entrega</div>
                          </div>
                          <div>R$ 9,<small>99</small></div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <!-- LOCAL
                  <div class="card">
                    <div class="card-header">
                      <h3 class="accordion-heading"><a class="collapsed" href="#localStore" role="button" data-toggle="collapse" aria-expanded="true" aria-controls="localStore"><i class="czi-location text-muted font-size-lg align-middle mt-n1 mr-2"></i>Find in local store<span class="accordion-indicator"></span></a></h3>
                    </div>
                    <div class="collapse" id="localStore" data-parent="#productPanels">
                      <div class="card-body">
                        <select class="custom-select">
                          <option value>Select your country</option>
                          <option value="Argentina">Argentina</option>
                          <option value="Belgium">Belgium</option>
                          <option value="France">France</option>
                          <option value="Germany">Germany</option>
                          <option value="Spain">Spain</option>
                          <option value="UK">United Kingdom</option>
                          <option value="USA">USA</option>
                        </select>
                      </div>
                    </div>
                  </div>
                  -->
                </div>

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
      <!-- Product description section 1-->

        <div class="col-lg-4 col-md-6 offset-lg-1 py-4 order-md-1">
          <h2 class="h3 mb-4 pb-2">Descrissão do produto</h2>
          <h6 class="font-size-base mb-3"><?php echo $p->descrissao; ?></h6>
          <!-- <p class="font-size-sm text-muted pb-2">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Duis aute irure dolor in reprehenderit.</p> -->
      

        </div>
    
    
    </div>
  
    <!-- Reviews-->
    <div class="border-top border-bottom my-lg-3 py-5">
      <div class="container pt-md-2" id="reviews">
        <div class="row pb-3">
          <div class="col-lg-4 col-md-5">
            <h2 class="h3 mb-4"><?php echo qntavaliacao($id);  ?> Avaliações</h2>
            <div class="star-rating mr-2">

              <i class="<?php if($avaliacaototal >= '1'){echo 'czi-star-filled font-size-sm text-accent mr-1';}else{ echo 'czi-star font-size-sm text-muted mr-1'; } ?>"></i>
              <i class="<?php if($avaliacaototal >= '2'){echo 'czi-star-filled font-size-sm text-accent mr-1';}else{ echo 'czi-star font-size-sm text-muted mr-1'; } ?>"></i>
              <i class="<?php if($avaliacaototal >= '3'){echo 'czi-star-filled font-size-sm text-accent mr-1';}else{ echo 'czi-star font-size-sm text-muted mr-1'; } ?>"></i>
              <i class="<?php if($avaliacaototal >= '4'){echo 'czi-star-filled font-size-sm text-accent mr-1';}else{ echo 'czi-star font-size-sm text-muted mr-1'; } ?>"></i>
              <i class="<?php if($avaliacaototal == '5'){echo 'czi-star-filled font-size-sm text-accent mr-1';}else{ echo 'czi-star font-size-sm text-muted mr-1'; } ?>"></i>

            </div><span class="d-inline-block align-middle"><?php echo $avaliacaototal;  ?> Avaliação geral</span>
            <?php if($avaliacaototal >= '2'){ ?>
            <p class="pt-3 font-size-sm text-muted">Os clientes recomendaram este produto.</p>
            <?php } else {
             ?>
             <br /><br />
             <?php
            } ?>
          </div>
          <div class="col-lg-8 col-md-7">
            <div class="d-flex align-items-center mb-2">
              <div class="text-nowrap mr-3"><span class="d-inline-block align-middle text-muted">5</span><i class="czi-star-filled font-size-xs ml-1"></i></div>
              <div class="w-100">
                <div class="progress" style="height: 4px;">
                  <div class="progress-bar bg-success" role="progressbar" style="width: <?php echo (qntavaliacao2($id,'5') * 100) / qntavaliacao($id); ?>%;" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
              </div><span class="text-muted ml-3"><?php echo qntavaliacao2($id,'5'); ?></span>
            </div>
            <div class="d-flex align-items-center mb-2">
              <div class="text-nowrap mr-3"><span class="d-inline-block align-middle text-muted">4</span><i class="czi-star-filled font-size-xs ml-1"></i></div>
              <div class="w-100">
                <div class="progress" style="height: 4px;">
                  <div class="progress-bar" role="progressbar" style="width: <?php echo (qntavaliacao2($id,'4') * 100) / qntavaliacao($id); ?>%; background-color: #a7e453;" aria-valuenow="27" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
              </div><span class="text-muted ml-3"><?php echo qntavaliacao2($id,'4'); ?></span>
            </div>
            <div class="d-flex align-items-center mb-2">
              <div class="text-nowrap mr-3"><span class="d-inline-block align-middle text-muted">3</span><i class="czi-star-filled font-size-xs ml-1"></i></div>
              <div class="w-100">
                <div class="progress" style="height: 4px;">
                  <div class="progress-bar" role="progressbar" style="width: <?php echo (qntavaliacao2($id,'3') * 100) / qntavaliacao($id); ?>%; background-color: #ffda75;" aria-valuenow="17" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
              </div><span class="text-muted ml-3"><?php echo qntavaliacao2($id,'3'); ?></span>
            </div>
            <div class="d-flex align-items-center mb-2">
              <div class="text-nowrap mr-3"><span class="d-inline-block align-middle text-muted">2</span><i class="czi-star-filled font-size-xs ml-1"></i></div>
              <div class="w-100">
                <div class="progress" style="height: 4px;">
                  <div class="progress-bar" role="progressbar" style="width: <?php echo (qntavaliacao2($id,'2') * 100) / qntavaliacao($id); ?>%; background-color: #fea569;" aria-valuenow="9" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
              </div><span class="text-muted ml-3"><?php echo qntavaliacao2($id,'2'); ?></span>
            </div>
            <div class="d-flex align-items-center">
              <div class="text-nowrap mr-3"><span class="d-inline-block align-middle text-muted">1</span><i class="czi-star-filled font-size-xs ml-1"></i></div>
              <div class="w-100">
                <div class="progress" style="height: 4px;">
                  <div class="progress-bar bg-danger" role="progressbar" style="width: <?php echo (qntavaliacao2($id,'1') * 100) / qntavaliacao($id); ?>%;" aria-valuenow="4" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
              </div><span class="text-muted ml-3"><?php echo qntavaliacao2($id,'1'); ?></span>
            </div>
          </div>
        </div>
        <hr class="mt-4 pb-4 mb-3">
        <div class="row">
          <!-- Reviews list-->
          <div class="col-md-7">
            <?php
            if(avaliacao($id)){
              $avaliacao = avaliacao($id);
              foreach ($avaliacao as $ava) {

            ?>

            <!-- Review-->
            <div class="product-review pb-4 mb-4 border-bottom">
              <div class="d-flex mb-3">
                <div class="media media-ie-fix align-items-center mr-4 pr-2"><img class="rounded-circle" width="50" src="img/usuarios/<?php echo $ava->img; ?>"/>
                  <div class="media-body pl-3">
                    <h6 class="font-size-sm mb-0"><?php echo $ava->nome; ?></h6><span class="font-size-ms text-muted"><?php echo $ava->data; ?></span>
                  </div>
                </div>
                
              </div>
              <p class="font-size-md mb-2"><?php echo $ava->comentario; ?></p>
            
            </div>

            <?php
              }
             }
             ?>
  <!--
            <div class="text-center">
              <button class="btn btn-outline-accent" type="button"><i class="czi-reload mr-2"></i>Load more reviews</button>
            </div>
          </div>
        -->
          <!-- Leave review form-->
          <div class="col-md-5 mt-2 pt-4 mt-md-0 pt-md-0">
            <div class="bg-secondary py-grid-gutter px-grid-gutter rounded-lg">
              <h3 class="h4 pb-2">Escrever um comentário</h3>
              <div class="aviso3"></div>
              <form class="needs-validation" name="form_comentario" action="" method="post" novalidate>
                <div class="form-group">
                  
                  <label for="review-rating">Avaliação<span class="text-danger">*</span></label>
                  <select name="star" class="custom-select" required id="review-rating" <?php if(!isset($_SESSION['logado'])){echo 'disabled="disabled"';} ?>>
                    <option value="">Escolhe a classificação</option>
                    <option value="5">5 Estrelas</option>
                    <option value="4">4 Estrelas</option>
                    <option value="3">3 Estrelas</option>
                    <option value="2">2 Estrelas</option>
                    <option value="1">1 Estrelas</option>
                  </select>
                  <div class="invalid-feedback">Escolhe uma classificação</div>
                </div>
                <div class="form-group">
                  <label for="review-text">Comentário<span class="text-danger">*</span></label>
                  <textarea name="comentario" class="form-control" rows="6" required id="review-text" <?php if(!isset($_SESSION['logado'])){echo 'disabled="disabled"';} ?>></textarea>
                  <div class="invalid-feedback">Por favor, escreva um comentário!</div>
                </div>

                <input type="hidden" name="produto" value="<?php echo $p->id; ?>">
                <input type="hidden" name="nome" value="<?php echo $_SESSION['logado']->usuario; ?>">
                <input type="hidden" name="img" value="<?php echo $_SESSION['logado']->img; ?>">
                <input type="hidden" name="data" value="<?php setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese'); date_default_timezone_set('America/Sao_Paulo');
echo strftime('%d de %B de %Y', strtotime('today')); ?>">

                <button class="btn btn-primary btn-shadow btn-block" type="submit" <?php if(!isset($_SESSION['logado'])){echo 'disabled="disabled"';} ?>>Enviar comentário</button>

                <label for="review-rating"><?php if(!isset($_SESSION['logado'])){echo '&nbsp;Faça o login para poder fazer um comentario.';} ?></label>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>


<?php
    }
}
?>