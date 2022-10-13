<?php
@session_start();
require_once '../load_model.php';
$det = new BeanDetailsOperation();
$detTo = new BeanDetailsOperation();
$det_an = new BeanDetailsOperation();
$stock = new BeanStock();
$stockTo = new BeanStock();
$prod = new BeanProducts();
$op=new BeanOperation();
$opTo=new BeanOperation();
$store=new BeanPos();
$pers=new BeanPersonne();
$pr=new BeanPrice();
$prTo=new BeanPrice();

$idPer=$_SESSION['periode'];

if(!isset($_SESSION['op_chg_id']))
{
  $tarId=$_POST['tar_id'];
  $tarIdTo=$_POST['tar_id_to'];

  $posId=$_POST['pos_id'];
  $posIdTo=$_POST['pos_id_to'];
}
else
{
  $op->select($_SESSION['op_chg_id']);
  $tarId=$op->getTarId();
  $posId=$op->getPosId();

  $opTo->select($op->getPartyCode());
  $tarIdTo=$opTo->getTarId();
  $posIdTo=$opTo->getPosId();
}


if(!isset($_SESSION['op_chg_id']))
{

  $opTo->setOpType('6');
  $opTo->setPartyType('1');
  $opTo->setJourId($_SESSION['jour']);
  $opTo->setTarId($tarIdTo);
  $opTo->setPartyCode('-');
  $opTo->setIdPer($idPer);
  $opTo->setPersonneId($_SESSION['perso_id']);
  $opTo->setPosId($posIdTo);
  $opTo->setCreateDate($_POST['date_chg']);

  $lastOp=$opTo->insert();

  $op->setOpType('5');
  $op->setPartyType('2');
  $op->setJourId($_SESSION['jour']);
  $op->setTarId($tarId);
  $op->setPartyCode($lastOp);
  $op->setIdPer($idPer);
  $op->setPersonneId($_SESSION['perso_id']);
  $op->setPosId($posId);
  $op->setCreateDate($_POST['date_chg']);

  $_SESSION['op_chg_id']=$op->insert();
}

$prod->select($_POST['prod_id']);

$qt=$_POST['qt'];
$price=$_POST['price'];
$prodId=$_POST['prod_id'];

$pr->select_2($prodId,$tarId);
$prTo->select_2($prodId,$tarIdTo);

if($pr->getUnt()<$prTo->getUnt())
{
$qtTo=(int)$qt*($pr->getUnt()/$prTo->getUnt());
$priceTo=(int)$price/($pr->getUnt()/$prTo->getUnt());  
}
else
{
 $qtTo=(int)$qt/($prTo->getUnt()/$pr->getUnt());
 $priceTo=(int)$price*($prTo->getUnt()/$pr->getUnt());  
}

$op->select($_SESSION['op_chg_id']);
//$opTop->select($op->getPartyCode());

if(isset($_POST["operation"]))
{
  if($_POST["operation"] == "Add")
  {
    $dateExp=$_POST['date_exp'];

    $det->setProdId($prodId);
    $det->setOpId($_SESSION['op_chg_id']);
    $det->setQuantity($qt);
    $det->setAmount($price);
    $det->setDet(true);
    $det->setLot("-");
    $det->setDateExp($dateExp);
    $det->insert();

    $detTo->setProdId($prodId);
    $detTo->setOpId($op->getPartyCode());
    $detTo->setQuantity($qtTo);
    $detTo->setAmount($priceTo);
    $detTo->setDet(true);
    $detTo->setLot("-");
    $detTo->setDateExp($dateExp);
    $detTo->insert(); 

    
    $stock->select($prodId,$posId,$tarId);
    $qt_stk=$stock->getQuantity() - $qt;

    if($qt_stk>0)
    {
        $stock->update_qt($stock->getStockId(),$qt_stk);

        if(!$stock->existstock($prodId,$posIdTo,$tarIdTo))
        {
        $stock->setProdId($prodId);
        $stock->setTarId($tarIdTo);
        $stock->setQuantity($qtTo);
        $stock->setPosId($posIdTo);
        $stock->setDateExp($dateExp);
        $stock->insert();
        }
        else
        {
          $stock->select($prodId,$posIdTo,$tarIdTo);
          $qt_stkTo=$stock->getQuantity() + $qtTo;
          $stock->update_qt($stock->getStockId(),$qt_stkTo);
        }
    }

    echo ' Enregistrement reussi '.$pr->getUnt().'-'.$prTo->getUnt();
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
      $m_chg=$price*$qty_r;
      $m_chg += $chg->getAmount();

      $chg->setMotif($_POST['motif']);
      $chg->setTypeSort($_POST['type_chg']);
      $chg->setAmount($m_chg);
      $chg->update($_SESSION['op_chg_id']);

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
