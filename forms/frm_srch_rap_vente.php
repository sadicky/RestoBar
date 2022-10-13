
<?php
@session_start();
require_once '../load_model.php';
$cat= new BeanCategory();
$perso=new BeanPersonne();

?>
<div class="card card-info" >
                            <div class="card-header bg-light">Rapport périodique de vente</div>
                            <div >
                                <div class="card-body">
                                    <form id="frm_search_rap_vente" method="post">
                                        <div class="form-body">
<div class="form-row">
    <input type="hidden" name="pos" id="pos_rap" value="tous">

    <input type="hidden" id="client_rap" name="four" value="">

    <div class="col-md-3">
        <div class="form-group">
            <label class="control-label">Categorie</label>
            <select class="form-control" id="cat_rap" name="cat_rap">
                <option value="">Tous</option>
                <?php
                $datas=$cat->select_all_2();
                foreach($datas as $un)
                {

                    echo '<option value="'.$un['category_id'].'">'.$un['category_name'].'</option>';
                }
                ?>
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
    <div class="col-md-2">
        <div class="form-group">
            <label class="control-label">Concernant</label>
            <select name="party" id="party" class="form-control">
                <option value="" selected>Tous</option>
                <option value="1">Cuisine</option>
                <option value="2">Bar</option>
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
<div class="alert alert-info" style="background-color: white;" id="tab_rap_vente">

</div>
</div>
</section>
