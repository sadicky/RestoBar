<?php
@session_start();
require_once '../load_model.php';
$op= new BeanOperation();
$perso=new BeanPersonne();
$ass=new BeanPersonne();
$info=new BeanInfoSuppl();
$vente= new BeanVente();
$vente2= new BeanVente();
$op_crt= new BeanVente();
$det= new BeanDetailsOperation();
$prod= new BeanProducts();
$cat= new BeanCategory();
$perso_client=new BeanPersonne();
$pos=new BeanPos();
$serv=new BeanServeur();
$det_client=new BeanInfoSuppl();
$paie=new BeanPaiement();
$cmd=new BeanCoupon();
$cp=new BeanCoupon();
$stock=new BeanStock();
$pl=new BeanPlace();
$tabl=new BeanPlace();
$bq=new BeanBanque();
$paie=new BeanPaiement();
$trans=new BeanTransactions();
$aut=new BeanAutreFrais();
$loc=new BeanLocation();
if(isset($_SESSION['jour']))
{
if(isset($_SESSION['op_vente_id']))
{
if(!isset($_SESSION['cmd']))
{
$_SESSION['cmd']=$cmd->select_last_cmd($_SESSION['op_vente_id']);
}
//$opId=$_SESSION['op_vente_id'];
}
else
{
    $_SESSION['cmd']='';
    //$opId='';
}

if(!isset($_SESSION['place']))
{
 $place='';
 $color='btn-success';
}
else
{
  $place=$_SESSION['place'];
  $color=$_SESSION['color'];
}

?>
<section class="row">

    <?php
            if(!isset($_SESSION['op_vente_id']))
            {
            ?>
<div class="card m-1 w-100">
<div class="card-header bg-light">Saisie des commandes</div>
<div>
<div class="card-body"> 
<!-- <div class="row"> -->
<?php
$dat1=$pl->select_all();
foreach ($dat1 as $key => $val) {
//echo '<div class="col-md-3 col-sm-3 mb-1">';
echo '<h1 style="font-weight:bold; font-size:15pz;"><a href="javascript:void(0)" class="show_cont_det" id="'.$val['place_id'].'" data-id="'.$val['place_lib'].'"><i class="fa fa-plus"></i> <i>'.$val['place_lib'].'</i></a></h1><hr>';
//echo '</div>';
?>
<div class="row pl-2 det<?php echo $val['place_id']; ?> hide_cont_det">
 <?php
 $datas=$pl->select_all_parent($val['place_id']);
 foreach ($datas as $key => $value) {
     //echo '<form  class="new_sale_tab" data-id="'.$value['table_id'].'"  action="javascript:void(0)">';
     echo '<div class="col-md-3 col-sm-3 mb-1">';
     $op_crt->select_tab($value['place_num']);
     if($vente->exist_table_2($value['place_num']) or $loc->exist_chamb_2($value['place_id']))
     {
     $p=$paie->select_sum_op($op_crt->getOpId());
     $valp=$det->select_sum_op($op_crt->getOpId())-$p['paie'];
        $ass->select($op_crt->getAssId());
            echo '<button class="btn btn-danger btn-sm  w-100 row_op_vente" data-id="'.$op_crt->getOpId().'">'.$value['place_num'].' ('.$ass->getNomComplet().')=><b>'.number_format($valp).'</b></button>';
     }
    else
    {
    echo '<button class="btn btn-primary btn-sm  w-100 new_sale_tab" type="submit" data-id="'.$value['place_num'].'">'.$value['place_num'].'</button>'; 
    }
           echo '</div>';
        //echo '</form>';
 }
 
 ?>   
</div>
<?php
}
?>
<!-- </div> -->
<hr>
<div class="row">
    <div class="col-md-12 border border-dark" id="hist_salex">
        
    </div>
</div>

                                </div>
                            </div>
                </div>
<?php
            }
else
            {
if(!isset($_SESSION['op_vente_num']))
{
$vente->select($_SESSION['op_vente_id']);
$_SESSION['op_vente_num']=$vente->getNumVente();
}
$op->select($_SESSION['op_vente_id']);
$vente->select($_SESSION['op_vente_id']);
            ?>
<div class="card w-100">
<div class="card-header bg-light">
<div class="row">
<div class="col-md-2">    
Fact. N° :
<?php echo $vente->getNumVente(); ?>
</div>
<div class="col-md-2">
<a href="javascript:void(0)" class="editTable" id="<?php echo $_SESSION['op_vente_id'] ?>">
Table : <?php $pl->select($vente->getPlace()); echo $pl->getPlaceNum(); ?>
</a>
</div>
<div class="col-md-2">
<a href="javascript:void(0)" class="editDate" id="<?php echo $_SESSION['op_vente_id'] ?>" data-id="<?php echo $vente->getAssId(); ?>">Date : <?php echo $op->getCreateDate(); ?>
</a>
</div>
<div class="col-md-2">
<a href="javascript:void(0)" class="editServ" id="<?php echo $_SESSION['op_vente_id'] ?>" data-id="<?php echo $vente->getAssId(); ?>">Serveur : <?php $perso->select($vente->getAssId()); echo $perso->getNomComplet(); ?>
</a>
</div>
<div class="col-md-2">
<a href="javascript:void(0)" class="editCust" id="<?php echo $_SESSION['op_vente_id'] ?>" data-id="<?php echo $op->getPartyCode(); ?>">Client : <?php $perso->select($op->getPartyCode()); echo $perso->getNomComplet(); ?></a>
</div>
</div>
</div>
<div class="card-body" style="">
<div class="row">
<div class="col-md-6 border border-secondary pt-1">
<?php
include('frm_vente.php');
?>
<h3>Commandes Effectuées</h3>
<div class="row">
        <?php
        $datas=$det->select_all_cmd($_SESSION['op_vente_id']);
        $tot_gen=0;
        foreach ($datas as $key => $value) {
            $cmd->select($value['det']);

            echo '<div class="col-md-4 border ';
            if($cmd->getIsPaid()==0 ) echo 'border-primary '; else echo ' border-danger '; 
            echo ' p-2 mb-2" style="width:100%;">';
            if($cmd->getIsPaid()==0 ) { echo '<a href="javascript:void()" class="btn btn-light btn-sm row_cmd" data-id="'.$value['det'].'" style="cursor:pointer;"><i class="fa fa-edit"></i></a>';
           /*debut check*/
           echo '<input type="checkbox" name="det_fact[]" id="'.$value['det'].'" data-id="'.$value['det'].'" class="pull-right m-1 sep_fact" value="" ';

                    if(isset($_SESSION['list_det']))
                    {
                        if(in_array($value['det'], $_SESSION['list_det'])) { echo "checked";}
                    }

                echo ' style="cursor:pointer" >';

            }
            /*else
            {
            echo '<a href="javascript:void()" class="btn btn-light btn-sm cancel_cmd_pay" data-id="'.$value['det'].'" style="cursor:pointer;"><i class="fa fa-times"></i></a>';    
            }*/
           /*end fact*/
            echo '<ol>';
            $dat=$det->select_all_2($value['det']);
            $tot=0;
            foreach ($dat as $key => $value2) {
                $prod->select($value2['prod_id']);
                $tot +=$value2['quantity']*$value2['amount'];

                echo '<li>'.$prod->getProdName().'->('.$value2['quantity'].')</li>';
            }

            $tot_gen +=$tot;
            echo '</ol>';
            echo '<h5>Sous-Total : '.$perso->nb_format($tot).'</h5>';
            echo '</div>';
        }
        ?>
</div>
</div>
<div class="col-md-6 border border-secondary p-1">
<?php
include('../tables/tab_det_vente.php');
 include('frm_cust_paie_crt.php'); 
?>
<h3>Transfert de Table</h3>  
        <div class="row">  
            <div class="col-md-6">
                <div class="form-group">
                    <label class="control-label">Table (Origine)</label>
                    <select id="trans_table_sale"  name="table_id" class="custom-select">
                        <option value="">Choisir</option>
                        <?php
                        $datas=$tabl->select_all_2();
                        foreach ($datas as $key => $un) {
                                if($vente->exist_table($un['place_num']) and $un['place_num']!=$vente->getPlace())
                                echo '<option value="'.$vente->get_op_table($un['place_num']).'">'.$un['place_num'].'</option>';

                        }
                        ?>
                    </select>
                </div>
            </div>
        </div>
    </div>
 </div>
</div>
</div>
</div>
<?php
    }
    ?>
</section>
<?php include('modal_customer.php'); ?>
<?php include('modal_table.php'); ?>
<?php include('modal_server.php'); ?>
<?php include('modal_date.php'); ?>
<?php
}
?>