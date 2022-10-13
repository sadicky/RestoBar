<?php
@session_start();
require_once '../load_model.php';
$pos = new BeanPos();

if(isset($_POST["operation"]))
{
 if($_POST["operation"] == "Add")
 {
  $pos->setPosName($_POST['pos_name']);
  $pos->setPosCode($_POST['pos_code']);
  $pos->setStatus($_POST['status']);

  if($_POST['status']=='1')
  {
    $pos->update_2('Non');
  }
  $pos->insert();
  echo 'Enregistrement reussi avec succès';
 }
else if($_POST["operation"] == "Edit")
 {
  $pos->setPosName($_POST['pos_name']);
  $pos->setPosCode($_POST['pos_code']);
  $pos->setStatus($_POST['status']);

  if($_POST['status']=='1')
  {
    $pos->update_2('Non');
  }

  $pos->update($_POST['pos_id']);
  echo 'Modification reussie avec succès';
  unset($_GET['id']);
}

}
else
{
echo "operation existe pas";
}
?>
