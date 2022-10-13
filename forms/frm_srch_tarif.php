<?php
@session_start();
require_once '../load_model.php';
$pers=new BeanPersonne();
$cat=new BeanCategory();
?>
<div class="form-row">
<div class="col-md-3">
        <div class="form-group">
            <label class="control-label">Tarif</label>
            <select class="form-control" id="srch_tarif_vente" name="tarif" required>
            <option value="">Choisir</option>
                <?php
                  $datas=$pers->select_all_role('assureur');
                       foreach ($datas as $value) {
                      echo '<option value="'.$value['personne_id'].'">'.$value['nom_complet'].'</option>';
                }
            ?>
            <!-- <option value="tous">Tous</option> -->
        </select>

        </div>
    </div>
</div>
<hr>
<div id="disp_tarif_vente">
</div>
