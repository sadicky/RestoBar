
<?php
require_once '../load_model.php';
$acc= new BeanAccounts();
$perso=new BeanPersonne();
$prod=new BeanProducts();

?>
<div class="card card-info" >
                            <div class="card-header bg-light">Invataire valorisé</div>
                            <div >
                                <div class="card-body">
                                    <form id="frm_search_rap_inv_valo" method="post">
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
    <div class="col-md-2" >
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
<div class="alert alert-info" style="background-color: white;" id="tab_rap_inv_valo">

</div>
</div>
</section>
