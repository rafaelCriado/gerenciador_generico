
<div class="row">
  <div class="col-12">
    <div class="form-group">
      <label for="nome">Nome</label>
      <input type="text" class="form-control" id="nome" name="nome" placeholder="Nome" value="{{ isset($pedido->nome) ? $pedido->nome : '' }}">
    </div>  
  </div>
</div>

<div class="row">
  <div class="col-5">
    <div class="form-group">
      <label for ="cpf">CPF</label>
      <input type="text" class="form-control" id="cpf" name="cpf" placeholder="CPF" value="{{ isset($pedido->cpf) ? $pedido->cpf : '' }}">
    </div>  
  </div>
  <div class="col-5">
    <div class="form-group">
      <label for="placa">Placa/Renavam do Veículo</label>
      <input type="text" class="form-control" id="placa" name="placa" placeholder="Placa/Renavam" value="{{ isset($pedido->placa) ? $pedido->placa : '' }}">
    </div>  
  </div>
  <div class="col-2">
    <div class="form-group">
      <label for="apelido">Estado</label>
      <select name="uf" id="uf" class="form-control">
        @foreach ($estados as $estado)
          <option value="{{$estado->uf}}" @if (isset($pedido->uf) and $pedido->uf == $estado->uf)
              selected='selected'
          @endif>{{$estado->uf}}</option>
        @endforeach
      </select>
    </div>  
  </div>
</div>


