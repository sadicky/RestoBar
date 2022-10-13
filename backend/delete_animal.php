<?php

require_once '../load_model.php';
$animal = new BeanAnimaux();

if(isset($_POST["animal_id"]))
{
  $animal->delete($_POST['animal_id']);
  echo 'Suppression reussie avec succès';
}
else
{
echo " pas Id";
}

?>
