<?php $__env->startSection('content'); ?>
    <form method="get">
        <?php echo e(Form::label('search', 'Username: ')); ?> <input type="text" name="q" id="keyword" value="<?php echo e($keyword); ?>" onkeyup="updateResults();" /> <span id="keyword-status"></span>
        <input type="submit" class="btn btn-primary" value="Search" />
    </form>

    <?php if(count($accounts)): ?>
        <h1>Search Results</h1>
        <table class="table">
            <tr>
                <th>Name</th>
                
                
                <th># Followers</th>
                <th># Following</th>
            </tr>
            <?php $__currentLoopData = $accounts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $account): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                <tr>
                    <td>
                        <a href="<?php echo e(route('accounts.show', $account->id)); ?>">
                        <?php if($account->profileImageUrl): ?>
                            <img src="<?php echo e($account->profileImageUrl); ?>" width="50" />
                        <?php endif; ?>
                        <?php echo e($account->name); ?>

                        </a>
                    </td>


                    <td><?php echo e(number_format($account->stats->numFollowers)); ?></td>
                    <td><?php echo e(number_format($account->stats->numFollowing)); ?></td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
        </table>
    <?php else: ?>
        <?php if (! (empty($keyword))): ?>
            No results available
        <?php endif; ?>
    <?php endif; ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>