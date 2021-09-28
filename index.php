<?php
ob_start(); session_start();
require 'funcoes/banco/conexao.php';
require 'funcoes/crud/crud.php';
require 'funcoes/login/login.php';
logado();

if (isset($_GET['logout']) && $_GET['logout'] == 'true') {
    session_destroy();
    header("Location: index.php");
}


?>

<!DOCTYPE html>
<html lang="pt-BR">
    <head>
      <script src="js/jquery-3.5.0.js"></script>

    <meta charset="utf-8">
    <title>Ph Store</title>
    <!-- SEO Meta Tags-->
    <meta name="description" content="PhSotre - Roupas infatis e adulto">
    <meta name="author" content="NestWeb - nestweb.com.br">
    <!-- Viewport-->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Favicon and Touch Icons-->
    <link rel="apple-touch-icon" sizes="180x180" href="apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="favicon-16x16.png">
    <link rel="mask-icon" color="#fe6a6a" href="https://cartzilla.createx.studio/safari-pinned-tab.svg">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="theme-color" content="#ffffff">
    <!-- Vendor Styles including: Font Icons, Plugins, etc.-->
    <link rel="stylesheet" media="screen" href="https://cartzilla.createx.studio/vendor/simplebar/dist/simplebar.min.css"/>
    <link rel="stylesheet" media="screen" href="https://cartzilla.createx.studio/vendor/tiny-slider/dist/tiny-slider.css"/>
    <link rel="stylesheet" media="screen" href="https://cartzilla.createx.studio/vendor/drift-zoom/dist/drift-basic.min.css"/>
    <!-- Main Theme Styles + Bootstrap-->
    <link rel="stylesheet" media="screen" href="https://cartzilla.createx.studio/css/theme.min.css">
    <!-- Google Tag Manager-->
    <script>
      (function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
      new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
      j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
      'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
      })(window,document,'script','dataLayer','GTM-WKV3GT5');
    </script>



  </head>
  <!-- Body-->
  <body class="toolbar-enabled">

    <script src="js/paginicio.js"></script>

    <!-- Google Tag Manager (noscript)-->
    <noscript>
      <iframe src="//www.googletagmanager.com/ns.html?id=GTM-WKV3GT5" height="0" width="0" style="display: none; visibility: hidden;"></iframe>
    </noscript>
    <!-- Sign in / sign up modal-->

    <div class="modal fade" id="ExemploModalCentralizado" tabindex="-1" role="dialog" aria-labelledby="TituloModalCentralizado" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="TituloModalCentralizado"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body"></div>
            </div>
          </div>
        </div>

    <div class="modal fade" id="signin-modal" tabindex="-1" role="dialog">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <ul class="nav nav-tabs card-header-tabs" role="tablist">
              <?php if(logado() === false){ ?>
              <li class="nav-item"><a class="nav-link active" href="#signin-tab" data-bs-toggle="tab" role="tab" aria-selected="true"><i class="ci-unlocked me-2 mt-n1"></i>Fazer login</a></li>
              <li class="nav-item"><a class="nav-link" href="#signup-tab" data-bs-toggle="tab" role="tab" aria-selected="false"><i class="ci-user me-2 mt-n1"></i>Registrar-se</a></li>
            <?php } ?>
            </ul>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          </div>
          <div class="modal-body tab-content py-4">
            <div class="aviso"></div>
            <?php if(logado() === false){ ?>
            <form class="needs-validation tab-pane fade show active" autocomplete="off" novalidate id="signin-tab"  action="" name="login" method="post">
              <div class="form-group">
                <label for="si-email">Email:</label>
                <input class="form-control" type="email" name="email" id="si-email" placeholder="phstore@example.com" required >
                <div class="invalid-feedback">Por favor informe um e-mail válido!</div>
              </div>
              <div class="form-group">
                <label for="si-password">Senha</label>
                <div class="password-toggle">
                  <input class="form-control" name="senha" type="password" id="si-password" required >
                  <label class="password-toggle-btn">
                    <input class="custom-control-input" type="checkbox"><i class="ci-eye password-toggle-indicator"></i><span class="sr-only">Exibir senha</span>
                  </label>
                </div>
              </div>
              <div class="form-group d-flex flex-wrap justify-content-between">
                <div class="custom-control custom-checkbox mb-2">
                </div><a class="font-size-sm" href="#">Esqueceu sua senha?</a>
              </div>
              <button class="btn btn-primary btn-block btn-shadow" type="submit">Entrar</button>
            </form>
            <form class="needs-validation tab-pane fade" autocomplete="off" novalidate id="signup-tab" action="" name="registrar" method="post">
              <div class="form-group">
                <label for="su-name">Nome completo:</label>
                <input class="form-control" type="text" name="nome" placeholder="Ex: Pedro Henrique Sobrenome.." required>
                <div class="invalid-feedback">Por favor informe seu nome completo</div>
              </div>
              <div class="form-group">
                <label for="su-email">Email:</label>
                <input class="form-control" type="email" name="email" placeholder="phstore@example.com" required >
                <div class="invalid-feedback">Por favor informe um e-mail válido</div>
              </div>
              <div class="form-group">
                <label for="su-password">Senha:</label>
                <div class="password-toggle">
                  <input class="form-control" name="senha" type="password" required >
                  <label class="password-toggle-btn">
                    <input class="custom-control-input" type="checkbox"><i class="ci-eye password-toggle-indicator"></i><span class="sr-only">Exibir senha</span>
                  </label>
                </div>
              </div>
              <div class="form-group">
                <label for="su-name">Celular:</label>
                <input class="form-control" type="number" name="telefone" placeholder="Ex: 71 98888-8888" required >
                <div class="invalid-feedback">Por favor informe o número para contato</div>
              </div>
              <div class="form-group">
                <label for="su-name">Endereço</label>
                <input class="form-control" type="text" name="endereco" placeholder="Ex: Rua do canal, nº 00, Bairro, Camaçari" required >
                <div class="invalid-feedback">Por favor informe seu endereço</div>
              </div>
              <div class="form-group">
                <label for="su-name">Ponto de Referência</label>
                <input class="form-control" type="text" name="referencia"  placeholder="Ex: Perto ao mercado camaçari" required >
                <div class="invalid-feedback">Por favor informe um ponto de referência</div>
              </div>
              
              <button class="btn btn-primary btn-block btn-shadow" type="submit">Registrar</button>
            </form>
        <?php } ?>
          </div>
        
        </div>
      </div>
    </div>
  
    <!-- Navbar-->
    <!-- Quick View Modal-->
    <div class="modal-quick-view modal fade" id="quick-view" tabindex="-1">
      <div class="modal-dialog modal-xl">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title product-title"><a href="shop-single-v1.html" data-bs-toggle="tooltip" data-placement="right" title="Go to product page">Sports Hooded Sweatshirt<i class="ci-arrow-right font-size-lg ms-2"></i></a></h4>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          </div>
          <div class="modal-body">
            <div class="row">
              <!-- Product gallery-->
              <div class="col-lg-7 pr-lg-0">
                <div class="cz-product-gallery">
                  <div class="cz-preview order-sm-2">
                    <div class="cz-preview-item active" id="first"><img class="cz-image-zoom" src="https://cartzilla.createx.studio/img/shop/single/gallery/01.jpg" data-zoom="https://cartzilla.createx.studio/img/shop/single/gallery/01.jpg" alt="Product image">
                      <div class="cz-image-zoom-pane"></div>
                    </div>
                    <div class="cz-preview-item" id="second"><img class="cz-image-zoom" src="https://cartzilla.createx.studio/img/shop/single/gallery/02.jpg" data-zoom="https://cartzilla.createx.studio/img/shop/single/gallery/02.jpg" alt="Product image">
                      <div class="cz-image-zoom-pane"></div>
                    </div>
                    <div class="cz-preview-item" id="third"><img class="cz-image-zoom" src="https://cartzilla.createx.studio/img/shop/single/gallery/03.jpg" data-zoom="https://cartzilla.createx.studio/img/shop/single/gallery/03.jpg" alt="Product image">
                      <div class="cz-image-zoom-pane"></div>
                    </div>
                    <div class="cz-preview-item" id="fourth"><img class="cz-image-zoom" src="https://cartzilla.createx.studio/img/shop/single/gallery/04.jpg" data-zoom="https://cartzilla.createx.studio/img/shop/single/gallery/04.jpg" alt="Product image">
                      <div class="cz-image-zoom-pane"></div>
                    </div>
                  </div>
                  <div class="cz-thumblist order-sm-1"><a class="cz-thumblist-item active" href="#first"><img src="https://cartzilla.createx.studio/img/shop/single/gallery/th01.jpg" alt="Product thumb"></a><a class="cz-thumblist-item" href="#second"><img src="https://cartzilla.createx.studio/img/shop/single/gallery/th02.jpg" alt="Product thumb"></a><a class="cz-thumblist-item" href="#third"><img src="https://cartzilla.createx.studio/img/shop/single/gallery/th03.jpg" alt="Product thumb"></a><a class="cz-thumblist-item" href="#fourth"><img src="https://cartzilla.createx.studio/img/shop/single/gallery/th04.jpg" alt="Product thumb"></a></div>
                </div>
              </div>
              <!-- Product details-->
              <div class="col-lg-5 pt-4 pt-lg-0 cz-image-zoom-pane">
                <div class="product-details ms-auto pb-3">
                  <div class="d-flex justify-content-between align-items-center mb-2"><a href="shop-single-v1.html#reviews">
                      <div class="star-rating"><i class="sr-star ci-star-filled active"></i><i class="sr-star ci-star-filled active"></i><i class="sr-star ci-star-filled active"></i><i class="sr-star ci-star-filled active"></i><i class="sr-star ci-star"></i>
                      </div><span class="d-inline-block font-size-sm text-body align-middle mt-1 ms-1">74 Reviews</span></a>
                    <button class="btn-wishlist" type="button" data-bs-toggle="tooltip" title="Add to wishlist"><i class="ci-heart"></i></button>
                  </div>
                  <div class="mb-3"><span class="h3 font-weight-normal text-accent me-1">$18.<small>99</small></span>
                    <del class="text-muted font-size-lg me-3">$25.<small>00</small></del><span class="badge badge-danger badge-shadow align-middle mt-n2">Sale</span>
                  </div>
                  <div class="font-size-sm mb-4"><span class="text-heading font-weight-medium me-1">Color:</span><span class="text-muted">Red/Dark blue/White</span></div>
                  <div class="position-relative me-n4 mb-3">
                    <div class="custom-control custom-option custom-control-inline mb-2">
                      <input class="custom-control-input" type="radio" name="color" id="color1" checked>
                      <label class="custom-option-label rounded-circle" for="color1"><span class="custom-option-color rounded-circle" style="background-image: url(img/shop/single/color-opt-1.png)"></span></label>
                    </div>
                    <div class="custom-control custom-option custom-control-inline mb-2">
                      <input class="custom-control-input" type="radio" name="color" id="color2">
                      <label class="custom-option-label rounded-circle" for="color2"><span class="custom-option-color rounded-circle" style="background-image: url(img/shop/single/color-opt-2.png)"></span></label>
                    </div>
                    <div class="custom-control custom-option custom-control-inline mb-2">
                      <input class="custom-control-input" type="radio" name="color" id="color3">
                      <label class="custom-option-label rounded-circle" for="color3"><span class="custom-option-color rounded-circle" style="background-image: url(img/shop/single/color-opt-3.png)"></span></label>
                    </div>
                    <div class="product-badge product-available mt-n1"><i class="ci-security-check"></i>Product available</div>
                  </div>
                  <form class="mb-grid-gutter">
                    <div class="form-group">
                      <label class="font-weight-medium pb-1" for="product-size">Size:</label>
                      <select class="custom-select" required id="product-size">
                        <option value="">Select size</option>
                        <option value="xs">XS</option>
                        <option value="s">S</option>
                        <option value="m">M</option>
                        <option value="l">L</option>
                        <option value="xl">XL</option>
                      </select>
                    </div>
                    <div class="form-group d-flex align-items-center">
                      <select class="custom-select me-3" style="width: 5rem;">
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                      </select>
                      <button class="btn btn-primary btn-shadow btn-block" type="submit"><i class="ci-cart font-size-lg me-2"></i>Add to Cart</button>
                    </div>
                  </form>
                  <h5 class="h6 mb-3 pb-2 border-bottom"><i class="ci-announcement text-muted font-size-lg align-middle mt-n1 me-2"></i>Product info</h5>
                  <h6 class="font-size-sm mb-2">Style</h6>
                  <ul class="font-size-sm pl-4">
                    <li>Hooded top</li>
                  </ul>
                  <h6 class="font-size-sm mb-2">Composition</h6>
                  <ul class="font-size-sm pl-4">
                    <li>Elastic rib: Cotton 95%, Elastane 5%</li>
                    <li>Lining: Cotton 100%</li>
                    <li>Cotton 80%, Polyester 20%</li>
                  </ul>
                  <h6 class="font-size-sm mb-2">Art. No.</h6>
                  <ul class="font-size-sm pl-4 mb-0">
                    <li>183260098</li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
   
      <!-- Remove "navbar-sticky" class to make navigation bar scrollable with the page.-->
      <div class="navbar-sticky bg-light">
        <div class="navbar navbar-expand-lg navbar-light">
          <div class="container"><a class="navbar-brand d-none d-sm-block me-3 flex-shrink-0" href="index.php" style="min-width: 7rem;"><img width="142" src="img/phstore-top.png" alt="PhStore"/></a><a class="navbar-brand d-sm-none me-2" href="index.php" style="min-width: 4.625rem;"><img width="90" src="img/phstore-top.png" alt="PhStore"/></a>
            <div class="input-group-overlay d-none d-lg-flex mx-4">
              <input class="form-control appended-form-control" type="text" placeholder="Procurar produto">
              <div class="input-group-append-overlay"><span class="input-group-text"><i class="ci-search"></i></span></div>
            </div>
            <div class="navbar-toolbar d-flex flex-shrink-0 align-items-center">
              <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse"><span class="navbar-toggler-icon"></span></button><a class="navbar-tool navbar-stuck-toggler" href="#"><span class="navbar-tool-tooltip">Expandir menu</span>

                <div class="navbar-tool-icon-box"><i class="navbar-tool-icon ci-menu"></i></div></a><a class="navbar-tool d-none d-lg-flex" <?php if(!isset($_SESSION['logado'])){ echo 'onclick="fazerlog();"';}else { echo 'href="#"';} ?>><span class="navbar-tool-tooltip">Lista de desejos</span>

                <div class="navbar-tool-icon-box"><i class="navbar-tool-icon ci-heart"></i></div></a><a class="navbar-tool ms-1 ms-lg-0 me-n1 me-lg-2" <?php if(!isset($_SESSION['logado'])){ echo 'onclick="fazerlog();"';}else { echo 'href="index.php?p=minhaconta"';} ?> >

                <div class="navbar-tool-icon-box"><?php if(isset($_SESSION['logado']) && $_SESSION['logado']->img != 'semfoto.png'){$img = $_SESSION['logado']->img; echo '<img style="background-color: #aaa;border-radius: 50%;margin-bottom:5px;width: 45px;height:45px;overflow: hidden;position: relative;"src="img/usuarios/'.$img.'">';} ?><i class="navbar-tool-icon <?php if(!isset($_SESSION['logado'])){echo 'ci-user';} if(isset($_SESSION['logado']) && $_SESSION['logado']->img === 'semfoto.png'){echo 'ci-user';} ?>"></i></div>
                <div class="navbar-tool-text ms-n3"><small>Olá, Faça o Login</small>Minha Conta</div></a>

              <div class="navbar-tool dropdown ms-3"><a class="navbar-tool-icon-box bg-secondary dropdown-toggle" <?php if(!isset($_SESSION['logado'])){ echo 'onclick="fazerlog();"';}else { echo 'href="index.php?p=carrinho"';} ?>><span class="navbar-tool-label"><?php if(isset($_SESSION['logado'])){ echo qntcarrinho($_SESSION["logado"]->id); } else {echo '0';} ?></span><i class="navbar-tool-icon ci-cart"></i></a>

                <a class="navbar-tool-text" <?php if(!isset($_SESSION['logado'])){ echo 'onclick="fazerlog();"';}else { echo 'href="#"';} ?>><small>Meu Carrinho</small>R$0,00</a>

                <!--
                 Cart dropdown
                <div class="dropdown-menu dropdown-menu-right" style="width: 20rem;">
                  <div class="widget widget-cart px-3 pt-2 pb-3">
                    <div style="height: 15rem;" data-simplebar data-simplebar-auto-hide="false">
                      <div class="widget-cart-item pb-2 border-bottom">
                        <button class="close text-danger" type="button" aria-label="Remove"><span aria-hidden="true">&times;</span></button>
                        <div class="media align-items-center"><a class="d-block me-2" href="shop-single-v1.html"><img width="64" src="https://cartzilla.createx.studio/img/shop/cart/widget/01.jpg" alt="Product"/></a>
                          <div class="media-body">
                            <h6 class="widget-product-title"><a href="shop-single-v1.html">Women Colorblock Sneakers</a></h6>
                            <div class="widget-product-meta"><span class="text-accent me-2">$150.<small>00</small></span><span class="text-muted">x 1</span></div>
                          </div>
                        </div>
                      </div>
                      <div class="widget-cart-item py-2 border-bottom">
                        <button class="close text-danger" type="button" aria-label="Remove"><span aria-hidden="true">&times;</span></button>
                        <div class="media align-items-center"><a class="d-block me-2" href="shop-single-v1.html"><img width="64" src="https://cartzilla.createx.studio/img/shop/cart/widget/02.jpg" alt="Product"/></a>
                          <div class="media-body">
                            <h6 class="widget-product-title"><a href="shop-single-v1.html">TH Jeans City Backpack</a></h6>
                            <div class="widget-product-meta"><span class="text-accent me-2">$79.<small>50</small></span><span class="text-muted">x 1</span></div>
                          </div>
                        </div>
                      </div>
                      <div class="widget-cart-item py-2 border-bottom">
                        <button class="close text-danger" type="button" aria-label="Remove"><span aria-hidden="true">&times;</span></button>
                        <div class="media align-items-center"><a class="d-block me-2" href="shop-single-v1.html"><img width="64" src="https://cartzilla.createx.studio/img/shop/cart/widget/03.jpg" alt="Product"/></a>
                          <div class="media-body">
                            <h6 class="widget-product-title"><a href="shop-single-v1.html">3-Color Sun Stash Hat</a></h6>
                            <div class="widget-product-meta"><span class="text-accent me-2">$22.<small>50</small></span><span class="text-muted">x 1</span></div>
                          </div>
                        </div>
                      </div>
                      <div class="widget-cart-item py-2 border-bottom">
                        <button class="close text-danger" type="button" aria-label="Remove"><span aria-hidden="true">&times;</span></button>
                        <div class="media align-items-center"><a class="d-block me-2" href="shop-single-v1.html"><img width="64" src="https://cartzilla.createx.studio/img/shop/cart/widget/04.jpg" alt="Product"/></a>
                          <div class="media-body">
                            <h6 class="widget-product-title"><a href="shop-single-v1.html">Cotton Polo Regular Fit</a></h6>
                            <div class="widget-product-meta"><span class="text-accent me-2">$9.<small>00</small></span><span class="text-muted">x 1</span></div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="d-flex flex-wrap justify-content-between align-items-center py-3">
                      <div class="font-size-sm me-2 py-2"><span class="text-muted">Subtotal:</span><span class="text-accent font-size-base ms-1">$265.<small>00</small></span></div><a class="btn btn-outline-secondary btn-sm" href="shop-cart.html">Expand cart<i class="ci-arrow-right ms-1 me-n1"></i></a>
                    </div><a class="btn btn-primary btn-sm btn-block" href="checkout-details.html"><i class="ci-card me-2 font-size-base align-middle"></i>Checkout</a>
                  </div>
                </div>
              -->

              </div>
            </div>
          </div>
        </div>
        <div class="navbar navbar-expand-lg navbar-light navbar-stuck-menu mt-n2 pt-0 pb-2">
          <div class="container">
            <div class="collapse navbar-collapse" id="navbarCollapse">
              <!-- Search-->
                <div class="input-group d-lg-none my-3"><i class="ci-search position-absolute top-50 start-0 translate-middle-y text-muted fs-base ms-3"></i>
                <input class="form-control rounded-start" type="text" placeholder="Buscar produto">
                </div>


              <!-- MENU -->
              <ul class="navbar-nav">
                <li class="nav-item dropdown <?php if(!isset($_GET['p'])){echo 'active';} if($_GET['p'] === 'inicio'){echo 'active';}  ?>">
                  <a class="nav-link" href="index.php?p=inicio">Inicio</a>
                </li>

                <!-- <li class="nav-item">Roupas Infantil</li> -->

                <?php
                if(logado()){
                  if($_SESSION['logado']->cargo === '1'){
                ?>
                <li class="nav-item dropdown <?php if($_GET['p'] === 'cadastroproduto'){echo 'active';} ?>">
                  <a class="nav-link" href="index.php?p=cadastroproduto">Cadastrar produtos (ADM)</a></li>
                  <li class="nav-item dropdown <?php if($_GET['p'] === 'cadcupom'){echo 'active';} ?>">
                  <a class="nav-link" href="index.php?p=cadcupom">Cadastrar cupom (ADM)</a></li>
                  <li class="nav-item dropdown <?php if($_GET['p'] === 'todospedidos'){echo 'active';} ?>">
                  <a class="nav-link" href="index.php?p=todospedidos">Todos pedidos (ADM)</a></li>
                <?php
                  }
                }
                ?>
            </div>
          </div>
        </div>
      </div>
    </header>
    <!-- Page title-->

  
    <?php
      $pagina = @$_GET['p'];

      if($pagina == 'cadastroproduto'){
        require 'paginas/cadastroproduto.php';
      } else if($pagina == 'produto'){
        require 'paginas/produto.php';
      } else if($pagina == 'minhaconta'){
        require 'paginas/minhaconta.php';
      } else if($pagina == 'carrinho'){
        require 'paginas/carrinho.php';
      } else if($pagina == 'desejo'){
        require 'paginas/desejo.php';
      } else if($pagina == 'comprar1'){
        require 'paginas/comprar1.php';
      } else if($pagina == 'comprar2'){
        require 'paginas/comprar2.php';
      } else if($pagina == 'comprar3'){
        require 'paginas/comprar3.php';
      } else if($pagina == 'meuspedidos'){
        require 'paginas/meuspedidos.php';
      } else if($pagina == 'todospedidos'){
        require 'paginas/todospedidos.php';
      } else if($pagina == 'cadcupom'){
        require 'paginas/cadcupom.php';
      } else{
        require 'paginas/inicio.php';
      }


    ?>

    <!-- Footer-->
    <!-- Footer-->
    <footer class="bg-dark pt-5">
      <div class="container">
        <div class="row pb-2">
          <div class="col-md-4 col-sm-6">
            <div class="col-md-4">
            <div class="widget pb-2 mb-4">
              <h3 class="widget-title text-light pb-1">Matenha-me informado(a):</h3>
              <form class="subscription-form validate" action="" method="post" name="inscrever">
                <div class="input-group input-group-overlay flex-nowrap">
                  <div class="input-group-prepend-overlay"></div>
                  <input class="form-control prepended-form-control" type="email" name="email" placeholder="Seu email" required>
                  <div class="input-group-append">
                    <button class="btn btn-primary" type="submit">Inscrever-se</button>
                  </div>
                </div>
                <!-- real people should not fill this in and expect good things - do not remove this or risk form bot signups-->
                <div style="position: absolute; left: -5000px;" aria-hidden="true">
                  <input class="cz-subscribe-form-antispam" type="text" name="b_c7103e2c981361a6639545bd5_29ca296126" tabindex="-1">
                </div><small class="form-text text-light opacity-50">Se inscreva acima para receber mensagens sobre novos lançamentos!</small>
                <div class="subscribe-status"></div>
                <div class="aviso-inscrever"></div>
              </form>
            </div>
