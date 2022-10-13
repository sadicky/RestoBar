<?php
@session_start();
require_once '../load_model.php';
$cat= new BeanCategory();
$prod=new BeanProducts();
$stock= new BeanStock();
$op= new BeanOperation();
$pers= new BeanPersonne();
$sort=new BeanSortieMatp();

if(empty($_POST['pos']))
{
   $pos=$_SESSION['pos'];
}
else
{
    $pos=$_POST['pos'];
}

$datas=$op->select_all_by_period_rap('Transfert produit',$_POST['from_d'],$_POST['to_d'],$pos)
?>
<div class="white-box">
                            <h4 class="box-title m-b-0">Point de vente :<?php
                            $pers->select($pos);
                             echo $pers->getNomComplet(); ?> /Approvisionnement du <?php echo $_POST['from_d'].' au '. $_POST['to_d']; ?></h4>

                            <div class="table-responsive">
               <table class="table table-striped table-bordered table-hover" id="example23">
               <thead>
                                        <tr>
                                           <th>N°</th><th>Code</th><th>Désignation</th><th>Destination</th><th>Qté</th><th>Nb Pce</th></th><th>P.U.V</th><th>Valeur du Stock</th>
                                         </tr>
               </thead>


                                    <tbody>
                  <?php
                  $i=1;
                                    foreach ($datas as $un) {

                            $pers->select($un['party_code']);
                            $prod->select($un['prod_id']);

                            echo '<tr>
                            <td>'.$i.'</td><td>'.$prod->getProdCode().'</td><td>'.$prod->getProdName().'</td>
                            <td>'.$pers->getNomComplet().'</td><td>'.$un['quantity'].'</td><td>'.$prod->getUntMes().'</td><td>'.$un['amount'].'</td><td>'.$un['amount']*$un['quantity'].'</td>';
                             echo '</tr>';
                             $i++;
                                    }
                                    ?>
                    </tbody>
               </table>
              </div>
</div>
