<?php
@session_start();
require_once '../load_model.php';
$cat= new BeanCategory();
$prod=new BeanProducts();
$stock= new BeanStock();
$op= new BeanOperation();
$pers=new BeanPersonne();
//$stk=$_POST['stk'];

if(empty($_POST['pos']))
{
   $pos=$_SESSION['pos'];
}
else
{
    $pos=$_POST['pos'];
}

?>
<div class="white-box">
                            <h4 class="box-title m-b-0">STATISTIQUE DES VENTES

                              <?php
                                /*if($stk=='0')
                                {
                                    echo 'EN GROS';
                                }
                                else{
                                    echo 'EN DETAIL';
                                }*/
                                ?>

                              DU <?php echo $_POST['from_d'].' AU '. $_POST['to_d']; ?></h4>

                            <div class="table-responsive">
               <table class="table table-striped table-bordered table-hover" id="example23">
               <thead>
                                        <tr>
                                           <th>Code</th><th>Produit</th><th>Qté Vendue</th><!-- <th>Prix</th> --><th>Total</th>
                                         </tr>
               </thead>


                                    <tbody>
                  <?php
                  if($pos=='tous')
                  {
                  $datas=$op->select_all_by_period_rap_vente('Vente',$_POST['from_d'],$_POST['to_d']);
                  }
                  else
                  {
                    $datas=$op->select_all_by_period_rap_vente_by_pos('Vente',$_POST['from_d'],$_POST['to_d'],$pos);
                  }

                  $tot=0;
                      foreach ($datas as $un) {

                        if(empty($_POST['user']))
                        {
                        $prod->select($un['prod_id']);
                        $tot_qt=0;
                        $tot_som=0;
                        if($pos=='tous')
                        {
                        $data=$op->select_all_by_period_rap_vente_('Vente',$_POST['from_d'],$_POST['to_d'],$un['prod_id']);
                        }
                        else
                        {
                          $data=$op->select_all_by_period_rap_vente_pos('Vente',$_POST['from_d'],$_POST['to_d'],$un['prod_id'],$pos);
                        }

                        foreach ($data as $key) {

                          if($key['det']=='1')
                            {
                              $tot_qt +=$key['quantity'];

                            }
                            else
                            {
                             $tot_qt +=$key['quantity']*$prod->getUntMes();
                            }
                            $tot_som +=$key['quantity']*$key['amount'];

                        }
                        $tot +=$tot_som;

                        echo '<tr><td>'.$prod->getProdCode().'</td><td>'.$prod->getProdName().'</td><td>'.number_format($tot_qt/*/$prod->getUntMes()*/,'1','.',' ').'</td><td>'.number_format($tot_som,'0','.',' ').'</td></tr>';
                          }
                          else
                          {
                        $prod->select($un['prod_id']);
                        $tot_qt=0;
                        $tot_som=0;
                        if($pos=='tous')
                        {
                        $data=$op->select_all_by_period_rap_vente_('Vente',$_POST['from_d'],$_POST['to_d'],$un['prod_id']);
                        }
                        else
                        {
                          $data=$op->select_all_by_period_rap_vente_pos('Vente',$_POST['from_d'],$_POST['to_d'],$un['prod_id'],$pos);
                        }

                        foreach ($data as $key) {

                          if($key['det']=='1')
                            {
                              if($key['personne_id']==$_POST['user'])
                              {
                              $tot_qt +=$key['quantity'];
                              }

                            }
                            else
                            {
                              if($key['personne_id']==$_POST['user'])
                              {
                             $tot_qt +=$key['quantity']*$prod->getUntMes();
                              }
                            }
                            $tot_som +=$key['quantity']*$key['amount'];

                        }
                        $tot +=$tot_som;

                        echo '<tr><td>'.$prod->getProdName().'</td><td>'.number_format($tot_qt/*/$prod->getUntMes()*/,'1','.',' ').'</td><td>'.number_format($tot_som,'0','.',' ').'</td></tr>';
                           }
                          }
                        ?>
                    </tbody>
                    <tfoot>
                      <tr><th>-</th><th>Total</th><th>-</th><th><?php echo number_format($tot,'0','.',' '); ?></th></tr>
                    </tfoot>
               </table>
              </div>
</div>
