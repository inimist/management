<?php $__env->startSection('content'); ?>


    <?php if(count($feed) > 0): ?>
        <p><a href="<?php echo e(route('accounts.show', ['id' => $feed[0]->user->id])); ?>" class="btn btn-default">Back to User</a></p>
        <h1>Posts by <?php echo e($feed[0]->user->displayName); ?></h1>
    <?php else: ?>
        No posts
    <?php endif; ?>

    <table class="table">
        <tr>
            <th>Category</th>
            <th>Date</th>
            <th>Description</th>
            <th>Post</th>
            <th># Envies</th>
            <th># Comments</th>
            <th>Place</th>
            <th>Features</th>
        </tr>
        <?php $__currentLoopData = $feed; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
            <tr>


                <td><?php echo e($post->category->name); ?></td>
                <td> <?php
                    $timestamp = strtotime($post->created);
                    print date('Y-m-d h:i A', $timestamp );
                    ?> </td>
                <td><?php echo e($post->object->description); ?></td>
                <td><?php echo e(number_format($post->object->numEnvies)); ?></td>
                <td><?php echo e(number_format($post->object->numComments)); ?></td>
                
                
                
                
                
                
                
                
                <td>
                    <a href="<?php echo e(route('places.show', ['id' => $post->place->id ])); ?>"><?php echo e($post->place->name); ?></a>
                    <?php if(isset($post->place->address)): ?>
                        (<?php echo e($post->place->address->city); ?>

                        <?php echo e($post->place->address->state); ?>)
                    <?php endif; ?>
                </td>
                <td>
                    <?php if(isset($post->features)): ?>
                        <?php if(isset($post->features->uber) && $post->features->uber): ?>
                            Uber
                        <?php endif; ?>
                        <?php if(isset($post->features->fare) && $post->features->fare): ?>
                            Fare
                        <?php endif; ?>
                    <?php else: ?>
                        N/A
                    <?php endif; ?>
                </td>
            </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
    </table>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>