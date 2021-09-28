<?php
if(isset($_SESSION['logado'])){
  $usu = $_SESSION['logado'];
} else {
  header('Location: index.php');
}



if(isset($_REQUEST['payment_id'])){


}else if(isset($_POST['idret'])){
  function attvenda2($status,$ref){
      $pdo = conectar();

      try{
          $addvenda = $pdo->prepare("UPDATE venda SET status=? WHERE ordem=?");

          $addvenda->bindValue(1,$status,PDO::PARAM_STR);
          $addvenda->bindValue(2,$ref,PDO::PARAM_INT);
          $addvenda->execute();

          if($addvenda->rowCount() === 1){
              return TRUE;
          } else {
              return FALSE;
          }
      }catch(PDOException $e){
          echo $e->getMessage();
      }
  }

  $idret = filter_input(INPUT_POST, 'idret', FILTER_SANITIZE_NUMBER_INT);
  attvenda2('retirada',$idret);

} else {
  header('Location: index.php');
}

?>
<div class="container pb-5 mb-sm-4">
  <div class="pt-5">
    <div class="card py-3 mt-sm-3">
      <div class="card-body text-center">
        <?php
        if(isset($_REQUEST['status'])){


          if($_REQUEST['status'] === 'approved'){
    
          ?>
          <h2 class="h4 pb-3">Obrigado pelo seu pedido!</h2>
          <p class="font-size-sm mb-2">Seu pedido foi aprovado e será processado o mais rápido possível.</p>
          <p class="font-size-sm mb-2">Certifique-se de anotar o número do seu pedido, que é <span class='font-weight-medium'><?php echo $_REQUEST['external_reference']; ?></span></p>
          <p class="font-size-sm">Em breve, você receberá um e-mail com a confirmação do seu pedido. Agora você pode:</p><a class="btn btn-secondary mt-3 mr-3" href="index.php">Voltar às compras</a><a class="btn btn-primary mt-3" href="index.php?p=meuspedidos"><i class="czi-location"></i>&nbsp;Acompanhar pedido</a>
          <?php

          } else if($_REQUEST['status'] === 'pending'){

          ?>
          <h2 class="h4 pb-3">Obrigado pelo seu pedido!</h2>
          <p class="font-size-sm mb-2">Seu pedido está pendente, caso tenha selecionado o boleto poderá leva de 1 a 2 dias após o pagamento para confirmar seu pedido.</p>
          <p class="font-size-sm mb-2">Certifique-se de anotar o número do seu pedido, que é <span class='font-weight-medium'><?php echo $_REQUEST['external_reference']; ?></span></p>
          <p class="font-size-sm">Em breve, você receberá um e-mail com a confirmação do seu pedido. Agora você pode:</p><a class="btn btn-secondary mt-3 mr-3" href="index.php">Voltar às compras</a><a class="btn btn-primary mt-3" href="index.php?p=meuspedidos"><i class="czi-location"></i>&nbsp;Acompanhar pedido</a>
          <?php
          } else {

          ?>
          <h2 class="h4 pb-3">Oops, infelizmente ocorreu um erro</h2>
          <p class="font-size-sm mb-2">Seu pagamento foi rejeitado, mais não se preocupe! você poderá tentar novamente.</p>
          <a class="btn btn-secondary mt-3 mr-3" href="index.php">Voltar às compras</a>
          <a class="btn btn-primary mt-3 mr-3" href="index.php?p=carrinho">Tentar novamente</a>
          <?php
          }


        }


        if(isset($_POST['idret'])){
          ?>
          <h2 class="h4 pb-3">Obrigado pelo seu pedido!</h2>
          <p class="font-size-sm mb-2">Seu pedido está pendente, aguarde que entraremos em contato com você via Whatsapp ou Email.</p>
          <p class="font-size-sm mb-2">Certifique-se de anotar o número do seu pedido, que é <span class='font-weight-medium'><?php echo $idret; ?></span></p>
          <p class="font-size-sm">Em breve, você receberá um e-mail com a confirmação do seu pedido. Agora você pode:</p><a class="btn btn-secondary mt-3 mr-3" href="index.php">Voltar às compras</a><a class="btn btn-primary mt-3" href="index.php?p=meuspedidos"><i class="czi-location"></i>&nbsp;Acompanhar pedido</a>
          <?php
        }
        ?>
      </div>
    </div>
  </div>
</div>