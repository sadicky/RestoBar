<!-- The Modal -->
<div id="myModal" class="modal">

    <!-- Modal content -->
    <div class="modal-content">
        <div class="modal-header">
            <h3 style="text-align: center">Clients</h3>
            <span class="close text-danger">&times;</span>
        </div>
        <div class="form-body  p-1 mb-2 m-0" style="border: 1px gray solid; border-radius: 5px;">
            <form id="frm_edit_customer" method="post" autocomplete="off">
            
              <div class="row" >
                <div class="col-md-2">
                  <label class="control-label">Code</label>
                  <input type="text" id="cust_code" name="cust_code" class="form-control" value="">
                </div>
                <div class="col-md-3">
                  <label class="control-label">Nom*</label>
                  <div class="input_container">
                                    <input type="text" id="content_lib_cust" name="content_lib_cust" class="form-control" value="" required> 
                                    <ul id="content_list_cust"></ul>
                                    <input type="text" name="cust_id" id="cust_idr" value="" />
                                </div>
                </div>
                <div class="col-md-2">
                  <label class="control-label">Tél</label>
                  <input type="number" id="tel" name="tel" class="form-control" value="">
                </div>
                <div class="col-md-2">
                  <label class="control-label">NIF</label>
                  <input type="number" id="cust_num" name="cust_num" class="form-control" value="">
                </div>
                <div class="col-md-2">
                  <label class="control-label">Adresse</label>
                  <input type="text" id="cust_adr" name="cust_adr" class="form-control" value="">
                </div>
                <div class="col-md-1">
                  <br>
                  <input type="hidden" id="personne_id" name="personne_id" class="form-control" value="">
                  <input type="hidden" id="op_id_edit" name="op_id" class="form-control" value="">
                  <button id="Enregistrer" type="submit" class="btn btn-success" name="Enregistrer"><i class="fa fa-save"></i></button>
                </div>
              </div>
            
          </form>
        </div>
        
        <!-- <div class="modal-footer">
            Modal Footer
        </div> -->
    </div>

</div>