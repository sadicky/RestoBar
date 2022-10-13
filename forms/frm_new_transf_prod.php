
<?php
require_once '../load_model.php';
$acc= new BeanAccounts();
$perso=new BeanPersonne();

?>
<div class="card card-info" >
                            <div class="card-header bg-light">Tranfert des Produits</div>
                            <div>
                                <div class="card-body">
                                    <form id="frm_new_vente" method="post">
                                        <div class="form-body">
<div class="form-row">
    <div class="col-md-6">
        <div class="form-group">
            <label class="control-label">Point de Vente</label>
            <select class="form-control" id="dest_pos" name="dest_pos" required>
                <option value="">Choisir</option>
                <?php
                $datas=$perso->select_all_by_role('pos');
                foreach($datas as $un)
                {

                    if(isset($_POST['pos']) and $un['personne_id']==$_POST['pos_id'])
                    {
                     echo '<option value="'.$un['personne_id'].'" selected>'.$un['nom_complet'].'</option>';
                    }
                    echo '<option value="'.$un['personne_id'].'">'.$un['nom_complet'].'</option>';

                }
                ?>
            </select>

        </div>
</div>

    <div class="col-md-6">
        <div class="form-group">
            <label class="control-label">Date</label>
            <input type="text" id="datepicker" name="date_v" class="form-control" value="<?php echo date("Y-m-d"); ?>" required>
        </div>
    </div>
    <div class="col-md-12" >
        <div class="form-group" style="bottom:0;">
            &nbsp;<br/>
            <input type="hidden" id="vente_id" name="vente_id" class="form-control" value="">
            <button id="action" data-id="Add" type="submit" class="btn btn-success" name="search"> <span class="fa fa-search"></span> Enregistrer</button>

            <!-- <button type="reset" class="btn btn-warning" > <span class="fa fa-search"></span> Nouveau</button> -->
        </div>
    </div>
</div>
</div>
</form>
                                </div>
                            </div>
                </div>
