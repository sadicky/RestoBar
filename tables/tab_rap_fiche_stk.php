<?php
@session_start();
require_once '../load_model.php';
$op= new BeanOperation();
$det= new BeanDetailsOperation();
$prod= new BeanProducts();
$sort= new BeanSortie();
$pos= new BeanPos();
$pers= new BeanPersonne();
$pers2= new BeanPersonne();
$stock = new BeanStock();

$from_date=$_GET['from_d'];
$to_date=$_GET['to_d'];
$posId=$_GET['pos_id'];
$prodId=$_GET['prod_id'];
$idPer=$_GET['id_per'];

$prod->select($prodId);
?>
<div class="white-box form-row">
    <div class="col-md-12">
        <div  id="vente_tab">
            <h4 class="box-title m-b-0">Fiche du stock du <?php echo $from_date; ?>: Au: <?php echo $to_date; ?> / Produit : <?php echo $prod->getProdName(); ?> / Stock :
                <?php
                $pos->select($posId);

                echo $pos->getPosName();

                ?>
            </h4>
            <hr>
            <div class="table-responsive">
                <table id="tab" class="table table-bordered table-condensed table-striped display table-sm" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>Date*</th><th>Libellé</th><th>Fournisseur/Client</th><th>Utilisateur</th><th>Unité</th><th>Entrée</th><th>Sortie</th><th>reste</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php
                        $reste=0;

                        $in=$op->select_all_by_date_rap_an('stock_in',$prodId,$from_date,$posId,$idPer);
                        $out=$op->select_all_by_date_rap_an('stock_out',$prodId,$from_date,$posId,$idPer);

                        $solde=$in['totqt']-$out['totqt'];

                        $reste +=$solde;
                       
                        if($solde>=0)
                        {
                            echo '<tr><td>'.$from_date.'</td><td>Reste entrée</td><td>-</td><td>-</td><td>'.$prod->getUntMes().'</td><td>'.number_format($solde).'</td><td>-</td><td>'.number_format($solde).'</td></tr>';
                        }
                        else
                        {
                            echo '<tr><td>'.$from_date.'</td><td>Reste Sortie</td><td>-</td><td>'.$pr->getUntMes().'</td><td>-</td><td>'.number_format($solde,'2','.',' ').'</td><td>'.number_format($solde,'2','.',' ').'</td></tr>';
                        }

                        while (strtotime($from_date) <= strtotime($to_date))
                        {
                            $datas=$op->select_all_by_date_rap($prodId,$from_date,$posId,$idPer);

                            foreach ($datas as $un) {
                                $prod->select($un['prod_id']);
                                $pers2->select($un['party_code']);
                                $pers->select($un['personne_id']);
                                
                                if($un['party_type']=='stock_in')
                                {
                                    $reste +=$un['quantity'];
                                    echo '<tr><td>'.$un['create_date'].'</td><td>'.$un['op_type'].'</td><td>'.$pers2->getNomComplet().'</td><td>'.$pers->getNomComplet().'</td><td>'.$prod->getUntMes().'</td><td>'.number_format($un['quantity']).'</td><td>-</td><td>'.number_format($reste).'</td></tr>';
                                }
                                elseif($un['party_type']=='stock_out')
                                {
                                    $reste -=$un['quantity'];
                                    echo '<tr><td>'.$un['create_date'].'</td><td>'.$un['op_type'].' (<b>';
                                    if($un['op_type']=='Sortie')
                                    {
                                    $sort->select($un['op_id']);
                                    echo $sort->getMotif();
                                    }
                                    else
                                    {
                                    echo $pers2->getNomComplet();
                                    }

                                    echo '</b>)</td><td>'.$pers2->getNomComplet().'</td><td>'.$pers->getNomComplet().'</td><td>'.$prod->getUntMes().'</td><td>-</td><td>'.number_format($un['quantity']).'</td><td>'.number_format($reste).'</td></tr>';
                                }
                            }

                            $from_date = date ("Y-m-d", strtotime("+1 days", strtotime($from_date)));
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

