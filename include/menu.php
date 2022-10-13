
<?php
@session_start();
require_once '../load_model.php';
$mn= new BeanMenu();
$stock=new BeanStock();
$menu=$mn->select_all_menu_type("");

?>

  <?php                                  ?>
    <!-- <ul class="nav flex-column"> -->
<div class="row">
        <?php $i=1;
            foreach ($menu as $sm) {
        ?>

        <!-- <li class="nav-item"> -->
          <div class="col-md-2">
            <a href="javascript:void(0)" data-id="<?php echo $sm['menu_id']; ?>" class="button show_menu" >
              <img src="upload/<?php echo $sm['menu_icon']; ?>" width="60%" alt="Photo" class="img-thumbnail"  /><br/>
              <?php echo $sm['menu_text']; ?>

            </a>
        </div>
        <!-- </li> -->
        <?php
              $i++;
        }
          ?>
           </div>
       <!--  </ul> -->