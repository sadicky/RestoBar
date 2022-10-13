<?php
session_start();
require_once '../load_model.php';
$trans = new BeanTransactions();
$trans->select($_POST["trans_id"]);

if(isset($_POST["trans_id"]))
{
  $output = array();
  $output["mont_trans"] = $trans->getAmount();
  $output["comment_trans"] = $trans->getDescript();




 }
echo json_encode($output);
//echo $trans->getAmount();

?>
