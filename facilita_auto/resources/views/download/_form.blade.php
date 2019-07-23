<div class="form-group">
    <label for="nome">Nome</label>
    <input type="text" class="form-control" id="nome" name="nome" placeholder="Nome" value="{{ isset($download->nome) ? $download->nome : '' }}">
  </div>
  <div class="form-group">
    <label for="descricao">Descrição</label>
    <input type="text" class="form-control" id="descricao" name="descricao" placeholder="Descrição" value="{{ isset($download->descricao)? $download->descricao : '' }}">
  </div>

  <div class="form-group">
    <label for="categoria_id">Categoria</label>
    <select class="form-control" id="categoria_id" required="required" name="categoria_id">
      <option value="">- Selecione uma categoria</option>
      @foreach($categorias as $categoria)
        <option value="{{ $categoria->id }}" {{ (isset($download->categoria_id) && $download->categoria_id == $categoria->id)? 'selected="selected"' : '' }}>{{ $categoria->nome }}</option>
      @endforeach
    </select>
  </div>


  <div class="form-group">
    <label for="tipo">Tipo</label>
    <select class="form-control" id="tipo" required="required" name="tipo">
      <option value="">- Selecione um tipo</option>
      <option value="video" {{ (isset($download->tipo) && $download->tipo == 'video')? 'selected="selected"' : '' }}>Video</option>
      <option value="audio" {{ (isset($download->tipo) && $download->tipo == 'audio')? 'selected="selected"' : '' }}>Áudio</option>
      <option value="imagem" {{ (isset($download->tipo) && $download->tipo == 'imagem')? 'selected="selected"' : '' }}>Imagem</option>
      <option value="arquivo" {{ (isset($download->tipo) && $download->tipo == 'arquivo')? 'selected="selected"' : '' }}>Arquivo</option>
    </select>
  </div>

  <div class="form-group">
    <label for="url_youtube">URL Youtube</label>
    <input type="text" class="form-control" id="url_youtube" name="url_youtube" placeholder="Caso o video esteja no youtube preencha esse campo com o codigo do video" value="{{ isset($download->url_youtube)? $download->url_youtube : '' }}">
  </div>

  <div class="form-group">
    <label for="caminho">Arquivo</label>
    <input type="file" class="form-control" id="caminho" name="caminho" placeholder="arquivo">
  </div>


  @if(isset($download->tipo))
  <ul class="products-list product-list-in-box mb-3">
  <li class="item">
  <div class="product-img">
      @switch($download->tipo)
          @case('video')
              <img src="{{ asset('img/video.png') }}" class="" alt="Video" title="Video">
              @break
          @case('audio')
              <img src="{{ asset('img/audio.png') }}" class="" alt="Áudio" title="Áudio">
              @break
          @case('imagem')
              @if(isset($download->caminho) && $download->caminho != "")
                <img src="{{ url('storage/download/imagens/'.$download->caminho) }}" alt="{{ $download->nome }}">  
              @endif
              @break
          @case('arquivo')
              <img src="{{ asset('img/file.png') }}" class="" alt="Arquivo" title="Arquivo">
              @break
      
      @endswitch
  </div>
  <div class="product-info">
      <span class="product-title">{{ $download->nome }}</span> - <a href="{{ route('download',$download->id)}}" >Fazer Download</a>
      <span class="product-description">
          Criado em: {{ $download->created_at}}<br>
          @if($download->tipo == 'audio')
              <audio src="{{ url('storage/download/audios/'.$download->caminho) }}" controls loop>
                <p>Seu navegador não suporta o elemento audio </p>
              </audio>
          @endif

          @if($download->tipo == 'video')
            @if($download->url_youtube != '')
            <iframe width="1280" height="720" 
                    src="https://www.youtube.com/embed/{{$download->url_youtube}}" 
                    frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" 
                    allowfullscreen>
            </iframe>
            @else
            <video src="{{ url('storage/download/videos/'.$download->caminho) }}" controls>
              Seu navegador não suporta o elemento <code>video</code>.
            </video>
            @endif
          @endif
      </span>
  </div>
  </li>
  </ul>
  @endif