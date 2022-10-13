<?php

require_once '../load_model.php';
$per = new BeanPeriode();

if(isset($_POST['id_per']))
{
  
  $per->delete($_POST['id_per']);
  echo 'Suppression reussie avec succès';
  
}
else
{
echo " pas Id ";
}

?>
