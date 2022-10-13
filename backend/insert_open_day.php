<?php
@session_start();
require_once '../load_model.php';
$jour = new BeanJournal();

$jour->setPersonneId($_SESSION['perso_id']);
$jour->setOpenBal('0');
$jour->setStartDate($_POST['open_date'].' h:i:s');
$_SESSION['jour']=$jour->insert();
?>
