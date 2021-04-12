<?php $__env->startSection('content'); ?>
	<p>
		<a href="<?php echo e(action('PlacesController@index')); ?>" class="btn btn-default">Back to Places</a>
		<a href="<?php echo e(route('places.posts', ['id' => $place->id])); ?>" class="btn btn-default">Posts</a>
	</p>
	
	<h1><?php echo e($place->name); ?> 
		<a href="<?php echo e(action('PlacesController@edit', ['id' => $place->id ])); ?>" class="btn btn-primary">Edit</a>

	<?php if(isset($place->createdBy)): ?>
				<?php echo e(Form::open(['style' => 'display:inline-block;', 'method' => 'DELETE', 'action' => ['PlacesController@destroy', $place->id], 'onsubmit' => 'return confirm(\'Are you sure you want to delete this place?  This is irreversible.\');'])); ?>

				<input type="submit" value="Delete" class="btn btn-danger" />
				<?php echo e(Form::close()); ?>

	<?php endif; ?>
				
					</h1>
	<p><strong>Type: </strong> <?php echo e($place->type); ?></p>
	<p><strong>Phone: </strong> <?php echo e($place->phone); ?></p>
	<p><strong>Website: </strong> <?php echo e($place->website); ?></p>
	<p><strong>Reservation Website: </strong> <?php echo e($place->reservationWebsite); ?></p>

	<?php if($place->reviewStatus): ?>
		<p><strong>Review Status: </strong> <?php echo e($place->reviewStatus); ?></p>
	<?php endif; ?>

	<?php if(isset($place->createdBy)): ?>
		<p>
			<strong>Created by:</strong>
			<a href="<?php echo e(action('AccountsController@show', ['id' => $place->createdBy ])); ?>" target="_blank">user profile</a>
		</p>
	<?php endif; ?>

	<?php if(isset($place->categoryId)): ?>
		<p>
			<strong>Category:</strong>
			<a href="<?php echo e(action('CategoriesController@show', ['id' => $place->categoryId ])); ?>" target="_blank">see category</a>
		</p>
	<?php endif; ?>

	<h2>Address:</h2>
	<?php if(isset($place->address)): ?>
		<div class="list-group">
			<div class="list-group-item">
				<p><?php echo e($place->address->street1); ?><br />
				<?php if (! (empty($place->address->street2))): ?>
					<?php echo e($place->address->street2); ?><br />
				<?php endif; ?>
				<?php echo e($place->address->city); ?>, <?php echo e($place->address->state); ?> <?php echo e(isset($place->address->zip) ? $place->address->zip : ''); ?></p>
			</div>
		</div>
	<?php else: ?>
		<p>None</p>
	<?php endif; ?>
	
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>