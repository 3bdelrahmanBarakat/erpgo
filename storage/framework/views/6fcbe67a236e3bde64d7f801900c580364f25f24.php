<?php echo e(Form::open(['route' => ['projects.expenses.store',$project->id],'id' => 'create_expense','enctype' => 'multipart/form-data'])); ?>

<div class="modal-body">

<div class="row">
    <div class="col-12 col-md-12">
        <div class="form-group">
            <?php echo e(Form::label('name', __('Name'),['class' => 'form-label'])); ?>

            <?php echo e(Form::text('name', null, ['class' => 'form-control','required'=>'required'])); ?>

        </div>
    </div>
    <div class="col-12 col-md-4">
        <div class="form-group">
            <?php echo e(Form::label('date', __('Date'),['class' => 'form-label'])); ?>

            <?php echo e(Form::date('date', null, ['class' => 'form-control'])); ?>

        </div>
    </div>
    <div class="col-12 col-md-4">
      <div class="form-group">
          <?php echo e(Form::label('amount',__('Amount'),['class'=>'form-label'])); ?>

          <div class="form-group price-input input-group search-form">
              <span class="input-group-text bg-transparent"><?php echo e(\Auth::user()->currencySymbol()); ?></span>
              <?php echo e(Form::number('amount',null,array('class'=>'form-control','required' => 'required','min' => '0'))); ?>

          </div>
      </div>

    </div>
    <div class="col-12 col-md-4">
        <div class="form-group">
            <?php echo e(Form::label('task_id', __('Task'),['class' => 'form-label'])); ?>

            <select class="form-control select" name="task_id" id="task_id">
                <option value="0"  disabled selected>Choose Task</option>
                <?php $__currentLoopData = $project->tasks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $task): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($task->id); ?>"><?php echo e($task->name); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>
    </div>
    <div class="col-12 col-md-12">
        <div class="form-group">
            <?php echo e(Form::label('description', __('Description'),['class' => 'form-label'])); ?>

            <small class="form-text text-muted mb-2 mt-0"><?php echo e(__('This textarea will autosize while you type')); ?></small>
            <?php echo e(Form::textarea('description', null, ['class' => 'form-control','rows' => '1','data-toggle' => 'autosize'])); ?>

        </div>
    </div>


    <div class="col-12 col-md-12">
        <?php echo e(Form::label('attachment',__('Attachment'),['class'=>'form-label'])); ?>

        <div class="choose-file form-group">
            <label for="attachment" class="form-label">
                <div><?php echo e(__('Choose file here')); ?></div>
                <input type="file" class="form-control" name="attachment" id="attachment" data-filename="attachment_create">
            </label>
            <p class="attachment_create"></p>
        </div>
    </div>


</div>
</div>

<div class="modal-footer">
    <input type="button" value="<?php echo e(__('Cancel')); ?>" class="btn btn-light" data-bs-dismiss="modal">
    <input type="submit" value="<?php echo e(__('Create')); ?>" class="btn  btn-primary">
</div>

<?php echo e(Form::close()); ?>


<?php /**PATH C:\xampp\htdocs\erpgo\resources\views/expenses/create.blade.php ENDPATH**/ ?>