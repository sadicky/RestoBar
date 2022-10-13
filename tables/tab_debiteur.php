<?php
require_once '../load_model.php';
$perso= new BeanPersonne();
$customer= new BeanCustomer();
$acc=new BeanAccounts();
$datas=$perso->select_all_role('customer');
?>

 <div class="white-box">
    <h3 class="box-title m-b-0">Débiteurs (Clients)</h3>

	<div class="table-responsive">
		<table id="example23" class="table table-bordered table-condensed table-striped display" cellspacing="0" width="100%">
			<thead>
               <tr>
               <th>Nom</th><th>Tel</th><th>Balance</th><th>Payé</th><th>Solde</th>
               </tr>
           </thead>
            <tbody>
                <?php
                    foreach ($datas as $un) {
                             $acc->select_acc_perso($un['personne_id']);
                             $solde=$acc->getBalCash()-$acc->getBalpaid();
                             if($solde!=0)
                             {
                             echo '<tr><td class="vente_non_paie" data-id="'.$un['personne_id'].'" style="cursor:pointer;"><i class="fa fa-hand-o-right"> '.$un['nom_complet'].'</td><td>'.$un['contact'].'</td><td>'.number_format($acc->getBalCash(),0,'.',',').'</td><td>'.number_format($acc->getBalPaid(),0,'.',',').'</td><td>'.number_format($solde,0,'.',',').'</td>';
                             echo '</tr>';
                              }

                         }
                            ?>
							</tbody>
							 </table>
							</div>

</div>
