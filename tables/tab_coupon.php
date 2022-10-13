<?php
require_once '../load_model.php';
$coupon= new BeanCoupon();
$datas=$coupon->select_all();
?>
<div class="white-box">
                            <h3 class="box-title m-b-0">Coupons</h3>
                            <p id="nouveau"><a href="javascript:void(0)" class="btn btn-primary btn-rounded" id="new_coupon"> <i class="fa fa-plus"></i> Nouveau</a>
<a href="javascript:void(0)" class="btn btn-warning btn-rounded" id="trash_coupon"> <i class="fa fa-trash"></i> Corbeille</a>
                            </p>
                            <div class="table-responsive">
               <table id="example2" class="table table-bordered table-striped table-condensed display" cellspacing="0" width="100%">
               <thead>
                                        <tr>
                                            <th>Coupon</th>><th>&nbsp;</th><th>&nbsp;</th>
                                        </tr>
               </thead>


                                    <tbody>
                  <?php
                                    foreach ($datas as $un) {
                            if($un['status']==$_POST['status'])
                            {
                            echo '<tr><td>'.$un['coupon_name'].'</td><td>';

                            echo '<button class="btn btn-warning btn-circle update_coupon" id="'.$un['coupon_id'].'"><i class="fa fa-edit"></i></button>';

                             echo '</td><td>';

                            if($un['status']=='1')
                             {
                            echo '<button class="btn btn-danger btn-circle delete_coupon" id="'.$un['coupon_id'].'" data-id="0"><i class="fa fa-times"></i></button>';
                                }
                                else
                                {
                                echo '<button class="btn btn-success btn-circle delete_coupon" id="'.$un['coupon_id'].'" data-id="1"><i class="fa fa-refresh"></i></button>';
                                }

                             echo '</td></tr>';
                           }
                                    }
                                    ?>
                    </tbody>
               </table>
              </div>
</div>
