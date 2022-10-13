<?php
@session_start();
require_once '../load_model.php';
$op= new BeanOperation();
$pos= new BeanPos();
$tar= new BeanTarif();
$pers=new BeanPersonne();
$det= new BeanDetailsOperation();
$prod= new BeanProducts();
$sort= new BeanSortie();
$bq=new BeanBanque();
$pr=new BeanPrice();
$paie=new BeanPaiement();

$posId=$_SESSION['pos'];
$idPer=$_SESSION['periode'];
if(isset($_SESSION['op_sort_id'])) {
    $op->select($_SESSION['op_sort_id']);
    $sort->select($_SESSION['op_sort_id']);
    $pers->select($op->getPartyCode());
}
?>
<section class="row">
    <div class="col-md-8">
        <div class="card card-info" >
            <div class="card-header bg-light">Sortie - No : <?php echo $sort->getNumSort(); ?></div>
            <div>
                <div class="card-body">
                    <form id="frm_new_sort" method="post" autocomplete="off">
                        <div class="form-body">
                            <div class="row">
                                <div class="col-md-4">
                                <label class="control-label">Type</label>
                                <select class="custom-select" name="type_sort" id="type_sort" required>
                                    <!-- <option value="">Choisir</option> -->
                                    <?php
                                    $typ = array('Perte','Maison','Conversion');
                                    foreach($typ as $e)
                                    {
                                        if($sort->getTypeSort()==$e and isset($_SESSION['op_sort_id']))
                                        {
                                            echo '<option value="'.$e.'" selected>'.$e.'</option>';
                                        }
                                        else
                                        {
                                        echo '<option value="'.$e.'">'.$e.'</option>';
                                        }
                                    }
                                    ?>
                                </select>
                                </div>
                                <div class="col-md-4">
                                <label class="control-label">Motif</label>
                                <select class="custom-select" name="motif" id="motif" required>
                                >
                                   <!--  <option value="">Choisir</option> -->
                                    <?php
                                    $motif = array('Manquant','Moitié Vide','Cassé','Impropre','Consommation Locale','Portion');
                                    foreach($motif as $e)
                                    {
                                        if($sort->getMotif()==$e and isset($_SESSION['op_sort_id']))
                                        {
                                            echo '<option value="'.$e.'" selected>'.$e.'</option>';
                                        }
                                        else
                                        {
                                        echo '<option value="'.$e.'">'.$e.'</option>';
                                        }

                                    }
                                    ?>
                                </select>
                                </div>
                                
                                
                            <div class="col-md-3">
                                <label class="control-label">Date</label>
                                <input type="date" id="date_sort" class="form-control" name="date_sort"  value="<?php if(isset($_SESSION['op_sort_id'])) echo $op->getCreateDate(); else echo date("Y-m-d"); ?>" <?php if(isset($_SESSION['op_sort_id'])) echo 'readonly';?>>
                            </div>
                            <div class="col-md-4">
                                <label class="control-label">Produit : </label>
                                <div class="input_container">
                                    <input type="text" id="content_lib_prod" name="content_lib_prod" class="form-control" value="" required> 
                                    <ul id="content_list_prod"></ul>
                                    <input type="hidden" name="prod_id" id="prod_id" value="" />
                                </div>
                            </div>
                            <div class="col-md-2 p-1">
                                <label class="control-label">P.U.A</label>
                                <input type="number" name="price" id="price" class="form-control">
                            </div>
                            <div class="col-md-2">
                                <label class="control-label">Qt</label>
                                <input type="number" name="qt" id="qt" class="form-control" value="">
                            </div>
                            
                            <div class="col-md-1">
                                <br>
                                <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-save"></i></button>
                                <input type="hidden" name="op_id" id="op_id" value="<?php if(isset($_SESSION['op_sort_id'])) echo $_SESSION['op_sort_id'];?>">
                                <input type="hidden" name="det_id" id="det_id" value="">
                                <input type="hidden" name="operation" id="operation_inv" value="Add">
                            </div>
                        </div>
                    </div>
                </form>
                <hr>
                <form method="post" id="sort-search">
                    <div class="row">
                            <div class="col-md-4">
                                <label class="control-label">Du</label>
                                <input type="date" name="date_from" id="date_from" class="form-control" value="<?php if(!empty($_GET['date_from'])) echo $_GET['date_from']; else echo date('Y-m-d'); ?>">
                            </div>
                            <div class="col-md-4">
                                <label class="control-label">Au</label>
                                <input type="date" name="date_to" id="date_to" class="form-control" value="<?php if(!empty($_GET['date_to'])) echo $_GET['date_to']; else echo date('Y-m-d'); ?>">
                            </div>
                            <div class="col-md-2">
                                <br>
                                <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-search"></i></button>
                            </div>
                    </div>
                </form>
                <div class="title m-3" style="text-align: center; font-weight: bold; font-size: 14px;"><h3>Du <?php echo $_GET['date_from'];?> Au <?php echo $_GET['date_to'];?></h3></div>
                <div class="table-responsive">
                <table class="table table-bordered table-sm tab">
                    <thead>
                        <tr>
                            <th>No</th><th>Date</th><th>Type</th><th>Motif</th><th>Produit</th><th>-</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php
                        $datas=$op->select_all_by_period('Sortie',$_GET['date_from'],$_GET['date_to'],$idPer);

                        foreach ($datas as $key => $value) {
                            
                            $sort->select($value['op_id']);
                            echo '<tr>
                            <td><button class="btn btn-light btn-sm row_edit_sort_hist" style="cursor:pointer" data-id="'.$value['op_id'].'"><i class="fa fa-edit fa-fw" ></i></button> '.$sort->getNumSort().'</td>
                            <td>'.$value['create_date'].'</td><td>'.$sort->getTypeSort().'</td><td>'.$sort->getMotif().'</td><td><ul>';
                                    $datas2=$det->select_all($value['op_id']);
                                    foreach ($datas2 as $un2) {
                                    $prod->select($un2['prod_id']);
                                    echo '<li>'.$un2['quantity'].' '.$prod->getProdName().'</li>';
                                     }
                                    echo '</ul>';
                            echo '</td><td>';

                if($det->nb_op($value['op_id'])==0)
                echo '<button class="btn btn-danger btn-circle btn-sm del_op_sort" name="delete" data-id="'.$value['op_id'].'" id="'.$value['op_id'].'"><i class="fa fa-times"></i></button>';
                else
                    echo '-';

                echo '</td></tr>';
                        }
                        ?>
                    </tbody>
                </table>
            </div>
            </div>
        </div>
    </div>
