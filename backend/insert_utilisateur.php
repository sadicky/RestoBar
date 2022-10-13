<?php

session_start();
require_once '../load_model.php';
$perso = new BeanPersonne();
$user = new BeanUsers();



if(isset($_POST['operation']))
{
 if($_POST['operation'] == "Add")
 {
  $perso->setRole('3');
  $perso->setNomComplet($_POST['nom_ut']);
  $perso->setGenre($_POST['sexe_ut']);
  $perso->setContact($_POST['tel_ut']);
  $perso->setEmail($_POST['email_ut']);

  $last=$perso->insert();

  $user->setUsername($_POST['pseudo_ut']);
  $user->setPassword($_POST['mp_ut']);
  $user->setPersonneId($last);
  $user->setTypeUser($_POST['type_ut']);
  $user->setLevelUser($_POST['level_user']);
  $user->setPosId($_POST['pos_id']);
  $user->setActif(true);

 // $user->insert();
  if($user->insert())
  {
  echo 'Enregistrement reussi avec succès ';
  }
  else
  {
    echo 'xxxx';
  }
 }
else if($_POST["operation"] == "Edit")
 {

  $perso->setRole('3');
  $perso->setNomComplet($_POST['nom_ut']);
  $perso->setGenre($_POST['sexe_ut']);
  $perso->setContact($_POST['tel_ut']);
  $perso->setEmail($_POST['email_ut']);
  $perso->setPersonneId($_POST['personne_id']);

  $perso->updateCurrent();
  $perso->update_one($_POST["personne_id"],'personne_id','last_update',date('Y-m-d h:i:s'));

  echo 'Modification reussie avec succès';

  $user->update_one($_POST['personne_id'],'personne_id','type_user',$_POST['type_ut']);
  $user->update_one($_POST['personne_id'],'personne_id','level_user',$_POST['level_user']);
  $user->update_one($_POST['personne_id'],'personne_id','pos_id',$_POST['pos_id']);
  $user->update_one($_POST['personne_id'],'personne_id','username',$_POST['pseudo_ut']);
  if(!empty($_POST['mp_ut']))
  $user->update_one($_POST['personne_id'],'personne_id','password',$_POST['mp_ut']);

}
else if($_POST["operation"] == "Edit_con")
 {

  $user->select($_POST['personne_id']);
  $an_mp=$_POST['an_mp_ut'];

if($an_mp==$user->getPassword())
  {
   $user->update_one($_POST['personne_id'],'personne_id','username',$_POST['pseudo_ut']);
  $user->update_one($_POST['personne_id'],'personne_id','password',$_POST['mp_ut']);
  echo 'Modification reussie avec succès';
  }
  else
  {
  echo 'Modification Impossible, ancien mot de passe incorrect ';

  }
}

}
else
{
echo "operation existe pas";
}

?>
