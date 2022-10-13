<?php

session_start();
require_once '../load_model.php';
$size = new BeanProdSize();


if(isset($_POST["operation_size"]))
{
 if($_POST["operation_size"] == "Add_size")
 {
  $size->setProdSizeName($_POST['prod_size_name']);
  $size->insert();
  echo 'Enregistrement reussi avec succès';
 }
else if($_POST["operation_size"] == "Edit_size")
 {
  $size->setProdSizeName($_POST['prod_size_name']);
  $size->setProdSizeId($_POST['prod_size_id']);
  $size->updateCurrent();

  echo 'Modification reussie avec succès';
  }
}
else
{
echo "operation existe pas";
}

?>
