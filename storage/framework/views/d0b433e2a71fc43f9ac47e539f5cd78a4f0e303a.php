<?php $__env->startSection('content'); ?>
    <div class="page">
        <div class="page-content">
            <?php echo $__env->make('merchant.shared.errors-and-messages', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <div class="panel panel-bordered">
                <header class="panel-heading">
                    <h3 class="panel-title"><i class="fa fa-exclamation-circle" aria-hidden="true"></i>
                        <?php echo e(isset($page_title_prefix) ? $page_title_prefix : ""); ?>

                        <?php echo app('translator')->get("common.pending"); ?> <?php echo app('translator')->get("common.users"); ?> <?php echo app('translator')->get("$string_file.vehicle"); ?> <?php echo app('translator')->get("common.approval"); ?></h3>
                </header>
                <div class="panel-body container-fluid">
                    <table id="customDataTable" class="display nowrap table table-hover table-stripedw-full" style="width:100%">
                        <thead>
                        <tr>
                            <th><?php echo app('translator')->get("common.sn"); ?></th>
                            <th> <?php echo app('translator')->get("common.id"); ?></th>
                            <th><?php echo app('translator')->get("common.user"); ?> <?php echo app('translator')->get("common.details"); ?></th>
                            <th><?php echo app('translator')->get("$string_file.vehicle"); ?> <?php echo app('translator')->get("common.number"); ?></th>
                            <th><?php echo app('translator')->get("common.registered"); ?> <?php echo app('translator')->get("common.date"); ?></th>
                            <th><?php echo app('translator')->get("common.update"); ?></th>
                            <th><?php echo app('translator')->get("common.action"); ?></th>
                        </tr>
                        </thead>
                        <tbody>
                            <?php $sr = $users->firstItem() ?>
                            <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($sr); ?></td>
                                    <td><a href="<?php echo e(route('users.show',$user->id)); ?>"
                                           class="address_link"><?php echo e($user->user_merchant_id); ?></a>
                                    </td>
                                    <?php if(Auth::user()->demo == 1): ?>
                                        <td>
                                            <?php echo e("********".substr($user->last_name, -2)); ?><br>
                                            <?php echo e("********".substr($user->UserPhone, -2)); ?> <br>
                                            <?php echo e("********".substr($user->email, -2)); ?>


                                        </td>
                                    <?php else: ?>
                                        <td><?php echo e($user->first_name." ".$user->last_name); ?><br>
                                            <?php echo e($user->email); ?><br>
                                            <?php echo e($user->UserPhone); ?></td>
                                    <?php endif; ?>
                                    <td>
                                        <?php $__currentLoopData = $user->UserVehicles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $vehicle): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php echo e($vehicle->vehicle_number); ?>,
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </td>
                                    <td><?php echo e($user->created_at->toDateString()); ?>

                                    <br>
                                    <?php echo e($user->created_at->toTimeString()); ?></td>
                                    <td><?php echo e($user->updated_at->toDateString()); ?>

                                    <br>
                                    <?php echo e($user->updated_at->toTimeString()); ?></td>
                                    <td>
                                        <a href="<?php echo e(route('users.show',$user->id)); ?>"
                                           class="btn btn-sm btn-info menu-icon btn_detail action_btn"><span
                                                    class="fa fa-list-alt"
                                                    title="View User Profile"></span></a>
                                    </td>
                                </tr>
                                <?php $sr++; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                    <?php echo $__env->make('merchant.shared.table-footer', ['table_data' => $users, 'data' => []], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('merchant.layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/msprojectsappori/public_html/multi-service-v3/resources/views/merchant/user/pending_vehicle.blade.php ENDPATH**/ ?>