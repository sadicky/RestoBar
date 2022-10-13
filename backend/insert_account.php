 <?php

session_start();
require_once '../load_model.php';
$acc = new BeanAccounts();



if(isset($_POST["acc_num"]))
{
 if($_POST["operation"] == "Add")
 {

  $nb_acc=$acc->exist_acc($_POST['acc_num']);
  $nb_perso=$acc->exist_acc_perso($_POST['personne_id']);

  if($nb_perso['nb']!=0)
  {
    echo 'Tu as déjà un compte';
  }
  elseif($nb_acc['nb']!=0)
  {
    echo 'Compte existant déjà ';
  }
  else
  {
  $acc->setBalAdv('0');
  $acc->setBalCash('0');
  $acc->setLastUpdate(date("Y-m-d"));
  $acc->setUpdatedBy('1');
  $acc->setCreatedDate(date("Y-m-d"));
  $acc->setPersonneId($_POST['personne_id']);
  $acc->setAccNum($_POST['acc_num']);
  $acc->setStatus(true);
  $acc->insert();
  echo 'Enregistrement reussi avec succès';
}
 }
else if($_POST["operation"] == "Edit")
 {
  $acc->update_one($_POST['acc_id'],'acc_num',$_POST['acc_num']);
  echo 'Modification reussie avec succès';
}

}
else
{
echo "operation existe pas";
}

?>
