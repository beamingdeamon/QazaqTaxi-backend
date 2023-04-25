<?php $__env->startSection('content'); ?>
    <div class="page">
        <div class="page-content">
            <?php echo $__env->make("merchant.shared.errors-and-messages", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <div class="panel panel-bordered">
                <header class="panel-heading">
                    <div class="panel-actions">
                        <a href="<?php echo e(route('users.index')); ?>" data-toggle="tooltip">
                            <button type="button" class="btn btn-icon btn-success float-right" style="margin: 10px;">
                                <i class="wb-reply" title="<?php echo app('translator')->get('common.all'); ?> <?php echo app('translator')->get('common.users'); ?>"></i>
                            </button>
                        </a>
                    </div>
                    <h3 class="panel-title"><i class="icon wb-plus" aria-hidden="true"></i>
                        <?php echo app('translator')->get('common.upload'); ?> <?php echo app('translator')->get('common.documents'); ?></h3>
                </header>
                <div class="panel-body container-fluid">
                    <form method="POST" class="steps-validation wizard-notification"
                          enctype="multipart/form-data"
                          action="<?php echo e(route('user.save.document',$user->id)); ?>">
                        <?php echo csrf_field(); ?>
                        <h5 class="form-section col-md-12" style="color: black;">
                            <i class="fa fa-file"></i> <?php echo app('translator')->get("common.personal"); ?> <?php echo app('translator')->get("common.document"); ?>
                        </h5>
                        <hr>
                        <?php
                            $arr_uploaded_doc = [];
                        ?>
                        <?php if(isset($uploaded_documents) && !empty($uploaded_documents)): ?>
                            <?php
                                $arr_uploaded_doc = array_column($uploaded_documents,NULL,'document_id');
                            ?>
                        <?php endif; ?>
                        <?php $__currentLoopData = $documents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $document): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php $expire_date = null;
$document_file = null; ?>
                            <?php if(isset($arr_uploaded_doc[$document['id']])): ?>
                                <?php
                                    $expire_date = $arr_uploaded_doc[$document['id']]['expire_date'];
                                    $document_file = $arr_uploaded_doc[$document['id']]['document_file'];
                                    $document_number = $arr_uploaded_doc[$document['id']]['document_number'];
                                ?>
                            <?php endif; ?>
                            <?php echo Form::hidden('all_doc[]',$document['id']); ?>

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="emailAddress5">
                                            <?php echo e($document->DocumentName); ?>:
                                            <span class="text-danger">*</span>
                                        </label>
                                        <?php if(in_array($document['pivot']['document_id'],array_keys($arr_uploaded_doc))): ?>
                                            <a href="<?php echo e(get_image($document_file,'user_document')); ?>"
                                               target="_blank"><?php echo app('translator')->get("common.view"); ?> </a>
                                        <?php endif; ?>
                                        <input type="file" class="form-control" id="document"
                                               name="document[<?php echo e($document['id']); ?>]"
                                               placeholder=""
                                               <?php if($document['documentNeed'] == 1 && empty($document_file)): ?>)
                                               required <?php endif; ?>>
                                        <?php if($errors->has('documentname')): ?>
                                            <label class="text-danger"><?php echo e($errors->first('documentname')); ?></label>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <?php if($document->expire_date == 1): ?>
                                        <div class="form-group">
                                            <label for="datepicker"><?php echo app('translator')->get("common.expire"); ?> <?php echo app('translator')->get("common.date"); ?>
                                                <span class="text-danger">*</span>
                                            </label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                        <span class="input-group-text"><i class="icon wb-calendar"
                                                          aria-hidden="true"></i></span>
                                                </div>
                                                <input type="text"
                                                       class="form-control customDatePicker1"
                                                       name="expiredate[<?php echo e($document->id); ?>]"
                                                       value="<?php echo e($expire_date); ?>"
                                                       placeholder="<?php echo app('translator')->get("common.expire"); ?> <?php echo app('translator')->get("common.date"); ?>  "
                                                       <?php if($document['expire_date'] == 1 && empty($expire_date)): ?> required
                                                       <?php endif; ?>
                                                       autocomplete="off">
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                </div>
                                <?php if($document->document_number_required == 1): ?>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="emailAddress5">
                                                <?php echo app('translator')->get('common.document'); ?> <?php echo app('translator')->get('common.number'); ?> :
                                                <span class="text-danger">*</span>
                                            </label>
                                            <input type="text" class="form-control" id="document_number"
                                                   name="document_number[<?php echo e($document['id']); ?>]"
                                                   placeholder="<?php echo app('translator')->get('common.document'); ?> <?php echo app('translator')->get('common.number'); ?>"
                                                   value="<?php echo e(isset($document_number) ? $document_number : ''); ?>"
                                                   required>
                                            <?php if($errors->has('document_number')): ?>
                                                <label class="text-danger"><?php echo e($errors->first('document_number')); ?></label>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <div class="form-actions float-right">
                            <button type="submit" class="btn btn-primary">
                                <i class="fa fa-check-circle"></i> <?php echo app('translator')->get('common.save'); ?>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('js'); ?>
    <script>
        $('.toast').toast('show');
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('merchant.layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/msprojectsappori/public_html/multi-service-v3/resources/views/merchant/user/upload_document.blade.php ENDPATH**/ ?>