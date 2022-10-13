<?php

require_once '../load_model.php';
$aut = new BeanAutreFrais();
  $aut->delete($_POST['aut_id']);
  echo 'Suppression reussie avec succès';
?>
