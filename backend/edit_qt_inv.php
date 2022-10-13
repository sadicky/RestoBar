<?php
@session_start();
require_once '../load_model.php';
$det = new BeanDetailsOperation();
$stock=new BeanStock();

$val=$_POST['val'];
if(isset($_POST['det_id']))
{
 $det->update_one($_POST["det_id"],'details_id',$_POST['field'],$val);
}

$det->select($_POST['det_id']);

$stock->select($det->getProdId(),$_SESSION['pos']);

    
    if($_POST['field']=='quantity')
     {
      $qt=$val;
      if(!$stock->existstock($_SESSION['pos'],$det->getProdId()))
     {
        $stock->setProdId($det->getProdId());
        $stock->setOpId('1');
        $stock->setQuantity($qt);
        $stock->setUpdateDate(date('Y-m-d h:i'));
        $stock->setPosId($_SESSION['pos']);
        $stock->setDet(true);
        $stock->insert();
     }
     else
     {
      
      //$qt=$stock->getQuantity() - ($qt_dif);
      $stock->setOpId('1');
      $stock->setQuantity($qt);
      $stock->setUpdateDate(date('Y-m-d h:i'));
      $stock->update($det->getProdId(),$_SESSION['pos']);
    }
}
?>
