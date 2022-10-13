<?php

session_start();
require_once '../load_model.php';
$det = new BeanDetailsOperation();
$det_an = new BeanDetailsOperation();
$stock = new BeanStock();
$prod = new BeanProducts();
//$animaux= new BeanAnimaux();
$acc=new BeanAccounts();
$ent=new BeanEntreProdf();

$prod->select($_POST['prod_id']);
//$animaux->select($prod->getAnimalId());
//$acc->select_acc($_SESSION['sup_id']);
$ent->select($_SESSION['op_ent_id']);
//$bal_post=0;

$m_ent=0;

if(isset($_POST["operation"]))
{
 if($_POST["operation"] == "Add")
 {

  $det->setProdId($_POST['prod_id']);
  $det->setOpId($_SESSION['op_ent_id']);
  $det->setQuantity($_POST['prod_qt']);
  $det->setAmount($_POST['prod_prix']);


  if($det->insert())
  {
     echo ' Enregistrement reussi';

     $m_ent=$_POST['prod_prix']*$_POST['prod_qt'];

  $m_ent += $ent->getAmount();
  $ent->setAmount($m_ent);
  $ent->update($_SESSION['op_ent_id']);

    if(!$stock->existstock($_POST['prod_id']))
     {
        $stock->setProdId($_POST['prod_id']);
        $stock->setOpId($_SESSION['op_ent_id']);
        $stock->setQuantity($_POST['prod_qt']);
        $stock->setUpdateDate(date('Y-m-d h:i'));

        $stock->insert();

     }
     else
     {
      $stock->select($_POST['prod_id']);
      $qt=$stock->getQuantity() + $_POST['prod_qt'];


        $stock->setOpId($_SESSION['op_ent_id']);
        $stock->setQuantity($qt);
        $stock->setUpdateDate(date('Y-m-d h:i'));

        $stock->update($_POST['prod_id']);

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
  $det->setOpId($_SESSION['op_ent_id']);
  $det->setQuantity($_POST['prod_qt']);
  $det->setDetailsId($_POST['det_id']);
  $det->setAmount($_POST['prod_prix']);

      $stock->select($_POST['prod_id']);
      $det_an->select($_POST["det_id"]);

      $qty_r=$_POST['prod_qt'] - $det_an->getQuantity();
      $qt=$stock->getQuantity() + $qty_r;


  if($det->update($_POST["det_id"]))
  {

  $m_ent=$_POST['prod_prix']*$qty_r;
  $m_ent += $ent->getAmount();
  $ent->setAmount($m_ent);
  $ent->update($_SESSION['op_ent_id']);


      $stock->setOpId($_SESSION['op_ent_id']);
      $stock->setQuantity($qt);
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
