<div class="form-group">
    <label for="nome">Nome</label>
    <input type="text" class="form-control" id="nome" name="nome" placeholder="Nome" value="{{ isset($papel->nome) ? $papel->nome : '' }}">
  </div>
  <div class="form-group">
    <label for="descricao">Descrição</label>
    <input type="text" class="form-control" id="descricao" name="descricao" placeholder="Descrição" value="{{ isset($papel->descricao)? $papel->descricao : '' }}">
  </div>
  