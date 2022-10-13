<?php

require_once '../load_model.php';
$acc = new BeanAccounts();

if(isset($_POST['acc_id']))
{
  if($_POST['status']=='0')
  {
  $acc->update_one($_POST['acc_id'],'acc_id','status',false);
  echo 'Suppression reussie avec succès';
  }
  elseif($_POST['status']=='1')
  {
   $acc->update_one($_POST['acc_id'],'acc_id','status',true);
   echo 'Restauration reussie avec succès';
  }


}
else
{
echo " pas Id ";
}

?>
