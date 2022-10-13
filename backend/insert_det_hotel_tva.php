<?php

session_start();
require_once '../load_model.php';
$loc =new BeanLocationFact();

if(isset($_POST["op_id"]))
{
  $loc->select($_POST["op_id"]);
  $loc->update_one($_POST['op_id'],'op_id','loc_tva',$_POST['tva']);


echo 'Enregistrement reussi '.$_POST['tva'];
}
else
{
echo "operation existe pas";
}

?>
