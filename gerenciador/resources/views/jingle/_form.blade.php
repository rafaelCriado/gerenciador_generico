<div class="form-group">
    <label for="titulo">Titulo</label>
    <input type="text" class="form-control" id="titulo" name="titulo" placeholder="Titulo" value="{{ isset($jingle->titulo) ? $jingle->titulo : '' }}">
  </div>
  <div class="form-group">
    <label for="descricao">Descrição</label>
    <input type="text" class="form-control" id="descricao" name="descricao" placeholder="Descrição" value="{{ isset($jingle->descricao)? $jingle->descricao : '' }}">
  </div>
  <div class="form-group">
    <label for="url">URL</label>
    <input type="text" class="form-control" id="url" name="url" placeholder="URL" value="{{ isset($jingle->url)? $jingle->url : '' }}">
  </div>