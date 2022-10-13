<?php

require_once '../load_model.php';
$chamb = new BeanChambre();
$chamb->select($_POST["chamb_id"]);

$output = array();
if(isset($_POST["chamb_id"]))
{
  $output["chamb_num"] = $chamb->getChambNum();
  $output["chamb_price"] = $chamb->getChambPrice();
  $output["cat_id"] = $chamb->getCategoryId();
  $output["chamb_cara"] = $chamb->getChambreCara();
}

$output['id'] = $_POST["chamb_id"];

echo json_encode($output);


?>
