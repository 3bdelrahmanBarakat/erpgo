<?php echo e(Form::open(array('route' => ['leads.labels.store',$lead->id]))); ?>

<div class="modal-body">
    <div class="row">
        <div class="col-12 form-group">
            <div class="row gutters-xs">
                <?php $__currentLoopData = $labels; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="col-12 custom-control custom-checkbox mt-2 mb-2">
                        <?php echo e(Form::checkbox('labels[]',$label->id,(array_key_exists($label->id,$selected))?true:false,['class' => 'form-check-input','id'=>'labels_'.$label->id])); ?>

                        <?php echo e(Form::label('labels_'.$label->id, ucfirst($label->name),['class'=>'custom-control-label ml-4 text-white p-2 px-3 rounded badge bg-'.$label->color])); ?>

                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </div>
</div>

<div class="modal-footer">
    <input type="button" value="<?php echo e(__('Cancel')); ?>" class="btn  btn-light" data-bs-dismiss="modal">
    <input type="submit" value="<?php echo e(__('Create')); ?>" class="btn  btn-primary">
</div>

<?php echo e(Form::close()); ?>


<?php /**PATH E:\~Prgoramming\Projects\Laravel\Mini Projects\erpgo\resources\views/leads/labels.blade.php ENDPATH**/ ?>