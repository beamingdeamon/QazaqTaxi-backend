<div class="mt-10">
    <div class="float-left"><?php echo app('translator')->get("$string_file.showing"); ?> <?php echo e(($table_data->firstItem() > 0) ? $table_data->firstItem() : 0); ?> <?php echo app('translator')->get("$string_file.to"); ?> <?php echo e(($table_data->lastItem() > 0 ) ? $table_data->lastItem() : 0); ?> <?php echo app('translator')->get("$string_file.of"); ?> <?php echo e($table_data->total()); ?></div>
    <?php if(isset($data)): ?>
        <div class="pagination1 float-right"><?php echo e($table_data->appends($data)->links()); ?></div>
    <?php else: ?>
        <div class="pagination1 float-right"><?php echo e($table_data->appends()->links()); ?></div>
    <?php endif; ?>
</div><?php /**PATH /Users/eldar/Desktop/ms-v3/resources/views/merchant/shared/table-footer.blade.php ENDPATH**/ ?>