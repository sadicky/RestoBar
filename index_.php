<?php
session_start();
require_once("load_model.php");
$login = new BeanUsers();
$perso = new BeanPersonne();

if($login->is_loggedin()!="")
{
    $login->redirect('config.php');
}

if(isset($_POST['btn-login']))
{
    $login->setUsername(strip_tags($_POST['login']));
    $login->setPassword(strip_tags($_POST['password']));

    if($login->doLogin())
    {

        if($login->getActif()=='1')
        {
        //$_SESSION['user_session']=$login->getUserId();
        $_SESSION['pos']=$_POST['pos'];
        $login->redirect('config.php');
        }
        else
        {
         echo '<script>alert("utilisateur suspendu, contactez l\'administateur");</script>';
        }
    }
    else
    {
        echo '<script>alert("Login ou mot de passe incorrect");</script>';
    }
}
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Easy Bar Resto</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="robots" content="all,follow">
    <?php
    include('include/header_script.php');
    ?>
  </head>
  <body>
    <div class="page login-page">
      <div class="container d-flex align-items-center">
        <div class="form-holder has-shadow">
          <div class="row">
            <!-- Logo & Information Panel-->
            <div class="col-lg-6">
              <div class="info d-flex align-items-center">
                <div class="content">
                  <div class="logo">
                    <h1>Easy RestoBarManager</h1>
                  </div>
                  <img src="img/back.png" style="width: 100%;">
                </div>
              </div>
            </div>
            <!-- Form Panel    -->
            <div class="col-lg-6 bg-white">
              <div class="form d-flex align-items-center">
                <div class="content">
                  <form method="post" class="form-validate">
                    <div class="form-group">
                      <label for="login-username" class="control-label">Login</label>
                      <input name="login" id="login" type="text" name="loginUsername" required class="form-control">

                    </div>
                    <div class="form-group">
                      <label for="login-password" class="control-label">Mot de passe</label>
                      <input id="password" type="password" name="password" required data-msg="Please enter your password" class="form-control">

                    </div>


                    <div class="form-group">
                      <label for="login-password" class="control-label">Point de Vente</label>
                                    <select class="form-control" id="pos" name="pos" required>
                                        <option value="">Choisir</option>
                                        <?php
                                        $datas=$perso->select_all_role('pos');
                                        foreach ($datas as $value) {
                                           echo '<option value="'.$value['personne_id'].'">'.$value['nom_complet'].'</option>';
                                        }

                                        ?>
                                    </select>
                   </div>

                    <button id="btn-login" name="btn-login" type="submit" class="btn btn-primary">Connexion</button>
                    <!-- This should be submit button but I replaced it with <a> for demo purposes-->
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="copyrights text-center">
        <p>Design by <a href="https://bootstrapious.com/admin-templates" class="external">Bootstrapious</a>
          <!-- Please do not remove the backlink to us unless you support further theme's development at https://bootstrapious.com/donate. It is part of the license conditions. Thank you for understanding :)-->
        </p>
      </div>
    </div>
    <!-- JavaScript files-->
    <?php include('include/footer_script.php'); ?>
    <script src="assets/js/script_config.js"></script>
  </body>
</html>
