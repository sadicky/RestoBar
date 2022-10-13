<?php
@session_start();
require_once '../load_model.php';
$vente = new BeanVente();
$op = new BeanOperation();
$op->select($_SESSION['op_vente_id']);
$vente->select($_SESSION['op_vente_id']);
?>
<option value="">Choisir table</option>
                <?php
                $datas=$tabl->select_all_tab($_POST['place']);
                foreach ($datas as $key => $un) {
                    if($un['table_id']==$vente->getPlace())
                     echo '<option value="'.$un['table_id'].'" selected>'.$un['table_num'].'</option>';  
                    else
                    { 
                    if($un['table_parent']<>0 and !$vente->exist_table($un['table_id']))
                    echo '<option value="'.$un['table_id'].'">'.$un['table_num'].'</option>';
                    }
                }
                ?>