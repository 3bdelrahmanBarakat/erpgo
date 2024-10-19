<?php echo e(Form::open(array('url' => 'bank-transfer'))); ?>

<div class="modal-body">
    <div class="row">
        <div class="form-group  col-md-6">
            <?php echo e(Form::label('sender_id', __('Sender'),['class'=>'form-label'])); ?>

            <?php echo e(Form::select('sender_id', $creditAccounts, null, ['class' => 'form-control select', 'required' => 'required'])); ?>

        </div>
        <div class="form-group  col-md-6">
            <?php echo e(Form::label('receiver_id', __('Receiver'),['class'=>'form-label'])); ?>

            <?php echo e(Form::select('receiver_id', $debitAccounts, null, ['class' => 'form-control select', 'required' => 'required'])); ?>

        </div>




        <div class="form-group  col-md-6">
            <?php echo e(Form::label('debit_amount', __('Debit Amount'),['class'=>'form-label'])); ?>

            <?php echo e(Form::text('debit_amount', '', array('class' => 'form-control','required'=>'required'))); ?>

        </div>
        <div class="form-group  col-md-6">
            <?php echo e(Form::label('credit_amount', __('Credit Amount'),['class'=>'form-label'])); ?>

            <?php echo e(Form::text('credit_amount', '', array('class' => 'form-control','required'=>'required'))); ?>

        </div>
        <div class="form-group  col-md-6">
            <?php echo e(Form::label('date', __('Date'),['class'=>'form-label'])); ?>

            <?php echo e(Form::date('date',null,array('class'=>'form-control','required'=>'required'))); ?>

        </div>
        <div class="form-group  col-md-6">
            <?php echo e(Form::label('reference', __('Reference'),['class'=>'form-label'])); ?>

            <?php echo e(Form::text('reference', '', array('class' => 'form-control'))); ?>

        </div>
        <div class="form-group  col-md-12">
            <?php echo e(Form::label('description', __('Description'),['class'=>'form-label'])); ?>

            <?php echo e(Form::textarea('description', '', array('class' => 'form-control','rows'=>3))); ?>

        </div>

    </div>
</div>
<div class="modal-footer">
    <input type="button" value="<?php echo e(__('Cancel')); ?>" class="btn  btn-light" data-bs-dismiss="modal">
    <input type="submit" value="<?php echo e(__('Create')); ?>" class="btn  btn-primary">
</div>
<?php echo e(Form::close()); ?>

<?php /**PATH E:\~Prgoramming\Projects\Laravel\Mini Projects\erpgo - permissions\resources\views/bank-transfer/create.blade.php ENDPATH**/ ?>