<?php
@session_start();
require_once '../load_model.php';
$det = new BeanDetailsOperation();
$det_an = new BeanDetailsOperation();
$stock = new BeanStock();
$prod = new BeanProducts();
$op=new BeanOperation();
$store=new BeanPos();
$sort = new BeanSortie();
$pers=new BeanPersonne();

$idPer=$_SESSION['periode'];
$posId=$_SESSION['pos'];



if(isset($_SESSION['op_sort_id']))
{
  $op->select($_SESSION['op_sort_id']);
}

if(!isset($_SESSION['op_sort_id']))
{
  $op->setOpType('2');
  $op->setPartyType('2');
  $op->setJourId($_SESSION['jour']);
  $op->setPartyCode('-');
  $op->setIdPer($idPer);
  $op->setPersonneId($_SESSION['perso_id']);
  $op->setPosId($posId);
  $op->setCreateDate($_POST['date_sort']);

  $_SESSION['op_sort_id']=$op->insert();

  $op->select($_SESSION['op_sort_id']);
  $last_sort=$sort->select_last_num();
  $last_num=($last_sort['last_num'] +1) .'/'.date("my", strtotime($op->getCreateDate()));

  $sort->setAmount('0');
  $sort->setNumSort($last_num);
  $sort->setOpId($_SESSION['op_sort_id']);
  $sort->setIsPaid('0');
  $sort->setMotif($_POST['motif']);
  $sort->setTypeSort($_POST['type_sort']);
  $sort->insert();
}

$prod->select($_POST['prod_id']);

$qt=$_POST['qt'];
$price=$_POST['price'];
$prodId=$_POST['prod_id'];
$sort->select($_SESSION['op_sort_id']);
$m_sort=0;

if(isset($_POST["operation"]))
{
  if($_POST["operation"] == "Add")
  {
    $det->setProdId($prodId);
    $det->setOpId($_SESSION['op_sort_id']);
    $det->setQuantity($qt);
    $det->setAmount($price);
    $det->setDet('0');
    $det->setLot("-");
    $det->setDateExp('-');

    $det->insert(); 

    $m_sort=$price*$qt;
    $m_sort += $sort->getAmount();
    $sort->setAmount($m_sort);
    $sort->update($_SESSION['op_sort_id']);

    $stock->select($prodId,$posId);
    $qt_stk=$stock->getQuantity() - $qt;
    $stock->update_qt($stock->getStockId(),$qt_stk);

    echo ' Enregistrement reussi ';

  }
  if($_POST["operation"] == "Edit")
  {
    $det_an->select($_POST["det_id"]);
    
    $det->setProdId($prodId);
    $det->setQuantity($qt);
    $det->setAmount($price);
    $det->setDateExp('-');

    $stock->select($prodId,$posId);

    $qty_r=$qt - $det_an->getQuantity();

    if($qt>$det_an->getQuantity())
    {
      $qt_stk=$stock->getQuantity() - $qty_r;
    }
    else
    {
      $qt_stk=$stock->getQuantity() + (-$qty_r);
    }



    if($qt_stk<0)
    {
      echo 'Quantité insuffisante en stock !';
    }
    elseif($det->update($_POST["det_id"]))
    {
      $m_sort=$price*$qty_r;
      $m_sort += $sort->getAmount();

      $sort->setMotif($_POST['motif']);
      $sort->setTypeSort($_POST['type_sort']);
      $sort->setAmount($m_sort);
      $sort->update($_SESSION['op_sort_id']);

      $stock->update_qt($stock->getStockId(),$qt_stk);
      echo ' Modification reussie ';
    }
    else
    {
      echo 'Echec Modification';
    }
  }
}
else
{
  echo "operation existe pas";
}
?>
