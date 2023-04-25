<?php $__env->startSection('content'); ?>
    <div class="page">
        <div class="page-content">
            <?php echo $__env->make('merchant.shared.errors-and-messages', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <div class="panel panel-bordered">
                <div class="panel-heading">
                    <div class="panel-actions">
                        <div class="btn-group float-right">
                            <a href="<?php echo e(route('merchant.brands')); ?>">
                                <button type="button" class="btn btn-icon btn-success" style="margin:10px"><i
                                            class="wb-reply"></i>
                                </button>
                            </a>
                            <?php if(!empty($info_setting) && $info_setting->add_text != ""): ?>
                                <button class="btn btn-icon btn-primary float-right" style="margin:10px"
                                        data-target="#examplePositionSidebar" data-toggle="modal" type="button">
                                    <i class="wb-info ml-1 mr-1" title="Info" style=""></i>
                                </button>
                            <?php endif; ?>
                        </div>
                    </div>
                    <h3 class="panel-title">
                        <i class=" fa fa-building" aria-hidden="true"></i>
                        <?php echo $data['title']; ?>

                    </h3>
                </div>
                <?php $id = isset($data['brand']['id']) ? $data['brand']['id'] : NULL; ?>
                <div class="panel-body container-fluid">
                    <?php echo Form::open(['name'=>'category','id'=>'category-form','files'=>true,'url'=>$data['save_url'],'method'=>'POST'] ); ?>

                    <?php echo $data['segment_html']; ?>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="banner_name">
                                    <?php echo app('translator')->get("$string_file.name"); ?>
                                    <span class="text-danger">*</span>
                                </label>
                                <?php echo Form::text('brand_name',old('brand_name',isset( $data['brand']['id']) ? $data['brand']->Name($data['brand']['merchant_id']) : NULL),['id'=>'','class'=>'form-control','required'=>true]); ?>

                                <?php if($errors->has('brand_name')): ?>
                                    <label class="text-danger"><?php echo e($errors->first('banner_name')); ?></label>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="status">
                                    <?php echo app('translator')->get("$string_file.status"); ?>
                                    <span class="text-danger">*</span>
                                </label>
                                <?php echo Form::select('status',$data['arr_status'],old('status',isset($data['brand']['status']) ? $data['brand']['status'] : NULL),['id'=>'','class'=>'form-control','required'=>true]); ?>

                                <?php if($errors->has('status')): ?>
                                    <label class="text-danger"><?php echo e($errors->first('status')); ?></label>
                                <?php endif; ?>
                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="sequence">
                                    <?php echo app('translator')->get("$string_file.sequence"); ?>
                                    <span class="text-danger">*</span>
                                </label>
                                <?php echo Form::number('sequence',old('sequence',isset($data['brand']['sequence']) ? $data['brand']['sequence'] : NULL),['id'=>'','class'=>'form-control','required'=>true]); ?>

                                <?php if($errors->has('sequence')): ?>
                                    <label class="text-danger"><?php echo e($errors->first('sequence')); ?></label>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group  ">
                                <label for="message26">
                                    <?php echo app('translator')->get("$string_file.image"); ?> (W:<?php echo e(Config('custom.image_size.category.width')); ?> *
                                    H:<?php echo e(Config('custom.image_size.category.height')); ?>)
                                </label>
                                <?php if(!empty($data['brand']['brand_image'])): ?>
                                    <a href="<?php echo e(get_image($data['brand']['brand_image'],'brand',$data['brand']['merchant_id'])); ?>"
                                       target="_blank"><?php echo app('translator')->get("$string_file.view"); ?></a>
                                <?php endif; ?>
                                <?php echo Form::file('brand_image',['id'=>'brand_image','class'=>'form-control']); ?>

                                <?php if($errors->has('brand_image')): ?>
                                    <label class="text-danger"><?php echo e($errors->first('brand_image')); ?></label>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="form-actions d-flex flex-row-reverse p-2">
                        <?php if($id == NULL || $edit_permission): ?>
                            <button type="submit" class="btn btn-primary">
                                <i class="fa fa-check-circle"></i><?php echo app('translator')->get("$string_file.save"); ?>
                            </button>
                        <?php else: ?>
                            <span style="color: red" class="float-right"><?php echo app('translator')->get("$string_file.demo_warning_message"); ?></span>
                        <?php endif; ?>
                    </div>
                    <?php echo Form::close(); ?>

                </div>
            </div>
        </div>
    </div>
    <?php echo $__env->make('merchant.shared.info-setting',['info_setting'=>$info_setting,'page_name'=>'add_text'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('merchant.layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/msprojectsappori/public_html/multi-service-v3/resources/views/merchant/brand/form.blade.php ENDPATH**/ ?>