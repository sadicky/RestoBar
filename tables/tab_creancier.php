<?php
require_once '../load_model.php';
$perso= new BeanPersonne();
$acc=new BeanAccounts();
$datas=$perso->select_all_role('supplier');
?>

 <div class="white-box">
    <h3 class="box-title m-b-0">Créanciers (Fournisseurs)</h3>

	<div class="table-responsive">
		<table id="example23" class="table table-bordered table-condensed table-striped display" cellspacing="0" width="100%">
			<thead>
               <tr>
               <th>Nom</th><th>Tel</th><th>Balance</th><th>Payé</th><th>Solde</th>
               </tr>
           </thead>
            <tbody>
                <?php
                $tot_cash=0;
                $tot_paid=0;

                    foreach ($datas as $un) {
                             $acc->select_acc_perso($un['personne_id']);
                             $solde=$acc->getBalCash()-$acc->getBalpaid();
                             if($solde!=0)
                             {
                              $tot_cash +=$acc->getBalCash();
                              $tot_paid +=$acc->getBalPaid();

                             echo '<tr><td class="achat_non_paie" data-id="'.$un['personne_id'].'" id="'.$un['nom_complet'].'" style="cursor:pointer;"> <i class="fa fa-hand-o-right fa-fw"></i> '.$un['nom_complet'].'</td><td>'.$un['contact'].'</td><td>'.number_format($acc->getBalCash(),0,'.',',').'</td><td>'.number_format($acc->getBalPaid(),0,'.',',').'</td><td>'.number_format($solde,0,'.',',').'</td>';
                             echo '</tr>';
                             }

                         }
                            ?>
							</tbody>
              <tfoot>
                <tr>
                  <th>Totaux</th><th>-</th><th><?php echo number_format($tot_cash,0,'.',','); ?></th><th><?php echo number_format($tot_paid,0,'.',','); ?></th><th><?php echo number_format($tot_cash-$tot_paid,0,'.',','); ?></th></tr>
                </tr>
              </tfoot>
							 </table>
							</div>

</div>
