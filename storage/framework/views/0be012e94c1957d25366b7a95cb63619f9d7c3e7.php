<?php $__env->startSection('content'); ?>

	<h1>Login</h1>

	<?php if(isset($login_error)): ?>
		<div class="alert alert-warning"><?php echo e($login_error); ?></div>
	<?php endif; ?>

	<?php echo e(Form::open()); ?>

	<?php echo e(Form::token()); ?>


	<div class="form-group">
		<?php echo e(Form::label('email', 'Email: ')); ?>

		<?php echo e(Form::text('email', null, ['class' => 'form-control'])); ?>

	</div>

	<div class="form-group">
		<?php echo e(Form::label('password', 'Password: ')); ?>

		<?php echo e(Form::password('password', null, ['class' => 'form-control'])); ?>

	</div>

	<div class="form-group">
		<?php echo e(Form::submit('Login')); ?>

	</div>

	<?php echo e(Form::close()); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>