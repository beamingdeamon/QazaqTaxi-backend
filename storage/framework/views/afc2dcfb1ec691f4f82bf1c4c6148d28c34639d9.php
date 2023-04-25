
<?php $__env->startSection('content'); ?>
    <div class="page">
        <div class="page-content">
            <?php echo $__env->make("merchant.shared.errors-and-messages", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <div class="panel panel-bordered">
                <header class="panel-heading">
                    <div class="mr--10 ml--10">
                        <div class="row " style="margin-right: 0rem;margin-left: 0rem" >
                            <div class="col-md-3 col-sm-3">
                                <h3 class="panel-title"><i class="wb-flag" aria-hidden="true"></i>
                                    <?php echo app('translator')->get("$string_file.all_drivers"); ?></h3>
                            </div>
                            <div class="col-sm-9 col-md-9">
                                <a href="<?php echo e(route('taxicompany.driver.add')); ?>">
                                    <button type="button" class="btn btn-icon btn-success float-right" style="margin:10px">
                                        <i class="wb-plus" title="<?php echo app('translator')->get("$string_file.add_driver"); ?>"></i>
                                    </button>
                                </a>
                                <a href="<?php echo e(route('taxicompany.driver.basics')); ?>">
                                    <button type="button" class="btn btn-icon btn-primary float-right" style="margin:10px">
                                        <?php echo app('translator')->get("$string_file.basic_signup_completed"); ?>
                                        <span class="badge badge-pill"><?php echo e($basicDriver); ?></span>
                                    </button>
                                </a>


















                            </div>
                        </div>
                    </div>
                </header>
                <div class="panel-body container-fluid">
                    <?php echo $search_view; ?>

                    <table id="customDataTable" class="display nowrap table table-hover table-striped w-full" style="width:100%">
                        <thead>
                        <tr>
                            <th> <?php echo app('translator')->get("$string_file.id"); ?></th>
                            <th><?php echo app('translator')->get("$string_file.service_area"); ?> </th>
                            <th><?php echo app('translator')->get("$string_file.driver_details"); ?></th>
                            <?php if($config->gender == 1): ?>
                                <th><?php echo app('translator')->get("$string_file.gender"); ?></th>
                            <?php endif; ?>

                            <th><?php echo app('translator')->get("$string_file.last_location_updated"); ?>  </th>
                            <th><?php echo app('translator')->get("$string_file.service_statistics"); ?></th>
                            <th><?php echo app('translator')->get("$string_file.referral_code"); ?></th>
                            <th><?php echo app('translator')->get("$string_file.transaction_amount"); ?></th>
                            <th><?php echo app('translator')->get("$string_file.registered_date"); ?></th>
                            <th><?php echo app('translator')->get("$string_file.status"); ?></th>
                            <th><?php echo app('translator')->get("$string_file.action"); ?></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $sr = $drivers->firstItem() ?>
                        <?php $__currentLoopData = $drivers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $driver): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><a href="<?php echo e(route('taxicompany.driver.show',$driver->id)); ?>"
                                       class="hyperLink"><?php echo e($driver->id); ?></a></td>
                                <td><?php echo e($driver->CountryArea->CountryAreaName); ?></td>
                                <?php if(Auth::user()->demo == 1): ?>
                                    <td>
                                                            <span class="long_text">
                                                                <?php echo e("********".substr($driver->last_name, -2)); ?><br>
                                                                <?php echo e("********".substr($driver->phoneNumber, -2)); ?> <br>
                                                                <?php echo e("********".substr($driver->email, -2)); ?>

                                                            </span>
                                    </td>
                                <?php else: ?>
                                    <td><span class="long_text">
                                                        <?php echo e($driver->first_name." ".$driver->last_name); ?><br>
                                                    <?php echo e($driver->phoneNumber); ?> <br>
                                                    <?php echo e($driver->email); ?>

                                                    </span>
                                    </td>
                                <?php endif; ?>
                                <?php if($config->gender == 1): ?>
                                    <?php switch($driver->driver_gender):
                                        case (1): ?>
                                        <td><?php echo app('translator')->get("$string_file.male"); ?></td>
                                        <?php break; ?>
                                        <?php case (2): ?>
                                        <td><?php echo app('translator')->get("$string_file.female"); ?></td>
                                        <?php break; ?>
                                        <?php default: ?>
                                        <td>------</td>
                                    <?php endswitch; ?>
                                <?php endif; ?>
                                <td>
                                    <?php if(!empty($driver->current_latitude)): ?>
                                        <?php $last_location_update_time = convertTimeToUSERzone($driver->last_location_update_time, $driver->CountryArea->timezone, null, $driver->Merchant); ?>
                                        <a class="map_address hyperLink " target="_blank"
                                           href="https://www.google.com/maps/place/<?php echo e($driver->current_latitude); ?>,<?php echo e($driver->current_longitude); ?>">
                                            <?php echo $last_location_update_time; ?>

                                        </a>
                                    <?php else: ?>
                                        ----------
                                    <?php endif; ?>

                                </td>
                                <td>
                                    <?php if($driver->total_trips): ?>
                                        <?php echo e($driver->total_trips); ?>  <?php echo app('translator')->get("$string_file.ride"); ?>
                                    <?php else: ?>
                                        <?php echo app('translator')->get("$string_file.no_ride"); ?>
                                    <?php endif; ?>
                                    <br>
                                    <?php if($driver->rating == "0.0"): ?>
                                        <?php echo app('translator')->get("$string_file.not_rated_yet"); ?>
                                    <?php else: ?>
                                        <?php while($driver->rating>0): ?>
                                            <?php if($driver->rating >0.5): ?>
                                                <img src="<?php echo e(asset("star.png")); ?>"
                                                     alt='Whole Star'>
                                            <?php else: ?>
                                                <img src="<?php echo e(asset('halfstar.png')); ?>"
                                                     alt='Half Star'>
                                            <?php endif; ?>
                                            <?php $driver->rating--; ?>
                                        <?php endwhile; ?>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php if($driver->total_earnings): ?>
                                        <?php echo e($driver->CountryArea->Country->isoCode." ".number_format($driver->total_earnings,2)); ?>

                                    <?php else: ?>
                                        <?php echo app('translator')->get("$string_file.no_ride"); ?>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php if($driver->total_comany_earning): ?>
                                        <?php echo e($driver->total_comany_earning); ?>

                                    <?php else: ?>
                                        <?php echo app('translator')->get("$string_file.no_ride"); ?>
                                    <?php endif; ?>
                                </td>
                                <?php if($config->driver_wallet_status == 1): ?>
                                    <td>
                                        <?php if($driver->wallet_money): ?>
                                            <a href="<?php echo e(route('merchant.driver.wallet.show',$driver->id)); ?>"><?php echo e($driver->wallet_money); ?></a>
                                        <?php else: ?>
                                            ------
                                        <?php endif; ?>

                                    </td>
                                <?php endif; ?>
                                <td>
                                    <?php echo convertTimeToUSERzone($driver->created_at, $driver->CountryArea->timezone,null,$driver->Merchant); ?>

                                </td>
                                <td>
                                    <?php if($driver->driver_admin_status == 1): ?>
                                        <?php if($driver->login_logout == 1): ?>
                                            <?php if($driver->online_offline == 1): ?>
                                                <?php if($driver->free_busy == 1): ?>
                                                    <span class="badge badge-info"><?php echo app('translator')->get("$string_file.busy"); ?></span>
                                                <?php else: ?>
                                                    <span class="badge badge-success"><?php echo app('translator')->get("$string_file.free"); ?></span>
                                                <?php endif; ?>
                                            <?php else: ?>
                                                <span class="badge badge-info"><?php echo app('translator')->get("$string_file.offline"); ?></span>
                                            <?php endif; ?>
                                        <?php else: ?>
                                            <span class="badge badge-warning"><?php echo app('translator')->get("$string_file.logout"); ?></span>
                                        <?php endif; ?>
                                    <?php else: ?>
                                        <span class="badge badge-danger"><?php echo app('translator')->get("$string_file.inactive"); ?></span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <div class="button-margin" >
                                        <a href="<?php echo e(route('taxicompany.driver.add',$driver->id)); ?>"
                                           data-original-title="<?php echo app('translator')->get("$string_file.edit"); ?>" data-toggle="tooltip"
                                           data-placement="top"
                                           class="btn btn-sm btn-primary menu-icon btn_edit action_btn"> <i
                                                    class="fa fa-edit"></i> </a>
                                        <span data-target="#sendNotificationModel"
                                              data-toggle="modal" id="<?php echo e($driver->id); ?>"><a
                                                    data-original-title="<?php echo app('translator')->get("$string_file.send_notification"); ?>"
                                                    data-toggle="tooltip"
                                                    id="<?php echo e($driver->id); ?>" data-placement="top"
                                                    class="btn  text-white btn-sm btn-warning menu-icon btn_eye action_btn"> <i
                                                        class="fa fa-bell"></i> </a></span>
                                        <a href="<?php echo e(route('taxicompany.driver.show',$driver->id)); ?>"
                                           class="btn btn-sm btn-info menu-icon btn_detail action_btn"><span
                                                    class="fa fa-user"
                                                    title="View Driver Profile"></span></a>

                                        <a href="<?php echo e(route('taxicompany.driver-vehicle',$driver->id)); ?>"
                                           class="btn btn-sm btn-warning menu-icon btn_edit action_btn"><span
                                                    class="fa fa-car"
                                                    title="View Driver Vehicles"></span></a>
                                    </div><div>
                                        <?php if($driver->driver_admin_status == 1): ?>
                                            <a href="<?php echo e(route('taxicompany.driver.active.deactive',['id'=>$driver->id,'status'=>2])); ?>"
                                               data-original-title="<?php echo app('translator')->get("$string_file.inactive"); ?>"
                                               data-toggle="tooltip" data-placement="top"
                                               class="btn btn-sm btn-danger menu-icon btn_eye_dis action_btn"> <i
                                                        class="fa fa-eye-slash"></i> </a>
                                        <?php else: ?>
                                            <a href="<?php echo e(route('taxicompany.driver.active.deactive',['id'=>$driver->id,'status'=>1])); ?>"
                                               data-original-title="<?php echo app('translator')->get("$string_file.active"); ?>"
                                               data-toggle="tooltip" data-placement="top"
                                               class="btn btn-sm btn-success menu-icon btn_eye action_btn"> <i
                                                        class="fa fa-eye"></i>
                                            </a>
                                        <?php endif; ?>
                                        <?php if($driver->login_logout == 1): ?>
                                            <a href="<?php echo e(route('merchant.driver.logout',$driver->id)); ?>"
                                               data-original-title="Logout"
                                               data-toggle="tooltip" data-placement="top"
                                               class="btn btn-sm btn-secondary menu-icon btn_delete action_btn"> <i
                                                        class="fa fa-sign-out-alt"></i>
                                            </a>
                                        <?php endif; ?>
                                        <button onclick="DeleteEvent(<?php echo e($driver->id); ?>)" type="submit"
                                                data-original-title="<?php echo app('translator')->get("$string_file.delete"); ?>"
                                                data-toggle="tooltip"
                                                data-placement="top"
                                                class="btn btn-sm btn-danger menu-icon btn_delete action_btn"><i
                                                    class="fa fa-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <?php $sr++; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                    <div class="pagination1 float-right"><?php echo e($drivers->links()); ?></div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade text-left" id="sendNotificationModel" tabindex="-1" role="dialog"
         aria-labelledby="myModalLabel33"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <label class="modal-title text-text-bold-600" id="myModalLabel33"><b><?php echo app('translator')->get("$string_file.send_notification_to_driver"); ?></b></label>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="<?php echo e(route('taxicompany.sendsingle-driver')); ?>" method="post" enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>
                    <div class="modal-body">
                        <label><?php echo app('translator')->get("$string_file.title"); ?>: </label>
                        <div class="form-group">
                            <input type="text" class="form-control" id="title"
                                   name="title"
                                   placeholder="<?php echo app('translator')->get("$string_file.title"); ?>" required>
                        </div>
                        <label><?php echo app('translator')->get("$string_file.message"); ?>: </label>
                        <div class="form-group">
                           <textarea class="form-control" id="message" name="message"
                                     rows="3"
                                     placeholder="<?php echo app('translator')->get("$string_file.message"); ?>"></textarea>
                        </div>
                        <label><?php echo app('translator')->get("$string_file.image"); ?>: </label>
                        <div class="form-group">
                            <input type="file" class="form-control" id="image"
                                   name="image"
                                   placeholder="<?php echo app('translator')->get("$string_file.image"); ?>">
                            <input type="hidden" name="persion_id" id="persion_id">
                        </div>
                        <label><?php echo app('translator')->get("$string_file.show_in_promotion"); ?>: </label>
                        <div class="form-group">
                            <input type="checkbox" value="1" name="expery_check"
                                   id="expery_check_two">
                        </div>
                        <label><?php echo app('translator')->get("$string_file.expire_date"); ?>:</label>
                        <div class="form-group">
                            <input type="text" class="form-control datepicker"
                                   id="datepicker-backend" name="date"
                                   placeholder="" disabled readonly>
                        </div>
                        <label><?php echo app('translator')->get("$string_file.url"); ?>: </label>
                        <div class="form-group">
                            <input type="url" class="form-control" id="url"
                                   name="url"
                                   placeholder="<?php echo app('translator')->get("$string_file.url"); ?>(<?php echo app('translator')->get("$string_file.optional"); ?>)">
                            <label class="danger"><?php echo app('translator')->get("$string_file.example"); ?> :  https://www.google.com/</label>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="reset" class="btn btn-outline-secondary btn-lg" data-dismiss="modal" value="<?php echo app('translator')->get("$string_file.close"); ?>">
                        <input type="submit" class="btn btn-outline-primary btn-lg" value="<?php echo app('translator')->get("$string_file.send"); ?>">
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade text-left" id="addMoneyModel" tabindex="-1" role="dialog" aria-labelledby="myModalLabel33"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <label class="modal-title text-text-bold-600" id="myModalLabel33"><b><?php echo app('translator')->get("$string_file.add_money_in_driver_wallet"); ?></b></label>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="<?php echo e(route('merchant.AddMoney')); ?>" method="post">
                    <?php echo csrf_field(); ?>
                    <div class="modal-body">
                        <label><?php echo app('translator')->get("$string_file.payment_method"); ?>: </label>
                        <div class="form-group">
                            <select class="form-control" name="payment_method" id="payment_method" required>
                                <option value="1"><?php echo app('translator')->get("$string_file.cash"); ?></option>
                                <option value="2"><?php echo app('translator')->get("$string_file.non_cash"); ?></option>
                            </select>
                        </div>
                        <label><?php echo app('translator')->get("$string_file.receipt_number"); ?>: </label>
                        <div class="form-group">
                            <input type="text" name="receipt_number" id="receipt_number" placeholder="<?php echo app('translator')->get("$string_file.receipt_number"); ?>"
                                   class="form-control" required>
                        </div>
                        <label><?php echo app('translator')->get("$string_file.amount"); ?>: </label>
                        <div class="form-group">
                            <input type="number" name="amount" id="amount" placeholder="<?php echo app('translator')->get("$string_file.amount"); ?>"
                                   class="form-control" required min="1">
                            <input type="hidden" name="add_money_driver_id" id="add_money_driver_id">
                        </div>
                        <label><?php echo app('translator')->get("$string_file.description"); ?>: </label>
                        <div class="form-group">
                            <textarea class="form-control" id="title1" rows="3" name="description"
                                      placeholder="<?php echo app('translator')->get("$string_file.description"); ?>"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="reset" class="btn btn-outline-secondary btn-lg" data-dismiss="modal" value="<?php echo app('translator')->get("$string_file.close"); ?>">
                        <input type="submit" class="btn btn-outline-primary btn-lg" value="<?php echo app('translator')->get("$string_file.add"); ?>">
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('js'); ?>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script>
        function show() {
            if (document.getElementById("expery_check_two").checked = true) {
                document.getElementById('datepicker-backend').disabled = false;
            }
        }

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
                        type: "POST",
                        data:{
                            id: id,
                        },
                        url: "<?php echo e(route('taxicompany.drivers.delete')); ?>",
                    }).done(function (data) {
                        swal({
                            title: "DELETED!",
                            text: data,
                            type: "success",
                        });
                        window.location.href = "<?php echo e(route('taxicompany.driver.index')); ?>";
                    });
                } else {
                    swal("<?php echo app('translator')->get("$string_file.data_is_safe"); ?>");
                }
            });
        }
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('taxicompany.layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/qazaq/public_html/admin.qazaq.taxi/ms-v3/resources/views/taxicompany/driver/index.blade.php ENDPATH**/ ?>