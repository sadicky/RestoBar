<?php

require_once '../load_model.php';
$animal = new BeanAnimaux();
$animal->select($_POST["animal_id"]);

$output = array();
if(isset($_POST["animal_id"]))
{
  $output["animal_name"] = $animal->getAnimalName();
 }
$output['id'] = $_POST["animal_id"];

echo json_encode($output);


?>
