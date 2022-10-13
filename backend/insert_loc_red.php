<?php

session_start();
require_once '../load_model.php';
$loc =new BeanLocation();
$op = new BeanOperation();



if(isset($_POST["op_id"]))
{
  
  if($_POST['type_red']=='1')
  {
    $red=$_POST['tot']*($_POST['red']/100);
  }
  else
  {
    $red=$_POST['red'];
  }

  $loc->update_one($_POST['op_id'],'op_id','loc_red',$red);

echo 'Réduction accordée ';
}
else
{
echo "operation existe pas";
}

?>
