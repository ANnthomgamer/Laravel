@extends('layouts.app')

@section('title', 'Lista de Proveedores')

@section('content')
<h2 class="glitch-title" style="color: var(--cp-yellow)">> ACCEDIENDO_A_BASE_DE_DATOS: PROVEEDORES</h2>

<table class="cyber-table">
    <thead>
        <tr>
            <th>ID_SERIAL</th>
            <th>NOMBRE_ENTIDAD</th>
            <th>EMAIL_ENLACE</th>
            <th>REGISTRO</th>
            <th>ACCIONES</th>
        </tr>
    </thead>
    <tbody>

    <tbody>
        @forelse($providers as $provider)
            <tr>
                <td>#{{ str_pad($provider->id, 4, '0', STR_PAD_LEFT) }}</td>
                <td>{{ strtoupper($provider->name) }}</td>
                <td>{{ $provider->email }}</td>
                <td>{{ $provider->created_at->format('Y-m-d') }}</td>
                <td>
                    <a href="#" class="cyber-button-alt warning" style="text-decoration: none; padding: 2px 5px; font-size: 0.7rem;">EDITAR</a>
                    
                    {{-- Formulario para BORRAR --}}
                    <form action="{{ route('providers.destroy', $provider->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="cyber-button-alt danger" style="padding: 2px 5px; font-size: 0.7rem;">BORRAR</button>
                    </form>
                </td>
            </tr>
        @empty


            <tr>
                <td colspan="5" style="text-align: center; color: var(--cp-magenta);">[ ADVERTENCIA: NO SE ENCONTRARON REGISTROS EN EL SECTOR ]</td>
            </tr>
        @endforelse
    </tbody>
</table>

<div style="margin-top: 20px;">
    <a href="{{ route('providers.create') }}" class="cyber-button-alt">AÑADIR_NUEVO_NODO</a>
</div>
@endsection
