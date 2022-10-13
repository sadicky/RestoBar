<?php
@session_start();
require_once '../load_model.php';
$det= new BeanDetailsOperation();
$prod= new BeanProducts();
$achat= new BeanAchats();
$track=new BeanPayTrack();
?>
<div class="table-responsive">
                             <table id="example24" class="table table-bordered table-striped table-condensed display table-sm" cellspacing="0" width="100%" border="1">
                             <thead>
                                        <tr>
                                            <th>Produit</th><th>Prix</th><th>Qt</th><th>-</th><th>-</th>
                                        </tr>
                            </thead>

                                    <tbody>
                                    <?php
                                    if(isset($_SESSION['op_appro_id']))
                                    {
                                    $datas2=$det->select_all($_SESSION['op_appro_id']);
                                    $tot=0;
                                    foreach ($datas2 as $un) {
                                    $prod->select($un['prod_id']);
                                    //$cat->select($prod->getCategoryId());
                                    $tot +=($un['amount']*$un['quantity']);
                                    echo '<tr><td >'.$prod->getProdName().'</td><td>'.number_format($un['amount'],0,'.',',').'</td><td>'.$un['quantity'].'</td>';

                                    echo '<td>';

                                    if($un['amount']!=0)
                                    {
                                    echo '<button class="btn btn-sm btn-success btn-circle update_det" name="update" id="'.$un["details_id"].'"><span class="fa fa-edit"></span></button>';
                                    }
                                    echo '</td>';


                                    echo '</td><td><button class="btn btn-sm btn-danger btn-circle delete_det" name="delete" id="'.$un["details_id"].'">';

                                    echo '<span class="fa fa-times"></span>';


                                    echo '</button></td></tr>';

                                    }
                                    echo '</tbody><tfoot>';

                                    echo '<tr><th>Totaux</th><th>'.number_format($tot,0,'.',',').'</th><th>-</th><th>-</th><th>-</th></tr>';

                                    echo '</tfoot>';
                                    }
                                    ?>
    
    </table>
</div>
<?php
$track->select($_SESSION['op_appro_id'],'0');
?>
<input type="hidden" name="mont_trans" id="mont_trans" value="<?php echo $tot;?>">
<input type="hidden" name="mode_paie" id="mode_paie" value="<?php echo $track->getModePaie();?>">
<input type="hidden" name="date_p" id="date_p" value="<?php echo $track->getDatePay();?>">
