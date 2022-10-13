
<h5>Facture</h5><hr>
<div id="facture">
    
    <?php
    include("../entete.php");
    ?>
    
        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-sm display" cellspacing="0" width="100%" border="1">
                                <?php
                                $perso_client->select($op->getPartyCode());
                                $perso->select($op->getPersonneId());
                                $m_p=$paie->select_sum_op($_SESSION['op_loc_id']);
                                ?>
                                <tr>
                                    <td>Client : <?php echo $perso_client->getNomComplet(); ?></td>
                                     <td>Facture N° : <?php echo $fact->getLocNum(); ?></td>
                                </tr>
                                <tr>
                                   <td>Date : <?php echo $op->getCreateDate().' '.date('h:i:s',strtotime($op->getDhOp())); ?></td><td >Réceptionniste : <?php echo $perso->getNomComplet(); ?></td>
                                </tr>
                                

                            </table>
                             <table class="table table-sm table-bordered table-striped" border="1" width="100%">
            <thead>
                <tr><th>Chambre / Salle</th><th>Arrivée</th><th>Départ</th><th>Nbre de Jours</th><th>Total</th></tr>
            </thead>
            <tbody>
                <?php
                $datas=$loc->select_all($_SESSION['op_loc_id']);
                $cout=0;
                $tot_tva=0;
                foreach ($datas as $key => $value) {
                if($value['loc_type']=='Location')
                {
                    $to_day=date('Y-m-d');
                    $chamb->select($value['chamb_id']);
                    $test=$loc->dateDiff($value['from_d'],$to_day);

                    echo '<tr><td>'.$chamb->getChambNum();
            
                    echo '</td><td>'.$value['from_d'].'</td><td>'.$value['to_d'].'</td><td>';
            
            //$next=$to_day;
            if($chamb->getChambEtat()=='0') { $nb_days=$fact->dateDiff($value['from_d'],$to_day);}
              else { $nb_days=$fact->dateDiff($value['from_d'],$value['to_d']); }

            if($nb_days<=0) $nb_days=1;
            echo $nb_days;
            $cout +=$nb_days*$value['loc_price'];
                    echo '</td><td>'.$pers->nb_format($nb_days*$value['loc_price']).'</td></tr>';
                }
                }
                
                $cout=$cout-$fact->getLocRed();
                if($fact->getLocTva()=='1') $tot_tva=$cout*0.18;
                else
                $tot_tva=0;

                ?>
            </tbody>
            <tfoot>
                <tr><th colspan="4">Réduction accordée</th><th><?php echo $pers->nb_format($fact->getLocRed()); ?></th></tr>
                <tr><th colspan="4">Total Hors TVA</th><th><?php echo $pers->nb_format($cout-$tot_tva); ?></th></tr>
                <tr><th colspan="4">TVA</th><th><?php echo $pers->nb_format($tot_tva);
                 ?></th></tr>
                 <tr><th colspan="4">Total TVAC</th><th><?php echo $pers->nb_format($cout);
                 ?></th></tr>
            </tfoot>
                
        </table>
    <p>Merci et à bientôt</p>
</div>
</div>   
<!-- <a href="javascript:void(0)" id="print_facture" class="btn btn-success" title="Imprimer"><span class="fa fa-print"></span></a> -->

