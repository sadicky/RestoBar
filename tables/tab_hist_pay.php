<?php
@session_start();
require_once '../load_model.php';
$op= new BeanOperation();
$trans=new beanTransactions();
$paie= new BeanPaiement();
$det= new BeanDetailsOperation();
$prod= new BeanProducts();
$cat= new BeanCategory();
$vente= new BeanVente();
$pers= new BeanPersonne();
$pers2= new BeanPersonne();
$pers3= new BeanPersonne();
$pr=new BeanPrice();

$datas=$trans->select_all_type_period('Vente',$_GET['from_d'],$_GET['to_d']);
?>

<h4>Paiement des Vente du <?php echo $_GET['from_d']; ?>: Au: <?php echo $_GET['to_d']; ?></h4>
<div class="table-responsive">
    <table id="example23" class="table table-bordered table-striped table-sm display tab" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>Date</th><th>N° Fact.</th><th>Montant</th><th>Client</th><th>-</th>
            </tr>
        </thead>

        <tbody>
            <?php
            $totdu=0;
            $totpaie=0;
            $tot_perc=0;
            $i=1;
            foreach ($datas as $un) {

                $vente->select($un['op_id']);
                $op->select($un['op_id']);
                $pers->select($un['party_code']);
                $pers2->select($vente->getAssId());

                $m_vente=$vente->getAmount() - $vente->getRed();
                echo '<tr><td>'.$un['create_date'].'</td><td>'.$vente->getNumVente().'</td><td align="right" class="tc">'.$pers->nb_format($un['amount']);
                $totpaie +=$un['amount'];
                echo '</td><td>'.$pers->getNomComplet().'</td><td>';
                if($un['jour_id']==$_SESSION['jour'])
                {
                echo '<button class="btn btn-danger btn-sm delete_trans" name="delete" id="'.$un["transaction_id"].'"><span class="fa fa-times"></span></button>';
                }
                else
                {
                echo '-';
                }
                echo '</td></tr>';
                 $totdu +=$m_vente;
            }
            ?>
        </tbody>
        <tfoot>
            <tr>
                <th>#</th><th>Total</th><td align="right" id="t1" class="tc"><b><?php echo $pers->nb_format($totpaie); ?></b></td><td>-</td><td>-</td>
            </tr>
        </tfoot>
    </table>
</div>