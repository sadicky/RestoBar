<?php

	@session_start();
	require_once 'load_model.php';
	$session = new BeanUsers();
	if(!$session->is_loggedin())
	{
		// session no set redirects to login page
		$session->redirect('index.php');
	}
