
<?php $__env->startSection('content'); ?>
    <div class="page">
        <div class="page-content container-fluid">
            <?php if(session('sosadded')): ?>
                <div class="col-md-6 alert alert-icon-right alert-info alert-dismissible mb-2" role="alert">
                    <span class="alert-icon"><i class="fa fa-info"></i></span>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                    <strong><?php echo app('translator')->get("$string_file.notification"); ?></strong>
                </div>
            <?php endif; ?>
            <div class="panel panel-bordered">
                <header class="panel-heading">
                    <div class="panel-actions">





                    </div>
                    <h3 class="panel-title">
                        <i class="wb-flag" aria-hidden="true"></i>
                        <?php echo app('translator')->get("$string_file.reviews_and_symbol_ratings"); ?></h3>
                </header>
                <div class="panel-body container-fluid">
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    

                    <form action="<?php echo e(route('taxicompany.ratings.search')); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <div class="table_search row">
                            <div class="col-md-2 col-xs-12 form-group ">
                                <div class="input-group">
                                    <input type="text" id="" name="booking_id"
                                           placeholder="<?php echo app('translator')->get("$string_file.ride_id"); ?>"
                                           class="form-control col-md-12 col-xs-12">
                                </div>
                            </div>
                            <div class="col-md-2 col-xs-12 form-group ">
                                <div class="input-group">
                                    <input type="text" id="" name="rider"
                                           placeholder="<?php echo app('translator')->get("$string_file.user_details"); ?>"
                                           class="form-control col-md-12 col-xs-12">
                                </div>
                            </div>
                            <div class="col-md-2 col-xs-12 form-group ">
                                <div class="input-group">
                                    <input type="text" id="" name="driver"
                                           placeholder="<?php echo app('translator')->get("$string_file.driver_details"); ?>"
                                           class="form-control col-md-12 col-xs-12">
                                </div>
                            </div>
                            <div class="col-sm-2  col-xs-12 form-group ">
                                <button class="btn btn-primary" type="submit" name="seabt12"><i
                                            class="fa fa-search" aria-hidden="true"></i>
                                </button>
                            </div>
                            <div class="col-sm-4 float-right form-group">

                            </div>
                        </div>
                    </form>
                    <table id="customDataTable" class="display nowrap table table-hover table-striped w-full" style="width:100%">
                        <thead>
                        <tr>
                            <th><?php echo app('translator')->get("$string_file.sn"); ?></th>
                            <th><?php echo app('translator')->get("$string_file.ride_id"); ?></th>
                            <th><?php echo app('translator')->get("$string_file.ride_type"); ?></th>
                            <th><?php echo app('translator')->get("$string_file.user_details"); ?></th>
                            <th><?php echo app('translator')->get("$string_file.rating_by_user"); ?> </th>
                            <th><?php echo app('translator')->get("$string_file.user"); ?>  <?php echo app('translator')->get("$string_file.review"); ?></th>
                            <th><?php echo app('translator')->get("$string_file.driver_details"); ?></th>
                            <th><?php echo app('translator')->get("$string_file.rating"); ?>  <?php echo app('translator')->get("$string_file.by_driver"); ?></th>
                            <th><?php echo app('translator')->get("$string_file.driver"); ?>  <?php echo app('translator')->get("$string_file.review"); ?></th>
                            <th><?php echo app('translator')->get("$string_file.date_and_symbol_time"); ?></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $sr = $ratings->firstItem() ?>
                        <?php $__currentLoopData = $ratings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rating): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($sr); ?></td>
                                <td><a target="_blank" class="address_link"
                                       href="<?php echo e(route('taxicompany.booking.details',$rating->booking_id)); ?>"><?php echo e($rating->Booking->merchant_booking_id); ?></a>
                                </td>
                                <td>
                                    <?php if($rating->Booking->booking_type == 1): ?>
                                        <?php echo app('translator')->get("$string_file.ride_now"); ?>
                                    <?php else: ?>
                                        <?php echo app('translator')->get("$string_file.ride"); ?>  <?php echo app('translator')->get("$string_file.later"); ?>
                                    <?php endif; ?>
                                </td>

                                <?php if(Auth::user()->demo == 1): ?>
                                    <td>
                                            <span class="long_text">
                                                <?php echo e("********".substr($rating->Booking->User->UserName,-2)); ?>

                                               <br>
                                               <?php echo e("********".substr($rating->Booking->User->UserPhone,-2)); ?>

                                               <br>
                                              <?php echo e("********".substr($rating->Booking->User->email,-2)); ?>

                                            </span>
                                    </td>
                                <?php else: ?>
                                    <td>
                                            <span class="long_text">
                                                <?php echo e($rating->Booking->User->UserName); ?>

                                               <br>
                                               <?php echo e($rating->Booking->User->UserPhone); ?>

                                               <br>
                                              <?php echo e($rating->Booking->User->email); ?>

                                            </span>
                                    </td>
                                <?php endif; ?>
                                <td>
                                    <?php if($rating->user_rating_points): ?>
                                        <?php while($rating->user_rating_points>0): ?>
                                            <?php if($rating->user_rating_points >0.5): ?>
                                                <img src="<?php echo e(view_config_image("static-images/star.png")); ?>"
                                                     alt='Whole Star'>
                                            <?php else: ?>
                                                <img src="<?php echo e(view_config_image('static-images/halfstar.png')); ?>"
                                                     alt='Half Star'>
                                            <?php endif; ?>
                                            <?php $rating->user_rating_points--; ?>
                                        <?php endwhile; ?>
                                    <?php else: ?>
                                        <?php echo app('translator')->get("$string_file.not_rated_yet"); ?>
                                    <?php endif; ?>
                                </td>

                                <td>
                                    <?php if($rating->user_comment): ?>
                                        <?php echo e($rating->user_comment); ?>

                                    <?php else: ?>
                                        ------
                                    <?php endif; ?>
                                </td>
                                <?php if(Auth::user()->demo == 1): ?>
                                    <td>
                                            <span class="long_text">
                                                 <?php echo e("********".substr($rating->Booking->Driver->last_name,-2)); ?>

                                            <br>
                                            <?php echo e("********".substr($rating->Booking->Driver->phoneNumber,-2)); ?>

                                            <br>
                                            <?php echo e("********".substr($rating->Booking->Driver->email,-2)); ?>

                                                </span>
                                    </td>
                                <?php else: ?>
                                    <td>
                                            <span class="long_text">
                                                 <?php echo e($rating->Booking->Driver->first_name." ".$rating->Booking->Driver->last_name); ?>

                                            <br>
                                            <?php echo e($rating->Booking->Driver->phoneNumber); ?>

                                            <br>
                                            <?php echo e($rating->Booking->Driver->email); ?>

                                                </span>
                                    </td>
                                <?php endif; ?>
                                <td>
                                    <?php if($rating->driver_rating_points): ?>
                                        <?php while($rating->driver_rating_points>0): ?>
                                            <?php if($rating->driver_rating_points >0.5): ?>
                                                <img src="<?php echo e(view_config_image("static-images/star.png")); ?>"
                                                     alt='Whole Star'>
                                            <?php else: ?>
                                                <img src="<?php echo e(view_config_image('static-images/halfstar.png')); ?>"
                                                     alt='Half Star'>
                                            <?php endif; ?>
                                            <?php $rating->driver_rating_points--; ?>
                                        <?php endwhile; ?>
                                    <?php else: ?>
                                        <?php echo app('translator')->get("$string_file.not_rated_yet"); ?>
                                    <?php endif; ?>

                                </td>
                                <td>
                                    <?php if($rating->driver_comment): ?>
                                        <?php echo e($rating->driver_comment); ?>

                                    <?php else: ?>
                                        ------
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php echo convertTimeToUSERzone($rating->created_at, $rating->Booking->CountryArea->timezone,null,$rating->Booking->Merchant); ?>

                                </td>
                            </tr>
                            <?php $sr++;  ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                    <div class="pagination1 float-right"><?php echo e($ratings->links()); ?></div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>




<?php echo $__env->make('taxicompany.layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/qazaq/public_html/admin.qazaq.taxi/ms-v3/resources/views/taxicompany/random/ratings.blade.php ENDPATH**/ ?>