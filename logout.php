<?php

	ob_start();
	session_start();
	session_unset();
	//session_unset($_SESSION['loggedInMember']);
	session_destroy();
	header("Location: index.php");
	ob_end_flush();

?>