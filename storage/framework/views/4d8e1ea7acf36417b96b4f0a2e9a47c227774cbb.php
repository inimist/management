<?php $__env->startSection('content'); ?>
    <p><a href="<?php echo e(route('filters.create')); ?>" class="btn btn-success">Create Filter</a></p>

    <?php if(count($filters)): ?>
        <table class="table">
        <?php $__currentLoopData = $filters; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $filter): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
            <tr><td>
                <a href="<?php echo e(route('filters.show', ['id' => $filter->id])); ?>">
                    <?php if(isset($filter->fullName)): ?>
                        <?php echo e($filter->fullName); ?>

                    <?php else: ?>
                        <?php echo e($filter->name); ?>

                    <?php endif; ?>
                </a>
            </td></tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
        </table>
    <?php elseif(!empty($filters)): ?>
        <p>There are not currently any filters configured.</p>
    <?php endif; ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>