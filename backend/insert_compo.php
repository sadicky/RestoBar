<?php
@session_start();
require_once '../load_model.php';
$compo=new BeanComposition();

if(isset($_SESSION['plat_compo']))
{
$compo->setIngred($_POST['ingr']);
$compo->setProdId($_SESSION['plat_compo']);
$compo->setQt($_POST['unt']);
$compo->insert();
}
?>
