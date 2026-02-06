@extends('layouts.app')
@section('title', 'Entrada de datos')
@section('content')
<!-- Contenido del formulario de alta de producto -->
<h1 class="glitch-title">Alta de producto</h1>

<form method="POST" action="{{ route('products.store') }}">
    @csrf

    <div class="cyber-form-group">
        <label>Producto</label>
        <input class="cyber-input" name="name" value="{{ old('name') }}">
    </div>

    <div class="cyber-form-group">
        <label class="form-label">Stock</label>
        <input class="cyber-input" type="number" name="stock" value="{{ old('stock', 0) }}">
    </div>

    <div class="cyber-form-group">
        <label class="form-label">Precio</label>
        <input class="cyber-input" type="number" step="0.01" name="price" value="{{ old('price', 0) }}">
    </div>

    <div class="cyber-form-group">
        <label class="form-label">Categoría</label>
        <select class="cyber-input" name="category_id">
            <option value="">-- elige --</option>
            @foreach($categories as $c)
                <option value="{{ $c->id }}" @selected(old('category_id') == $c->id)>
                    {{ $c->name }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="cyber-form-group">
        <label class="form-label">Proveedor</label>
        <select class="cyber-input" name="provider_id">
            <option value="">-- elige --</option>
            @foreach($providers as $p)
                <option value="{{ $p->id }}" @selected(old('provider_id') == $p->id)>
                    {{ $p->name }}
                </option>
            @endforeach
        </select>
    </div>

    <button class="cyber-button-alt">Guardar</button>
</form>
@endsection

