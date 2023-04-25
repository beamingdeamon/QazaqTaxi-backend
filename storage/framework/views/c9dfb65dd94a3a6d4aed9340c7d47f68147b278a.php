
<?php $__env->startSection('content'); ?>
    <div class="page">
        <div class="page-content container-fluid">
            <div class="panel panel-bordered">
                <header class="panel-heading">
                    <div class="panel-actions">
                        
                        
                        
                        
                        
                    </div>
                    <h3 class="panel-title">
                        <i class="fa fa-google-wallet" aria-hidden="true"></i>
                        <?php echo app('translator')->get("$string_file.wallet_transaction"); ?></h3>
                </header>
                <div class="panel-body container-fluid">
                    <table id="customDataTable" class="display nowrap table table-hover table-striped w-full" style="width:100%">
                        <thead>
                        <tr>
                            <th><?php echo app('translator')->get("$string_file.transaction_type"); ?></th>
                            <th><?php echo app('translator')->get("$string_file.payment"); ?></th>
                            <th><?php echo app('translator')->get("$string_file.receipt_no"); ?></th>
                            <th><?php echo app('translator')->get("$string_file.amount"); ?></th>
                            <th><?php echo app('translator')->get("$string_file.narration"); ?></th>
                            <th><?php echo app('translator')->get("$string_file.created_at"); ?></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $__currentLoopData = $wallet_transactions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $wallet_transaction): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td>
                                    <?php if($wallet_transaction->transaction_type == 1): ?>
                                        <?php echo app('translator')->get("$string_file.credit"); ?>
                                    <?php else: ?>
                                       <?php echo app('translator')->get("$string_file.debit"); ?>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php if($wallet_transaction->payment_method == 1): ?>
                                        <?php echo app('translator')->get("$string_file.cash"); ?>
                                    <?php else: ?>
                                        <?php echo app('translator')->get("$string_file.non_cash"); ?>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php echo e($wallet_transaction->receipt_number); ?>

                                </td>
                                <td>
                                    <?php echo e($wallet_transaction->amount); ?>

                                </td>
                                <td>
                                    <?php if($wallet_transaction->transaction_type == 1): ?>
                                        <?php echo app('translator')->get("$string_file.money_added"); ?>
                                    <?php elseif($wallet_transaction->booking_id != null): ?>
                                        <?php echo app('translator')->get("$string_file.money_spent"); ?><?php echo e($wallet_transaction->booking_id); ?>

                                    <?php elseif($wallet_transaction->subscription_package_id != null): ?>
                                        <?php echo app('translator')->get('admin.wallet_money_spent_package'); ?><?php echo e($wallet_transaction->subscription_package_id); ?>

                                    <?php else: ?>
                                        ------------
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php echo convertTimeToUSERzone($wallet_transaction->created_at, null,null,$wallet_transaction->merchant_id); ?>

                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                    <div class="pagination1 float-right"><?php echo e($wallet_transactions->links()); ?></div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('taxicompany.layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/qazaq/public_html/admin.qazaq.taxi/ms-v3/resources/views/taxicompany/random/wallet.blade.php ENDPATH**/ ?>