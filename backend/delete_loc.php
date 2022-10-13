<?php

require_once '../load_model.php';
$loc = new BeanLocation();
$chamb=new BeanChambre();

if(isset($_POST['loc_id']))
{
  
  $loc->delete($_POST['loc_id']);
  echo 'Suppression reussie avec succès';
  $chamb->update_one($_POST['chamb_id'],'chamb_id','chamb_etat','1');
}
else
{
echo " pas Id ";
}

?>
