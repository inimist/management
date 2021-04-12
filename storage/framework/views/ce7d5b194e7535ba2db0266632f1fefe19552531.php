<?php $__env->startSection('content'); ?>


    <p>
        <a href="<?php echo e(route('places.show', ['id' => $place->id])); ?>" class="btn btn-default">Back to Place</a>
        <a href="<?php echo e(route('posts.create', ['placeId' => $place->id])); ?>" class="btn btn-primary">Add Post</a>
    </p>

    <?php if(count($feed) > 0): ?>
        <h1>Posts for <?php echo e($place->name); ?></h1>
    <?php else: ?>
        No posts
    <?php endif; ?>

    <table class="table">
        <tr>
            <th>User</th>
            <th>Category</th>
            <th>Post</th>
            <th># Envies</th>
            <th># Comments</th>
            <th>Features</th>
            <th>View</th>
        </tr>
        <?php $__currentLoopData = $feed; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
            <tr>
                <td>
                    <?php if(isset($post->user->id) && !empty($post->user->id)): ?><a href="<?php echo e(route('accounts.show', ['id' => $post->user->id])); ?>"><?php endif; ?>
                        <?php echo e($post->user->displayName); ?>

                    <?php if(isset($post->user->id) && !empty($post->user->id)): ?></a><?php endif; ?>
                </td>
                <td><a href="<?php echo e(route('categories.show', ['id' => $post->category->id])); ?>"><?php echo e($post->category->name); ?></a></td>
                <td><?php echo e($post->object->description); ?></td>
                <td><?php echo e(number_format($post->object->numEnvies)); ?></td>
                <td><?php echo e(number_format($post->object->numComments)); ?></td>
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
                <td>
                    <a href="<?php echo e(route('posts.show', ['id' => $post->object->id])); ?>" class="btn btn-default">View</a>
                </td>
            </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
    </table>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>