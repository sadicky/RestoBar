<?php

require_once '../load_model.php';
$det = new BeanDetailsOperation();

if(isset($_POST['det_id']))
{
 $det->update_one($_POST["det_id"],'details_id','lot',$_POST['val']);
}
?>
