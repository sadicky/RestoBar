<?php
@session_start();
require_once '../load_model.php';
$op= new BeanOperation();
$trans=new BeanTransactions();
$acc= new BeanAccounts();
$sort= new BeanSortieMatp();
$ent= new BeanEntreProdf();
$pers= new BeanPersonne();
$datas=$op->select_all_by_state('Sortie','1',$_SESSION['pos']);
//$datas_paie=$trans->select_all_ag($_SESSION['acc_id'],'paiement');
?>
<div class="row">
<div class="col-md-6">
    <div class="row alert alert-info " style="background-color: white;">
    <div class="col-md-12" id="info_fact_non_valid">
        <h5 class="box-title m-b-0">Commandes non validées</h5>
        <hr>

    </div>
    </div>
</div>
    <div class="col-md-6">
        <div class="row alert alert-info " style="background-color: white;">

            <div class="col-md-12" >

                <div  id="list_prod_vente">

                </div>
            </div>
        </div>
    </div>
</div>

