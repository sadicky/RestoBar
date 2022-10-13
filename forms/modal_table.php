<!-- The Modal -->
<div id="myModalTable" class="modal">
    <!-- Modal content -->
    <div class="modal-content">
        <div class="modal-header">
            <h3 style="text-align: center">Table</h3>
            <span class="close text-danger">&times;</span>
        </div>
        <div class="form-body  p-1 mb-2 m-0" style="border: 1px gray solid; border-radius: 5px;">
            <form id="frm_edit_table" method="post" autocomplete="off">
                <div class="row" >
                    <div class="col-md-8">
                        <label class="control-label">Table</label>
                        <input type="text" id="place" name="place" class="form-control" value="<?php echo $vente->getPlace()?>" required>
                    </div>

                    <div class="col-md-2">
                        <br>
                        <input type="hidden" id="personne_id" name="personne_id" class="form-control" value="">
                        <input type="hidden" id="op_edit_table" name="op_id" class="form-control" value="<?php echo $_SESSION['op_vente_id'];?>">
                        <input type="hidden" id="op_type" name="op_type" class="form-control" value="Vente">
                        <button id="Enregistrer" type="submit" class="btn btn-success" name="Enregistrer"><i class="fa fa-save"></i></button>
                    </div>
                </div>

            </form>
        </div>
</div>
</div>