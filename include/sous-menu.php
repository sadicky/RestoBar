<?php
@session_start();
require_once '../load_model.php';
$mn= new BeanMenu();
$stock=new BeanStock();
$menu=$mn->select_all_menu_type("");
$attrib=new BeanAttributionMenu();

/*if(isset($_POST['parent_id']))
{*/
$group=$attrib->select_all($_SESSION['perso_id']);
/*}
else
{
  $group=$attrib->select_all_2($_SESSION['perso_id'],'25');
}*/
?>
<a class="nav-link" href="javascript:void(0)"  id="param_con" data-id="<?php echo $_SESSION['perso_id']; ?>">
          <i class="fa fa-user"></i> <span class="badge badge-light"></span>
      </a>
        <?php $i=1;
            foreach ($menu as $un) {

              if($un['menu_parent']=='0')
              {
                $sous_menu=$attrib->select_all_3($_SESSION['perso_id'], $un['menu_id']);
                ?>

        <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle text-white" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <?php
          if(!empty($un['menu_icon']))
             {
              //echo '<img src="upload/'.$un['menu_icon'].'" width="30" class="img-thumbnail"> ';
             }
          echo $un['menu_text']; ?>
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <?php
          foreach ($sous_menu as $sm) {
                  ?>
          <a class="dropdown-item" href="#" id="<?php echo $sm['menu_id_text']; ?>" ><?php
          if(!empty($sm['menu_icon']))
             {
              //echo '<img src="upload/'.$sm['menu_icon'].'" width="20" class=""> ';
             }
          if($sm['menu_id_text']=='open_day' and isset($_SESSION['jour']))
          {
            echo 'Cloturer le Journal';
          }
          else
          {
            echo $sm['menu_text'];
          }

          ?></a>
          <div class="dropdown-divider"></div>
                  <?php
                }
          ?>
        </div>
        </li>
        <?php
          }
          elseif($un['menu_group']=='0')
          {
            ?>
        <li class="nav-item">
            <a  class="nav-link text-white" href="javascript:void(0)" id="<?php echo $un['menu_id_text']; ?>">
             <?php
             if(!empty($un['menu_icon']))
             {
              echo '<img src="upload/'.$un['menu_icon'].'" width="30" class="img-thumbnail"> ';
             }
             echo $un['menu_text']; ?></a>
       </li>
            <?php
          }
        ?>
            <!-- <a href="javascript:void(0)" id="<?php //echo $un['menu_id_text']; ?>" class="btn btn-primary ml-2 mt-1" ><?php //echo $un['menu_text']; ?>

            </a> -->

           <?php

             }

?>