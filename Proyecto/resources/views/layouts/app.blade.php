
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Inventario')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

</head>

<body class="cyber-body">

    <header class="cyber-header">
        <div class="header-container">
            <h1 class="glitch-title">Tienda Laravel</h1>
            <span class="system-status">SYSTEM: ACTIVE</span>
        </div>
    </header>

    <nav class="cyber-nav">
        <div class="nav-container">
            <a href="{{ route('home') }}">INICIO</a>
            <a href="{{ route('products.create') }}">ENTRADA DATOS</a>
            <a href="{{ route('products.index') }}">LISTADO GENERAL</a>
            <a href="{{ route('products.filter.form') }}">LISTADO FILTRADO</a>

            <a href="{{ route('categories.create') }}">CREAR CATEGORÍA</a>

            <a href="{{ route('products.manage') }}">MODIFICAR/BORRAR</a>
        </div>
    </nav>

    <main class="cyber-main">
        <!-- Notificaciones de Sistema -->
        @if(session('ok'))
            <div class="cyber-alert success">{{ session('ok') }}</div>
        @endif

        @if($errors->any())
            <div class="cyber-alert danger">
                <ul>
                    @foreach($errors->all() as $e) 
                        <li>{{ $e }}</li> 
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Contenido Dinámico -->
        <div class="content-terminal">
            @yield('content')
        </div>
    </main>

    <footer class="cyber-footer">
        <div class="footer-container">
            <div class="footer-line"></div>
            <small>AUTHOR_ID: JUAN ANTONIO GIL ALBA</small>
        </div>
    </footer>

</body>
</html>

