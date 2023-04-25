<?php $__env->startSection('content'); ?>
    <div class="page">
        <div class="page-content">
            <?php echo $__env->make('merchant.shared.errors-and-messages', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <div class="panel panel-bordered">
                <header class="panel-heading">
                    <div class="panel-actions"></div>
                    <h1 class="panel-title">
                        <i class="icon fa-gears" aria-hidden="true"></i>
                        <?php echo app('translator')->get("$string_file.carpooling"); ?> <?php echo app('translator')->get("$string_file.country"); ?> <?php echo app('translator')->get("$string_file.configuration"); ?>
                    </h1>
                </header>

                <div class="panel-body container-fluid">
                    <section id="validation">
                        <form method="POST" class="steps-validation wizard-notification"
                              enctype="multipart/form-data"
                              action="<?php echo e(route('merchant.carpooling.config.country.store')); ?>" id="config">
                            <?php echo csrf_field(); ?>
                            <input type="hidden" id="id" name="update_id">
                            <div class="row">
                                <div class="col-md-3"></div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="google_key">
                                            <?php echo app('translator')->get("$string_file.carpooling"); ?> <?php echo app('translator')->get("$string_file.country"); ?>
                                            <span class="text-danger">*</span>
                                        </label>
                                        <select class="form-control" id="country_id"
                                                name="country_id" required>
                                            <option value=""> <?php echo app('translator')->get("$string_file.select"); ?>  <?php echo app('translator')->get("$string_file.country"); ?></option>
                                            <?php $__currentLoopData = $country_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option id="country_id"
                                                        value="<?php echo e($value->id); ?>"><?php echo e($value->CountryName); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                        <?php if($errors->has('country_id')): ?>
                                            <label class="text-danger"><?php echo e($errors->first('country_id')); ?></label>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="col-md-3"></div>
                            </div>

                            <h3 class="panel-title"><?php echo app('translator')->get("$string_file.other"); ?> <?php echo app('translator')->get("$string_file.configuration"); ?></h3>
                            <div class="row">
                                 <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="google_key">
                                            <?php echo app('translator')->get("$string_file.short"); ?> <?php echo app('translator')->get("$string_file.ride"); ?>

                                            <span class="text-danger">*</span>
                                        </label>
                                        <input type="text" class="form-control"
                                               id="short_ride"
                                               name="short_ride"
                                               value="<?php echo e(old('short_ride')); ?>"
                                               placeholder="<?php echo app('translator')->get("$string_file.enter"); ?> <?php echo app('translator')->get("$string_file.short"); ?> <?php echo app('translator')->get("$string_file.ride"); ?> <?php echo app('translator')->get("$string_file.in"); ?> <?php echo app('translator')->get("$string_file.km"); ?>">
                                        <?php if($errors->has('short_ride')): ?>
                                            <label class="danger"><?php echo e($errors->first('short_ride')); ?></label>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="google_key">
                                            <?php echo app('translator')->get("$string_file.start"); ?> <?php echo app('translator')->get("$string_file.location"); ?> <?php echo app('translator')->get("$string_file.radius"); ?>
                                            <span class="text-danger">*</span>
                                        </label>
                                        <input type="text" class="form-control"
                                               id="start_location_radius"
                                               name="start_location_radius"
                                               value="<?php echo e(old('short_ride')); ?>"
                                               placeholder="<?php echo app('translator')->get("$string_file.enter"); ?>  <?php echo app('translator')->get("$string_file.drop"); ?> <?php echo app('translator')->get("$string_file.location"); ?> <?php echo app('translator')->get("$string_file.radius"); ?> <?php echo app('translator')->get("$string_file.in"); ?> <?php echo app('translator')->get("$string_file.km"); ?>">
                                        <?php if($errors->has('drop_location_radius')): ?>
                                            <label class="danger"><?php echo e($errors->first('start_location_radius')); ?></label>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="google_key">
                                            <?php echo app('translator')->get("$string_file.drop"); ?> <?php echo app('translator')->get("$string_file.location"); ?> <?php echo app('translator')->get("$string_file.radius"); ?>

                                            <span class="text-danger">*</span>
                                        </label>
                                        <input type="text" class="form-control"
                                               id="drop_location_radius"
                                               name="drop_location_radius"
                                               value=""
                                               placeholder="<?php echo app('translator')->get("$string_file.enter"); ?>  <?php echo app('translator')->get("$string_file.drop"); ?> <?php echo app('translator')->get("$string_file.location"); ?> <?php echo app('translator')->get("$string_file.radius"); ?> <?php echo app('translator')->get("$string_file.in"); ?> <?php echo app('translator')->get("$string_file.km"); ?>">
                                        <?php if($errors->has('drop_location_radius')): ?>
                                            <label class="danger"><?php echo e($errors->first('drop_location_radius')); ?></label>
                                        <?php endif; ?>
                                    </div>
                                </div>
                          
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="google_key">
                                            <?php echo app('translator')->get("$string_file.short"); ?> <?php echo app('translator')->get("$string_file.ride"); ?> <?php echo app('translator')->get("$string_file.time"); ?>

                                            <span class="text-danger">*</span>
                                        </label>
                                        <input type="text" class="form-control"
                                               id="short_ride_time"
                                               name="short_ride_time"
                                               value=""
                                               placeholder="<?php echo app('translator')->get("$string_file.enter"); ?>  <?php echo app('translator')->get("$string_file.time"); ?> <?php echo app('translator')->get("$string_file.in"); ?> <?php echo app('translator')->get("$string_file.minute"); ?>">
                                        <?php if($errors->has('short_ride_time')): ?>
                                            <label class="danger"><?php echo e($errors->first('short_ride_time')); ?></label>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                 <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="google_key">
                                            <?php echo app('translator')->get("$string_file.long"); ?> <?php echo app('translator')->get("$string_file.ride"); ?> <?php echo app('translator')->get("$string_file.time"); ?>

                                            <span class="text-danger">*</span>
                                        </label>
                                        <input type="text" class="form-control"
                                               id="long_ride_time"
                                               name="long_ride_time"
                                               value=""
                                               placeholder="<?php echo app('translator')->get("$string_file.enter"); ?>  <?php echo app('translator')->get("$string_file.time"); ?> <?php echo app('translator')->get("$string_file.in"); ?> <?php echo app('translator')->get("$string_file.hour"); ?>">
                                        <?php if($errors->has('long_ride_time')): ?>
                                            <label class="danger"><?php echo e($errors->first('long_ride_time')); ?></label>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="google_key">
                                            <?php echo app('translator')->get("$string_file.user"); ?> <?php echo app('translator')->get("$string_file.ride"); ?> <?php echo app('translator')->get("$string_file.start"); ?> <?php echo app('translator')->get("$string_file.time"); ?>

                                            <span class="text-danger">*</span>
                                        </label>
                                        <input type="text" class="form-control"
                                               id="user_ride_start_time"
                                               name="user_ride_start_time"
                                               value=""
                                               placeholder="<?php echo app('translator')->get("$string_file.enter"); ?>  <?php echo app('translator')->get("$string_file.user"); ?> <?php echo app('translator')->get("$string_file.ride"); ?> <?php echo app('translator')->get("$string_file.start"); ?> <?php echo app('translator')->get("$string_file.time"); ?>  <?php echo app('translator')->get("$string_file.in"); ?> <?php echo app('translator')->get("$string_file.minute"); ?>">
                                        <?php if($errors->has('user_ride_start_time')): ?>
                                            <label class="danger"><?php echo e($errors->first('user_ride_start_time')); ?></label>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="google_key">
                                            <?php echo app('translator')->get("$string_file.user"); ?> <?php echo app('translator')->get("$string_file.reminder_expire_doc"); ?>

                                            <span class="text-danger">*</span>
                                        </label>
                                        <input type="text" class="form-control"
                                               id="user_document_reminder_time"
                                               name="user_document_reminder_time"
                                               value=""
                                               placeholder="<?php echo app('translator')->get("$string_file.enter"); ?> <?php echo app('translator')->get("$string_file.user"); ?> <?php echo app('translator')->get("$string_file.document"); ?> <?php echo app('translator')->get("$string_file.reminder"); ?> <?php echo app('translator')->get("$string_file.time"); ?>  <?php echo app('translator')->get("$string_file.in"); ?> <?php echo app('translator')->get("$string_file.hour"); ?>">
                                        <?php if($errors->has('user_document_reminder_time')): ?>
                                            <label class="danger"><?php echo e($errors->first('user_document_reminder_time')); ?></label>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                            <div class="form-actions d-flex flex-row-reverse p-2">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-check-circle"></i> <?php echo app('translator')->get("$string_file.save"); ?>
                                </button>
                            </div>
                        </form>
                    </section>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('js'); ?>
    <script>
        $(document).ready(function(){
    var config = $('#config');
    $('#submit').click(function(){
        $.ajax({
            url: form.attr('action'),
            type:"POST",
            data: $('#config input').serialize(),

            success:function(data){
                console.log(data);
            }

            
        });
    });
        });   
        $(document).on('change', '#country_id', function () {
            var id = $(this).val();
            $.ajax({
                type: "GET",
                url: "<?php echo e(route('merchant.carpooling.config')); ?>",
                data: {
                    "id":id,
                },
                success: function (response) {
                    $('#id').val(response.id);
                    $('#short_ride').val(response.short_ride);
                    $('#start_location_radius').val(response.start_location_radius);
                    $('#drop_location_radius').val(response.drop_location_radius);
                    $('#short_ride_time').val(response.short_ride_time);
                    $('#long_ride_time').val(response.long_ride_time);
                    $('#user_ride_start_time').val(response.user_ride_start_time);
                    $('#user_document_reminder_time').val(response.user_document_reminder_time);
       
                }
            });
        });
        
    </script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('merchant.layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/msprojectsappori/public_html/multi-service-v3/resources/views/merchant/random/country_wise_carpooling_config.blade.php ENDPATH**/ ?>