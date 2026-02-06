<?php $__env->startSection('title', 'Crear Categoría'); ?>

<?php $__env->startSection('content'); ?>
    <h1 class="glitch-title">Crear Nueva Categoría</h1>

    <!-- Notificaciones de error específicas para este formulario -->
    <?php if($errors->any()): ?>
        <div class="cyber-alert danger">
            <ul>
                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li><?php echo e($error); ?></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        </div>
    <?php endif; ?>

    <form method="POST" action="<?php echo e(route('categories.store')); ?>">
        <?php echo csrf_field(); ?>

        <div class="cyber-form-group">
            <label for="name">NOMBRE DE LA CATEGORÍA:</label>
            <!-- Mantiene el valor anterior si hubo un error de validación -->
            <input type="text" name="name" id="name" class="cyber-input" value="<?php echo e(old('name')); ?>" required>
        </div>

        <button type="submit" class="cyber-button-alt">Guardar Categoría</button>
    </form>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /opt/lampp/htdocs/Tienda/resources/views/categories/create.blade.php ENDPATH**/ ?>