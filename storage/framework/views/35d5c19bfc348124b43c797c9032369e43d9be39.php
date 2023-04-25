
<?php $__env->startSection('content'); ?>
    <div class="page">
        <div class="page-content">
            <?php if(session('moneyAdded')): ?>
                <div class="alert dark alert-icon alert-info alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                    <i class="icon wb-info" aria-hidden="true"></i><?php echo app('translator')->get('admin.message430'); ?>
                </div>
            <?php endif; ?>
            <div class="panel panel-bordered">
                <header class="panel-heading">
                    <div class="panel-actions">
                        <a href="<?php echo e(route('excel.user')); ?>">
                            <button type="button" class="btn btn-icon btn-primary float-right" style="margin:10px">
                                <i class="wb-download" title="<?php echo app('translator')->get("$string_file.export_excel"); ?>"></i>
                            </button>
                        </a>
                        <a href="<?php echo e(route('taxicompany.users.create')); ?>">
                            <button type="button" class="btn btn-icon btn-success float-right" style="margin:10px">
                                <i class="wb-plus" title="<?php echo app('translator')->get("$string_file.add_user"); ?>"></i>
                            </button>
                        </a>
                    </div>
                    <h3 class="panel-title"><i class="wb-flag" aria-hidden="true"></i>
                       <?php echo app('translator')->get("$string_file.user_management"); ?></h3>
                </header>
                <div class="panel-body container-fluid">
                    <form action="<?php echo e(route('users.search')); ?>" method="post">
                        <?php echo csrf_field(); ?>
                        <div class="table_search row p-3">
                            <div class="col-md-2 col-xs-6 active-margin-top"><?php echo app('translator')->get("$string_file.search_by"); ?> :</div>
                            <div class="col-md-2 col-xs-12 form-group active-margin-top">
                                <div class="input-group">
                                    <select class="form-control" name="parameter"
                                            id="parameter"
                                            required>
                                        <option value="1"><?php echo app('translator')->get("$string_file.name"); ?></option>
                                        <option value="2"><?php echo app('translator')->get("$string_file.email"); ?></option>
                                        <option value="3"><?php echo app('translator')->get("$string_file.phone"); ?></option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-2 col-xs-12 form-group active-margin-top">
                                <div class="input-group">
                                    <input type="text" name="keyword"
                                           placeholder="<?php echo app('translator')->get("$string_file.enter_text"); ?>"
                                           class="form-control col-md-12 col-xs-12">
                                </div>
                            </div>
                            <div class="col-md-2 col-xs-6 form-group active-margin-top">
                                <button class="btn btn-primary" type="submit"><i class="fa fa-search" aria-hidden="true"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                    <table id="customDataTable" class="display nowrap table table-hover table-striped w-full" style="width:100%">
                        <thead>
                        <tr>
                            <th><?php echo app('translator')->get("$string_file.sn"); ?></th>
                            <th><?php echo app('translator')->get("$string_file.user_details"); ?></th>
                            <th><?php echo app('translator')->get("$string_file.gender"); ?></th>
                            <th><?php echo app('translator')->get("$string_file.service_statistics"); ?></th>
                            <th><?php echo app('translator')->get("$string_file.wallet_money"); ?></th>
                            <th><?php echo app('translator')->get("$string_file.referral_code"); ?></th>
                            <th><?php echo app('translator')->get("$string_file.signup_details"); ?></th>
                            <th><?php echo app('translator')->get("$string_file.registered_date"); ?></th>
                            <th><?php echo app('translator')->get("$string_file.status"); ?></th>
                            <th><?php echo app('translator')->get("$string_file.action"); ?></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $sr = $users->firstItem() ?>
                        <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($sr); ?> </td>
                                <td>
                                    <span class="long_text">   <?php echo nl2br($user->first_name." ".$user->last_name."\n".$user->UserPhone."\n".$user->email); ?></span>
                                </td>
                                <?php switch($user->user_gender):
                                    case (1): ?>
                                    <td><?php echo app('translator')->get("$string_file.male"); ?></td>
                                    <?php break; ?>
                                    <?php case (2): ?>
                                    <td><?php echo app('translator')->get("$string_file.female"); ?></td>
                                    <?php break; ?>
                                    <?php default: ?>
                                    <td>------</td>
                                <?php endswitch; ?>
                                <td>
                                    <?php if($user->total_trips): ?>
                                        <?php echo e($user->total_trips); ?>  <?php echo app('translator')->get("$string_file.rides"); ?>
                                    <?php else: ?>
                                        <?php echo app('translator')->get("$string_file.no_ride"); ?>
                                    <?php endif; ?>
                                    <br>
                                    <?php if($user->rating == "0.0"): ?>
                                        <?php echo app('translator')->get("$string_file.not_rated_yet"); ?>
                                    <?php else: ?>
                                        <?php while($user->rating>0): ?>
                                            <?php if($user->rating >0.5): ?>
                                                <img src="<?php echo e(view_config_image("static-images/star.png")); ?>"
                                                     alt='Whole Star'>
                                            <?php else: ?>
                                                <img src="<?php echo e(view_config_image('static-images/halfstar.png')); ?>"
                                                     alt='Half Star'>
                                            <?php endif; ?>
                                            <?php $user->rating--; ?>
                                        <?php endwhile; ?>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php if($user->wallet_balance): ?>
                                        <?php echo e($user->wallet_balance); ?>

                                    <?php else: ?>
                                        0.00
                                    <?php endif; ?>
                                </td>
                                <td><?php echo e($user->ReferralCode); ?></td>
                                <td>
                                    <?php if($user->user_type == 1): ?>
                                        <?php echo app('translator')->get("$string_file.corporate_user"); ?>
                                    <?php else: ?>
                                        <?php echo app('translator')->get("$string_file.retail"); ?>
                                    <?php endif; ?>
                                    <br>
                                    <?php switch($user->UserSignupType):
                                        case (1): ?>
                                        <?php echo app('translator')->get("$string_file.normal"); ?>
                                        <?php break; ?>
                                        <?php case (2): ?>
                                        <?php echo app('translator')->get("$string_file.google"); ?>
                                        <?php break; ?>
                                        <?php case (3): ?>
                                        <?php echo app('translator')->get("$string_file.facebook"); ?>
                                        <?php break; ?>
                                    <?php endswitch; ?>
                                    <br>
                                    <?php switch($user->UserSignupFrom):
                                        case (1): ?>
                                        <?php echo app('translator')->get("$string_file.application"); ?>
                                        <?php break; ?>
                                        <?php case (2): ?>
                                        <?php echo app('translator')->get("$string_file.admin"); ?>
                                        <?php break; ?>
                                        <?php case (3): ?>
                                        <?php echo app('translator')->get("$string_file.web"); ?>
                                        <?php break; ?>
                                    <?php endswitch; ?>
                                </td>
                                <td>
                                    <?php echo convertTimeToUSERzone($user->created_at, null,null,$user->Merchant,2); ?>

                                </td>
                                <td>
                                    <?php if($user->UserStatus == 1): ?>
                                        <span class="badge badge-success"><?php echo app('translator')->get("$string_file.active"); ?></span>
                                    <?php else: ?>
                                        <span class="badge badge-danger"><?php echo app('translator')->get("$string_file.inactive"); ?></span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php if($config->user_wallet_status == 1): ?>
                                        <span data-target="#addMoneyModel"
                                              data-toggle="modal" id="<?php echo e($user->id); ?>"><a
                                                    data-original-title="<?php echo app('translator')->get("$string_file.add_money"); ?>"
                                                    data-toggle="tooltip"
                                                    id="<?php echo e($user->id); ?>" data-placement="top"
                                                    class="btn text-white btn-sm btn-success menu-icon btn_detail action_btn"> <i
                                                        class="fa fa-money"></i> </a></span>
                                        <a href="<?php echo e(route('taxicompany.user.wallet',$user->id)); ?>"
                                           data-original-title="Wallet Transactions"
                                           data-toggle="tooltip"
                                           data-placement="top"
                                           class="btn btn-sm btn-secondary menu-icon btn_money action_btn">
                                            <i class="fa fa-window-maximize"></i> </a>
                                    <?php endif; ?>
                                    <button onclick="DeleteEvent(<?php echo e($user->id); ?>)"
                                            type="submit"
                                            data-original-title="<?php echo app('translator')->get("$string_file.delete"); ?>"
                                            data-toggle="tooltip"
                                            data-placement="top"
                                            class="btn btn-sm btn-danger menu-icon btn_delete action_btn">
                                        <i class="fa fa-trash"></i></button>
                                    <button type="submit"
                                            data-original-title="<?php echo app('translator')->get("$string_file.edit"); ?>"
                                            data-toggle="tooltip"
                                            data-placement="top"
                                            class="btn btn-sm btn-warning menu-icon btn_delete action_btn">
                                        <a href="<?php echo e(route('taxicompany.users.edit',$user->id)); ?>"
                                           style="color: white">
                                            <i class="fa fa-edit"></i></a></button>
                                    <a href="<?php echo e(route('taxicompany.users.show',$user->id)); ?>"
                                       class="btn btn-sm btn-info menu-icon btn_delete action_btn"
                                       data-original-title="<?php echo app('translator')->get("$string_file.details"); ?>"
                                       data-toggle="tooltip"
                                       data-placement="top"><span
                                                class="fa fa-user"></span></a>
                                </td>
                            </tr>
                            <?php $sr++  ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                    <div class="pagination1 float-right"><?php echo e($users->links()); ?></div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade text-left" id="addMoneyModel" tabindex="-1" role="dialog" aria-labelledby="myModalLabel33"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <label class="modal-title text-text-bold-600" id="myModalLabel33"><b><?php echo app('translator')->get("$string_file.add_money_in_wallet"); ?></b></label>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="<?php echo e(route('taxicompany.user.add.wallet')); ?>" method="post">
                    <?php echo csrf_field(); ?>
                    <div class="modal-body">
                        <label><?php echo app('translator')->get("$string_file.payment_method"); ?> </label>
                        <div class="form-group">
                            <select class="form-control" name="payment_method" id="payment_method" required>
                                <option value="1"><?php echo app('translator')->get("$string_file.cash"); ?></option>
                                <option value="2"><?php echo app('translator')->get("$string_file.non_cash"); ?></option>
                            </select>
                        </div>

                        <label><?php echo app('translator')->get("$string_file.amount"); ?> </label>
                        <div class="form-group">
                            <input type="text" name="amount" placeholder="<?php echo app('translator')->get('admin.message164'); ?>"
                                   class="form-control" required>
                            <input type="hidden" name="add_money_user_id" id="add_money_driver_id">
                        </div>

                        <label><?php echo app('translator')->get("$string_file.receipt_number"); ?> </label>
                        <div class="form-group">
                            <input type="text" name="receipt_number" placeholder="<?php echo app('translator')->get('admin.message630'); ?>"
                                   class="form-control" required>
                        </div>
                        <label><?php echo app('translator')->get("$string_file.description"); ?> </label>
                        <div class="form-group">
                            <textarea class="form-control" id="title1" rows="3" name="description"
                                      placeholder="<?php echo app('translator')->get('admin.message632'); ?>"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="reset" class="btn btn-secondary" data-dismiss="modal" value="<?php echo app('translator')->get("$string_file.close"); ?>">
                        <input type="submit" id="sub" class="btn btn-primary" value="<?php echo app('translator')->get("$string_file.add"); ?>">
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('js'); ?>
    
    
    
    
    
    
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script>
        function DeleteEvent(id) {
            var token = $('[name="_token"]').val();
            swal({
                title: "<?php echo app('translator')->get("$string_file.are_you_sure"); ?>",
                text: "<?php echo app('translator')->get("$string_file.delete_warning"); ?>",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            }).then((isConfirm) => {
                if (isConfirm) {
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': token
                        },
                        type: "DELETE",
                        url: 'users/' + id,
                    }).done(function (data) {
                        swal({
                            title: "DELETED!",
                            text: data,
                            type: "success",
                        });
                        window.location.href = "<?php echo e(route('taxicompany.users.index')); ?>";
                    });
                } else {
                    swal("<?php echo app('translator')->get("$string_file.data_is_safe"); ?>");
                }
            });
        }
    </script>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('taxicompany.layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/qazaq/public_html/admin.qazaq.taxi/ms-v3/resources/views/taxicompany/user/index.blade.php ENDPATH**/ ?>