
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title><?php echo $__env->yieldContent('title', 'Inventario'); ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="<?php echo e(asset('css/style.css')); ?>">

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
            <a href="<?php echo e(route('home')); ?>">INICIO</a>
            <a href="<?php echo e(route('products.create')); ?>">ENTRADA DATOS</a>
            <a href="<?php echo e(route('products.index')); ?>">LISTADO GENERAL</a>
            <a href="<?php echo e(route('products.filter.form')); ?>">LISTADO FILTRADO</a>

            <a href="<?php echo e(route('categories.create')); ?>">CREAR CATEGORÍA</a>
	    
	    <a href="<?php echo e(route('providers.create')); ?>">ANADIR PROVEEDOR</a>
	    <a href="<?php echo e(route('providers.index')); ?>">VER PROVEEDOR</a>

            <a href="<?php echo e(route('products.manage')); ?>">MODIFICAR/BORRAR</a>
        </div>
    </nav>

    <main class="cyber-main">
        <!-- Notificaciones de Sistema -->
        <?php if(session('ok')): ?>
            <div class="cyber-alert success"><?php echo e(session('ok')); ?></div>
        <?php endif; ?>

        <?php if($errors->any()): ?>
            <div class="cyber-alert danger">
                <ul>
                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $e): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> 
                        <li><?php echo e($e); ?></li> 
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </div>
        <?php endif; ?>

        <!-- Contenido Dinámico -->
        <div class="content-terminal">
            <?php echo $__env->yieldContent('content'); ?>
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

<?php /**PATH /opt/lampp/htdocs/Tienda/resources/views/layouts/app.blade.php ENDPATH**/ ?>