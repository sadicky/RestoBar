<?php
@session_start();
require_once '../load_model.php';
$jour = new BeanJournal();

$jour->setClosingBal($_POST['closing_balance']);
$jour->update($_SESSION['perso_id']);
unset($_SESSION['jour']);
?>
