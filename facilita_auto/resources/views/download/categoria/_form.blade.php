<div class="form-group">
    <label for="nome">Nome</label>
    <input type="text" class="form-control" id="nome" name="nome" placeholder="Nome" value="{{ isset($categoria->nome) ? $categoria->nome : '' }}">
  </div>
  <div class="form-group">
    <label for="descricao">Descrição</label>
    <input type="text" class="form-control" id="descricao" name="descricao" placeholder="Descrição" value="{{ isset($categoria->descricao)? $categoria->descricao : '' }}">
  </div>
