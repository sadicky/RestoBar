
<?php
require_once '../load_model.php';
$acc= new BeanAccounts();
$perso=new BeanPersonne();
$prod=new BeanProducts();
$datas=$prod->select_all_3('2','1','1');
?>
<div class="card card-info" >
                            <div class="card-header bg-light">Rapport périodique du stock PF</div>
                            <div >
                                <div class="card-body">
                                    <form id="frm_search_rap_stk_pf" method="post">
                                        <div class="form-body">
<div class="form-row">
    <div class="col-md-3">
        <div class="form-group">
            <label class="control-label">Point de vente</label>
            <select class="form-control" id="pos_rap" name="pos">
            <option value="">Local</option>
                <?php
                  $datas=$perso->select_all_role('pos');
                       foreach ($datas as $value) {
                      if($value['personne_id']!=$_SESSION['pos'])
                      {
                      echo '<option value="'.$value['personne_id'].'">'.$value['nom_complet'].'</option>';
                        }
                }
            ?>
        </select>

        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <label class="control-label">Produit</label>
            <select class="form-control select2" id="lib_mp_rap" name="mp">
                <!-- <option value="">Tous</option> -->
                <?php
                foreach($datas as $un)
                {
                    //$perso->select($un['personne_id']);
                    if(isset($_POST['mp']) and $un['prod_id']==$_POST['mp'])
                    {
                     echo '<option value="'.$un['prod_id'].'" selected>'.$un['prod_name'].'</option>';
                    }
                    echo '<option value="'.$un['prod_id'].'">'.$un['prod_name'].'</option>';
                }
                ?>
            </select>

        </div>
    </div>
    <div class="col-md-2">
        <div class="form-group">
            <label class="control-label">Du : </label>
            <input type="text" id="datepicker" name="from" class="form-control" value="<?php echo date("Y-m-d"); ?>" required>
        </div>
    </div>
    <div class="col-md-2">
        <div class="form-group">
            <label class="control-label">Au : </label>
            <input type="text" id="datepicker2" name="to" class="form-control" value="<?php echo date("Y-m-d"); ?>" required>
        </div>
    </div>
    <div class="col-md-2" >
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

<section class="row">
<div class="col-lg-12" >
<div class="alert alert-info" style="background-color: white;" id="tab_rap_stk_pf">

</div>
</div>
</section>
