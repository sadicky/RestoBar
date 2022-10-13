<!-- The Modal -->
<div id="myModalServ" class="modal">

    <!-- Modal content -->
    <div class="modal-content">
        <div class="modal-header">
            <h3 style="text-align: center">Serveur</h3>
            <span class="close text-danger">&times;</span>
        </div>
        <div class="form-body  p-1 mb-2 m-0" style="border: 1px gray solid; border-radius: 5px;">
            <form id="frm_edit_server" method="post" autocomplete="off">
            
              <div class="row" >
                <div class="col-md-2">
                  <label class="control-label">Code</label>
                  <input type="text" id="serv_code" name="serv_code" class="form-control" value="">
                </div>
                <div class="col-md-3">
                  <label class="control-label">Nom*</label>
                  <div class="input_container">
                                    <input type="text" id="content_lib_serv" name="content_lib_serv" class="form-control" value="" required> 
                                    <ul id="content_list_serv"></ul>
                                    <input type="hidden" name="serv_id" id="serv_id" value="" />
                                </div>
                </div>
                <div class="col-md-1">
                  <br>
                  <input type="hidden" id="personne_id2" name="personne_id" class="form-control" value="">
                  <input type="hidden" id="op_id_edit2" name="op_id" class="form-control" value="">
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