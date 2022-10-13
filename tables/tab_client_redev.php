<?php
@session_start();
require_once '../load_model.php';
$pers= new BeanPersonne();
$op=new BeanOperation();

$datas=$op->select_state_paid('0');

?>
<div class="row" style="overflow: auto;">
  <div class="col-md-3">
  <div class="table-responsive">
               <table class="table table-striped table-bordered table-hover table-sm dtab">
               <thead>
                  <tr>
                    <th>Nom & Prénom</th><th>Tél</th>
                  </tr>
               </thead>
                  <tbody>
                  <?php
                  foreach ($datas as $key => $value) {
                    $pers->select($value['party_code']);
                    echo '<tr><td class="row_client_redev" data-id="'.$value['party_code'].'" style="cursor:pointer"> '.$pers->getNomComplet().'</td><td>'.$pers->getContact().' <i class="fa fa-hand-o-left"></i></td></tr>';
                  }
                  ?>
                </tbody>
               </table>
              </div>
  </div>
  <div class="col-md-9" id="details_client">
    
  </div>
</div>
