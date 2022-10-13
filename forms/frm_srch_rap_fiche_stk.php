
<?php
@session_start();
require_once '../load_model.php';
$tar= new BeanTarif();
$pos=new BeanPos();
$prod=new BeanProducts();
$per=new BeanPeriode();

$pos->select_status('Oui');
?>
<input type="hidden" name="is_sale" id="is_sale" value="Tous">
<div class="card card-info" >
    <div class="card-header bg-light">Fiche du stock</div>
    <div >
        <div class="card-body">
            <form id="frm_srch_rap_fiche_stk" method="post" autocomplete="off">
                <div class="form-body">
                    <div class="form-row">
                        <div class="col-md-1">
                            <div class="form-group">
                                <label class="control-label">Periode</label>
                                <select class="custom-select" id="id_per" name="id_per" required>
                                    <option value="">Choisir</option>
                                    <?php
                                    $datas=$per->select_all();
                                    foreach ($datas as $value) {
                                        if ($value['id_per']==$_SESSION['periode']) {
                                            echo '<option value="'.$value['id_per'].'" selected>'.$value['code_per'].'</option>';
                                        }
                                        else
                                        {
                                            echo '<option value="'.$value['id_per'].'">'.$value['code_per'].'</option>';
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
                                <select class="custom-select" id="pos_id" name="pos_id" required>
                                    <option value="">Choisir</option>
                                    <?php
                                    $datas=$pos->select_all();
                                    foreach ($datas as $value) {
                                        if ($value['pos_id']==$_SESSION['pos']) {
                                            echo '<option value="'.$value['pos_id'].'" selected>'.$value['pos_name'].'</option>';
                                        }
                                        else
                                        {
                                            echo '<option value="'.$value['pos_id'].'">'.$value['pos_name'].'</option>';
                                        }
                                    }
                                    ?>
                                </select>

                            </div>
                        </div>
                        
                        <div class="col-md-3">
                                <label class="control-label">Produits*</label>
                                <div class="input_container">
                                    <input type="text" id="content_lib_prod" name="content_lib_prod" class="form-control" value="" required> 
                                    <ul id="content_list_prod"></ul>
                                    <input type="hidden" name="prod_id" id="prod_id" value="" />
                                </div>
                            
                        </div>
                        <div class="col-md-2">
                                <label class="control-label">Du : </label>
                                <input type="date" id="date_from" name="date_from" class="form-control" value="<?php echo date("Y-m-d"); ?>" required>
                        </div>
                        <div class="col-md-2">
                                <label class="control-label">Au : </label>
                                <input type="date" id="date_to" name="date_to" class="form-control" value="<?php echo date("Y-m-d"); ?>" required>
                        </div>
                        <div class="col-md-1" >
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

<section class="" id="tab_rap_fiche_stk">
<!-- <div class="col-lg-12" >
<div class="alert alert-info" style="background-color: white;" >

</div>
</div> -->
</section>
