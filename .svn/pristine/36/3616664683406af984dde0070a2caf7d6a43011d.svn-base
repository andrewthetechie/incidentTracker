<?php
/**
 *
 * Andrew Herrington
 * Last Updated: 11.28.12  
 */

include('includes/php/functions.php');
loginRedirect($session);
if(!isset($_GET['computerID']) || $_GET['computerID'] == "") 
	header("Location: index.php");

include('includes/php/header.php');

$computerID = $_GET['computerID'];

?>

<script src="./includes/js/sorttable.js"></script>
<SCRIPT LANGUAGE="JavaScript">
	
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
	

<?

if(isset($_POST['editComputer']) && $_POST['editComputer']=="editMe")
{
	
	editWorkstation($_POST,$_POST['computerID']);
	echo "<h3>Workstation Data Edited</h3>";
}

?>


	<STYLE>
		tr { background-color: #DDDDDD}
			.initial { background-color: #DDDDDD; color:#000000 }
			.normal { background-color: #CCCCCC }
			.highlight { background-color: #8888FF }
	</style>


	<?php
		$workstationData = getWorkstation($computerID);

	?>


	<h3>Edit Computer</h3>
	<form id="manualEntry" action="editComputer.php?computerID=<? echo $computerID; ?>" method="POST" onSubmit="return validateManualForm()">
	<table border="1"  width="75%" cellpadding="1" cellspacing="1"> 
		<tr>	
			<td>Computer Name:</td>
			<td><input type="text" name="computerName" 
				value="<? echo $workstationData['computerName']; 
				?>" size="<? 
					inputBoxSize($workstationData['computerName']); 
				?>"/></td>
		<tr>
			<td>OS:</td>
			<td><input type="text" name="OS" 
				value="<? echo $workstationData['os'];?>" 
				size="<? 
					inputBoxSize($workstationData['os']);
				?>"/></td>
		</tr>
		<tr>
			<td>Architecture:</td>	
			<td><select name="arch">
				<option value="32-bit"<? 
					if($workstationData['osArch'] == "32-bit")
						echo "selected";
					?>>32-bit</option>
				<option value="64-bit" <? 
					if($workstationData['osArch'] == "64-bit")
						echo "selected";
					?>>64-bit</option>
				<option value="IA64" <?
					if($workstationData['osArch'] == "IA64")
						echo "selected";
					?>>Itanium 64bit</option>
				<option value="ARM" <?
					if($workstationData['osArch'] == "ARM")
						echo "selected";
					?>>ARM</option>
				<option value="Other" <?
					if($workstationData['osArch'] == "Other")
						echo "selected";
					?>>Other/misc</option>
			</select></td>
		<tr>
			<td>Install Date:</td>	
			<?	
				$installDate = split("-",$workstationData['installDate']);
			?>
			<td>
				<input type="text" name="installMonth" 
					onclick="clearDefault(this,'MM')"
					onblur="setDefault(this,'MM')" size="2" 
					maxlength="2" value="<? 
					echo $installDate[1];?>"/> / 
				<input type="text" name="installDay" 
					onclick="clearDefault(this,'DD')" 
					onblur="setDefault(this,'DD')" size="2" 
					 maxlength="2" value="<? 
					echo $installDate[2];?>"/> / 
				<input type="text" name="installYear" 
					onclick="clearDefault(this,'YYYY')"
					onblur="setDefault(this,'YYYY')" size="4" 
					maxlength="4" value="<? 
					echo $installDate[0];?>"/>  
		</tr>
		<tr>
			<td>Workstation Manufacturer:</td>
			<td><input type="text" name="mfg" 
				value="<? echo $workstationData['mfg']; ?>"
				size="<?
					inputBoxSize($workstationData['mfg']);
				?>"/></td>
		</tr>
		<tr>
			<td>Serial:</td>
			<td><input type="text" name="serial" 
				value="<? echo $workstationData['serial']; ?>"
				size="<? 
					inputBoxSize($workstationData['serial']); 
				?>"/></td>
		</tr>
		<tr>
			<td>System Drive:</td>	
			<td><input type="text" name="systemDrive" size="2" 
				value="<? 
					echo $workstationData['systemDrive'];?>"
				size="<?
					inputBoxSize(
						$workstationData['systemDrive']);
				?>"></td>
		</tr>
		<tr>
			<td>OS Directory:</td>	
			<td><input type="text" name="osDirectory"
				value="<?
					echo $workstationData['osDirectory'];?>"
				size="<?
					echo inputBoxSize(
						$workstationData['osDirectory']);
				?>"></td>
		</tr>
		<tr>
			<td>Number of Users:</td>
			<td><input type="text" name="numberOfUsers"
				size="5" maxlength="5" 
				onkeypress="return isNumberKey(event)" 
				value="<? 
					echo $workstationData['numOfUsers']; ?>"
				/></td>
		</tr>
		<tr>
			<td>Motherboard MFG:</td>
			<td><input type="text" name="moboMFG" 
				value="<? 
				echo $workstationData['moboMfg']; ?>"
				size="<? inputBoxSize(
					$workstationData['moboMfg']);?>"
			/></td>
		</tr>
		<tr>
			<td>Motherboard Model:</td>
			<td><input type="text" name="moboModel" 
				value="<?
				echo $workstationData['moboModel'];
				?>" size="<?
				inputBoxSize($workstationData['moboModel']);
				?>"/></td>
		</tr>
		<tr>
			<td>Bios MFG:</td>	
			<td><input type="text" name="biosMFG" 
				value="<?
					echo $workstationData['biosMFG'];
				?>" size="<?
					inputBoxSize($workstationData['biosMFG']);
				?>"/></td>
		</tr>
		<tr>
			<td>Bios Version:</td>
			<td><input type="text" name="biosVer" 
				value="<? 
				echo $workstationData['biosVer'];
				?>" size="<?
				inputBoxSize($workstationData['biosVer']);
				?>"/></td>
		</tr>
		<tr>
			<td>Memory:</td>
			<td><input type="text" name="memory" size=6 
				onkeypress="return isNumberKey(event)" 
				maxlength=6 value="<?
				echo $workstationData['memory'];
				?>"/> MB</td>
		</tr>
		<tr>
			<td>CPU:</td>
			<td><input type="text" name="cpu" value="<?
				echo $workstationData['cpu'];
			?>" size="<?
				inputBoxSize($workstationData['cpu']);
			?>"/></td>
		</tr>
		<tr>
			<td>CPU Speed:</td>
			<td><input type="text" name="cpuSpeed" size=6 maxlength=6
				onkeypress="return isNumberKey(event)" value="<?
				echo $workstationData['cpuSpeed'];
				?>"/> Mhz</td>
		</tr>
		<tr>	
			<td>Disk Size:</td>
			<td><input type="text" name="diskSize" size=10 maxlength=10
				onkeypress="return isNumberKey(event)" value="<?
				echo $workstationData['totalDisk'];
				?>"/> MB</td>
		</tr>
	</table>
	<input type="submit" value="Edit Computer" />
	<input type="hidden" name="computerID" value="<? echo $computerID; ?>" />
	<input type="hidden" name="editComputer" value="editMe" />
	</form>
	
</div>

<?php include("includes/php/footer.php"); ?>

</body>
</html>
