<?php

require_once '../load_model.php';
$tab = new BeanTabl();

if(isset($_POST['table_id']))
{
  $tab->delete($_POST['table_id']);
  echo 'Suppression reussie avec succès';
}
else
{
echo " pas Id ";
}

?>
