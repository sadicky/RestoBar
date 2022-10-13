<?php

session_start();
require_once '../load_model.php';
$coupon = new BeanCoupon();



if(isset($_POST["operation"]))
{
 if($_POST["operation"] == "Add")
 {
  $coupon->setCouponName($_POST['coupon_name']);
  $coupon->insert();
  echo 'Enregistrement reussi avec succès';
 }
else if($_POST["operation"] == "Edit")
 {

  $coupon->setCouponName($_POST['coupon_name']);
  $coupon->setCouponId($_POST['coupon_id']);
  $coupon->updateCurrent();
  echo 'Modification reussie avec succès';
}

}
else
{
echo "operation existe pas";
}

?>
