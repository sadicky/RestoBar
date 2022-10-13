<?php

require_once '../load_model.php';
$compo = new BeanComposition();

if(isset($_POST['compo_id']))
{
 $compo->update_one($_POST["compo_id"],'id_compo','qt',$_POST['qt']);
}
?>
