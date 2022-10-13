
<?php
require_once '../load_model.php';
$acc= new BeanAccounts();
$perso=new BeanPersonne();
$datas=$acc->select_all_role('customer');
?>
<div class="card card-info" >
                            <div class="card-header bg-light">Informations du client</div>
                            <div>
                                <div class="card-body">
                                    <form id="frm_search_acc_pay_cli" method="post">
                                        <div class="form-body">
<div class="form-row">
    <div class="col-md-4">
        <div class="form-group">
            <label class="control-label">N° du Compte Client</label>
            <select class="form-control" id="rech_acc_num_cli" name="rech_acc_num_cli" required>
                <option value="">Choisir</option>
                <?php
                foreach($datas as $un)
                {
                    $perso->select($un['personne_id']);
                    if(isset($_POST['rech_acc_num']) and $un['acc_id']==$_POST['rech_acc_num'])
                    {
                     echo '<option value="'.$un['acc_id'].'" selected>'.$un['acc_num'].' - '.$perso->getNomComplet().'</option>';
                    }
                    echo '<option value="'.$un['acc_id'].'">'.$un['acc_num'].' - '.$perso->getNomComplet().'</option>';
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
<div class="alert alert-info" style="background-color: white;" id="paie_profile_cli">

</div>
</div>
<div class="col-lg-9 " >
<div class="alert alert-info" style="background-color: white;" id="paie_form_cli">

</div>
</div>
</section>
<section class="row">
<div class="col-lg-12 " id="vente_tab_det">

</div>

</section>
