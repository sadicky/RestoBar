<!DOCTYPE html>
<?php
@session_start();
require_once("load_model.php");
$login = new BeanUsers();


/*if($login->is_loggedin())
{
    $login->redirect('market.php');
}*/

if(isset($_POST['btn-login']))
{
    //$login->setUsername(strip_tags($_POST['login']));
    $login->setPassword(strip_tags($_POST['password']));

    if($login->doLogin())
    {
        
        if($login->getActif()=='1')
        {
           if($login->getTypeUser()=='Utilisateur') 
           $login->redirect('market.php');
           else
           $login->redirect('sale_interface.php'); 
            
        }
        else
        {
         echo '<script>alert("utilisateur Suspendu ou il n\'a aucun droit, contactez l\'administateur");</script>';
         //$login->redirect('logout.php');
        }
    }
    else
    {
        echo '<script>alert("Login ou mot de passe incorrect");</script>';
        //$login->redirect('logout.php');
    }
}
/*else
{
   echo '<script>alert("Erreur");</script>'; 
}*/
?>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="au theme template">
    <meta name="author" content="Hau Nguyen">
    <meta name="keywords" content="au theme template">

    <!-- Title Page-->
    <title>RahisiSoft Manager 2.0</title>

    <?php include('include/header_script.php');?>

</head>

<body class="animsition">
    <div class="page-wrapper">
        <div class="page-content--bge5 bg-sucess">
            <div class="container ">
                <div class="login-wrap">
                    <div class="login-content">
                        <div class="login-logo">
                            <a href="#">
                                <img src="img/logo.png" class="m-2 rounded-circle" width="150">
                            </a>
                            <h1 style="font-size: 20px; letter-spacing: 10px; color: #000000;">Rahisi Hotel Resto-Bar Manager</h1>
                            
                        </div>
                        <div class="login-form">
                            <form id="loginform" action="#" method="post" autocomplete="off">
                                <!-- <div class="form-group">
                                    <label style="font-weight: bold; letter-spacing: 2px; color: #000000; margin: 5px;">Pseudo</label>
                                    <input class="au-input au-input--full" type="text" required name="login" id="login" placeholder="Pseudo">
                                </div> -->
                                <div class="form-group">
                                    <label style="font-weight: bold; letter-spacing: 2px; color: #000000; margin: 5px;">Code Secret</label>
                                    <input class="au-input au-input--full" type="password" required name="password" placeholder="Votre Code secret" autofocus>
                                </div>

                                <button class="au-btn au-btn--block  m-2" type="submit" name="btn-login">Connexion</button>

                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <?php include('include/footer_script.php');?>
</body>

</html>
<!-- end document-->
