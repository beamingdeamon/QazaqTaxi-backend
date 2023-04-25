<?php $__env->startSection('content'); ?>
    <style>
        #ecommerceRecentride .table-row .card-block .table td {
            vertical-align: middle !important;
            height: 15px !important;
            font-size: 14px !important;
            padding: 8px 8px !important;
        }
        .dataTables_filter, .dataTables_info { display: none; }
    </style>
    <div class="page">
        <div class="page-content">
            <?php echo $__env->make("merchant.shared.errors-and-messages", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <div class="panel panel-brideed">
                <header class="panel-heading">
                    <div class="panel-actions">
                    </div>
                    <h3 class="panel-title">
                        <i class="icon wb-list" aria-hidden="true"></i>
                        <?php echo app('translator')->get("$string_file.ride_earning_statistics_of"); ?> <span class="blue-500"><?php echo e(is_demo_data($driver->first_name.' '.$driver->last_name,$driver->Merchant)); ?> (<?php echo e(is_demo_data($driver->phoneNumber,$driver->Merchant)); ?>)</span>
                        </span>
                    </h3>
                    <?php if($export_permission): ?>
                        <div class="panel-actions">
                            <a href="<?php echo e(route('merchant.taxi.earning.export',$arr_search)); ?>">
                                <button type="button" title="<?php echo app('translator')->get("$string_file.export_rides"); ?>"
                                        class="btn btn-icon btn-success float-right"  style="margin:10px"><i class="wb-download"></i>
                                </button>
                            </a>
                        </div>
                    <?php endif; ?>
                </header>
                <div class="panel-body container-fluid">
                <?php echo $search_view; ?>

                    <hr>
                    <!-- First Row -->
                    <div class="row">
                        <div class="col-xl-3 col-md-6 info-panel">
                            <div class="card card-shadow">
                                <div class="card-block bg-grey-100 p-20">
                                    <button type="button" class="btn btn-floating btn-sm btn-warning">
                                        <i class="icon wb-shopping-cart"></i>
                                    </button>
                                    <span class="ml-15 font-weight-400"><?php echo app('translator')->get("$string_file.rides"); ?></span>
                                    <div class="content-text text-center mb-0">
                                        <span class="font-size-20 font-weight-100"><?php echo e($total_rides); ?></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-3 info-panel">
                            <div class="card card-shadow">
                                <div class="card-block bg-grey-100 p-20">
                                    <button type="button" class="btn btn-floating btn-sm btn-danger">
                                        <i class="icon fa-dollar"></i>
                                    </button>
                                    <span class="ml-15 font-weight-400"><?php echo app('translator')->get("$string_file.ride_amount"); ?></span>
                                    <div class="content-text text-center mb-0">
                                        <span class="font-size-20 font-weight-100"><?php echo e(isset($earning_summary['ride_amount']) ? $currency.$earning_summary['ride_amount'] : 0); ?></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-3 info-panel">
                            <div class="card card-shadow">
                                <div class="card-block bg-grey-100 p-20">
                                    <button type="button" class="btn btn-floating btn-sm btn-danger">
                                        <i class="icon fa-percent"></i>
                                    </button>
                                    <span class="ml-15 font-weight-400"><?php echo app('translator')->get("$string_file.merchant_earning"); ?></span>
                                    <div class="content-text text-center mb-0">
                                        <span class="font-size-20 font-weight-100"><?php echo e(isset($earning_summary['merchant_earning']) ? $currency.$earning_summary['merchant_earning'] : 0); ?></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-3 info-panel">
                            <div class="card card-shadow">
                                <div class="card-block bg-grey-100 p-20">
                                    <button type="button" class="btn btn-floating btn-sm btn-danger">
                                        <i class="icon fa-dollar"></i>
                                    </button>
                                    <span class="ml-15 font-weight-400"><?php echo app('translator')->get("$string_file.driver_earning"); ?></span>
                                    <div class="content-text text-center mb-0">
                                        <span class="font-size-20 font-weight-100"><?php echo e(isset($earning_summary['driver_earning']) ? $currency.$earning_summary['driver_earning'] : 0); ?></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>

                    <!-- Third Row -->
                    <!-- Third Left -->
                    <div class="row">
                        <div class="col-lg-12" id="ecommerceRecentride">
                            <div class="card card-shadow table-row">
                                <div class="card-block bg-white table-responsive">
                                    <table id="customDataTable" class="display nowrap table table-hover table-stripedw-full" style="width:100%">
                                        <thead>
                                        <tr>
                                            <th><?php echo app('translator')->get("$string_file.sn"); ?></th>
                                            <th><?php echo app('translator')->get("$string_file.ride_id"); ?></th>
                                            <th><?php echo app('translator')->get("$string_file.driver_earning"); ?></th>
                                            <th><?php echo app('translator')->get("$string_file.merchant_earning"); ?></th>
                                            <th><?php echo app('translator')->get("$string_file.ride_amount"); ?></th>


                                            <th><?php echo app('translator')->get("$string_file.created_at"); ?></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php if(!empty($arr_rides)): ?>
                                            <?php $sr = $arr_rides->firstItem(); $user_name = ''; $user_phone = ''; $user_email = '';
                                                        $driver_name = '';$driver_email = '';
                                                         $tax_amount =    !empty($ride->tax) ? $ride->tax : 0;
                                            ?>
                                            <?php $__currentLoopData = $arr_rides; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ride): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <?php if(!empty($ride->BookingTransaction)): ?>
                                                    <?php $transaction = $ride->BookingTransaction;
                                                     $currency = $ride->CountryArea->Country->isoCode;
                                                    ?>
                                                <?php endif; ?>
                                                <tr>
                                                    <td><?php echo e($sr); ?></td>
                                                    <td>
                                                        <a href="<?php echo e(route('merchant.booking.invoice',$ride->id)); ?>"><?php echo e($ride->merchant_booking_id); ?></a>
                                                    </td>
                                                    <td>
                                                        <?php if(!empty($transaction)): ?>
                                                            <?php echo e($transaction->driver_earning); ?>

                                                        <?php endif; ?>
                                                    </td>
                                                    <td>
                                                        <?php if(!empty($transaction)): ?>
                                                            <?php echo e($transaction->company_earning); ?>

                                                        <?php endif; ?>
                                                    </td>
                                                    <td>
                                                        <?php echo e($ride->final_amount_paid); ?>

                                                    </td>






                                                    <td>
                                                        <?php echo app('translator')->get("$string_file.at"); ?> <?php echo e(date('H:i',strtotime($ride->created_at))); ?>,
                                                        <?php echo e(date_format($ride->created_at,'D, M d, Y')); ?>

                                                    </td>
                                                </tr>
                                                <?php $sr++  ?>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </tbody>
                                        <?php endif; ?>
                                    </table>
                                        <?php echo $__env->make('merchant.shared.table-footer', ['table_data' => $arr_rides, 'data' => $arr_search], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('merchant.layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/msprojectsappori/public_html/multi-service-v3/resources/views/merchant/report/taxi-services/driver.blade.php ENDPATH**/ ?>