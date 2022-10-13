<?php
if(isset($_SESSION['op_sort_id']))
{
$op->select($_SESSION['op_sort_id']);
$sort->select($_SESSION['op_sort_id']);
?>
<div id="rapport">
                             <table class="table table-bordered table-striped table-condensed display table-sm" cellspacing="0" width="100%" border="1">
                             <thead>
                                <tr>
                                    <th colspan="4">
                                       <?php include('../entete.php');?>
                                    </th>
                                </tr>
                                <tr>
                                    <th colspan="4">
                                        Bon de Sortie N° <?php echo $sort->getNumSort(); ?><br/>
                                        Date : <?php echo $op->getCreateDate();?><br>
                                        Motif : <?php echo $sort->getTypeSort();?>

                                    </th>
                                </tr>
                                        <tr>
                                            <th>Produit</th><th>Qt</th>
                                        </tr>
                            </thead>

                                    <tbody>
                                    <?php
                                    $datas2=$det->select_all($_SESSION['op_sort_id']);
                                    $tot =0;
                                    foreach ($datas2 as $un) {
                                    $tot +=($un['amount']*$un['quantity']);
                                    $prod->select($un['prod_id']);

                                    echo '<tr><td >'.$prod->getProdName().'</td><td>'.$un['quantity'].'</td></tr>';


                                    }
                                    ?>
    </tbody>

    </table>

</div>
<?php
}
?>