<?php
@session_start();
require_once '../load_model.php';
$mn= new BeanMenu();
$mn2= new BeanMenu();
$menu= new BeanMenu();
$mod=new BeanPersonne();
$datas=$mn->select_all();

?>
<div class="white-box" width="100%">
  <hr/>
  <h3 class="box-title m-b-0">Menus de navigation</h3>
    <?php
/*if($_SESSION['level']>=1)
                            {*/
                              ?>
        <p  id="nouveau"><a href="javascript:void(0)" class="btn btn-primary btn-rounded btn-sm" id="frm_menu"> <i class="fa fa-plus"></i> Nouveau</a>

        </p>
        <?php
      //}
      ?>
              <div class="table-responsive">
               <table id="example2" class="table table-bordered table-striped table-condensed display table-sm" cellspacing="0" width="100%">
               <thead>
                                        <tr>
                                            <th>Parent</th><th>Group</th><th>Ordre</th><th>Menu</th><th>Id</th><th>Icon</th><th>&nbsp;</th><th>&nbsp;</th>
                                        </tr>
               </thead>

                                    <tbody>
                  <?php
                                    foreach ($datas as $un) {
                            $mn->select($un['menu_parent']);
                            $mn2->select($un['menu_group']);
                            //$mod->select($un['mod_id']);
                            echo '<tr><td>'.$mn->getMenuText().'</td><td>'.$mn2->getMenuText().'</td><td class="edit_order" data-id="'.$un['menu_id'].'" contenteditable="true">'.$un['menu_order'].'</td><td>'.$un['menu_text'].'</td><td>'.$un['menu_id_text'].'</td><td>';

                              if(empty($un['menu_icon']))
                            {
                        echo '<span id="p'.$un['menu_id'].'"></span><br />
     <span id="upload_icon" class="inputfile"><input type="file" name="file" id="file'.$un['menu_id'].'" class="'.$un['menu_id'].'"/></span>
                                        <label for="file'.$un['menu_id'].'"><i class="fa fa-edit"></i></label>

     <input type="hidden" value="'.$un['menu_id'].'" name="id_ut" id="h'.$un['menu_id'].'"/>';
                            }
                            else
                            {
                            echo '<span id="p'.$un['menu_id'].'"><img src="upload/'.$un['menu_icon'].'" height="50" width="50" alt="Photo" class="img-thumbnail" /></span><br />
     <span id="upload_icon" class="inputfile"><input type="file" name="file" id="file'.$un['menu_id'].'" class="'.$un['menu_id'].'"/></span>
<label for="file'.$un['menu_id'].'"><i class="fa fa-edit"></i></label>

     <input type="hidden" value="'.$un['menu_id'].'" name="id_ut" id="h'.$un['menu_id'].'"/>';
                            }
                             echo '</td><td>';
                             /*if($_SESSION['level']>=2)
                            {*/
                            echo '<button class="btn btn-warning btn-sm btn-circle update_menu" id="'.$un['menu_id'].'"><i class="fa fa-edit"></i></button>';
                            //}
                             echo '</td><td>';

                             /*if($_SESSION['level']>=3)
                            {*/
                            echo '<button class="btn btn-danger btn-sm btn-circle delete_menu" id="'.$un['menu_id'].'" data-id="0"><i class="fa fa-times"></i></button>';

                            //}
                             echo '</td></tr>';

                                    }
                                    ?>
                    </tbody>
               </table>
              </div>
</div>
