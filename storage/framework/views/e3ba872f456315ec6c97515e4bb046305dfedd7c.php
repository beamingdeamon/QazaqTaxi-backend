
<?php $__env->startSection('content'); ?>
    <div class="page">
        <div class="page-content">
            <?php echo $__env->make("merchant.shared.errors-and-messages", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <div class="panel panel-bordered">
                <haeder class="panel-heading">
                    <div class="panel-actions">





                    </div>
                    <h3 class="panel-title">
                        <i class="wb-info" aria-hidden="true"></i>
                        <?php echo app('translator')->get("$string_file.taxi_company_transaction"); ?>
                    </h3>
                </haeder>
                <div class="panel-body container-fluid">
                    <form method="post" action="<?php echo e(route('taxicompany.transaction.search')); ?>">
                        <?php echo csrf_field(); ?>
                        <div class="table_search row">
                            <div class="col-md-1 col-xs-12 form-group ">
                                <?php echo app('translator')->get("$string_file.search_by"); ?>:
                            </div>
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

                            <div class="col-md-2 col-xs-12 form-group ">
                                <div class="input-group">
                                    <input type="text" id="" name="date"
                                           placeholder="<?php echo app('translator')->get("$string_file.from_date"); ?>" readonly
                                           class="form-control col-md-12 col-xs-12 datepickersearch bg-this-color"
                                           id="datepickersearch">
                                </div>
                            </div>
                            <div class="col-md-2 col-xs-12 form-group ">
                                <div class="input-group">
                                    <input type="text" id="" name="date1"
                                           placeholder="<?php echo app('translator')->get("$string_file.to_date"); ?>" readonly
                                           class="form-control col-md-12 col-xs-12 datepickersearch bg-this-color"
                                           id="datepickersearch">
                                </div>
                            </div>
                            <div class="col-sm-1  col-xs-12 form-group ">
                                <button class="btn btn-primary" type="submit" name="seabt12"><i
                                            class="fa fa-search" aria-hidden="true"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                    <table id="customDataTable" class="display nowrap table table-hover table-striped w-full" style="width:100%">
                        <thead>
                        <th><?php echo app('translator')->get("$string_file.sn"); ?></th>
                        <th><?php echo app('translator')->get("$string_file.ride_id"); ?></th>
                        <th><?php echo app('translator')->get("$string_file.ride_type"); ?></th>
                        <th><?php echo app('translator')->get("$string_file.service_area"); ?></th>
                        <th><?php echo app('translator')->get("$string_file.commission_type"); ?></th>
                        <th><?php echo app('translator')->get("$string_file.user_details"); ?></th>
                        <th><?php echo app('translator')->get("$string_file.driver_details"); ?></th>
                        <th><?php echo app('translator')->get("$string_file.payment"); ?></th>
                        <th><?php echo app('translator')->get("$string_file.total_amount"); ?></th>
                        <th><?php echo app('translator')->get("$string_file.promo_discount"); ?></th>
                        <th><?php echo app('translator')->get("$string_file.tax"); ?></th>
                        <th><?php echo app('translator')->get("$string_file.company_cut"); ?></th>
                        <th><?php echo app('translator')->get("$string_file.driver_cut"); ?></th>
                        <th><?php echo app('translator')->get("$string_file.total_payout"); ?></th>
                        <th><?php echo app('translator')->get("$string_file.total_outstanding"); ?></th>
                        <th><?php echo app('translator')->get("$string_file.travelled_distance"); ?></th>
                        <th><?php echo app('translator')->get("$string_file.travelled_time"); ?></th>
                        <th><?php echo app('translator')->get("$string_file.estimated_bill"); ?></th>
                        <th><?php echo app('translator')->get("$string_file.date"); ?></th>
                        <th><?php echo app('translator')->get("$string_file.details"); ?></th>
                        </thead>
                        <tbody>
                        <?php $s = 0; ?>
                        <?php $__currentLoopData = $transactions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $transaction): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><a target="_blank" class="address_link"
                                       href="<?php echo e(route('taxicompany.booking.details',$transaction->id)); ?>"><?php echo e(++$s); ?></a>
                                </td>
                                <td><?php echo e($transaction->id); ?></a>
                                </td>
                                <td>
                                    <?php if($transaction->booking_type == 1): ?>
                                        <?php echo app('translator')->get("$string_file.ride_now"); ?>
                                    <?php else: ?>
                                        <?php echo app('translator')->get("$string_file.ride"); ?>  <?php echo app('translator')->get("$string_file.later"); ?>
                                    <?php endif; ?>

                                </td>
                                <td><?php echo e($transaction->CountryArea->CountryAreaName); ?></td>
                                <td>
                                    <?php if(isset($transaction['BookingTransaction']['commission_type']) && $transaction['BookingTransaction']['commission_type'] == 1): ?>
                                        <?php echo app('translator')->get("$string_file.pre_paid"); ?>
                                    <?php elseif(isset($transaction['BookingTransaction']['commission_type']) && $transaction['BookingTransaction']['commission_type'] == 2): ?>
                                        <?php echo app('translator')->get("$string_file.post_paid"); ?>
                                    <?php else: ?>
                                        ----
                                    <?php endif; ?>
                                </td>
                                <td><span class="long_text">
                                                                <?php echo e($transaction->User->UserName); ?>

                                                                <br>
                                                                <?php echo e($transaction->User->UserPhone); ?>

                                                                <br>
                                                                <?php echo e($transaction->User->email); ?>

                                                                </span>
                                </td>
                                <td><span class="long_text">
                                                                <?php echo e($transaction->Driver->first_name." ".$transaction->Driver->last_name); ?>

                                                                <br>
                                                                <?php echo e($transaction->Driver->phoneNumber); ?>

                                                                <br>
                                                                <?php echo e($transaction->Driver->email); ?>

                                                                </span>
                                </td>
                                <td><?php echo e($transaction->PaymentMethod->payment_method); ?></td>
                                <td><?php if(!empty($transaction['BookingTransaction'])): ?> <?php echo e($transaction->CountryArea->Country->isoCode." ".$transaction['BookingTransaction']['customer_paid_amount']); ?>

                                    <?php else: ?> <?php echo e($transaction->CountryArea->Country->isoCode." ".$transaction->final_amount_paid); ?> <?php endif; ?>
                                </td>
                                <td><?php if(!empty($transaction['BookingTransaction'])): ?> <?php echo e($transaction->CountryArea->Country->isoCode." ".$transaction['BookingTransaction']['discount_amount']); ?>

                                    <?php else: ?> <?php echo e($transaction->CountryArea->Country->isoCode." ".$transaction['BookingDetail']['promo_discount']); ?> <?php endif; ?> </td>
                                <td><?php echo e($transaction->CountryArea->Country->isoCode." ".$transaction['BookingTransaction']['tax_amount']); ?></td>
                                <td><?php if(!empty($transaction['BookingTransaction'])): ?> <?php echo e($transaction->CountryArea->Country->isoCode." ".$transaction['BookingTransaction']['company_earning']); ?>

                                    <?php else: ?> <?php echo e($transaction->CountryArea->Country->isoCode." ".$transaction->company_cut); ?> <?php endif; ?>
                                </td>
                                <td><?php if(!empty($transaction['BookingTransaction'])): ?> <?php echo e($transaction->CountryArea->Country->isoCode." ".$transaction['BookingTransaction']['driver_earning']); ?>

                                    <?php else: ?> <?php echo e($transaction->CountryArea->Country->isoCode." ".$transaction->driver_cut); ?> <?php endif; ?>
                                </td>
                                <td><?php echo e($transaction->CountryArea->Country->isoCode." ".$transaction['BookingTransaction']['driver_total_payout_amount']); ?></td>
                                <td><?php echo e($transaction->CountryArea->Country->isoCode." ".$transaction['BookingTransaction']['trip_outstanding_amount']); ?></td>
                                <td><?php echo e($transaction->travel_distance); ?></td>
                                <td><?php echo e($transaction->travel_time); ?></td>
                                <td><?php echo e($transaction->CountryArea->Country->isoCode." ".$transaction->estimate_bill); ?></td>
                                <td><?php echo convertTimeToUSERzone($transaction->created_at, $transaction->CountryArea->timezone,null,$transaction->Merchant); ?></td>
                                <td> <span class="openPopup" data-href="<?php echo e($transaction->BookingDetail->bill_details); ?>" data-id="<?php echo e($transaction->id); ?>">
                                            <a data-original-title="Bill Details" data-toggle="tooltip" id="Model" data-placement="top"
                                               class="btn btn-sm btn-default btn-outline-secondary btn"> <h7><?php echo app('translator')->get("$string_file.bill_details"); ?> </h7></a></span>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                    <div class="pagination1 float-right"><?php echo e($transactions->links()); ?></div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade text-left" id="detailBooking" tabindex="-1" role="dialog" aria-labelledby="myModalLabel33"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <label class="modal-title text-text-bold-600"
                           id="myModalLabel33"><b><?php echo app('translator')->get("$string_file.transaction"); ?></b></label>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                </div>
                <div class="modal-footer">
                    <input type="reset" class="btn btn-outline-secondary btn" data-dismiss="modal"
                           value="<?php echo app('translator')->get("$string_file.close"); ?>">
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('taxicompany.layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/qazaq/public_html/admin.qazaq.taxi/ms-v3/resources/views/taxicompany/transaction/index.blade.php ENDPATH**/ ?>