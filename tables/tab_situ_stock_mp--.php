<?php
@session_start();
require_once '../load_model.php';
$cat= new BeanCategory();
$prod=new BeanProducts();
$stock= new BeanStock();
$stock2= new BeanStock();
$pers=new BeanPersonne();
$det=new BeanDetailsOperation();
//$price=new BeanPrice();

/*if(isset($_GET['pos']))
{*/
$pos=$_GET['pos'];
/*}
else
{
$pos=$_SESSION['pos'];
}*/

?>
<div class="white-box">

                            <h3 class="box-title m-b-0">
                             <?php
                            /*$pers->select($pos);
                             echo $pers->getNomComplet();*/
                             if($pos=='tous')
                             {
                              echo 'Situation du stock générale';
                             }
                             else
                             {
                             ?>

                             Situation Stock :
                                <?php
                                $pers->select($pos);
                                    if($pos=='tous')
                                    {
                                        echo 'GENERAL';
                                    }
                                    else
                                    {
                                    echo $pers->getNomComplet();
                                    }
                              }
                                ?> A LA DATE DU <?php echo date('Y-m-d'); ?></h3>

                            <div class="table-responsive">
               <table class="table table-striped table-bordered table-hover table-sm" id="example23">
               <thead>
                                        <tr>
                                            <th>Produits</th><th>Unité</th><th>Qté</th><th>PA</th><th>PAT</th><th>PV</th><th>PVT</th>
                                        </tr>
               </thead>


                                    <tbody>
                  <?php
                  if(empty($_GET['cat']))
                  {
                  $datas=$prod->select_all();
                  }
                  else
                  {
                  $datas=$prod->select_all_3($_GET['cat'],'1', '1');
                  }
                  
                  $tot=0;
                  $pat=0;
                  $pvt=0;
                                    foreach ($datas as $un) {
                           
                            $qt_syn=$stock->stock_syn_qt($un['prod_id'],$pos);

                            //echo $qt_syn;
                            $stock->update_qt($qt_syn,$un['prod_id'],$pos);

                            $stock->select($un['prod_id'],$pos);
                            
                            /*if(!empty($stock->getQuantity()) or $stock->getQuantity()!=0)
                            {*/
                            $last=$det->select_last_id_by_prod('Approvisionnement',$un['prod_id']);
                            $det_id=$last['last_id'];
                            $det->select($det_id);
                            //$price->select_2($un['prod_id'],'69');

                            //$stock->update_one($un['prod_id'],'prod_id','pa',$det->getAmount());

                            $pat +=$det->getAmount()*$stock->getQuantity();
                            $pvt +=$un['prod_price']*$stock->getQuantity();
                            echo '<tr>
                           <td>'.$un['prod_name'].'</td><td>'.$un['unt_mes'].'</td><td>';

                              echo $pers->nb_format($stock->getQuantity());

                            echo '</td><td>'.$pers->nb_format($det->getAmount()).'</td><td>'.$pers->nb_format($det->getAmount()*$stock->getQuantity()).'</td><td>'.$pers->nb_format($un['prod_price']).'</td><td>'.$pers->nb_format($un['prod_price']*$stock->getQuantity()).'</td></tr>';
                          //}

                             }

                                    ?>
                    </tbody>
                    <tfoot>
                      <tr>
                        <th>Total</th><th>-</th><th>-</th><th><?php echo $pers->nb_format($pat); ?></th><th>-</th><th>-</th><th><?php echo $pers->nb_format($pvt); ?></th>
                      </tr>
                    </tfoot>
               </table>
              </div>
</div>
