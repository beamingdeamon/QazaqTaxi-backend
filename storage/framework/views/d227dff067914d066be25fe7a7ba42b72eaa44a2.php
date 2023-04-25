<?php $__env->startSection('content'); ?>
    <div class="page">
        <div class="page-content">
            <?php echo $__env->make('merchant.shared.errors-and-messages', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <div class="panel panel-bordered">
                <header class="panel-heading">
                    <div class="panel-actions">
                        <a href="<?php echo e(route('carpooling.price_card.add')); ?>">
                            <button type="button" class="btn btn-icon btn-success float-right" style="margin:10px">
                                <i class="wb-plus" title="<?php echo app('translator')->get("$string_file.add"); ?> <?php echo app('translator')->get("$string_file.price_card"); ?>"></i>
                            </button>
                        </a>
                    </div>
                    <h3 class="panel-title"><i class="icon fa-money" aria-hidden="true"></i>
                        <?php echo app('translator')->get("$string_file.price_card"); ?> <?php echo app('translator')->get("$string_file.list"); ?>
                    </h3>
                </header>
                <div class="panel-body container-fluid">
                    <table id="customDataTable" class="display nowrap table table-hover table-stripedw-full"
                           style="width:100%">
                        <thead>
                        <tr>
                            <th><?php echo app('translator')->get("$string_file.sn"); ?></th>
                            <th><?php echo app('translator')->get("$string_file.service"); ?> <?php echo app('translator')->get("$string_file.area"); ?></th>
                            <th><?php echo app('translator')->get("$string_file.distance"); ?> <?php echo app('translator')->get("$string_file.charges"); ?></th>
                            <th><?php echo app('translator')->get("$string_file.service"); ?> <?php echo app('translator')->get("$string_file.charges"); ?></th>
                            <th><?php echo app('translator')->get("$string_file.status"); ?></th>
                            <th><?php echo app('translator')->get("$string_file.action"); ?></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $sr = $pricecards->firstItem();
                        ?>
                        <?php $__currentLoopData = $pricecards; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $price_card): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($sr); ?></td>
                                <td>
                                    <?php echo e($price_card->CountryArea->CountryAreaName); ?>

                                </td>
                                <td><?php echo e($price_card->CountryArea->Country->isoCode.' '.$price_card->distance_charges); ?></td>
                                <td><?php echo e(($price_card->service_charges > 0) ? $price_card->CountryArea->Country->isoCode.' '.$price_card->service_charges : "--"); ?></td>
                                <td>
                                    <?php if($price_card->status == 1): ?>
                                        <span class="badge badge-success"><?php echo app('translator')->get("$string_file.active"); ?></span>
                                    <?php else: ?>
                                        <span class="badge badge-danger"><?php echo app('translator')->get("$string_file.inactive"); ?></span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <a href="<?php echo e(route('carpooling.price_card.add',[$price_card->id])); ?>"
                                       data-original-title="Edit" data-toggle="tooltip" data-placement="top"
                                       class="btn btn-sm btn-warning menu-icon btn_edit action_btn"> <i
                                                class="fa fa-edit"></i> </a>
                                </td>
                            </tr>
                            <?php $sr++  ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                    <?php echo $__env->make('merchant.shared.table-footer', ['table_data' => $pricecards, 'data' => []], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('merchant.layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/msprojectsappori/public_html/multi-service-v3/resources/views/merchant/carpooling-pricecard/index.blade.php ENDPATH**/ ?>