
<?php
@session_start();
require_once '../load_model.php';
$op= new BeanOperation();
$acc= new BeanAccounts();
$perso=new BeanPersonne();
$det= new BeanDetailsOperation();
$prod= new BeanProducts();
$sort= new BeanSortieMatp();
//$datas=$acc->select_all_role('supplier');
?>
<section class="form-row">
    <?php
            if(!isset($_SESSION['op_transf_prod_id']))
            {
            ?>
<div class="col-md-12">
<div class="card card-info" >
                            <div class="card-header bg-light">Approvisionnement Stock Point de Vente</div>
                            <div>
                                <div class="card-body">
                                    <form id="frm_new_transf_prod" method="post">
                                        <div class="form-body">
<div class="form-row">
            <input type="hidden" id="from_pos" name="from_pos" class="form-control" value="<?php echo $_SESSION['pos']; ?>" required>

    <div class="col-md-2">
        <div class="form-group">
            <label class="control-label">Date</label>
             <input type="text" id="datepicker" name="date_sort" class="form-control" value="<?php echo date("Y-m-d"); ?>" required>
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <label class="control-label">Point de vente</label>
            <select class="form-control" id="dest_pos" name="dest_pos" required>
                <option value="">Choisir</option>
                <?php
                $datas=$perso->select_all_role('pos');
                $perso->select($_SESSION['pos']);
                foreach($datas as $un)
                {
                    /*if($un['personne_id']<>$_SESSION['pos'])
                    {*/
                     echo '<option value="'.$un['personne_id'].'">'.$un['nom_complet'].'</option>';
                    //}
                    
                }
                ?>
            </select>
            <input type="hidden" id="op_an_id" name="op_an_id" value="">
        </div>
    </div>
    <div class="col-md-3" >
        <div class="form-group" style="bottom:0;">
            &nbsp;<br/>

            <button id="action" data-id="Add" type="submit" class="btn btn-sm btn-success" name="search"> <span class="fa fa-plus"></span> <span id="label_action"></span></button>

        </div>
    </div>
</div>

<!-- <div class="form-row">
    <div class="col-md-12">
        <label class="label-control">Recherche du Produit</label>
            <input type="text" name="rech_prod_sort" id="rech_prod_sort" value="" class="form-control" />
    </div>
</div>
<div id="tab_srched_prod">

</div> -->
</div>
</form>
                                </div>
                            </div>
                </div>
<!-- <div id="list_prod">

</div> -->
</div>
<?php
            }
            else
            {
            ?>

<div class="col-md-10" >
<div id="sortie_form">
<!-- sortie form -->
<?php
if(isset($_SESSION['op_transf_prod_id']))
{
$op->select($_SESSION['op_transf_prod_id']);
$sort->select($_SESSION['op_transf_prod_id']);
$_SESSION['transf_prod_num']=$sort->getNumSort();
}
else
{
$op->select_op_type('Transfert produit',$_SESSION['pos'],'0');
$_SESSION['op_transf_prod_id']=$op->getOpId();

$sort->select($_SESSION['op_transf_prod_id']);
$_SESSION['transf_prod_num']=$sort->getNumSort();
}
?>
<input type="hidden" name="is_sale" id="is_sale" value="Oui">
<div class="card card-info" >
                            <div class="card-header bg-light"> N° Bon de Sortie stock: #<span id="num_sort"><?php if(isset($_SESSION['transf_prod_num'])){echo $_SESSION['transf_prod_num'];}else {echo '?';} ?></span></div>
                            <div>
                                <div class="card-body">
<form id="transf_produit_form" method="post" autocomplete="off">
 <div class="form-body">
<div class="form-row">
    <div class="col-md-6">
        <label class="control-label">Produit : </label>
                <div class="input_container">
                    <input type="text" id="content_id_ent" class="form-control">
                    <ul id="content_list_id"></ul>
                </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <label class="control-label">Qté</label>
            <input type="number" id="prod_qt" name="prod_qt" class="form-control" value="" required>
        </div>
    </div>


<div class="col-md-3">
    <label class="control-label">&nbsp;&nbsp;</label><br/>
            <input type="hidden" name="prod_id" id="prod_id" />
            <!-- <input type="hidden" name="prod_prix" id="prod_prix" /> -->
            <input type="hidden" name="sort_id" id="sort_id" />
            <input type="hidden" name="det_id" id="det_id" />
            <input type="hidden" name="prod_prix" id="prod_prix" value="0" required>
            <input type="hidden" name="operation" id="operation" value="Add" />

            <input type="hidden" id="sup_id" name="sup_id" class="form-control" value="<?php if(isset($_SESSION['sup_id'])) echo $_SESSION['sup_id'];?>" required>

            <input type="hidden" id="op_id" name="op_id" class="form-control" value="<?php if(isset($_SESSION['op_transf_prod_id'])) echo $_SESSION['op_transf_prod_id'];?>" required>

            <button id="action" data-id="Add" type="submit" class="btn btn-sm btn-warning mr-2" name="action"> <span class="fa fa-plus"></span> </button>

            <a href="javascript:void(0)" class="btn btn-sm btn-success" id="save_transf_prod" <?php
           if(!$det->existop($_SESSION['op_transf_prod_id']))
           {
            echo ' style="visibility:hidden;" ';
           }
           ?>
           ><i class="fa fa-save"></i> </a>
           <a href="javascript:void(0)" class="btn btn-sm btn-danger" id="cancel_action_transf"
           <?php
           if($det->existop($_SESSION['op_transf_prod_id']))
           {
            echo ' style="visibility:hidden;" ';
           }
           ?>
        ><i class="fa fa-times" ></i> </a>
           <span id="save_text"></span>

        </div>
        </div>
</div>
</form>
<hr>
<!-- fin appro-form -->

<!-- debut appro form -->
<div id="tab_details_transf">
<div class="table-responsive">
                             <table class="table table-bordered table-striped table-condensed display table-sm" cellspacing="0" width="100%" border="&" id="dt">
                             <thead>
                                <tr>
                                  <th>Produit</th><th>Unité</th><th>Qté</th><th>-</th>
                                </tr>
                            </thead>
                                    <tbody>
                                    <?php
                                    if(isset($_SESSION['op_transf_prod_id']))
                                    {
                                    $datas2=$det->select_all($_SESSION['op_transf_prod_id']);

                                    foreach ($datas2 as $un) {

                                    $prod->select($un['prod_id']);
                                    //$cat->select($prod->getCategoryId());
                                    echo '<tr><td >'.$prod->getProdName().'</td><td >'.$prod->getUntMes().'</td></td><td>'.$un['quantity'].'</td>';

                                    /*echo '<td><button class="btn btn-warning btn-circle update_det_transf_prod" name="delete" id="'.$un["details_id"].'">';
                                    echo '<span class="fa fa-edit"></span>';
                                    echo '</button></td>';*/

                                    echo '<td><button class="btn btn-sm btn-danger btn-circle delete_det_transf_prod" name="delete" id="'.$un["details_id"].'">';


                                    echo '<span class="fa fa-times"></span>';


                                    echo '</button></td></tr>';

                                    }

                                    }
                                    ?>
    </tbody>
    </table>
</div>
</div>
</div>

                </div>
<!-- fin sortie and tab -->
</div>
</div>
</div>
<?php
}
?>
</section>
<!-- <section id="appro_tab" class="m-0 p-0">
<div class="col-lg-12 " id="appro_tab">

</div>

</section> -->
