<?php $__env->startSection('content'); ?>

    <h1>Create New Filter</h1>

    <?php echo e(Form::open(['route' => 'filters.store'])); ?>


    <div class="form-group">
        <?php echo e(Form::label('name', 'Name')); ?>

        <?php echo e(Form::text('name', null, ['class' => 'form-control'])); ?>

        (abbreviated for mobile)
    </div>

    <div class="form-group">
        <?php echo e(Form::label('fullName', 'Full Name')); ?>

        <?php echo e(Form::text('fullName', null, ['class' => 'form-control'])); ?>

    </div>

    <div class="form-group">
        <?php echo e(Form::label('values', 'Values')); ?> (one per line)
        <?php echo e(Form::textarea('values', null, ['class' => 'form-control'])); ?>

    </div>

    <?php echo e(Form::submit('Save', ['class' => 'btn btn-primary'])); ?>


    <?php echo e(Form::close()); ?>


<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>