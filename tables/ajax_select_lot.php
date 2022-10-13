<?php
require_once '../load_model.php';
$check= new BeanCheckExp();

$list=$check->select_all($_POST['prod_id'],'1');

foreach ($list as $un) {
echo '<option value="'.$un['id'].'">'.$un['lot'].'/'.$un['date_exp'].'</option>';
}
?>
