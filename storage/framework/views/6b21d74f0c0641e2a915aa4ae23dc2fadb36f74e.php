
<?php $__env->startSection('content'); ?>
    <div class="page">
        <div class="page-content">
            <?php echo $__env->make("merchant.shared.errors-and-messages", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <div class="panel panel-bordered">
                <header class="panel-heading">
                    <div class="panel-actions">
                        <a href="<?php echo e(route('excel.ridenow')); ?>" data-toggle="tooltip">
                            <button type="button" class="btn btn-icon btn-primary float-right" style="margin:10px">
                                <i class="wb-download" title="<?php echo app('translator')->get("$string_file.export_excel"); ?>"></i>
                            </button>
                        </a>
                    </div>
                    <h3 class="panel-title"><i class="fa-taxi" aria-hidden="true"></i>
                        <?php echo app('translator')->get("$string_file.on_going_rides"); ?></h3>
                </header>
                <div class="panel-body container-fluid">
                    <div class="nav-tabs-horizontal" data-plugin="tabs">
                        <ul class="nav nav-tabs nav-tabs-line tabs-line-top" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <a class="nav-link active" id="base-tab11" data-toggle="tab" href="#exampleTabsLineTopOne"
                                   aria-controls="#exampleTabsLineTopOne" role="tab">
                                    <i class="icon fa-cab"></i><?php echo app('translator')->get("$string_file.ride_now"); ?></a></li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" id="base-tab12" data-toggle="tab" href="#exampleTabsLineTopTwo"
                                   aria-controls="#exampleTabsLineTopTwo" role="tab">
                                    <i class="icon fa-clock-o"></i><?php echo app('translator')->get("$string_file.ride"); ?>  <?php echo app('translator')->get("$string_file.later"); ?> </a></li>
                        </ul>
                        <div class="tab-content pt-20">
                            <div class="tab-pane active" id="exampleTabsLineTopOne" role="tabpanel">
                                <form action="<?php echo e(route('taxicompany.activeride.serach')); ?>"
                                      method="post">
                                    <?php echo csrf_field(); ?>
                                    <div class="table_search row p-3 ">
                                        <div class="col-md-2 active-margin-top">
                                            <?php echo app('translator')->get("$string_file.search_by"); ?> :
                                        </div>
                                        <div class="col-md-2 col-xs-12 form-group active-margin-top">
                                            <div class="">
                                                <input id="" name="booking_id"
                                                       placeholder="<?php echo app('translator')->get("$string_file.ride_id"); ?>"
                                                       class="form-control"
                                                       type="text">
                                            </div>
                                        </div>
                                        <div class="col-md-2 col-xs-12 form-group active-margin-top">
                                            <div class="">
                                                <input id="" name="rider"
                                                       placeholder="<?php echo app('translator')->get("$string_file.user_details"); ?>"
                                                       class="form-control"
                                                       type="text">

                                            </div>

                                        </div>
                                        <div class="col-md-2 col-xs-12 form-group active-margin-top">
                                            <div class="">
                                                <input id="" name="driver"
                                                       placeholder="<?php echo app('translator')->get("$string_file.driver_details"); ?>"
                                                       class="form-control"
                                                       type="text">
                                            </div>
                                        </div>
                                        <div class="col-md-2 col-xs-12 form-group active-margin-top">
                                            <div class="">
                                                <select class="form-control" name="booking_status" id="booking_status">
                                                    <option value=""><?php echo e(trans("$string_file.ride_status")); ?></option>
                                                    <option value="1001"><?php echo e(trans("$string_file.new_ride")); ?></option>
                                                    <option value="1002"> <?php echo e(trans("$string_file.accepted_by_driver")); ?></option>
                                                    <option value="1012"><?php echo e(trans("$string_file.partial_accepted")); ?></option>
                                                    <option value="1003"> <?php echo e(trans("$string_file.arrived_at_pickup")); ?></option>
                                                    <option value="1004"><?php echo e(trans("$string_file.ride_started")); ?></option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-2 col-xs-12 form-group active-margin-top">
                                            <button class="btn btn-primary" type="submit"
                                                    name="seabt12"><i class="fa fa-search" aria-hidden="true"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                                <table id="customDataTable" class="display nowrap table table-hover table-stripedw-full" style="width:100%">
                                    <thead>
                                    <tr>
                                        <th><?php echo app('translator')->get("$string_file.ride_id"); ?></th>
                                        <?php if($bookingConfig->ride_otp == 1): ?>
                                            <th><?php echo app('translator')->get("$string_file.otp"); ?></th>
                                        <?php endif; ?>
                                        <th><?php echo app('translator')->get("$string_file.current_status"); ?></th>
                                        <th><?php echo app('translator')->get("$string_file.user_details"); ?></th>
                                        <th><?php echo app('translator')->get("$string_file.driver_details"); ?></th>
                                        <th><?php echo app('translator')->get("$string_file.request_from"); ?></th>
                                        <th><?php echo app('translator')->get("$string_file.ride_details"); ?></th>
                                        <th><?php echo app('translator')->get("$string_file.pickup_drop"); ?></th>


                                        <th><?php echo app('translator')->get("$string_file.ride_time"); ?></th>
                                        <th><?php echo app('translator')->get("$string_file.estimated"); ?></th>
                                        <th><?php echo app('translator')->get("$string_file.payment_method"); ?></th>
                                        <th><?php echo app('translator')->get("$string_file.date"); ?></th>
                                        <th><?php echo app('translator')->get("$string_file.action"); ?></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php $__currentLoopData = $bookings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $booking): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td><a target="_blank"
                                                   class="address_link hyperLink"
                                                   href="<?php echo e(route('taxicompany.booking.details',$booking->id)); ?>"><?php echo e($booking->merchant_booking_id); ?></a>
                                            </td>
                                            <?php if($bookingConfig->ride_otp == 1): ?>
                                                <td><?php echo e($booking->ride_otp); ?></td>
                                            <?php endif; ?>
                                            <td style="text-align: center">
                                                <?php switch($booking->booking_status):
                                                    case (1001): ?>
                                                    <?php echo e(trans("$string_file.new_ride")); ?>

                                                    <br>

                                                    <?php echo e($booking->updated_at->toTimeString()); ?>

                                                    <?php break; ?>
                                                    <?php case (1012): ?>
                                                    <?php echo e(trans("$string_file.accepted_by_driver")); ?>

                                                    <br>

                                                    <?php echo e($booking->updated_at->toTimeString()); ?>

                                                    <?php break; ?>
                                                    <?php case (1002): ?>
                                                    <?php echo app('translator')->get('admin.message582'); ?>

                                                    <br>
                                                    <?php echo e($booking->updated_at->toTimeString()); ?>

                                                    <?php break; ?>
                                                    <?php case (1003): ?>
                                                    <?php echo app('translator')->get('admin.driver_arrived'); ?>
                                                    <br>

                                                    <?php echo e($booking->updated_at->toTimeString()); ?>

                                                    <?php break; ?>
                                                    <?php case (1004): ?>
                                                    <?php echo app('translator')->get('admin.begin'); ?>
                                                    <br>
                                                    <?php echo e($booking->updated_at->toTimeString()); ?>

                                                    <?php break; ?>
                                                <?php endswitch; ?>
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
                                                                         <?php echo e("********".substr($booking->Driver->phoneNumber,-2)); ?>

                                                                         <br>
                                                                         <?php echo e("********".substr($booking->Driver->email,-2)); ?>

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
                                            </td>

                                            <?php
                                                $service_text = ($booking->ServiceType) ? $booking->ServiceType->serviceName : $booking->deliveryType->name ;
                                            ?>

                                            <td><?php echo nl2br($booking->CountryArea->CountryAreaName ."\n". $service_text."\n".$booking->VehicleType->VehicleTypeName); ?></td>

                                            <td><a class="long_text hyperLink" target="_blank"
                                                   href="https://www.google.com/maps/place/<?php echo e($booking->pickup_location); ?>"><?php echo e($booking->pickup_location); ?></a></span>
                                                <a class="long_text hyperLink" target="_blank"
                                                   href="https://www.google.com/maps/place/<?php echo e($booking->drop_location); ?>"><?php echo e($booking->drop_location); ?></a>
                                            </td>
                                            <td>
                                                <?php echo e($booking->estimate_distance); ?><br>
                                                <?php echo e($booking->CountryArea->Country->isoCode .  $booking->estimate_bill); ?>

                                            </td>
                                            <td>
                                                <?php echo e($booking->PaymentMethod->payment_method); ?>

                                            </td>
                                            <td>
                                                <?php echo convertTimeToUSERzone($booking->created_at, $booking->CountryArea->timezone,null,$booking->Merchant); ?>

                                            </td>
                                            <td>

                                                <a target="_blank"
                                                   title="<?php echo app('translator')->get("$string_file.requested_drivers"); ?>"
                                                   href="<?php echo e(route('taxicompany.ride-requests',$booking->id)); ?>"
                                                   class="btn btn-sm btn-primary menu-icon btn_detail action_btn"><span
                                                            class="fa fa-list-alt"
                                                            data-original-title="<?php echo app('translator')->get('admin.message184'); ?>"
                                                            data-toggle="tooltip"
                                                            data-placement="top"></span></a>
                                                <a target="_blank"
                                                   title="<?php echo app('translator')->get("$string_file.ride_details"); ?>"
                                                   href="<?php echo e(route('taxicompany.booking.details',$booking->id)); ?>"
                                                   class="btn btn-sm btn-success menu-icon btn_money action_btn"><span
                                                            class="fa fa-info-circle"
                                                            data-original-title="<?php echo app('translator')->get("$string_file.service_details"); ?>"
                                                            data-toggle="tooltip"
                                                            data-placement="top"></span></a>
                                                <?php if(Auth::user('merchant')->can('ride_cancel_dispatch')): ?>
                                                    <span data-target="#cancelbooking"
                                                          data-toggle="modal"
                                                          id="<?php echo e($booking->id); ?>"><a
                                                                data-original-title="Cancel Booking"
                                                                data-toggle="tooltip"
                                                                id="<?php echo e($booking->id); ?>"
                                                                data-placement="top"
                                                                class="btn btn-sm btn-warning menu-icon btn_delete action_btn"> <i
                                                                    class="fa fa-times"></i> </a></span>
                                                <?php endif; ?>
                                                <?php if($booking->booking_status != 1001): ?>
                                                    <a target="_blank"
                                                       title="<?php echo app('translator')->get("$string_file.ride_details"); ?>"
                                                       href="<?php echo e(route('taxicompany.activeride.track',$booking->id)); ?>"
                                                       class="btn btn-sm btn-success menu-icon btn_money action_btn"><span
                                                                class="fa fa-map-marker"
                                                                data-original-title="<?php echo app('translator')->get('admin.trackRide'); ?>"
                                                                data-toggle="tooltip"
                                                                data-placement="top"></span></a>
                                                <?php endif; ?>
                                            </td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tbody>
                                </table>
                                <div class="pagination1 float-right"><?php echo e($bookings->links()); ?></div>
                            </div>
                            <div class="tab-pane" id="exampleTabsLineTopTwo" role="tabpanel">
                                <form method="post"
                                      action="<?php echo e(route('taxicompany.activeride.later.serach')); ?>">
                                    <?php echo csrf_field(); ?>
                                    <div class="table_search row p-3">
                                        <div class="col-sm-2 active-margin-top">
                                            <?php echo app('translator')->get("$string_file.search_by"); ?> :
                                        </div>
                                        <div class="col-md-2 col-xs-12 form-group active-margin-top">
                                            <div class="">
                                                <input id="" name="booking_id"
                                                       placeholder="<?php echo app('translator')->get("$string_file.ride_id"); ?>"
                                                       class="form-control"
                                                       type="text">
                                            </div>
                                        </div>
                                        <div class="col-md-2 col-xs-12 form-group active-margin-top">
                                            <div class="">
                                                <input id="" name="rider"
                                                       placeholder="<?php echo app('translator')->get("$string_file.user_details"); ?>"
                                                       class="form-control"
                                                       type="text">

                                            </div>
                                        </div>
                                        <div class="col-md-2 col-xs-12 form-group active-margin-top">
                                            <div class="">
                                                <input id="" name="driver"
                                                       placeholder="<?php echo app('translator')->get("$string_file.driver_details"); ?>"
                                                       class="form-control"
                                                       type="text">
                                            </div>
                                        </div>
                                        <div class="col-sm-2  col-xs-12 form-group active-margin-top">
                                            <button class="btn btn-primary" type="submit" name="seabt12"><i class="fa fa-search" aria-hidden="true"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                                <table id="customDataTable2" class="display nowrap table table-hover table-stripedw-full" style="width:100%">
                                    <thead>
                                    <tr>
                                        <th><?php echo app('translator')->get("$string_file.ride_id"); ?></th>
                                        <?php if($bookingConfig->ride_otp == 1): ?>
                                            <th><?php echo app('translator')->get("$string_file.otp"); ?></th>
                                        <?php endif; ?>
                                        <th><?php echo app('translator')->get("$string_file.current_status"); ?></th>
                                        <th><?php echo app('translator')->get("$string_file.user_details"); ?></th>
                                        <th><?php echo app('translator')->get("$string_file.driver_details"); ?></th>
                                        <th><?php echo app('translator')->get("$string_file.request_from"); ?></th>
                                        <th><?php echo app('translator')->get("$string_file.ride_details"); ?></th>
                                        <th><?php echo app('translator')->get("$string_file.pickup_drop"); ?></th>


                                        <th><?php echo app('translator')->get("$string_file.ride_time"); ?></th>
                                        <th><?php echo app('translator')->get("$string_file.estimated"); ?></th>
                                        <th><?php echo app('translator')->get("$string_file.payment_method"); ?></th>
                                        <th><?php echo app('translator')->get("$string_file.date"); ?></th>
                                        <th><?php echo app('translator')->get("$string_file.action"); ?></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php $__currentLoopData = $later_bookings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $booking): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td>
                                                <a class="address_link"
                                                   href="<?php echo e(route('taxicompany.booking.details',$booking->id)); ?>"><?php echo e($booking->merchant_booking_id); ?> </a>
                                            </td>
                                            <?php if($bookingConfig->ride_otp == 1): ?>
                                                <td><?php echo e($booking->ride_otp); ?></td>
                                            <?php endif; ?>
                                            <td style="text-align: center">
                                                <?php if(!empty($arr_status)): ?>
                                                    <?php echo e(isset($arr_status[$booking->booking_status]) ? $arr_status[$booking->booking_status]: ""); ?>

                                                    <?php endif; ?>
                                            </td>
                                            <td>
                                                <?php if(Auth::user()->demo == 1): ?>
                                                    <span class="long_text">
                                                        <?php echo e("********".substr($booking->User->UserName, -2)); ?>

                                                        <br>
                                                        <?php echo e("********".substr($booking->User->UserPhone, -2)); ?>

                                                        <br>
                                                        <?php echo e("********".substr($booking->User->email, -2)); ?>

                                                        </span>
                                                <?php else: ?>
                                                    <span class="long_text">
                                                        <?php echo e($booking->User->UserName); ?>

                                                        <br>
                                                        <?php echo e($booking->User->UserPhone); ?>

                                                        <br>
                                                        <?php echo e($booking->User->email); ?>

                                                        </span>
                                                <?php endif; ?>
                                            </td>
                                            <td>
                                                 <span class="long_text">
                                                    <?php if($booking->Driver): ?>
                                                         <?php if(Auth::user()->demo == 1): ?>
                                                             <?php echo e("********".substr($booking->Driver->first_name.' '.$booking->Driver->last_name, -2)); ?>

                                                             <br>
                                                             <?php echo e("********".substr($booking->Driver->phoneNumber, -2)); ?>

                                                             <br>
                                                             <?php echo e("********".substr($booking->Driver->email, -2)); ?>

                                                         <?php else: ?>
                                                             <?php echo e($booking->Driver->first_name.' '.$booking->Driver->last_name); ?>

                                                             <br>
                                                             <?php echo e($booking->Driver->phoneNumber); ?>

                                                             <br>
                                                             <?php echo e($booking->Driver->email); ?>

                                                         <?php endif; ?>
                                                     <?php else: ?>
                                                         <?php echo app('translator')->get("$string_file.not_assigned_yet"); ?>
                                                     <?php endif; ?>
                                                </span>
                                            </td>
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
                                            </td>
                                            <?php
                                                $service_text = ($booking->ServiceType) ? $booking->ServiceType->serviceName : $booking->deliveryType->name ;
                                            ?>
                                            <td><?php echo nl2br($booking->CountryArea->CountryAreaName ."\n". $service_text."\n".$booking->VehicleType->VehicleTypeName); ?></td>

                                            <td><a class="long_text hyperLink" target="_blank"
                                                   href="https://www.google.com/maps/place/<?php echo e($booking->pickup_location); ?>"><?php echo e($booking->pickup_location); ?></a>
                                                <a class="long_text hyperLink" target="_blank"
                                                   href="https://www.google.com/maps/place/<?php echo e($booking->drop_location); ?>"><?php echo e($booking->drop_location); ?></a>
                                            </td>
                                            <td>
                                                <?php echo e($booking->later_booking_date); ?><br>
                                                <?php echo e($booking->later_booking_time); ?>

                                            </td>
                                            <td>
                                                <?php echo e($booking->estimate_distance); ?><br>
                                                <?php echo e($booking->CountryArea->Country->isoCode . $booking->estimate_bill); ?>

                                            </td>
                                            <td>
                                                <?php echo e($booking->PaymentMethod->payment_method); ?>

                                            </td>
                                            <td>
                                                <?php echo convertTimeToUSERzone($booking->created_at, $booking->CountryArea->timezone,null,$booking->Merchant); ?>

                                            </td>
                                            <td>
                                                <a target="_blank"
                                                   title="<?php echo app('translator')->get("$string_file.ride_details"); ?>"
                                                   href="<?php echo e(route('taxicompany.booking.details',$booking->id)); ?>"
                                                   class="btn btn-sm btn-info menu-icon btn_money action_btn"><span
                                                            class="fa fa-info-circle"
                                                            data-original-title="<?php echo app('translator')->get("$string_file.service_details"); ?>"
                                                            data-toggle="tooltip"
                                                            data-placement="top"></span></a>
                                                <?php if(Auth::user('merchant')->can('ride_cancel_dispatch')): ?>
                                                    <span data-target="#cancelbooking"
                                                          data-toggle="modal"
                                                          id="<?php echo e($booking->id); ?>"><a
                                                                data-original-title="Cancel Booking"
                                                                data-toggle="tooltip"
                                                                id="<?php echo e($booking->id); ?>"
                                                                data-placement="top"
                                                                class="btn btn-sm btn-danger menu-icon btn_delete action_btn"> <i
                                                                    class="fa fa-times"></i> </a></span>

                                                <?php endif; ?>
                                                <?php if(!in_array($booking->booking_status,[1001,1012])): ?>
                                                    <a target="_blank"
                                                       title="<?php echo app('translator')->get("$string_file.ride_details"); ?>"
                                                       href="<?php echo e(route('taxicompany.activeride.track',$booking->id)); ?>"
                                                       class="btn btn-sm btn-success menu-icon btn_money action_btn"><span
                                                                class="fa fa-map-marker"
                                                                data-original-title="<?php echo app('translator')->get('admin.trackRide'); ?>"
                                                                data-toggle="tooltip"
                                                                data-placement="top"></span></a>
                                                <?php endif; ?>
                                            </td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tbody>
                                </table>
                                <div class="pagination1 float-right"><?php echo e($later_bookings->links()); ?></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade text-left" id="cancelbooking" tabindex="-1" role="dialog" aria-labelledby="myModalLabel33"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <label class="modal-title text-text-bold-600" id="myModalLabel33"><?php echo app('translator')->get('admin.message56'); ?></label>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="<?php echo e(route('taxicompany.cancelbooking')); ?>" method="post">
                    <?php echo csrf_field(); ?>
                    <div class="modal-body">
                        <div class="form-group">
                            <select class="form-control" name="cancel_reason_id" required>
                                <option value=""><?php echo app('translator')->get('admin.select_cancel_reason'); ?></option>
                                <?php $__currentLoopData = $cancelreasons; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cancelreason): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($cancelreason->id); ?>"><?php echo e($cancelreason->ReasonName); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>

                        <label><?php echo app('translator')->get("$string_file.additional_notes"); ?>: </label>
                        <div class="form-group">
                            <textarea class="form-control" id="title1" rows="3" name="description"
                                      placeholder="<?php echo app('translator')->get("$string_file.additional_notes"); ?>"></textarea>
                        </div>
                        <input type="hidden" name="booking_id" id="booking_id" value="">

                    </div>
                    <div class="modal-footer">
                        <input type="reset" class="btn btn-secondary" data-dismiss="modal" value="<?php echo app('translator')->get("$string_file.close"); ?>">
                        <input type="submit" class="btn btn-primary" value="Cancel Booking">
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('js'); ?>
    <script>
        $(document).ready(function () {
            $('#dataTable2').DataTable({
                searching: false,
                paging: false,
                info: false,
                "bSort": false,
            });
        });
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('taxicompany.layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/qazaq/public_html/admin.qazaq.taxi/ms-v3/resources/views/taxicompany/booking/active.blade.php ENDPATH**/ ?>