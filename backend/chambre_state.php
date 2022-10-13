<?php

require_once '../load_model.php';
$chamb = new BeanChambre();
$loc = new BeanLocation();
$op = new BeanOperation();

if(isset($_POST['loc_id']))
{
  $loc->select($_POST['loc_id']);
  if($_POST['status']=='0')
  {

  $to_day=date('Y-m-d');
  $loc->update_one($_POST['loc_id'],'loc_id','loc_etat','0');
  $loc->update_one($_POST['loc_id'],'op_id','to_d',$to_day);
  $chamb->update_one($loc->getChambId(),'chamb_id','chamb_etat','1');

  echo 'Libération de la chambre reussie avec succès';
  }
  elseif($_POST['status']=='1')
  {
   $chamb->update_one($loc->getChambId(),'chamb_id','chamb_etat','0');
   $loc->update_one($_POST['loc_id'],'loc_id','loc_type','1');
   echo 'Location activée avec succès';
  }
}
else
{
echo " pas Id ";
}

?>
