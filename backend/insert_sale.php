<?php
@session_start();
require_once '../load_model.php';
$det = new BeanDetailsOperation();
$det_an = new BeanDetailsOperation();
$stock = new BeanStock();
$prod = new BeanProducts();
$op=new BeanOperation();
$store=new BeanPos();
$vente = new BeanVente();
$pers=new BeanPersonne();
$cust=new BeanCustomer();

$idPer=$_SESSION['periode'];
$cust->select_code('1');
$cust_id=$cust->getPersonneId();

if(!isset($_SESSION['op_vente_id']))
{
  $tarId=$_POST['tar_id'];
  $posId=$_POST['pos_id'];
}
else
{
  $op->select($_SESSION['op_vente_id']);
  $tarId=$op->getTarId();
  $posId=$op->getPosId();
}

if(!isset($_SESSION['op_vente_id']))
{
  $op->setOpType('4');
  $op->setPartyType('2');
  $op->setJourId($_SESSION['jour']);
  $op->setTarId($tarId);
  $op->setPartyCode($cust_id);
  $op->setIdPer($idPer);
  $op->setPersonneId($_SESSION['perso_id']);
  $op->setPosId($posId);
  $op->setCreateDate($_POST['date_vente']);

  $_SESSION['op_vente_id']=$op->insert();

  $op->select($_SESSION['op_vente_id']);
  $last_vente=$vente->select_last_num();
  $last_num=($last_vente['last_num'] +1) .'/'.date("my", strtotime($op->getCreateDate()));

  $vente->setAmount('0');
  $vente->setNumVente($last_num);
  $vente->setOpId($_SESSION['op_vente_id']);
  $vente->setIsPaid('0');
  $vente->setAssId('0');
  $vente->insert();
}

$prod->select($_POST['prod_id']);

$qt=$_POST['qt'];
$price=$_POST['price'];
$prodId=$_POST['prod_id'];
$vente->select($_SESSION['op_vente_id']);
$m_vente=0;

if(isset($_POST["operation"]))
{
  if($_POST["operation"] == "Add")
  {
    $dateExp=$_POST['date_exp'];
    $det->setProdId($prodId);
    $det->setOpId($_SESSION['op_vente_id']);
    $det->setQuantity($qt);
    $det->setAmount($price);
    $det->setDet(true);
    $det->setLot($_POST['lot']);
    $det->setDateExp($dateExp);

    $stock->select($prodId,$posId,$tarId);
    $qt_stk=$stock->getQuantity() - $qt;

    if($qt_stk<0 and $prod->getIsStock()=='Oui')
    {
    echo 'Quantité insuffisante en stock ';
    }
    else
    {
    $det->insert(); 

    $m_vente=$price*$qt;
    $m_vente += $vente->getAmount();
    $vente->setAmount($m_vente);
    $vente->update($_SESSION['op_vente_id']);
    $stock->update_qt($stock->getStockId(),$qt_stk);

    echo ' Enregistrement reussi ';
    }

  }
  if($_POST["operation"] == "Edit")
  {
    $det_an->select($_POST["det_id"]);
    $dateExp=$det_an->getDateExp();

    $det->setProdId($prodId);
    $det->setQuantity($qt);
    $det->setAmount($price);
    $det->setDateExp($dateExp);

    $stock->select($prodId,$posId,$tarId);

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
      $m_vente=$price*$qty_r;
      $m_vente += $vente->getAmount();

      $vente->setAmount($m_vente);
      $vente->update($_SESSION['op_vente_id']);

      $det->update_one($_POST["det_id"],'details_id','lot',$_POST['lot']);
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
