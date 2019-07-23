@can('franquia_listar')
    @if(count($dados['franquias']) > 0)
                        
            @foreach($dados['franquias'] as $franquia)
                <li class="item">
                    <div class="product-img">
                        <img src="{{ asset('img/enterprise.png') }}" class="" alt="{{ $franquia->nome_fantasia }}">
                    </div>
                    <div class="product-info">
                        <small>FRANQUIA:</small> <a href="{{ route('franquia.info',$franquia->id)}}" class="product-title">{{ $franquia->nome_fantasia }}</a>
                        <span class="product-description">
                            {{ $franquia->endereco_cidade }} - {{ $franquia->endereco_estado }}, <a href="mailto:{{ $franquia->email }}">{{ $franquia->email }}</a>, <abbr title="Telefone">Tel:</abbr> {{ $franquia->telefone}}<br>
                        </span>
                    </div>
                </li>
            @endforeach
        
    @endif
@endcan