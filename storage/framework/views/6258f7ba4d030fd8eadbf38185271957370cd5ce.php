
<?php $__env->startSection('content'); ?>
    <div class="page">
        <div class="page-content container-fluid">
            <?php echo $__env->make('merchant.shared.errors-and-messages', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php if(session('accounts')): ?>
                <div class="alert dark alert-icon alert-info" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">x</span>
                    </button>
                    <i class="icon wb-info" aria-hidden="true"></i><?php echo e(session('accounts')); ?>

                </div>
            <?php endif; ?>
            <div class="panel panel-bordered">
                <header class="panel-heading">
                    <div class="panel-actions">
                    </div>
                    <h3 class="panel-title"><i class="fa fa-money" aria-hidden="true"></i>
                        <?php echo app('translator')->get("$string_file.driver_account"); ?></h3>
                </header>
                <div class="panel-body container-fluid">
                    <form action="<?php echo e(route('taxicompany.account.search')); ?>" method="GET">
                        <?php echo csrf_field(); ?>
                        <div class="table_search row">
                            <div class="col-md-2 col-xs-12 form-group active-margin-top">
                                <?php echo app('translator')->get("$string_file.search_by"); ?>:
                            </div>
                            <div class="col-md-2 col-xs-12 form-group active-margin-top">
                                <div class="">
                                    <select class="form-control" name="parameter" id="parameter" required>
                                        <option value="1"><?php echo app('translator')->get("$string_file.name"); ?></option>
                                        <option value="2"><?php echo app('translator')->get("$string_file.email"); ?></option>
                                        <option value="3"><?php echo app('translator')->get("$string_file.phone"); ?></option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-2 col-xs-12 form-group active-margin-top">
                                <div class="input-group">
                                    <input type="text" id="" name="keyword"
                                           placeholder="<?php echo app('translator')->get("$string_file.enter_text"); ?>"
                                           class="form-control col-md-12 col-xs-12">
                                </div>
                            </div>
                            <div class="col-sm-2  col-xs-12 form-group active-margin-top">
                                <button class="btn btn-primary" type="submit"><i
                                            class="fa fa-search" aria-hidden="true"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                    <table id="customDataTable" class="display nowrap table table-hover table-striped w-full" style="width:100%">
                        <thead>
                        <tr>
                            <th><?php echo app('translator')->get("$string_file.sn"); ?></th>
                            <th><?php echo app('translator')->get("$string_file.driver_details"); ?></th>
                            <th><?php echo app('translator')->get("$string_file.area"); ?></th>
                            <th><?php echo app('translator')->get("$string_file.unbilled_amount"); ?></th>
                            <th><?php echo app('translator')->get("$string_file.rides"); ?></th>
                            <th><?php echo app('translator')->get("$string_file.taxi_company_earning"); ?></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $sr = $drivers->firstItem() ?>
                        <?php $__currentLoopData = $drivers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $driver): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($sr); ?></td>
                                <?php if(Auth::user()->demo == 1): ?>
                                    <td>
                                                                <span class="long_text">
                                                                    <?php echo e("********".substr($driver->last_name, -2)); ?><br>
                                                                    <?php echo e("********".substr($driver->email, -2)); ?><br>
                                                                    <?php echo e("********".substr($driver->phoneNumber, -2)); ?>

                                                                 </span>
                                    </td>
                                <?php else: ?>
                                    <td><span class="long_text">
                                                        <?php echo e($driver->first_name." ".$driver->last_name); ?>

                                                        <br>
                                                        <?php echo e($driver->email); ?>

                                                        <br>
                                                        <?php echo e($driver->phoneNumber); ?>

                                                        </span>
                                    </td>
                                <?php endif; ?>
                                <td><?php echo e($driver->CountryArea->CountryAreaName); ?></td>
                                <td>
                                    <?php echo e(sprintf("%0.2f", $driver->cash_received)); ?>

                                </td>
                                <td>
                                    <?php if($driver->total_trips): ?>
                                        <?php echo e($driver->total_trips); ?>

                                    <?php else: ?>
                                        <?php echo app('translator')->get("$string_file.no_ride"); ?>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php if($driver->total_earnings): ?>
                                        <?php echo e(sprintf("%0.2f", $driver->total_earnings)); ?>

                                    <?php else: ?>
                                        <?php echo app('translator')->get("$string_file.no_ride"); ?>
                                    <?php endif; ?>
                                </td>
                            </tr>
                            <?php $sr++  ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                    <div class="pagination1 float-right"><?php echo e($drivers->links()); ?></div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('taxicompany.layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/qazaq/public_html/admin.qazaq.taxi/ms-v3/resources/views/taxicompany/accounts/index.blade.php ENDPATH**/ ?>