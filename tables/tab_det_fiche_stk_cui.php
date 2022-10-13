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
$per=new BeanPeriode();
$vente=new BeanVente();

$per->select($_SESSION['periode']);
$from_date=$per->getDebut();
$to_date=date('Y-m-d');
$posId=$_SESSION['pos'];
$prodId=$_GET['prod_id'];
$idPer=$_SESSION['periode'];

$prod->select($prodId);
?>

            <h3>Fiche du stock du <?php echo $from_date; ?>: Au: <?php echo $to_date; ?> / <a href="javascript:void(0)" class="new_prod" id="<?php echo $prodId; ?>" data-id="<?php echo $prodId; ?>" >Produit : <?php echo $prod->getProdName(); ?> (<?php echo $prodId; ?>)</a> / Stock :
                <?php
                $pos->select($posId);

                echo $pos->getPosName();

                ?>
            </h3>
            <hr>
            <div class="table-responsive">
                <table id="example23" class="table table-bordered table-condensed table-striped display table-sm tab" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>Date</th><th>Libellé</th><th>Par</th><th>Entrée</th><th>Sortie</th><th>reste</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php
                        $reste=0;

                        $in=$op->select_all_by_date_rap_an('stock_in',$prodId,$from_date,$posId,$idPer);
                        $out=$op->select_all_by_date_rap_an_cui('stock_out',$prod->getProdEquiv(),$from_date,$posId,$idPer);

                        $solde=$in['totqt']-$out['totqt'];

                        $reste +=$solde;
                        
                        if($solde>=0)
                        {
                            echo '<tr><td>'.$from_date.'</td><td>Reste entrée</td><td>-</td><td>'.number_format($solde).'</td><td>-</td><td>'.number_format($solde).'</td></tr>';
                        }
                        else
                        {
                            echo '<tr><td>'.$from_date.'</td><td>Reste Sortie</td><td>-</td><td>'.number_format($solde,'2','.',' ').'</td><td>'.number_format($solde,'2','.',' ').'</td></tr>';
                        }

                        while (strtotime($from_date) <= strtotime($to_date))
                        {
                            $datas=$op->select_all_by_date_rap($prodId,$from_date,$posId,$idPer);

                            foreach ($datas as $un) {
                                $prod->select($un['prod_id']);
                                $pers2->select($un['party_code']);
                                $pers->select($un['personne_id']);
                                $vente->select($un['op_id']);
                                
                                if($un['party_type']=='stock_in')
                                {
                                    $reste +=$un['quantity'];
                                    echo '<tr><td>'.$un['create_date'].'</td><td>'.$un['op_type'].' (<b>'.$pers2->getNomComplet().'</b>)</td><td>'.$pers->getNomComplet().'</td><td>'.number_format($un['quantity']).'</td><td>-</td><td>'.number_format($reste).'</td></tr>';
                                }
                                elseif($un['party_type']=='stock_out')
                                {
                                    $reste -=$un['quantity'];
                                    echo '<tr><td>'.$un['create_date'].'</td><td>'.$un['op_type'].' (<b>';
                                    echo $un['prod_name'];
                                    echo '</b>)';
                                    if($vente->getIsPaid()=='0')
                                    {
                                    echo ' <button class=" btn btn-light btn-sm row_op_vente" data-id='.$un['op_id'].' style="cursor:pointer"><i class="fa fa-edit fa-fw"></i></button>';
                                    }
                                    echo '</td><td>'.$pers->getNomComplet().'</td><td>-</td><td>'.number_format($un['quantity']).'</td><td>'.number_format($reste).'</td></tr>';
                                }
                            }

                            $from_date = date ("Y-m-d", strtotime("+1 days", strtotime($from_date)));
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        
<?php
//qt_stk=$stock->stock_syn_qt($prodId,$posId,$idPer);
$stock->select($prodId,$posId);
$stock->update_qt($stock->getStockId(),$reste);
?>
