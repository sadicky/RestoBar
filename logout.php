<?php
	require_once('session.php');
	require_once('load_model.php');
	$user_logout = new BeanUsers();

	if($user_logout->is_loggedin()!="")
	{
		$user_logout->redirect('market.php');
	}
	if(isset($_GET['logout']) && $_GET['logout']=="true")
	{
		$user_logout->doLogout();
		$user_logout->redirect('index.php');
	}
