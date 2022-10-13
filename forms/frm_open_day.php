<?php
@session_start();
require_once '../load_model.php';
$jour= new BeanJournal();
$trans=new BeanTransactions();
?>

<div class="card" >

    <?php

    if(!isset($_SESSION['jour']))
    {
        ?>
        <div class="card-header bg-light">Ouverture du Journal</div>

        <div class="card-body">
            <form id="frm_open_day" method="post">
                <div class="form-body">
                    <div class="form-row">

                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="control-label">Solde d'Ouverture</label>
                                <input type="number" id="open_balance" name="open_balance" class="form-control" value="0" required>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <input type="hidden" name="operation" id="operation" value="New" />
                            <label class="control-label">&nbsp;</label><br/>
                            <button id="action" data-id="New" type="submit" class="btn btn-success" name="action"> <span class="fa fa-save"></span>Ouvrir journal</button>


                        </div>
                    </div>
                </div>
            </form>
        </div>
        <?php
    }
    else
    {
        ?>
        <div class="card-header bg-light">Cloture du Journal</div>

        <div class="card-body">
            <form id="frm_open_day" method="post">
                <div class="form-body">
                    <div class="form-row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="control-label">Solde de clôture</label>
                                <input type="number" id="open_balance" name="closing_balance" class="form-control" value="<?php
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
        <?php
    }
    ?>
</div>
