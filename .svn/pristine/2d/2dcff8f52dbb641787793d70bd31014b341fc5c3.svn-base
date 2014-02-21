<?php
/**
 *
 * Andrew Herrington
 * Last Updated: 11/29/12
 */

include('includes/php/functions.php');
loginRedirect($session);
	if(!isset($_GET['id']) || $_GET['id'] == "")
		header("Location: index.php");
include('includes/php/header.php');
?>

<script src="./includes/js/sorttable.js"></script>
<SCRIPT LANGUAGE="JavaScript">
	function recordIncident(id)
	{
		var baseUrl="recordIncident.php?companyID=";
		var url = baseUrl.concat(id);
		window.location=url;
	}
	function edit(id)
	{
		var baseUrl="editCustomer.php?companyID=";
		var url = baseUrl.concat(id);
		window.location=url;
	}
	
	function viewIncident(id)
	{
		var baseUrl="incidents.php?companyID=";
		var url = baseUrl.concat(id);
		window.location=url;
	}
	
	function computerInventory(id)
	{
		var baseUrl="inventory.php?companyID=";
		var url = baseUrl.concat(id);
		window.location=url;
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
		$workstationData = getWorkstation($_GET['id']);
	?>
	<h3><? echo $workstationData['computerName']; ?> </h3>

	<table border="1"  width="75%" cellpadding="1" cellspacing="1">
		<tr>
			<td>OS:</td>
			<td><? echo $workstationData['os']; ?> </td>
		</tr>
		<tr>
			<td>Architecture:</td>	
			<td><? echo $workstationData['osArch']; ?> </td>
		</td>
		<tr>
			<td>Install Date:</td>	
			<td><? echo $workstationData['installDate']; ?> </td>
		</tr>
		<tr>
			<td>Workstation Manufacturer:</td>
			<td><? echo $workstationData['mfg']; ?> </td>
		</tr>
		<tr>
			<td>Serial:</td>
			<td><? echo $workstationData['serial']; ?> </td>
		</tr>
		<tr>
			<td>System Drive:</td>	
			<td><? echo $workstationData['systemDrive']; ?> </td>
		</tr>
		<tr>
			<td>OS Directory:</td>	
			<td><? echo $workstationData['osDirectory']; ?> </td>
		</tr>
		<tr>
			<td>Number of Users:</td>
			<td><? echo $workstationData['numOfUsers']; ?> </td>
		</tr>
		<tr>
			<td>Motherboard MFG:</td>
			<td><? echo $workstationData['moboMfg']; ?> </td>i
		</tr>
		<tr>
			<td>Motherboard Model:</td>
			<td><? echo $workstationData['moboModel']; ?> </td>
		</tr>
		<tr>
			<td>Bios MFG:</td>	
			<td><? echo $workstationData['biosMFG']; ?> </td>
		</tr>
		<tr>
			<td>Bios Version:</td>
			<td><? echo $workstationData['biosVer']; ?> </td>
		</tr>
		<tr>
			<td>Memory:</td>
			<td><? echo $workstationData['memory']; ?> MB</td>
		</tr>
		<tr>
			<td>CPU:</td>
			<td><? echo $workstationData['cpu']; ?> </td>
		</tr>
		<tr>
			<td>CPU Speed:</td>
			<td><? echo $workstationData['cpuSpeed']; ?> Mhz</td>
		</tr>
		<tr>	
			<td>Disk Size:</td>
			<td><? echo $workstationData['totalDisk']; ?> MB</td>
		</tr>
	</table>
	

	<h3>Averages</h3>
	<table border="1"  width="100%" cellpadding="1" cellspacing="1">
		<tr>
			<th>Time</th>
			<th>Disk Use Avg</th>
			<th>Mem Use Avg</th>
			<th>Processes Avg</th>
		</tr>
		<?
			$average8 = 
				getAverageStats($_GET['id'],"08:00:00");
			$average10 = 
				getAverageStats($_GET['id'],"10:00:00");
			$averageNoon = 
				getAverageStats($_GET['id'],"12:00:00");
			$averageTwo = 
				getAverageStats($_GET['id'],"14:00:00");
			$averageFour = 
				getAverageStats($_GET['id'],"16:00:00");
		



		?>
                <tr>
                        <td>08:00</td>
                        <td <?
                                if($average8['AVG(diskUse)'] >= 90)
                                        echo "bgcolor='#FF0000'";
                                if($average8['AVG(diskUse)'] >= 75)
                                        echo "bgcolor='#FFFF00'";

                                echo ">" .$average8['AVG(diskUse)']; ?></td>
                        <td <?
                                if($average8['AVG(memoryUse)'] >= 80)
                                        echo "bgcolor='#FF0000'";
                                if($average8['AVG(memoryUse)'] >= 55)
                                        echo "bgcolor='#FFFF00'";

                                echo ">" .$average8['AVG(memoryUse)']; ?></td>
                        <td <?
                                if($average8['AVG(numberOfProcesses)'] >= 125)
                                        echo "bgcolor='#FF0000'";
                                if($average8['AVG(numberOfProcesses)'] >= 100)
                                        echo "bgcolor='#FFFF00'";

                                echo ">" .$average8['AVG(numberOfProcesses)']; ?></td>
                </tr>

				<tr>
                        <td>10:00</td>
                        <td <?
                                if($average10['AVG(diskUse)'] >= 90)
                                        echo "bgcolor='#FF0000'";
                                if($average10['AVG(diskUse)'] >= 75)
                                        echo "bgcolor='#FFFF00'";

                                echo ">" .$average10['AVG(diskUse)']; ?></td>
                        <td <?
                                if($average10['AVG(memoryUse)'] >= 80)
                                        echo "bgcolor='#FF0000'";
                                if($average10['AVG(memoryUse)'] >= 55)
                                        echo "bgcolor='#FFFF00'";

                                echo ">" .$average10['AVG(memoryUse)']; ?></td>
                        <td <?
                                if($average10['AVG(numberOfProcesses)'] >= 125)
                                        echo "bgcolor='#FF0000'";
                                if($average10['AVG(numberOfProcesses)'] >= 100)
                                        echo "bgcolor='#FFFF00'";

                                echo ">" .$average10['AVG(numberOfProcesses)']; ?></td>
                </tr>
				
				<tr>
                        <td>12:00</td>
                        <td <?
                                if($averageNoon['AVG(diskUse)'] >= 90)
                                        echo "bgcolor='#FF0000'";
                                if($averageNoon['AVG(diskUse)'] >= 75)
                                        echo "bgcolor='#FFFF00'";

                                echo ">" .$averageNoon['AVG(diskUse)']; ?></td>
                        <td <?
                                if($averageNoon['AVG(memoryUse)'] >= 80)
                                        echo "bgcolor='#FF0000'";
                                if($averageNoon['AVG(memoryUse)'] >= 55)
                                        echo "bgcolor='#FFFF00'";

                                echo ">" .$averageNoon['AVG(memoryUse)']; ?></td>
                        <td <?
                                if($averageNoon['AVG(numberOfProcesses)'] >= 125)
                                        echo "bgcolor='#FF0000'";
                                if($averageNoon['AVG(numberOfProcesses)'] >= 100)
                                        echo "bgcolor='#FFFF00'";

                                echo ">" .$averageNoon['AVG(numberOfProcesses)']; ?></td>
                </tr>

				<tr>
                        <td>14:00</td>
                        <td <?
                                if($averageTwo['AVG(diskUse)'] >= 90)
                                        echo "bgcolor='#FF0000'";
                                if($averageTwo['AVG(diskUse)'] >= 75)
                                        echo "bgcolor='#FFFF00'";

                                echo ">" .$averageTwo['AVG(diskUse)']; ?></td>
                        <td <?
                                if($averageTwo['AVG(memoryUse)'] >= 80)
                                        echo "bgcolor='#FF0000'";
                                if($averageTwo['AVG(memoryUse)'] >= 55)
                                        echo "bgcolor='#FFFF00'";

                                echo ">" .$averageTwo['AVG(memoryUse)']; ?></td>
                        <td <?
                                if($averageTwo['AVG(numberOfProcesses)'] >= 125)
                                        echo "bgcolor='#FF0000'";
                                if($averageTwo['AVG(numberOfProcesses)'] >= 100)
                                        echo "bgcolor='#FFFF00'";

                                echo ">" .$averageTwo['AVG(numberOfProcesses)']; ?></td>
                </tr>

				<tr>
                        <td>16:00</td>
                        <td <?
                                if($averageFour['AVG(diskUse)'] >= 90)
                                        echo "bgcolor='#FF0000'";
                                if($averageFour['AVG(diskUse)'] >= 75)
                                        echo "bgcolor='#FFFF00'";

                                echo ">" .$averageFour['AVG(diskUse)']; ?></td>
                        <td <?
                                if($averageFour['AVG(memoryUse)'] >= 80)
                                        echo "bgcolor='#FF0000'";
                                if($averageFour['AVG(memoryUse)'] >= 55)
                                        echo "bgcolor='#FFFF00'";

                                echo ">" .$averageFour['AVG(memoryUse)']; ?></td>
                        <td <?
                                if($averageFour['AVG(numberOfProcesses)'] >= 125)
                                        echo "bgcolor='#FF0000'";
                                if($averageFour['AVG(numberOfProcesses)'] >= 100)
                                        echo "bgcolor='#FFFF00'";

                                echo ">" .$averageFour['AVG(numberOfProcesses)']; ?></td>
                </tr>


	</table>

	<h3>Stats for last 60 days</h3>
	<a href="downloadStats.php?format=csv&computerID=<? echo $_GET['id']; ?>" 
		>Downlad stats as a CSV</a>
	<table border="1"  width="100%" cellpadding="1" cellspacing="1">
	<tr>
		<th>Date</th>
		<th>Time</th>
		<th>Disk Usage (%)</th>
		<th>Memory Usage (%)</th>
		<th>Number of Processes</th>
		<th>Last Reboot</th>
	</tr>
	<?
		$statsTable = getWorkstationStats($_GET['id'],60);
		
		for($i=0; $i<count($statsTable);$i++)
		{
			$thisRow=$statsTable[$i];
			$date = $thisRow['date'];
			$time = $thisRow['time'];
			$mem = $thisRow['memoryUse'];
			$disk = $thisRow['diskUse'];
			$proc = $thisRow['numberOfProcesses'];
			$lastReboot = epochToHuman($thisRow['lastReboot']);

			echo "<tr>";
				echo "<td>$date</td>";
				echo "<td>$time</td>";
				echo "<td>$disk</td>";
				echo "<td>$mem</td>";
				echo "<td>$proc</td>";
				echo "<td>$lastReboot</td>";
			echo "</tr>";
		}	

	?>
	</table>
</div>

<?php include("includes/php/footer.php"); ?>

</body>
</html>
