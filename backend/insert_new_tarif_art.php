<?php

session_start();
require_once '../load_model.php';
$pr = new BeanPrice();

if(isset($_POST["operation"]))
{
 if($_POST["operation"] == "Add")
 {
  $pr->setTarId($_POST['tar_id']);
  $pr->setProdId($_POST['prod_id']);
  $pr->setPrice($_POST['price']);
  $pr->setUnt($_POST['unt']);
  $pr->setUntMes($_POST['unt_mes']);
  $pr->insert();
  echo 'Enregistrement reussi avec succès ';
 }
else if($_POST["operation"] == "Edit")
 {

  $pr->setTarId($_POST['tar_id']);
  $pr->setPrice($_POST['price']);
  $pr->setUnt($_POST['unt']);
  $pr->setUntMes($_POST['unt_mes']);
  $pr->update($_POST['price_id']);
  echo 'Modification reussie avec succès ';

  $pr->update_one($_POST["price_id"],'price_id','last_update',date('Y-m-d h:i:s'));
}

}
else
{
echo "operation existe pas";
}

?>
