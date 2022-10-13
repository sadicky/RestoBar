<?php
@session_start();
require_once '../load_model.php';
$pers= new BeanPersonne();
$cust= new BeanCustomer();

if(isset($_SESSION['cust_id']))
{
    $pers->select($_SESSION['cust_id']);
    $cust->select($_SESSION['cust_id']);
}
echo '<input value="'.$pers->getTableName().'" type="hidden" name="table_name" id="tab_details" data-id="personne_id">';
?>
<div class="card" >
  <div class="card-header bg-light"><h3>Clients (*Champs obligatoire)</h3></div>
  <div class="card-wrapper">
    <div class="card-body">
          <form id="frm_customer_hot" method="post" autocomplete="off">
           
              <div class="row" >
                <div class="col-md-8">
                  <label class="control-label">Recherche(Nom & CNI)</label>
                  <div class="input_container">
                                    <input type="text" id="content_lib_cust_hot" name="content_lib_cust" class="form-control" value=""> 
                                    <ul id="content_list_cust"></ul>
                                    <input type="hidden" name="cust_id" id="cust_id" value="" />
                                </div>
                </div>
                <div class="col-md-4">
                  <label class="control-label">Code</label>
                  <input type="text" id="cust_code" name="cust_code" class="form-control" value="<?php if(isset($_SESSION['cust_id'])) echo $cust->getCustomerCode(); else echo $pers->select_code('Customer');?>">
                </div>
                <div class="col-md-12">
                  <label class="control-label">Nom*</label>
                  <input type="text" id="nom" name="nom" class="form-control" required value="<?php if(isset($_SESSION['cust_id'])) echo $pers->getNomComplet();?>">
                </div>
                <div class="col-md-6">
                  <label class="control-label">Tél</label>
                  <input type="number" id="tel" name="tel" class="form-control" value="<?php if(isset($_SESSION['cust_id'])) echo $pers->getContact();?>">
                </div>
                <div class="col-md-6">
                  <label class="control-label">CNI</label>
                  <input type="text" id="cust_num" name="cust_num" class="form-control" value="<?php if(isset($_SESSION['cust_id'])) echo $cust->getCustomerNum();?>">
                </div>
                <div class="col-md-8">
                  <label class="control-label">Adresse</label>
                  <input type="text" id="cust_adr" name="cust_adr" class="form-control" value="<?php if(isset($_SESSION['cust_id'])) echo $cust->getCustomerAdr();?>">
                </div>
                <div class="col-md-4">
                  <br>
                  
                                <input type="hidden" name="operation" id="operation" value="Add" />

                                <input type="hidden" name="personne_id" id="personne_id" value=""/>

                  <button id="enregistrer_cli" type="submit" class="btn btn-success btn-sm" name="Enregistrer"><i class="fa fa-save"></i></button>
                  <button class="btn btn-primary btn-sm" id="reset_loc" <?php if(!isset($_SESSION['cust_id'])) echo 'disabled="true"'; ?>><i class="fa fa-plus"></i></button>
                </div>
              </div>
           
          </form>   
      </div>
</div>
</div>

