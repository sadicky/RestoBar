<?php
@session_start();
require_once '../load_model.php';
$op= new BeanOperation();
$trans=new BeanTransactions();
$acc= new BeanAccounts();
$sort= new BeanSortieMatp();
$ent= new BeanEntreProdf();
$pers= new BeanPersonne();
$datas=$op->select_all_by_state('Sortie','1');
//$datas_paie=$trans->select_all_ag($_SESSION['acc_id'],'paiement');
?>
<div class="row">
<div class="col-md-5">
    <div class="row alert alert-info " style="background-color: white;">
        <div class="card card-info" >
                            <div class="card-header bg-light">Entrée des produits finis</div>
                            <div >
                                <div class="card-body">
                                    <form id="frm_new_ent" method="post">
                                        <div class="form-body">
<div class="row">
    <div class="col-md-7">
        <div class="form-group">
            <label class="control-label">Date</label>
            <input type="text" id="datepicker" name="date_ent" class="form-control" value="<?php echo date("Y-m-d"); ?>" required>
        </div>
    </div>
    <div class="col-md-5" >
        <div class="form-group" style="bottom:0;">
            &nbsp;<br/>
            <button id="action" data-id="Add" type="submit" class="btn btn-success" name="search"> <span class="fa fa-plus"></span> Nouveau</button>
        </div>
    </div>
</div>
</div>
</form>
                                </div>
                            </div>
                </div>
    </div>

    <div class="row alert alert-info " style="background-color: white;" id="ent_prodf_tab">

    </div>
</div>
    <div class="col-md-7">
        <div class="row alert alert-info " style="background-color: white;">
            <div class="col-md-12"  id="ent_form">
            </div>
            <div class="col-md-12">
                <div class="white-box">
  <button id="entre_details" data-id="0" class="btn btn-primary"><i class="fa fa-plus"></i> Détails</button>
                <div  id="list_prodf">
                </div>
            </div>
        </div>
    </div>
</div>

