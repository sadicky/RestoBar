<?php

require_once '../load_model.php';
$personne = new BeanPersonne();
$info=new BeanInfoSuppl();

if(isset($_POST["contact"]))
{
  $info->select_tel($_POST["contact"]);
  $personne->select($info->getPersonneId());
  $info->select($info->getPersonneId());
}
elseif(isset($_POST["cni"])) 
{
$info->select_cni($_POST["cni"]);
$personne->select($info->getPersonneId());
$info->select($info->getPersonneId());
}
elseif(isset($_POST["person_id"])) 
{
$personne->select($_POST["person_id"]);
$info->select($_POST["person_id"]);
}
else
{
$info->select_tel($_POST["contact"]);
$personne->select($info->getPersonneId());
  $info->select($info->getPersonneId());
}


$output = array();

  $output["nom"] = $personne->getNomComplet();
  $output["genre"] = $personne->getGenre();
  $output["contact"] = $personne->getContact();
  $output["email"] = $personne->getEmail();

  $output["cni"] = $info->getCni();
  $output["nat"] = $info->getNat();
  $output['id'] = $info->getPersonneId();
 


echo json_encode($output);


?>
