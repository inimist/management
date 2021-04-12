<?php $__env->startSection('head'); ?>
	<script type="text/javascript">
	var updating = {};

	function updateCategoryFilter(btn) {
		var $btn = $(btn);
		if (updating[$btn]) return;

		updating[$btn] = true;
		$btn.text('Updating...');
		var $form = $btn.parents('form');
		var $values = $form.find('.filter-value');
		$btn.text('Updating');

		var values = [];
		$values.filter(function() { return ($(this).is(':checked')); }).map(function() {
			values.push($(this).val());
		});
console.log('values', values);
		$.ajax({
			url: $form.attr('action'),
			method: $form.attr('method'),
			data: {
				values: values,
				_token: '<?php echo e(csrf_token()); ?>'
			},
//			dataType: 'json',
			error: function(data) {
				delete updating[$btn];

				console.log('Failed: ', data);
				$btn.text('Failed, Try Again');
			},
			success: function(data) {
				console.log('Success: ', data);
				$btn.text('Done');
				setTimeout(function() {
					$btn.text('Update');
					delete updating[$btn];
				}, 1000);
			}
		});
	}
	</script>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>

	<p><a href="<?php echo e(route('categories.browse')); ?>" class="badge">Root</a>
	<?php if(isset($category->hierarchy)): ?>
		<?php $__currentLoopData = $category->hierarchy; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $parent): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
		<i class="glyphicon glyphicon-chevron-right"></i> <a href="<?php echo e(route('categories.browse', ['category' => $parent->id])); ?>" class="badge"><?php echo e($parent->name); ?></a>
		<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
	<?php endif; ?>
	</p>

	<h1>
		<?php if($category->enable === false): ?><span class="text-danger"><?php endif; ?><?php echo e($category->name); ?> <?php if($category->enable === false): ?></span> (disabled)<?php endif; ?>
		<a href="<?php echo e(route('categories.edit', ['id' => $category->id ])); ?>" class="btn btn-primary">Edit</a>
			<a href="<?php echo e(route('categories.posts', ['id' => $category->id])); ?>" class="btn btn-default">Posts</a>
	</h1>

	<?php if(isset($category->type)): ?>
		<p><strong>Type:</strong> <?php echo e($category->type); ?></p>
	<?php endif; ?>


	<h2>
		<?php if(isset($category->type) && $category->type == 'Virtual'): ?>
			Filter Values
		<?php else: ?>
			Filters
		<?php endif; ?>

		<?php if(isset($category->type) && $category->type == 'Primary'): ?>
			<a href="<?php echo e(route('categories.filtersIndex', ['categoryId' => $category->id])); ?>" class="btn btn-info">Manage</a>
		<?php endif; ?>
	</h2>

	<?php if(isset($category->filters) && count($category->filters) > 0): ?>
		<ul>
			<?php $__currentLoopData = $category->filters; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $filter): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
				<li><strong><?php echo e($filter->name); ?></strong>
					<?php if($category->type && $category->type != 'Primary'): ?>
						<br />
						<form action="<?php echo e(route('categories.setFilterValue', ['categoryId' => $category->id, 'filterId' => $filter->id])); ?>" method="post">
						<?php $__currentLoopData = $filter->possibleValues; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
							<label><input type="checkbox" name="values[]" class="filter-value" value="<?php echo e($value); ?>" <?php if(in_array($value, $filter->values)): ?> checked="true" <?php endif; ?> /> <?php echo e($value); ?></label><br />
						<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
						<input type="submit" class="btn btn-info" value="Update" />
						</form>
					<?php endif; ?>
				</li>
			<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
		</ul>

	<?php endif; ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>