<?php
  //  $logo=asset(Storage::url('uploads/logo/'));
    $logo=\App\Models\Utility::get_file('uploads/logo');
 $company_logo=Utility::getValByName('company_logo');
?>
<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Forgot Password')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('auth-topbar'); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="">
        <h2 class="mb-3 f-w-600"><?php echo e(__('Reset Password')); ?></h2>
    </div>
    <?php echo e(Form::open(array('route'=>'password.update','method'=>'post','id'=>'loginForm'))); ?>

    <input type="hidden" name="token" value="<?php echo e($request->route('token')); ?>">
    <div class="">
        <div class="form-group mb-3">
            <?php echo e(Form::label('email',__('E-Mail Address'),['class'=>'form-label'])); ?>

            <?php echo e(Form::text('email',null,array('class'=>'form-control'))); ?>

            <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
            <span class="invalid-email text-danger" role="alert">
                        <strong><?php echo e($message); ?></strong>
                    </span>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>
        <div class="form-group mb-3">
            <?php echo e(Form::label('password',__('Password'),['class'=>'form-label'])); ?>

            <?php echo e(Form::password('password',array('class'=>'form-control'))); ?>

            <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
            <span class="invalid-password text-danger" role="alert">
                        <strong><?php echo e($message); ?></strong>
                    </span>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>
        <div class="form-group mb-3">
            <?php echo e(Form::label('password_confirmation',__('Password Confirmation'),['class'=>'form-label'])); ?>

            <?php echo e(Form::password('password_confirmation',array('class'=>'form-control'))); ?>

            <?php $__errorArgs = ['password_confirmation'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
            <span class="invalid-password_confirmation text-danger" role="alert">
                        <strong><?php echo e($message); ?></strong>
                    </span>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>
        <div class="d-grid">
            <?php echo e(Form::submit(__('Reset'),array('class'=>'btn btn-primary btn-block mt-2','id'=>'resetBtn'))); ?>

        </div>

    </div>

    <?php echo e(Form::close()); ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.auth', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\~Prgoramming\Projects\Laravel\Mini Projects\erpgo\resources\views/auth/passwords/reset.blade.php ENDPATH**/ ?>