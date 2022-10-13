<?php
@session_start();
require_once("../load_model.php");
$jour=new BeanJournal();

                    if(!isset($_SESSION['jour']))
                    {
                            ?>
                    <small>Veuillez Ouvrir un Journal</small>
                    <?php
                    }
                        else
                        {
                           $jour->select_by_state('1',$_SESSION['pos'],$_SESSION['perso_id']);
                          ?>
                        <small>Journal courant Depuis : <?php echo $jour->getStartDate(); ?></small>
                        <!-- <a href="?jour=end" class="btn btn-danger btn-sm"><i class="fa fa-minus"></i></a></small> -->
                    <?php
                        }
?>
