
<?php
@session_start();
require_once '../load_model.php';
$pos= new BeanPos();
$tar= new BeanTarif();
$perso=new BeanPersonne();
$prod=new BeanProducts();
$cat=new BeanCategory();

$pos->select_status('Oui');
?>
<input type="hidden" name="is_sale" id="is_sale" value="Tous">
<div class="card card-info" >
    <div class="card-header bg-light">Situation Stock général</div>
    <div >
        <div class="card-body">
            <form id="frm_srch_rap_situ_gen" method="post" autocomplete="off">
                <div class="form-body">
                    <div class="form-row">
                        <div class="col-md-2">
                            <div class="form-group">
                                <label class="control-label">Category</label>
                                <select class="custom-select" id="cat_id" name="cat_id">
                                    <option value="">Tous</option>
                                    <?php
                                    $datas=$cat->select_all_2();
                                    foreach ($datas as $value) {
                                        echo '<option value="'.$value['category_id'].'">'.$value['category_name'].'</option>';
                                        
                                    }
                                    ?>
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
                        
                        <div class="col-md-1" >
                                &nbsp;<br/>
                                <button id="action" data-id="Add" type="submit" class="btn btn-success" name="search"> <i class="fa fa-search"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        

<section class="m-2" id="tab_situ">

</section>
</div>
    </div>
</div>