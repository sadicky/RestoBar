<?php

session_start();
require_once '../load_model.php';
$place = new BeanPlace();

if(isset($_POST["operation"]))
{
 if($_POST["operation"] == "Add")
 {
  $place->setPlaceNum($_POST['place_num']);
  $place->setPlaceParent($_POST['place_parent']);
  $place->setPlaceLib($_POST['place_lib']);
  $place->setPlaceCode($_POST['place_code']);
  $place->insert();
  echo 'Enregistrement reussi avec succès';
 }
else if($_POST["operation"] == "Edit")
 {

  $place->setPlaceNum($_POST['place_num']);
  $place->setPlaceParent($_POST['place_parent']);
  $place->setPlaceLib($_POST['place_lib']);
  $place->setPlaceCode($_POST['place_code']);
  $place->setPlaceId($_POST['place_id']);
  $place->updateCurrent();
  echo 'Modification reussie avec succès';
}

}
else
{
echo "operation existe pas";
}

?>
