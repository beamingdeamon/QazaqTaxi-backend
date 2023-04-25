
<?php $__env->startSection('content'); ?>
    <div class="page">
        <div class="page-content">
            <?php if(session('message181')): ?>
                <div class="alert dark alert-icon alert-info alert-dismissible"
                     role="alert">
                    <button type="button" class="close" data-dismiss="alert"
                            aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                    <i class="icon wb-info" aria-hidden="true"></i><?php echo app('translator')->get('admin.message181'); ?>
                </div>
            <?php endif; ?>
            <div class="panel panel-bordered">
                <header class="panel-heading">
                    <div class="panel-actions">
                        <a href="<?php echo e(URL:: previous()); ?>">
                            <button type="button" class="btn btn-icon btn-success" style="margin:10px">
                                <i class="wb-reply"></i>
                            </button>
                        </a>
                    </div>
                    <h3 class="panel-title"><i class="fa fa-user-circle"></i>
                       <?php echo app('translator')->get("$string_file.edit_profile"); ?> </h3>
                </header>
                <div class="panel-body container-fluid">
                    <form method="POST" class="steps-validation wizard-notification"
                          enctype="multipart/form-data" action="<?php echo e(route('taxicompany.profile.submit')); ?>">
                        <?php echo csrf_field(); ?>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="name">
                                        <?php echo app('translator')->get('admin.company_name'); ?> :
                                        <span class="danger">*</span>
                                    </label>
                                    <input type="text" class="form-control"
                                           id="name"
                                           name="name"
                                           value="<?php echo e(isset($taxicompany) ? $taxicompany->name : ''); ?>"
                                           placeholder="<?php echo app('translator')->get('admin.company_name'); ?>" required>
                                    <?php if($errors->has('name')): ?>
                                        <label class="danger"><?php echo e($errors->first('name')); ?></label>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="web_rest_key">
                                        <?php echo app('translator')->get('admin.company_email'); ?> :
                                        <span class="danger">*</span>
                                    </label>
                                    <input type="text" class="form-control"
                                           id="email"
                                           name="email"
                                           placeholder="<?php echo app('translator')->get('admin.company_email'); ?>"
                                           value="<?php echo e(isset($taxicompany) ? $taxicompany->email : ''); ?>" required>
                                    <?php if($errors->has('email')): ?>
                                        <label class="danger"><?php echo e($errors->first('email')); ?></label>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="firstName3">
                                        <?php echo app('translator')->get('admin.company_phone'); ?> :
                                        <span class="danger">*</span>
                                    </label>
                                    <input type="text" class="form-control" id="phone"
                                           name="phone"
                                           placeholder="<?php echo app('translator')->get('admin.company_phone'); ?>"
                                           value="<?php echo e(isset($taxicompany) ? $taxicompany->phone : ''); ?>" required>
                                    <?php if($errors->has('phone')): ?>
                                        <label class="danger"><?php echo e($errors->first('phone')); ?></label>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="firstName3">
                                        <?php echo app('translator')->get('admin.company_contact_pers'); ?> :
                                        <span class="danger">*</span>
                                    </label>
                                    <input type="text" class="form-control" id="contact_person"
                                           name="contact_person"
                                           placeholder="<?php echo app('translator')->get('admin.company_contact_pers'); ?>"
                                           value="<?php echo e(isset($taxicompany) ? $taxicompany->contact_person : ''); ?>">
                                    <?php if($errors->has('contact_person')): ?>
                                        <label class="danger"><?php echo e($errors->first('contact_person')); ?></label>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="firstName3">
                                        <?php echo app('translator')->get("$string_file.password"); ?> :
                                        <span class="danger">*</span>
                                    </label>
                                    <input type="password" class="form-control" id="password"
                                           name="password"
                                           placeholder="<?php echo app('translator')->get("$string_file.password"); ?>" required disabled>
                                    <?php if($errors->has('password')): ?>
                                        <label class="danger"><?php echo e($errors->first('password')); ?></label>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="firstName3">
                                        <?php echo app('translator')->get('admin.company_add'); ?> :
                                        <span class="danger">*</span>
                                    </label>
                                    <input type="text" class="form-control" id="address"
                                           name="address"
                                           placeholder="<?php echo app('translator')->get('admin.company_add'); ?>"
                                           value="<?php echo e(isset($taxicompany) ? $taxicompany->address : ''); ?>" required>
                                    <?php if($errors->has('address')): ?>
                                        <label class="danger"><?php echo e($errors->first('address')); ?></label>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <fieldset class="checkbox">
                                    <label>
                                        <input type="checkbox" value="1" name="edit_password"
                                               id="edit_password" onclick="EditPassword()">
                                        <?php echo app('translator')->get("$string_file.edit_password"); ?>
                                    </label>
                                </fieldset>
                            </div>
                        </div>
                        <div class="form-actions d-flex flex-row-reverse p-2">
                            <button type="submit" class="btn btn-primary">
                                <i class="wb-check-circle"></i> <?php echo app('translator')->get("$string_file.save"); ?>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        function EditPassword() {
            if (document.getElementById("edit_password").checked = true) {
                document.getElementById('password').disabled = false;
            }
        }
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('taxicompany.layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/qazaq/public_html/admin.qazaq.taxi/ms-v3/resources/views/taxicompany/random/profile.blade.php ENDPATH**/ ?>