<?php

require_once '../load_model.php';
$check = new BeanCheckExp();

if(isset($_POST['id']))
{
 $check->update_one($_POST["id"],'id','date_exp',$_POST['date_exp']);
}
?>
