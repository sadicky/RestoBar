<?php
@session_start();
require_once '../load_model.php';
$typ = new BeanTypeDep();

if(isset($_POST["operation"]))
{
 if($_POST["operation"] == "Add")
 {
  $typ->setLibTyp($_POST['lib_typ']);
  $typ->insert();
  echo 'Enregistrement reussi avec succès';
 }
else if($_POST["operation"] == "Edit")
 {
  $typ->setLibTyp($_POST['lib_typ']);
  $typ->update($_POST['idmod']);
  echo 'Modification reussie avec succès';
  unset($_GET['id']);
}
}
else
{
echo "operation existe pas";
}
?>
