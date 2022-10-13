<?php
require_once '../load_model.php';
$pers= new BeanPersonne();
$user=new BeanUsers();
$pos=new BeanPos();
if(!empty($_GET['id']))
{
$pers->select($_GET['id']);
$user->select_2($_GET['id']);
}
?>
<div class="card card-info" >
    <div class="card-header bg-light">Utilisateurs</div>
    <div >
        <div class="card-body">
            <form id="frm_utilisateur" method="post" autocomplete="false">
                <div class="form-body">

                    <div class="form-row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="control-label">Nom & Prénom</label>
                                <input type="text" id="nom" name="nom_ut" class="form-control" value="<?php if(!empty($_GET['id'])) echo $pers->getNomComplet();?>" required>
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="form-group">
                                <label class="control-label">Genre</label>
                                <?php
                                $sexe = array('Homme','Femme');
                                ?>
                                <select class="form-control select2" name="sexe_ut" id="genre">
                                    <?php
                                    foreach($sexe as $e)
                                    {
                                        if(!empty($_GET['id']) and $e==$pers->getGenre())
                                        echo '<option value="'.$e.'" selected>'.$e.'</option>';

                                        echo '<option value="'.$e.'">'.$e.'</option>';

                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label class="control-label">Privilèges</label>
                                <?php
                                $level = array('1','2','3','4');
                                ?>
                                <select class="form-control select2" name="level_user" id="level_user">
                                    <option value="">Choisir</option>

                                    <?php
                                    foreach($level as $e)
                                    {
                                         if(!empty($_GET['id']) and $e==$user->getLevelUser())
                                        echo '<option value="'.$e.'" selected>'.$e.'</option>';

                                        echo '<option value="'.$e.'">'.$e.'</option>';

                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label class="control-label">POS</label>
                                <?php
                                $datas=$pos->select_all();
                                ?>
                                <select class="custom-select" name="pos_id" id="pos_id" required>
                                    <option value="">Choisir</option>
                                    <?php
                                    foreach($datas as $un)
                                    {
                                        if(!empty($_GET['id']) and $un['pos_id']==$user->getPosId())
                                        echo '<option value="'.$un['pos_id'].'" selected>'.$un['pos_name'].'</option>';
                                        echo '<option value="'.$un['pos_id'].'">'.$un['pos_name'].'</option>';

                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                   
                        <div class="col-md-2">
                            <div class="form-group">
                                <label class="control-label">Type</label>
                                <select class="custom-select" name="type_ut" id="type_user" required>
                                    <option value="">--Choisir--</option>
                                    <?php
                                    $datas=array('Utilisateur','Serveur');
                                    foreach ($datas as $key => $value) {
                                       if(!empty($_GET['id']) and $value==$user->getTypeUser())
                                        echo '<option value="'.$value.'" selected>'.$value.'</option>';
                                        echo '<option value="'.$value.'">'.$value.'</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label class="control-label">Pseudo</label>
                                <input type="text" id="pseudo" name="pseudo_ut" value="<?php if(!empty($_GET['id'])) echo $user->getUsername();?>" class="form-control" required>
                                <span id="availability"></span>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="control-label">Mot de passe</label>
                                <input type="password" id="mp" name="mp_ut" value="" class="form-control" <?php if(empty($_GET['id']))echo 'required'; ?>>
                                <span id="availability_pswd"></span>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="control-label">Confirmer</label>
                                <input type="password" id="conf" name="conf_ut" class="form-control"
                                value="" <?php if(empty($_GET['id']))echo 'required'; ?>>
                                <span id="availability_conf"></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-actions">
                        <?php
                        if(!empty($_GET['id']))
                            {
                                ?>
                                <input type="hidden" name="operation" id="operation" value="Edit" />
                                <input type="hidden" name="personne_id" id="person_id" value="<?php echo $_GET['id'];?>" />
                                <input id="Enregistrer" type="submit" class="btn btn-success" name="Enregistrer" value="Modifier"/>
                                <?php
                            }
                            else
                            {
                                ?>
                                <input type="hidden" name="operation" id="operation" value="Add" />
                                <input id="Enregistrer" type="submit" class="btn btn-success" name="Enregistrer" value="Enregistrer"/>
                                <?php
                            }
                            ?>
                    
                    <input id="tel_ut" type="hidden"  name="tel_ut" value="-"/>
                    <input id="email_ut" type="hidden"  name="email_ut" value="-"/>

                    
                 
                </div>
            </form>
            <div id="last_inserted"></div>
        </div>
    </div>
</div>
