<!-- The Modal -->
<div id="myModalProd" class="modal">

    <!-- Modal content -->
    <div class="modal-content">
        <div class="modal-header">
            <h3 style="text-align: center">Nouveau Produit</h3>
            <span class="close text-danger">&times;</span>
        </div>
        <div class="form-body  p-1 mb-2 m-0" style="border: 1px gray solid; border-radius: 5px;">
            <form id="frm_product_v" method="post" autocomplete="off">
                <div class="form-body">
                    <div class="row p-2 mb-2" style="border: 1px gray solid; border-radius: 5px;">
                        <div class="col-md-2">
                            <div class="form-group">
                                <label class="control-label">Code</label>
                                <input type="number" id="prod_code" name="prod_code" class="form-control" value="<?php if(!empty($_GET['id'])) echo $prod->getProdCode(); else echo $prod->select_last_num();?>" required>
                                <span id="available_msg"></span>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="control-label">Produit</label>
                                <input type="text" id="prod_name" name="prod" class="form-control" value="" required>
                                <span id="available_msg_2"></span>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label class="control-label">Prix</label>
                                <input type="number" id="prod_price" name="prod_price" class="form-control" value="" required>
                            </div>
                        </div>

                        <div class="col-md-2">
                            <label class="control-label">Unité Mes</label>
                            <select class="custom-select" name="unt_mes" id="unt_mes">
                                <?php
                                $datas=array('Bouteille','Plat','Godet','Portion');
                                foreach ($datas as $key => $value) {
                                    echo '<option value="'.$value.'">'.$value.'</option>';
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-md-1">
                            <div class="form-group">
                                <label class="control-label">Nbre El</label>
                                <input type="number" id="nb_el" name="nb_el" class="form-control" value="" required>
                            </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-2">
                            <label class="control-label">Equivalent : </label>
                            <div class="input_container">
                                <input type="text" id="content_lib_prod" name="content_lib_prod" class="form-control" value=""> 
                                <ul id="content_list_prod"></ul>
                                <input type="hidden" name="prod_equiv" id="prod_equiv" value="" />
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label class="control-label">Catégorie</label>  
                            <div class="input_container">
                                <input type="text" id="content_lib_cat" name="content_lib_cat" class="form-control" value="" required> 
                                <ul id="content_list_cat"></ul>
                                <input type="hidden" name="cat_id" id="cat_id" value="" />
                            </div>
                        </div>
                        <div class="col-md-2">
                            <label class="control-label">Stockable</label>
                            <select class="custom-select" name="is_stock" id="is_stock">
                                <?php
                                $datas=array('1'=>'Oui','2'=>'Non');
                                foreach ($datas as $key => $value) {
                                    echo '<option value="'.$key.'">'.$value.'</option>';
                                }
                                ?>
                            </select>
                        </div>
                       
                            <div class="col-md-2">
                            <button id="action" data-id="Add" type="submit" class="btn btn-success btn-sm" name="action"> <span class="fa fa-save"></span> Enregistrer</button>
                          </div>

                        <input type="hidden" name="is_tva" id="is_tva" value="2" />
                        <input type="hidden" name="operation" id="operation" value="Add" />
                           
                        </div>
                    </div>
                </div>
            </form>
        </div>
        
        <!-- <div class="modal-footer">
            Modal Footer
        </div> -->
    </div>

</div>