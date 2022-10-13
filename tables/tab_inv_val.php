<?php
set_time_limit(500);
@session_start();
require_once '../load_model.php';
$cat= new BeanCategory();
$prod=new BeanProducts();
$stock= new BeanStock();
$det = new BeanDetailsOperation();
$pers=new BeanPersonne();
$per=new BeanPeriode();
$op=new BeanOperation();

$per->select($_POST['id_per']);
$pos=$_SESSION['pos'];

if($_SESSION['periode']==$_POST['id_per'])
{
  //echo 'yes';
  $dat=$prod->select_all_2_1('Oui');
  $op->select_one_per($_POST['id_per']);
  $crt_op=$op->getOpId();

  if(empty($op->getOpId()))
  {
    $op->setOpType('7');
    $op->setPartyType('1');
    $op->setJourId($_SESSION['jour']);
    $op->setState(true);
    $op->setPartyCode('-');
    $op->setIsPaid(false);
    $op->setPersonneId($_SESSION['perso_id']);
    $op->setPosId($pos);
    $op->setCreateDate($per->getDebut());

    $crt_op=$op->insert();
    $op->update_one($crt_op,'op_id','id_per',$_SESSION['periode']);
  }

  foreach ($dat as $key => $value) {
    
    $last=$det->select_last_id_by_prod('Approvisionnement',$value['prod_id']);
    $det_id=$last['last_id'];
    $det->select($det_id);

    if(!$op->exist_op_per($_POST['id_per'],$value['prod_id']))
    {
      $det->setProdId($value['prod_id']);
      $det->setOpId($crt_op);
      $det->setQuantity('0');
      $det->setAmount($det->getAmount());
      $det->setDet(true);
      $det->setLot($det->getLot());
      $det->setDateExp($det->getDateExp());

      $last_det=$det->insert();
      $det->update_sup($last_det);
    }
    //echo $det->getLot().' '.$det->getDateExp().'<br>';
  }
}

$datas=$det->select_all_by_type('Inventaire',$_POST['id_per']);
?>
<div class="white-box">
                            <h3 class="box-title m-b-0">Point de vente :<?php
                            $pers->select($pos);
                             echo $pers->getNomComplet(); ?>/FICHE D'INVENTAIRE DU <?php echo $per->getDebut(); ?></h3>

                            <div class="table-responsive">
               <table class="table table-striped table-bordered table-hover" id="example23">
               <thead>
                  <tr>
                    <th>Categorie</th><th>Description</th><th>Stock </th></th><th>P.U.A</th><th>Valeur Stock</th>
                 </tr>
               </thead>
                <tbody>
                  <?php
                  $i=1;
                  $totgen=0;
                            foreach ($datas as $un) {

                            $prod->select($un['prod_id']);
                            $cat->select($prod->getCategoryId());

                            echo '<tr><td>'.$cat->getCategoryName().'</td><td>'.$prod->getProdName().'</td><td class="edit_qt_inv" contenteditable="true" id="'.$un['details_id'].'" data-id="quantity">'.$un['quantity'].'</td><td class="edit_qt_inv" contenteditable="true" id="'.$un['details_id'].'" data-id="amount">'.$un['amount'].'</td><td>'.$un['quantity']*$un['amount'].'</td>';
                             echo '</tr>';
                             $totgen +=$un['quantity']*$un['amount'];
                           
                            }
                                    ?>
 </tbody><thead>
                    <tr>
                        <th>Total général</th><th>-</th><th>-</th><th>-</th><th><?php echo $totgen; ?></th>
                    </tr>
                   </thead>
               </table>
              </div>
</div>
