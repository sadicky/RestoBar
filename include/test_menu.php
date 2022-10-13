<?php

require_once 'load_model.php';
$mn= new BeanMenu();
$stock=new BeanStock();
$menu=$mn->select_all_menu_type("");
$attrib=new BeanAttributionMenu();

$nb_end_prod=$stock->select_nb_end_prod_stk('0','360',$_SESSION['pos']);
?>
<div class="container-fluid">
        <nav class="nav navbar-nav">
            <div class="container">

                <div id="navbar" class="navbar-collapse collapse">
                    <ul class="nav navbar-nav">
                        <!-- <li class="active"><a href="#" class="">Home</a></li> -->
                        <?php foreach ($menu as $un) {
                        $sous_menu=$attrib->select_all_2($_SESSION['perso_id'],$un['menu_id']);
                       ?>
                        <li class=" dropdown">
                            <a href="#" class="dropdown-toggle " data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                <?php echo $un['menu_text']; ?>
                             <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <?php foreach ($sous_menu as $sm) {
                                ?>
                                <li class=" dropdown">
                                    <a href="javascript:void(0)" class="dropdown-toggle " data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" id="<?php echo $sm['menu_id_text']; ?>">
                                        <?php echo $sm['menu_text']; ?>

                                    </a>
                                </li>
                                <li class="divider"></li>
                                <?php
                                }
                            ?>
                                <!-- <li><a href="#">Add New</a></li> -->
                            </ul>
                        </li>
                        <?php
                        }
                    ?>
                    </ul>
                    <ul class="nav navbar-nav pull-right">


                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                          <i class="fa fa-tasks fa-2x"></i> <span class="top-label label label-warning" style="position: absolute;top: 50%; right: 50%; margin-top: -24px; margin-right: -24px;"><?php echo $nb_end_prod; ?></span>
                    </a>
                    <!-- dropdown alerts-->
                    <ul class="dropdown-menu dropdown-alerts">
                        <li>
                            <a href="javascript:void(0)" id="tab_end_stock">
                                <div>
                                    <i class="fa fa-warning fa-fw"></i> Rupture du stock (<?php echo $nb_end_prod; ?>)
                                 </div>
                            </a>
                        </li>
                        <li class="divider"></li>

                    </ul>
                    <!-- end dropdown-alerts -->
                </li>

                        <li class=" dropdown"><a href="#" class="dropdown-toggle active" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">connecté comme  <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a  href="javascript:void(0)" id="user_profile" data-id="<?php echo $_SESSION['perso_id']; ?>">Changer  mot de passe</a></li>
                                <li class="divider"></li>
                                <li><a href="javascript:void(0)" id="user_param">Mon profil</a></li>
                            </ul>
                        </li>
                        <li class=""><a href="logout.php?logout=true">déconnexion</a></li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>
