<?php
session_start();
require_once '../load_model.php';
$det = new BeanDetailsOperation();
$prod = new BeanProducts();
$det->select($_POST["det_id"]);

$output = array();
if(isset($_POST["det_id"]))
{

$prod->select($det->getProdId());
$output["prod_appro"]=$prod->getProdName();
$output["prod_prix"]=$det->getAmount();
$output["prod_id"]=$det->getProdId();
$output["prod_qt"]=$det->getQuantity();
$output["poids"]=$det->getDet();
$output["lot"]=$det->getLot();
$output["date_exp"]=$det->getDateExp();
$output["year"]=date('Y', strtotime($det->getDateExp()));
$output["month"]=date('m', strtotime($det->getDateExp()));

 }

echo json_encode($output);


?>
