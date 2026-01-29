@extends('layouts.app')
@section('title', 'Editar producto')
@section('content')
<h1 class="glitch-title">Editar producto #{{ $product->id }}</h1>
<form method="POST" action="{{ route('products.update', $product) }}">
@csrf
@method('PUT')

<div class="cyber-form-group">
<label class="form-label">Descripción</label>
<input class="cyber-input" name="description" value="{{ old('description', $product->description) }}">
</div>
<div class="cyber-form-group">
<label class="form-label">Stock</label>
<input class="cyber-input" type="number" name="stock" value="{{ old('stock', $product->stock) }}">
</div>
<div class="cyber-form-group">
<label class="form-label">Precio</label>
<input class="cyber-input" type="number" step="0.01" name="price" value="{{ old('price', $product->price) }}">
</div>
<div class="cyber-form-group">
<label class="form-label">Categoría</label>
<select class="cyber-input" name="category_id">
@foreach($categories as $c)
<option value="{{ $c->id }}" @selected(old('category_id', $product->category_id) == $c->id)>
{{ $c->name }}
</option>
@endforeach
</select>
</div>
<button class="cyber-button-alt">Guardar cambios</button>
</form>
@endsection


