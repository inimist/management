<?php $__env->startSection('content'); ?>
	<p><a href="<?php echo e(route('places.create')); ?>" class="btn btn-success">Create Place</a></p>
	
	<?php echo e(Form::model($model, ['route' => 'places.index', 'method' => 'GET'])); ?>

		<div class="form-group form-inline">
			<?php echo e(Form::label('q', 'Keyword: ')); ?>

			<?php echo e(Form::text('q', null, ['class' => 'form-control'])); ?>

			<?php echo e(Form::submit('Search', ['class' => 'btn btn-primary'])); ?>

		</div>
	<?php echo e(Form::close()); ?>

		
	<?php if(count($places)): ?>
		<br />
		<?php if($view == 'review'): ?>
			<h4>Places pending review</h4>
		<?php else: ?>
			<h4>Places matching query</h4>
		<?php endif; ?>
		<br />
		<table class="table">
			<tr>
				<th>Name</th>
				<th>Street</th>
				<th>City</th>
				<th>State</th>
				<th>Zip</th>
			</tr>
		<?php $__currentLoopData = $places; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $place): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
			<tr>
				<td><a href="<?php echo e(route('places.show', ['id' => $place->id])); ?>"><?php echo e($place->name); ?></a></td>
				<?php if(isset($place->address)): ?>
					<td><?php echo e($place->address->street1); ?></td>
					<td><?php echo e($place->address->city); ?></td>
					<td><?php echo e($place->address->state); ?></td>
					<td><?php echo e($place->address->zip); ?></td>
				<?php else: ?>
					<td colspan="4">&nbsp;</td>
				<?php endif; ?>
			</tr>
		<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
		</table>
	<?php elseif(!empty($places)): ?>
		<p>No results matched your search</p>
	<?php endif; ?>
	
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>