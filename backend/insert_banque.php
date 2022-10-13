<?php
@session_start();
require_once '../load_model.php';
$bq = new BeanBanque();

if(isset($_POST["operation"]))
{
 if($_POST["operation"] == "Add")
 {
  $bq->setLibBq($_POST['lib_bq']);
  $bq->setStatus($_POST['status']);
  $bq->insert();

  if($_POST['status']=='1')
  {
    $bq->update_2('Non');
  }
  echo 'Enregistrement reussi avec succès';
 }
else if($_POST["operation"] == "Edit")
 {
  $bq->setLibBq($_POST['lib_bq']);
  $bq->setStatus($_POST['status']);

  if($_POST['status']=='1')
  {
    $bq->update_2('Non');
  }

  $bq->update($_POST['idmod']);
  echo 'Modification reussie avec succès';
  unset($_GET['id']);
}
}
else
{
echo "operation existe pas";
}
?>
