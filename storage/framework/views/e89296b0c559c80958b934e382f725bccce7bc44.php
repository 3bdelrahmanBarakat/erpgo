<?php echo e(Form::open(array('url'=>'payslip/bulkpayment/'.$date,'method'=>'post'))); ?>

    <div class="modal-body">
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <?php echo e(__('Total Unpaid Employee')); ?> <b><?php echo e(count($unpaidEmployees)); ?></b> <?php echo e(_('out of')); ?> <b><?php echo e(count($Employees)); ?></b>
                </div>
            </div>
        </div>
    </div>

    <div class="modal-footer">
        <input type="button" value="<?php echo e(__('Cancel')); ?>" class="btn  btn-light" data-bs-dismiss="modal">
        <input type="submit" value="<?php echo e(__('Bulk Payment')); ?>" class="btn  btn-primary">
    </div>

<?php echo e(Form::close()); ?>

<?php /**PATH E:\~Prgoramming\Projects\Laravel\Mini Projects\erpgo\resources\views/payslip/bulkcreate.blade.php ENDPATH**/ ?>