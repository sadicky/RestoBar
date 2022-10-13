<?php
session_start();
require_once '../load_model.php';
$det = new BeanDetailsOperation();
$op = new BeanOperation();
$det_an = new BeanDetailsOperation();
$stock = new BeanStock();
$prod = new BeanProducts();


$acc=new BeanAccounts();
$vente=new BeanVente();

$msg="xxxxx";
if(isset($_SESSION['type_stock']))
{
$stk=$_SESSION['type_stock'];
}
else
{
$stk='1';
}

$vente->select($_SESSION['op_vente_id']);

$m_vente=0;

//$prod->select($_POST['prod_id']);
//$op->select($_POST['op_vente_id']);

if(isset($_POST['prod_id']))
{
  $prod->select($_POST['prod_id']);
  $price=0;
  $new_qt=1;
  $qt_stk=1;
  if($stk=='0')
  {
    $price=$prod->getProdPriceGros();
    $qt_stk *=$prod->getUntMes();
  }
  else
  {
    $price=$prod->getProdPrice();
  }

  $stock->select($_POST['prod_id'],$_SESSION['pos']);
 if(!$det->existop($_SESSION['op_vente_id'],$_POST['prod_id'],$stk))
 {

  $det->setProdId($_POST['prod_id']);
  $det->setOpId($_SESSION['op_vente_id']);
  $det->setQuantity($new_qt);
  $det->setAmount($price);
  if($stk=='1')
  {
  $det->setDet(true);
  }
  else
  {
  $det->setDet(false);
  }

  if($stock->getQuantity()<$qt_stk and $prod->getIsStock()=='Oui')
  {
  $msg='Quantité insuffisante en stock ';
  }
  elseif($det->insert())
  {
  $msg=' Enregistrement reussi';
  $m_vente=$price*$new_qt;
  $m_vente += $vente->getAmount();
  $vente->setAmount($m_vente);
  $vente->update($_SESSION['op_vente_id']);

      $stock->select($_POST['prod_id'],$_SESSION['pos']);
      $qt=$stock->getQuantity() - $qt_stk;

      $stock->setOpId($_SESSION['op_vente_id']);
      $stock->setQuantity($qt);
      $stock->setUpdateDate(date('Y-m-d h:i'));

      $stock->update($_POST['prod_id'],$_SESSION['pos']);


  }
  else
  {
   $msg='Echec Enregistrement';
  }
  }
  elseif($det->existop($_SESSION['op_vente_id'],$_POST['prod_id'],$stk))
 {
  $det_an->select_op($_SESSION['op_vente_id'],$_POST['prod_id'],$stk);
  $new_qt=$det_an->getQuantity() + 1;
  $qt_stk=1;
  $det->setProdId($_POST['prod_id']);
  $det->setQuantity($new_qt);
  $det->setAmount($price);
  if($stk=='1')
  {
  $det->setDet(true);
  }
  else
  {
  $det->setDet(false);
  $qt_stk *=$prod->getUntMes();
  }

      $stock->select($_POST['prod_id'],$_SESSION['pos']);


  if($stock->getQuantity()<$qt_stk and $prod->getIsStock()=='Oui')
  {
    $msg= 'Quantité insuffisante en stock ';

  }
  elseif($det->update_op($_POST['prod_id'],$_SESSION['op_vente_id'],$stk))
  {

  $m_vente=$price;
  $m_vente += $vente->getAmount();
  $vente->setAmount($m_vente);
  $vente->update($_SESSION['op_vente_id']);
  $qt =$stock->getQuantity()-$qt_stk;

      $stock->setOpId($_SESSION['op_vente_id']);
      $stock->setQuantity($qt);
      $stock->setUpdateDate(date('Y-m-d h:i'));

       $stock->update($_POST['prod_id'],$_SESSION['pos'],$stk);

    $msg= ' Modification reussie ';

  }
  else
  {
   $msg= 'Echec Modification';
  }

}
else
{
 $msg +=" operation existe pas ";
}
}

echo $msg;
?>
