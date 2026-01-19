# Usa la imagen oficial ya construida, no intentes construirla desde "scratch"
FROM ubuntu:22.04


# PATH
ENV PATH="/usr/local/sbin:/usr/local/bin:/usr/sbin:/usr/bin:/sbin:/bin"



# Aquí instalas lo que necesites para tu proyecto
RUN apt-get update && apt-get install -y \
    wget \
    curl \
    libnss3 \
    iproute2 \
    && rm -rf /var/lib/apt/lists/*

# Instalación lampp
RUN curl -X GET "https://deac-fra.dl.sourceforge.net/project/xampp/XAMPP%20Linux/8.2.4/xampp-linux-x64-8.2.4-0-installer.run?viasf=1" -o /opt/xampp.run

RUN chmod +x /opt/xampp.run && \
    /opt/xampp.run --mode unattended && \
    rm /opt/xampp.run


# Añadir el directorio bin del lampp al PATH
ENV PATH="/usr/local/sbin:/usr/local/bin:/usr/sbin:/usr/bin:/sbin:/bin:/opt/lampp/bin"

# Instalar composer
RUN curl -sS https://getcomposer.org/installer | php
RUN mv composer.phar bin/composer


# Crear proyecto
WORKDIR /opt/lampp/htdocs
RUN composer create-project --prefer-dist laravel/laravel Tienda
WORKDIR /opt/lampp/htdocs/Tienda

 
# Crear plantilla
WORKDIR /opt/lampp/htdocs/Tienda/resources/views
RUN mkdir layouts
WORKDIR /opt/lampp/htdocs/Tienda/resources/views/layouts
RUN <<EOF  cat >  /opt/lampp/htdocs/Tienda/resources/views/layouts/app.blade.php

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

EOF

WORKDIR /opt/lampp/htdocs/Tienda/public
RUN mkdir css
WORKDIR /opt/lampp/htdocs/Tienda/public/css
RUN <<EOF cat > style.css
/* Variables de color Cyberpunk 2077 */
:root {
    --cp-yellow: #fcee0a;
    --cp-cyan: #00f0ff;
    --cp-magenta: #ff003c;
    --cp-bg: #050505;
    --cp-gray: #1a1a1a;
}

body {
    background-color: var(--cp-bg);
    color: white;
    font-family: 'Courier New', Courier, monospace; /* Fuente estilo terminal */
    margin: 0;
    display: flex;
    flex-direction: column;
    min-height: 100vh;
}

/* --- HEADER --- */
.cyber-header {
    background: var(--cp-yellow);
    color: black;
    padding: 15px 30px;
    clip-path: polygon(0 0, 100% 0, 100% 70%, 98% 100%, 0 100%);
    border-bottom: 4px solid var(--cp-cyan);
}

.glitch-title {
    margin: 0;
    font-size: 1.5rem;
    font-weight: 900;
    text-transform: uppercase;
}

/* --- NAV --- */
.cyber-nav {
    background: var(--cp-gray);
    border-bottom: 2px solid var(--cp-magenta);
}

.nav-container {
    display: flex;
    flex-wrap: wrap;
    padding: 10px;
}

.cyber-nav a {
    color: var(--cp-cyan);
    text-decoration: none;
    padding: 10px 20px;
    font-weight: bold;
    font-size: 0.8rem;
    transition: 0.3s;
}

.cyber-nav a:hover {
    background: var(--cp-magenta);
    color: white;
    clip-path: polygon(10% 0, 100% 0, 90% 100%, 0 100%);
}

/* --- MAIN --- */
.cyber-main {
    flex: 1;
    padding: 40px 20px;
    max-width: 1200px;
    margin: 0 auto;
    width: 100%;
}

/* Alertas de estilo Hacker */
.cyber-alert {
    padding: 15px;
    margin-bottom: 20px;
    border-left: 5px solid;
    text-transform: uppercase;
    font-size: 0.85rem;
}

.success {
    background: rgba(0, 240, 255, 0.1);
    border-color: var(--cp-cyan);
    color: var(--cp-cyan);
}

.danger {
    background: rgba(255, 0, 60, 0.1);
    border-color: var(--cp-magenta);
    color: var(--cp-magenta);
}

/* --- FOOTER --- */
.cyber-footer {
    padding: 20px;
    text-align: center;
    color: #555;
}

.footer-line {
    height: 1px;
    background: var(--cp-magenta);
    width: 100%;
    margin-bottom: 10px;
}
EOF

# Crear base de datos
#  Creacion de tablas

WORKDIR /opt/lampp/htdocs/Tienda
RUN php artisan make:model Category -m
RUN php artisan make:model Product -m

#  Migraciones
RUN export FILE=`ls database/migrations/*_create_categories_table.php` && cat > "$FILE" <<'EOF'


<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
	   $table->string('name'); // nombre categoría
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};


EOF


RUN export FILE=`ls database/migrations/*_create_products_table.php` && cat > "$FILE" <<'EOF'

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */    
     
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id(); // id (autoincremental)
            $table->string('description');
            $table->integer('stock')->default(0);
            $table->decimal('price', 8, 2)->default(0);
            $table->foreignId('category_id')->constrained()->cascadeOnDelete();
            $table->timestamps();
        });
    }
        
        
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};

EOF


WORKDIR /opt/lampp/htdocs/Tienda
RUN php artisan migrate




EXPOSE 8000

# Comando por defecto
CMD ["/bin/bash"]
# CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"
