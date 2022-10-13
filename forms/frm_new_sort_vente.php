
<?php
require_once '../load_model.php';
/*$acc= new BeanAccounts();
$perso=new BeanPersonne();
$datas=$acc->select_all_role('supplier');*/
?>
<div class="card card-info" >
                            <div class="card-header bg-light">Sortie des produits</div>
                            <div >
                                <div class="card-body">
                                    <form id="frm_new_sort_vente" method="post">
                                        <div class="form-body">
<div class="form-row">
    <div class="col-md-4">
        <div class="form-group">
            <label class="control-label">Date</label>
            <input type="text" id="datepicker" name="date_sort" class="form-control" value="<?php echo date("Y-m-d"); ?>" required>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label class="control-label">Motif de sortie pour vente</label>
            <input type="text" id="motif" name="motif" class="form-control" value="" required>
            <input type="hidden" id="op_an_id" name="op_an_id" value="">
        </div>
    </div>
    <div class="col-md-4" >
        <div class="form-group" style="bottom:0;">
            &nbsp;<br/>
            <button id="action" data-id="Add" type="submit" class="btn btn-success" name="search"> <span class="fa fa-save"></span> <span id="label_action">Enregistrer</span></button>

            <button type="reset" class="btn btn-default"><span class="fa fa-plus"> Nouveau</button>
        </div>
    </div>
</div>
</div>
</form>
                                </div>
                            </div>
                </div>

<section class="row">
<div class="col-lg-7" >
<div class="alert alert-info" style="background-color: white;" id="list_prod_sort_vente">

</div>
</div>
<div class="col-lg-5" >
<div class="alert alert-info" style="background-color: white;" id="sort_vente_form">

</div>
</div>
</section>
<section class="row">
<div class="col-lg-12 " id="sort_tab">

</div>

</section>
