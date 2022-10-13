<?php
@session_start();
require_once '../load_model.php';
$op= new BeanOperation();
$trans=new BeanTransactions();
$acc= new BeanAccounts();
$sort= new BeanSortieMatp();
$ent= new BeanEntreProdf();
$pers= new BeanPersonne();
//$datas=$op->select_all_by_state('Sortie','1',$_SESSION['pos']);
//$datas_paie=$trans->select_all_ag($_SESSION['acc_id'],'paiement');

$det=new BeanDetailsOperation();

if(!$det->exist_vente_enc('Vente','1'))
{
    unset($_SESSION['op_vente_id']);
    unset($_SESSION['op_vente_num']);
}
?>
<div class="form-row">
<div class="col-md-6">
    <!-- <div style="background-color: white;"> -->
    <div class="col-md-12"  id="frm_client_ordi">
        <!-- dsfdsfds -->
    </div>
    <div class="col-md-12" id="info_fact_non_paie">
        <h5 class="box-title m-b-0">Factures non encore payés</h5>
        <hr>

    </div>
    <!-- </div> -->
</div>
    <div class="col-md-6">
        <!-- <div class="row alert alert-info " style="background-color: white;"> -->
            <div class="col-md-12"  id="vente_form">

            </div>
            <div class="col-md-12" >
                <div style="margin:5px;">
               <!--  <button id="vente_details" data-id="0" class="btn btn-primary"><i class="fa fa-plus"></i> Détails</button> -->



                </div>
                <div  id="list_prod_vente">

                </div>
            </div>
        <!-- </div> -->
    </div>
</div>

