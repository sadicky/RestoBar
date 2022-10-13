<?php
@session_start();
require_once '../load_model.php';
$det= new BeanDetailsOperation();
$prod= new BeanProducts();

if(isset($_SESSION['op_id'])) 
{
//$_SESSION['nb_fact']=count($_SESSION['op_id']);
?>
<h5>Facture</h5><hr>
<div id="facture">

    <h5 style="font-size: 15px; letter-spacing: 2px; text-align: center;">ESPACE VEGO - KININDO OUEST</h5>
    <div style="font-size:12px;">Facture N° <b><?php echo '?'; ?></b> du <?php echo date('Y-m-d'); ?></div>
    <?php
    include("../entete.php");
    ?> 
    <table class="table table-bordered table-striped table-sm display" cellspacing="0" width="100%" border="1" style="font-size:12px;">

    </table>
    <table class="table table-bordered table-striped table-sm display" cellspacing="0" width="100%" border="1" style="font-size:12px;">
        <thead>
            <tr>
                <th>Produit</th><th>Qté</th><th>PU</th><th>PT</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $tot=0;
            foreach ($_SESSION['op_id'] as $key => $value) {
            $datas2=$det->select_all($value);
            foreach ($datas2 as $un) {

                $prod->select($un['prod_id']);
                $aff_price=$un['amount'];
                $pt=$aff_price*$un['quantity'];

                $tot +=$pt;

                echo '<tr><td >'.$prod->getProdName().'</td><td align="right">'.$un['quantity'].'</td><td align="right">'.number_format($aff_price).'</td><td align="right">'.number_format($pt).'</td></tr>';

            }
            }

            echo '<tr><th colspan="3">TOTAUX</td><td align="right"><b>'.number_format($tot).'</b></td></tr>';
            ?>
        </tbody>
    </table>
    <p align="center">Merci et à bientôt</p>
</div>
<?php
}
?>