<?php

session_start();
require_once '../load_model.php';
$vente =new BeanVente();
$op = new BeanOperation();
$acc=new BeanAccounts();


if(isset($_POST["vente_id"]))
{
  $vente->select_id($_POST["vente_id"]);
  $op->select($vente->getOpId());
  $an_red=$vente->getRed();
  $acc->select($op->getPartyCode());
  $red=0;
  //$tot_red=$red + $an_red;

  if($_POST['type_red']=='1')
  {
    $red=$vente->getAmount()*($_POST['red']/100);
  }
  else
  {
    $red=$_POST['red'];
  }


  $bal=($acc->getBalCash()+$an_red) - $red;
  $acc->setBalCash($bal);
  $acc->update_cash($op->getPartyCode());

  $vente->update_one($_POST['vente_id'],'idvente','red',$red);


echo 'Réduction accordée ';
}
else
{
echo "operation existe pas";
}

?>
