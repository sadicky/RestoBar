<?php

require_once '../load_model.php';
$loc = new BeanLocation();
$chamb=new BeanChambre();

if(isset($_POST['chamb_id']))
{
  
  $chamb->delete($_POST['chamb_id']);
  echo 'Suppression reussie';
}
else
{
echo " pas Id ";
}

?>
