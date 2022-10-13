<?php
require_once '../load_model.php';
$acc= new BeanAccounts();
?>

<div class="card card-info" >
                            <div class="card-header bg-light">Coupons</div>
                            <div class="card-wrapper">
                                <div class="card-body">
                                    <form id="frm_coupon" method="post">
                                        <div class="form-body">
<div class="form-row">
    <div class="col-md-6">
        <div class="form-group">
            <label class="control-label">Libellé</label>

            <input type="text" id="coupon_name" name="coupon_name" class="form-control" value="" required>
        </div>
    </div>
</div>
</div>
<div class="form-actions">
            <input type="hidden" name="coupon_id" id="coupon_id" />
            <input type="hidden" name="operation" id="operation" value="Add" />
            <label class="control-label">&nbsp;</label>
            <button id="action" data-id="Add" type="submit" class="btn btn-success" name="action"> <span class="fa fa-save"></span> Enregistrer</button>

        </div>
</form>
                                </div>
                            </div>
                </div>

