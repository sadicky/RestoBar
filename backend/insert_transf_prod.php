<?php

@session_start();
require_once '../load_model.php';
$det = new BeanDetailsOperation();
$det_an = new BeanDetailsOperation();
$stock = new BeanStock();
$stock_dest = new BeanStock();
$prod = new BeanProducts();

$acc=new BeanAccounts();
$sort=new BeanSortieMatp();

//$msg="yyyy";

$sort->select($_SESSION['op_transf_prod_id']);

$m_sort=0;


if(isset($_POST["operation"]))
{
  $prod->select($_POST['prod_id']);

       $qt_op=$_POST['prod_qt'];

  $stock->select($_POST['prod_id'],$_SESSION['source_pos']);
  $stock_dest->select($_POST['prod_id'],$_SESSION['dest_pos']);

 if($_POST["operation"] == "Add")
 {

  $det->setProdId($_POST['prod_id']);
  $det->setOpId($_SESSION['op_transf_prod_id']);
  $det->setQuantity($_POST['prod_qt']);
  $det->setAmount($_POST['prod_prix']);
  $det->setDet(true);

if($stock->getQuantity()<$qt_op)
 {
  $msg='Quantité insuffisante en stock ';
 }
  elseif($det->insert())
  {

  $m_sort=$_POST['prod_prix']*$_POST['prod_qt'];

  $m_sort += $sort->getAmount();
  $sort->setAmount($m_sort);
  $sort->update($_SESSION['op_transf_prod_id']);

      $stock->select($_POST['prod_id'],$_SESSION['source_pos']);
      $qt=$stock->getQuantity() - $qt_op;

      $stock_dest->select($_POST['prod_id'],$_SESSION['dest_pos']);
      $qt_dest=$stock_dest->getQuantity() + $qt_op;

      $stock->setOpId($_SESSION['op_transf_prod_id']);
      $stock->setQuantity($qt);
      $stock->setUpdateDate(date('Y-m-d h:i'));

      $stock->update($_POST['prod_id'],$_SESSION['source_pos']);

      if(!$stock_dest->existstock($_SESSION['dest_pos'],$_POST['prod_id']))
      {
        $stock_dest->setProdId($_POST['prod_id']);
        $stock_dest->setOpId($_SESSION['op_transf_prod_id']);
        $stock_dest->setQuantity($qt_dest);
        $stock_dest->setUpdateDate(date('Y-m-d h:i'));
        $stock_dest->setPosId($_SESSION['dest_pos']);
        $stock_dest->setDet(true);
        $stock_dest->insert();

      }
      else
      {
      $stock_dest->setOpId($_SESSION['op_transf_prod_id']);
      $stock_dest->setQuantity($qt_dest);
      $stock_dest->setUpdateDate(date('Y-m-d h:i'));
      $stock_dest->update($_POST['prod_id'],$_SESSION['dest_pos']);

      //echo 'stock ok';

      }


  $msg=' Enregistrement reussi';

  }
  else
  {
   $msg='Echec Enregistrement';
  }
  }

}

echo $msg;
?>
