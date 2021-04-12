<?php $__env->startSection('content'); ?>
    <p><a href="<?php echo e(route('filters.index')); ?>">Back to Filters</a></p>

    <h1>
        <?php if(isset($filter->fullName)): ?>
            <?php echo e($filter->name); ?>

        <?php else: ?>
            <?php echo e($filter->name); ?>

        <?php endif; ?>
        <a href="<?php echo e(route('filters.edit', ['id' => $filter->id ])); ?>" class="btn btn-primary">Edit</a>
    </h1>

    <?php if(isset($filter->fullName)): ?>
    <p><strong>Full:</strong> <?php echo e($filter->fullName); ?></p>
    <?php endif; ?>

    <p><strong>Name:</strong> <?php echo e($filter->name); ?></p>

    <p><strong>Slug:</strong> <?php echo e($filter->slug); ?></p>

    <p><strong>Values: </strong><br />
        <?php if(count($filter->values) > 0): ?>
            <ul>
                <?php $__currentLoopData = $filter->values; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                    <li><?php echo e($value); ?></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
            </ul>
        <?php else: ?>
                No values
        <?php endif; ?>
    </p>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>