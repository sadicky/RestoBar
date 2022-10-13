<?php

require_once '../load_model.php';
$info = new BeanInfoSuppl();
$nb=$info->select_exist_mat($_POST['mat']);

echo $nb;
?>
