<?php

require_once '../load_model.php';
$user = new BeanUsers();
$sup = new BeanSupplier();
$cust = new BeanCustomer();
$ass = new BeanServeur();
$pers=new BeanPersonne();

if(isset($_POST['person_id']))
{
  /*if($_POST['status']=='0')
  {
  $user->update_one($_POST['person_id'],'personne_id','actif',false);
  $sup->update_one($_POST['person_id'],'personne_id','actif',false);
  $cust->update_one($_POST['person_id'],'personne_id','actif',false);
  $ass->update_one($_POST['person_id'],'personne_id','actif',false);
  echo 'Suppression reussie avec succès';
  }
  elseif($_POST['status']=='1')
  {
   $user->update_one($_POST['person_id'],'personne_id','actif',true);
   $sup->update_one($_POST['person_id'],'personne_id','actif',true);
   $cust->update_one($_POST['person_id'],'personne_id','actif',true);
   $ass->update_one($_POST['person_id'],'personne_id','actif',true);
   echo 'Restauration reussie avec succès';
  }*/
$pers->delete($_POST['person_id']);
echo 'Suppression reussie avec succès';
}
else
{
echo " pas Id ";
}

?>
