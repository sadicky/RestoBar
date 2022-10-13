<?php
@session_start();
require_once '../load_model.php';
$personne = new BeanPersonne();
$personne->select($_POST["pers_id"]);


$output = array();
if(isset($_POST["pers_id"]))
{
  
  $output["nom"] = $personne->getNomComplet();
  $output["email"] = $personne->getEmail();
  $output["contact"] = $personne->getContact();
 }

$output['id'] = $_POST["pers_id"];
echo json_encode($output);
?>
