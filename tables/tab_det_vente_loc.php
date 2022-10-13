<?php
if(isset($_SESSION['op_loc_id']))
                        {
$op->select($_SESSION['op_loc_id']);
$vente->select($_SESSION['op_loc_id']);

$sell=$det->select_sum_op($_SESSION['op_loc_id']);
    $p=$paie->select_sum_op($_SESSION['op_loc_id']);
    $pay=($sell-$vente->getRed()-$p['paie']);
}
?>
<hr>
<h1>Consommation Bar - Resto</h1>
  
<div class="table-responsive">
                <table class="table table-bordered table-striped table-sm display" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>Désignation</th><th>Prix</th><th>Qt</th><th>Tot</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $tot=0;
                        if(isset($_SESSION['op_loc_id']) and !empty($_SESSION['op_loc_id']))
                        {
                            $datas2=$det->select_all($_SESSION['op_loc_id']);
                            foreach ($datas2 as $un) {

                                $prod->select($un['prod_id']);
                                $tot +=$un['quantity']*$un['amount'];

                                echo '<tr><td>'.$prod->getProdName().'</td><td>'.$un['amount'].'</td><td>'.$un['quantity'].'</td><td>'.number_format($un['quantity']*$un['amount'],0,'.',',').'</td></tr>';
                                

                                }
                       }
?>
</tbody>
<tfoot>
    <tr>
        <th>Total</th><th>-</th><th>-</th><th><?php echo number_format($tot); $cout +=$tot; ?></th>
    </tr>
</tfoot>
</table>
</div>