<!--
            <div class="widget pb-2 mb-4">
              <h3 class="widget-title text-light pb-1">Baixar Aplicativo (Em desenvolvimento)</h3>
              <div class="d-flex flex-wrap">
                <div class="mb-2"><a class="btn-market btn-google" href="#" role="button"><span class="btn-market-subtitle">Baixe nosso app</span><span class="btn-market-title">Google Play</span></a></div>
              </div>
            </div>
          -->
          </div>
        </div>
      </div>
      <div class="pt-5 bg-darker">
        <div class="container">
          <div class="row pb-3">
            <div class="col-md-3 col-sm-6 mb-4">
              <div class="media"><i class="ci-rocket text-primary" style="font-size: 2.25rem;"></i>
                <div class="media-body pl-3">
                  <h6 class="font-size-base text-light mb-1">Entrega grátis e rápida</h6>
                  <p class="mb-0 font-size-ms text-light opacity-50">Entrega grátis apartir de R$ 80 em compras, válido somente para a cidade de camaçari.</p>
                </div>
              </div>
            </div>
            <div class="col-md-3 col-sm-6 mb-4">
              <div class="media"><i class="ci-support text-primary" style="font-size: 2.25rem;"></i>
                <div class="media-body pl-3">
                  <h6 class="font-size-base text-light mb-1">Suporte 24hrs</h6>
                  <p class="mb-0 font-size-ms text-light opacity-50">Entre em contato conosco a qualquer momento.</p>
                </div>
              </div>
            </div>
            <div class="col-md-3 col-sm-6 mb-4">
              <div class="media"><i class="ci-card text-primary" style="font-size: 2.25rem;"></i>
                <div class="media-body pl-3">
                  <h6 class="font-size-base text-light mb-1">Segurança no pagamento online</h6>
                  <p class="mb-0 font-size-ms text-light opacity-50">Nosso sistema possui o SSL (Secure certificate) garantindo segurança de suas informações. Juntamente com o mercado pago 100% seguro!</p>
                </div>
              </div>
            </div>
          </div>
          <hr class="hr-light mb-5">
          <div class="row pb-2">
            
            <div class="col-md-6 text-center text-md-end mb-4">
              <div class="mb-3"><a class="btn-social bs-light bs-facebook ms-2 mb-2" href="#"><i class="ci-facebook"></i></a><a class="btn-social bs-light bs-youtube ms-2 mb-2" href="#"><i class="ci-youtube"></i></a></div><img class="d-inline-block" width="187" src="https://cartzilla.createx.studio/img/cards-alt.png" alt="Metodos de Pagamento"/>
            </div>
          </div>
          <div class="pb-4 font-size-xs text-light opacity-50 text-center text-md-left">© Todos direitos reservados PhStore. Desenvolvido por <a class="text-light" href="https://createx.studio/" target="_blank" rel="noopener">NestWeb</a></div>
        </div>
      </div>
    </footer>
    <!-- Toolbar for handheld devices-->
    <div class="cz-handheld-toolbar">
      <div class="d-table table-fixed w-100"><a class="d-table-cell cz-handheld-toolbar-item" <?php if(!isset($_SESSION['logado'])){ echo 'onclick="fazerlog();"';}else { echo 'href="index.php?p=desejo"';} ?>><span class="cz-handheld-toolbar-icon"><i class="ci-heart"></i><span class="badge badge-primary badge-pill ms-1"><?php if(isset($_SESSION['logado'])){ echo qntdesejo($_SESSION["logado"]->id); } else {echo '0';} ?></span></span><span class="cz-handheld-toolbar-label">Meus Desejos</span></a>
        
        <a class="d-table-cell cz-handheld-toolbar-item" href="#navbarCollapse" data-bs-toggle="collapse" onclick="window.scrollTo(0, 0)"><span class="cz-handheld-toolbar-icon"><i class="ci-menu"></i></span><span class="cz-handheld-toolbar-label">Menu</span></a>

        <a class="d-table-cell cz-handheld-toolbar-item" <?php if(!isset($_SESSION['logado'])){ echo 'onclick="fazerlog();"';}else { echo 'href="index.php?p=carrinho"';} ?>><span class="cz-handheld-toolbar-icon"><i class="ci-cart"></i><span class="badge badge-primary badge-pill ms-1"><?php if(isset($_SESSION['logado'])){ echo qntcarrinho($_SESSION["logado"]->id); } else {echo '0';} ?></span></span><span class="cz-handheld-toolbar-label">Meu carrinho</span></a>
      </div>
    </div>


    <!-- Back To Top Button--><a class="btn-scroll-top" href="#top" data-scroll><span class="btn-scroll-top-tooltip text-muted font-size-sm me-2">Topo</span><i class="btn-scroll-top-icon ci-arrow-up">   </i></a>
    <!-- Vendor scrits: js libraries and plugins-->
    <script src="https://cartzilla.createx.studio/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    
    <script src="https://cartzilla.createx.studio/vendor/simplebar/dist/simplebar.min.js"></script>
    <script src="https://cartzilla.createx.studio/vendor/tiny-slider/dist/min/tiny-slider.js"></script>
    <script src="https://cartzilla.createx.studio/vendor/smooth-scroll/dist/smooth-scroll.polyfills.min.js"></script>

    <script src="https://cartzilla.createx.studio/vendor/drift-zoom/dist/Drift.min.js"></script>
    <!-- Main theme script-->
    <script src="https://cartzilla.createx.studio/js/theme.min.js"></script>

    <script type="text/javascript">
      function fazerlog(){

        $('#signin-modal').modal({backdrop: 'boolean'});
        return false;
      }
  </script>
  </body>
</html>

<?php ob_end_flush(); ?>