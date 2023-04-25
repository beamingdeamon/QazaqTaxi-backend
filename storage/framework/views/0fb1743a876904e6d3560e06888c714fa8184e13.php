<?php $__env->startSection('content'); ?>
    <?php
        $arr_commission_payout =  get_commission_type();
        $arr_cal_method =  get_commission_method($string_file);
        $arr_yes_no = add_blank_option(get_status(),trans("$string_file.select"));
   $id = null;
   $disabled = false;

   if(!empty($price_card->id) && isset($price_card->id))
    {
     $id =  $price_card->id;
     $disabled = true;
    }
    $commission_type = NULL;
    if(isset($price_card->PriceCardCommission->commission_type))
    {
     $commission_type = $price_card->PriceCardCommission->commission_type;
    }
    ?>
    <div class="page">
        <div class="page-content">
            <?php echo $__env->make('merchant.shared.errors-and-messages', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <div class="panel panel-bordered">
                <header class="panel-heading">
                    <div class="panel-actions">
                        <?php if(Auth::user('merchant')->can('create_price_card')): ?>
                            <div class="btn-group float-md-right">
                                <a href="<?php echo e(route('carpooling.price_card')); ?>">
                                    <button type="button" class="btn btn-icon btn-success mr-1" style="margin:10px  "><i
                                                class="wb-reply"></i></button>
                                </a>
                            </div>
                        <?php endif; ?>
                    </div>
                    <h3 class="panel-title">
                        <i class="icon wb-plus" aria-hidden="true"></i>
                        <?php echo app('translator')->get("$string_file.add"); ?> <?php echo app('translator')->get("$string_file.price_card"); ?></h3>
                </header>
                <div class="panel-body container-fluid">
                    <?php echo Form::open(['name'=>"",'class'=>"steps-validation wizard-notification","url"=>route('carpooling.price_card.save',$id)]); ?>


                    <?php echo Form::hidden('id',$id,['class'=>'form-control','id'=>'id']); ?>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="emailAddress5"><?php echo app('translator')->get("$string_file.price_card"); ?> <?php echo app('translator')->get("$string_file.name"); ?><span
                                            class="text-danger">*</span></label>
                                <?php echo Form::text('price_card_name',old('price_card_name',isset($price_card->price_card_name)? $price_card->price_card_name : NULL),['class'=>'form-control','id'=>'price_card_name','placeholder'=>"",'required'=>true]); ?>

                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="firstName3">
                                    <?php echo app('translator')->get("$string_file.service"); ?> <?php echo app('translator')->get("$string_file.area"); ?><span class="text-danger">*</span>
                                </label>
                                <?php if(empty($id)): ?>
                                    <?php echo Form::select('country_area_id',$areas,old('country_area_id'),["class"=>"form-control","id"=>"area","required"=>true]); ?>

                                    <?php if($errors->has('country_area_id')): ?>
                                        <label class="text-danger"><?php echo e($errors->first('country_area_id')); ?></label>
                                    <?php endif; ?>
                                <?php else: ?>
                                    <?php echo Form::text('country_area_id',isset($price_card->CountryArea->CountryAreaName) ? $price_card->CountryArea->CountryAreaName : NULL,['class'=>'form-control','id'=>'area','disabled'=>$disabled]); ?>

                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="distance_charges"><?php echo app('translator')->get("$string_file.distance"); ?> <?php echo app('translator')->get("$string_file.charges"); ?><span
                                            class="text-danger">*</span></label>
                                <?php echo Form::number('distance_charges',old('distance_charges',isset($price_card->distance_charges)? $price_card->distance_charges : NULL),['class'=>'form-control','id'=>'distance_charges','placeholder'=>trans("$string_file.per_km_mile"),'required'=>true, 'min'=>'0','step'=>'.01']); ?>

                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="service_charge"><?php echo app('translator')->get("$string_file.service"); ?> <?php echo app('translator')->get("$string_file.charges"); ?></label>
                                <?php echo Form::number('service_charges',old('service_charges',isset($price_card->service_charges)? $price_card->service_charges : NULL),['class'=>'form-control','id'=>'service_charges','placeholder'=>"",'min'=>'0','step'=>'.01']); ?>

                            </div>
                        </div>
                    </div>
                    <?php if($merchant->cancel_charges == 1): ?>
                        <h5 class="form-section col-md-12" style="color: black"><i
                                    class="fa fa-paperclip"></i> <?php echo app('translator')->get("$string_file.cancel"); ?> <?php echo app('translator')->get("$string_file.charges"); ?>
                        </h5>
                        <hr>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="emailAddress5"><?php echo app('translator')->get("$string_file.cancel"); ?> <?php echo app('translator')->get("$string_file.charges"); ?><span
                                                class="text-danger">*</span></label>
                                    <?php echo Form::select('cancel_charges',$arr_yes_no,old('cancel_charges',isset($price_card->cancel_charges) ? $price_card->cancel_charges :NULL),['class'=>'form-control','required'=>true,'id'=>'cancel_charges']); ?>

                                    <?php if($errors->has('cancel_charges')): ?>
                                        <label class="text-danger"><?php echo e($errors->first('cancel_charges')); ?></label>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="col-md-4" id="cancel_first">
                                <div class="form-group">
                                    <label for="emailAddress5">
                                        <?php echo app('translator')->get("$string_file.cancel"); ?> <?php echo app('translator')->get("$string_file.time"); ?>
                                        <span class="text-danger">*</span>
                                    </label><?php echo Form::number('cancel_time',old('cancel_time',isset($price_card->cancel_time) ? $price_card->cancel_time :NULL),['class'=>'form-control','id'=>'cancel_time','placeholder'=>"","min"=>"0"]); ?>

                                </div>
                            </div>
                            <div class="col-md-4" id="cancel_second">
                                <div class="form-group">
                                    <label for="emailAddress5"><?php echo app('translator')->get("$string_file.cancel"); ?> <?php echo app('translator')->get("$string_file.amount"); ?><span
                                                class="text-danger">*</span></label>
                                    <?php echo Form::number('cancel_amount',old('cancel_amount',isset($price_card->cancel_amount) ? $price_card->cancel_amount :NULL),['class'=>'form-control','id'=>'cancel_amount','placeholder'=>"","min"=>"0", "step"=>"0.01"]); ?>

                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                    <h5 class="form-section col-md-12" style="color: black"><i
                                class="fa fa-paperclip"></i> <?php echo app('translator')->get("$string_file.commission"); ?> <?php echo app('translator')->get("$string_file.from"); ?> <?php echo app('translator')->get("$string_file.user"); ?>
                    </h5>
                    <hr>
                    <div class="row">

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="emailAddress5"><?php echo app('translator')->get("$string_file.commission"); ?> <?php echo app('translator')->get("$string_file.method"); ?><span
                                            class="text-danger">*</span>
                                </label>
                                <?php echo Form::select('commission_method',add_blank_option($arr_cal_method,trans("$string_file.select")),old('commission_method',isset($price_card->PriceCardCommission->commission_method) ? $price_card->PriceCardCommission->commission_method : NULL),["class"=>"form-control","id"=>"commission_method","required"=>true]); ?>

                                <?php if($errors->has('commission_method')): ?>
                                    <label class="text-danger"><?php echo e($errors->first('commission_method')); ?></label>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="commission">
                                    <?php echo app('translator')->get("$string_file.commission"); ?> <?php echo app('translator')->get("$string_file.value"); ?><span class="text-danger">*</span>
                                </label>
                                <?php echo Form::number("commission",old("commission",isset($price_card->PriceCardCommission->commission) ? $price_card->PriceCardCommission->commission : NULL),["step"=>"0.01", "min"=>"0","class"=>"form-control", "id"=>"commission","placeholder"=>"","required"=>true]); ?>

                                <?php if($errors->has('commission_method')): ?>
                                    <label class="text-danger"><?php echo e($errors->first('commission_method')); ?></label>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="form-actions right" style="margin-bottom: 3%">
                        <button type="submit" class="btn btn-primary float-right">
                            <i class="fa fa-check-circle"></i> <?php echo app('translator')->get('$string_file.save'); ?>
                        </button>
                    </div>
                    <?php echo Form::close(); ?>

                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('merchant.layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/msprojectsappori/public_html/multi-service-v3/resources/views/merchant/carpooling-pricecard/form.blade.php ENDPATH**/ ?>