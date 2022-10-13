<?php

require_once '../load_model.php';
$jour = new BeanJournal();

if(isset($_POST['jour_id']))
{
 $jour->update_one($_POST["jour_id"],'jour_id','final_bal',$_POST['cont']);
}
?>
