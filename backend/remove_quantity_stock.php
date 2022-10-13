<?php
@session_start();
require_once '../load_model.php';
$det = new BeanDetailsOperation();
$stock = new BeanStock();
$op=new BeanOperation();

/*$datas=$det->select_all($_SESSION['op_sortie_mp_id']);

foreach ($datas as $key => $value) {

       $stock->select($value['prod_id'],$_SESSION['pos']);
       $qt=$stock->getQuantity() - $value['quantity'];


        $stock->setOpId($_SESSION['op_sortie_mp_id']);
        $stock->setQuantity($qt);
        $stock->setUpdateDate(date('Y-m-d h:i'));

        $stock->update($value['prod_id'],$_SESSION['pos']);


}*/
$op->update_one($_SESSION["op_sortie_mp_id"],'op_id','is_send',true);
unset($_SESSION['op_sortie_mp_id']);

?>
