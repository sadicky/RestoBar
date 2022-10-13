<?php
@session_start();
require_once '../load_model.php';
$jour= new BeanJournal();
$trans=new BeanTransactions();
?>

<div class="card" >
    <div class="card-header bg-light">Cloture de la caisse</div>

    <div class="card-body">
        <form id="frm_close_day" method="post">
            <div class="form-body">
                <div class="form-row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="control-label">Solde de clôture</label>
                            <input type="number" id="closing_balance" name="closing_balance" class="form-control" value="<?php
                            $balance=$trans->select_bal_jour($_SESSION['jour']);
                            echo $balance
                            ?>" required readonly>

                        </div>
                    </div>

                    <div class="col-md-3">
                        <input type="hidden" name="operation" id="operation" value="End" />
                        <label class="control-label">&nbsp;</label><br/>
                        <button id="action" data-id="End" type="submit" class="btn btn-success" name="action"> <span class="fa fa-save"></span> Clôturer journal</button>

                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
