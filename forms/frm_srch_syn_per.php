
<?php
@session_start();
require_once '../load_model.php';
$acc= new BeanAccounts();
$perso=new BeanPersonne();
$datas=$acc->select_all_role('supplier');
?>
<div class="card card-info" >
                            <div class="card-header bg-light">Statistique de vente</div>
                            <div >
                                <div class="card-body">
                                    <form id="frm_search_syn_per" method="post">
                                        <div class="form-body">
<div class="form-row">
            <input type="hidden" name="stock" id="gros" value="0">
            <input type="hidden" name="stock" id="det" value="1">
<div class="col-md-3">
        <div class="form-group">
            <label class="control-label">Stock</label>
            <select class="form-control" id="pos_rap" name="pos" required>
            <option value="">-- Choisir --</option>
                <?php
                  $datas=$perso->select_all_role('pos');
                       foreach ($datas as $value) {
                     if ($value['personne_id']==$_SESSION['pos']) {
                            echo '<option value="'.$value['personne_id'].'" selected>'.$value['nom_complet'].'</option>';
                        }
                        else
                        {
                      echo '<option value="'.$value['personne_id'].'">'.$value['nom_complet'].'</option>';
                    }
                }
            ?>
            <option value="tous">Tous</option>
        </select>

        </div>
    </div>
    <div class="col-md-2">
        <div class="form-group">
            <label class="control-label">Utilisateurs</label>
            <select class="form-control" id="user_rap" name="user_rap">
            <option value="">Tous</option>
                <?php
                  $datas=$perso->select_all_role('users');
                       foreach ($datas as $value) {
                     /*if ($value['personne_id']==$_SESSION['perso_id']) {
                            echo '<option value="'.$value['personne_id'].'" selected>'.$value['nom_complet'].'</option>';
                        }
                        else
                        {*/
                      echo '<option value="'.$value['personne_id'].'">'.$value['nom_complet'].'</option>';
                        //}
                }
            ?>
            <!-- <option value="tous">Tous</option> -->
        </select>

        </div>
    </div>
  <div class="col-md-2">
        <div class="form-group">
            <label class="control-label">Du : </label>
            <input type="text" id="datepicker" name="from" class="form-control" value="<?php echo date("Y-m-d"); ?>" required>
        </div>
    </div>
    <div class="col-md-2">
        <div class="form-group">
            <label class="control-label">Au : </label>
            <input type="text" id="datepicker2" name="to" class="form-control" value="<?php echo date("Y-m-d"); ?>" required>
        </div>
    </div>
    <div class="col-md-2" >
        <div class="form-group" style="bottom:0;">
            &nbsp;<br/>
            <button id="action" data-id="Add" type="submit" class="btn btn-success" name="search"> <span class="fa fa-search"></span></button>
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
<div class="alert alert-info" style="background-color: white;" id="tab_syn_per">

</div>
</div>
</section>
