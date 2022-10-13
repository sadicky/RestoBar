<?php

@session_start();
require_once '../load_model.php';
$det = new BeanDetailsOperation();
$det_an = new BeanDetailsOperation();
$stock = new BeanStock();
$prod = new BeanProducts();

$acc=new BeanAccounts();
$sort=new BeanSortieMatp();
$op=new BeanOperation();
$op->select($_SESSION['op_sortie_mp_id']);
$pos=$op->getPosId();

$msg="xxxxx";

$sort->select($_SESSION['op_sortie_mp_id']);

$m_sort=0;

if(isset($_POST["operation"]))
{
  $prod->select($_POST['prod_id']);

$qt_op=$_POST['prod_qt'];

 if($_POST["operation"] == "Add")
 {
  $det->setProdId($_POST['prod_id']);
  $det->setOpId($_SESSION['op_sortie_mp_id']);
  $det->setQuantity($_POST['prod_qt']);
  $det->setAmount($_POST['prod_prix']);
  $det->setDet(true);
  $det->setLot('-');
  $det->setDateExp('-');

  $stock->select($_POST['prod_id'],$pos);
  $qt=$stock->getQuantity();

   if($qt<$qt_op)
   {
  $msg='Quantité insuffisante en stock ';
   }
  else
  {
  
  $last_det=$det->insert();
  $det->update_sup($last_det);
  $msg='Enregistrement reussi';

  $m_sort=$_POST['prod_prix']*$_POST['prod_qt'];

  $m_sort += $sort->getAmount();
  $sort->setAmount($m_sort);
  $sort->update($_SESSION['op_sortie_mp_id']);

      $stock->select($_POST['prod_id'],$pos);

      $qt=$stock->getQuantity() - $qt_op;

      $stock->setOpId($_SESSION['op_sortie_mp_id']);
      $stock->setQuantity($qt);
      $stock->setUpdateDate(date('Y-m-d h:i'));

      $stock->update($_POST['prod_id'],$pos);

  }

  }
  elseif($_POST["operation"] == "Edit")
 {

  $det->setProdId($_POST['prod_id']);
  $det->setOpId($_SESSION['op_sortie_mp_id']);
  $det->setQuantity($_POST['prod_qt']);
  $det->setDetailsId($_POST['sort_id']);
  $det->setAmount($_POST['prod_prix']);
  $det->setDet($_POST['poids']);


      $stock->select($_POST['prod_id'],$pos);
      $det_an->select($_POST["det_id"]);

  $qty_r=$_POST['prod_qt'] - $det_an->getQuantity();

  if($_POST['prod_qt']>$det_an->getQuantity())
  {
  $qt=$stock->getQuantity() - $qty_r;
  }
  else
  {
   $qt=$stock->getQuantity() + (-$qty_r);
  }

  if($qt_stk<$qty_r)
  {
    $msg= 'Quantité insuffisante en stock';

  }
  elseif($det->update($_POST["sort_id"]))
  {

  $m_sort=$_POST['prod_prix']*$qty_r;
  $m_sort += $sort->getAmount();
  $sort->setAmount($m_sort);
  $sort->update($_SESSION['op_sortie_mp_id']);


      $stock->setOpId($_SESSION['op_sortie_mp_id']);
      $stock->setQuantity($qt);
      $stock->setUpdateDate(date('Y-m-d h:i'));

      $stock->update($_POST['prod_id'],$pos);

    $msg= ' Modification reussie ';

  }
  else
  {
   $msg= 'Echec Modification';
  }
}
}
else
{
 $msg +=" operation existe pas ";
}

echo $msg;

                        
?>
