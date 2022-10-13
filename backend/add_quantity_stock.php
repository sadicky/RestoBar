<?php
@session_start();
require_once '../load_model.php';
$det = new BeanDetailsOperation();
$stock = new BeanStock();
$op=new BeanOperation();

//$datas=$det->select_all($_SESSION['op_appro_id']);

/*foreach ($datas as $key => $value) {
  if(!$stock->existstock($_SESSION['pos'],$value['prod_id']))
     {
        $stock->setProdId($value['prod_id']);
        $stock->setOpId($_SESSION['op_appro_id']);
        $stock->setQuantity($value['quantity']);
        $stock->setUpdateDate(date('Y-m-d h:i'));
        $stock->setPosId($_SESSION['pos']);
        $stock->setDet(true);
        $stock->insert();

     }
     else
     {
       $stock->select($value['prod_id'],$_SESSION['pos']);
       $qt=$stock->getQuantity() + $value['quantity'];


        $stock->setOpId($_SESSION['op_appro_id']);
        $stock->setQuantity($qt);
        $stock->setUpdateDate(date('Y-m-d h:i'));

        $stock->update($value['prod_id'],$_SESSION['pos']);

     }
}*/
$op->update_one($_SESSION["op_appro_id"],'op_id','is_send',true);
unset($_SESSION['op_appro_id']);

?>
