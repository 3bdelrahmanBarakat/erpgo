<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Bank Balance Transfer')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Dashboard')); ?></a></li>
    <li class="breadcrumb-item"><?php echo e(__('Bank Balance Transfer')); ?></li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('action-btn'); ?>
    <div class="float-end">
        
        
        
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create bank transfer')): ?>
            <a href="#" data-url="<?php echo e(route('bank-transfer.create')); ?>" data-ajax-popup="true"
               data-title="<?php echo e(__('Create Bank-Transfer')); ?>" data-bs-toggle="tooltip" title="<?php echo e(__('Create')); ?>"
               class="btn btn-sm btn-primary">
                <i class="ti ti-plus"></i>
            </a>
        <?php endif; ?>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-sm-12">
            <div class=" mt-2 " id="multiCollapseExample1">
                <div class="card">
                    <div class="card-body">
                        <?php echo e(Form::open(array('route' => array('bank-transfer.index'),'method' => 'GET','id'=>'transfer_form'))); ?>

                        <div class="row align-items-center justify-content-end">
                            <div class="col-xl-10">
                                <div class="row">

                                    <div class="col-3">
                                    </div>

                                    <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12 month">
                                        <div class="btn-box">
                                            <?php echo e(Form::label('date', __('Date'),['class'=>'form-label'])); ?>

                                            <?php echo e(Form::text('date', isset($_GET['date'])?$_GET['date']:null, array('class' => 'form-control month-btn','id'=>'pc-daterangepicker-1','readonly'))); ?>


                                        </div>
                                    </div>
                                    <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12 date">
                                        <div class="btn-box">
                                            <?php echo e(Form::label('sender_id', __('From Account'),['class'=>'form-label'])); ?>

                                            <?php echo e(Form::select('sender_id',$account,isset($_GET['sender_id'])?$_GET['sender_id']:'', array('class' => 'form-control select'))); ?>

                                        </div>
                                    </div>

                                    <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12">
                                        <div class="btn-box">
                                            <?php echo e(Form::label('receiver_id', __('To Account'),['class'=>'form-label'])); ?>

                                            <?php echo e(Form::select('receiver_id', $account,isset($_GET['receiver_id'])?$_GET['receiver_id']:'', array('class' => 'form-control select'))); ?>

                                        </div>
                                    </div>


                                </div>
                            </div>
                            <div class="col-auto mt-4">
                                <div class="row">
                                    <div class="col-auto">

                                        <a href="#" class="btn btn-sm btn-primary"
                                           onclick="document.getElementById('transfer_form').submit(); return false;"
                                           data-bs-toggle="tooltip" title="<?php echo e(__('Apply')); ?>"
                                           data-original-title="<?php echo e(__('apply')); ?>">
                                            <span class="btn-inner--icon"><i class="ti ti-search"></i></span>
                                        </a>

                                        <a href="<?php echo e(route('bank-transfer.index')); ?>" class="btn btn-sm btn-danger "
                                           data-bs-toggle="tooltip" title="<?php echo e(__('Reset')); ?>"
                                           data-original-title="<?php echo e(__('Reset')); ?>">
                                            <span class="btn-inner--icon"><i
                                                    class="ti ti-trash-off text-white-off "></i></span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php echo e(Form::close()); ?>

                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body table-border-style">
                    <h5></h5>
                    <div class="table-responsive">
                        <table class="table datatable">
                            <thead>
                            <tr>
                                <th> <?php echo e(__('Date')); ?></th>
                                <th> <?php echo e(__('From Account')); ?></th>
                                <th> <?php echo e(__('To Account')); ?></th>
                                <th> <?php echo e(__('Debit Amount')); ?></th>
                                <th> <?php echo e(__('Credit Amount')); ?></th>
                                <th> <?php echo e(__('Rate')); ?></th>
                                <th> <?php echo e(__('Description')); ?></th>
                                <th> <?php echo e(__('Status')); ?></th>

                                
                                
                                
                            </tr>
                            </thead>

                            <tbody>
                            <?php $__currentLoopData = $transfers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $transfer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr class="font-semibold">
                                    <td ><?php echo e(Auth::user()->dateFormat($transfer->date)); ?></td>
                                    <td class="p-0"><?php echo e($transfer->SenderBankAccount()->holder_name . " -  " . $transfer->SenderBankAccount()->currency->name); ?></td>
                                    <td class="p-0"><?php echo e($transfer->ReceiverBankAccount()->holder_name . " -  " . $transfer->ReceiverBankAccount()->currency->name); ?></td>
                                    <td class="p-0"><?php echo e($transfer->debit_amount  . " " . $transfer->SenderBankAccount()->currency->symbol); ?></td>
                                    <td class="p-0"><?php echo e($transfer->credit_amount  . " " . $transfer->ReceiverBankAccount()->currency->symbol); ?></td>
                                    <td class="p-0"><?php echo e($transfer->rate); ?></td>
                                    <td class="p-0"><?php echo e($transfer->description); ?></td>
                                    <td class="p-0">
                                        <?php if($transfer->status == 1): ?>
                                            <span class="status_badge badge bg-primary p-2 px-3 rounded">Success</span>
                                        <?php else: ?>
                                            <span class="status_badge badge bg-danger p-2 px-3 rounded">Failed</span>
                                        <?php endif; ?>
                                    </td>
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\~Prgoramming\Projects\Laravel\Mini Projects\erpgo\resources\views/bank-transfer/index.blade.php ENDPATH**/ ?>