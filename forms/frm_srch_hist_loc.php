
<?php
@session_start();
require_once '../load_model.php';
$acc= new BeanAccounts();
$perso=new BeanPersonne();

?>
<div class="card card-info" >
                            <div class="card-header bg-light">Historique des réservations</div>
                            <div >
                                <div class="card-body">
                                    <form id="frm_search_hist_loc" method="post">
                                        <div class="form-body">
<div class="form-row">
    <div class="col-md-2">
        <div class="form-group">
            <label class="control-label">Client</label>
            <select class="form-control" id="client_hist" name="four">
                <option value="">Tous</option>
                <?php
                $datas=$perso->select_all_role('customer');
                foreach($datas as $un)
                {
                    echo '<option value="'.$un['personne_id'].'">'.$un['nom_complet'].'</option>';
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
            <input type="text" id="datepicker2" name="to" class="form-control" value="<?php echo date('Y-m-d', strtotime(date("Y-m-d"). ' + 1 days')); //echo date("Y-m-d"); ?>" required>
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


<div id="tab_hist_loc">

</div>

