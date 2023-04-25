<?php $__env->startSection('content'); ?>
    <div class="page">
        <div class="page-content">
            <?php echo $__env->make('merchant.shared.errors-and-messages', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <div class="panel panel-bordered">
                <div class="panel-heading">
                    <div class="panel-actions">
                        
                            
                                
                                            
                                
                            
                        
                    </div>
                    <h3 class="panel-title">
                        <i class=" fa fa-building" aria-hidden="true"></i>
                        <?php echo $data['title']; ?>

                    </h3>
                </div>
                <?php $id = isset($data['brand']['id']) ? $data['brand']['id'] : NULL; ?>
                <div class="panel-body container-fluid">
                    <?php echo Form::open(['name'=>'home_screen_design','id'=>'home_screen_design','files'=>true,'url'=>$data['save_url'],'method'=>'POST'] ); ?>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="status">
                                    <?php echo app('translator')->get("$string_file.top_seller"); ?> <?php echo app('translator')->get("$string_file.product"); ?>
                                    <span class="text-danger">*</span>
                                </label>
                                <?php echo Form::select('top_seller_products[]',$product_list,old('top_seller_products', $top_seller_products),['id'=>'','class'=>'form-control', 'multiple' => true, 'required'=>true]); ?>

                                <?php if($errors->has('top_seller_products')): ?>
                                    <label class="text-danger"><?php echo e($errors->first('top_seller_products')); ?></label>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="status">
                                    <?php echo app('translator')->get("$string_file.top_brands"); ?>
                                    <span class="text-danger">*</span>
                                </label>
                                <?php echo Form::select('top_brands[]',$brand_list,old('top_brands',$top_brand_list),['id'=>'','class'=>'form-control', 'multiple' => true, 'required'=>true]); ?>

                                <?php if($errors->has('top_brands')): ?>
                                    <label class="text-danger"><?php echo e($errors->first('top_brands')); ?></label>
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
<?php $__env->stopSection(); ?>

<?php echo $__env->make('merchant.layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/msprojectsappori/public_html/multi-service-v3/resources/views/merchant/home_screen_design_config/index.blade.php ENDPATH**/ ?>