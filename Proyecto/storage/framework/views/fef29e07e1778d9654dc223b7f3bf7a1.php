<?php $__env->startSection('title', 'Modificar / Borrar'); ?>
<?php $__env->startSection('content'); ?>
<h1 class="glitch-title">Gestionar productos</h1>
<table class="cyber-table">
<thead>
<tr>
<th>ID</th><th>Descripción</th><th>Categoría</th><th>Acciones</th>
</tr>
</thead>
<tbody>
<?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<tr>
<td><?php echo e($p->id); ?></td>
<td><?php echo e($p->description); ?></td>
<td><?php echo e($p->category?->name); ?></td>
<td>
<!-- Usamos nuestras clases de botón -->
<a class="cyber-button-alt warning" href="<?php echo e(route('products.edit', $p)); ?>">Editar</a>
<form method="POST" action="<?php echo e(route('products.destroy', $p)); ?>" style="display:inline;">
<?php echo csrf_field(); ?>
<?php echo method_field('DELETE'); ?>
<button class="cyber-button-alt danger" onclick="return confirm('¿Borrar producto?')">
Borrar
</button>
</form>
</td>
</tr>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</tbody>
</table>
<?php $__env->stopSection(); ?>



<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /opt/lampp/htdocs/Tienda/resources/views/products/manage.blade.php ENDPATH**/ ?>