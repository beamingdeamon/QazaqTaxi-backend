<?php $__env->startSection('content'); ?>
    <div class="page">
        <div class="page-content">
            <?php echo $__env->make('merchant.shared.errors-and-messages', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <div class="panel panel-bordered">
                <div class="panel-heading">
                    <div class="panel-actions">
                        <div class="btn-group float-right" >
                            <a href="<?php echo e(route('merchant.taxi-company')); ?>">
                                <button type="button" class="btn btn-icon btn-success"style="margin:10px"><i
                                            class="wb-reply"></i>
                                </button>
                            </a>
                        </div>
                    </div>
                    <h3 class="panel-title">
                        <i class="icon wb-plus" aria-hidden="true"></i>
                        <?php echo app('translator')->get("$string_file.add_taxi_company"); ?>
                    </h3>
                </div>
                <?php $id = isset($company->id) ? $company->id : NULL  ?>
                <div class="panel-body container-fluid">
                    <section id="validation">
                        <form method="POST" class="steps-validation wizard-notification"
                              enctype="multipart/form-data" action="<?php echo e(route('merchant.taxi-company.save',$id)); ?>">
                            <?php echo csrf_field(); ?>
                            <?php echo Form::hidden('id',$id); ?>

                                   <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="firstName3">
                                                <?php echo app('translator')->get("$string_file.name"); ?>
                                                <span class="text-danger">*</span>
                                            </label>
                                            <input type="text" class="form-control" id="name"
                                                   name="name" value="<?php echo e(isset($company->name) ? $company->name : NULL); ?>"
                                                   placeholder="" required>
                                            <?php if($errors->has('name')): ?>
                                                <label class="text-danger"><?php echo e($errors->first('name')); ?></label>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                       <div class="form-group">
                                           <label for="emailAddress5">
                                               <?php echo app('translator')->get("$string_file.country"); ?>
                                               <span class="text-danger">*</span>
                                           </label>
                                           <select class="form-control" id="country" name="country">
                                               <option value=""> -- <?php echo app('translator')->get("$string_file.select"); ?>--</option>
                                               <?php $__currentLoopData = $countries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $country): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                   <option value="<?php echo e($country->id); ?>" <?php if(!empty($company)): ?><?php if($company->country_id == $country->id): ?> selected <?php endif; ?> <?php endif; ?>><?php echo e($country->CountryName); ?></option>
                                               <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                           </select>
                                           <?php if($errors->has('country')): ?>
                                               <label class="text-danger"><?php echo e($errors->first('country')); ?></label>
                                           <?php endif; ?>
                                       </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="firstName3">
                                                <?php echo app('translator')->get("$string_file.phone"); ?>
                                                <span class="text-danger">*</span>
                                            </label>
                                            <input type="text" class="form-control" id="phone"
                                                   name="phone" value="<?php echo e(isset($company->phone) ? $company->phone : NULL); ?>"
                                                   placeholder="" required>
                                            <?php if($errors->has('phone')): ?>
                                                <label class="text-danger"><?php echo e($errors->first('phone')); ?></label>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="emailAddress5">
                                                <?php echo app('translator')->get("$string_file.company_contact_pers"); ?>
                                                <span class="text-danger">*</span>
                                            </label>
                                            <input type="text" class="form-control" id="contact_person"
                                                   name="contact_person" value="<?php echo e(isset($company->contact_person) ? $company->contact_person : NULL); ?>"
                                                   placeholder="" required>
                                            <?php if($errors->has('contact_person')): ?>
                                                <label class="text-danger"><?php echo e($errors->first('contact_person')); ?></label>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="lastName3">
                                                <?php echo app('translator')->get("$string_file.email"); ?>
                                                <span class="text-danger">*</span>
                                            </label>
                                            <input type="email" class="form-control" id="email"
                                                   name="email" value="<?php echo e(isset($company->email) ? $company->email : NULL); ?>"
                                                   placeholder="" required>
                                            <?php if($errors->has('email')): ?>
                                                <label class="text-danger"><?php echo e($errors->first('email')); ?></label>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="emailAddress5">
                                                <?php echo app('translator')->get("$string_file.address"); ?>
                                                <span class="text-danger">*</span>
                                            </label>
                                            <input type="text" class="form-control" id="address"
                                                   name="address" value="<?php echo e(isset($company->address) ? $company->address : NULL); ?>"
                                                   placeholder="" required>
                                            <?php if($errors->has('address')): ?>
                                                <label class="text-danger"><?php echo e($errors->first('address')); ?></label>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <div class="col-md-4" id="areaList">
                                        <div class="form-group">
                                            <label for="emailAddress5">
                                                <?php echo app('translator')->get("$string_file.password"); ?>
                                                <span class="text-danger">*</span>
                                            </label>
                                            <input class="form-control" type="password" name="password" id="password" >
                                            <?php if($errors->has('password')): ?>
                                                <label class="text-danger"><?php echo e($errors->first('password')); ?></label>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <div class="col-md-4 corporate_inr">
                                        <div class="form-group">
                                            <label for="location3"> <?php echo app('translator')->get("$string_file.logo"); ?>
                                                <span class="text-danger">*</span>
                                            </label>
                                            <input style="height: 0%;" class="form-control" type="file" name="company_logo" id="company_logo">
                                            <?php if($errors->has('company_logo')): ?>
                                                <label class="text-danger"><?php echo e($errors->first('company_logo')); ?></label>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                                <h4> <?php echo app('translator')->get("$string_file.bank_details"); ?></h4>
                            <br>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="lastName3">
                                                 <?php echo app('translator')->get("$string_file.bank_name"); ?>
                                                <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="bank_name"
                                                   name="bank_name" value="<?php echo e(old('bank_name',isset($company->bank_name) ? $company->bank_name : NULL)); ?>"
                                                   placeholder="">
                                            <?php if($errors->has('bank_name')): ?>
                                                <label class="text-danger"><?php echo e($errors->first('bank_name')); ?></label>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="lastName3">
                                                <?php echo app('translator')->get("$string_file.account_holder_name"); ?>
                                                <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control"
                                                   id="account_holder_name" value="<?php echo e(old('account_holder_name',isset($company->account_holder_name) ? $company->account_holder_name : NULL)); ?>"
                                                   name="account_holder_name">
                                            <?php if($errors->has('account_holder_name')): ?>
                                                <label class="text-danger"><?php echo e($errors->first('account_holder_name')); ?></label>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="lastName3">
                                                <?php echo app('translator')->get("$string_file.account_number"); ?>
                                                <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control required"
                                                   id="account_number" value="<?php echo e(isset($company->account_number) ? $company->account_number : NULL); ?>"
                                                   name="account_number"
                                                   >
                                            <?php if($errors->has('account_number')): ?>
                                                <label class="text-danger"><?php echo e($errors->first('account_number')); ?></label>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="location3" id="transaction_label">
                                                <?php echo app('translator')->get("$string_file.online_transaction_code"); ?>
                                                <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control"
                                                   id="online_transaction"
                                                   name="online_transaction"
                                                   value="<?php echo e(old('online_transaction',isset($company->online_transaction) ? $company->online_transaction : NULL)); ?>"
                                                   placeholder="">
                                            <?php if($errors->has('online_transaction')): ?>
                                                <label class="text-danger"><?php echo e($errors->first('online_transaction')); ?></label>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="location3"><?php echo app('translator')->get("$string_file.account_type"); ?>
                                                <span class="text-danger">*</span></label>
                                            <select type="text" class="form-control"
                                                    id="account_types"
                                                    name="account_types">
                                                <?php $__currentLoopData = $account_types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $account_type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option value="<?php echo e($account_type->id); ?>" value="<?php echo e($account_type->id); ?>" <?php if(!empty($company)): ?> <?php if($company->account_type_id == $account_type->id): ?> selected <?php endif; ?> <?php endif; ?> > <?php if($account_type->LangAccountTypeSingle): ?><?php echo e($account_type->LangAccountTypeSingle->name); ?> <?php else: ?> <?php echo e($account_type->LangAccountTypeAny->name); ?> <?php endif; ?></option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>
                                            <?php if($errors->has('account_types')): ?>
                                                <label class="text-danger"><?php echo e($errors->first('account_types')); ?></label>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            <div class="form-actions d-flex flex-row-reverse p-2">
                                <?php if($id == NULL || $edit_permission): ?>
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fa fa-check-circle"></i> <?php echo app('translator')->get("$string_file.save"); ?>
                                    </button>
                                 <?php endif; ?>
                            </div>
                        </form>
                    </section>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('merchant.layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/eldar/Desktop/ms-v3/resources/views/merchant/taxicompany/create.blade.php ENDPATH**/ ?>