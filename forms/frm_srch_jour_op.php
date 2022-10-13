
<?php
require_once '../load_model.php';
$acc= new BeanAccounts();
$perso=new BeanPersonne();
$datas=$acc->select_all_role('users');
?>
<div class="card card-info" >
                            <div class="card-header bg-light">Recettes Périodiques</div>
                            <div >
                                <div class="card-body">
                                    <form id="frm_search_jour_op" method="post">
                                        <div class="form-body">
<div class="form-row">
    <div class="col-md-3">
        <div class="form-group">
            <label class="control-label">utilisateurs</label>
            <select class="form-control" id="caisser_op" name="caissier">
                <option value="">Tous</option>
                <?php
                foreach($datas as $un)
                {
                    //$perso->select($un['personne_id']);
                    if(isset($_POST['rech_acc_num']) and $un['acc_id']==$_POST['rech_acc_num'])
                    {
                     echo '<option value="'.$un['acc_id'].'" selected>'.$un['nom_complet'].'</option>';
                    }
                    echo '<option value="'.$un['acc_id'].'">'.$un['nom_complet'].'</option>';
                }
                ?>
            </select>

        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <label class="control-label">Du : </label>
            <input type="text" id="datepicker" name="from" class="form-control" value="<?php echo date("Y-m-d"); ?>" required>
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <label class="control-label">Au : </label>
            <input type="text" id="datepicker2" name="to" class="form-control" value="<?php echo date("Y-m-d"); ?>" required>
        </div>
    </div>
    <div class="col-md-3" >
        <div class="form-group" style="bottom:0;">
            &nbsp;<br/>
            <button id="action" data-id="Add" type="submit" class="btn btn-success" name="search"> <span class="fa fa-search"></span> Recherche</button>
        </div>
    </div>
</div>
</div>
</form>
                                </div>
                            </div>
                </div>


<div id="tab_jour_op">

</div>

