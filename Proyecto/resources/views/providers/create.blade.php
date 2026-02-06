@extends('layouts.app')

@section('title', 'Añadir Proveedor')

@section('content')
<h2 class="glitch-title" style="color: var(--cp-cyan)">> REGISTRAR_NUEVO_PROVEEDOR</h2>

<form action="{{ route('providers.store') }}" method="POST" class="cyber-form">
    @csrf
    <div class="cyber-form-group">
        <label>NOMBRE_DEL_PROVEEDOR:</label>
        <input type="text" name="name" class="cyber-input" required placeholder="Ej: CyberDyne Systems">
    </div>

    <div class="cyber-form-group">
        <label>EMAIL_DE_CONTACTO:</label>
        <input type="email" name="email" class="cyber-input" required placeholder="contacto@red.com">
    </div>

    <button type="submit" class="cyber-button-alt">INICIALIZAR_PROTOCOLO_ALTA</button>
</form>
@endsection
