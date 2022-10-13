
<?php
@session_start();
require_once '../load_model.php';
$acc= new BeanAccounts();
$perso=new BeanPersonne();
$prod=new BeanProducts();
$per=new BeanPeriode();
?>
<input type="hidden" name="is_sale" id="is_sale" value="Tous">
<div class="card card-info" >
                            <div class="card-header bg-light">Fiche du stock</div>
                            <div >
                                <div class="card-body">
                                    <form id="frm_search_rap_stk_mp" method="post" autocomplete="off">
                                        <div class="form-body">
<div class="form-row">
    <div class="col-md-2">
        <div class="form-group">
            <label class="control-label">Periode</label>
            <select class="form-control" id="id_per" name="id_per" required>
            <option value="">Choisir</option>
                <?php
                  $datas=$per->select_all();
                       foreach ($datas as $value) {
                      if ($value['id_per']==$_SESSION['periode']) {
                            echo '<option value="'.$value['id_per'].'" selected>'.$value['debut'].'</option>';
                        }
                        else
                        {
                      echo '<option value="'.$value['id_per'].'">'.$value['debut'].'</option>';
                    }
                }
            ?>
           <!--  <option value="tous">Tous</option> -->
        </select>

        </div>
    </div>
    <div class="col-md-2">
        <div class="form-group">
            <label class="control-label">POS</label>
            <select class="form-control" id="pos_rap" name="pos" required>
            <option value="">Choisir</option>
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
           <!--  <option value="tous">Tous</option> -->
        </select>

        </div>
    </div>
  <input type="hidden" name="stock" id="gros" value="0">
  <input type="hidden" name="stock" id="det" value="1">
    <div class="col-md-3">
        <div class="form-group">
            <label class="control-label">Produits*</label>
            <div class="input_container">
                <input type="text" id="content_id_appro" name="prod" class="form-control" value="" required>
            <ul id="content_list_id"></ul>
            </div>
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
    <div class="col-md-1" >
        <div class="form-group" style="bottom:0;">
            &nbsp;<br/>
            <input type="hidden" name="prod_id" id="prod_id" />
            <button id="action" data-id="Add" type="submit" class="btn btn-success" name="search"> <span class="fa fa-search"></span></button>
        </div>
    </div>
</div>
</div>
</form>
                                </div>
                            </div>
                </div>

<section class="" id="tab_rap_stk_mp">
<!-- <div class="col-lg-12" >
<div class="alert alert-info" style="background-color: white;" >

</div>
</div> -->
</section>
