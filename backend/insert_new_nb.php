<?php

session_start();
require_once '../load_model.php';
$place = new BeanPlace();
$place2= new BeanPlace();

$place2->select_2($_POST['parent_id']);

  $place->setPlaceNum($place2->getPlaceCode().'-'.$place->nb($_POST['parent_id']));
  $place->setPlaceParent($_POST['parent_id']);
  $place->setPlaceLib('');
  $place->setPlaceCode('');
  $place->insert();
  
?>
