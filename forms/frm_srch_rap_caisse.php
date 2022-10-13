<?php
require_once '../load_model.php';
$perso=new BeanPersonne();
$bq=new BeanBanque();
?>
<div class="card card-info" >
                            <div class="card-header bg-light">Rapport périodique de Caisse</div>
                            <div >
                                <div class="card-body">
                                    <form id="frm_search_rap_caisse" method="post">
                                        <div class="form-body">
<div class="form-row">
    <div class="col-md-3">
        
                <label class="control-label">Source</label>
                <select id="caisse_rap" name="caisse_rap" class="form-control"required>
                    <option value="">-- Choisir --</option>
                  <?php
                  $mode=$bq->select_all();
                  foreach($mode as $e)
                    {
                    echo '<option value="'.$e['id_bq'].'">'.$e['lib_bq'].'</option>';
                    }
            ?>
                </select>
                 
  </div>
    <div class="col-md-3">
        <div class="form-group">
            <label class="control-label">Du : </label>
            <input type="text" id="datepicker" name="from" class="form-control" value="<?php echo date("Y-m-d"); ?>" required>
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <label class="control-label">Au : </label>
            <input type="text" id="datepicker2" name="to" class="form-control" value="<?php echo date("Y-m-d"); ?>" required>
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

<section class="row">
<div class="col-lg-12" >
<div class="alert alert-info" style="background-color: white;" id="tab_rap_caisse">

</div>
</div>
</section>
