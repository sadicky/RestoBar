<?php

session_start();
require_once '../load_model.php';
$pers = new BeanPersonne();
$sup = new BeanSupplier();

if(isset($_POST['operation']))
{
if($_POST['operation']=="Add")
 {
  if($sup->exist_code($_POST['sup_code']))
  {
    echo 'Le code exist déjà';
  }
 else
 {
  $pers->setRole('1');
  $pers->setNomComplet($_POST['nom']);
  $pers->setContact($_POST['tel']);
  $pers->setEmail('-');
  $pers->setGenre('-');
  $last=$pers->insert();
  
  $sup->update_one($last,'personne_id','sup_code',$_POST['sup_code']);
  echo 'Enregistrement reussi avec succès ';
    }
 }
else if($_POST["operation"] == "Edit")
 {
  $sup->select($_POST['personne_id']);

  if($sup->exist_code($_POST['sup_code']) and $_POST['sup_code']!=$sup->getSupCode())
  {
    echo 'Le code exist déjà';
  }
  else
  {
  $pers->setRole('1');
  $pers->setNomComplet($_POST['nom']);
  $pers->setContact($_POST['tel']);
  $pers->setGenre("-");
  $pers->setemail('-');
  $pers->setPersonneId($_POST['personne_id']);
  $pers->updateCurrent();

  echo 'Modification reussie avec succès';
  $sup->update_one($_POST["personne_id"],'personne_id','sup_code',$_POST['sup_code']);
  }
}
}
else
{
echo "operation existe pas";
}

?>
