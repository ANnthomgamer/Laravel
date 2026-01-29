@extends('layouts.app')
@section('title', 'Modificar / Borrar')
@section('content')
<h1 class="glitch-title">Gestionar productos</h1>
<table class="cyber-table">
<thead>
<tr>
<th>ID</th><th>Descripción</th><th>Categoría</th><th>Acciones</th>
</tr>
</thead>
<tbody>
@foreach($products as $p)
<tr>
<td>{{ $p->id }}</td>
<td>{{ $p->description }}</td>
<td>{{ $p->category?->name }}</td>
<td>
<!-- Usamos nuestras clases de botón -->
<a class="cyber-button-alt warning" href="{{ route('products.edit', $p) }}">Editar</a>
<form method="POST" action="{{ route('products.destroy', $p) }}" style="display:inline;">
@csrf
@method('DELETE')
<button class="cyber-button-alt danger" onclick="return confirm('¿Borrar producto?')">
Borrar
</button>
</form>
</td>
</tr>
@endforeach
</tbody>
</table>
@endsection


