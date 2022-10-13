<?php

session_start();
require_once '../load_model.php';
$perso = new BeanPersonne();
$serv = new BeanServeur();

if(isset($_POST['operation']))
{
 if($_POST['operation'] == "Add")
 {
  $perso->setRole('5');
  $perso->setNomComplet($_POST['nom']);
  $perso->setContact($_POST['serv_code']);
  $perso->setGenre("-");
  $perso->setemail("-");
  $perso->insert();

  echo 'Enregistrement reussi avec succès ';

 }
else if($_POST["operation"] == "Edit")
 {

  $perso->setRole('5');
  $perso->setNomComplet($_POST['nom']);
  $perso->setContact($_POST['serv_code']);
  $perso->setGenre("");
  $perso->setemail('-');
  $perso->setPersonneId($_POST['personne_id']);

  $perso->updateCurrent();
  $serv->update_one($_POST['personne_id'],'personne_id','serv_code',$_POST['serv_code']);
  $serv->update_one($_POST['personne_id'],'personne_id','serv_name',$_POST['nom']);
  echo 'Modification reussie avec succès';
}
}
else
{
echo "operation existe pas";
}

?>
