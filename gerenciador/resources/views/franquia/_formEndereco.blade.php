<div class="row">
  <div class="col-6">
    <div class="form-group">
      <label for="endereco">Endereço</label>
      <input type="text" class="form-control" id="endereco" name="endereco" placeholder="Endereço" value="{{ isset($franquia->endereco) ? $franquia->endereco : '' }}">
    </div>  
  </div>
  <div class="col-2">
    <div class="form-group">
      <label for="enderecoNumero">Número</label>
      <input type="text" class="form-control" id="enderecoNumero" name="endereco_numero" placeholder="Número" value="{{ isset($franquia->endereco_numero) ? $franquia->endereco_numero : '' }}">
    </div>  
  </div>
  <div class="col-4">
    <div class="form-group">
      <label for="enderecoBairro">Bairro</label>
      <input type="text" class="form-control" id="enderecoBairro" name="endereco_bairro" placeholder="Bairro" value="{{ isset($franquia->endereco_bairro) ? $franquia->endereco_bairro : '' }}">
    </div>  
  </div>
</div>

<div class="row">
    <div class="col-3">
        <div class="form-group">
            <label for="enderecoCEP">CEP</label>
            <input type="text" class="form-control" id="enderecoCEP" name="endereco_cep" placeholder="CEP" value="{{ isset($franquia->endereco_cep) ? $franquia->endereco_cep : '' }}">
        </div>  
    </div>
    <div class="col-3">
    <div class="form-group">
      <label for="enderecoCidade">Cidade</label>
      <input type="text" class="form-control" id="enderecoCidade" name="endereco_cidade" placeholder="Cidade" value="{{ isset($franquia->endereco_cidade) ? $franquia->endereco_cidade : '' }}">
    </div>  
  </div>
  <div class="col-3">
    <div class="form-group">
      <label for="enderecoEstado">Estado</label>
      <input type="text" class="form-control" id="enderecoEstado" name="endereco_estado" placeholder="Estado" value="{{ isset($franquia->endereco_estado) ? $franquia->endereco_estado : '' }}">
    </div>  
  </div>
  <div class="col-3">
    <div class="form-group">
      <label for="enderecoComplemento">Complemento</label>
      <input type="text" class="form-control" id="enderecoComplemento" name="endereco_complemento" placeholder="Complemento" value="{{ isset($franquia->endereco_complemento) ? $franquia->endereco_complemento : '' }}">
    </div>  
  </div>
</div>