@extends('layouts.app')
@section('title', 'Entrada de datos')
@section('content')
<!-- Contenido del formulario de alta de producto -->
<h1 class="glitch-title">Alta de producto</h1>

<form method="POST" action="{{ route('products.store') }}">
    @csrf

    <!-- Campo Descripción -->
    <div class="cyber-form-group">
        <label>Descripción</label>
        <input class="cyber-input" name="description" value="{{ old('description') }}">
    </div>

    <!-- Campo Stock -->
    <!-- Reemplazamos mb-3 y form-control -->
    <div class="cyber-form-group">
        <label class="form-label">Stock</label>
        <input class="cyber-input" type="number" name="stock" value="{{ old('stock', 0) }}">
    </div>

    <!-- Campo Precio -->
    <div class="cyber-form-group">
        <label class="form-label">Precio</label>
        <input class="cyber-input" type="number" step="0.01" name="price" value="{{ old('price', 0) }}">
    </div>

    <!-- Campo Categoría -->
    <div class="cyber-form-group">
        <label class="form-label">Categoría</label>
        <!-- Reemplazamos form-select -->
        <select class="cyber-input" name="category_id">
            <option value="">-- elige --</option>
            @foreach($categories as $c)
                <option value="{{ $c->id }}" @selected(old('category_id') == $c->id)>
                    {{ $c->name }}
                </option>
            @endforeach
        </select>
    </div>

    <!-- Botón Guardar -->
    <!-- Reemplazamos btn btn-primary por cyber-button-alt -->
    <button class="cyber-button-alt">Guardar</button>
</form>
@endsection

