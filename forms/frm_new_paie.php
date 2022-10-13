
<?php
require_once '../load_model.php';
$acc= new BeanAccounts();
$perso=new BeanPersonne();
$datas=$perso->select_all_role('supplier');
?>
<div class="card card-info" >
                            <div class="card-header bg-light">Informations du fournisseurs</div>
                            <div>
                                <div class="card-body">
                                    <form id="frm_search_acc_pay" method="post">
                                        <div class="form-body">
<div class="form-row">
    <div class="col-md-4">
        <div class="form-group">
            <label class="control-label">Fournisseurs</label>
            <select class="form-control" id="rech_acc_num" name="rech_acc_num" required>
                <option value="">Choisir</option>
                <?php
                foreach($datas as $un)
                {
                    $perso->select($un['personne_id']);
                    if(isset($_POST['rech_acc_num']) and $un['acc_id']==$_POST['rech_acc_num'])
                    {
                     echo '<option value="'.$un['acc_id'].'" selected>'.$perso->getNomComplet().'</option>';
                    }
                    echo '<option value="'.$un['acc_id'].'">'.$perso->getNomComplet().'</option>';
                }
                ?>
            </select>

        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label class="control-label">Date de paiement</label>
            <input type="text" id="datepicker" name="date_v" class="form-control" value="<?php echo date("Y-m-d"); ?>" required>
        </div>
    </div>
    <div class="col-md-4" >
        <div class="form-group" style="bottom:0;">
            &nbsp;<br/>
            <button id="action" data-id="Add" type="submit" class="btn btn-success" name="search"> <span class="fa fa-search"></span> Nouveau</button>
        </div>
    </div>
</div>
</div>
</form>
                                </div>
                            </div>
                </div>

<section class="row">
<div class="col-lg-3 " >
<div class="alert alert-info" style="background-color: white;" id="paie_profile">

</div>
</div>
<div class="col-lg-9 " >
<div class="alert alert-info" style="background-color: white;" id="paie_form">

</div>
</div>
</section>
<section class="row">
<div class="col-lg-12 " id="achat_tab_det">

</div>

</section>
