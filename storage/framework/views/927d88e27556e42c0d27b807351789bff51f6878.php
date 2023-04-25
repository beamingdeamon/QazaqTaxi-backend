<?php $__env->startSection('content'); ?>
    <div class="page">
        <div class="page-content">
            <?php echo $__env->make('merchant.shared.errors-and-messages', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <div class="panel panel-bordered">
                <header class="panel-heading">
                    <div class="panel-actions">
                            <a href="<?php echo e(route('users.index')); ?>">
                                <button type="button" class="btn btn-icon btn-success float-right" style="margin:10px">
                                    <i class="wb-reply"></i>
                                </button>
                            </a>
                        <?php if($user->account_number == null): ?>
                            <a href="<?php echo e(route('users.edit',$user->id)); ?>" class="text-reset">
                                <span><?php echo app('translator')->get('common.complete'); ?> <?php echo app('translator')->get('common.your'); ?> <?php echo app('translator')->get('common.bank'); ?> <?php echo app('translator')->get('common.details'); ?> <?php echo app('translator')->get('common.first'); ?>
                                    <?php echo app('translator')->get('common.for'); ?> <?php echo app('translator')->get('common.add'); ?> <?php echo app('translator')->get('common.vehicle'); ?>
                                </span>
                            </a>
                        <?php else: ?>
                        <a href="<?php echo e(route('merchant.user.vehicle_add',['id'=>$user->id])); ?>">
                            <button type="button" class="btn btn-icon btn-success float-right" style="margin:10px">
                                <i class="wb-plus" title="<?php echo app('translator')->get("common.add"); ?> <?php echo app('translator')->get("common.user"); ?>"></i>
                            </button>
                        </a>
                        <?php endif; ?>
                    </div>

                    <h3 class="panel-title"><i class="far fa-car" aria-hidden="true"></i>
                       <spam> <?php echo e(ucwords($user->first_name)." ".$user->last_name); ?></spam> ------> <?php echo app('translator')->get("$string_file.vehicle"); ?> <?php echo app('translator')->get("common.management"); ?>
                    </h3>
                </header>
                <table id="customDataTable" class="display nowrap table table-hover table-striped w-full"
                       style="width:100%">
                    <thead>
                    <tr>
                        <th><?php echo app('translator')->get("common.sn"); ?></th>
                        <th><?php echo app('translator')->get("$string_file.vehicle"); ?> <?php echo app('translator')->get('common.details'); ?></th>
                        <th><?php echo app('translator')->get("$string_file.vehicle"); ?> <?php echo app('translator')->get('common.number'); ?></th>
                        <th><?php echo app('translator')->get("$string_file.vehicle"); ?> <?php echo app('translator')->get('common.color'); ?></th>
                        <th><?php echo app('translator')->get("$string_file.vehicle"); ?> <?php echo app('translator')->get('common.image'); ?></th>
                        <th><?php echo app('translator')->get("$string_file.vehicle"); ?> <?php echo app('translator')->get("$string_file.plate"); ?> <?php echo app('translator')->get('common.number'); ?> <?php echo app('translator')->get('common.image'); ?></th>
                        <th><?php echo app('translator')->get('common.action'); ?></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $sr = $user_vehicle->firstItem() ?>
                    <?php $__currentLoopData = $user_vehicle; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $vehicle_list): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($sr); ?>  </td>
                        <td><?php echo e($vehicle_list->vehicleType->vehicleTypeName); ?>

                            <br>
                            <?php echo e($vehicle_list->vehicleMake->vehicleMakeName); ?>

                            <br>
                            <?php echo e($vehicle_list->vehicleModel->vehicleModelName); ?>

                        </td>
                        <td><?php echo e($vehicle_list->vehicle_number); ?></td>
                        <td><?php echo e($vehicle_list->vehicle_color); ?></td>
                        <td class="text-center">
                            <img src="<?php echo e(get_image($vehicle_list->vehicle_image,'user_vehicle_document')); ?>"
                                 alt="avatar" style="width: 100px;height: 100px;">
                        </td>
                        <td class="text-center">
                            <img src="<?php echo e(get_image($vehicle_list->vehicle_number_plate_image,'user_vehicle_document')); ?>"
                                 alt="avatar" style="width: 100px;height: 100px;">
                        </td>
                        <td>
                            <a href="<?php echo e(route('merchant.user.vehicle.edit',['id'=>$vehicle_list->id])); ?>"
                               data-original-title="<?php echo app('translator')->get("common.edit"); ?> <?php echo app('translator')->get("$string_file.vehicle"); ?> "
                               data-toggle="tooltip"
                               data-placement="top"
                               class="btn btn-sm btn-primary menu-icon btn_edit action_btn">
                                <i class="fa fa-edit"></i> </a>
                        </td>
                    </tr>
                    <?php $sr++  ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
                <?php echo $__env->make('merchant.shared.table-footer', ['table_data' => $user_vehicle, 'data' => []], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('merchant.layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/msprojectsappori/public_html/multi-service-v3/resources/views/merchant/user/vehicle_list.blade.php ENDPATH**/ ?>