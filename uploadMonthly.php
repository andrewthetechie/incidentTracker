<?php
/**
 *
 * Andrew Herrington
 * Last Updated: 11.28.12  
 */

include('includes/php/functions.php');
loginRedirect($session);
	if((!isset($_GET['computerID']) || $_GET['computerID'] == "") && 
		!isset($_GET['status']))
		header("Location: index.php");
include('includes/php/header.php');

$computerID = $_GET['computerID'];

?>

<SCRIPT LANGUAGE="JavaScript">
	function checkFileType(file)
	{
		var name = file.value;
		var ar_name = name.split('.');

		//for ie - sepatarte dir paths (\) from name
		var ar_nm = ar_name[0].split('\\');
		for(var i=0; i<ar_nm.length; i++) var nm=ar_nm[i];

		//check the file extension
		if(ar_name[1] != "log")
		{
			alert("Only log Files Allowed");
			this.focus();
			document.getElementById("fileOk").value="no";	
		}
		else
		{
			document.getElementById("fileOk").value="yes";	
		}
	}

	function validateUploadForm()
	{
		var fileOk = document.forms['uploadForm']['fileOk'].value;
		if(fileOk == "no" || fileOk != "yes")
		{
			document.getElementById("uploadError").style.visibility="visible";
			document.getElementById("uploadError").style.color="red";
			return false;
		}
	}

</script>
<div id='form_container'>
<?

	if(isset($_GET['status']))
		echo "<h3>" . urldecode($_GET['status']) . "</h3>";
	else
	{
?>


	<STYLE>
		tr { background-color: #DDDDDD}
			.initial { background-color: #DDDDDD; color:#000000 }
			.normal { background-color: #CCCCCC }
			.highlight { background-color: #8888FF }
	</style>

	<h3>Upload Stat File</h3>
	<form enctype="multipart/form-data" action="uploader.php" method="POST" id="uploadForm" onSubmit="return validateUploadForm()">
		<input type="hidden" name="MAX_FILE_SIZE" value="1000000" />
		<input type="hidden" name="type" value="monthly" />
		<input type="hidden" id="fileOk" value="no" />
		<input type="hidden" name="computerID" value="<? echo $computerID; ?>" />
		<span id="uploadError" style="visibility:hidden">Please choose a correct file to upload<br /></span>
		Choose a file to upload: <input name="uploadedFile" type="file"  onchange="checkFileType(this)"/></br />
		<input type="submit" value="Upload" />
	</form>

	
</div>

<?php 

}
include("includes/php/footer.php"); ?>

</body>
</html>
