# syntax=docker/dockerfile:1
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
RUN <<'EOF'  cat >  /opt/lampp/htdocs/Tienda/resources/views/layouts/app.blade.php

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

EOF

WORKDIR /opt/lampp/htdocs/Tienda/public
RUN mkdir css
WORKDIR /opt/lampp/htdocs/Tienda/public/css
RUN <<'EOF' cat > style.css



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

/* Estilo para los campos de entrada de texto, números, selects y botones */
.cyber-input, 
.cyber-button-alt,
select.cyber-input {
    /* Fondo oscuro para que coincida con el tema */
    background-color: #0a0a0a; 
    /* Texto verde neón */
    color: #00ff41; 
    /* Borde estilo terminal */
    border: 1px solid #00ff41; 
    padding: 8px 12px;
    font-family: monospace; /* Fuente monoespaciada */
    /* Elimina el borde blanco por defecto de los navegadores */
    appearance: none; 
    border-radius: 0; /* Bordes cuadrados */
}

/* Efecto de "brillo neón" al enfocar un campo */
.cyber-input:focus,
select.cyber-input:focus {
    outline: none; /* Elimina el borde azul por defecto */
    box-shadow: 0 0 10px #00ff41; /* Añade un brillo verde alrededor */
    border-color: #00ff41;
}

/* Estilo específico para el botón */
.cyber-button-alt {
    cursor: pointer;
    background-color: #00ff41; /* Invierte los colores para un botón destacado */
    color: #0a0a0a;
    font-weight: bold;
    border: 1px solid #00ff41;
}

.cyber-button-alt:hover {
    background-color: #00e639;
    box-shadow: 0 0 15px #00ff41;
}

/* Estilo para el contenedor de cada campo (etiqueta + input) */
.cyber-form-group {
    margin-bottom: 15px;
}

/* Estilo para las etiquetas */
label {
    color: #fff; /* Etiquetas en blanco o color claro */
    display: block;
    margin-bottom: 5px;
    font-family: monospace;
}

/* Estilo para la tabla Cyber */
.cyber-table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
    color: var(--cp-cyan); /* Texto principal de la tabla */
    font-family: monospace;
}

.cyber-table th, .cyber-table td {
    padding: 10px;
    text-align: left;
    border-bottom: 1px solid var(--cp-gray);
}

.cyber-table th {
    background-color: var(--cp-gray);
    color: var(--cp-yellow);
    text-transform: uppercase;
}

.cyber-table tbody tr:hover {
    background-color: rgba(0, 240, 255, 0.05);
}

/* Modificadores de color para botones de acción */
.cyber-button-alt.warning {
    background-color: var(--cp-yellow);
    color: black;
    border-color: var(--cp-yellow);
}

.cyber-button-alt.danger {
    background-color: var(--cp-magenta);
    color: white;
    border-color: var(--cp-magenta);
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


# Relacionar los modelos

WORKDIR /opt/lampp/htdocs/Tienda/app/Models/
RUN <<'EOF' cat > Category.php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{         
    //  
    protected $fillable = ['name'];
    public function products()
    {       
        return $this->hasMany(Product::class);    
    }       
}

EOF


RUN <<'EOF' cat > Product.php 
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    //
    protected $fillable = ['description','stock','price','category_id'];
    public function category() 
    { 
        return $this->belongsTo(Category::class);    
    }       
}

EOF


# Controlador y rutas
WORKDIR /opt/lampp/htdocs/Tienda
RUN php artisan make:controller ProductController
RUN php artisan make:controller CategoryController



RUN <<'EOF' cat > routes/web.php
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;

/*
Route::get('/', function () {
    return view('welcome');  
});
 */

Route::get('/', fn() => view('home'))->name('home');

Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
Route::get('/products/filter', [ProductController::class, 'filterForm'])->name('products.filter.form');
Route::get('/products/filter/results', [ProductController::class, 'filterResults'])->name('products.filter.results');
Route::get('/products/manage', [ProductController::class, 'manage'])->name('products.manage');
Route::get('/products/{product}/edit', [ProductController::class, 'edit'])->name('products.edit');

Route::post('/products', [ProductController::class, 'store'])->name('products.store');

Route::put('/products/{product}', [ProductController::class, 'update'])->name('products.update');

Route::delete('/products/{product}', [ProductController::class, 'destroy'])->name('products.destroy');



Route::get('/categories/create', [CategoryController::class, 'create'])->name('categories.create');

Route::post('/categories', [CategoryController::class, 'store'])->name('categories.store');


EOF

