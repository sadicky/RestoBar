<?php

require_once '../load_model.php';
$compo = new BeanComposition();

if(isset($_POST['compo_id']))
{
 $compo->delete($_POST['compo_id']);
}
?>
