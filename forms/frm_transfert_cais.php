<?php session_start(); ?>
<?php
require_once '../load_model.php';
$acc= new BeanAccounts();
$datas=$acc->select_all_role('users');
?>
<div class="card card-info" >
                            <div class="card-header bg-light">Retrait de fonds en Caisse</div>
                            <div >
                                <div class="card-body">
<form method="post" id="frm_transf_cpt" enctype="multipart/form-data">
<div class="form-body">
<div class="form-row">
    <div class="col-md-3">
        <div class="form-group">
            <label class="control-label">Utilisateur (Caisse/Source)</label>
            <select class="form-control" id="acc_num_ret" name="acc_num_ret" required>
                <option value="">Choisir</option>
                <?php
                foreach($datas as $un)
                {
                    //$perso->select($un['personne_id']);
                    if(isset($_POST['acc_num_ret']) and $un['acc_id']==$_POST['acc_num_ret'])
                    {
                     echo '<option value="'.$un['acc_id'].'" selected>'.$un['nom_complet'].'</option>';
                    }
                    echo '<option value="'.$un['acc_id'].'">'.$un['nom_complet'].'</option>';
                }
                ?>
            </select>

        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <label class="control-label">Utilisateur (Caisse/Destination)</label>
            <select class="form-control" id="acc_num_alim" name="acc_num_alim" required>
                <option value="">Choisir</option>
                <?php
                foreach($datas as $un)
                {
                    //$perso->select($un['personne_id']);
                    if(isset($_POST['acc_num_ret']) and $un['acc_id']==$_POST['acc_num_ret'])
                    {
                     echo '<option value="'.$un['acc_id'].'" selected>'.$un['nom_complet'].'</option>';
                    }
                    echo '<option value="'.$un['acc_id'].'">'.$un['nom_complet'].'</option>';
                }
                ?>
            </select>

        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <label class="control-label">Montant</label>
            <input type="number" id="mont_trans" name="mont_trans" class="form-control"  value="" required>
            <input type="hidden" name="hidden_mont" id="hidden_mont" value="" class="form-control">
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <label class="control-label">Date</label>
            <input type="text" id="date_trans" name="date_trans" class="form-control"  value="<?php echo date("Y-m-d"); ?>" required>
        </div>
    </div>

</div>
</div>
<div class="form-actions">
<input type="hidden" name="trans_id" id="trans_id" />
<input type="hidden" name="operation" id="operation" value="Add" />

<button id="action" data-id="Add" type="submit" class="btn btn-success" name="action"> <i class="fa fa-check"></i><span id="lab_action">Enregistrer</span></button>

<button type="reset" class="btn btn-default" id="reset_act">Annuler</button>
</div>
</form>
</div>
</div>
</div>

<div id="trans_transf_tab">
</div>
