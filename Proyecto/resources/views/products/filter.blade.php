@extends('layouts.app')
@section('title', 'Listado filtrado')
@section('content')

<h1 class="glitch-title">Filtrar productos</h1>
<div class="cyber-form-group">

  <form method="GET" action="{{ route('products.filter.results') }}">
  <div class="cyber-form-group">
  <label class="form-label">Criterio</label>
  <select class="cyber-input" name="criterion">
  <option value="low_stock">Stock bajo (<= 5)</option>
  <option value="stock_gt_10">Stock alto (> 10)</option>
  <option value="price_lt_20">Precio barato (< 20)</option>
  </select>
  </div>
  <button class="btn btn-primary">Aplicar filtro</button>
  </form>
</div>
@endsection

