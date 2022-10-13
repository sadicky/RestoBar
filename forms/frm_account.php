<?php
require_once '../load_model.php';
$acc= new BeanAccounts();
$perso=new BeanPersonne();
$perso->select($_POST['perso_id']);
$acc_num=0;
if($perso->getRole()=='users')
{
$acc_num=$acc->num_generated('10',$perso->getRole());
}
elseif($perso->getRole()=='supplier')
{
$acc_num=$acc->num_generated('11',$perso->getRole());
}
elseif($perso->getRole()=='customer')
{
$acc_num=$acc->num_generated('12',$perso->getRole());
}

?>

<div class="card card-info" >
                            <div class="card-header bg-light">Numero de compte caisse</div>
                            <div >
                                <div class="card-body">
                                    <form id="frm_account" method="post">
                                        <div class="form-body">
<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label class="control-label">Numero</label>

            <input type="text" id="acc_num" name="acc_num" class="form-control" value="<?php echo $acc_num; ?>" required>
        </div>
    </div>
</div>
</div>
<div class="form-actions">
            <input type="hidden" name="acc_id" id="acc_id" />
            <input type="hidden" name="personne_id" id="personne_id" value="<?php echo $_POST['perso_id']; ?>"/>
            <input type="hidden" name="operation" id="operation" value="Add" />
            <label class="control-label">&nbsp;</label>
            <button id="action" data-id="Add" type="submit" class="btn btn-success" name="action"> <span class="fa fa-save"></span> Créer</button>

        </div>
</form>
                                </div>
                            </div>
                </div>

