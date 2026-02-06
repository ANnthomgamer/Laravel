<?php $__env->startSection('title', 'Listado general'); ?>
<?php $__env->startSection('content'); ?>
<div class="bg-white p-4 rounded shadow-sm">
<h2>Productos</h2>
<table class="table table-striped">
<thead>
<tr>
  <th>ID</th>
  <th>Producto</th>
  <th>Stock</th>
  <th>Precio</th>
  <th>Categoría</th>
  <th>Proveedor</th>
</tr>
</thead>
<tbody>
<?php $__empty_1 = true; $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
<tr>
<td><?php echo e($p->id); ?></td>
<td><?php echo e($p->name); ?></td>
<td><?php echo e($p->stock); ?></td>
<td><?php echo e(number_format($p->price, 2)); ?></td>
<td><?php echo e($p->category?->name); ?></td>
<td><?php echo e($p->provider?->name ?? 'N/A'); ?></td>
</tr>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
<tr><td colspan="5">No hay productos.</td></tr>
<?php endif; ?>
</tbody>
</table>
</div>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /opt/lampp/htdocs/Tienda/resources/views/products/index.blade.php ENDPATH**/ ?>