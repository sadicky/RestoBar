<?php
@session_start();
require_once '../load_model.php';
$det = new BeanDetailsOperation();
$det_an = new BeanDetailsOperation();
$stock = new BeanStock();
$prod = new BeanProducts();
$op=new BeanOperation();
$store=new BeanPos();
$pro = new BeanProforma();
$pers=new BeanPersonne();

$idPer=$_SESSION['periode'];
$posId=$_SESSION['pos'];



if(isset($_SESSION['op_pro_id']))
{
  $op->select($_SESSION['op_pro_id']);
}

if(!isset($_SESSION['op_pro_id']))
{
  $op->setOpType('2');
  $op->setPartyType('2');
  $op->setJourId($_SESSION['jour']);
  $op->setPartyCode($_POST['proforma']);
  $op->setIdPer($idPer);
  $op->setPersonneId($_SESSION['perso_id']);
  $op->setPosId($posId);
  $op->setCreateDate($_POST['date_pro']);

  $_SESSION['op_pro_id']=$op->insert();

  $op->select($_SESSION['op_pro_id']);
  $last_pro=$pro->select_last_num();
  $last_num=($last_pro['last_num'] +1) .'/'.date("my", strtotime($op->getCreateDate()));

  $pro->setAmount('0');
  $pro->setNumSort($last_num);
  $pro->setOpId($_SESSION['op_pro_id']);
  $pro->setIsPaid('0');
  $pro->setMotif($_POST['motif']);
  $pro->setTypeSort($_POST['type_pro']);
  $pro->insert();
}

$prod->select($_POST['prod_id']);

$qt=$_POST['qt'];
$price=$_POST['price'];
$prodId=$_POST['prod_id'];
$pro->select($_SESSION['op_pro_id']);
$m_pro=0;

if(isset($_POST["operation"]))
{
  if($_POST["operation"] == "Add")
  {
    $det->setProdId($prodId);
    $det->setOpId($_SESSION['op_pro_id']);
    $det->setQuantity($qt);
    $det->setAmount($price);
    $det->setDet('0');
    $det->setLot("-");
    $det->setDateExp('-');

    $det->insert(); 

    $m_pro=$price*$qt;
    $m_pro += $pro->getAmount();
    $pro->setAmount($m_pro);
    $pro->update($_SESSION['op_pro_id']);

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
      $m_pro=$price*$qty_r;
      $m_pro += $pro->getAmount();

      $pro->setMotif($_POST['motif']);
      $pro->setTypeSort($_POST['type_pro']);
      $pro->setAmount($m_pro);
      $pro->update($_SESSION['op_pro_id']);

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
