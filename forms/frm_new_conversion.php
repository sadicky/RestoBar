
<?php
@session_start();
require_once '../load_model.php';
$op= new BeanOperation();
$acc= new BeanAccounts();
$perso=new BeanPersonne();
$det= new BeanDetailsOperation();
$prod= new BeanProducts();
$entre= new BeanEntreProdf();

?>
<section class="form-row">
    <?php
            if(!isset($_SESSION['op_conv_id']))
            {
            ?>
<div class="col-md-10">
<div class="card card-info" >
<div class="card-header bg-light">Nouvelle Conversion</div>
                            <div>
                                <div class="card-body">
                                    <form id="frm_new_conv" method="post">
                                        <div class="form-body">
<div class="form-row">
    <div class="col-md-6">
        <div class="form-group">
            <input type="hidden" id="op_an_id" name="op_an_id" value="">
            <label class="control-label">Bon de Sortie N°</label>
            <select class="form-control select2" name="party_code" id="party_code" required>
                <option value="">Choisir</option>
                             <?php
                             $datas = $op->select_op_paid('Sortie',$_SESSION['pos'],'0');
                             foreach($datas as $un)
                             {
                                if($un['type_sort']=='Conversion')
                                {
                                    if($det->nb_op($un['op_id'])!=0)
                                    {
                               echo '<option value="'.$un['op_id'].'">'.$un['num_sort'].'</option>';
                                    }
                                }

                             }
                             ?>
                             </select>
        </div>
    </div>
    <div class="col-md-3" >
        <input type="hidden" id="datepicker" name="date_conv"  value="<?php echo date("Y-m-d h:i:s"); ?>">
        <input type="hidden" id="dest_pos" name="dest_pos"  value="<?php echo $_SESSION['pos']; ?>">

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
<div id="conv_formx">
<!-- sortie form -->
<?php
if(isset($_SESSION['op_conv_id']))
{
$op->select($_SESSION['op_conv_id']);
$entre->select($_SESSION['op_conv_id']);
$_SESSION['conv_num']=$entre->getNumEnt();
}
else
{
$op->select_op_type('Conversion',$_SESSION['pos'],'0');
$_SESSION['op_conv_id']=$op->getOpId();

$entre->select($_SESSION['op_conv_id']);
$_SESSION['conv_num']=$entre->getNumEnt();
}
?>
<input type="hidden" name="is_sale" id="is_sale" value="Oui">
<div class="card card-info" >
                            <div class="card-header bg-light"> Conversion N° : #<span id="num_conv"><?php if(isset($_SESSION['conv_num'])){echo $_SESSION['conv_num'];}else {echo '?';} ?></span></div>
                            <div>
                                <div class="card-body">
                                    <form id="conv_form" method="post" autocomplete="off">
                                        <div class="form-body" >
<div class="form-row">
    <div class="col-md-3">
        <label class="control-label">Produit : </label>
                <div class="input_container">
                    <input type="text" id="content_id_ent" class="form-control">
                    <ul id="content_list_id"></ul>
                </div>
    </div>
    <div class="col-md-1">
        <div class="form-group">
            <label class="control-label">Qté</label>
            <input type="number" id="prod_qt" name="prod_qt" class="form-control" value="" required>
        </div>
    </div>
    <div class="col-md-2">
        <label class="control-label">Lot : </label>
        <input type="text" id="lot" name="lot" class="form-control" required readonly>
    </div>
    <div class="col-md-1">
        <div class="form-group">
            <label class="control-label">Mois/Exp</label>
            <!-- <input type="number" name="month" maxlength="2" id="month"  class="form-control"> -->
            <select name="month" id="month" class="form-control">
                <?php

                for ($i=1; $i<=12 ; $i++) {
                    if($i<10)
                    {
                    echo '<option value="0'.$i.'">0'.$i.'</option>';
                    }
                    else
                    {
                     echo '<option value="'.$i.'">'.$i.'</option>';
                    }
                }
                ?>
            </select>
        </div>
    </div>
    <div class="col-md-2">
        <div class="form-group">
            <label class="control-label">Année/Exp</label>
            <!-- <input type="number" name="year" maxlength="2" id="year" class="form-control"> -->
            <select name="year" id="year" class="form-control">
                <?php
                $debut=date('Y');
                for ($i=$debut; $i<=($debut +10) ; $i++) {

                     echo '<option value="'.$i.'">'.$i.'</option>';

                }
                ?>
            </select>
        </div>
    </div>


<div class="col-md-3">
    <label class="control-label">&nbsp;&nbsp;</label><br/>
            <input type="hidden" name="prod_id" id="prod_id" />
            <!-- <input type="hidden" name="prod_prix" id="prod_prix" /> -->
            <input type="hidden" name="conv_id" id="conv_id" />
            <input type="hidden" name="det_id" id="det_id" />
            <input type="hidden" name="prod_prix" id="prod_prix" value="0" required>
            <input type="hidden" name="operation" id="operation" value="Add" />

            <input type="hidden" id="sup_id" name="sup_id" class="form-control" value="<?php if(isset($_SESSION['sup_id'])) echo $_SESSION['sup_id'];?>" required>

            <input type="hidden" id="op_id" name="op_id" class="form-control" value="<?php if(isset($_SESSION['op_conv_id'])) echo $_SESSION['op_conv_id'];?>" required>

            <button id="action" data-id="Add" type="submit" class="btn btn-sm btn-warning mr-2" name="action"> <span class="fa fa-plus"></span> </button>

            <a href="javascript:void(0)" class="btn btn-sm btn-success" id="save_conv" <?php
           if(!$det->existop($_SESSION['op_conv_id']))
           {
            echo ' style="visibility:hidden;" ';
           }
           ?>
           ><i class="fa fa-save"></i> </a>
           <a href="javascript:void(0)" class="btn btn-sm btn-danger mr-2" id="cancel_action_conv"
           <?php
           if($det->existop($_SESSION['op_conv_id']))
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
<div class="row">
    <div class="col-md-5">
        <div class="table-responsive">
                             <table class="table table-bordered table-striped table-condensed display table-sm" cellspacing="0" width="100%" border="1">
                             <thead>

                                        <tr>
                                            <th>Produit</th><th>Qt</th><th>Lot</th><th>Date Exp.</th>
                                        </tr>
                            </thead>

                                    <tbody>
                                    <?php
                                    $datas=$det->select_all($op->getPartyCode());
                                    $tot =0;
                                    foreach ($datas as $un) {
                                    $tot +=($un['amount']*$un['quantity']);
                                    $prod->select($un['prod_id']);

                                    echo '<tr class="choose_for_conv" id="'.$un['details_id'].'" style="cursor:pointer"><td> <i class="fa fa-check"></i> '.$prod->getProdName().'</td><td>'.$un['quantity'].'</td><td>'.$un['lot'].'</td><td>'.$un['date_exp'].'</td></tr>';


                                    }
                                    ?>
    </tbody>

    </table>
</div>
    </div>
<div id="tab_details_conv" class="col-md-5">
<div class="table-responsive">
                             <table class="table table-bordered table-striped table-condensed display table-sm" cellspacing="0" width="100%" border="&">
                             <thead>
                                <tr>
                                  <th>Produit</th><th>Qt</th><th>Lot</th><th>Date Exp.</th><th>-</th><th>-</th>
                                </tr>
                            </thead>
                                    <tbody>
                                    <?php
                                    if(isset($_SESSION['op_conv_id']))
                                    {
                                    $datas2=$det->select_all($_SESSION['op_conv_id']);

                                    foreach ($datas2 as $un) {

                                    $prod->select($un['prod_id']);
                                    //$cat->select($prod->getCategoryId());
                                    echo '<tr><td >'.$prod->getProdName().'</td><td>'.$un['quantity'].'</td><td>'.$un['lot'].'</td><td>'.$un['date_exp'].'</td>';

                                    echo '</td><td><button class="btn btn-sm btn-warning btn-circle update_det_conv" name="delete" id="'.$un["details_id"].'">';
                                    echo '<span class="fa fa-edit"></span>';
                                    echo '</button></td>';

                                    echo '</td><td><button class="btn btn-sm btn-danger btn-circle delete_det_conv" name="delete" id="'.$un["details_id"].'">';


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
