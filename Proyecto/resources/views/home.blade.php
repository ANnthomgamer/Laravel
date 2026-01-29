@extends('layouts.app')

@section('title', 'Panel de Control del Sistema')

@section('content')
    <h1 class="glitch-title">SYSTEM STATUS: OPERATIONAL</h1>
    <p>Bienvenido al terminal de gestión de inventario de Tienda Laravel.</p>

    <!-- Sección de Estadísticas Clave (simulado por ahora) -->
    <div class="stats-container">
        <!-- Estos divs necesitarán estilos CSS, ver abajo -->
        <div class="stat-card">
            <h3>[ TOTAL PRODUCTS ]</h3>
            <p class="stat-value">420</p>
        </div>
        <div class="stat-card">
            <h3>[ LOW STOCK ]</h3>
            <p class="stat-value danger">15</p>
        </div>
        <div class="stat-card">
            <h3>[ CATEGORIES ]</h3>
            <p class="stat-value">12</p>
        </div>
    </div>

    <!-- Sección de Acciones Rápidas -->
    <h2>ACCIONES RÁPIDAS >></h2>
    <div class="quick-links">
        <a href="{{ route('products.create') }}" class="cyber-button-alt">[ NUEVO PRODUCTO ]</a>
        <a href="{{ route('products.index') }}" class="cyber-button-alt">[ VER INVENTARIO ]</a>
    </div>

    <!-- Sección de Registro de Actividad (Log) -->
    <div class="system-log">
        <h2>REGISTRO DE ACTIVIDAD_</h2>
        <ul>
            <li>[04:14:22] - Usuario ADMIN ha iniciado sesión.</li>
            <li>[04:14:10] - Producto ID 10 actualizado con nuevo stock.</li>
            <li>[04:13:50] - Conexión con DB establecida correctamente.</li>
            <!-- Estos datos luego se pueden cargar dinámicamente -->
        </ul>
    </div>

@endsection

