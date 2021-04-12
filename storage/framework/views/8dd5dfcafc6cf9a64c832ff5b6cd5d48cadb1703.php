<?php $__env->startSection('content'); ?>

    <h1>Flagged Content</h1>

    <table class="table">
        <tr>
            <th>Date</th>
            <th>Object Type</th>
            <th>Object ID</th>
            <th>Flagged By</th>
            <th>Status</th>
            <th>&nbsp;</th>
            
        </tr>
        <?php $__currentLoopData = $flags; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $flag): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
            <tr>
                <td><?php echo e((new \Carbon\Carbon($flag->created))->format('m/d/Y H:iA')); ?></td>
                <td><?php echo e($flag->objectType); ?></td>
                <td><?php echo e($flag->objectId); ?></td>
                <td>
                    <?php if(isset($flag->flagger)): ?>
                        <?php echo e($flag->flagger->name); ?>

                    <?php else: ?>
                        Unknown
                    <?php endif; ?>
                </td>
                <td><?php echo e($flag->status); ?></td>
                <td>
                    <?php if($flag->objectType == 'post'): ?>
                        <a href="<?php echo e(route('posts.show', ['id' => $flag->objectId])); ?>" class="btn btn-default">View Post</a>
                    <?php endif; ?>
                </td>
            </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
    </table>

    <?php echo $__env->make('partials/pager', [
        'offset' => $offset,
        'limit' => $limit,
        'total' => $total,
        'link' => route('flags.index')
    ], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>