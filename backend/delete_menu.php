<?php
@session_start();
require_once '../load_model.php';
$mn = new BeanMenu();


if(isset($_POST["menu_id"]))
{
  $mn->delete($_POST['menu_id']);
  echo 'Suppression reussie avec succès';
}
else
{
echo " pas Id";
}

?>
