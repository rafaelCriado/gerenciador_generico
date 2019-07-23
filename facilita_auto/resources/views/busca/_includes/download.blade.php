@can('download_listar')
    @if(count($dados['download']) > 0)
        
        @foreach($dados['download'] as $download)
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
                                <img src="{{ asset('img/imagem.png') }}" class="" alt="Imagem" title="Imagem">
                                @break
                            @case('arquivo')
                                <img src="{{ asset('img/file.png') }}" class="" alt="Arquivo" title="Arquivo">
                                @break
                        
                        @endswitch
                    </div>
                    <div class="product-info">
                        <small>DOWNLOAD:</small> <span class="product-title">{{ $download->nome }}</span> - 
                        @if($download->url_youtube == '') 
                            <a href="{{ route('download',$download->id)}}" >Fazer Download</a> 
                        @endif 
                        &nbsp &nbsp<a href="{{ route('download.editar',$download->id)}}" >Editar</a>
                        <span class="product-description">
                            @if($download->tipo == 'imagem' || $download->tipo == 'arquivo')
                                {{ $download->descricao }} - {{ $download->tipo }}
                            @endif
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
        @endforeach
          
    @endif
@endcan