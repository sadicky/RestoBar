<?php
require_once '../load_model.php';
$vente = new BeanVente();
$nb=$vente->exist_table($_POST['tab']);
//echo $nb;
$output = array();
$output['nb'] = $nb;
$vente->select_tab($_POST['tab']);
$output['serv_id'] = $vente->getAssId();
echo json_encode($output);
?>
