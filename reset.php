<?php
require_once("load_model.php");
$reset = new BeanUsers();

$reset->reset_table("operation");
$reset->reset_table("transactions");
$reset->reset_table("vente");
$reset->reset_table("achats");
$reset->reset_table("paiement");
$reset->reset_table("sortie_matp");
$reset->reset_table("stock");
$reset->reset_table("details_operation");

echo '<p style="color:blue">The DataBase is reset</p>';
?>
