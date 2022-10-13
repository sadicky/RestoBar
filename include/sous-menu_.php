<?php
@session_start();
require_once '../load_model.php';
$mn= new BeanMenu();
$stock=new BeanStock();
$menu=$mn->select_all_menu_type("");
$attrib=new BeanAttributionMenu();

if(isset($_POST['parent_id']))
{
$sous_menu=$attrib->select_all_2($_SESSION['perso_id'],$_POST['parent_id']);
?>
        <?php $i=1;
            foreach ($sous_menu as $sm) {
                if($i%2!=0)
            {
                ?>


            <a href="javascript:void(0)" id="<?php echo $sm['menu_id_text']; ?>" class="btn btn-primary ml-2 mt-1" ><?php echo $sm['menu_text']; ?>
               <!-- <i class="fa fa-forward pull-right"></i> -->
            </a>

           <?php
            }
                else
                  {
            ?>


               <a href="javascript:void(0)" id="<?php echo $sm['menu_id_text']; ?>" class="btn btn-info ml-2 mt-1"><?php echo $sm['menu_text']; ?>
                <!-- <i class="fa fa-forward pull-right"></i> -->
               </a>

              <?php
                 }
              $i++;
             }
                                                            ?>

                                        <?php

                                        ?>



<?php

}
else
{
    echo 'Choisir le Menu principal';
}
?>
