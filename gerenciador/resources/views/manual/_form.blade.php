<div class="form-group">
    <label for="titulo">Titulo</label>
    <input type="text" class="form-control" id="titulo" name="titulo" placeholder="Titulo" value="{{ isset($manual->titulo) ? $manual->titulo : '' }}">
  </div>
  <div class="form-group">
    <label for="descricao">Descrição</label>
    <input type="text" class="form-control" id="descricao" name="descricao" placeholder="Descrição" value="{{ isset($manual->descricao)? $manual->descricao : '' }}">
  </div>
  <div class="form-group">
    <label for="url">URL</label>
    <input type="text" class="form-control" id="url" name="url" placeholder="URL" value="{{ isset($manual->url)? $manual->url : '' }}">
  </div>