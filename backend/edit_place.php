<?php

require_once '../load_model.php';
$pl = new BeanPlace();

if(isset($_POST['place_id']))
{
 $pl->update_one($_POST["place_id"],'place_id',$_POST['field'],$_POST['val']);
 //echo 'modification reussie';
}
?>
