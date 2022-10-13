<?php
@session_start();
require_once 'load_model.php';
$mn= new BeanMenu();
$stock=new BeanStock();
$menu=$mn->select_all_menu_type("");
$attrib=new BeanAttributionMenu();

$nb_end_prod=$stock->select_nb_end_prod_stk('0','360',$_SESSION['pos']);
?>
<input type="hidden" id="sess_name" name="sess_name" value="<?php echo $_SESSION['nom'];?>">
<nav class="side-navbar">
          <!-- Sidebar Header-->
          <div class="sidebar-header d-flex align-items-center">
            <div class="avatar"><img src="upload/<?php echo $_SESSION['photo'];?>" alt="..." class="img-fluid rounded-circle"></div>
            <div class="title">
              <h1 class="h4"><a href="javascript:void(0)" id="user_param"><?php echo $_SESSION['nom']; ?></a></h1>
              <p><a  href="javascript:void(0)" id="user_profile" data-id="<?php echo $_SESSION['perso_id']; ?>">Changer  mot de passe</a></p>
            </div>
          </div>
          <!-- Sidebar Navidation Menus--><span class="heading">Menu Principale</span>
          <ul class="list-unstyled">
                    <!-- <li class="active"><a href="index.html"> <i class="icon-home"></i>Home </a></li> -->

                    <?php $i=0; foreach ($menu as $un) {
                        $sous_menu=$attrib->select_all_2($_SESSION['perso_id'],$un['menu_id']);
                       ?>
                    <li><a href="#<?php echo 'm'.$i; ?>" aria-expanded="false" data-toggle="collapse"> <i class="icon-interface-windows"></i><?php echo $un['menu_text']; ?> </a>
                      <ul id="<?php echo 'm'.$i; ?>" class="collapse list-unstyled ">
                        <?php foreach ($sous_menu as $sm) {
                                ?>
                        <li><a href="javascript:void(0)" id="<?php echo $sm['menu_id_text']; ?>"><?php echo $sm['menu_text']; ?></a></li>
                        <?php
                                }
                            ?>
                      </ul>
                    </li>
                    <?php
                    $i++;
                        }
                    ?>

          </ul>
        </nav>
