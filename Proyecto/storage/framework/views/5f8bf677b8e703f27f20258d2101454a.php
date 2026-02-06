<?php $__env->startSection('title', 'Entrada de datos'); ?>
<?php $__env->startSection('content'); ?>
<!-- Contenido del formulario de alta de producto -->
<h1 class="glitch-title">Alta de producto</h1>

<form method="POST" action="<?php echo e(route('products.store')); ?>">
    <?php echo csrf_field(); ?>

    <div class="cyber-form-group">
        <label>Producto</label>
        <input class="cyber-input" name="name" value="<?php echo e(old('name')); ?>">
    </div>

    <div class="cyber-form-group">
        <label class="form-label">Stock</label>
        <input class="cyber-input" type="number" name="stock" value="<?php echo e(old('stock', 0)); ?>">
    </div>

    <div class="cyber-form-group">
        <label class="form-label">Precio</label>
        <input class="cyber-input" type="number" step="0.01" name="price" value="<?php echo e(old('price', 0)); ?>">
    </div>

    <div class="cyber-form-group">
        <label class="form-label">Categoría</label>
        <select class="cyber-input" name="category_id">
            <option value="">-- elige --</option>
            <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($c->id); ?>" <?php if(old('category_id') == $c->id): echo 'selected'; endif; ?>>
                    <?php echo e($c->name); ?>

                </option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
    </div>

    <div class="cyber-form-group">
        <label class="form-label">Proveedor</label>
        <select class="cyber-input" name="provider_id">
            <option value="">-- elige --</option>
            <?php $__currentLoopData = $providers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($p->id); ?>" <?php if(old('provider_id') == $p->id): echo 'selected'; endif; ?>>
                    <?php echo e($p->name); ?>

                </option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
    </div>

    <button class="cyber-button-alt">Guardar</button>
</form>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /opt/lampp/htdocs/Tienda/resources/views/products/create.blade.php ENDPATH**/ ?>