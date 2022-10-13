<?php

require_once '../load_model.php';
$chamb = new BeanPlace();
$loc = new BeanLocation();
$op = new BeanOperation();

if(isset($_POST['loc_id']))
{
  $loc->select($_POST['loc_id']);
  
  $to_day=date('Y-m-d');
  $loc->update_one($_POST['loc_id'],'loc_id','loc_etat','0');
  $loc->update_one($_POST['loc_id'],'loc_id','to_d',$to_day);
  $chamb->update_one($_POST['chamb_id'],'place_id','status','1');

  echo 'Libération de la chambre reussie avec succès ';
  
}
else
{
echo " pas Id ";
}

?>
