<?php $__env->startSection('content'); ?>
    <p>
        <a href="<?php echo e(route('accounts.show', ['id' => $claim->profile->userId])); ?>" class="btn btn-default">
            Back
        </a>
    </p>
    <?php if(empty($claim)): ?>  
        <table class="table">
            <th>No results</th>
        </table>
    <?php else: ?>
        <table class="table">
            <p><strong> Full name</strong> <?php echo e($claim->claimer->name); ?></p>
            <p><strong> Business Name</strong> <?php echo e($claim->place->name); ?></p>
            <p><strong> Instagram handle</strong> <?php echo e($claim->claimer->insta); ?></p>
            <p><strong> Email</strong> <?php echo e($claim->claimer->email); ?></p>
            <p><strong> Place</strong> <?php echo e($claim->place->name); ?></p>
            <p><strong> Status</strong> <?php echo e($claim->status); ?></p>
            <p><?php echo e(Form::open(['route' => ['accounts.approve'], 'method' => 'post', 'onclick' => 'return confirm(\'Are you sure you want to Approve this user accounts?\');'])); ?>

                <input type="submit" value="Approve" class="btn btn-success" />
                <input type="hidden" name="status" value="Approved"/>
                <input type="hidden" name="email" value="<?php echo e($claim->claimer->email); ?>"/>
                <input type="hidden" name="profileid" value="<?php echo e($claim->profile->userId); ?>"/>
                <input type="hidden" name="token" value="<?php echo e(md5(uniqid(rand(), true))); ?>"/>
            <?php echo e(Form::close()); ?> </p><p>
            <?php echo e(Form::open(['route' => ['accounts.approve'], 'method' => 'post', 'onclick' => 'return confirm(\'Are you sure you want to Decline this user accounts?\');'])); ?>

                <input type="submit" value="Declined" class="btn btn-danger" />
                <input type="hidden" name="status" value="Declined"/>
                <input type="hidden" name="email" value="<?php echo e($claim->claimer->email); ?>"/>
                <input type="hidden" name="profileid" value="<?php echo e($claim->profile->userId); ?>"/>
                <input type="hidden" name="token" value="<?php echo e(md5(uniqid(rand(), true))); ?>"/>
            <?php echo e(Form::close()); ?> </p>
        </table>  
    <?php endif; ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>