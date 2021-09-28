<?php
if(isset($_SESSION['logado'])){
  $usu = $_SESSION['logado'];
}else{
  header('Location: index.php');
}

?>

<div class="bg-dark py-4">
      <div class="container d-lg-flex justify-content-between py-2 py-lg-3">
        <div class="order-lg-2 mb-3 mb-lg-0 pt-lg-2">
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumb-light flex-lg-nowrap justify-content-center justify-content-lg-start">
              <li class="breadcrumb-item"><a class="text-nowrap" href="index.php"><i class="czi-home"></i>Inicio</a></li>
              <li class="breadcrumb-item text-nowrap"><a href="index.php?p=minhaconta">Minha conta</a>
              </li>
              <li class="breadcrumb-item text-nowrap active" aria-current="page">Meus pedidos</li>
            </ol>
          </nav>
        </div>
        <div class="order-lg-1 pr-lg-4 text-center text-lg-left">
          <h1 class="h3 text-light mb-0">Meus pedidos</h1>
        </div>
      </div>
    </div>
<?php

            if(pegavenda($usu->id)){
              $pegavenda = pegavenda($usu->id);
              foreach ($pegavenda as $pe) {
?>

      <div class="card border-0 box-shadow-lg">
        <div class="card-body pb-2">
          <ul class="nav nav-tabs media-tabs nav-justified">
            <li class="nav-item">
              <div class="nav-link <?php if($pe->status2 === '1'){echo 'completed';} ?>">
                <div class="media align-items-center">
                  <div class="media-tab-media mr-3"><i class="czi-bag"></i></div>
                  <div class="media-body">
                    <div class="media-tab-subtitle text-muted font-size-xs mb-1">Pedido:</div>
                    <h6 class="media-tab-title text-nowrap mb-0"><?php echo $pe->ordem; ?></h6>
                  </div>
                </div>
              </div>
            </li>
            <li class="nav-item">
              <div class="nav-link <?php if($pe->status === 'approved'){echo 'completed';} ?>">
                <div class="media align-items-center">
                  <div class="media-tab-media mr-3"><i class="czi-settings"></i></div>
                  <div class="media-body">
                    <div class="media-tab-subtitle text-muted font-size-xs mb-1">Pagamento:</div>
                    <h6 class="media-tab-title text-nowrap mb-0"><?php if($pe->status === 'approved'){echo 'Aprovado';}else if($pe->status === 'pending'){ echo 'Pendente'; }else if($pe->status === 'retirada'){ echo 'Retirada';}else{ echo 'Recusado';}?></h6>
                  </div>
                </div>
              </div>
            </li>
            <li class="nav-item">
              <div class="nav-link">
                <div class="media align-items-center">
                  <div class="media-tab-media mr-3"><i class="czi-star"></i></div>
                  <div class="media-body">
                    <div class="media-tab-subtitle text-muted font-size-xs mb-1">Status:</div>
                    <h6 class="media-tab-title text-nowrap mb-0"><?php if($pe->status2 === '0'){ echo 'Processando';}else if($pe->status2 === '1'){echo 'Pront para entrega';}else{echo 'Pedido recusado';} ?></h6>
                  </div>
                </div>
              </div>
            </li>
            <li class="nav-item">
              <div class="nav-link">
                <div class="media align-items-center">
                  <div class="media-tab-media mr-3"><svg width="1.5em" height="1.5em" viewBox="0 0 16 16" class="bi bi-clock-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg" style="margin-top: 15px;">
                   <path fill-rule="evenodd" d="M8 15A7 7 0 1 0 8 1a7 7 0 0 0 0 14zm8-7A8 8 0 1 1 0 8a8 8 0 0 1 16 0z"/>
                  <path fill-rule="evenodd" d="M7.5 3a.5.5 0 0 1 .5.5v5.21l3.248 1.856a.5.5 0 0 1-.496.868l-3.5-2A.5.5 0 0 1 7 9V3.5a.5.5 0 0 1 .5-.5z"/>
                  </svg></div>
                  <div class="media-body">
                    <div class="media-tab-subtitle text-muted font-size-xs mb-1">Pedido feito:</div>
                    <h6 class="media-tab-title text-nowrap mb-0"><?php echo $pe->data; ?></h6>
                  </div>
                </div>
              </div>
            </li>
            <li class="nav-item">
              <div class="nav-link">
                <div class="media align-items-center">
                  <div class="media-tab-media mr-3"><svg width="1.5em" height="1.5em" viewBox="0 0 16 16" class="bi bi-cash" fill="currentColor" xmlns="http://www.w3.org/2000/svg" style="margin-top: 15px;">
                  <path fill-rule="evenodd" d="M15 4H1v8h14V4zM1 3a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h14a1 1 0 0 0 1-1V4a1 1 0 0 0-1-1H1z"/>
                  <path d="M13 4a2 2 0 0 0 2 2V4h-2zM3 4a2 2 0 0 1-2 2V4h2zm10 8a2 2 0 0 1 2-2v2h-2zM3 12a2 2 0 0 0-2-2v2h2zm7-4a2 2 0 1 1-4 0 2 2 0 0 1 4 0z"/>
                  </svg></div>
                  <div class="media-body">
                    <div class="media-tab-subtitle text-muted font-size-xs mb-1">Total:</div>
                    <h6 class="media-tab-title text-nowrap mb-0">R$: <?php echo $pe->total; ?></h6>
                  </div>
                </div>
              </div>
            </li>
            <li class="nav-item">
              <div class="nav-link">
                <div class="media align-items-center">
                   <div class="media-tab-media mr-3"><svg width="1.5em" height="1.5em" viewBox="0 0 16 16" class="bi bi-house-door" fill="currentColor" xmlns="http://www.w3.org/2000/svg" style="margin-top: 15px;">
                  <path fill-rule="evenodd" d="M7.646 1.146a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 .146.354v7a.5.5 0 0 1-.5.5H9.5a.5.5 0 0 1-.5-.5v-4H7v4a.5.5 0 0 1-.5.5H2a.5.5 0 0 1-.5-.5v-7a.5.5 0 0 1 .146-.354l6-6zM2.5 7.707V14H6v-4a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 .5.5v4h3.5V7.707L8 2.207l-5.5 5.5z"/>
                  <path fill-rule="evenodd" d="M13 2.5V6l-2-2V2.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5z"/>
                  </svg></div>
                  <div class="media-body">
                    <div class="media-tab-subtitle text-muted font-size-xs mb-1">Endereço:</div>
                    <h6 class="media-tab-title text-nowrap mb-0"><?php echo $pe->endereco;?></h6>
                  </div>
                </div>
              </div>
            </li>
            
            <?php
            if($pe->comentario != ''){
            ?>
            <li class="nav-item">
              <div class="nav-link">
                <div class="media align-items-center">
                   <div class="media-tab-media mr-3"><svg width="1.5em" height="1.5em" viewBox="0 0 16 16" class="bi bi-envelope" fill="currentColor" xmlns="http://www.w3.org/2000/svg" style="margin-top: 15px;">
                  <path fill-rule="evenodd" d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V4zm2-1a1 1 0 0 0-1 1v.217l7 4.2 7-4.2V4a1 1 0 0 0-1-1H2zm13 2.383l-4.758 2.855L15 11.114v-5.73zm-.034 6.878L9.271 8.82 8 9.583 6.728 8.82l-5.694 3.44A1 1 0 0 0 2 13h12a1 1 0 0 0 .966-.739zM1 11.114l4.758-2.876L1 5.383v5.73z"/>
                  </svg></div>
                  <div class="media-body">
                    <div class="media-tab-subtitle text-muted font-size-xs mb-1">Comentário:</div>
                    <h6 class="media-tab-title text-nowrap mb-0"><?php echo $pe->comentario; ?></h6>
                  </div>
                </div>
              </div>
            </li>
            <?php
            }
            ?>


          </ul>
        </div>
      </div>
    </div><br />
      <!-- Footer-->
    <?php
      }
    } else{
      ?>
       <div class="d-sm-flex justify-content-between align-items-center my-4 pb-3">
                <div class="media media-ie-fix d-block d-sm-flex align-items-center text-center text-sm-left">
              <br /><br />
                <h2 class="h6 mb-3 pb-1">Infelizmente você não fez nenhum pedido.</h2>
              </div>
            </div>

      <?php
    }

    ?>
