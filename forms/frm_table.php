<?php
require_once '../load_model.php';
$tab=new BeanTabl();

if(!empty($_GET['id']))
{
    $tab->select($_GET['id']);
}
echo '<input value="'.$tab->getTableName().'" type="hidden" name="table_name" id="tab_details" data-id="table_id"/>';
?>
<div class="card card-info" >
    <div class="card-header bg-light">Tables</div>
    <div >
        <div class="card-body">
        <div class="row">
            <div class="col-md-5">
            <form id="frm_table" method="post">
                <div class="form-body">
                    <div class="row">
                        <div class="col-md-5">
                            <div class="form-group">
                                <label class="control-label">Libellé</label>
                                <input type="text" id="table_num" name="table_num" class="form-control" value="<?php if(!empty($_GET['id'])) echo $tab->getTableNum();?>" required>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="form-group">
                                <label class="control-label">Place :</label>
                                <select id="table_parent" name="table_parent" class="custom-select">
                                    <option value="0">Aucun</option>
                                    <?php
                                    $datas=$tab->select_all();
                                    foreach ($datas as $key => $value) {
                                        
                                            if(!empty($_GET['id']) and $value['table_id']==$tab->getTableParent())
                                            {
                                                echo '<option value="'.$value['table_id'].'" selected>'.$value['table_num'].'</option>';
                                            }
                                            echo '<option value="'.$value['table_id'].'">'.$value['table_num'].'</option>';
                                        
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                <div class="col-md-2">
                    <br>
                    <input type="hidden" name="table_id" id="table_id" value="<?php if(!empty($_GET['id'])) echo $_GET['id'];?>" />
                     <button id="action" data-id="Add" type="submit" class="btn btn-success" name="action"> <span class="fa fa-save"></span></button>
                     <?php 
                        if(!empty($_GET['id']))
                        {
                            ?>
                    <input type="hidden" name="operation" id="operation" value="Edit" />
                   
                        <?php
                        }
                        else
                        {
                            ?>
                    <input type="hidden" name="operation" id="operation" value="Add" />
                            <?php
                        }
                        ?>
                </div>
                </div>
            </div>
            </form>
        </div>
        <div class="col-md-7">
            <div class="table-responsive">
               <table id="example2" class="table-bordered table-striped table-sm display tabx" cellspacing="0" width="100%">
               <thead>
                                        <tr>
                                            <th>Table</th><th>&nbsp;</th><th>&nbsp;</th>
                                        </tr>
               </thead>

                                    <tbody>
                  <?php

                    $datas=$tab->select_all();
                                    foreach ($datas as $un) {
                            
                            echo '<tr><td><a href="javascript:void(0)" class="show_cont_det" id="'.$un['table_id'].'" data-id="'.$un['table_num'].'"><i class="fa fa-plus"></i> '.$un['table_num'].'</a></td><td>';

                            echo '<button class="btn btn-warning btn-circle btn-sm tabl" id="'.$un['table_id'].'"><i class="fa fa-edit"></i></button>';

                             echo '</td><td>';
                                    echo '<button class="btn btn-danger btn-circle btn-sm trash_art" id="'.$un['table_id'].'" data-id="0"><i class="fa fa-times"></i></button>';
                                    echo '</td></tr>';

                            $dat2=$tab->select_all_tab($un['table_id']);
                            foreach ($dat2 as $un2) {
                            
                            echo '<tr class="det'.$un['table_id'].' hide_cont_det"><td style="padding-left:25px;">'.$un2['table_num'].'</a></td><td>';

                            echo '<button class="btn btn-warning btn-circle btn-sm tabl" id="'.$un2['table_id'].'"><i class="fa fa-edit"></i></button>';

                             echo '</td><td>';
                                    echo '<button class="btn btn-danger btn-circle btn-sm trash_art" id="'.$un2['table_id'].'" data-id="0"><i class="fa fa-times"></i></button>';
                                    echo '</td></tr>';
                                    }
                                    }
                                    ?>
                    </tbody>
               </table>
              </div>
        </div>
    </div>
</div>

