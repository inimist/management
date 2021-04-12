<table class="table table-striped">
<?php $__currentLoopData = $type_grid; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $section => $values): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
    <?php if($section == 'headers'): ?>
        <tr>
            <th>&nbsp;</th>
            <?php $__currentLoopData = $values; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                <th><?php echo e($value); ?></th>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
        </tr>
    <?php elseif($section == 'rows'): ?>

        <?php $__currentLoopData = $values; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $label => $sub_values): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
            <tr>
                <th><?php echo e($label); ?></th>
                <?php $__currentLoopData = $sub_values; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                    <td width="25%"><?php echo e($value); ?></td>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
            </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
    <?php endif; ?>
<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
</table>