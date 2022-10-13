<?php

session_start();
require_once '../load_model.php';
$vente =new BeanVente();

if(isset($_POST["op_id"]))
{
  $vente->select($_POST["op_id"]);
  $vente->update_one($_POST['op_id'],'op_id','tva',$_POST['tva']);


echo 'Enregistrement reussi '.$_POST['tva'];
}
else
{
echo "operation existe pas";
}

?>
