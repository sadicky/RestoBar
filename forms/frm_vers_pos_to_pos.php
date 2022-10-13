
<?php
@session_start();
require_once '../load_model.php';
/*$acc= new BeanAccounts();*/
$perso=new BeanPersonne();
/*$datas=$acc->select_all_role('supplier');*/
?>
<div class="card card-info" >
                            <div class="card-header bg-light">Du Stock en Stock</div>
                            <div >
                                <div class="card-body">
                                    <form id="frm_new_transf_prod" method="post">
                                        <div class="form-body">
<div class="form-row">
    <div class="col-md-2">
        <div class="form-group">
            <label class="control-label">Date</label>
            <input type="text" id="datepicker" name="date_sort" class="form-control" value="<?php echo date("Y-m-d"); ?>" required>
        </div>
    </div>
    <div class="col-md-2">
        <div class="form-group">
            <label class="control-label">Source</label>
            <select class="form-control" id="from_pos" name="from_pos" required>
                <option value="">Choisir</option>
                <?php
                $datas=$perso->select_all_role('pos');
                $perso->select($_SESSION['pos']);
                foreach($datas as $un)
                {

                    if($un['personne_id']==$_SESSION['pos'])
                    {
                     echo '<option value="'.$un['personne_id'].'" selected>'.$un['nom_complet'].'</option>';
                    }
                    else
                    {
                    echo '<option value="'.$un['personne_id'].'">'.$un['nom_complet'].'</option>';
                    }
                }
                ?>
            </select>
        </div>
    </div>
    <div class="col-md-2">
        <div class="form-group">
            <label class="control-label">Destination</label>
            <select class="form-control" id="dest_pos" name="dest_pos" required>
                <option value="">Choisir</option>
                <?php
                $datas=$perso->select_all_role('pos');
                $perso->select($_SESSION['pos']);
                foreach($datas as $un)
                {
                    /*if($un['personne_id']!=$_SESSION['pos'])
                    {*/
                     echo '<option value="'.$un['personne_id'].'">'.$un['nom_complet'].'</option>';

                    //}

                }
                ?>
            </select>
            <input type="hidden" id="op_an_id" name="op_an_id" value="">
        </div>
    </div>
    <div class="form-group col-md-3">
    <label class="control-label">Stock : </label><br/>
            <div class="form-check form-check-inline">
            <label class="form-check-label mr-2">Details</label> <input type="radio" name="stock" id="det" value="1">
            </div>
            <div class="form-check form-check-inline">
            <label class="form-check-label mr-2">Gros</label> <input type="radio" name="stock" id="gros" value="0" checked>
            </div>
  </div>
    <div class="col-md-2" >
        <div class="form-group" style="bottom:0;">
            &nbsp;<br/>
            <button id="action" data-id="Add" type="submit" class="btn btn-success" name="search"> <span class="fa fa-save"></span> <span id="label_action"></span></button>

            <button type="reset" class="btn btn-default"><span class="fa fa-plus"></button>
        </div>
    </div>
</div>
</div>
</form>
                                </div>
                            </div>
                </div>

<section class="form-row">
<div class="col-md-7" id="list_prod_transf">

</div>
<div class="col-md-5" id="transf_prod_form">

</div>
</section>
<section id="transf_prod_tab">


</section>
