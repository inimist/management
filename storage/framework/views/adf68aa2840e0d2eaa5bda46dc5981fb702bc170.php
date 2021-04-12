<?php $__env->startSection('content'); ?>
	<p><a href="<?php echo e(route('categories.index')); ?>" class="btn btn-default">Back to Search</a> <a href="<?php echo e(route('categories.create')); ?><?php if($category): ?>?parentid=<?php echo e($category->id); ?><?php endif; ?>" class="btn btn-success">Create Category</a></p>

	<?php if($category): ?>

		<p><a href="<?php echo e(route('categories.browse')); ?>" class="badge">Root</a>
		<?php if(isset($category->hierarchy)): ?>
			<?php $__currentLoopData = $category->hierarchy; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $parent): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
			<i class="glyphicon glyphicon-chevron-right"></i> <a href="<?php echo e(route('categories.browse')); ?>?category=<?php echo e($parent->id); ?>" class="badge"><?php echo e($parent->name); ?></a>
			<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
		<?php else: ?>

		<?php endif; ?>
		</p>

		<h1><?php if($category->enable === false): ?><span class="text-danger"><?php endif; ?><?php echo e($category->name); ?> <?php if($category->enable === false): ?></span> (disabled)<?php endif; ?>
			<a href="<?php echo e(route('categories.edit', ['id' => $category->id])); ?>" class="btn btn-primary">Edit</a>
			<a href="<?php echo e(route('categories.show', ['id' => $category->id])); ?>" class="btn btn-primary">View</a>
			<a href="<?php echo e(route('categories.posts', ['id' => $category->id])); ?>" class="btn btn-default">Posts</a>
			<?php if (! (count($categories))): ?>
				<?php echo e(Form::open(['style' => 'display:inline-block;', 'method' => 'DELETE', 'action' => ['CategoriesController@destroy', $category->id], 'onsubmit' => 'return confirm(\'Are you sure you want to delete this category?  This is irreversible.\');'])); ?>

				<input type="submit" value="Delete" class="btn btn-danger" />
				<?php echo e(Form::close()); ?>

			<?php endif; ?>
		</h1>
		<?php if(count($categories)): ?>
			<span class="text-danger" style="font-size:1.2rem;font-weight:normal;">This category cannot be deleted because it has sub-categories.</span>
		<?php endif; ?>
	<?php endif; ?>

	<?php if(count($categories)): ?>
		<table class="table">
			<tr>
				<th>Name</th>
				<th>Display Name</th>
				<th>Type</th>
				<th>&nbsp;</th>
			</tr>
		<?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
			<tr>
				<td <?php if($category->enable === false): ?> class="bg-danger" style="text-decoration:line-through"<?php endif; ?>><a href="<?php echo e(route('categories.browse')); ?>?category=<?php echo e($category->id); ?>"><?php echo e($category->name); ?></a></td>
				<td <?php if($category->enable === false): ?> class="bg-danger" style="text-decoration:line-through"<?php endif; ?>><a href="<?php echo e(route('categories.browse')); ?>?category=<?php echo e($category->id); ?>"><?php echo e($category->displayName); ?></a></td>
				<td <?php if($category->enable === false): ?> class="bg-danger" style="text-decoration:line-through"<?php endif; ?>><?php echo e(isset($category->type) ? $category->type : ''); ?></td>
				<td <?php if($category->enable === false): ?> class="bg-danger"<?php endif; ?>>
					
					<a href="<?php echo e(route('categories.edit', ['id' => $category->id ])); ?>" class="btn btn-primary">Edit</a>
				</td>
			</tr>
		<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
		</table>
	<?php else: ?>
		<p>No sub categories.</p>
	<?php endif; ?>
	
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>