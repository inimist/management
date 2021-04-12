<?php $__env->startSection('content'); ?>

	<p><a href="<?php echo e(route('categories.index')); ?>">Back to Categories</a></p>

	<h1>Create New Categories</h1>
	
	<?php echo e(Form::open(['route' => 'categories.store'])); ?>


	<div class="row">
		<div class="col-md-4">
			<div class="form-group">
				<?php echo e(Form::label('enable', 'Enabled')); ?>

				<?php echo e(Form::checkbox('enable', null, $enabled)); ?>

			</div>

			<div class="form-group">
				<?php echo e(Form::label('name', 'Name')); ?> (searchable)
				<?php echo e(Form::text('name', null, ['class' => 'form-control'])); ?>

			</div>

			<div class="form-group">
				<?php echo e(Form::label('parentId', 'Parent')); ?>

				<?php echo e(Form::select('parentId', $categories, $parent_id, ['class' => 'form-control'])); ?>

			</div>

			<div class="form-group">
				<?php echo e(Form::label('type', 'Type')); ?>

				<?php echo e(Form::select('type', $types, null, ['class' => 'form-control'])); ?>

			</div>

			<div class="form-group">
				<?php echo e(Form::label('displayName', 'Display Name')); ?> (not searchable)
				<?php echo e(Form::text('displayName', null, ['class' => 'form-control'])); ?>

			</div>

			<div class="form-group">
				<?php echo e(Form::label('pluralName', 'Plural Name')); ?> (searchable)
				<?php echo e(Form::text('pluralName', null, ['class' => 'form-control'])); ?>

			</div>

			<div class="form-group">
				<?php echo e(Form::label('aliases', 'Aliases')); ?> (one per line, searchable)
				<?php echo e(Form::textarea('aliases', null, ['class' => 'form-control'])); ?>

			</div>

			<div class="form-group">
				<?php echo e(Form::label('searchMetaData', 'Search Meta Data')); ?>

				<?php echo e(Form::text('searchMetaData', null, ['class' => 'form-control'])); ?>

			</div>

			<div class="form-group">
				<?php echo e(Form::label('flags', 'Featured')); ?> (aka &quot;Popular&quot;)
				<?php echo e(Form::checkbox('featured', null, $featured)); ?>

			</div>

			<div class="form-group">
				<?php echo e(Form::label('flags', 'Exclude Feed Search')); ?>

				<?php echo e(Form::checkbox('excludeFeedSearch', null, $exclude_feed_search)); ?>

			</div>

			<?php echo e(Form::submit('Save', ['class' => 'btn btn-primary'])); ?>


		</div>
		<div class="col-md-8">
			<h2>Type Info</h2>
			<?php echo $__env->make('categories.partials.typedescription', array('type_grid' => $type_grid), array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
		</div>
	</div>

	<?php echo e(Form::close()); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>