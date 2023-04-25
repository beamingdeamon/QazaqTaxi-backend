<?php $__env->startSection('content'); ?>
    <div class="page">
        <div class="page-content">
            <?php echo $__env->make("merchant.shared.errors-and-messages", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <div class="panel panel-bordered">
                <header class="panel-heading">
                    <div class="panel-actions">
                        <a href="<?php echo e(route('users.index')); ?>">
                            <button type="button" class="btn btn-icon btn-success float-right" style="margin:10px">
                                <i class="wb-reply"></i>
                            </button>
                        </a>
                        <a href="<?php echo e(route('excel.userRides',$user->id)); ?>" data-toggle="tooltip">
                            <button type="button" class="btn btn-icon btn-primary float-right" style="margin:10px">
                                <i class="wb-download" title="<?php echo app('translator')->get("$string_file.export_excel"); ?>"></i>
                            </button>
                        </a>
                    </div>
                    <h3 class="panel-title"><i class="fa-info-circle" aria-hidden="true"></i>
                        <?php echo app('translator')->get("$string_file.user_details"); ?></h3>
                </header>
                <div class="panel-body container-fluid">
                    <div id="user-profile">
                        <div class="row">
                            <!-- Column -->
                            <div class="col-md-4 col-xs-12">
                                <div class="card shadow">
                                    <div class="card-block text-center">
                                        <img src="<?php echo e(get_image($user->UserProfileImage,'user')); ?>"
                                             class="rounded-circle" width="120" height="120">
                                        <?php if(Auth::user()->demo == 1): ?>
                                            <h5 class="user-name mb-3"><?php echo e("********".substr($user->last_name,-2)); ?></h5>
                                            <p class="user-job mb-3"><?php echo e("********".substr($user->UserPhone,-2)); ?></p>
                                            <p class="user-info mb-3"><?php echo e("********".substr($user->email,-2)); ?></p>
                                        <?php else: ?>
                                            <h5 class="user-name mb-3"><?php echo e($user->first_name." ".$user->last_name); ?></h5>
                                            <p class="user-job mb-3"><?php echo e($user->UserPhone); ?></p>
                                            <p class="user-info mb-3"><?php echo e($user->email); ?></p>
                                        <?php endif; ?>

                                    </div>
                                </div>
                            </div>
                            <div class="col-md-8 col-xs-12 mt-20">
                                <div class="row mb-5">
                                    <div class="col-md-6 col-sm-6 col-xs-12 py-2 ">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class="h5 text-uppercase mb-1">
                                                    <i class="icon fa-car fa-2x text-gray-300"></i>
                                                    <?php echo app('translator')->get("$string_file.user_type"); ?>
                                                </div>
                                                <div class="mb-0">
                                                    <?php if($user->user_type == 1): ?>
                                                        <?php echo app('translator')->get("$string_file.corporate_user"); ?>
                                                    <?php else: ?>
                                                        <?php echo app('translator')->get("$string_file.retail"); ?>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-6 col-xs-12 py-2">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class="h5 text-uppercase mb-1">
                                                    <i class="icon fa-tag fa-2x text-gray-300"></i>
                                                    <?php echo app('translator')->get("$string_file.referral_code"); ?>
                                                </div>
                                                <div class="mb-0 text-gray-800"><?php echo e($user->ReferralCode); ?>

                                                </div>
                                            </div>
                                        </div>
                                        <!-- <div class="white-box"> -->
                                        <!-- <ul class="book_details"> -->
                                        <!-- <li> -->
                                    <!-- <h4><?php echo app('translator')->get("$string_file.referral_code"); ?></h4> -->
                                    <!-- <p><?php echo e($user->ReferralCode); ?></p> -->
                                        <!-- </li> -->
                                        <!-- </ul> -->
                                        <!-- </div> -->
                                    </div>
                                </div>
                                <div class="row mb-5">
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class="h5 text-uppercase mb-1">
                                                    <i class="icon fa-signing fa-2x text-gray-300"></i>
                                                    <?php echo app('translator')->get("$string_file.signup_type"); ?>
                                                </div>
                                                <div class="mb-0 text-gray-800">
                                                    <?php switch($user->UserSignupType):
                                                        case (1): ?>
                                                        <?php echo app('translator')->get("$string_file.normal"); ?>
                                                        <?php break; ?>
                                                        <?php case (2): ?>
                                                        <?php echo app('translator')->get("$string_file.google"); ?>
                                                        <?php break; ?>
                                                        <?php case (3): ?>
                                                        <?php echo app('translator')->get("$string_file.facebook"); ?>
                                                        <?php break; ?>
                                                    <?php endswitch; ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class="h5 text-uppercase mb-1">
                                                    <i class="icon fa-mobile fa-2x text-gray-300"></i>
                                                    <?php echo app('translator')->get("$string_file.signup_plateform"); ?>
                                                </div>
                                                <div class="mb-0 text-gray-800">
                                                    <?php switch($user->UserSignupFrom):
                                                        case (1): ?>
                                                        <?php echo app('translator')->get("$string_file.application"); ?>
                                                        <?php break; ?>
                                                        <?php case (2): ?>
                                                        <?php echo app('translator')->get("$string_file.admin"); ?>
                                                        <?php break; ?>
                                                        <?php case (3): ?>
                                                        <?php echo app('translator')->get("$string_file.web"); ?>
                                                        <?php break; ?>
                                                    <?php endswitch; ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-5">
                                    <div class="col-md-6 col-sm-6 col-xs-12 py-2">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class="h5 text-uppercase mb-1">
                                                    <i class="icon fa-calendar fa-2x text-gray-300"></i>
                                                    <?php echo app('translator')->get("$string_file.registered_date"); ?>
                                                </div>
                                                <div class="mb-0 text-gray-800">
                                                    <?php if(isset($user->CountryArea->timezone)): ?>
                                                        <?php echo convertTimeToUSERzone($user->created_at, $user->CountryArea->timezone, null, $user->Merchant); ?>

                                                    <?php else: ?>
                                                        <?php echo convertTimeToUSERzone($user->created_at, null, null, $user->Merchant); ?>

                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-6 col-xs-12 py-2">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class="h5 text-uppercase mb-1">
                                                    <i class="icon fa-calendar fa-2x text-gray-300"></i>
                                                    <?php echo app('translator')->get("$string_file.updated_at"); ?>
                                                </div>
                                                <div class="mb-0 text-gray-800">
                                                    <?php if(isset($user->CountryArea->timezone)): ?>
                                                        <?php echo convertTimeToUSERzone($user->updated_at, $user->CountryArea->timezone, null, $user->Merchant); ?>

                                                    <?php else: ?>
                                                        <?php echo convertTimeToUSERzone($user->updated_at, null, null, $user->Merchant); ?>

                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div class="row mb-5">
                                    <?php if($appConfig->gender == 1): ?>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <div class="row no-gutters align-items-center">
                                                <div class="col mr-2">
                                                    <div class="h5 text-uppercase mb-1">
                                                        <i class="icon fa-sign-in fa-2x text-gray-300"></i>
                                                        <?php echo app('translator')->get("$string_file.gender"); ?>
                                                    </div>
                                                    <div class="mb-0 text-gray-800">
                                                        <?php if($user->user_gender == 1): ?> <?php echo app('translator')->get("$string_file.male"); ?> <?php else: ?> <?php echo app('translator')->get("$string_file.female"); ?>  <?php endif; ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                    <?php if($appConfig->smoker == 1): ?>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <div class="row no-gutters align-items-center">
                                                <div class="col mr-2">
                                                    <div class="h5 text-uppercase mb-1">
                                                        <i class="icon wi-smoke text-gray-300" area-hidden="true"></i>
                                                        <?php echo app('translator')->get("$string_file.smoke"); ?>
                                                    </div>
                                                    <div class="mb-0 text-gray-800">
                                                    </div>
                                                    <?php if($user->smoker_type == 1): ?>  <?php echo app('translator')->get("$string_file.smoker"); ?> <?php else: ?>  <?php echo app('translator')->get("$string_file.non_smoker"); ?> <?php endif; ?>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <?php if(isset($config->user_bank_details_enable) && $config->user_bank_details_enable == 1): ?>
                                <div class="col-md-12 mt-20 mb-10">
                                    <h5><?php echo app('translator')->get("common.bank"); ?> <?php echo app('translator')->get("common.details"); ?></h5>
                                    <hr>
                                    <div class="card shadow">
                                        <div class="card-block">
                                            <?php if(Auth::user()->demo == 1): ?>
                                                <div class="row">
                                                    <div class="col-md-3">
                                                        <span class="h5 text-uppercase mb-1"> <?php echo app('translator')->get("common.bank"); ?> <?php echo app('translator')->get("common.name"); ?> :</span>
                                                        <?php echo e("********".substr($user->bank_name,-2)); ?>

                                                    </div>
                                                    <div class="col-md-3">
                                                        <span class="h5 text-uppercase mb-1"> <?php echo app('translator')->get("common.account"); ?> <?php echo app('translator')->get("common.holder"); ?> <?php echo app('translator')->get("common.name"); ?> :</span>
                                                        <?php echo e("********".substr($user->account_holder_name,-2)); ?>

                                                    </div>
                                                    <div class="col-md-3">
                                                        <span class="h5 text-uppercase mb-1"> <?php echo app('translator')->get("common.account"); ?> <?php echo app('translator')->get("common.number"); ?> :</span>
                                                        <?php echo e("********".substr($user->account_number,-2)); ?>

                                                    </div>
                                                    <div class="col-md-3">
                                                        <span class="h5 text-uppercase mb-1"> <?php echo app('translator')->get("common.online"); ?> <?php echo app('translator')->get("common.transaction"); ?> <?php echo app('translator')->get("common.code"); ?> :</span>
                                                        <?php echo e("********".substr($user->online_code,-2)); ?>

                                                    </div>
                                                    <div class="col-md-3">
                                                        <span class="h5 text-uppercase mb-1"> <?php echo app('translator')->get("common.account"); ?> <?php echo app('translator')->get("common.type"); ?> :</span>
                                                        <?php echo e("********"); ?>

                                                    </div>
                                                </div>
                                            <?php else: ?>
                                                <div class="row">
                                                    <div class="col-md-3">
                                                        <span class="h5 text-uppercase mb-1"> <?php echo app('translator')->get("common.bank"); ?> <?php echo app('translator')->get("common.name"); ?> :</span>
                                                        <?php echo e($user->bank_name); ?>

                                                    </div>
                                                    <div class="col-md-3">
                                                        <span class="h5 text-uppercase mb-1"> <?php echo app('translator')->get("common.account"); ?> <?php echo app('translator')->get("common.holder"); ?> <?php echo app('translator')->get("common.name"); ?> :</span>
                                                        <?php echo e($user->account_holder_name); ?>

                                                    </div>
                                                    <div class="col-md-3">
                                                        <span class="h5 text-uppercase mb-1"> <?php echo app('translator')->get("common.account"); ?> <?php echo app('translator')->get("common.number"); ?> :</span>
                                                        <?php echo e($user->account_number); ?>

                                                    </div>
                                                    <div class="col-md-3">
                                                        <span class="h5 text-uppercase mb-1"> <?php echo app('translator')->get("common.online"); ?> <?php echo app('translator')->get("common.transaction"); ?> <?php echo app('translator')->get("common.code"); ?> :</span>
                                                        <?php echo e($user->online_code); ?>

                                                    </div>
                                                    <div class="col-md-3">
                                                        <span class="h5 text-uppercase mb-1"> <?php echo app('translator')->get("common.account"); ?> <?php echo app('translator')->get("common.type"); ?> :</span>
                                                        <?php if(!empty($user->AccountType)): ?>
                                                            <?php if($user->AccountType->LangAccountTypeSingle): ?>
                                                                <?php echo e($user->AccountType->LangAccountTypeSingle->name); ?>

                                                            <?php else: ?>
                                                                <?php echo e($user->AccountType->LangAccountTypeAny->name); ?>

                                                            <?php endif; ?>
                                                        <?php else: ?>
                                                            ---
                                                        <?php endif; ?>
                                                    </div>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>
                            <?php if(in_array('CARPOOLING',$merchant_segment)): ?>
                                <div class="col-md-12 mt-20 mb-10">
                                    <?php if(!empty($user->OwnerVehicle) && $user->OwnerVehicle->count() > 0): ?>
                                        <h5><?php echo app('translator')->get("$string_file.self"); ?> <?php echo app('translator')->get("$string_file.vehicle"); ?></h5>
                                        <hr>
                                    <?php endif; ?>
                                    <?php $__currentLoopData = $user->OwnerVehicle; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $owner_vehicle): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div style="border:1px solid #e4eaec; border-radius: 5px;" class="mb-2 p-2">
                                            <div class="row mt-20 mb-5">
                                                <div class="col-md-6">
                                                    <h5><?php echo app('translator')->get("$string_file.vehicle"); ?> <?php echo app('translator')->get("common.no"); ?>
                                                        : <?php echo e($owner_vehicle->vehicle_number); ?></h5>
                                                    <span class=""><b><?php echo app('translator')->get("$string_file.vehicle"); ?> <?php echo app('translator')->get("common.type"); ?> </b></span>
                                                    : <?php echo e(isset($owner_vehicle->VehicleType->VehicleTypeName) ? $owner_vehicle->VehicleType->VehicleTypeName : "---"); ?>

                                                    |
                                                    <span class=""><b><?php echo app('translator')->get("$string_file.vehicle"); ?> <?php echo app('translator')->get("common.model"); ?>  </b></span>
                                                    : <?php echo e(isset($owner_vehicle->VehicleModel->VehicleModelName) ? $owner_vehicle->VehicleModel->VehicleModelName : "---"); ?>

                                                    |
                                                    <span class=""><b><?php echo app('translator')->get("$string_file.vehicle"); ?> <?php echo app('translator')->get("common.make"); ?>  </b></span>
                                                    : <?php echo e(isset($owner_vehicle->VehicleMake->VehicleMakeName) ? $owner_vehicle->VehicleMake->VehicleMakeName : "---"); ?>

                                                    |<br>
                                                    
                                                    
                                                    
                                                    <span class=""><b><?php echo app('translator')->get("$string_file.vehicle"); ?> <?php echo app('translator')->get("common.registered"); ?> <?php echo app('translator')->get("common.date"); ?></b></span>
                                                    : <?php echo e(isset($owner_vehicle->vehicle_register_date) ? $owner_vehicle->vehicle_register_date : "---"); ?>

                                                    |
                                                    <br>
                                                </div>
                                                <div class="col-md-3">
                                                    <h6><?php echo app('translator')->get("$string_file.vehicle"); ?> <?php echo app('translator')->get("common.image"); ?> </h6>
                                                    <div class="" style="width: 6.5rem;">
                                                        <div class=" bg-light">
                                                            <?php $vehicle_image = get_image($owner_vehicle->vehicle_image,'user_vehicle_document'); ?>
                                                            <a href="<?php echo e($vehicle_image); ?>" target="_blank"><img
                                                                        src="<?php echo e($vehicle_image); ?>"
                                                                        style="width:100%;height:80px;"></a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <h6><?php echo app('translator')->get("$string_file.vehicle"); ?>  <?php echo app('translator')->get("common.number"); ?> <?php echo app('translator')->get("$string_file.plate"); ?>  <?php echo app('translator')->get("common.image"); ?> </h6>
                                                    <div class="" style="width: 6.5rem;">
                                                        <div class=" bg-light">
                                                            <?php $vehicle_number_plate_image = get_image($owner_vehicle->vehicle_number_plate_image,'user_vehicle_document'); ?>
                                                            <a href="<?php echo e($vehicle_number_plate_image); ?>" target="_blank"><img
                                                                        src="<?php echo e($vehicle_number_plate_image); ?>"
                                                                        style="width:100%;height:80px;"></a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="table-responsive">
                                                        <table class="table table-bordered" id="dataTable">
                                                            <thead>
                                                            <tr>
                                                                <th><?php echo app('translator')->get("common.document"); ?> <?php echo app('translator')->get("common.name"); ?></th>
                                                                <th><?php echo app('translator')->get('common.document'); ?></th>
                                                                <th><?php echo app('translator')->get('common.status'); ?></th>
                                                                <th><?php echo app('translator')->get("common.expire"); ?> <?php echo app('translator')->get("common.date"); ?></th>
                                                                <th><?php echo app('translator')->get("common.uploaded"); ?> <?php echo app('translator')->get("common.time"); ?></th>
                                                            </tr>
                                                            </thead>
                                                            <tbody>
                                                            <?php if(isset($owner_vehicle->UserVehicleDocument)): ?>
                                                                <?php $__currentLoopData = $owner_vehicle->UserVehicleDocument; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $document): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                    <tr>
                                                                        <td> <?php echo e($document->Document->documentname); ?></td>
                                                                        <td>
                                                                            <a href="<?php echo e(get_image($document->document,'user_vehicle_document')); ?>"
                                                                               target="_blank"><img
                                                                                        src="<?php echo e(get_image($document->document,'user_vehicle_document')); ?>"
                                                                                        style="width:60px;height:60px;border-radius: 10px"></a>
                                                                        </td>
                                                                        <td>
                                                                            <?php switch($document->document_verification_status):
                                                                                case (1): ?>
                                                                                <?php echo app('translator')->get("common.pending"); ?> <?php echo app('translator')->get("common.for"); ?> <?php echo app('translator')->get("common.verification"); ?>
                                                                                <?php break; ?>
                                                                                <?php case (2): ?>
                                                                                <?php echo app('translator')->get("common.verified"); ?>
                                                                                <?php break; ?>
                                                                                <?php case (3): ?>
                                                                                <?php echo app('translator')->get("common.rejected"); ?>
                                                                                <?php break; ?>
                                                                            <?php endswitch; ?>
                                                                        </td>
                                                                        <td>
                                                                            <?php echo e($document->expire_date); ?>

                                                                        </td>
                                                                        <td>
                                                                            <?php echo e($document->created_at); ?>

                                                                        </td>
                                                                    </tr>
                                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                            <?php endif; ?>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php if($owner_vehicle->vehicle_verification_status == 1): ?>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="float-right mt-10">
                                                            <a href="<?php echo e(route('merchant.user-vehicle-verify',[$owner_vehicle->id])); ?>">
                                                                <button class="btn btn-success float-right"><?php echo app('translator')->get("common.approve"); ?></button>
                                                            </a>
                                                            <button class="btn btn-danger float-right mr-2"
                                                                    onclick="rejectVehicle(<?php echo e($owner_vehicle->id); ?>)"
                                                            ><?php echo app('translator')->get("common.reject"); ?>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php if(!empty($sharing_vehicles) && $sharing_vehicles->count() > 0): ?>
                                        <h5><?php echo app('translator')->get("$string_file.sharing"); ?> <?php echo app('translator')->get("$string_file.vehicle"); ?></h5>
                                        <hr>
                                    <?php endif; ?>
                                    <?php $__currentLoopData = $sharing_vehicles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sharing_vehicle): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div class="row mt-20 mb-5">
                                            <div class="col-md-6">
                                                <h5><?php echo app('translator')->get("$string_file.vehicle"); ?> <?php echo app('translator')->get("common.no"); ?>
                                                    : <?php echo e($sharing_vehicle->vehicle_number); ?></h5>
                                                <span class=""><b><?php echo app('translator')->get("$string_file.vehicle"); ?> <?php echo app('translator')->get("common.type"); ?> </b></span>
                                                : <?php echo e(isset($sharing_vehicle->VehicleType->VehicleTypeName) ? $sharing_vehicle->VehicleType->VehicleTypeName : "---"); ?>

                                                |
                                                <span class=""><b><?php echo app('translator')->get("$string_file.vehicle"); ?> <?php echo app('translator')->get("common.model"); ?>  </b></span>
                                                : <?php echo e(isset($sharing_vehicle->VehicleModel->VehicleModelName) ? $sharing_vehicle->VehicleModel->VehicleModelName : "---"); ?>

                                                |
                                                <span class=""><b><?php echo app('translator')->get("$string_file.vehicle"); ?> <?php echo app('translator')->get("common.make"); ?>  </b></span>
                                                : <?php echo e(isset($sharing_vehicle->VehicleMake->VehicleMakeName) ? $sharing_vehicle->VehicleMake->VehicleMakeName : "---"); ?>

                                                |<br>
                                                <span class=""><b><?php echo app('translator')->get("$string_file.vehicle"); ?> <?php echo app('translator')->get("common.registered"); ?> <?php echo app('translator')->get("common.date"); ?></b></span>
                                                : <?php echo e(isset($sharing_vehicle->vehicle_register_date) ? $sharing_vehicle->vehicle_register_date : "---"); ?>

                                                |
                                                <br>
                                            </div>
                                            <div class="col-md-3">
                                                <h6><?php echo app('translator')->get("$string_file.vehicle"); ?> <?php echo app('translator')->get("common.image"); ?> </h6>
                                                <div class="" style="width: 6.5rem;">
                                                    <div class=" bg-light">
                                                        <?php $vehicle_image = get_image($sharing_vehicle->vehicle_image,'user_vehicle_document'); ?>
                                                        <a href="<?php echo e($vehicle_image); ?>" target="_blank"><img
                                                                    src="<?php echo e($vehicle_image); ?>"
                                                                    style="width:100%;height:80px;"></a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <h6><?php echo app('translator')->get("$string_file.vehicle"); ?>  <?php echo app('translator')->get("common.number"); ?> <?php echo app('translator')->get("$string_file.plate"); ?>  <?php echo app('translator')->get("common.image"); ?> </h6>
                                                <div class="" style="width: 6.5rem;">
                                                    <div class=" bg-light">
                                                        <?php $vehicle_number_plate_image = get_image($sharing_vehicle->vehicle_number_plate_image,'user_vehicle_document'); ?>
                                                        <a href="<?php echo e($vehicle_number_plate_image); ?>" target="_blank"><img
                                                                    src="<?php echo e($vehicle_number_plate_image); ?>"
                                                                    style="width:100%;height:80px;"></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="table-responsive">
                                                    <table class="table table-bordered" id="dataTable">
                                                        <thead>
                                                        <tr>
                                                            <th><?php echo app('translator')->get("common.document"); ?> <?php echo app('translator')->get("common.name"); ?></th>
                                                            <th><?php echo app('translator')->get('common.document'); ?></th>
                                                            <th><?php echo app('translator')->get('common.status'); ?></th>
                                                            <th><?php echo app('translator')->get("common.expire"); ?> <?php echo app('translator')->get("common.date"); ?></th>
                                                            <th><?php echo app('translator')->get("common.uploaded"); ?> <?php echo app('translator')->get("common.time"); ?></th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        <?php if(isset($sharing_vehicle->UserVehicleDocument)): ?>
                                                            <?php $__currentLoopData = $sharing_vehicle->UserVehicleDocument; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $document): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                <tr>
                                                                    <td> <?php echo e($document->Document->documentname); ?></td>
                                                                    <td>
                                                                        <a href="<?php echo e(get_image($document->document,'user_vehicle_document')); ?>"
                                                                           target="_blank"><img
                                                                                    src="<?php echo e(get_image($document->document,'user_vehicle_document')); ?>"
                                                                                    style="width:60px;height:60px;border-radius: 10px"></a>
                                                                    </td>
                                                                    <td>
                                                                        <?php switch($document->document_verification_status):
                                                                            case (1): ?>
                                                                            <?php echo app('translator')->get("common.pending"); ?> <?php echo app('translator')->get("common.for"); ?> <?php echo app('translator')->get("common.verification"); ?>
                                                                            <?php break; ?>
                                                                            <?php case (2): ?>
                                                                            <?php echo app('translator')->get("common.verified"); ?>
                                                                            <?php break; ?>
                                                                            <?php case (3): ?>
                                                                            <?php echo app('translator')->get("common.rejected"); ?>
                                                                            <?php break; ?>
                                                                        <?php endswitch; ?>
                                                                    </td>
                                                                    <td>
                                                                        <?php echo e($document->expire_date); ?>

                                                                    </td>
                                                                    <td>
                                                                        <?php echo e($document->created_at); ?>

                                                                    </td>
                                                                </tr>
                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                        <?php endif; ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                            <?php endif; ?>
                            <div class="col-md-12 mt-30">
                                <table id="customDataTable"
                                       class="display nowrap table table-hover table-striped w-full" style="width:100%">
                                    <thead>
                                    <tr>
                                        <th><?php echo app('translator')->get("$string_file.sn"); ?></th>
                                        <th><?php echo app('translator')->get("$string_file.ride_type"); ?></th>
                                        <th><?php echo app('translator')->get("$string_file.driver_details"); ?></th>
                                        <th><?php echo app('translator')->get("$string_file.service_details"); ?></th>
                                        <th><?php echo app('translator')->get("$string_file.service_area"); ?> </th>
                                        <th><?php echo app('translator')->get("$string_file.pickup_drop"); ?></th>
                                        <th><?php echo app('translator')->get("$string_file.current_status"); ?></th>
                                        <th><?php echo app('translator')->get("$string_file.payment"); ?></th>
                                        <th><?php echo app('translator')->get("$string_file.created_at"); ?></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php $sr = $bookings->firstItem() ?>
                                    <?php $__currentLoopData = $bookings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $booking): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td><?php echo e($sr); ?></td>
                                            <td>
                                                <?php if($booking->booking_type == 1): ?>
                                                    <?php echo app('translator')->get("$string_file.ride_now"); ?>
                                                <?php else: ?>
                                                    <?php echo app('translator')->get("$string_file.ride_later"); ?><br>(
                                                    <?php echo convertTimeToUSERzone($booking->later_booking_date, $booking->CountryArea->timezone,null,$booking->Merchant, 2); ?>

                                                    <br>
                                                    <?php echo e($booking->later_booking_time); ?> )
                                                <?php endif; ?>
                                            </td>
                                            <?php if(Auth::user()->demo == 1): ?>
                                                <td>
                                                         <span class="long_text">
                                                    <?php if($booking->Driver): ?>
                                                                 <?php echo e('********'.substr($booking->Driver->last_name,-2)); ?>

                                                                 <br>
                                                                 <?php echo e('********'.substr($booking->Driver->phoneNumber,-2)); ?>

                                                                 <br>
                                                                 <?php echo e('********'.substr($booking->Driver->email,-2)); ?>

                                                             <?php else: ?>
                                                                 <?php echo app('translator')->get("$string_file.not_assigned_yet"); ?>
                                                             <?php endif; ?>
                                                    </span>
                                                </td>
                                            <?php else: ?>
                                                <td>
                                                         <span class="long_text">
                                                    <?php if($booking->Driver): ?>
                                                                 <?php echo e($booking->Driver->first_name.' '.$booking->Driver->last_name); ?>

                                                                 <br>
                                                                 <?php echo e($booking->Driver->phoneNumber); ?>

                                                                 <br>
                                                                 <?php echo e($booking->Driver->email); ?>

                                                             <?php else: ?>
                                                                 <?php echo app('translator')->get("$string_file.not_assigned_yet"); ?>
                                                             <?php endif; ?>
                                                    </span>
                                                </td>
                                            <?php endif; ?>
                                            <td>
                                                <?php switch($booking->platform):
                                                    case (1): ?>
                                                    <?php echo app('translator')->get("$string_file.application"); ?>
                                                    <?php break; ?>
                                                    <?php case (2): ?>
                                                    <?php echo app('translator')->get("$string_file.admin"); ?>
                                                    <?php break; ?>
                                                    <?php case (3): ?>
                                                    <?php echo app('translator')->get("$string_file.web"); ?>
                                                    <?php break; ?>
                                                <?php endswitch; ?>
                                                <br>
                                                <?php
                                                    $service_text = ($booking->ServiceType) ? $booking->ServiceType->serviceName : $booking->deliveryType->name ;
                                                ?>
                                                <?php echo e($service_text); ?> <br>
                                                <?php echo e($booking->VehicleType->VehicleTypeName); ?>

                                            </td>
                                            <td> <?php echo e($booking->CountryArea->CountryAreaName); ?></td>
                                            <td>
                                                <a title="<?php echo e($booking->pickup_location); ?>"
                                                   href="https://www.google.com/maps/place/<?php echo e($booking->pickup_location); ?>" class="btn btn-icon btn-success ml-20"><i class="icon wb-map"></i></a>
                                                <a title="<?php echo e($booking->drop_location); ?>"
                                                   href="https://www.google.com/maps/place/<?php echo e($booking->drop_location); ?>" class="btn btn-icon btn-danger ml-20"><i class="icon fa-tint"></i></a>
                                            </td>
                                            <td style="text-align: center">
                                                <?php if(!empty($arr_booking_status)): ?>
                                                    <?php echo isset($arr_booking_status[$booking->booking_status]) ? $arr_booking_status[$booking->booking_status] : ""; ?>

                                                    <br>
                                                    <?php echo app('translator')->get("$string_file.at"); ?> <?php echo convertTimeToUSERzone($booking->updated_at, $booking->CountryArea->timezone,null,$booking->Merchant, 3); ?>

                                                <?php endif; ?>
                                            </td>
                                            <td>
                                                <?php echo e($booking->PaymentMethod->payment_method); ?>

                                            </td>
                                            <td>
                                                <?php echo convertTimeToUSERzone($booking->created_at, $user->CountryArea->timezone, null, $booking->Merchant); ?>

                                            </td>
                                        </tr>
                                        <?php $sr++ ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tbody>
                                </table>
                                <div class="pagination1 float-right"><?php echo e($bookings->links()); ?></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog"
         aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <form class="form-group" action="<?php echo e(route('merchant.user-vehicle-reject')); ?>" method="post">
                    <?php echo csrf_field(); ?>
                    <div class="modal-header">
                        <h5 class="modal-title"
                            id="exampleModalCenterTitle"><?php echo app('translator')->get("common.reject"); ?> <?php echo app('translator')->get("common.user"); ?> <?php echo app('translator')->get("$string_file.vehicle"); ?></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <input type="hidden" value="<?php echo e($user->id); ?>" name="user_id">
                            <hr>
                            <div class="col-md-12">
                                <h5><?php echo app('translator')->get("$string_file.vehicle"); ?> <?php echo app('translator')->get("common.documents"); ?></h5>
                            </div>
                            <input type="hidden" value=""
                                   name="user_vehicle_id" id="user_vehicle_id">
                            <div id="doc_check_list"></div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <textarea class="form-control" placeholder="<?php echo app('translator')->get("common.comment"); ?>" name="comment"
                                          required></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary"
                                data-dismiss="modal"><?php echo app('translator')->get("common.close"); ?></button>
                        <button type="submit" class="btn btn-primary"><?php echo app('translator')->get("common.reject"); ?> </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('js'); ?>
    <script>
        $('#sub').on('click', function () {
            $('#myLoader').removeClass('d-none');
            $('#myLoader').addClass('d-flex');
        });
    </script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script>
        function rejectVehicle(id) {
            $.ajax({
                type: "GET",
                data: {user_vehicle_id: id},
                url: "<?php echo e(route('merchant.user-vehicle-document')); ?>",
            }).done(function (data) {
                $("#doc_check_list").html(data);
                $("#user_vehicle_id").val(id);
                $("#exampleModalCenter").modal('show');
            });
        }
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('merchant.layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/msprojectsappori/public_html/multi-service-v3/resources/views/merchant/user/show.blade.php ENDPATH**/ ?>