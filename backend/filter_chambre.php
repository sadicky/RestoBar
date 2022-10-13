<?php
@session_start();
require_once '../load_model.php';
$chamb = new BeanPlace();
$pr = new BeanPlace();
?>
<option value="">Choisir Chambre ou salle</option>
                <?php
                $datas=$chamb->select_all_parent($_POST['cat']);
                foreach ($datas as $key => $un) {
                    echo '<option value="'.$un['place_id'].'">'.$un['place_num'].'</option>';
                    }
                ?>