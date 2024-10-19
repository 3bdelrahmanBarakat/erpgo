<div class="modal-body">

<div class="row">
    <div class="col-12 pb-2">
        <b><?php echo e(__(' Estimated Hours')); ?></b> : <span><?php echo e((!empty($task->estimated_hrs)) ? number_format($task->estimated_hrs) : '-'); ?></span>
    </div>
    <div class="col-12 pb-2">
        <b><?php echo e(__('Milestone')); ?></b> : <span><?php echo e((!empty($task->milestone)) ? $task->milestone->title : '-'); ?></span>
    </div>
    <div class="col-12">
        <b><?php echo e(__('Description')); ?></b> <br> <span><?php echo e((!empty($task->description)) ? $task->description : '-'); ?></span>
        <hr/>
    </div>

    <div class="col-12 pb-4">
        <div class="progress" data-toggle="tooltip" data-original-title="<?php echo e($task->taskProgress()['percentage']); ?>">
            <div class="progress-bar event-<?php echo e($task->taskProgress()['color']); ?>" role="progressbar" aria-valuenow="<?php echo e($task->taskProgress()['percentage']); ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo e($task->taskProgress()['percentage']); ?>;"></div>
        </div>
    </div>
</div>
<div class="row pb-2">
    <div class="col-6">
        <?php if($users = $task->users()): ?>
            <?php if(count($users) > 0): ?>
                <div class="avatar-group">
                    <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if($key<3): ?>
                            <a href="#" class="avatar rounded-circle avatar-sm">
                                <img src="<?php echo e($user->getImgImageAttribute()); ?>" title="<?php echo e($user->name); ?>">
                            </a>
                        <?php else: ?>
                            <?php break; ?>
                        <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php if(count($users) > 3): ?>
                        <a href="#" class="avatar rounded-circle avatar-sm">
                            <img src="<?php echo e($user->getImgImageAttribute()); ?>" avatar="+ <?php echo e(count($users)-3); ?>">
                        </a>
                    <?php endif; ?>
                </div>
            <?php else: ?>
                <p><?php echo e(__('No User Found.')); ?></p>
            <?php endif; ?>
        <?php endif; ?>
    </div>
    <div class="col-6 pt-2">
        <div class="row text-center">
            <div class="col-4" data-toggle="tooltip" data-placement="bottom" data-original-title="<?php echo e(__('Attachment')); ?>">
                <i class="ti ti-paperclip mr-2"></i><?php echo e(count($task->taskFiles)); ?>

            </div>
            <div class="col-4" data-toggle="tooltip" data-placement="bottom" data-original-title="<?php echo e(__('Comment')); ?>">
                <i class="ti ti-brand-hipchat mr-2"></i><?php echo e(count($task->comments)); ?>

            </div>
            <div class="col-4" data-toggle="tooltip" data-placement="bottom" data-original-title="<?php echo e(__('Checklist')); ?>">
                <i class="ti ti-list-check mr-2"></i><?php echo e($task->countTaskChecklist()); ?>

            </div>
        </div>
    </div>
</div>
</div>
<?php /**PATH C:\xampp\htdocs\erpgo\resources\views/tasks/calendar_show.blade.php ENDPATH**/ ?>