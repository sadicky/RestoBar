<?php

require_once '../load_model.php';
$size = new BeanProdSize();

if(isset($_POST["size_id"]))
{
  $size->delete($_POST['size_id']);
  echo 'Suppession réussie avec succès';
}
else
{
echo " pas Id";
}

?>
