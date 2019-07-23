<div class="image text-center">
    @if(isset($usuario->image) && $usuario->image != "")
      <img src="{{ url('storage/users/'.$usuario->image) }}" alt="{{ $usuario->name }}" class="img-circle" style="max-width:150px">  
    @endif
    @empty(auth()->user()->image)
        <img src="{{ asset('img/user.png') }}" class="img-circle" style="width:150px">
    @endempty
</div>
  <div class="form-group">
    <label for="name">Nome</label>
    <input type="text" class="form-control" id="name" name="name" placeholder="Nome" value="{{ isset($usuario->name) ? $usuario->name : '' }}">
  </div>
  
  <div class="form-group">
    <label for="email">Email</label>
    <input type="email" class="form-control" id="email" name="email" placeholder="Email" value="{{ isset($usuario->email)? $usuario->email : '' }}">
  </div>
  <div class="form-group">
    <label for="senha">Senha</label>
    <input type="password" class="form-control" id="senha" placeholder="Senha" name="password" value="">
  </div>

  <div class="form-group">
    <label for="image">Imagem</label>
    <input type="file" class="form-control" id="image" name="image" placeholder="Imagem">
  </div>