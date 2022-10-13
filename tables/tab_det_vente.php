<?php
$op->select($_SESSION['op_vente_id']);
$vente->select($_SESSION['op_vente_id']);
$perso->select($op->getPersonneId());
$pos->select($op->getPosId());
//$amount=$paie->select_sum_op($_SESSION['op_vente_id']);

?>
<span style="display: none;"><?php include('tab_facture.php');?></span>
<span style="display: none;"><?php include('tab_facture_2.php');?></span>
<span style="display: none;"><?php include('tab_cmd.php');?></span>

<div class="row">
<div class="col-md-12">
    <input type="hidden" value="<?php echo $_SESSION['op_vente_id']; ?>" id="fact_op_id" name="fact_op_id"/>
    <input type="hidden" value="--" id="fact_party_code" name="fact_party_code"/>
    <input type="hidden" value="<?php echo date("Y-m-d"); ?>" id="date_fact_pay" name="date_fact_pay"/>

    <?php
    $sell=$det->select_sum_op($_SESSION['op_vente_id']);
    $p=$paie->select_sum_op($_SESSION['op_vente_id']);
    $pay=($sell-$vente->getRed()-$p['paie']);

    if($pay>0)
    {
        ?>

        <a href="javascript:void(0)" id="print_facture" data-id="<?php //echo $pay; ?>" class="btn btn-success btn-sm mr-1 mt-1"><i class="fa fa-print"></i> Facture (F2)</a>

        <a href="javascript:void(0)" id="print_cmd" data-id="<?php //echo $pay; ?>" class="btn btn-warning btn-sm mr-1 mt-1"><i class="fa fa-print"></i> Commande (F3)</a>
        <?php
    }
    ?>
    <?php if($det->nb_op($_SESSION['op_vente_id'])==0) {?>
    <button class="btn btn-danger btn-sm mr-1 mt-1 del_op_sale" name="delete" data-id="<?php echo $_SESSION['op_vente_id']; ?>" id="<?php echo $_SESSION['op_vente_id']; ?>"><i class="fa fa-times"></i> Annuler</button>
    <?php } else { ?>
    <a href="javascript:void(0)" id="<?php echo $_SESSION['op_vente_id']; ?>" class="btn btn-info btn-sm mr-1 mt-1 close_sale"><i class="fa fa-save"></i> Cloturer (F6)</a>
    <?php }?>

    <a href="javascript:void(0)" id="new_fact" class="btn btn-sm btn-info mr-1 mt-1"><i class="fa fa-plus"></i> Facture (F7)</a>
    <a href="javascript:void(0)" id="new_cmd" class="btn btn-sm btn-success mr-1 mt-1"><i class="fa fa-plus"></i> Commande (F8)</a>
</div>
</div>

    <div class="table-responsive" id="current_det_vente">
        <hr color="blue">
        <div id="tab_det_sous_fact">
            <?php
            if(isset($_SESSION['lot']))
            {
                include('tab_det_sous_fact.php');
            }
            else
            {
                ?>    
                <H3>Commande No <b><?php if(isset($_SESSION['cmd'])) echo $_SESSION['cmd']; ?></b></H3>
                <table class="table table-bordered table-striped table-sm display" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>Désignation</th><th>Accompagnement</th><th>Prix</th><th>Qt</th><th>Tot</th><th>-</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $tot=0;
                        if(isset($_SESSION['op_vente_id']) and !empty($_SESSION['op_vente_id']))
                        {
                            $datas2=$det->select_all($_SESSION['op_vente_id']);
                            $i=1;
                            $next=1;
                            $t=1;
                            $tva=0;
                            foreach ($datas2 as $un) {

                                $prod->select($un['prod_id']);
                                $tot +=$un['quantity']*$un['amount'];

                                if($vente->getTva()=='1')
                                {
                                    $tv=($un['amount']*$un['quantity']);
                                    $tva += round($tv*0.18);
                                }
                                else
                                {
                                    $tva =0;
                                }

                                if($un['det']==$_SESSION['cmd'])
                                {
                                    echo '<tr><td>'.$prod->getProdName();
/*if($prod->getIsTva()=='1')
{
echo '(*)';
}*/
echo '</td>';

//<td class="edit_det_acc" contenteditable="true" id="'.$un['details_id'].'">'.$un['date_exp'].'</td>
echo '<td>';
if($prod->getIsStock()=='Non')
{
 echo '<div class="input_container">
                                    <input type="text" id="content_lib_acc" name="content_lib_acc" class="form-control content_lib_acc" value="'.$un['date_exp'].'" data-id="'.$un['details_id'].'" style="outline: none; border:none;"/> 
                                    <ul class="content_list_acc'.$un['details_id'].'" w-25"></ul>
        </div>';
}
echo '</td>';
echo '<td class="edit_det_price" contenteditable="true" id="'.$un['details_id'].'">'.$un['amount'].'</td><td class="edit_det_qt" contenteditable="true" id="'.$un['details_id'].'">'.$un['quantity'].'</td><td>'.number_format($un['quantity']*$un['amount'],0,'.',',').'</td>';


/*echo '</td><th><button class="btn btn-sm btn-primary btn-circle ch_prod" name="delete" id="-1" data-id="'.$un["prod_id"].'"><span class="fa fa-minus"></span></button></td>';*/

//echo '<td><button class="btn btn-sm btn-success btn-circle save_cmd" data-id="'.$un["details_id"].'"><span class="fa fa-save"></span></button></td>';

echo '<td><button class="btn btn-sm btn-danger btn-circle delete_det_vente" name="delete" id="'.$un["details_id"].'"><span class="fa fa-times"></span></button></td>';


echo '</tr>';
$i++;
}
}



/* echo '<tr><th colspan="4">PTHTVA</th><th>'.number_format($tot,1,'.',',').'</th><th>-</th><th>-</th></tr>';
echo '<tr><th colspan="4">TVA</th><th>'.number_format($tva,1,'.',',').'</th><th>-</th><th>-</th></tr>';*/
/* echo '<tr><th colspan="4">Réduction</th><th>'.number_format($vente->getRed(),1,'.',',').'</th><th>-</th></tr>';*/
/* echo '<tr><th colspan="4">Payé</th><th>'.number_format($sell-$pay,1,'.',',').'</th><th>-</th></tr>';*/
/*echo '<tr><th colspan="4">PTTTC</th><th>'.number_format($tot-$tva,1,'.',',').'</th><th>-</th><th>-</th></tr>';*/
}
?>
</tbody>
</table>
<?php
}
?>
</div>
        


    <!-- fin de detail supplemetaire reduction et tva -->
    <!-- </div> -->
</div>
