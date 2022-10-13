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
//$prodId=$_GET['prod_id'];
$idPer=$_GET['id_per'];
?>
<div class="white-box form-row">
    <div class="col-md-12">
        <div  id="vente_tab">
            <h4 class="box-title m-b-0">Fiche du stock du <?php echo $from_date; ?>: Au: <?php echo $to_date; ?> / Stock :
                <?php
                $pos->select($posId);

                echo $pos->getPosName();

                ?>
            </h4>
            <hr>
            <div class="table-responsive">
                <table id="tabx" class="table table-bordered table-condensed table-striped display table-sm" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>Date</th><th>Produit</th><th colspan="3" style="text-align: center">Initial</th><th colspan="3" style="text-align: center">Entrée</th><th colspan="3" style="text-align: center">Sortie</th><th colspan="3" style="text-align: center">Final</th>
                        </tr>
                        <tr>
                            <th>-</th><th>-</th><th>Qt</th><th>PUV</th><th>PT</th><th>Qt</th><th>PUA</th><th>PT</th><th>Qt</th><th>PUV</th><th>PT</th><th>Qt</th><th>PUV</th><th>PT</th>
                        </tr>

                    </thead>

                    <tbody>
                        <?php
                        $reste=0;
                        $nb=$prod->select_all_nb_stk();
                        while (strtotime($from_date) <= strtotime($to_date))
                        {
                            echo '<tr><td rowspan="'.$nb.'">'.$from_date.'</td>';
                            $datas=$prod->select_all_2();
                            $tot_init=0;
                            $tot_in=0;
                            $tot_out=0;
                            $tot_fin=0;
                            foreach ($datas as $key => $value) {
                        $prodId=$value['prod_id'];
                        $in=$op->select_all_by_date_rap_an('stock_in',$prodId,$from_date,$posId,$idPer);
                        $out=$op->select_all_by_date_rap_an('stock_out',$prodId,$from_date,$posId,$idPer);
                        $init=$in['totqt']-$out['totqt'];
                        $in=$op->select_all_by_date_rap_mv($prodId,$from_date,$posId,$idPer,'stock_in');
                        $out=$op->select_all_by_date_rap_mv($prodId,$from_date,$posId,$idPer,'stock_out');
                        $fin=($in['quantity']+$init)-$out['quantity'];

                        $tot_init +=$value['prod_price']*$init;
                        $tot_in  +=$in['quantity']*$in['amount'];
                        $tot_out +=$out['quantity']*$out['amount'];
                        $tot_fin +=$value['prod_price']*$fin;

                        echo '<tr><td>'.$value['prod_name'].'</td>
                        <th align="right">'.$init.'</th><td align="right">'.$value['prod_price'].'</td><td align="right">'.number_format($value['prod_price']*$init).'</td>
                        <th align="right">'.$in['quantity'].'</th><td align="right">'.$in['amount'].'</td><td align="right">'.$in['quantity']*$in['amount'].'</td>
                        <th align="right">'.$out['quantity'].'</th><td align="right">'.$out['amount'].'</td><td align="right">'.$out['quantity']*$out['amount'].'</td>
                        <th>'.$fin.'</th><td align="right">'.$value['prod_price'].'</td><td align="right">'.number_format($value['prod_price']*$fin).'</td></tr>';
                            
                            }

                            echo '</tr>';
                            $from_date = date ("Y-m-d", strtotime("+1 days", strtotime($from_date)));
                            echo '

                            <tr>
                            <th>-</th><th>-</th><th>-</th><th>-</th><th style="text-align:right">'.number_format($tot_init).'</th><th>-</th><th>-</th><th style="text-align:right">'.number_format($tot_in).'</th><th>-</th><th>-</th><th style="text-align:right">'.number_format($tot_out).'</th><th>-</th><th>-</th><th style="text-align:right">'.number_format($tot_fin).'</th>
                            </tr>

                            <tr>
                            <th>Date</th><th>Produit</th><th colspan="3" style="text-align: center">Initial</th><th colspan="3" style="text-align: center">Entrée</th><th colspan="3" style="text-align: center">Sortie</th><th colspan="3" style="text-align: center">Final</th>
                        </tr>
                        <tr>
                            <th>'.$from_date.'</th><th>-</th><th>Qt</th><th>PUV</th><th>PT</th><th>Qt</th><th>PUA</th><th>PT</th><th>Qt</th><th>PUV</th><th>PT</th><th>Qt</th><th>PUV</th><th>PT</th>
                        </tr>
                            ';

                            
                        
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

