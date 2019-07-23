@can('usuario_listar')
    @if(count($dados['usuarios']) > 0)
                
            @foreach($dados['usuarios'] as $usuario)
                <li class="item">
                    <div class="product-img">
                    @if($usuario->image != "")
                        <img src="{{ url('storage/users/'.$usuario->image) }}" alt="{{ $usuario->name }}" class="img-circle">  
                    @endisset

                    @empty($usuario->image)
                        <img src="{{ asset('img/user.png') }}" class="img-circle" alt="{{ $usuario->name }}">
                    @endempty
                        
                    </div>
                    <div class="product-info">
                    <small>USUÁRIO: </small><a href="{{ route('usuario.perfil',$usuario->id)}}" class="product-title">{{ $usuario->name }}</a>
                        <span class="product-description">
                            {{ $usuario->email }}
                        </span>
                    </div>
                </li>
            @endforeach
        
    @endif
@endcan