<?php $__env->startSection('content'); ?>

    <div class="page">
        <div class="page-content">
            <?php echo $__env->make('merchant.shared.errors-and-messages', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <div class="panel panel-bordered">
                <header class="panel-heading">
                    <div class="panel-actions">

                    </div>
                    <h3 class="panel-title"><i class="far fa-car" aria-hidden="true"></i>
                        <?php echo app('translator')->get("$string_file.up_coming"); ?> <?php echo app('translator')->get("$string_file.ride"); ?>
                    </h3>
                </header>
                <div class="panel-body container-fluid">
                    <form action="<?php echo e(route('merchant.carpool.up_coming.rides.search')); ?>" method="get">
                        <div class="table_search row p-3">
                            <div class="col-md-2 col-xs-6 active-margin-top"><?php echo app('translator')->get("$string_file.search"); ?> <?php echo app('translator')->get("$string_file.by"); ?>
                            </div>
                            <div class="col-md-2 col-xs-12 form-group active-margin-top">
                                <div class="input-group">
                                    <input type="text" name="id"
                                           placeholder=" <?php echo app('translator')->get("$string_file.user"); ?> <?php echo app('translator')->get("$string_file.ride"); ?> <?php echo app('translator')->get("$string_file.id"); ?>"
                                           class="form-control col-md-12 col-xs-12">
                                </div>
                            </div>
                            <div class="col-md-2 col-xs-12 form-group active-margin-top">
                                <div class="input-group">
                                    <input type="text" id="" name="date"
                                           placeholder="<?php echo app('translator')->get("$string_file.from"); ?> <?php echo app('translator')->get("$string_file.date"); ?>"
                                           class="form-control col-md-12 col-xs-12 customDatePicker2"
                                           id="datepickersearch" autocomplete="off">
                                </div>
                            </div>
                            <div class="col-md-2 col-xs-12 form-group active-margin-top">
                                <div class="input-group">
                                    <input type="text" id="" name="date1"
                                           placeholder="<?php echo app('translator')->get("$string_file.to"); ?> <?php echo app('translator')->get("$string_file.date"); ?>"
                                           class="form-control col-md-12 col-xs-12 customDatePicker2"
                                           id="datepickersearch" autocomplete="off">
                                </div>
                            </div>
                            <div class="col-md-2 col-xs-6 form-group active-margin-top">
                                <button class="btn btn-primary" type="submit"><i
                                            class="fa fa-search"
                                            aria-hidden="true"></i>
                                </button>
                            </div>
                        </div>
                    </form>

                        <table id="customDataTable" class="display nowrap table table-hover table-striped w-full"
                               style="width:100%">
                            <thead>
                            <tr>
                                <th><?php echo app('translator')->get("$string_file.sn"); ?></th>
                                <th><?php echo app('translator')->get("$string_file.user"); ?> <?php echo app('translator')->get("$string_file.ride"); ?> <?php echo app('translator')->get("$string_file.id"); ?></th>
                                <th><?php echo app('translator')->get("$string_file.ride"); ?> <?php echo app('translator')->get("$string_file.id"); ?></th>
                                <th> <?php echo app('translator')->get("$string_file.ride"); ?> <?php echo app('translator')->get("$string_file.details"); ?> <?php echo app('translator')->get("$string_file.id"); ?> </th>
                                <th><?php echo app('translator')->get("$string_file.user"); ?> <?php echo app('translator')->get("$string_file.details"); ?></th>
                                <th><?php echo app('translator')->get("$string_file.offer"); ?> <?php echo app('translator')->get("$string_file.user"); ?> <?php echo app('translator')->get("$string_file.details"); ?></th>
                                <th><?php echo app('translator')->get("$string_file.area"); ?></th>
                                <th><?php echo app('translator')->get("$string_file.promo"); ?> <?php echo app('translator')->get("$string_file.code"); ?></th>
                                <th><?php echo app('translator')->get("$string_file.ride"); ?> <?php echo app('translator')->get("$string_file.date"); ?></th>
                                <th><?php echo app('translator')->get("$string_file.map"); ?> <?php echo app('translator')->get("$string_file.image"); ?></th>
                                <th><?php echo app('translator')->get("$string_file.payment"); ?> <?php echo app('translator')->get("$string_file.status"); ?></th>
                                <th><?php echo app('translator')->get("$string_file.ac_ride"); ?></th>
                                <th><?php echo app('translator')->get("$string_file.action"); ?></th>
                            </tr>
                            </thead>
                            <tbody>

                            <?php $sr = $upcoming_ride->firstItem() ?>
                            <?php $__currentLoopData = $upcoming_ride; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $upcoming): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($sr); ?></td>

                                    <td><?php echo e($upcoming->id ? : ''); ?></td>

                                    <td><?php echo e($upcoming->carpooling_ride_id ? : ''); ?></td>
                                    <td><?php echo e($upcoming->carpooling_ride_detail_id ? : ''); ?></td>
                                    <td>
                                        <?php echo e(ucwords($upcoming->user->first_name)." ".$upcoming->user->last_name); ?>

                                        <br>
                                        <?php echo e($upcoming->user->UserPhone ? : ''); ?>

                                        <br>
                                        <?php echo e($upcoming->user->email ? : ''); ?>


                                    </td>
                                    <td>
                                        <?php echo e(ucwords($upcoming->CarpoolingRide->user->first_name)." ".$upcoming->CarpoolingRide->user->last_name); ?>

                                        <br>
                                        <?php echo e($upcoming->CarpoolingRide->user->UserPhone ? : ''); ?>

                                        <br>
                                        <?php echo e($upcoming->CarpoolingRide->user->email ? : ''); ?>

                                    </td>
                                    <td><?php echo e($upcoming->CarpoolingRide->CountryArea->CountryAreaName); ?></td>
                                    <td><?php echo e($upcoming->promo_code); ?></td>
                                

                                    <td><?php echo e(date('Y-m-d h:s:i',$upcoming->ride_timestamp)); ?></td>
                                    <td> <a href="<?php echo $upcoming->CarpoolingRideDetail->map_image; ?>"
                                            target="_blank"><?php echo app('translator')->get("$string_file.view"); ?> <?php echo app('translator')->get("$string_file.map"); ?></a></td>
                                    <td><?php echo e($upcoming->payment_status == 0 ? trans("$string_file.pending") : ($upcoming->payment_status == 1 ? trans("$string_file.success") : ' ')); ?></td>
                                    <td><?php echo e($upcoming->ac_ride == 0 ? trans("$string_file.no") : ($upcoming->ac_ride == 1 ? trans("$string_file.yes") : ' ')); ?></td>
                                    <td>
                                        <a href="<?php echo e(route('merchant.offer.rides.user.details',['id'=>$upcoming->id])); ?>"
                                           data-original-title="<?php echo app('translator')->get("$string_file.ride"); ?> <?php echo app('translator')->get("$string_file.details"); ?> "
                                           data-toggle="tooltip"
                                           data-placement="top"
                                           class="btn btn-sm btn-primary menu-icon btn_car action_btn">
                                            <i class="fa fa-car"></i> </a
                                    </td>
                                </tr>
                                <?php $sr++  ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                            <?php echo $__env->make('merchant.shared.table-footer', ['table_data' => $upcoming_ride, 'data' =>$data], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        </table>
                </div>
            </div>
            </div>
        </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('merchant.layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/msprojectsappori/public_html/multi-service-v3/resources/views/merchant/car-pool-ride-management/up_coming-ride.blade.php ENDPATH**/ ?>