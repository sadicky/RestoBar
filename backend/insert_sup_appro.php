<?php

@session_start();
require_once '../load_model.php';
$det = new BeanDetailsOperation();
$det_an = new BeanDetailsOperation();
$stock = new BeanStock();
$prod = new BeanProducts();
$acc=new BeanAccounts();
$achat=new BeanAchats();
$op=new BeanOperation();
$store=new BeanPos();

//$store->select_actif('0');
//$pos=$store->getPersonneId();

$op->select($_SESSION['op_appro_id']);
$pos=$op->getPosId();

$prod->select($_POST['prod_id']);
$achat->select($_SESSION['op_appro_id']);

$m_achat=0;

$qt_appro=$_POST['prod_qt'];

if(isset($_POST["operation"]))
{
 if($_POST["operation"] == "Add")
 {

  $det->setProdId($_POST['prod_id']);
  $det->setOpId($_SESSION['op_appro_id']);
  $det->setQuantity($_POST['prod_qt']);
  $det->setAmount($_POST['prod_prix']);
  $det->setDet(true);
  $det->setLot("-");
  $det->setDateExp('-');

  if(empty($_POST['prod_id']))
  {
    echo 'Selectionnez le produit';

  }
  else
  {
  $det->insert(); 
  echo ' Enregistrement reussi';
  $prod->update_one($_POST['prod_id'],'prod_id','prod_price',$_POST['prod_prix_v']);

  $m_achat=$_POST['prod_prix']*$_POST['prod_qt'];

  $acc->select($op->getPartyCode());
  $bal=$acc->getBalCash() + $m_achat;
  $acc->setBalCash($bal);
  $acc->update_cash($op->getPartyCode());

  $m_achat += $achat->getAmount();
  $achat->setAmount($m_achat);
  $achat->update($_SESSION['op_appro_id']);

    if(!$stock->existstock($pos,$_POST['prod_id']))
     {
        $stock->setProdId($_POST['prod_id']);
        $stock->setOpId($_SESSION['op_appro_id']);
        $stock->setQuantity($qt_appro);
        $stock->setUpdateDate(date('Y-m-d h:i'));
        $stock->setPosId($pos);
        $stock->setDet(true);
        $stock->insert();

     }
     else
     {
       $stock->select($_POST['prod_id'],$pos);
       $qt=$stock->getQuantity() + $qt_appro;

        $stock->setOpId($_SESSION['op_appro_id']);
        $stock->setQuantity($qt);
        $stock->setUpdateDate(date('Y-m-d h:i'));

        $stock->update($_POST['prod_id'],$pos);

     }

     //stock price
$stock->update_one($_POST['prod_id'],'prod_id','pv',$_POST['prod_prix_v']);
$stock->update_one($_POST['prod_id'],'prod_id','pa',$_POST['prod_prix']);
//stock price

  }
  }
 if($_POST["operation"] == "Edit")
 {

  $det->setProdId($_POST['prod_id']);
  $det->setOpId($_SESSION['op_appro_id']);
  $det->setQuantity($_POST['prod_qt']);
  $det->setDetailsId($_POST['appro_id']);
  $det->setAmount($_POST['prod_prix']);
  $det->setDet(true);
  $det->setLot('-');
  $det->setDateExp('-');


      $stock->select($_POST['prod_id'],$pos);
      $det_an->select($_POST["det_id"]);

      //stock generale
      $qty_r=$_POST['prod_qt'] - $det_an->getQuantity();
      $qt=$stock->getQuantity() + $qty_r;

  if($qty_r=='0' and $det_an->getAmount()!=$_POST['prod_prix'])
  {
   $m_achat=(($_POST['prod_qt']*$_POST['prod_prix']) -($det_an->getAmount()*$det_an->getQuantity())) ;
  }
  else
  {
  $m_achat=$_POST['prod_prix']*$qty_r;
  }


  if($qt<0)
  {
    echo 'Quantité insuffisante en stock !';
  }
  elseif($det->update($_POST["appro_id"]))
  {
  $det->update_sup($_POST["appro_id"]);

  $acc->select($op->getPartyCode());
  $bal=$acc->getBalCash() + $m_achat;
  $acc->setBalCash($bal);
  $acc->update_cash($op->getPartyCode());

  $m_achat += $achat->getAmount();
  $achat->setAmount($m_achat);
  $achat->update($_SESSION['op_appro_id']);

      $stock->setOpId($_SESSION['op_appro_id']);
      $stock->setQuantity($qt);
      $stock->setUpdateDate(date('Y-m-d h:i'));

      $stock->update($_POST['prod_id'],$pos);

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
