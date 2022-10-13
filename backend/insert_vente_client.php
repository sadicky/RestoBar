<?php
session_start();
require_once '../load_model.php';
$det = new BeanDetailsOperation();
$op = new BeanOperation();
$det_an = new BeanDetailsOperation();
$stock = new BeanStock();
$prod = new BeanProducts();


//$acc=new BeanAccounts();
$vente=new BeanVente();

$msg="xxxxx";

$vente->select($_SESSION['op_vente_id']);

$m_vente=0;

if(isset($_POST['prod_id']))
{
  $prod->select($_POST['prod_id']);
  $price=0;
  /*if($prod->getQtMin()>2)
    {
        $new_qt=$_POST['qt']*$prod->getQtMin();
        $qt_stk=$_POST['qt']*$prod->getQtMin();
        $price=$prod->getProdPrice()/$prod->getQtMin();
      }
  else
    {*/
      $new_qt=$_POST['qt'];
      $qt_stk=$_POST['qt'];
      $price=$prod->getProdPrice();
      //}

  $stock->select($_POST['prod_id'],$_SESSION['pos']);
  
 if(!$det->existop_2_($_SESSION['op_vente_id'],$_POST['prod_id'],$_SESSION['cmd']))
 {

  $det->setProdId($_POST['prod_id']);
  $det->setOpId($_SESSION['op_vente_id']);
  $det->setQuantity($new_qt);
  $det->setAmount($price);
  $det->setDet($_SESSION['cmd']);
  $det->setLot('1');

  
  if($stock->getQuantity()<$qt_stk and $prod->getIsStock()=='Oui')
  {
  $msg='Quantité insuffisante en stock ';
  }
  elseif($det->insert())
  {

  $msg=' Enregistrement reussi';
  $op->update_one($_SESSION['op_vente_id'],'op_id','is_send',false);
  $m_vente=$price*$new_qt;
  $m_vente += $vente->getAmount();
  $vente->setAmount($m_vente);
  $vente->update($_SESSION['op_vente_id']);

      $stock->select($_POST['prod_id'],$_SESSION['pos']);
      
      $qt_stk=$stock->getQuantity() - $qt_stk;
      $stock->update_qt($stock->getStockId(),$qt_stk);
  }
  else
  {
   $msg='Echec Enregistrement';
  }
  }
  elseif($det->existop_2_($_SESSION['op_vente_id'],$_POST['prod_id'],$_SESSION['cmd']))
 {
  $det_an->select_op_($_SESSION['op_vente_id'],$_POST['prod_id'],$_SESSION['cmd']);

  /*if($prod->getQtMin()>2)
    {
        $new_qt=$_POST['qt']*$prod->getQtMin();
        $qt_stk=$_POST['qt']*$prod->getQtMin();
        $price=$prod->getProdPrice()/$prod->getQtMin();
      }
  else
    {*/
      $new_qt=$_POST['qt'];
      $qt_stk=$_POST['qt'];
      $price=$prod->getProdPrice();
      //}

  $new_qt +=$det_an->getQuantity();

  if($new_qt<=0)
  {
    //$new_qt=1;
    /*if($prod->getQtMin()>2)
    {
        $new_qt=1*$prod->getQtMin();
        $qt_stk=1*$prod->getQtMin();
        $price=$prod->getProdPrice()/$prod->getQtMin();
      }
  else
    {*/
      $new_qt=1;
      $qt_stk=1;
      $price=$prod->getProdPrice();
      //}
  }

  //$qt_stk=$_POST['qt'];
  $det->setProdId($_POST['prod_id']);
  $det->setQuantity($new_qt);
  $det->setAmount($price);
  $det->setDet($_SESSION['cmd']);

  
  $stock->select($_POST['prod_id'],$_SESSION['pos']);
  
  if($stock->getQuantity()<$qt_stk and $prod->getIsStock()=='Oui')
  {
    $msg= 'Quantité insuffisante en stock ';

  }
  elseif($det->update_op_($_POST['prod_id'],$_SESSION['op_vente_id'],$_SESSION['cmd']))
  {

  $m_vente=($price*$new_qt);
  //$m_vente += $vente->getAmount();
  $vente->setAmount($m_vente);
  $vente->update($_SESSION['op_vente_id']);

  $qt_stk =$stock->getQuantity()-$qt_stk;
  $stock->update_qt($stock->getStockId(),$qt_stk);

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
