<div class="row">
  <div class="col-5">
  
    <div class="form-group">
      <label for="cnpj">CNPJ</label>
      <input type="text" class="form-control" id="cnpj" name="cnpj" placeholder="CNPJ" value="{{ isset($franquia->cnpj) ? $franquia->cnpj : '' }}">
    </div>  
  
  </div>
</div>

<div class="row">
  <div class="col-6">
    <div class="form-group">
      <label for="razaoSocial">Razão Social</label>
      <input type="text" class="form-control" id="razaoSocial" name="razao_social" placeholder="Razão Social" value="{{ isset($franquia->razao_social) ? $franquia->razao_social : '' }}">
    </div>  
  </div>
  <div class="col-6">
    <div class="form-group">
      <label for="nomeFantasia">Nome Fantasia</label>
      <input type="text" class="form-control" id="nomeFantasia" name="nome_fantasia" placeholder="Nome Fantasia" value="{{ isset($franquia->nome_fantasia) ? $franquia->nome_fantasia : '' }}">
    </div>  
  </div>
</div>

<div class="row">
  <div class="col-4">
    <div class="form-group">
      <label for="apelido">Apelido</label>
      <input type="text" class="form-control" id="apelido" name="apelido" placeholder="Apelido" value="{{ isset($franquia->apelido) ? $franquia->apelido : '' }}">
    </div>  
  </div>
  <div class="col-8">
    <div class="form-group">
      <label for="email">E-mail</label>
      <input type="email" class="form-control" id="email" name="email" placeholder="E-mail" value="{{ isset($franquia->email) ? $franquia->email : '' }}">
    </div>  
  </div>
</div>

<div class="row">
  <div class="col-3">
    <div class="form-group">
      <label for="telefone">Telefone 1</label>
      <input type="text" class="form-control" id="telefone" name="telefone" placeholder="(99) 9999-9999" value="{{ isset($franquia->telefone) ? $franquia->telefone : '' }}">
    </div>  
  </div>
  <div class="col-3">
    <div class="form-group">
      <label for="celular">Telefone 2</label>
      <input type="text" class="form-control" id="celular" name="celular" placeholder="(99) 9999-9999" value="{{ isset($franquia->celular) ? $franquia->celular : '' }}">
    </div>  
  </div>
  <div class="col-6">
    <div class="form-group">
      <label for="responsavel">Responsável</label>
      <input type="text" class="form-control" id="responsavel" name="responsavel" placeholder="Responsável" value="{{ isset($franquia->responsavel) ? $franquia->responsavel : '' }}">
    </div>  
  </div>
</div>

@include('franquia._formEndereco')

