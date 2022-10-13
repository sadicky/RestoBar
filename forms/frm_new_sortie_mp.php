
<?php
@session_start();
require_once '../load_model.php';
$op= new BeanOperation();
$acc= new BeanAccounts();
$perso=new BeanPersonne();
$pos=new BeanPersonne();
$det= new BeanDetailsOperation();
$prod= new BeanProducts();
$sort= new BeanSortieMatp();
//$datas=$acc->select_all_role('supplier');
?>
<section class="form-row">
<?php
            if(!isset($_SESSION['op_sortie_mp_id']))
            {
            ?>
<div class="col-md-8">
<div class="card card-info" >
<div class="card-header bg-light">Sortie du Stock avec motif</div>
                            <div>
                                <div class="card-body">
                                    <form id="frm_new_sort" method="post">
                                        <div class="form-body">
<div class="form-row">
    <div class="col-md-3">
        <div class="form-group">
            <input type="hidden" id="op_an_id" name="op_an_id" value="">
            <label class="control-label">Motif de sortie</label>
            <select class="form-control select2" name="motif" id="motif" required>
                <option value="">Choisir</option>
                             <?php
                             $motif = array('Impropre','Fermé vide','Cassé','Autre');
                             foreach($motif as $e)
                             {
                               echo '<option value="'.$e.'">'.$e.'</option>';

                             }
                             ?>
                             </select>
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <label class="control-label">Stock source</label>
            <select class="form-control" id="from_pos" name="from_pos" required>
                <option value="">Choisir</option>
                <?php
                $datas=$perso->select_all_role('pos');
                $perso->select($_SESSION['pos']);
                foreach($datas as $un)
                {
                    if($un['personne_id']==$_SESSION['pos'])
                    {
                     echo '<option value="'.$un['personne_id'].'" selected>'.$un['nom_complet'].'</option>';
                    }
                    else
                    {
                     echo '<option value="'.$un['personne_id'].'">'.$un['nom_complet'].'</option>';   
                    }

                }
                ?>
            </select>
            <input type="hidden" id="op_an_id" name="op_an_id" value="">
        </div>
    </div>
    <div class="col-md-3" >
        <input type="hidden" id="datepicker" name="date_sort"  value="<?php echo date("Y-m-d h:i:s"); ?>">
        
        <div class="form-group" style="bottom:0;">
            &nbsp;<br/>

            <button id="action" data-id="Add" type="submit" class="btn btn-sm btn-success" name="search"> <span class="fa fa-plus"></span></button>

        </div>
    </div>
</div>

</div>
</form>
                                </div>
                            </div>
                </div>
</div>
<?php
}
else
{
    ?>
<div class="col-md-12" >
<div id="sortie_form">
<!-- sortie form -->
<?php
if(isset($_SESSION['op_sortie_mp_id']))
{
$op->select($_SESSION['op_sortie_mp_id']);
$sort->select($_SESSION['op_sortie_mp_id']);
$_SESSION['sort_num']=$sort->getNumSort();
}
else
{
$op->select_op_type('Sortie',$_SESSION['pos'],'0');
$_SESSION['op_sortie_mp_id']=$op->getOpId();

$sort->select($_SESSION['op_sortie_mp_id']);
$_SESSION['sort_num']=$sort->getNumSort();
}
if($sort->getTypeSort()=='Production')
{
    echo '<input type="hidden" name="is_sale" id="is_sale" value="Non">';
}
else
{
 echo '<input type="hidden" name="is_sale" id="is_sale" value="Tous">';
}

?>
<div class="card card-info" >
<div class="card-header bg-light">Bon de Sortie stock N°  : #<span id="num_sort"><?php if(isset($_SESSION['sort_num'])){echo $_SESSION['sort_num'];}else {echo '?';} ?>/Type : <?php echo $sort->getTypeSort();?>/Source : <?php $pos->select($op->getPosId()); echo $pos->getNomComplet();?></span></div>
<div class="card-body">
<form id="sort_mat_form" method="post" autocomplete="off">
<div class="form-body">
<div class="form-row">
    <div class="col-md-4">
        <label class="control-label">Produit : </label>
                <div class="input_container">
                    <input type="text" id="content_id_sort" class="form-control">
                    <ul id="content_list_id"></ul>
                </div>
    </div>
    <div class="col-md-2">
        <div class="form-group">
            <label class="control-label">Qté</label>
            <input type="text" id="prod_qt" name="prod_qt" class="form-control" value="" required>
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

            <input type="hidden" id="op_id" name="op_id" class="form-control" value="<?php if(isset($_SESSION['op_sortie_mp_id'])) echo $_SESSION['op_sortie_mp_id'];?>" required>

            <button id="action" data-id="Add" type="submit" class="btn btn-sm btn-warning mr-2" name="action"> <span class="fa fa-plus"></span> </button>

            <a href="javascript:void(0)" class="btn btn-sm btn-success" id="save_sortie"
            <?php
           if(!$det->existop($_SESSION['op_sortie_mp_id']))
           {
            echo ' style="visibility:hidden;" ';
           }
           ?>
            ><i class="fa fa-save"></i> </a>
            <a href="javascript:void(0)" class="btn btn-sm btn-danger" id="cancel_action_sort"
           <?php
           if($det->existop($_SESSION['op_sortie_mp_id']))
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
<div id="tab_details_sort" class="row">
<?php
include('../tables/tab_details_sort.php');
?>
</div>
</div>

                </div>
<!-- fin sortie and tab -->
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
