<?php
@session_start();
require_once '../load_model.php';
$trans= new BeanTransactions();
$op=new BeanOperation();
$stock=new BeanStock();

$next_date=date('Y-m-d', strtotime(date("Y-m-d"). ' + 1 days'));
$today=date('Y-m-d');
?>
<div class="row static_table">
<div class="col-md-8">
    <h1>Montants</h1>
    <table class="table table-bordered table-striped table-sm example2 table-responsive" style="border-collapse: separate; border-spacing: 10px; table-layout: fixed ">
    <thead>
    <tr>
        <th>-</th><th>TD</th><th>WTD</th><th>MTD</th><th>YTD</th>
    </tr>
</thead>
<tbody>
    <tr>
        <th>Ventes</th>
        <td>
            <?php $a1=$trans->transaction_amount('Vente',$today,$today);
            echo number_format($a1,0,'.',','); ?>
        </td><td>
            <?php
            $from=date('Y-m-d', strtotime('previous monday'));
            $to=date('Y-m-d');
            $a2=$trans->transaction_amount('Vente',$from,$to);
            echo number_format($a2,0,'.',','); ?>
        </td><td> <?php
            $from=date('Y-m-01');
            $to=date('Y-m-d');
            $a3=$trans->transaction_amount('Vente',$from,$to);
            echo number_format($a3,0,'.',','); ?></td>
            <td> <?php
            $from=date('Y-01-01');
            $to=date('Y-m-d');
            $a4=$trans->transaction_amount('Vente',$from,$to);
            echo number_format($a4,0,'.',','); ?></td>
            
    </tr>


    <tr>
        <th>Dépenses</th>
        <td>
            <?php $d1=$trans->transaction_amount('Retrait',$today,$today);
            echo number_format($d1,0,'.',','); ?>
        </td><td>
            <?php
            $from=date('Y-m-d', strtotime('previous monday'));
            $to=date('Y-m-d');
            $d2=$trans->transaction_amount('Retrait',$from,$to);
            echo number_format($d2,0,'.',','); ?>
        </td><td> <?php
            $from=date('Y-m-01');
            $to=date('Y-m-d');
            $d3=$trans->transaction_amount('Retrait',$from,$to);
            echo number_format($d3,0,'.',','); ?></td>
            <td> <?php
            $from=date('Y-01-01');
            $to=date('Y-m-d');
            $d4=$trans->transaction_amount('Retrait',$from,$to);
            echo number_format($d4,0,'.',','); ?></td>
            
    </tr>
    <tr>
        <th>Variance</th>
        <td><?php echo number_format((($a1)-($d1)),0,'.',',') ?></td>
        <td><?php echo number_format((($a2)-($d2)),0,'.',',') ?></td>
        <td><?php echo number_format((($a3)-($d3)),0,'.',',') ?></td>
        <td><?php echo number_format((($a4)-($d4)),0,'.',',') ?></td>
        
    </tr>
    <tr>
        <th>Approvisionnement</th>
        <td>
            <?php $e1=$op->select_all_sum_period('Approvisionnement',$today,$today);
            echo number_format($e1,0,'.',','); ?>
        </td><td>
            <?php
            $from=date('Y-m-d', strtotime('previous monday'));
            $to=date('Y-m-d');
            $e2=$op->select_all_sum_period('Approvisionnement',$from,$to);
            echo number_format($e2,0,'.',','); ?>
        </td><td> <?php
            $from=date('Y-m-01');
            $to=date('Y-m-d');
            $e3=$op->select_all_sum_period('Approvisionnement',$from,$to);
            echo number_format($e3,0,'.',','); ?></td>
            <td> <?php
            $from=date('Y-01-01');
            $to=date('Y-m-d');
            $e4=$op->select_all_sum_period('Approvisionnement',$from,$to);
            echo number_format($e4,0,'.',','); ?></td>
            
    </tr>
</tbody>
</table>
</div>
<div class="col-md-4">
<h1>Stock</h1>
    <table class="table table-bordered table-striped table-sm example2 table-responsive" style="border-collapse: separate; border-spacing: 10px; table-layout: fixed ">
    <thead>
    <tr>
        <th>Libellé</th><th>Nombre/Montant</th>
    </tr>
</thead>
<tbody>
    <tr>
        <th>Produits (Dispo)</th><td><?php  echo number_format($stock->select_nb(),0,'.',','); ?></td>
    </tr>
    <tr>
        <th>Produits (Indispo)</th><td><?php  echo number_format($stock->select_stk_0(),0,'.',','); ?></td>
    </tr>
    <tr>
        <th>PAT</th><td><?php  echo number_format($stock->select_pat(),0,'.',','); ?></td>
    </tr>
    <tr>
        <th>PVT</th><td><?php  echo number_format($stock->select_pvt(),0,'.',','); ?></td>
    </tr>
    <tr>
        <th>VARIANCE</th><td><?php $ben=$stock->select_pvt()-$stock->select_pat(); echo number_format($ben,0,'.',','); ?></td>
    </tr>
</tbody>
</table>
</div>
</div>