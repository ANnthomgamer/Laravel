@extends('layouts.app')

@section('title', 'Crear Categoría')

@section('content')
    <h1 class="glitch-title">Crear Nueva Categoría</h1>

    <!-- Notificaciones de error específicas para este formulario -->
    @if ($errors->any())
        <div class="cyber-alert danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('categories.store') }}">
        @csrf

        <div class="cyber-form-group">
            <label for="name">NOMBRE DE LA CATEGORÍA:</label>
            <!-- Mantiene el valor anterior si hubo un error de validación -->
            <input type="text" name="name" id="name" class="cyber-input" value="{{ old('name') }}" required>
        </div>

        <button type="submit" class="cyber-button-alt">Guardar Categoría</button>
    </form>
@endsection

