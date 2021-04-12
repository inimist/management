<?php $__env->startSection('content'); ?>
	
	<h1>Create New Place</h1>
	
	<?php echo e(Form::open(['route' => 'places.store'])); ?>

	
	<div class="form-group">
		<?php echo e(Form::label('name', 'Name')); ?>

		<?php echo e(Form::text('name', '', ['class' => 'form-control'])); ?>

	</div>
	<div class="form-group">
		<?php echo e(Form::label('type', 'Type')); ?>

		<?php echo e(Form::select('type', $types, null, ['class' => 'form-control'])); ?>

	</div>
	<div class="form-group">
		<?php echo e(Form::label('type', 'Review Status')); ?>

		<?php echo e(Form::select('reviewStatus', $reviewStatuses, 'Approved', ['class' => 'form-control'])); ?>

	</div>
	<div class="form-group">
		<?php echo e(Form::label('street1', 'Street 1')); ?>

		<?php echo e(Form::text('street1', '', ['class' => 'form-control'])); ?>

	</div>
	<div class="form-group">
		<?php echo e(Form::label('street2', 'Street 2')); ?>

		<?php echo e(Form::text('street2', '', ['class' => 'form-control'])); ?>

	</div>
	<div class="form-group">
		<?php echo e(Form::label('city', 'City')); ?>

		<?php echo e(Form::text('city', '', ['class' => 'form-control'])); ?>

	</div>
	<div class="form-group">
		<?php echo e(Form::label('state', 'State')); ?>

		<?php echo e(Form::text('state', '', ['class' => 'form-control'])); ?>

	</div>
	<div class="form-group">
		<?php echo e(Form::label('zip', 'Zip')); ?>

		<?php echo e(Form::text('zip', '', ['class' => 'form-control'])); ?>

	</div>
	<div class="form-group">
		<?php echo e(Form::label('phone', 'Phone')); ?>

		<?php echo e(Form::text('phone', '', ['class' => 'form-control'])); ?>

	</div>
	<div class="form-group">
		<?php echo e(Form::label('website', 'Website')); ?>

		<?php echo e(Form::text('website', '', ['class' => 'form-control'])); ?>

	</div>
	<div class="form-group">
		<?php echo e(Form::label('reservationWebsite', 'Reservation Website')); ?>

		<?php echo e(Form::text('reservationWebsite', '', ['class' => 'form-control'])); ?>

	</div>
	<div class="form-group">
		<?php echo e(Form::label('searchMetaData', 'Search Meta Data')); ?>

		<?php echo e(Form::text('searchMetaData', '', ['class' => 'form-control'])); ?>

	</div>
	<div class="form-group">
		<?php echo e(Form::label('categoryId', 'Category Id')); ?>

		<?php echo e(Form::text('categoryId', isset($place->categoryId) ? $place->categoryId : '', ['class' => 'form-control'])); ?>

	</div>

	<div class="form-inline">
		<div class="form-group">
			<?php echo e(Form::label('latitude', 'Latitude')); ?>

			<?php echo e(Form::text('latitude', '', ['class' => 'form-control'])); ?>

		</div>
		<div class="form-group">
			<?php echo e(Form::label('longitude', 'Longitude')); ?>

			<?php echo e(Form::text('longitude', '', ['class' => 'form-control'])); ?>

		</div>
	</div>

	<?php echo e(Form::submit('Save', ['class' => 'btn btn-primary'])); ?>

	
	<?php echo e(Form::close()); ?>

	
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>