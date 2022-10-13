<?php
@session_start();
require_once("../load_model.php");
$acc = new BeanAccounts();
$acc->select_acc_perso($_SESSION['perso_id']);
?>
<div class="alert alert-info text-center">
  Balance Crédit : <b><?php echo number_format($acc->getBalCash(),'1','.',','); ?></b>
 </div>
