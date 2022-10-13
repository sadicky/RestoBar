<?php
@session_start();
require_once '../load_model.php';
$op= new BeanOperation();
$prod= new BeanProducts();

?>
<div class="card card-info" >
<div class="card-header bg-light">Statistiques des ventes par produit</div>
<div class="card-body">
    <div class="row">
        <div class="col-md-5">
    <h3>Mois en cours</h3>
<table class="table table-bordered table-striped table-sm example2">
    <thead>
        <tr>
            <th>Produit</th><th>Total vendu</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $mois=date('m');
        $datas=$op->select_all_top_ten('Vente',$mois,$_SESSION['pos']);
        foreach ($datas as $key => $value) {
            $prod->select($value['prod_id']);
            echo '<tr><td>'.$prod->getProdName().'</td><td>'.$value['tot'].'</td></tr>';
        }
        ?>
    </tbody>
</table>
</div>
<div class="col-md-5">
    <h3>Mois passé</h3>
<table class="table table-bordered table-striped table-sm example2">
    <thead>
        <tr>
            <th>Produit</th><th>Total vendu</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $mois=date('m', strtotime('last month'));
        $datas=$op->select_all_top_ten('Vente',$mois,$_SESSION['pos']);
        foreach ($datas as $key => $value) {
            $prod->select($value['prod_id']);
            echo '<tr><td>'.$prod->getProdName().'</td><td>'.$value['tot'].'</td></tr>';
        }
        ?>
    </tbody>
</table>
</div>
</div>
</div>
</div>
