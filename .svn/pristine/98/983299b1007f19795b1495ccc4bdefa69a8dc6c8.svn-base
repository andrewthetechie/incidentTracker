<?php
/**
 *
 * Andrew Herrington
 * Last Updated: 11.28.12  
 */

	include('includes/php/functions.php');
	
	loginRedirect($session);

	if(!isset($_POST) || !isset($_POST['type']))
		header("location: index.php");

	$targetPath="tmp/";

	$targetPath = $targetPath . basename($_FILES['uploadedFile']['name']);
	
	switch($_POST['type'])
	{
		case 'initial':
			initialInventoryProcessor($_FILES['uploadedFile']['tmp_name'], $_POST['companyID']);
			header("location: inventory.php?companyID=".$_POST['companyID']);
			break;
		
		case 'monthly':
			monthlyStatProcessor($_FILES['uploadedFile']['tmp_name'], $_POST['computerID']);
			header("location: uploadMonthly.php?status=Status+Uploaded+Successfully");

		default:
			break;

	}
?>
