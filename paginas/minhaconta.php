<?php
if(isset($_SESSION['logado'])){
  $usu = $_SESSION['logado'];
} else {
  header('Location: index.php');
}
?>
<script src="js/minhacon.js"></script>
<div class="page-title-overlap bg-dark pt-4">
      <div class="container d-lg-flex justify-content-between py-2 py-lg-3">
        <div class="order-lg-2 mb-3 mb-lg-0 pt-lg-2">
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumb-light flex-lg-nowrap justify-content-center justify-content-lg-start">
              <li class="breadcrumb-item"><a class="text-nowrap" href="index.php"><i class="czi-home"></i>Inicio</a></li>
              <li class="breadcrumb-item text-nowrap active">Minha conta</li>
            </ol>
          </nav>
        </div>
        <div class="order-lg-1 pr-lg-4 text-center text-lg-left">
          <h1 class="h3 text-light mb-0">Minha conta</h1>
        </div>
      </div>
    </div>
    <!-- Page Content-->
    <div class="container pb-5 mb-2 mb-md-4">
      <div class="row">
        <!-- Sidebar-->
        <aside class="col-lg-4 pt-4 pt-lg-0">
          <div class="cz-sidebar-static rounded-lg box-shadow-lg px-0 pb-0 mb-5 mb-lg-0">
            <div class="px-4 mb-4">
              <div class="media align-items-center">
                <div class="img-thumbnail rounded-circle position-relative" style="width: 6.375rem;height: 6.375rem;"><img style="width: 6.375rem;height: 5.700rem;" class="rounded-circle" src="img/usuarios/<?php echo $usu->img; ?>"></div>
                <div class="media-body pl-3">
                  <h3 class="font-size-base mb-0"><?php echo $usu->usuario; ?></h3><span class="text-accent font-size-sm"><?php echo $usu->email; ?></span>
                </div>
              </div>
            </div>
            <div class="bg-secondary px-4 py-3">
              <h3 class="font-size-sm mb-0 text-muted">Painel de controle</h3>
            </div>
            <ul class="list-unstyled mb-0">
              <li class="border-bottom mb-0"><a class="nav-link-style d-flex align-items-center px-4 py-3" href="index.php?p=meuspedidos"><i class="czi-bag opacity-60 mr-2"></i>Pedidos<span class="font-size-sm text-muted ml-auto"><?php echo qntvenda($usu->id); ?></span></a></li>
              <li class="border-bottom mb-0"><a class="nav-link-style d-flex align-items-center px-4 py-3" href="index.php?p=desejo"><i class="czi-heart opacity-60 mr-2"></i>Meus desejos<span class="font-size-sm text-muted ml-auto"><?php echo qntdesejo($usu->id); ?></span></a></li>
              <li class="border-bottom mb-0"><a class="nav-link-style d-flex align-items-center px-4 py-3" href="index.php?p=carrinho"><i class="czi-cart opacity-60 mr-2"></i>Meu Carrinho<span class="font-size-sm text-muted ml-auto"><?php echo qntcarrinho($usu->id); ?></span></a></li>
            </ul>
            <div class="bg-secondary px-4 py-3">
              <h3 class="font-size-sm mb-0 text-muted">Configurações da conta</h3>
            </div>
            <ul class="list-unstyled mb-0">
              <li class="border-bottom mb-0" id="altinfo"><a class="nav-link-style d-flex align-items-center px-4 py-3"><i class="czi-user opacity-60 mr-2"></i>Alterar informações</a></li>
              <!--
              <li class="border-bottom mb-0"><a class="nav-link-style d-flex align-items-center px-4 py-3"><i class="czi-location opacity-60 mr-2"></i>Alterar endereço</a></li>
              <li class="mb-0"><a class="nav-link-style d-flex align-items-center px-4 py-3" href="account-payment.html"><i class="czi-card opacity-60 mr-2"></i>Payment methods</a></li> -->
              <li class="d-lg-none border-top mb-0"><a class="nav-link-style d-flex align-items-center px-4 py-3" href="index.php?logout=true"><i class="czi-sign-out opacity-60 mr-2"></i>Sair</a></li>
            </ul>
          </div>
        </aside>
        <!-- Content  -->
        <section class="col-lg-8">
          <!-- Toolbar-->
          <div class="d-none d-lg-flex justify-content-between align-items-center pt-lg-3 pb-4 pb-lg-5 mb-lg-3">
            <h6 class="font-size-base text-light mb-0">List of items you added to wishlist:</h6><a class="btn btn-primary btn-sm" href="account-signin.html"><i class="czi-sign-out mr-2"></i>Sign out</a>
          </div>