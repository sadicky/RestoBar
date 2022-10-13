<?php
@session_start();
require_once '../load_model.php';
$det = new BeanDetailsOperation();
$stock = new BeanStock();
$stock_dest = new BeanStock();
$op=new BeanOperation();

/*$datas=$det->select_all($_SESSION['op_transf_prod_id']);

foreach ($datas as $key => $value) {
  if(!$stock_dest->existstock($_SESSION['dest_pos'],$value['prod_id']))
     {
        $stock_dest->setProdId($value['prod_id']);
        $stock_dest->setOpId($_SESSION['op_transf_prod_id']);
        $stock_dest->setQuantity($value['quantity']);
        $stock_dest->setUpdateDate(date('Y-m-d h:i'));
        $stock_dest->setPosId($_SESSION['dest_pos']);
        $stock_dest->setDet(true);
        $stock_dest->insert();

     }
     else
     {
       $stock_dest->select($value['prod_id'],$_SESSION['pos']);
       $qt=$stock_dest->getQuantity() + $value['quantity'];
        $stock_dest->setOpId($_SESSION['op_transf_prod_id']);
        $stock_dest->setQuantity($qt);
        $stock_dest->setUpdateDate(date('Y-m-d h:i'));

        $stock_dest->update($value['prod_id'],$_SESSION['dest_pos']);

    }
    //destination

       $stock->select($value['prod_id'],$_SESSION['pos']);
       $qt=$stock->getQuantity() - $value['quantity'];


        $stock->setOpId($_SESSION['op_transf_prod_id']);
        $stock->setQuantity($qt);
        $stock->setUpdateDate(date('Y-m-d h:i'));
        $stock->update($value['prod_id'],$_SESSION['pos']);
}*/
$op->update_one($_SESSION["op_transf_prod_id"],'op_id','is_send',true);
unset($_SESSION['op_transf_prod_id']);

?>
