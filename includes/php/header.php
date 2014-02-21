<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>VND Incident Tracker</title>
<link rel="stylesheet" type="text/css" href="./includes/css/view.css" media="all">
</head>
<body id="main_body" >
	
	<img src="./includes/images/logo.png"><img id="top" src="./includes/images/top.png" alt="">
	
	
<?php
if($session->logged_in){
	echo "<div id='form_container'>";
  	echo "<h1>Logged In</h1>";
	echo "Welcome <b>$session->username</b>, you are logged in. <a href=\"process.php\">Log Out now</a><br><br>"
		."<h3>".
		"[<a href=\"index.php\">Home</a>]&nbsp;&nbsp;".
		"[<a href=\"recordIncident.php\">Record Incident</a>]&nbsp;&nbsp;".
		"[<a href=\"customers.php\">Customers</a>]&nbsp;&nbsp;".
		"[<a href=\"incidents.php\">Incidents</a>]&nbsp;&nbsp;".
		"[<a href=\"useredit.php\">Edit Account</a>] &nbsp;&nbsp;";
	if($session->isAdmin())
	{
		echo "[<a href=\"admin/admin.php\">User Management</a>] &nbsp;&nbsp;";
		echo "[<a href=\"reports.php\">Reports</a>] &nbsp;&nbsp;";
	}

	echo "<br /><hr /><br />";
   
		echo '<div id="form_container">';
			if(isset($_GET['result']))
			{
				$result = $_GET['result'];
				echo "<h2>$result</h2>";
			}
		echo '</div>';
		echo "</span>";
	echo "</div>";
}
?>