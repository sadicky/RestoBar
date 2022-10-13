<?php

require_once '../load_model.php';
$personne = new BeanPersonne();
$info=new BeanInfoSuppl();
$sup=new BeanSupplier();
$personne->select($_POST["personne_id"]);
$info->select($_POST["personne_id"]);

$user = new BeanUsers();
$user->select_2($_POST["personne_id"]);
$sup->select($_POST["personne_id"]);

$output = array();
if(isset($_POST["personne_id"]))
{
  $output["nom"] = $personne->getNomComplet();
  $output["genre"] = $personne->getGenre();
  $output["contact"] = $personne->getContact();
  $output["email"] = $personne->getEmail();

  $output["type_user"] = $user->getTypeUser();
  $output["pos_id"] = $user->getPosId();
  $output["level_user"] = $user->getLevelUser();
  $output["pseudo"] = $user->getUsername();

  $output["cni"] = $info->getCni();
  $output["nat"] = $info->getNat();

  $output["sup_code"] = $sup->getSupCode();
  $output["sup_nif"] = $sup->getSupNif();
  $output["sup_nat"] = $sup->getSupNat();
  $output["sup_contact"] = $sup->getSupContact();

 }
$output['id'] = $_POST["personne_id"];

echo json_encode($output);


?>
