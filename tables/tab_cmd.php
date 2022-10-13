<?php

?>

<div id="cmd_to_print" class="card">
    <div class="card-body">
        <div class="table-responsive">
            <h5 class="box-title m-b-0">Bon de Commande</h5>
                            <table class="table table-bordered table-striped table-sm display" cellspacing="0" width="100%" border="1">
                                <tr>
                                    <td>Operateur : <?php
                                    $perso->select($_SESSION['perso_id']);
                                    echo $perso->getNomComplet(); ?></td>
                                   <td>Table : <?php $pl->select($vente->getPlace()); echo $pl->getPlaceNum(); ?></td>
                                   <td colspan="2">Serveur : <?php $perso->select($vente->getAssId()); echo $perso->getNomComplet(); ?></td>
                                </tr>
                                <tr>
                                    <td>Date : <?php echo $op->getCreateDate().' '.date('h:i'); ?></td>
                                     <td>N° Fact : <?php echo $vente->getNumVente(); ?></td>
                                      <td>N° Cmd : <?php echo $_SESSION['cmd']; ?></td>
                                </tr>

                            </table>
                             <table class="table table-bordered table-striped table-sm display" cellspacing="0" width="100%" border="1">
                             <thead>
                                        <tr>
                                           <th>Produit</th><th>Qté</th>
                                        </tr>
                            </thead>
                                    <tbody>
                                    <?php
                                    $datas2=$det->select_all_2($_SESSION['cmd']);
                                    $totc=0;
                                    foreach ($datas2 as $un) {
                                    $prod->select($un['prod_id']);
                                    $totc +=$un['quantity']*$un['amount'];
                                    echo '<tr><td >'.$prod->getProdName();

                                    if(!empty($un['date_exp'])) echo '('.$un['date_exp'].')';

                                    echo '</td><td>'.$un['quantity'].'</td>';
                                   echo '</tr>';

                                    }

                                    ?>
    </tbody>
    </table>
</div>
</div>
</div>
