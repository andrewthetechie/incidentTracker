<?php
/**
 *
 * Andrew Herrington
 * Last Updated: 11/29/12
 */

include('includes/php/functions.php');
loginRedirect($session);
	if(!isset($_GET['format']) || $_GET['format'] == "")
		header("Location: index.php");
	if(!isset($_GET['computerID']) || $_GET['computerID'] == "")
		header("Location: index.php");

	$computerName = computerIDToName($_GET['computerID']);
	$filePath = "tmp/$computerName-stats.csv";

	generateStatsCSV($filePath,$_GET['computerID']);



	// assume you have a full path to file stored in $filename
	if (!is_file($filePath)) {
 		die('The file appears to be invalid.');
	}	

	$filePath = str_replace('\\', '/', realpath($filePath));
	$fileSize = filesize($filePath);
	$fileName = substr(strrchr('/'.$filePath, '/'), 1);
	$extension = strtolower(substr(strrchr($filePath, '.'), 1));

	// use this unless you want to find the mime type based on extension
	$mime = array('application/octet-stream');

	header('Content-Type: '.$mime);
	header('Content-Disposition: attachment; filename="'.$fileName.'"');
	header('Content-Transfer-Encoding: binary');
	header('Content-Length: '.sprintf('%d', $fileSize));
	header('Expires: 0');

	// check for IE only headers
	if (isset($_SERVER['HTTP_USER_AGENT']) && (strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE') !== false)) {
	  header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
	  header('Pragma: public');
	} else {
	  header('Pragma: no-cache');
	}

	$handle = fopen($filePath, 'rb');
	fpassthru($handle);
	fclose($handle);
	unlink($filePath);
?>


