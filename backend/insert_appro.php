<?php
@session_start();
require_once '../load_model.php';
$det = new BeanDetailsOperation();
$det_an = new BeanDetailsOperation();
$stock = new BeanStock();
$prod = new BeanProducts();
$op=new BeanOperation();
$store=new BeanPos();
$achat = new BeanAchats();
$track=new BeanPayTrack();
$pers=new BeanPersonne();

$idPer=$_SESSION['periode'];
$posId=$_SESSION['pos'];

$supId=$_POST['sup_id'];
 
if(!empty($_POST['content_lib_sup']) and empty($supId))
{
  $pers->setRole('1');
  $pers->setNomComplet($_POST['content_lib_sup']);
  $supId=$pers->insert_2();
}

if(isset($_SESSION['op_appro_id']))
{
  $op->select($_SESSION['op_appro_id']);
}

if(!isset($_SESSION['op_appro_id']))
{
  $op->setOpType('1');
  $op->setPartyType('1');
  $op->setJourId($_SESSION['jour']);
  $op->setPartyCode($supId);
  $op->setIdPer($idPer);
  $op->setPersonneId($_SESSION['perso_id']);
  $op->setPosId($posId);
  $op->setCreateDate($_POST['date_appro']);

  $_SESSION['op_appro_id']=$op->insert();

  $op->select($_SESSION['op_appro_id']);
  $last_achat=$achat->select_last_num();
  $last_num=($last_achat['last_num'] +1) .'/'.date("my", strtotime($op->getCreateDate()));

  $achat->setAmount('0');
  $achat->setNumAchat($last_num);
  $achat->setOpId($_SESSION['op_appro_id']);
  $achat->setIsPaid(false);
  $achat->insert();
}

$prod->select($_POST['prod_id']);

$qt=$_POST['qt'];
$price=$_POST['price'];
$prodId=$_POST['prod_id'];
$achat->select($_SESSION['op_appro_id']);
$m_achat=0;

if(isset($_POST["operation"]))
{
  if($_POST["operation"] == "Add")
  {
    $det->setProdId($prodId);
    $det->setOpId($_SESSION['op_appro_id']);
    $det->setQuantity($qt);
    $det->setAmount($price);
    $det->setDet('0');
    $det->setLot("-");
    $det->setDateExp('-');

    $det->insert(); 

  $m_achat=$price*$qt;
  $m_achat += $achat->getAmount();
  $achat->setAmount($m_achat);
  $achat->update($_SESSION['op_appro_id']);

    if(!$stock->existstock($prodId,$posId))
    {
      $stock->setProdId($prodId);
      $stock->setQuantity($qt);
      $stock->setPosId($posId);
      $stock->insert();

    }
    else
    {
      $stock->select($prodId,$posId);
      $qt_stk=$stock->getQuantity() + $qt;
      $stock->update_qt($stock->getStockId(),$qt_stk);
    }

    echo ' Enregistrement reussi ';

  }
  if($_POST["operation"] == "Edit")
  {
    $det_an->select($_POST["det_id"]);
    $dateExp=$det_an->getDateExp();

    $det->setProdId($prodId);
    $det->setQuantity($qt);
    $det->setAmount($price);
    $det->setDateExp('-');

    $stock->select($prodId,$posId);
    
    $qty_r=$qt - $det_an->getQuantity();
    $qt_stk=$stock->getQuantity() + $qty_r;

  if($qty_r=='0' and $det_an->getAmount()!=$price)
  {
   $m_achat=(($qt*$price) -($det_an->getAmount()*$det_an->getQuantity())) ;
  }
  else
  {
  $m_achat=$price*$qty_r;
  }

    if($qt_stk<0)
    {
      echo 'Quantité insuffisante en stock !';
    }
    elseif($det->update($_POST["det_id"]))
    {
      $m_achat += $achat->getAmount();
      $achat->setAmount($m_achat);
      $achat->update($_SESSION['op_appro_id']);
      
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
