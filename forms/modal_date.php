<!-- The Modal -->
<div id="myModalDate" class="modal">
    <!-- Modal content -->
    <div class="modal-content">
        <div class="modal-header">
            <h3 style="text-align: center">Date d'Opération</h3>
            <span class="close text-danger">&times;</span>
        </div>
        <div class="form-body  p-1 mb-2 m-0" style="border: 1px gray solid; border-radius: 5px;">
            <form id="frm_edit_date_op" method="post" autocomplete="off">
                <div class="row" >
                    <div class="col-md-8">
                        <label class="control-label">Date</label>
                        <input type="date" id="date_op" name="date_op" class="form-control" value="<?php echo $op->getCreateDate()?>" required>
                    </div>

                    <div class="col-md-2">
                        <br>
                        <input type="hidden" id="personne_id" name="personne_id" class="form-control" value="">
                        <input type="hidden" id="op_edit_date" name="op_id" class="form-control" value="">
                        <input type="hidden" id="op_type" name="op_type" class="form-control" value="">
                        <button id="Enregistrer" type="submit" class="btn btn-success" name="Enregistrer"><i class="fa fa-save"></i></button>
                    </div>
                </div>

            </form>
        </div>
</div>
</div>