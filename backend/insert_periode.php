<?php
@session_start();
require_once '../load_model.php';
$per = new BeanPeriode();

if(isset($_POST["operation"]))
{
 if($_POST["operation"] == "Add")
 {
  $per->setDebut($_POST['debut']);
  //$per->setFin($_POST['fin']);
  $per->setCodePer($_POST['lib']);
  $per->setCrt($_POST['enc']);

  if($_POST['enc']=='1')
  {
    $per->update_2(false);
  }
  $per->insert();
  echo 'Enregistrement reussi avec succès';
 }
else if($_POST["operation"] == "Edit")
 {
  $per->setDebut($_POST['debut']);
  //$per->setFin($_POST['fin']);
  $per->setCodePer($_POST['lib']);
  $per->setCrt($_POST['enc']);

  if($_POST['enc']=='1')
  {
    $per->update_2(false);
  }

  $per->update($_POST['idmod']);
  echo 'Modification reussie avec succès';
  unset($_GET['id']);
}

}
else
{
echo "operation existe pas";
}
?>
