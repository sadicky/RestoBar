<?php

session_start();
require_once '../load_model.php';
$chamb = new BeanChambre();

if(isset($_POST["operation"]))
{
 if($_POST["operation"] == "Add")
 {
  $chamb->setCategoryId($_POST['cat_id']);
  $chamb->setChambNum($_POST['chamb']);
  $chamb->setChambPrice($_POST['chamb_price']);
  $chamb->setChambCara($_POST['chamb_cara']);
  $chamb->insert();

  echo 'Enregistrement reussi avec succès';
 }
else if($_POST["operation"] == "Edit")
 {
  $chamb->setCategoryId($_POST['cat_id']);
  $chamb->setChambNum($_POST['chamb']);
  $chamb->setChambPrice($_POST['chamb_price']);
  $chamb->setChambCara($_POST['chamb_cara']);
  $chamb->setChambId($_POST['chamb_id']);
 
  $chamb->updateCurrent();

  echo 'Modification reussie avec succès';
}

}
else
{
echo "operation existe pas";
}

?>
