<?php
/**
 *
 * Andrew Herrington
 * Last Updated: 11.28.12  
 */

include('includes/php/functions.php');
loginRedirect($session);
if(!isset($_POST['companyID']) || $_POST['companyID'] == "" && !isset($_POST['addType']))
	header("Location: index.php");

include('includes/php/header.php');

$companyID = $_POST['companyID'];

?>

<script src="./includes/js/sorttable.js"></script>
<SCRIPT LANGUAGE="JavaScript">
	function checkFileType(file)
	{
		var name = file.value;
		var ar_name = name.split('.');

		//for ie - sepatarte dir paths (\) from name
		var ar_nm = ar_name[0].split('\\');
		for(var i=0; i<ar_nm.length; i++) var nm=ar_nm[i];

		//check the file extension
		if(ar_name[1] != "txt")
		{
			alert("Only Text Files Allowed");
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
	
	function validateManualForm()
	{

		return true;
	}

	
	function clearDefault(element,defaultText)
	{
		if(element.value == defaultText)
			element.value="";
	}
	
	function setDefault(element,defaultText)
	{
		if(element.value == "")
			element.value=defaultText;
	}

	function isNumberKey(evt)
	{
		var charCode = (evt.which) ? evt.which : event.keyCode
		if (charCode > 31 && (charCode < 48 || charCode > 57))
			return false;
		return true;
	}
</script>
<div id='form_container'>
	<STYLE>
		tr { background-color: #DDDDDD}
			.initial { background-color: #DDDDDD; color:#000000 }
			.normal { background-color: #CCCCCC }
			.highlight { background-color: #8888FF }
	</style>



<?

if(isset($_POST['addType']) && $_POST['addType']=="manual")
{
	$workstationData = array();
	$workstationData[0] = $_POST['computerName'];
	$workstationData[1] = $_POST['OS'];
	$workstationData[2] = $_POST['installYear']."-".$_POST['installMonth']."-".$_POST['installDay'];
	$workstationData[3] = $_POST['mfg'];
	$workstationData[4] = $_POST['serial'];
	$workstationData[5] = $_POST['systemDrive'];
	$workstationData[6] = $_POST['osDirectory'];
	$workstationData[7] = $_POST['numberOfUsers'];
	$workstationData[8] = $_POST['arch'];
	$workstationData[9] = $_POST['moboMFG'];
	$workstationData[10] = $_POST['moboModel'];
	$workstationData[11] = $_POST['biosMFG'];
	$workstationData[12] = $_POST['biosVer'];
	$workstationData[13] = $_POST['memory'];
	$workstationData[14] = $_POST['cpu'];
	$workstationData[15] = $_POST['cpuSpeed'];
	$workstationData[16] = $_POST['diskSize'];
	
	addWorkstation($workstationData,$_POST['companyID']);
	echo "<h3>Workstation Added</h3>";
}

else
{
?>
	<h3>Upload Initial Inventory File</h3>
	<form enctype="multipart/form-data" action="uploader.php" method="POST" id="uploadForm" onSubmit="return validateUploadForm()">
		<input type="hidden" name="MAX_FILE_SIZE" value="1000000" />
		<input type="hidden" name="type" value="initial" />
		<input type="hidden" id="fileOk" value="no" />
		<input type="hidden" name="companyID" value="<? echo $companyID; ?>" />
		<span id="uploadError" style="visibility:hidden">Please choose a correct file to upload<br /></span>
		Choose a file to upload: <input name="uploadedFile" type="file"  onchange="checkFileType(this)"/></br />
		<input type="submit" value="Upload" />
	</form>

	<h3>Or Manual Entry</h3>
	<form id="manualEntry" action="addComputer.php" method="POST" onSubmit="return validateManualForm()">
	<table border="1"  width="75%" cellpadding="1" cellspacing="1"> 
		<tr>	
			<td>Computer Name:</td>
			<td><input type="text" name="computerName" /></td>
		</td>
		<tr>
			<td>OS:</td>
			<td><input type="text" name="OS" /></td>
		</tr>
		<tr>
			<td>Architecture:</td>	
			<td><select name="arch">
				<option value="32-bit">32-bit</option>
				<option value="64-bit" selected>64-bit</option>
				<option value="IA64">Itanium 64bit</option>
				<option value="ARM">ARM</option>
				<option value="Other">Other/misc</option>
			</select></td>
		</td>
		<tr>
			<td>Install Date:</td>	
			<td>
				<input type="text" name="installMonth" 
					value="MM" onclick="clearDefault(this,'MM')"
					onblur="setDefault(this,'MM')" size="2" 
					maxlength="2"/> / 
				<input type="text" name="installDay" 
					value="DD" onclick="clearDefault(this,'DD')" 
					onblur="setDefault(this,'DD')" size="2" 
					 maxlength="2"/> / 
				<input type="text" name="installYear" 
					value="YYYY" onclick="clearDefault(this,'YYYY')"
					onblur="setDefault(this,'YYYY')" size="4" 
					maxlength="4"/>  
		</tr>
		<tr>
			<td>Workstation Manufacturer:</td>
			<td><input type="text" name="mfg" /></td>
		</tr>
		<tr>
			<td>Serial:</td>
			<td><input type="text" name="serial" /></td>
		</tr>
		<tr>
			<td>System Drive:</td>	
			<td><input type="text" name="systemDrive" size="2" 
				value="C:"></td>
		</tr>
		<tr>
			<td>OS Directory:</td>	
			<td><input type="text" name="osDirectory"
				value="C:\Windows"></td>
		</tr>
		<tr>
			<td>Number of Users:</td>
			<td><input type="text" name="numberOfUsers"
				size="5" maxlength="5" 
				onkeypress="return isNumberKey(event)" /></td>
		</tr>
		<tr>
			<td>Motherboard MFG:</td>
			<td><input type="text" name="moboMFG" /></td>
		</tr>
		<tr>
			<td>Motherboard Model:</td>
			<td><input type="text" name="moboModel" /></td>
		</tr>
		<tr>
			<td>Bios MFG:</td>	
			<td><input type="text" name="biosMFG" /></td>
		</tr>
		<tr>
			<td>Bios Version:</td>
			<td><input type="text" name="biosVer" /></td>
		</tr>
		<tr>
			<td>Memory:</td>
			<td><input type="text" name="memory" size=6 
				onkeypress="return isNumberKey(event)" 
				maxlength=6 /> MB</td>
		</tr>
		<tr>
			<td>CPU:</td>
			<td><input type="text" name="cpu" /></td>
		</tr>
		<tr>
			<td>CPU Speed:</td>
			<td><input type="text" name="cpuSpeed" size=6 maxlength=6
				onkeypress="return isNumberKey(event)" /> Mhz</td>
		</tr>
		<tr>	
			<td>Disk Size:</td>
			<td><input type="text" name="diskSize" size=10 maxlength=10
				onkeypress="return isNumberKey(event)" /> MB</td>
		</tr>
	</table>
	<input type="submit" value="Add Computer" />
	<input type="hidden" name="addType" value="manual" />
	<input type="hidden" name="companyID" value="<? echo $companyID; ?>" />
	</form>
<? } ?>
	
</div>

<?php include("includes/php/footer.php"); ?>

</body>
</html>
