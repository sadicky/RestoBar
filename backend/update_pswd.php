<?php
session_start();
require_once '../load_model.php';
$perso = new BeanPersonne();
$user = new BeanUsers();



if(isset($_POST['operation']))
{

  $user->select_2($_SESSION['perso_id']);
  $an_mp=$_POST['an_mp_ut'];
if($_POST['mp_ut']!=$_POST['conf_ut'])
{
echo 'Modification Impossible, Mot de passe non conformes ';
}
elseif(password_verify($an_mp, $user->getPassword()))
  {
  $user->update_one($_SESSION['perso_id'],'personne_id','password',password_hash($_POST['mp_ut'], PASSWORD_DEFAULT));
  echo 'Modification reussie avec succès';
  }
  else
  {
  echo 'Modification Impossible, ancien mot de passe incorrect ';

  }
}
else
{
echo "operation existe pas";
}

?>
