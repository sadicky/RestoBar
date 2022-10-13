<?php

session_start();
require_once '../load_model.php';
$perso = new BeanPersonne();
$suppl=new BeanInfoSuppl();
$info=new BeanInfoSuppl();
$cust=new BeanCustomer();

  $perso->setRole('4');
  $perso->setNomComplet($_POST['nom_ut']);
  $perso->setContact($_POST['tel_ut']);
  $perso->setGenre($_POST['sexe']);
  $perso->setemail($_POST['email_ut']);
  $last=$perso->insert();

  $suppl->setNat($_POST['nat']);
  $suppl->setCni($_POST['cni']);
  $suppl->setPersonneId($last);
  $suppl->insert();

  $cust->update_one($last,'personne_id','actif','1');

$perso->select($last);
$info->select($last);

  $output = array();

  $output["nom"] = $perso->getNomComplet();
  $output["genre"] = $perso->getGenre();
  $output["contact"] = $perso->getContact();
  $output["email"] = $perso->getEmail();

  $output["cni"] = $info->getCni();
  $output["nat"] = $info->getNat();
  $output['id'] = $info->getPersonneId();
  $output['msg'] = 'Enregistrement reussi avec succès';

echo json_encode($output);
?>
