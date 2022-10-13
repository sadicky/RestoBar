<?php
require_once '../load_model.php';
$pl=new BeanPlace();

if(!empty($_GET['id']))
{
    $pl->select_2($_GET['id']);
}
echo '<input value="'.$pl->getTableName().'" type="hidden" name="table_name" id="tab_details" data-id="place_id"/>';
?>
<div class="card card-info" >
    <div class="card-header bg-light">Places</div>
    <div >
        <div class="card-body">
        <div class="row">
            <div class="col-md-12">
            <form id="frm_place" method="post">
                <div class="form-body">
                    <div class="row">
                        <div class="col-md-2">
                            <div class="form-group">
                                <label class="control-label">Code</label>
                                <input type="text" id="place_code" name="place_code" class="form-control" value="<?php if(!empty($_GET['id'])) echo $pl->getPlaceCode();?>">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="control-label">Libellé</label>
                                <input type="text" id="place_lib" name="place_lib" class="form-control" value="<?php if(!empty($_GET['id'])) echo $pl->getPlaceLib();?>">
                            </div>
                        </div>
                        
                                <?php
                                if(isset($_GET['nb']))
                                    { ?>
                                    <div class="col-md-2">
                            <div class="form-group">
                                <label class="control-label">Numéro</label>
                                <input type="number" id="place_num" name="place_num" class="form-control" value="<?php if(!empty($_GET['id'])) echo $pl->getPlaceNum();?>">
                                 </div>
                                </div>
                            <?php } else {?>
                                <input type="hidden" id="place_num" name="place_num" class="form-control" value="<?php if(!empty($_GET['id'])) echo $pl->getPlaceNum();?>">
                            <?php } ?>
                           
                                <?php
                                if(isset($_GET['nb']))
                                    { ?>
                                 <div class="col-md-3">
                                 <div class="form-group">
                                <label class="control-label">Parent</label>
                                <select id="place_parent" name="place_parent" class="custom-select">
                                    <option value="0">Aucun</option>
                                    <?php
                                    $datas=$pl->select_all();
                                    foreach ($datas as $key => $value) {
                                        
                                            if(!empty($_GET['id']) and $value['place_id']==$pl->getPlaceParent())
                                            {
                                                echo '<option value="'.$value['place_id'].'" selected>'.$value['place_lib'].'</option>';
                                            }
                                            echo '<option value="'.$value['place_id'].'">'.$value['place_lib'].'</option>';
                                        
                                    }
                                    ?>
                                </select>
                                </div>
                                </div>
                                <?php } else {?>
                                <input type="hidden" id="place_parent" name="place_parent" class="form-control" value="<?php if(!empty($_GET['id'])) echo $pl->getPlaceParent();?>">
                            <?php } ?>
                            
                <div class="col-md-2">
                    <br>
                    <input type="hidden" name="place_id" id="place_id" value="<?php if(!empty($_GET['id'])) echo $_GET['id'];?>" />
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
    </div>
    <div class="row">
        <div class="col-md-5">
            <div class="place-responsive">
               <table id="example2" class="table-bordered table-striped place-sm display tabx" cellspacing="0" width="100%">
               <thead>
                                        <tr>
                                           <th>Place</th> <th>Code</th><th>Numéro</th><th>Position</th><th>&nbsp;</th><th>&nbsp;</th>
                                        </tr>
               </thead>

                                    <tbody>
          <?php
         $dat1=$pl->select_all();
          foreach ($dat1 as $un) {

            $pl->select($un['place_parent']);
            
            echo '<tr><td><a href="javascript:void(0)" class="place_det" id="'.$un['place_id'].'" data-id="'.$un['place_lib'].'"><i class="fa fa-plus"></i> '.$un['place_lib'].'</a></td><td>'.$un['place_code'].'</td><td>';
            
            echo '<button class="btn btn-primary btn-sm add_new_nb" data-id="'.$un['place_id'].'" id="'.$un['place_id'].'"><i class="fa fa-plus"></i></button>';

            echo '</td><td>';

            echo '<span class="mr-2">
           <input name="state'.$un['place_id'].'" data-id="'.$un['place_id'].'" value="1" type="radio" class="place_state" '; if($un['status']=='1') echo ' checked'; echo '> <label for="Oui">Bar</label>
           </span>';
          
          echo '<span class="mr-2">
          <input name="state'.$un['place_id'].'" data-id="'.$un['place_id'].'" value="2" type="radio" class="place_state" '; if($un['status']=='2') echo ' checked'; echo '> <label for="Non">Hotel</label></span>';

            echo '</td><td><button class="btn btn-sm btn-warning btn-circle place" id="'.$un['place_id'].'" data-id="'.$un['place_id'].'" id="'.$un['place_id'].'"><i class="fa fa-edit"></i></button></td><td>';

            if(!$pl->exist_pl($un['place_id']))
            {
              echo '<button class="btn btn-sm btn-danger btn-circle trash_art" id="'.$un['place_id'].'" data-id="1"><i class="fa fa-times"></i></button>';
            }
            else
            {
              echo '-';
            }

            echo '</td></tr>';
          }
          ?>

        </tbody>
               </table>
              </div>
        </div>
        <div class="col-md-5">
            <?php if(!empty($_GET['place_id']))
            {?>
            <div class="table-responsive">
                <h1>Place : <?php $pl->select_2($_GET['place_id']); echo $pl->getPlaceLib(); ?></h1>
               <table class="table-bordered table-striped table-sm display tab" cellspacing="0" width="100%">
               <thead>
                                        <tr>
                                           <th>Numéro</th><th>Prix</th><th>&nbsp;</th>
                                        </tr>
               </thead>

                                    <tbody>
          <?php

            $dat2=$pl->select_all_parent($_GET['place_id']);
            foreach ($dat2 as $un2) {

                echo '<tr></td><td class="edit_place" contenteditable="true" id="'.$un2['place_id'].'" data-id="place_num">'.$un2['place_num'].'</td><td class="edit_place" contenteditable="true" id="'.$un2['place_id'].'" data-id="place_price">'.$un2['place_price'].'</td><td>';

            if(!$pl->exist_pl($un2['place_id']))
            {
              echo '<button class="btn btn-sm btn-danger btn-circle trash_art" id="'.$un2['place_id'].'" data-id="'.$_GET['place_id'].'"><i class="fa fa-times"></i></button>';
            }
            else
            {
              echo '-';
            }

            echo '</td></tr>';

            }
          
          ?>

        </tbody>
               </table>
              </div>
        <?php }?>
        </div>
    </div>
</div>

