<?php $__env->startSection('title', 'Listado filtrado'); ?>
<?php $__env->startSection('content'); ?>

<h1 class="glitch-title">Filtrar productos</h1>
<div class="cyber-form-group">

  <form method="GET" action="<?php echo e(route('products.filter.results')); ?>">
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
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /opt/lampp/htdocs/Tienda/resources/views/products/filter.blade.php ENDPATH**/ ?>