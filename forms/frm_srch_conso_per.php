
<?php
require_once '../load_model.php';
$acc= new BeanAccounts();
$perso=new BeanPersonne();
$datas=$acc->select_all_role('supplier');
?>
<div class="card card-info" >
                            <div class="card-header bg-light">Situation périodique</div>
                            <div >
                                <div class="card-body">
                                    <form id="frm_search_conso_per" method="post">
                                        <div class="form-body">
<div class="form-row">
    <div class="col-md-3">
        <div class="form-group">
            <label class="control-label">Point de vente</label>
            <select class="form-control" id="pos_rap" name="pos">
            <option value="">Choisir</option>
                <?php
                  $datas=$perso->select_all_role('pos');
                       foreach ($datas as $value) {
                      echo '<option value="'.$value['personne_id'].'">'.$value['nom_complet'].'</option>';
                }
            ?>
        </select>

        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <label class="control-label">Du : </label>
            <input type="text" id="datepicker" name="from" class="form-control" value="<?php echo date("Y-m-d"); ?>" required>
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <label class="control-label">Au : </label>
            <input type="text" id="datepicker2" name="to" class="form-control" value="<?php echo date("Y-m-d"); ?>" required>
        </div>
    </div>
    <div class="col-md-3" >
        <div class="form-group" style="bottom:0;">
            &nbsp;<br/>
            <button id="action" data-id="Add" type="submit" class="btn btn-success" name="search"> <span class="fa fa-search"></span> Recherche</button>
        </div>
    </div>
</div>
</div>
</form>
                                </div>
                            </div>
                </div>

<section class="row">
<div class="col-lg-12" >
<div class="alert alert-info" style="background-color: white;" id="tab_conso_per">

</div>
</div>
</section>
