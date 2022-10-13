<?php
@session_start();
require_once '../load_model.php';
$tar = new BeanTarif();

if(isset($_POST["operation"]))
{
 if($_POST["operation"] == "Add")
 {
  $tar->setTarName($_POST['tar_name']);
  $tar->setTarCode($_POST['tar_code']);
  $tar->setStatus($_POST['status']);
  $tar->setIsStock($_POST['is_stock']);

  if($_POST['status']=='1')
  {
    $tar->update_2('Non');
  }
  $tar->insert();
  echo 'Enregistrement reussi avec succès';
 }
else if($_POST["operation"] == "Edit")
 {
  $tar->setTarName($_POST['tar_name']);
  $tar->setTarCode($_POST['tar_code']);
  $tar->setStatus($_POST['status']);
  $tar->setIsStock($_POST['is_stock']);

  if($_POST['status']=='1')
  {
    $tar->update_2('Non');
  }

  $tar->update($_POST['tar_id']);
  echo 'Modification reussie avec succès';
  unset($_GET['id']);
}

}
else
{
echo "operation existe pas";
}
?>
