<?php

session_start();
require_once '../load_model.php';
$price = new BeanPrice();



if(isset($_POST["operation"]))
{
 if($_POST["operation"] == "Add")
 {

  $price->setPrice($_POST['prix_prod']);
  $price->setSupplierId($_SESSION['sup_id']);
  $price->setProdId($_POST['lib_prod']);
  $price->setStartDate(date('Y-m-d h:i'));
  //$price->setEndDate(NULL);
  $price->setState('1');
  $price->setSetBy($_SESSION['user_id']);
  $price->setComment($_POST['comment_price']);

  if(!$price->existprice($_POST['lib_prod'],'1'))
  {

  if($price->insert())
  {
     echo ' Enregistrement reussi';

  }
  else
  {
   echo 'Echec Enregistrement';
  }
  }
  else
  {
   echo 'Prix encours existant';
  }
  }


 if($_POST["operation"] == "Edit")
 {

  $price->setPrice($_POST['prix_prod']);
  $price->setSupplierId($_SESSION['sup_id']);
  $price->setProdId($_POST['lib_prod']);
  $price->setStartDate(date('Y-m-d', strtotime($_POST['date_debut'])));
  //$price->setEndDate(null);
  $price->setState('1');
  $price->setSetBy($_SESSION['user_id']);
  $price->setComment($_POST['comment_price']);
  $price->setPriceId($_POST['price_id']);

  if($price->updateCurrent())
  {
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
