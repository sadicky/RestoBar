<?php

session_start();
require_once '../load_model.php';
$perso = new BeanPersonne();
$suppl=new BeanInfoSuppl();
$cust=new BeanCustomer();

if(isset($_POST['nom_ut']))
{
 if($_POST['operation'] == "Add")
 {
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

  $cust->update_one($last,'personne_id','actif','2');
  echo 'Enregistrement reussi avec succès ';

 }
else if($_POST["operation"] == "Edit")
 {

  $perso->setRole('4');
  $perso->setNomComplet($_POST['nom_ut']);
  $perso->setContact($_POST['tel_ut']);
  $perso->setGenre($_POST['sexe']);
  $perso->setemail($_POST['email_ut']);
  $perso->setPersonneId($_POST['personne_id']);

  $nb=$suppl->select($_POST['personne_id']);
  if($nb!=0)
  {
  $suppl->setNat($_POST['nat']);
  $suppl->setCni($_POST['cni']);
  $suppl->setPersonneId($_POST['personne_id']);
  $suppl->updateCurrent();
  }
  else
  {
  $suppl->setNat($_POST['nat']);
  $suppl->setCni($_POST['cni']);
  $suppl->setPersonneId($_POST['personne_id']);
  $suppl->insert();
  }

  $perso->updateCurrent();

  echo 'Modification reussie avec succès';
  $perso->update_one($_POST["personne_id"],'personne_id','last_update',date('Y-m-d h:i:s'));
}
}
else
{
echo "operation existe pas";
}

?>