RUN <<'EOF' cat > app/Http/Controllers/ProductController.php
<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // OPCION3: listado general
    public function index()
    {
        $products = Product::with('category')->orderBy('id')->get();
        return view('products.index', compact('products'));
    }

    // OPCION2: formulario alta
    public function create()
    {
        $categories = Category::orderBy('name')->get();
        return view('products.create', compact('categories'));
    }

    // OPCION2: guardar alta
    public function store(Request $request)
    {
        $data = $request->validate([
            'description' => 'required|min:3',
            'stock' => 'required|integer|min:0',
            'price' => 'required|numeric|min:0',
            'category_id' => 'required|exists:categories,id',
        ]);

        Product::create($data);
        return redirect()->route('products.index')->with('ok', 'Producto guardado correctamente');
    }

    // OPCION4: formulario filtro
    public function filterForm()
    {
        return view('products.filter');
    }

    // OPCION4: resultados filtro (ejemplo simple)
    public function filterResults(Request $request)
    {
        $request->validate([
            'criterion' => 'required|in:low_stock,stock_gt_10,price_lt_20',
        ]);

        $q = Product::with('category');

        if ($request->criterion === 'low_stock') {
            $q->where('stock', '<=', 5);
        } elseif ($request->criterion === 'stock_gt_10') {
            $q->where('stock', '>', 10);
        } else { // price_lt_20
            $q->where('price', '<', 20);
        }

        $products = $q->orderBy('id')->get();
        return view('products.index', compact('products'));
    }

    // OPCION5: pantalla “gestión” (elige y accede a editar/borrar)
    public function manage()
    {
        $products = Product::with('category')->orderBy('id')->get();
        return view('products.manage', compact('products'));
    }

    public function edit(Product $product)
    {
        $categories = Category::orderBy('name')->get();
        return view('products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, Product $product)
    {
        $data = $request->validate([
            'description' => 'required|min:3',
            'stock' => 'required|integer|min:0',
            'price' => 'required|numeric|min:0',
            'category_id' => 'required|exists:categories,id',
        ]);

        $product->update($data);
        return redirect()->route('products.manage')->with('ok', 'Producto actualizado');
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('products.manage')->with('ok', 'Producto borrado');
    }
}


EOF


RUN <<'EOF' cat > app/Http/Controllers/CategoryController.php
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class CategoryController extends Controller
{
    //  Muestra el formulario de creación
    public function create()
    {
        // Devuelve la vista donde estará el formulario
        return view('categories.create');
    }

    // Guarda la nueva categoría en la base de datos
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255|unique:categories,name',
        ]);

        Category::create($data);

        // Redirige al listado de productos o a donde prefieras
        return redirect()->route('products.index')->with('ok', 'Categoría creada correctamente');
    }
}

EOF
# Vistas
# #home por  defecto

RUN <<'EOF' cat > resources/views/home.blade.php
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

EOF


































RUN mkdir resources/views/products
RUN mkdir resources/views/categories
WORKDIR /opt/lampp/htdocs/Tienda/resources/views/products
RUN <<'EOF' cat > create.blade.php
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

EOF

RUN <<'EOF' cat > index.blade.php
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

EOF

RUN <<'EOF' cat > filter.blade.php
@extends('layouts.app')
@section('title', 'Listado filtrado')
@section('content')

<h1 class="glitch-title">Filtrar productos</h1>
<div class="cyber-form-group">

  <form method="GET" action="{{ route('products.filter.results') }}">
  <div class="cyber-form-group">
  <label class="form-label">Criterio</label>
  <select class="cyber-input" name="criterion">
  <option value="low_stock">Stock bajo (<= 5)</option>
  <option value="stock_gt_10">Stock alto (> 10)</option>
  <option value="price_lt_20">Precio barato (< 20)</option>
  </select>
  </div>
  <button class="btn btn-primary">Aplicar filtro</button>
  </form>
</div>
@endsection

EOF


RUN <<'EOF' cat > manage.blade.php
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


EOF

RUN <<'EOF' cat > edit.blade.php
@extends('layouts.app')
@section('title', 'Editar producto')
@section('content')
<h1 class="glitch-title">Editar producto #{{ $product->id }}</h1>
<form method="POST" action="{{ route('products.update', $product) }}">
@csrf
@method('PUT')

<div class="cyber-form-group">
<label class="form-label">Descripción</label>
<input class="cyber-input" name="description" value="{{ old('description', $product->description) }}">
</div>
<div class="cyber-form-group">
<label class="form-label">Stock</label>
<input class="cyber-input" type="number" name="stock" value="{{ old('stock', $product->stock) }}">
</div>
<div class="cyber-form-group">
<label class="form-label">Precio</label>
<input class="cyber-input" type="number" step="0.01" name="price" value="{{ old('price', $product->price) }}">
</div>
<div class="cyber-form-group">
<label class="form-label">Categoría</label>
<select class="cyber-input" name="category_id">
@foreach($categories as $c)
<option value="{{ $c->id }}" @selected(old('category_id', $product->category_id) == $c->id)>
{{ $c->name }}
</option>
@endforeach
</select>
</div>
<button class="cyber-button-alt">Guardar cambios</button>
</form>
@endsection


EOF


WORKDIR /opt/lampp/htdocs/Tienda/resources/views/categories

RUN <<'EOF' cat > create.blade.php
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

EOF


WORKDIR /opt/lampp/htdocs/Tienda


EXPOSE 8000

# Comando por defecto
# CMD ["/bin/bash"]
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]
