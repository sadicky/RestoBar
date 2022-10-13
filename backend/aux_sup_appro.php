<?php

session_start();
require_once '../load_model.php';
$det = new BeanDetailsOperation();
$stock = new BeanStock();
$prod = new BeanProducts();
$animaux= new BeanAnimaux();
$acc=new BeanAccounts();

$prod->select($_POST['prod_id']);
$animaux->select($prod->getAnimalId());
$acc->select_acc($_SESSION['sup_id']);
$bal_post=0;

if(isset($_POST["operation"]))
{
 if($_POST["operation"] == "Add")
 {
  
  $det->setProdId($_POST['prod_id']);
  $det->setOpId($_SESSION['op_id']);
  $det->setSQuantity($_POST['s_qty']);
  $det->setNsQuanity($_POST['ns_qty']);
  $det->setSWeight($_POST['s_wgt']);
  $det->setNsWeight($_POST['ns_wgt']);
  $det->setAmount($_POST['prod_prix']);
  
  
  if($det->insert())
  {
     echo ' Enregistrement reussi';

  if($animaux->getByQty()=='1')
  {
     $bal_post=$acc->getBalCash() + (($_POST['prod_prix']*$_POST['s_qty']) + ($_POST['prod_prix']*$_POST['ns_qty'])) ;
  }
  else
  {
     $bal_post=$acc->getBalCash() + (($_POST['prod_prix']*$_POST['s_wgt']) + ($_POST['prod_prix']*$_POST['ns_wgt'])) ; 
  }

  $acc->setLastUpdate(date('Y/m/d h:i'));
  $acc->setUpdatedBy($_SESSION['sup_id']);
  $acc->setBalCash($bal_post);
  $acc->update_bal($acc->getaccId());

     if(!$stock->existstock($_POST['prod_id']))
     {
        $stock->setProdId($_POST['prod_id']);
        $stock->setOpId($_SESSION['op_id']);
        $stock->setSQuantity($_POST['s_qty']);
        $stock->setNsQuanity($_POST['ns_qty']);
        $stock->setSWeight($_POST['s_wgt']);
        $stock->setNsWeight($_POST['ns_wgt']);
        $stock->setUpdateDate(date('Y-m-d h:i'));

        $stock->insert();
        //echo ' Enregistrement reussi xxxx '.$stock->existstock($_POST['prod_id']);

     }
     else
     {
      $stock->select($_POST['prod_id']);
      $s_qty=$stock->getSQuantity() + $_POST['s_qty'];
      $s_wgt=$stock->getSWeight() + $_POST['s_wgt'];
      $ns_qty=$stock->getNsQuanity() + $_POST['ns_qty'];
      $ns_wgt=$stock->getNsWeight() + $_POST['ns_wgt'];


        $stock->setOpId($_SESSION['op_id']);
        $stock->setSQuantity($s_qty);
        $stock->setNsQuanity($ns_qty);
        $stock->setSWeight($s_wgt);
        $stock->setNsWeight($ns_wgt);
        $stock->setUpdateDate(date('Y-m-d h:i'));

        $stock->update($_POST['prod_id']);
        //echo ' Enregistrement reussi sadasd '.$stock->existstock($_POST['prod_id']);
      

     }
     
  }
  else
  {
   echo 'Echec Enregistrement'; 
  }
  }


 if($_POST["operation"] == "Edit")
 {
  
  $det->setProdId($_POST['prod_id']);
  $det->setOpId($_SESSION['op_id']);
  $det->setSQuantity($_POST['s_qty']);
  $det->setNsQuanity($_POST['ns_qty']);
  $det->setSWeight($_POST['s_wgt']);
  $det->setNsWeight($_POST['ns_wgt']);
  $det->setAmount($_POST['prod_prix']);
  $det->setDetailsId($_POST['appro_id']);

      $stock->select($_POST['prod_id']);
      $det->select($_POST["appro_id"]);

      $s_qty_r=$det->getSQuantity() - $_POST['s_qty'];
      $s_wgt_r=$det->getSWeight() - ($_POST['s_wgt']);
      $ns_qty_r=$det->getNsQuanity() - $_POST['ns_qty'];
      $ns_wgt_r=$det->getNsWeight() - $_POST['ns_wgt'];

      $s_qty=$stock->getSQuantity() - $s_qty_r;
      $s_wgt=$stock->getSWeight() - $s_wgt_r;
      $ns_qty=$stock->getNsQuanity() - $ns_qty_r;
      $ns_wgt=$stock->getNsWeight() - $ns_wgt_r;    
  
  if($det->update($_POST["appro_id"]))
  {

  /*if($animaux->getByQty()=='1')
  {
     $bal_post=$acc->getBalCash() + (($_POST['prod_prix']*$s_qty_r) + ($_POST['prod_prix']*$ns_qty_r)) ;
  }
  else
  {
     $bal_post=$acc->getBalCash() + (($_POST['prod_prix']*$s_wgt_r) + ($_POST['prod_prix']*$ns_wgt_r)) ; 
  }

  $acc->setLastUpdate(date('Y/m/d h:i'));
  $acc->setUpdatedBy($_SESSION['sup_id']);
  $acc->setBalCash($bal_post);
  $acc->update_bal($acc->getaccId());*/

        $stock->setOpId($_SESSION['op_id']);
        $stock->setSQuantity($s_qty);
        $stock->setNsQuanity($ns_qty);
        $stock->setSWeight($s_wgt);
        $stock->setNsWeight($ns_wgt);
        $stock->setUpdateDate(date('Y-m-d h:i'));

        $stock->update($_POST['prod_id']);
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