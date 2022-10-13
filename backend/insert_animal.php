<?php

session_start();
require_once '../load_model.php';
$animal = new BeanAnimaux();



if(isset($_POST["operation"]))
{
 if($_POST["operation"] == "Add")
 {
  $animal->setAnimalName($_POST['animal_name']);
  $animal->insert();
  echo 'Enregistrement reussi avec succès';
 }
else if($_POST["operation"] == "Edit")
 {

  $animal->setAnimalName($_POST['animal_name']);
  $animal->setAnimalId($_POST['animal_id']);
  $animal->updateCurrent();
  echo 'Modification reussie avec succès';
}

}
else
{
echo "operation existe pas";
}

?>
