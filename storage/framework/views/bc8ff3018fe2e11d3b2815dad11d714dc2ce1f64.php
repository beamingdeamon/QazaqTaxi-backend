<?php $__env->startSection('content'); ?>
<div class="page">
    <div class="page-content">
        <?php if(session('reward')): ?>
            <div class="alert dark alert-icon alert-info alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
                <i class="icon wb-info" aria-hidden="true"></i><?php echo e(session('reward')); ?>

            </div>
        <?php endif; ?>
        <div class="panel panel-bordered">
            <header class="panel-heading">
                <div class="panel-actions">
                    <a href="<?php echo e(route('reward-points.index')); ?>" data-toggle="tooltip">
                        <button type="button" class="btn btn-icon btn-success float-right" style="margin:10px">
                            <i class="wb-reply" title="<?php echo app('translator')->get('admin.message530'); ?>"></i>
                        </button>
                    </a>
                </div>
                <h3 class="panel-title">
                    <i class="fas fa-user-plus" aria-hidden="true"></i>
                    <?php echo app('translator')->get("$string_file.add"); ?> <?php echo app('translator')->get("$string_file.reward_points"); ?>
                </h3>
            </header>
            <div class="panel-body container-fluid">
                <section id="validation">
                    <form method="POST" class="steps-validation wizard-notification" action="<?php echo e(route('merchant.rewardSystem.store')); ?>">
                        <?php echo csrf_field(); ?>
                        <fieldset>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="text-capitalize"><?php echo app('translator')->get("$string_file.app"); ?></label>
                                        <select class="form-control" name="application" id="application">
                                            <option value=""> <?php echo app('translator')->get("$string_file.select"); ?> </option>
                                            <option value="1"><?php echo app('translator')->get("$string_file.user"); ?></option>
                                            
                                        </select>
                                        <span class="text-danger"><?php echo e($errors->first('application')); ?></span>
                                    </div>
                                </div>
                                <div class="col-md-4 custom-hidden" id="country_div">
                                    <div class="form-group">
                                        <label class="text-capitalize"><?php echo app('translator')->get("$string_file.select"); ?> <?php echo app('translator')->get("$string_file.country"); ?></label>
                                        <select class="form-control" name="country">
                                            <option value=""> <?php echo app('translator')->get("$string_file.select"); ?> </option>
                                            <?php $__currentLoopData = $countries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $country): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($country->id); ?>"
                                                        <?php echo e((old('country') == $country->id) ? ' selected' : ''); ?>

                                                >
                                                    <?php echo e($country->CountryName); ?>

                                                </option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                        <span class="text-danger"><?php echo e($errors->first('country')); ?></span>
    
                                    </div>
                                </div>
                                <div class="col-md-4 custom-hidden" id="country_area_div">
                                    <div class="form-group">
                                        <label class="text-capitalize"><?php echo app('translator')->get('admin.area.select'); ?></label>
                                        <select class="form-control" name="country_area">
                                            <option value=""> <?php echo app('translator')->get('admin.select'); ?> </option>
                                            <?php $__currentLoopData = $country_areas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $area): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($area->id); ?>"
                                                        <?php echo e((old('country_area') == $area->id) ? ' selected' : ''); ?>

                                                >
                                                    <?php echo e($area->CountryAreaName); ?>

                                                </option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    
                                        </select>
                                        <span class="text-danger"><?php echo e($errors->first('country_area')); ?></span>
    
                                    </div>
                                </div>
                            </div>
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            <div id="trip_expenses_div">
                                <hr>
                                <div class="row" >
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label class="text-capitalize"><?php echo app('translator')->get("$string_file.trip_expenses"); ?></label>
                                            <select class="form-control" name="trip_expenses" onchange="switchDisabled(this.value , 'expenses-switch')">
                                                <option value="2"> <?php echo app('translator')->get("$string_file.disable"); ?> </option>
                                                <option value="1" <?php echo e((old('trip_expenses') == 1) ? 'selected' : ''); ?>> <?php echo app('translator')->get("$string_file.enable"); ?> </option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="text-capitalize"><?php echo app('translator')->get("$string_file.per_point_amount"); ?></label>
                                            <input type="number" min="0" step="0.01" max="1000000" class="form-control expenses-switch" name="per_point_amount" value="<?php echo e(old('per_point_amount')); ?>"
                                              <?php echo e((old('per_point_amount') == 1) ? '' : 'disabled'); ?>

                                            />
                                            <?php if($errors->has('per_point_amount')): ?>
                                                <label class="text-danger"><?php echo e($errors->first('per_point_amount')); ?></label>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="text-capitalize"><?php echo app('translator')->get("$string_file.expire_in_days"); ?></label>
                                            <input type="number" max="1000000" class="form-control expenses-switch" name="expenses_expire_in_days" value="<?php echo e(old('expenses_expire_in_days')); ?>"
                                              <?php echo e((old('expenses_expire_in_days') == 1) ? '' : 'disabled'); ?>

                                            />
                                            <?php if($errors->has('expenses_expire_in_days')): ?>
                                                <label class="text-danger"><?php echo e($errors->first('expenses_expire_in_days')); ?></label>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                              
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            <hr>
                            <!--<div class="row">-->
                            <!--    <div class="col-md-2">-->
                            <!--        <div class="form-group">-->
                            <!--            <label class="text-capitalize"><?php echo app('translator')->get('admin.non'); ?> <?php echo app('translator')->get('admin.peak_hours'); ?></label>-->
                            <!--            <select class="form-control" name="non_peak_hours" onchange="switchDisabled(this.value , 'non_peak-switch')">-->
                            <!--                <option value="2"> <?php echo app('translator')->get('admin.disable'); ?> </option>-->
                            <!--                <option value="1" <?php echo e((old('non_peak_hours') == 1) ? 'selected' : ''); ?>> <?php echo app('translator')->get('admin.enable'); ?> </option>-->
                            <!--            </select>-->
                            <!--        </div>-->
                            <!--    </div>-->
                            <!--    <div class="col-md-2">-->
                            <!--        <div class="form-group">-->
                            <!--            <label class="text-capitalize"><?php echo app('translator')->get('admin.slab'); ?> 1</label>-->
                            <!--            <div class="row">-->
                            <!--                <div class="col-md-6">-->
                            <!--                    <input type="text" class="form-control non_peak-switch timepicker" name="slab_1_from" placeholder="From" value="<?php echo e(old('slab_1_from')); ?>"-->
                            <!--                      data-plugin="clockpicker" data-autoclose="true" id="time" autocomplete="off"-->
                            <!--                      <?php echo e((old('slab_1_from') == 1) ? '' : 'disabled'); ?>-->
                            <!--                    />-->
                            <!--                </div>-->
                            <!--                <div class="col-md-6">-->
                            <!--                    <input type="text" class="form-control non_peak-switch timepicker" name="slab_1_to" placeholder="To" value="<?php echo e(old('slab_1_to')); ?>"-->
                            <!--                      data-plugin="clockpicker" data-autoclose="true" id="time" autocomplete="off"-->
                            <!--                      <?php echo e((old('slab_1_to') == 1) ? '' : 'disabled'); ?>-->
                            <!--                    />-->
                            <!--                </div>-->
                            <!--            </div>-->
                            <!--        </div>-->
                            <!--    </div>-->
                            <!--    <div class="col-md-1">-->
                            <!--        <div class="form-group">-->
                            <!--            <label class="text-capitalize"><?php echo app('translator')->get('admin.points'); ?></label>-->
                            <!--            <input type="number" max="1000000" class="form-control non_peak-switch" name="points_collection" value="<?php echo e(old('points_collection')); ?>"-->
                            <!--              <?php echo e((old('points_collection') == 1) ? '' : 'disabled'); ?>-->
                            <!--            />-->
                            <!--        </div>-->
                            <!--    </div>-->
                            <!--    <div class="col-md-2">-->
                            <!--        <div class="form-group">-->
                            <!--            <label class="text-capitalize"><?php echo app('translator')->get('admin.slab'); ?> 2</label>-->
                            <!--            <div class="row">-->
                            <!--                <div class="col-md-6">-->
                            <!--                    <input type="text" class="form-control non_peak-switch timepicker" name="slab_2_from" placeholder="From" value="<?php echo e(old('slab_2_from')); ?>"-->
                            <!--                      data-plugin="clockpicker" data-autoclose="true" id="time" autocomplete="off"-->
                            <!--                      <?php echo e((old('slab_2_from') == 1) ? '' : 'disabled'); ?>-->
                            <!--                    />-->
                            <!--                </div>-->
                            <!--                <div class="col-md-6">-->
                            <!--                    <input type="text" class="form-control non_peak-switch timepicker" name="slab_2_to" placeholder="To" value="<?php echo e(old('slab_2_to')); ?>"-->
                            <!--                      data-plugin="clockpicker" data-autoclose="true" id="time" autocomplete="off"-->
                            <!--                      <?php echo e((old('slab_2_to') == 1) ? '' : 'disabled'); ?>-->
                            <!--                    />-->
                            <!--                </div>-->
                            <!--            </div>-->
                            <!--        </div>-->
                            <!--    </div>-->
                            <!--    <div class="col-md-1">-->
                            <!--        <div class="form-group">-->
                            <!--            <label class="text-capitalize"><?php echo app('translator')->get('admin.points'); ?></label>-->
                            <!--            <input type="number" max="1000000" class="form-control non_peak-switch" name="points_collection" value="<?php echo e(old('points_collection')); ?>"-->
                            <!--              <?php echo e((old('points_collection') == 1) ? '' : 'disabled'); ?>-->
                            <!--            />-->
                            <!--        </div>-->
                            <!--    </div>-->
                            <!--    <div class="col-md-2">-->
                            <!--        <div class="form-group">-->
                            <!--            <label class="text-capitalize"><?php echo app('translator')->get('admin.expire_in_days'); ?></label>-->
                            <!--            <input type="number" max="1000000" class="form-control non_peak-switch" name="expenses_expire_in_days" value="<?php echo e(old('expenses_expire_in_days')); ?>"-->
                            <!--              <?php echo e((old('expenses_expire_in_days') == 1) ? '' : 'disabled'); ?>-->
                            <!--            />-->
                            <!--            <?php if($errors->has('expenses_expire_in_days')): ?>-->
                            <!--                <label class="text-danger"><?php echo e($errors->first('expenses_expire_in_days')); ?></label>-->
                            <!--            <?php endif; ?>-->
                            <!--        </div>-->
                            <!--    </div>-->
                            <!--</div>-->
                            <!--<hr>-->
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                        </fieldset>
                        <div class="form-actions right" style="margin-bottom: 3%">
                            <button type="submit" class="btn btn-primary float-right">
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
  function switchDisabled (value , target) {
    if (value == 1) {
        $('.'+target).prop('disabled' , false)
        return
    }
      $('.'+target).prop('disabled' , true)
  }
  
  $(document).on('change','#application',function(){
    var app = this.value;
    if(app == 1){
        $('#country_div').show();
        $('#country_area_div').hide();
        $('#online_time_div').hide();
        $('#commission_paid_div').hide();
        
        // $('#referral_div').show();
        $('#trip_expenses_div').show();
    }else if(app == 2){
        $('#country_div').hide();
        $('#country_area_div').show();
        // $('#referral_div').hide();
        $('#trip_expenses_div').hide();
        
        $('#online_time_div').show();
        $('#commission_paid_div').show();
    }else{
        $('#country_div').hide();
        $('#country_area_div').hide();
        
        // $('#referral_div').hide();
        $('#trip_expenses_div').hide();
        
        $('#online_time_div').hide();
        $('#commission_paid_div').hide();
    }
  });
  
  $(document).ready(function(){
        // $('#referral_div').hide();
        $('#trip_expenses_div').hide();
        
        $('#online_time_div').hide();
        $('#commission_paid_div').hide();
  });
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('merchant.layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/msprojectsappori/public_html/multi-service-v3/resources/views/merchant/reward/create.blade.php ENDPATH**/ ?>