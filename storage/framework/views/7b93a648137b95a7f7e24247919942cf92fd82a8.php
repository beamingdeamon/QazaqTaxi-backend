
<?php $__env->startSection('content'); ?>
    <div class="page">
        <div class="page-content">
            <?php echo $__env->make('taxicompany.shared.errors-and-messages', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php if(Session::has('personal-document-expire-warning')): ?>
                <p class="alert alert-info"><?php echo e(Session::get('personal-document-expire-warning')); ?></p>
            <?php endif; ?>
            <?php if(Session::has('personal-document-expired-error')): ?>
                <div class="alert dark alert-icon alert-danger" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                    <i class="icon fa-warning"
                       aria-hidden="true"></i> <?php echo e(Session::get('personal-document-expired-error')); ?>

                </div>
            <?php endif; ?>
            <div class="panel panel-bordered">
                <header class="panel-heading">
                    <div class="panel-actions">
                        <a href="<?php echo e(route('taxicompany.driver.index')); ?>" data-toggle="tooltip">
                            <button type="button" class="btn btn-icon btn-success float-right" style="margin:10px">
                                <i class="wb-reply" title="<?php echo app('translator')->get("$string_file.all_drivers"); ?>"></i>
                            </button>
                        </a>
                    </div>
                    <h3 class="panel-title"><i class="icon wb-plus" aria-hidden="true"></i>
                        <?php echo $title; ?></h3>
                </header>
                <div class="panel-body container-fluid">
                    
                    <?php $id = NULL; $required = "required"; ?>
                    <?php if(!empty($driver->id)): ?>
                        <?php $id = $driver->id; $required=""; ?>

                    <?php endif; ?>
                    <?php if(Auth::user()->demo != 1): ?>
                        <?php echo Form::open(["class"=>"steps-validation wizard-notification", "files"=>true,"url"=>route('taxicompany.driver.save',$id),"onsubmit"=>"return validatesignup()"]); ?>

                        <?php echo Form::hidden('id',$id,['id'=>"driver_id"]); ?>

                        <?php echo csrf_field(); ?>
                        <div class="row">
                            <div class="col-md-12">
                                <h5 class="form-section col-md-12" style="color: #000000;"><i class="wb-user"></i> <?php echo app('translator')->get("$string_file.personal_details"); ?>
                                </h5>
                                <hr>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="form-control-label"
                                                   for="location3"><?php echo app('translator')->get("$string_file.country"); ?>
                                                <span class="text-danger">*</span>
                                            </label>
                                            <?php if(empty($id) || (!empty($id) && empty($driver->country_id))): ?>
                                                <select class="form-control" name="country" id="country"
                                                        onchange="getAreaList(this)" required>
                                                    <option value=""><?php echo app('translator')->get("$string_file.select"); ?></option>
                                                    <?php $__currentLoopData = $countries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $country): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <option data-min="<?php echo e($country->minNumPhone); ?>"
                                                                data-max="<?php echo e($country->maxNumPhone); ?>"
                                                                data-ISD="<?php echo e($country->phonecode); ?>"
                                                                value="<?php echo e($country->id); ?>"
                                                                data-id="<?php echo e($country->id); ?>"><?php echo e($country->name); ?>

                                                        </option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </select>
                                                <?php if($errors->has('country')): ?>
                                                    <label class="text-danger"><?php echo e($errors->first('country')); ?></label>
                                                <?php endif; ?>
                                            <?php else: ?>
                                                <?php echo Form::text('county_name',$driver->Country->CountryName,['class'=>'form-control','disabled'=>true]); ?>

                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="form-control-label"
                                                   for="location3"><?php echo app('translator')->get("$string_file.service_area"); ?>
                                                <span class="text-danger">*</span>
                                            </label>
                                        <?php if(empty($id) || (!empty($id) && empty($driver->country_area_id))): ?>
                                            <!--<select class="form-control" name="area" id="area">-->
                                            <!--    <option value="">--<?php echo app('translator')->get("$string_file.select"); ?>--</option>-->
                                                <!--</select>-->
                                                <?php echo Form::select("area",$areas,null,["class" => "form-control", "id" => "area", "required" => true]); ?>

                                                <?php if($errors->has('area')): ?>
                                                    <label class="text-danger"><?php echo e($errors->first('area')); ?></label>
                                                <?php endif; ?>
                                            <?php else: ?>
                                                <?php echo Form::text('county_area_name',$driver->CountryArea->CountryAreaName,['class'=>'form-control','disabled'=>true]); ?>

                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="form-control-label"
                                                   for="user_phone"><?php echo app('translator')->get("$string_file.phone"); ?>
                                                <span class="text-danger">*</span>
                                            </label>
                                            <div class="row">
                                                <input type="text"
                                                       class="form-control col-md-3 ml-15 col-sm-3 col-3" id="isd"
                                                       name="isd"
                                                       value="<?php echo e(old('isd',isset($driver->Country) ? $driver->Country->phonecode : NULL)); ?>"
                                                       placeholder="<?php echo app('translator')->get("$string_file.isd_code"); ?>" readonly/>
                                                <input type="number" class="form-control col-md-8 col-sm-8 col-8"
                                                       id="user_phone" name="phone"
                                                       value="<?php echo e(old('phone',isset($driver->Country)?str_replace($driver->Country->phonecode,"",$driver->phoneNumber):NULL)); ?>"
                                                       placeholder="" required/>
                                            </div>
                                            <?php if($errors->has('phonecode')): ?>
                                                <label class="text-danger"><?php echo e($errors->first('phonecode')); ?></label>
                                            <?php endif; ?>
                                            <?php if($errors->has('phone')): ?>
                                                <label class="text-danger"><?php echo e($errors->first('phone')); ?></label>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="form-control-label"
                                                   for="first_name"> <?php echo app('translator')->get("$string_file.first_name"); ?>
                                                <span class="text-danger">*</span>
                                            </label>
                                            <input type="text" class="form-control" id="first_name"
                                                   name="first_name"
                                                   value="<?php echo e(old('first_name',isset($driver->first_name) ? $driver->first_name : NULL)); ?>"
                                                   placeholder=" <?php echo app('translator')->get("$string_file.first_name"); ?>" required
                                                   autocomplete="off"/>
                                        </div>
                                        <?php if($errors->has('first_name')): ?>
                                            <label class="text-danger"><?php echo e($errors->first('first_name')); ?></label>
                                        <?php endif; ?>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="form-control-label"
                                                   for="firstName3"><?php echo app('translator')->get("$string_file.last_name"); ?>
                                                
                                            </label>
                                            <input type="text" class="form-control" id="last_name" name="last_name"
                                                   value="<?php echo e(old('last_name',isset($driver->last_name) ? $driver->last_name : NULL)); ?>"
                                                   placeholder="<?php echo app('translator')->get("$string_file.last_name"); ?>"
                                                   autocomplete="off"/>
                                        </div>
                                        <?php if($errors->has('last_name')): ?>
                                            <label class="text-danger"><?php echo e($errors->first('last_name')); ?></label>
                                        <?php endif; ?>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="form-control-label"
                                                   for="emailAddress5"><?php echo app('translator')->get("$string_file.profile_image"); ?>
                                                <span class="text-danger">*</span>
                                                <?php if(!empty($driver->profile_image)): ?>
                                                    <a href="<?php echo e(get_image($driver->profile_image,'driver',$driver->merchant_id)); ?>"
                                                       target="_blank"><?php echo app('translator')->get("$string_file.view"); ?></a>
                                                <?php endif; ?>
                                            </label>
                                            <input type="file" class="form-control" id="image" name="image"
                                                    <?php echo e($required); ?>/>
                                            <?php if($errors->has('image')): ?>
                                                <label class="text-danger"><?php echo e($errors->first('image')); ?></label>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="form-control-label" for="email"><?php echo app('translator')->get("$string_file.email"); ?>
                                                <span class="text-danger">*</span>
                                            </label>
                                            <input type="email" class="form-control" id="email" name="email"
                                                   placeholder="" autocomplete="off"
                                                   value="<?php echo e(old('email',isset($driver->email) ? $driver->email : NULL)); ?>"
                                                   required/>
                                        </div>
                                        <?php if($errors->has('email')): ?>
                                            <label class="text-danger"><?php echo e($errors->first('email')); ?></label>
                                        <?php endif; ?>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="form-control-label"
                                                   for="emailAddress5"><?php echo app('translator')->get("$string_file.password"); ?>
                                                <?php if($required): ?>
                                                    <span class="text-danger">*</span>
                                                <?php endif; ?>
                                            </label>
                                            <input type="password" class="form-control" id="password"
                                                   name="password"
                                                   placeholder="" autocomplete="off"
                                                    <?php echo e($required); ?>/>
                                        </div>
                                        <?php if($errors->has('password')): ?>
                                            <label class="text-danger"><?php echo e($errors->first('password')); ?></label>
                                        <?php endif; ?>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="form-control-label"
                                                   for="location"><?php echo e(trans("$string_file.confirm_password")); ?>

                                                <?php if($required): ?>
                                                    <span class="text-danger">*</span>
                                                <?php endif; ?>
                                            </label>
                                            <input type="password" class="form-control" id="password_confirmation"
                                                   name="password_confirmation"
                                                   placeholder="" autocomplete="off"
                                                    <?php echo e($required); ?>/>
                                        </div>
                                    </div>
                                    <?php if($config->gender == 1): ?>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="form-control-label"
                                                       for="driver_gender"><?php echo app('translator')->get("$string_file.gender"); ?>
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <select class="form-control" name="driver_gender" id="driver_gender"
                                                        required>
                                                    <option value="1"
                                                            <?php if(!empty($driver->driver_gender) && $driver->driver_gender == 1): ?> selected <?php endif; ?>><?php echo app('translator')->get("$string_file.male"); ?></option>
                                                    <option value="2"
                                                            <?php if(!empty($driver->driver_gender) && $driver->driver_gender == 2): ?> selected <?php endif; ?>><?php echo app('translator')->get("$string_file.female"); ?></option>
                                                </select>
                                                <?php if($errors->has('driver_gender')): ?>
                                                    <label class="text-danger"><?php echo e($errors->first('driver_gender')); ?></label>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                    <?php if($config->smoker == 1): ?>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="form-control-label"
                                                       for="location3"> <?php echo app('translator')->get("$string_file.smoke"); ?>
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <select class="form-control" name="smoker_type" id="smoker_type"
                                                        required>
                                                    <option value="1"
                                                            <?php if(!empty($driver->DriverRideConfig) && $driver->DriverRideConfig->smoker_type == 1): ?>
                                                            selected="selected" <?php endif; ?>> <?php echo app('translator')->get("$string_file.smoker"); ?></option>
                                                    <option value="2"
                                                            <?php if(!empty($driver->DriverRideConfig) && $driver->DriverRideConfig->smoker_type == 2): ?>
                                                            selected="selected" <?php endif; ?>> <?php echo app('translator')->get("$string_file.non_smoker"); ?></option>
                                                </select>

                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-control-label"></label>
                                            <div class="checkbox-inline"
                                                 style="margin-left: 5%;margin-top: 1%;">
                                                <input type="checkbox" name="allow_other_smoker" value="1"
                                                       id="allow_other_smoker"
                                                       <?php if(!empty($driver->DriverRideConfig) && $driver->DriverRideConfig->allow_other_smoker == 1): ?> checked
                                                        <?php endif; ?>>
                                                <label> <?php echo app('translator')->get("$string_file.allow_other_to_smoke"); ?></label>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                </div>
                                <br>
                                <h5 class="form-section col-md-12" style="color: black;">
                                    <i class="fa fa-address-card"></i> <?php echo app('translator')->get("$string_file.address"); ?>
                                </h5>
                                <hr>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="form-control-label"
                                                   for="location3"> <?php echo app('translator')->get("$string_file.address_line_1"); ?>
                                                <span class="text-danger">*</span>
                                            </label>
                                            <input type="text" class="form-control" id="address_line_1"
                                                   name="address_line_1"
                                                   value="<?php echo e(old('address_line_1',isset($driver_additional_data->address_line_1) ? $driver_additional_data->address_line_1 : '')); ?>"
                                                   placeholder=""
                                                   autocomplete="off" required/>
                                        </div>
                                        <?php if($errors->has('address_line_1')): ?>
                                            <label class="text-danger"><?php echo e($errors->first('address_line_1')); ?></label>
                                        <?php endif; ?>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="form-control-label"><?php echo app('translator')->get("$string_file.city_name"); ?>
                                                <span class="text-danger">*</span>
                                            </label>
                                            <input type="text" class="form-control" id="city_name"
                                                   name="city_name"
                                                   value="<?php echo e(old('city_name', isset($driver_additional_data->city_name) ? $driver_additional_data->city_name : '')); ?>"
                                                   placeholder=""
                                                   autocomplete="off" required/>
                                        </div>
                                        <?php if($errors->has('city_name')): ?>
                                            <label class="text-danger"><?php echo e($errors->first('city_name')); ?></label>
                                        <?php endif; ?>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="form-control-label"
                                                   for="location3"><?php echo app('translator')->get("$string_file.postal_code"); ?>
                                                <span class="text-danger">*</span>
                                            </label>
                                            <input type="text" class="form-control" id="address_postal_code"
                                                   name="address_postal_code"
                                                   value="<?php echo e(old('address_postal_code',isset($driver_additional_data->pincode) ? $driver_additional_data->pincode : '')); ?>"
                                                   placeholder=""
                                                   autocomplete="off" required/>
                                        </div>
                                        <?php if($errors->has('address_postal_code')): ?>
                                            <label class="text-danger"><?php echo e($errors->first('address_postal_code')); ?></label>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <?php if($config->bank_details == 1): ?>
                                    <br>
                                    <h5 class="form-section col-md-12" style="color: black;"><i
                                                class="fa fa-bank"></i> <?php echo app('translator')->get("$string_file.bank_details"); ?>
                                    </h5>
                                    <hr>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="form-control-label"
                                                       for="lastName3"><?php echo app('translator')->get("$string_file.bank_name"); ?>
                                                </label>
                                                <input type="text" class="form-control" id="bank_name"
                                                       name="bank_name"
                                                       value="<?php echo e(old('bank_name',isset($driver->bank_name) ? $driver->bank_name : NULL)); ?>"
                                                       placeholder="Your bank name" required
                                                       autocomplete="off"/>
                                            </div>
                                            <?php if($errors->has('bank_name')): ?>
                                                <label class="text-danger"><?php echo e($errors->first('bank_name')); ?></label>
                                            <?php endif; ?>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="form-control-label"
                                                       for="lastName3"><?php echo app('translator')->get("$string_file.account_holder_name"); ?>
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <input type="text" class="form-control" id="account_holder_name"
                                                       name="account_holder_name"
                                                       value="<?php echo e(old('account_holder_name',isset($driver->account_holder_name) ? $driver->account_holder_name : NULL)); ?>"
                                                       placeholder="" required
                                                       autocomplete="off"/>
                                            </div>
                                            <?php if($errors->has('account_holder_name')): ?>
                                                <label class="text-danger"><?php echo e($errors->first('account_holder_name')); ?></label>
                                            <?php endif; ?>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="form-control-label"
                                                       for="lastName3"><?php echo app('translator')->get("$string_file.account_number"); ?>
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <input type="text" class="form-control" id="account_number"
                                                       name="account_number"
                                                       value="<?php echo e(old('account_number',isset($driver->account_number) ? $driver->account_number : NULL)); ?>"
                                                       placeholder="<?php echo app('translator')->get("$string_file.account_number"); ?>"
                                                       autocomplete="off"/>
                                            </div>
                                            <?php if($errors->has('account_number')): ?>
                                                <label class="text-danger"><?php echo e($errors->first('account_number')); ?></label>
                                            <?php endif; ?>
                                        </div>
                                        <div class="col-md-4">
                                                <span class="form-group">
                                                    <label class="form-control-label"
                                                           for="location3">
                                                        <span id="transaction_label"><?php echo app('translator')->get("$string_file.online_transaction_code"); ?></span>
                                                        <span class="text-danger">*</span>
                                                    </label>
                                                    <input type="text" class="form-control" id="online_transaction"
                                                           name="online_transaction"
                                                           value="<?php echo e(old('online_transaction',isset($driver->online_code) ? $driver->online_code : NULL)); ?>"
                                                           placeholder="<?php echo app('translator')->get("$string_file.online_transaction_code"); ?>"
                                                           autocomplete="off"/>
                                                </div>
                                                <?php if($errors->has('online_transaction')): ?>
                                                    <label class="text-danger"><?php echo e($errors->first('online_transaction')); ?></label>
                                                <?php endif; ?>
                                        <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="form-control-label"
                                                           for="location3"><?php echo app('translator')->get("$string_file.account_type"); ?>
                                                        <span class="text-danger">*</span>
                                                    </label>
                                                    <select type="text" class="form-control" name="account_types"
                                                            id="account_types">
                                                        <?php $__currentLoopData = $account_types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $account_type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <option value="<?php echo e($account_type->id); ?>"><?php if($account_type->LangAccountTypeSingle): ?><?php echo e($account_type->LangAccountTypeSingle->name); ?>

                                                                <?php else: ?> <?php echo e($account_type->LangAccountTypeAny->name); ?> <?php endif; ?>
                                                            </option>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </select>
                                                    <?php if($errors->has('account_types')): ?>
                                                        <label class="text-danger"><?php echo e($errors->first('account_types')); ?></label>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                    </div>
                                <?php endif; ?>
                                <div id="personal-document">
                                    <?php echo $personal_document; ?>

                                </div>
                            </div>
                            <br>
                        </div>
                        <div class="form-actions float-right" style="margin-bottom: 1%">
                            <button type="submit" class="btn btn-primary"><i class="fa fa-check-circle"></i> <?php echo app('translator')->get("$string_file.save"); ?> & <?php echo app('translator')->get("$string_file.proceed"); ?></button>
                        </div>
                        <?php echo Form::close(); ?>

                    <?php else: ?>
                        <div class="alert dark alert-icon alert-danger" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                            <i class="icon fa-warning" aria-hidden="true"></i> <?php echo app('translator')->get("$string_file.demo_user_cant_edited"); ?>.
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('js'); ?>
<script>
    $(document).on('change', '#country', function () {
        var id = this.options[this.selectedIndex].getAttribute('data-id');
        $.ajax({
            method: 'GET',
            url: "<?php echo e(route('taxicompany.country.config')); ?>",
            data: {id: id},
            success: function (data) {
                $('#transaction_label').html(data);
                $('#online_transaction').attr('placeholder', 'Enter ' + data);
            }
        });
    });

    function getAreaList(obj) {
        var id = obj.options[obj.selectedIndex].getAttribute('data-id');
        $.ajax({
            method: 'GET',
            url: "<?php echo e(route('taxicompany.country.arealist')); ?>",
            data: {country_id: id},
            success: function (data) {
                $('#area').html(data);
            }
        });
    }

    function validatesignup() {
        var driver_id = $('#driver_id').val();
        if (driver_id == "") {
            var password = document.getElementById('password').value;
            var con_password = document.getElementById('password_confirmation').value;
            if (password == "") {
                alert("Please enter password");
                return false;
            }
            if (con_password == "") {
                alert("Please enter confirm password");
                return false;
            }
            if (con_password != password) {
                alert("Password and Confirm password must be same");
                return false;
            }
        }
    }

    $(document).on('change', '#area', function (e) {
        var area_id = $("#area option:selected").val();
        if (area_id != "") {
            var token = $('[name="_token"]').val();
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': token
                },
                method: 'POST',
                url: "<?php echo e(route('taxicompany.driver.country-area-document')); ?>",
                data: {area_id: area_id},
                success: function (data) {
                    $('#personal-document').html(data);
                    var dateToday = new Date();
                    $('.customDatePicker1').datepicker({
                        format: 'yyyy-mm-dd',
                        startDate: dateToday,
                        onRender: function (date) {
                            return date.valueOf() < now.valueOf() ? 'disabled' : '';
                        }
                    });
                }
            });
        }
    });
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('taxicompany.layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/qazaq/public_html/admin.qazaq.taxi/ms-v3/resources/views/taxicompany/driver/create.blade.php ENDPATH**/ ?>