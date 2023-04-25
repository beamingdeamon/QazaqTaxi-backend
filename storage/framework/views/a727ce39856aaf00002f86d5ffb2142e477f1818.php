
<?php $__env->startSection('content'); ?>
    <div class="page">
        <div class="page-content">
            <?php if(session('noridecompleteexport')): ?>
                <div class="alert dark alert-icon alert-info alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">x</span>
                    </button>
                    <i class="icon wb-info" aria-hidden="true"></i><?php echo app('translator')->get('admin.message448'); ?>
                </div>
            <?php endif; ?>
            <div class="panel panel-bordered">
                <header class="panel-heading">
                    <div class="panel-actions">
                    </div>
                    <h3 class="panel-title"><i class="fa-taxi" aria-hidden="true"></i>
                        <?php echo app('translator')->get("$string_file.all_rides"); ?></h3>
                </header>
                <div class="panel-body container-fluid">
                    <form action="<?php echo e(route('taxicompany.all.serach')); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <div class="table_search row">
                            <div class="col-md-1 col-xs-12 form-group active-margin-top">
                                <?php echo app('translator')->get("$string_file.search_by"); ?>:
                            </div>
                            <div class="col-md-1 col-xs-12 form-group active-margin-top">
                                <div class="input-group">
                                    <input type="text" id="" name="booking_id"
                                           placeholder="<?php echo app('translator')->get("$string_file.ride_id"); ?>"
                                           class="form-control col-md-12 col-xs-12">
                                </div>
                            </div>
                            <div class="col-md-2 col-xs-12 form-group active-margin-top">
                                <div class="input-group">
                                    <input type="text" id="" name="rider"
                                           placeholder="<?php echo app('translator')->get("$string_file.user_details"); ?>"
                                           class="form-control col-md-12 col-xs-12">
                                </div>

                            </div>
                            <div class="col-md-2 col-xs-12 form-group active-margin-top">
                                <div class="input-group">
                                    <input type="text" id="" name="driver"
                                           placeholder="<?php echo app('translator')->get("$string_file.driver_details"); ?>"
                                           class="form-control col-md-12 col-xs-12">
                                </div>

                            </div>
                            <div class="col-md-2 col-xs-12 form-group active-margin-top">
                                <div class="input-group">
                                    <input type="text" id="" name="date"
                                           placeholder="<?php echo app('translator')->get("$string_file.date"); ?>"
                                           class="form-control col-md-12 col-xs-12 datepickersearch"
                                           id="datepickersearch" autocomplete="off">
                                </div>
                            </div>
                            <div class="col-md-2 col-xs-12 form-group active-margin-top">
                                <div class="">
                                    <?php echo Form::select("booking_status",add_blank_option($arr_status,trans("$string_file.ride_status")),NULL,['class'=>'form-control']); ?>














                                </div>
                            </div>
                            <div class="col-sm-2  col-xs-12 form-group active-margin-top">
                                <button class="btn btn-primary" type="submit"
                                        name="seabt12"><i
                                            class="fa fa-search" aria-hidden="true"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                    <table id="customDataTable" class="display nowrap table table-hover table-stripedw-full" style="width:100%">
                        <thead>
                        <tr>
                            <th><?php echo app('translator')->get("$string_file.ride_id"); ?></th>
                            <th><?php echo app('translator')->get("$string_file.ride_type"); ?></th>
                            <th><?php echo app('translator')->get("$string_file.user_details"); ?></th>
                            <th><?php echo app('translator')->get("$string_file.driver_details"); ?></th>
                            <th><?php echo app('translator')->get("$string_file.service_details"); ?></th>
                            <th><?php echo app('translator')->get("$string_file.service_area"); ?></th>
                            <th><?php echo app('translator')->get("$string_file.pickup_drop"); ?></th>


                            <th><?php echo app('translator')->get("$string_file.current_status"); ?></th>
                            <th><?php echo app('translator')->get("$string_file.payment"); ?></th>
                            <th><?php echo app('translator')->get("$string_file.created_at"); ?></th>
                            <th><?php echo app('translator')->get("$string_file.action"); ?></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $__currentLoopData = $bookings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $booking): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($booking->merchant_booking_id); ?></td>
                                <td>
                                    <?php if($booking->booking_type == 1): ?>
                                        <?php echo app('translator')->get("$string_file.ride_now"); ?>
                                    <?php else: ?>
                                        <?php echo app('translator')->get("$string_file.ride_later"); ?><br>(
                                        <?php echo convertTimeToUSERzone($booking->later_booking_date, $booking->CountryArea->timezone,null,$booking->Merchant, 2); ?><br>
                                        <?php echo e($booking->later_booking_time); ?> )
                                    <?php endif; ?>
                                </td>

                                <?php if(Auth::user()->demo == 1): ?>
                                    <td>
                                        <span class="long_text">
                                            <?php echo e("********".substr($booking->User->UserName,-2)); ?>

                                            <br>
                                            <?php echo e("********".substr($booking->User->UserPhone,-2)); ?>

                                            <br>
                                            <?php echo e("********".substr($booking->User->email,-2)); ?>

                                        </span>
                                    </td>
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
                                                        <?php echo e($booking->User->UserName); ?>

                                                        <br>
                                                        <?php echo e($booking->User->UserPhone); ?>

                                                        <br>
                                                        <?php echo e($booking->User->email); ?>

                                                        </span>
                                    </td>
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
                                <td><a class="long_text hyperLink" target="_blank"
                                       href="https://www.google.com/maps/place/<?php echo e($booking->pickup_location); ?>"><?php echo e($booking->pickup_location); ?></a>
                                    <a class="long_text hyperLink" target="_blank"
                                       href="https://www.google.com/maps/place/<?php echo e($booking->drop_location); ?>"><?php echo e($booking->drop_location); ?></a>
                                </td>
                                <td style="text-align: center">
                                    <?php switch($booking->booking_status):
                                        case (1001): ?>
                                        <?php echo app('translator')->get('admin.newbooking'); ?>
                                        <br>
                                        <?php echo convertTimeToUSERzone($booking->created_at, $booking->CountryArea->timezone,null,$booking->Merchant,3); ?>

                                        <?php break; ?>
                                        <?php case (1012): ?>
                                        <?php echo app('translator')->get('admin.message291'); ?>
                                        <br>

                                        <?php echo convertTimeToUSERzone($booking->created_at, $booking->CountryArea->timezone,null,$booking->Merchant,3); ?>

                                        <?php break; ?>
                                        <?php case (1002): ?>
                                        <?php echo app('translator')->get('admin.driverAccepted'); ?>

                                        <br>
                                        <?php echo convertTimeToUSERzone($booking->created_at, $booking->CountryArea->timezone,null,$booking->Merchant,3); ?>

                                        <?php break; ?>
                                        <?php case (1003): ?>
                                        <?php echo app('translator')->get('admin.driverArrived'); ?>
                                        <br>
                                        <?php echo convertTimeToUSERzone($booking->created_at, $booking->CountryArea->timezone,null,$booking->Merchant,3); ?>

                                        <?php break; ?>
                                        <?php case (1004): ?>
                                        <?php echo app('translator')->get('admin.begin'); ?>
                                        <br>
                                        <?php echo convertTimeToUSERzone($booking->created_at, $booking->CountryArea->timezone,null,$booking->Merchant,3); ?>

                                        <?php break; ?>
                                        <?php case (1005): ?>
                                        <?php echo app('translator')->get('admin.completedBooking'); ?>
                                        <br>
                                        <?php echo convertTimeToUSERzone($booking->created_at, $booking->CountryArea->timezone,null,$booking->Merchant,3); ?>

                                        <?php break; ?>
                                        <?php case (1006): ?>
                                        <?php echo app('translator')->get('admin.message48'); ?>
                                        <?php break; ?>
                                        <?php case (1007): ?>
                                        <?php echo app('translator')->get('admin.message49'); ?>
                                        <?php break; ?>
                                        <?php case (1008): ?>
                                        <?php echo app('translator')->get('admin.message50'); ?>
                                        <?php break; ?>
                                        <?php case (1016): ?>
                                        <?php echo app('translator')->get('admin.autoCancel'); ?>
                                        <br>
                                        <?php echo convertTimeToUSERzone($booking->created_at, $booking->CountryArea->timezone,null,$booking->Merchant,3); ?>

                                        <?php break; ?>
                                        <?php case (1018): ?>
                                        <?php echo app('translator')->get('admin.driver-no-show'); ?>
                                        <?php break; ?>
                                    <?php endswitch; ?>
                                </td>
                                <td>
                                    <?php echo e($booking->PaymentMethod->payment_method); ?>

                                </td>
                                <td>
                                    <?php echo convertTimeToUSERzone($booking->created_at, $booking->CountryArea->timezone,null,$booking->Merchant); ?>

                                </td>
                                <td>
                                    <a target="_blank" title="<?php echo app('translator')->get("$string_file.requested_drivers"); ?>"
                                       href="<?php echo e(route('taxicompany.ride-requests',$booking->id)); ?>"
                                       class="btn btn-sm btn-success menu-icon btn_detail action_btn"><span
                                                class="fa fa-list-alt"></span></a>

                                    <a target="_blank" title="<?php echo app('translator')->get("$string_file.ride_details"); ?>"
                                       href="<?php echo e(route('taxicompany.booking.details',$booking->id)); ?>"
                                       class="btn btn-sm btn-info menu-icon btn_money action_btn"><span
                                                class="fa fa-info-circle"
                                                title="Booking Details"></span></a>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                    <div class="pagination1 float-right"><?php echo e($bookings->links()); ?></div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('taxicompany.layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/qazaq/public_html/admin.qazaq.taxi/ms-v3/resources/views/taxicompany/booking/all-ride.blade.php ENDPATH**/ ?>