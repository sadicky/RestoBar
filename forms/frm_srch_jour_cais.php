
<?php
require_once '../load_model.php';
$acc= new BeanAccounts();
$perso=new BeanPersonne();
$datas=$acc->select_all_role('users');
?>
<div class="card card-info" >
                            <div class="card-header bg-light">Jounl de caisse périodique</div>
                            <div >
                                <div class="card-body">
                                    <form id="frm_search_jour_cais" method="post">
                                        <div class="form-body">
<div class="form-row">
    <div class="col-md-3">
        <div class="form-group">
            <label class="control-label">Utilisateurs</label>
            <select class="form-control" id="user_acc" name="user_acc">
                <option value="">Tous</option>
                <?php
                foreach($datas as $un)
                {
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
            <input type="text" id="datepicker2" name="to" class="form-control" value="<?php echo date('Y-m-d', strtotime(date("Y-m-d"). ' + 1 days')); //echo date("Y-m-d"); ?>" required>
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

<section id="tab_jour_cais">
<!-- <div class="col-lg-12" >
<div class="alert alert-info" style="background-color: white;" >

</div>
</div> -->
</section>
