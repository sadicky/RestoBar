<?php

session_start();
require_once '../load_model.php';
$table = new BeanTabl();

if(isset($_POST["operation"]))
{
 if($_POST["operation"] == "Add")
 {
  $table->setTableNum($_POST['table_num']);
  $table->setTableParent($_POST['table_parent']);
  $table->insert();
  echo 'Enregistrement reussi avec succès';
 }
else if($_POST["operation"] == "Edit")
 {

  $table->setTableNum($_POST['table_num']);
  $table->setTableParent($_POST['table_parent']);
  $table->setTableId($_POST['table_id']);
  $table->updateCurrent();
  echo 'Modification reussie avec succès';
}

}
else
{
echo "operation existe pas";
}

?>
