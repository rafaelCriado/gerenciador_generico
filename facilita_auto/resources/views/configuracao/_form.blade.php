<div class="form-group">
    <label for="taxa_servico">Taxa de Serviços (R$)</label>
    <input type="text" class="form-control" id="taxa_servico" name="taxa_servico" placeholder="Taxa de Serviço" value="{{ isset($configuracao->taxa_servico) ? $configuracao->taxa_servico : '' }}">
  </div>
  