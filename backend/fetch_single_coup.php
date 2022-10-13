<?php

require_once '../load_model.php';
$coupon = new BeanCoupon();
$coupon->select($_POST["coupon_id"]);

$output = array();
if(isset($_POST["coupon_id"]))
{
  $output["coupon_name"] = $coupon->getCouponName();
}
$output['id'] = $_POST["coupon_id"];

echo json_encode($output);


?>
