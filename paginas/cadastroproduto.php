<script type="text/javascript" src="js/cadastp.js"></script>
<div class="cadprod" style="margin-left: 10px; margin-right: 10px; margin-top: 10px; margin-bottom: 40px;">
  <h4>Cadastro de produtos</h4>

  <div class="aviso2"></div>

  <form class="needs-validation tab-pane" autocomplete="off" novalidate id="signup-tab" action="" name="cadastrar_produto" method="post" enctype="multipart/form-data">

  <div class="form-group">
    <input class="form-control" type="text" name="titulo" placeholder="Titulo" required>
    <div class="invalid-feedback">Por favor informe o titulo</div>
  </div>

  <div class="form-group">
    <input class="form-control" type="text" name="descrissao" placeholder="Descrissão" required>
    <div class="invalid-feedback">Por favor informe a descrissão</div>
  </div>

  <div class="form-group">
    <select class="form-control" type="text" name="categoria" placeholder="Categoria" required>
      <option selected value="">- Categoria -</option>
      <option value="Infantil">Infantil</option>
      <option value="Sandálias">Sandálias</option>
    </select>
    <div class="invalid-feedback">Por favor informe a categoria</div>
  </div>
  
  <div class="form-group" >
    <input class="form-control" type="number" maxlength="3" name="valor" placeholder="Valor Ex: 90 (reais)" required style="width: 45%; float: left; margin-right: 10px;">
    <input class="form-control" type="number" maxlength="2" name="valor2" placeholder="Valor Ex: 99 (centavos)" required style="width: 49%">
    <div class="invalid-feedback">Por favor informe o valor</div>
  </div>

  <div class="form-group">
    <select class="form-control" type="text" name="status" placeholder="Status" required>
      <option selected value="">- Status -</option>
      <option value="Disponivel">Disponivel</option>
      <option value="A caminho">A caminho</option>
      <option value="Indisponivel">Indisponivel</option>
    </select>
    <div class="invalid-feedback">Por favor informe o status</div>
  </div>

  <div class="form-group">
    <input class="form-control" type="number" maxlength="3" name="tamanho1" placeholder="Qnt. P" required style="width: 24%; float: left; margin-right: 3px;" >

    <input class="form-control" type="number" maxlength="3" name="tamanho2" placeholder="Qnt. M" required style="width: 24%; float: left; margin-right: 3px;">

    <input class="form-control" type="number" maxlength="3" name="tamanho3" placeholder="Qnt. G" required style="width: 24%; float: left; margin-right: 3px;">

    <input class="form-control" type="number" maxlength="3" name="tamanhounico" placeholder="Qnt. unico" style="width: 24%;">

    <div class="invalid-feedback">Por favor informe a quantiade</div>
  </div>

  <div class="form-group">
    <input class="form-control" type="text" name="compo1" placeholder="Composição 01" required>
    <input class="form-control" type="text" name="compo2" placeholder="Composição 02">
    <input class="form-control" type="text" name="compo3" placeholder="Composição 03">
    <div class="invalid-feedback">Por favor informe no minimo uma composição</div>
  </div>

  <div class="form-group">
    <input class="form-control" type="text" name="fornecedor" placeholder="Fornecedor" required>
    <div class="invalid-feedback">Por favor informe o fornecedor</div>
  </div>

  <div class="form-group">
    <input type="file" name="foto1" accept="image/*" class="form-control" required>
    <div class="invalid-feedback">Por favor envie no minimo uma imagem</div>
  </div>

  <div class="form-group">
    <input type="file" name="foto2" accept="image/*" class="form-control">
  </div>

  <div class="form-group">
    <input type="file" name="foto3" accept="image/*" class="form-control">
  </div>
  
<div id="result"></div>


  <button class="btn btn-primary btn-block btn-shadow" type="submit">Cadastrar produto</button>

  </form>

</div>