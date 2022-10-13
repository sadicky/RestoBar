<?php
@session_start();
require_once '../load_model.php';
$cat= new BeanCategory();
$prod=new BeanProducts();

if(empty($_POST['rech']))
{
$rech='-';
}
else
{
$rech=$_POST['rech'];
}

$datas=$prod->select_all_2($rech,'1');
echo '<select class="form-control select2" id="lib_mp_rap" name="mp" required>';
foreach ($datas as $key) {
  echo '<option value="'.$key['prod_id'].'">'.$key['prod_name'].'</option>';
}
echo '</select>';
?>
