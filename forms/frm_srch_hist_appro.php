
<?php
@session_start();
require_once '../load_model.php';
$pers=new BeanPersonne();
?>
<div class="card card-info" >
    <div class="card-header bg-light">Approvisionnement périodique</div>
    <div >
        <div class="card-body">
            <form id="frm_srch_hist_appro" method="post">
                <div class="form-body">
                    <div class="form-row">
                        <div class="col-md-3">
                                <label class="control-label">Fournisseurs</label>
                                <select class="custom-select" id="four_hist" name="four">
                                    <option value="">Tous</option>
                                    <?php
                                    $datas=$pers->select_all_role('supplier');
                                    foreach($datas as $un)
                                    {
                                        echo '<option value="'.$un['personne_id'].'">'.$un['nom_complet'].'</option>';
                                    }
                                    ?>
                                </select>
                        </div>
                        <div class="col-md-2">
                            
                                <label class="control-label">Du : </label>
                                <input type="date" id="from_d" name="from_d" class="form-control" value="<?php echo date("Y-m-d"); ?>" required>
                           
                        </div>
                        <div class="col-md-2">

                                <label class="control-label">Au : </label>
                                <input type="date" id="to_d" name="to_d" class="form-control" value="<?php echo date("Y-m-d"); ?>" required>
                           
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

<section id="tab_hist_appro">

</section>
