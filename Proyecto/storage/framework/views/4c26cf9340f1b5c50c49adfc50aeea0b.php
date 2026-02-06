<?php $__env->startSection('title', 'Lista de Proveedores'); ?>

<?php $__env->startSection('content'); ?>
<h2 class="glitch-title" style="color: var(--cp-yellow)">> ACCEDIENDO_A_BASE_DE_DATOS: PROVEEDORES</h2>

<table class="cyber-table">
    <thead>
        <tr>
            <th>ID_SERIAL</th>
            <th>NOMBRE_ENTIDAD</th>
            <th>EMAIL_ENLACE</th>
            <th>REGISTRO</th>
            <th>ACCIONES</th>
        </tr>
    </thead>
    <tbody>

    <tbody>
        <?php $__empty_1 = true; $__currentLoopData = $providers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $provider): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <tr>
                <td>#<?php echo e(str_pad($provider->id, 4, '0', STR_PAD_LEFT)); ?></td>
                <td><?php echo e(strtoupper($provider->name)); ?></td>
                <td><?php echo e($provider->email); ?></td>
                <td><?php echo e($provider->created_at->format('Y-m-d')); ?></td>
                <td>
                    <a href="#" class="cyber-button-alt warning" style="text-decoration: none; padding: 2px 5px; font-size: 0.7rem;">EDITAR</a>
                    
                    
                    <form action="<?php echo e(route('providers.destroy', $provider->id)); ?>" method="POST" style="display:inline;">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('DELETE'); ?>
                        <button type="submit" class="cyber-button-alt danger" style="padding: 2px 5px; font-size: 0.7rem;">BORRAR</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>


            <tr>
                <td colspan="5" style="text-align: center; color: var(--cp-magenta);">[ ADVERTENCIA: NO SE ENCONTRARON REGISTROS EN EL SECTOR ]</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>

<div style="margin-top: 20px;">
    <a href="<?php echo e(route('providers.create')); ?>" class="cyber-button-alt">AÑADIR_NUEVO_NODO</a>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /opt/lampp/htdocs/Tienda/resources/views/providers/index.blade.php ENDPATH**/ ?>