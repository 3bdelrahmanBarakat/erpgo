<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Tasks')); ?>

<?php $__env->stopSection(); ?>


<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Dashboard')); ?></a></li>
    <li class="breadcrumb-item"><a href="<?php echo e(route('projects.index')); ?>"><?php echo e(__('Project')); ?></a></li>
    <li class="breadcrumb-item"><?php echo e(__('Task')); ?></li>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('action-btn'); ?>
<div class="float-end">

    <?php if(@$view == 'grid'): ?>
        <a href="<?php echo e(route('taskBoard.view', 'list')); ?>" class="btn btn-primary btn-sm" data-bs-toggle="tooltip" title="<?php echo e(__('List View')); ?>">
            <span class="btn-inner--text"><i class="ti ti-list"></i></span>
        </a>
    <?php else: ?>
        <a href="<?php echo e(route('taskBoard.view', 'grid')); ?>" class="btn btn-primary btn-sm" data-bs-toggle="tooltip" title="<?php echo e(__('Card View')); ?>">
            <span class="btn-inner--text"><i class="ti ti-table"></i></span>
        </a>
    <?php endif; ?>
</div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="row">
  <div class="col-12">
    <div class="card">
        <div class="row">

            <?php if(count($tasks) > 0): ?>
                <?php $__currentLoopData = $tasks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $task): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="col-md-3 col-lg-3 col-sm-3">
                        <div class="card m-3 card-progress border shadow-none" id="<?php echo e($task->id); ?>" style="<?php echo e(!empty($task->priority_color) ? 'border-left: 2px solid '.$task->priority_color.' !important' :''); ?>;">
                            <div class="card-body">
                                <div class="row align-items-center mb-2">
                                    <div class="col-6">
                                        <span class="badge p-2 px-3 rounded bg-<?php echo e(\App\Models\ProjectTask::$priority_color[$task->priority]); ?>"><?php echo e(\App\Models\ProjectTask::$priority[$task->priority]); ?></span>
                                    </div>
                                    <div class="col-6 text-end">
                                        <?php if(str_replace('%','',$task->taskProgress()['percentage']) > 0): ?><span class="text-sm"><?php echo e($task->taskProgress()['percentage']); ?></span><?php endif; ?>
                                    </div>
                                </div>

                                <a class="h6 task-name-break" href="<?php echo e(route('projects.tasks.index',!empty($task->project)?$task->project->id:'')); ?>"><?php echo e($task->name); ?></a>
                                <div class="row align-items-center">
                                    <div class="col-12">
                                        <div class="actions d-inline-block">
                                            <?php if(count($task->taskFiles) > 0): ?>
                                                <div class="action-item mr-2"><i class="ti ti-paperclip mr-2"></i><?php echo e(count($task->taskFiles)); ?></div><?php endif; ?>
                                            <?php if(count($task->comments) > 0): ?>
                                                <div class="action-item mr-2"><i class="ti ti-brand-hipchat mr-2"></i><?php echo e(count($task->comments)); ?></div><?php endif; ?>
                                            <?php if($task->checklist->count() > 0): ?>
                                                <div class="action-item mr-2"><i class="ti ti-list-check mr-2"></i><?php echo e($task->countTaskChecklist()); ?></div><?php endif; ?>
                                        </div>
                                    </div>
                                    <div class="col-5"><?php if(!empty($task->end_date) && $task->end_date != '0000-00-00'): ?><small <?php if(strtotime($task->end_date) < time()): ?>class="text-danger"<?php endif; ?>><?php echo e(Utility::getDateFormated($task->end_date)); ?></small><?php endif; ?></div>
                                    <div class="col-7 text-end">
                                        <?php if($users = $task->users()): ?>
                                            <div class="avatar-group">
                                                <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <?php if($key<3): ?>
                                                        <a href="#" class="avatar rounded-circle avatar-sm">
                                                            <img class="hweb" data-original-title="<?php echo e((!empty($user)?$user->name:'')); ?>" <?php if($user->avatar): ?> src="<?php echo e(asset('/storage/uploads/avatar/'.$user->avatar)); ?>" <?php else: ?> src="<?php echo e(asset('/storage/uploads/avatar/avatar.png')); ?>" <?php endif; ?>>
                                                        </a>
                                                    <?php else: ?>
                                                        <?php break; ?>
                                                    <?php endif; ?>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                <?php if(count($users) > 3): ?>
                                                    <a href="#" class="avatar rounded-circle avatar-sm">
                                                        <img class="hweb" data-original-title="<?php echo e((!empty($user)?$user->name:'')); ?>" <?php if($user->avatar): ?> src="<?php echo e(asset('/storage/uploads/avatar/'.$user->avatar)); ?>" <?php else: ?> src="<?php echo e(asset('/storage/uploads/avatar/avatar.png')); ?>" <?php endif; ?> avatar="+ <?php echo e(count($users)-3); ?>">
                                                    </a>
                                                <?php endif; ?>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php else: ?>
                <div class="col-md-12">
                    <h6 class="text-center m-3"><?php echo e(__('No tasks found')); ?></h6>
                </div>
            <?php endif; ?>
        </div>
    </div>
  </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('script-page'); ?>
    <script>
        // ready
        $(function () {
            var sort = 'created_at-desc';
            var status = '';
            ajaxFilterTaskView('created_at-desc', '', ['see_my_tasks']);

            // when change status
            $(".task-filter-actions").on('click', '.filter-action', function (e) {
                if ($(this).hasClass('filter-show-all')) {
                    $('.filter-action').removeClass('active');
                    $(this).addClass('active');
                } else {

                    $('.filter-show-all').removeClass('active');
                    if ($(this).hasClass('filter-other')) {
                        $('.filter-other').removeClass('active');
                    }
                    if ($(this).hasClass('active')) {
                        $(this).removeClass('active');
                        $(this).blur();
                    } else {
                        $(this).addClass('active');
                    }
                }

                var filterArray = [];
                var url = $(this).parents('.task-filter-actions').attr('data-url');
                $('div.task-filter-actions').find('.active').each(function () {
                    filterArray.push($(this).attr('data-val'));
                });
                status = filterArray;
                ajaxFilterTaskView(sort, $('#task_keyword').val(), status);
            });

            // when change sorting order
            $('#task_sort').on('click', 'a', function () {
                sort = $(this).attr('data-val');
                ajaxFilterTaskView(sort, $('#task_keyword').val(), status);
                $('#task_sort a').removeClass('active');
                $(this).addClass('active');
            });

            // when searching by task name
            $(document).on('keyup', '#task_keyword', function () {
                ajaxFilterTaskView(sort, $(this).val(), status);
            });
        });

        // For Filter
        function ajaxFilterTaskView(task_sort, keyword = '', status = '') {
            var mainEle = $('#taskboard_view');
            var view = '<?php echo e(@$view); ?>';
            var data = {
                view: view,
                sort: task_sort,
                keyword: keyword,
                status: status,
            }

            $.ajax({
                url: '<?php echo e(route('project.taskboard.view')); ?>',
                data: data,
                success: function (data) {
                    mainEle.html(data.html);
                }
            });
        }
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\erpgo\resources\views/project_task/grid.blade.php ENDPATH**/ ?>