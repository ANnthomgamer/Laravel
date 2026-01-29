@extends('layouts.app')
@section('title', 'Listado general')
@section('content')
<div class="bg-white p-4 rounded shadow-sm">
<h2>Productos</h2>
<table class="table table-striped">
<thead>
<tr>
<th>ID</th><th>Descripción</th><th>Stock</th><th>Precio</th><th>Categoría</th>
</tr>
</thead>
<tbody>
@forelse($products as $p)
<tr>
<td>{{ $p->id }}</td>
<td>{{ $p->description }}</td>
<td>{{ $p->stock }}</td>
<td>{{ number_format($p->price, 2) }}</td>
<td>{{ $p->category?->name }}</td>
</tr>
@empty
<tr><td colspan="5">No hay productos.</td></tr>
@endforelse
</tbody>
</table>
</div>
@endsection

