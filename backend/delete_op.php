<?php
@session_start();
require_once '../load_model.php';
$op = new BeanOperation();
if(isset($_POST['val_id']))
{
  $op->delete_one($_POST['table'],$_POST['val_id'],$_POST['id']);
  echo 'Suppression reussie avec succès';
}
else
{
echo " pas Id ";
}

?>
