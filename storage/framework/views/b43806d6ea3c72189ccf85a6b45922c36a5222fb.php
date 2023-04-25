<?php $__env->startSection('content'); ?>
    <div class="page">
        <div class="page-content">
            <?php echo $__env->make('merchant.shared.errors-and-messages', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <div class="panel panel-bordered">
                <header class="panel-heading">
                    <div class="panel-actions">
                        <a href="<?php echo e(route('merchant.offer.rides')); ?>">
                            <button type="button" class="btn btn-icon btn-success float-right" style="margin:10px">
                                <i class="wb-reply"></i>
                            </button>
                        </a>
                    </div>
                    <h3 class="panel-title"><i class="far fa-car" aria-hidden="true"></i>
                        <?php echo app('translator')->get("$string_file.ride"); ?> <?php echo app('translator')->get("$string_file.details"); ?>
                    </h3>
                </header>
                <div class="panel-body container-fluid">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="row">
                                <?php if(!empty($offer_ride_user_details)): ?>
                                    <div class="col-md-6">
                                        <div class="card " style="width: auto; ">
                                            <h3 class="panel-title">
                                                <span><?php echo app('translator')->get("$string_file.offer"); ?> <?php echo app('translator')->get("$string_file.user"); ?> <?php echo app('translator')->get("$string_file.details"); ?></span>
                                            </h3>

                                            <div class="card-body shadow">

                                                <div class="card-block text-center">
                                                    <img src="<?php echo e(get_image($carpooling->User->UserProfileImage,'user')); ?>"
                                                         class="rounded-circle" width="120" height="120">

                                                    <h5 class="user-name mb-3"><?php echo e($carpooling->User->first_name." ".$carpooling->User->last_name); ?></h5>
                                                    <p class="user-job mb-3"><?php echo e($carpooling->User->UserPhone); ?></p>
                                                    <p class="user-info mb-3"><?php echo e($carpooling->User->email); ?></p>


                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                  
                                <?php endif; ?>
                                <div class="col-md-6">
                                    <h3 class="panel-title"><?php echo app('translator')->get("$string_file.basic"); ?> <?php echo app('translator')->get("$string_file.details"); ?></h3>
                                    <div class="card shadow">
                                        <table class="display nowrap table table-hover table-striped w-full"
                                               style="width:100%">
                                            <thead>
                                            <tr>
                                                <th><?php echo app('translator')->get("$string_file.sn"); ?></th>
                                                <th><?php echo app('translator')->get("$string_file.booked"); ?> <?php echo app('translator')->get("$string_file.seat"); ?></th>
                                                <th><?php echo app('translator')->get("$string_file.is_return"); ?></th>
                                                <th><?php echo app('translator')->get("$string_file.map"); ?> <?php echo app('translator')->get("$string_file.image"); ?></th>

                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php $sr = $offer_ride_details->firstItem() ?>
                                            <?php $__currentLoopData = $offer_ride_details; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ride_details): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <tr>
                                                    <td><?php echo e($sr); ?></td>
                                                    <td><?php echo e($carpooling->booked_seats); ?></td>
                                                    <td>
                                                        <?php if($ride_details->is_return == 1): ?>
                                                            <span><?php echo app('translator')->get("$string_file.yes"); ?></span>
                                                        <?php else: ?>
                                                            <span><?php echo app('translator')->get("$string_file.no"); ?></span>
                                                        <?php endif; ?>
                                                    </td>
                                                    <td>
                                                        <a href="<?php echo $ride_details->map_image; ?>"
                                                           target="_blank"><?php echo app('translator')->get("$string_file.view"); ?> <?php echo app('translator')->get("$string_file.map"); ?></a>
                                                    </td>




                                                </tr>
                                                <?php $sr++  ?>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </tbody>

                                        </table>
                                    </div>
                                </div>

                            </div>
                            <?php if(!empty($carpooling)): ?>
                                <div class="row">
                                    <div class="col-md-12">
                                        <h3 class="panel-title">
                                            <span><?php echo app('translator')->get("$string_file.vehicle"); ?> <?php echo app('translator')->get("$string_file.details"); ?></span></h3>
                                        <div class="user-btm-box">
                                            <div class="col-md-4 col-sm-4" style="float:left;">
                                                <a class="avatar img-bordered avatar-100" href="javascript:void(0)">
                                                    <img src="<?php echo e(get_image($carpooling->UserVehicle->vehicle_image,'user_vehicle_document')); ?>"
                                                    /></a>
                                            </div>
                                            <div class="col-md-8 col-sm-8" style="float:left;">
                                                <h5 class="user-name"></h5>
                                                <h6 class="user-job"><?php echo e($carpooling->UserVehicle->VehicleType->vehicleTypeName); ?></h6>
                                                <p class="user-job mb-3"><?php echo e($carpooling->UserVehicle->vehicle_number); ?></p>
                                                <p class="user-info mb-3"><?php echo e($carpooling->UserVehicle->vehicle_color); ?></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>
                            <hr>
                            <?php if(!empty($offer_ride_user_details)): ?>
                             <div class="col-md-6">
                                        <div class="card " style="width: auto; ">
                                            <h3 class="panel-title">
                                                <span><?php echo app('translator')->get("$string_file.taken"); ?> <?php echo app('translator')->get("$string_file.user"); ?> <?php echo app('translator')->get("$string_file.details"); ?></span>
                                            </h3>

                                            <div class="card-body shadow">

                                                <div class="card-block text-center">
                                                    <img src="<?php echo e(get_image($offer_ride_user_details->User->UserProfileImage,'user')); ?>"
                                                         class="rounded-circle" width="120" height="120">

                                                    <h5 class="user-name mb-3"><?php echo e($offer_ride_user_details->User->first_name." ".$offer_ride_user_details->User->last_name); ?></h5>
                                                    <p class="user-job mb-3"><?php echo e($offer_ride_user_details->User->UserPhone); ?></p>
                                                    <p class="user-info mb-3"><?php echo e($offer_ride_user_details->User->email); ?></p>


                                                </div>
                                            </div>

                                        </div>
                                    </div>
                            <?php endif; ?>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="card shadow">
                                        <div class="card-header">
                                            <h3 class="panel-title">
                                                <span><?php echo app('translator')->get("$string_file.ride"); ?> <?php echo app('translator')->get("$string_file.other"); ?> <?php echo app('translator')->get("$string_file.details"); ?></span>
                                            </h3>
                                        </div>
                                        <div class="card-body">
                                            <div class="card ">
                                                <table class="display nowrap table table-hover table-striped w-full"
                                                       style="width:100%">
                                                    <thead>
                                                    <tr>
                                                        <th><?php echo app('translator')->get("$string_file.sn"); ?></th>
                                                        <th><?php echo app('translator')->get("$string_file.estimate"); ?> <?php echo app('translator')->get("$string_file.distance"); ?></th>
                                                        <th><?php echo app('translator')->get("$string_file.total"); ?> <?php echo app('translator')->get("$string_file.charges"); ?></th>
                                                        <th><?php echo app('translator')->get("$string_file.ride"); ?> <?php echo app('translator')->get("$string_file.status"); ?></th>
                                                    </tr>
                                                    </thead>
                                                    <tboday>
                                                        <?php $sr = $offer_ride_details->firstItem() ?>
                                                        <?php $__currentLoopData = $offer_ride_details; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ride_details): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <tr>
                                                                <td><?php echo e($sr); ?></td>
                                                                <td><?php echo e($ride_details->estimate_distance_text); ?></td>
                                                                <td><?php echo e($ride_details->CarpoolingRide->total_amount); ?></td>
                                                                <td>
                                                                    <?php switch($ride_details->ride_status):
                                                                        case (1): ?>
                                                                        <span><?php echo app('translator')->get("$string_file.booked"); ?></span>
                                                                        <?php break; ?>
                                                                        <?php case (2): ?>
                                                                        <span><?php echo app('translator')->get("$string_file.booked"); ?> <?php echo app('translator')->get("$string_file.seat"); ?></span>
                                                                        <?php break; ?>
                                                                        <?php case (3): ?>
                                                                        <span>  <?php echo app('translator')->get("$string_file.active"); ?><?php echo app('translator')->get("$string_file.ride"); ?></span>
                                                                        <?php break; ?>
                                                                        <?php case (4): ?>
                                                                        <span><?php echo app('translator')->get("$string_file.complete"); ?> <?php echo app('translator')->get("$string_file.ride"); ?></span>
                                                                        <?php break; ?>
                                                                        <?php case (5): ?>
                                                                        <span><?php echo app('translator')->get("$string_file.cancel"); ?> <?php echo app('translator')->get("$string_file.ride"); ?></span>
                                                                        <?php break; ?>
                                                                        <?php case (6): ?>
                                                                        <span><?php echo app('translator')->get("$string_file.auto"); ?> <?php echo app('translator')->get("$string_file.cancel"); ?>  <?php echo app('translator')->get("$string_file.ride"); ?></span>
                                                                        <?php break; ?>

                                                                        <?php default: ?>
                                                                        <span>Something went wrong, please try again</span>
                                                                    <?php endswitch; ?>
                                                                </td>

                                                            </tr>
                                                            <?php $sr++  ?>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </tboday>

                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>


                        </div>
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-6  float-left">
                                    <h3 class="panel-title"><?php echo app('translator')->get("$string_file.pickup"); ?> <?php echo app('translator')->get("$string_file.location"); ?></h3>
                                </div>
                                <div class="col-md-6 float-right ">
                                    <h3 class="panel-title"><?php echo app('translator')->get("$string_file.drop"); ?> <?php echo app('translator')->get("$string_file.location"); ?></h3>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-12">
                                    <ul class="timeline timeline-simple">
                                        <?php $__currentLoopData = $offer_ride_details; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ride_details): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <li class="timeline-item">
                                                <div class="timeline-dot bg-success" data-placement="right"
                                                     data-toggle="tooltip" data-trigger="hover"
                                                     data-original-title=""></div>
                                                <div class="timeline-content">
                                                    <div class="card card-inverse border border-success card-shadow">
                                                        <div class="card-block">
                                                            <p class="card-text"
                                                               style="color:#000000"><?php echo e($ride_details->from_location); ?> </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="timeline-item timeline-reverse">
                                                <div class="timeline-dot bg-danger" data-placement="left"
                                                     data-toggle="tooltip"
                                                     data-trigger="hover" data-original-title=""></div>
                                                <div class="timeline-content">
                                                    <div class="card card-inverse border border-danger card-shadow">
                                                        <div class="card-block">
                                                            <p class="card-text"
                                                               style="color:#000000"><?php echo e($ride_details->to_location); ?> </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>

                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('merchant.layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/msprojectsappori/public_html/multi-service-v3/resources/views/merchant/car-pool-offer-rides/offer_ride_details.blade.php ENDPATH**/ ?>