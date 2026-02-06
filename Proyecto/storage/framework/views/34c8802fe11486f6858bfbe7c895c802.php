<?php $__env->startSection('title', 'Añadir Proveedor'); ?>

<?php $__env->startSection('content'); ?>
<h2 class="glitch-title" style="color: var(--cp-cyan)">> REGISTRAR_NUEVO_PROVEEDOR</h2>

<form action="<?php echo e(route('providers.store')); ?>" method="POST" class="cyber-form">
    <?php echo csrf_field(); ?>
    <div class="cyber-form-group">
        <label>NOMBRE_DEL_PROVEEDOR:</label>
        <input type="text" name="name" class="cyber-input" required placeholder="Ej: CyberDyne Systems">
    </div>

    <div class="cyber-form-group">
        <label>EMAIL_DE_CONTACTO:</label>
        <input type="email" name="email" class="cyber-input" required placeholder="contacto@red.com">
    </div>

    <button type="submit" class="cyber-button-alt">INICIALIZAR_PROTOCOLO_ALTA</button>
</form>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /opt/lampp/htdocs/Tienda/resources/views/providers/create.blade.php ENDPATH**/ ?>