<?php

require_once '../load_model.php';
$loc = new BeanLocation();

if(isset($_POST['loc_id']))
{
 $loc->update_one($_POST["loc_id"],'loc_id',$_POST['field'],$_POST['val']);
 //echo 'modification reussie';
}
?>
