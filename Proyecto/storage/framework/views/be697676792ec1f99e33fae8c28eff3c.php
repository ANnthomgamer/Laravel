<?php $__env->startSection('title', 'Panel de Control del Sistema'); ?>

<?php $__env->startSection('content'); ?>
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
        <a href="<?php echo e(route('products.create')); ?>" class="cyber-button-alt">[ NUEVO PRODUCTO ]</a>
        <a href="<?php echo e(route('products.index')); ?>" class="cyber-button-alt">[ VER INVENTARIO ]</a>
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

<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /opt/lampp/htdocs/Tienda/resources/views/home.blade.php ENDPATH**/ ?>