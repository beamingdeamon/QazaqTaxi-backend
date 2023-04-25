<?php $__env->startSection('content'); ?>
<div class="page">
    <div class="page-content">
        <?php echo $__env->make('merchant.shared.errors-and-messages', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <div class="panel panel-bordered">
            <header class="panel-heading">
                <div class="panel-actions">
                    <?php if(!empty($info_setting) && $info_setting->view_text != ""): ?>
                        <button class="btn btn-icon btn-primary float-right" style="margin:10px"
                                data-target="#examplePositionSidebar" data-toggle="modal" type="button">
                            <i class="wb-info ml-1 mr-1" title="Info" style=""></i>
                        </button>
                    <?php endif; ?>
                    <?php if(Auth::user('merchant')->can('reward_points')): ?>
                        <a href="<?php echo e(route('reward-points.create')); ?>">
                            <button type="button" class="btn btn-icon btn-success float-right" style="margin:10px">
                                <i class="wb-plus" title="<?php echo app('translator')->get('admin.Add'); ?> <?php echo app('translator')->get('admin.reward.add'); ?>"></i>
                            </button>
                        </a>
                    <?php endif; ?>
                </div>
                <h3 class="panel-title"><i class="wb-users" aria-hidden="true"></i>
                        <?php echo app('translator')->get("$string_file.reward_points"); ?></h3>
            </header>
            <div class="panel-body container-fluid">
                <table id="customDataTable" class="display nowrap table table-hover table-striped w-full" style="width:100%;">
                    <thead>
                        <tr>
                            <th><?php echo app('translator')->get("$string_file.sn"); ?></th>
                            <th><?php echo app('translator')->get("$string_file.country"); ?></th>
                            <th><?php echo app('translator')->get("$string_file.area"); ?></th>
                            <th><?php echo app('translator')->get("$string_file.app"); ?></th>
                            
                            
                            
                            <th><?php echo app('translator')->get("$string_file.trip_expenses"); ?></th>
                            
                            
                            
                            <th><?php echo app('translator')->get("$string_file.status"); ?></th>
                            <?php if(Auth::user('merchant')->can('reward_points') || Auth::user('merchant')->can('reward_points')): ?>
                                <th><?php echo app('translator')->get("$string_file.action"); ?></th>
                            <?php endif; ?>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                        $sn = 0;
                    ?>
                    <?php $__currentLoopData = $reward_system; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $reward): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e(++$sn); ?></td>
                            <td><?php if(!empty($reward->Country)): ?> <?php echo e($reward->Country->CountryName); ?> <?php else: ?> --- <?php endif; ?></td>
                            <td><?php if(!empty($reward->countryArea)): ?> <?php echo e($reward->countryArea->CountryAreaName); ?> <?php else: ?> --- <?php endif; ?></td>
                            <td>
                                <?php if($reward->application == 1): ?>
                                    <?php echo app('translator')->get("$string_file.user"); ?>
                                <?php else: ?>
                                    <?php echo app('translator')->get('admin.driver'); ?>
                                <?php endif; ?>    
                            </td>
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            <td>
                                <?php if($reward->trip_expense_reward == 1): ?>
                                    <span class="text-success"> <?php echo app('translator')->get("$string_file.enable"); ?> </span>
                                    <br>Amount Per Points :<?php echo e($reward->amount_per_points); ?>

                                    <br>Expire :<?php echo e($reward->expenses_expire_in_days); ?>

                                <?php else: ?>
                                    <span class="text-danger"> <?php echo app('translator')->get("$string_file.disable"); ?> </span>
                                <?php endif; ?>
                            </td>
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            <td>
                                <?php if($reward->status == 1): ?>
                                    <span class="text-success"> <?php echo app('translator')->get("$string_file.active"); ?> </span>
                                <?php else: ?>
                                    <span class="text-danger"> <?php echo app('translator')->get("$string_file.deactive"); ?> </span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <?php if(Auth::user('merchant')->can('reward_points')): ?>
                                    <a class="mr-1 btn btn-sm btn-warning"
                                       href="<?php echo e(route('merchant.rewardSystem.edit' , ['id' => $reward->id])); ?>">
                                        <span class="fas fa-edit"></span>
                                    </a>
                                <?php endif; ?>
                                <?php if(Auth::user('merchant')->can('reward_points')): ?>
                                    <button class="btn btn-sm btn-danger" onclick="
                                            if(confirm('Do you want to delete ?')) {
                                            $('#delete-reward-<?php echo e($reward->id); ?>').submit();
                                            }
                                            ">
                                        <span class="fas fa-trash"></span>
                                    </button>
                                    <form id="delete-reward-<?php echo e($reward->id); ?>" method="post"
                                          action="<?php echo e(route('merchant.rewardSystem.delete' , ['id' => $reward->id])); ?>">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('delete'); ?>
                                    </form>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
                <div class="pagination1 float-right"><?php echo e($reward_system->appends($data)->links()); ?></div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('merchant.layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/msprojectsappori/public_html/multi-service-v3/resources/views/merchant/reward/index.blade.php ENDPATH**/ ?>