</div>
<div class="col-md-4">
    <span style="display: none;"><?php include('../tables/tab_bon_sort.php');?></span>
    <p><a href="javascript:void(0)" id="print_rp" class="btn btn-sm btn-success mr-2 mt-2"><i class="fa fa-print"></i> Imprimer</a>
        <a href="javascript:void(0)" class="btn btn-sm btn-info mr-2 mt-2 new_sort"><i class="fa fa-plus"></i> Nouveau</a></p>
        <div class="table-responsive">
            <table class="table table-bordered table-striped table-condensed display table-sm tab">
                <thead>
                    <tr>
                        <th>Produit</th><th>Qt</th><th>Unité</th><th>-</th><th>-</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if(isset($_SESSION['op_sort_id']))
                    {
                        $datas2=$det->select_all($_SESSION['op_sort_id']);
                        $tot=0;
                        foreach ($datas2 as $un) {
                            $prod->select($un['prod_id']);
                             //$pr->select_2($un['prod_id'],$op->getTarId());
                            
                            echo '<tr><td >'.$prod->getProdName().'</td><td>'.$un['quantity'].'</td><td>'.$prod->getUntMes().'</td>';

                            echo '
                            <td><button class="btn btn-success btn-circle btn-sm fetch_inv_op" name="update" id="'.$un["details_id"].'" data-id="'.$un["details_id"].'"><i class="fa fa-edit"></i></button></td><td><button class="btn btn-danger btn-circle btn-sm del_det_sort" name="delete" data-id="'.$un["details_id"].'" id="'.$un["details_id"].'"><i class="fa fa-times"></i></button></td></tr>';

                        }
                    }

                    ?>
                </tbody>
            </table>
        </div>           
    </div>
</section>

