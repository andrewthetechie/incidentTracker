<?php
/**
 *
 * Andrew Herrington
 * Last Updated: 8/29/12
 */

include('includes/php/functions.php');
loginRedirect($session);
include('includes/php/header.php');


	if(isset($_GET))
		$_GET = inputCleaner($_GET);
		
	if(isset($_GET['pageNum']))
	{
		$pageNum = $_GET['pageNum'];
	}
	$lastPage = countPages('incidents');
	$companyLookupTable = companyLookupTable();
	$userLookupTable = userLookupTable();
		 
	if (!(isset($pageNum)) || $pageNum < 1) 
	{ 
		$pageNum = 1; 
	}
	if($pageNum > $lastPage)
	{
		$pageNum = $lastPage;
	}
	
	$typeOfSearch="all";
	$clientID="";
	$startDate="";
	$stopDate="";
	$techID="";

	if(isset($_GET['typeOfSearch']) && $_GET['typeOfSearch'] != "")
	{
		$typeOfSearch = $_GET['typeOfSearch'];
	}
	
	if(isset($_GET['clientID']) && $_GET['clientID'] != "")
	{
		$clientID = $_GET['clientID'];
	}
	
	if(isset($_GET['startDate']) && $_GET['startDate'] != "")
	{
		$startDate = $_GET['startDate'];
	}
	
	if(isset($_GET['stopDate']) && $_GET['stopDate'] != "")
	{
		$stopDate = $_GET['stopDate'];
	}
	
	if(isset($_GET['techID']) && $_GET['techID'] != "")
	{
		$techID = $_GET['techID'];
	}

	if(isset($_POST['filter']))
	{
		if($_POST['filter'] === "true")
		{
			$typeOfSearch="";
			if($_POST['companyID'] != "")
			{
				$clientID = $_POST['companyID'];
				$typeOfSearch.="client";
			}
			if($_POST['startDate_1'] != "" && 
				$_POST['startDate_2'] != "" && 
				$_POST['startDate_3'] != "")
			{
				$startDateString = $_POST['startDate_1'] ."/".$_POST['startDate_2'] ."/".$_POST['startDate_3'] ." 12:00:00 AM";
				$stopDateString = $_POST['stopDate_1'] ."/".$_POST['stopDate_2'] ."/".$_POST['stopDate_3'] ." 11:59:00 PM";
				$startDate = strtotime($startDateString);
				$stopDate = strtotime($stopDateString);
				$typeOfSearch.="date";
			}
			if($_POST['techID'] != "0")
			{
				$techID = $_POST['techID'];
				$typeOfSearch.="tech";
			}
		}
		if($typeOfSearch=="")
			$typeOfSearch="all";
	}
	


?>

<script src="./includes/js/sorttable.js"></script>
<SCRIPT LANGUAGE="JavaScript">
	function clearFilters()
	{
		document.getElementById("filter").value="false";
		window.location="incidents.php";
	}
	function filterIncidents()
	{
		checkValues();
		document.getElementById("filter").value="true";
	}
	
	function openInReports(taskID,projectID)
	{
		var baseUrl="http://report.vndx.com/pmprojects.asp";
		var projects = "?ProjectId=";
		var tasks = "&TaskId=";
		var url = baseUrl.concat(projects).concat(projectID).concat(tasks).concat(taskID);
		window.open(url);
	}
	
	function edit(id)
	{
		var url = "editIncident.php?id=".concat(id);
		alert(url);
		window.open=url;
	}
	
	function checkValues()
	{
		var startMonth = document.getElementById('startDate_1').value;
		var startDay = document.getElementById('startDate_2').value;
		var startYear = document.getElementById('startDate_3').value;
		
		var stopMonth = document.getElementById('stopDate_1').value;
		var stopDay = document.getElementById('stopDate_2').value;
		var stopYear = document.getElementById('stopDate_3').value;
		
		var startMonthElement = document.getElementById('startDate_1');
		var startDayElement = document.getElementById('startDate_2');
		var startYearElement = document.getElementById('startDate_3');
		
		var stopMonthElement = document.getElementById('stopDate_1');
		var stopDayElement = document.getElementById('stopDate_2');
		var stopYearElement = document.getElementById('stopDate_3');
		
		if(stopMonth=="")
			stopMonthElement.value = startMonth;
		if(stopDay=="")
			stopDayElement.value = startDay;
		if(stopYear=="")
			stopYearElement.value = startYear;
		else
		{
			//stop year cannot be less than start year
			if(stopYear < startYear)
				stopYearElement.value = startYear;
			
			//stop month cannot be less than start month if in the 
			//same year
			if(stopMonth < startMonth && startYear == stopYear)
				stopMonthElement.value = startMonth;
			
			//stop day cannot be less than start day if in the same month
			//and year
			if(stopDay < startDay && startMonth == stopMonth && startYear == stopYear)
				stopDayElement.value = startDay
		}
		
		
	}
</script>
<div id='form_container'>
	<form name="filter" action="incidents.php" method="POST">
		<h3>Filter </h3>
		<table>
			<tr>
				<td>Company Name</td>
				<td><select class="element select medium" id="companyID" name="companyID"> 
									<option value="" selected="selected">Choose...</option>
									<?
										$clients = getClients();
										print_r($clients);
										for($i=0;$i<count($clients);$i++)
										{
											$rowArray = $clients[$i];
												$id = $rowArray['id'];
												$name = $rowArray['companyName'];
											echo "<option value='$id'>$name</option>";
										}
									?>

								</select></td>
			</tr>
			<tr>
				<td>Start Date</td>
				<td><input id="startDate_1" name="startDate_1" 
					class="element text" size="2" 
					maxlength="2" value="" type="text"
					onChange="checkValues()"> /
					<label for="startDate_1">MM</label>
				</span>
				<span>
					<input id="startDate_2" name="startDate_2" 
					class="element text" size="2" maxlength="2" 
					value="" type="text"
					onChange="checkValues()"> /
					<label for="startDate_2">DD</label>
				</span>
				<span>
					<input id="startDate_3" name="startDate_3" 
					class="element text" size="4" maxlength="4" 
					value="" type="text"
					onChange="checkValues()">
					<label for="startDate_3">YYYY</label></td>
			</tr>
			<tr>
				<td>Stop Date</td>
				<td><input id="stopDate_1" name="stopDate_1" class="element text" size="2" maxlength="2" value="" type="text" onChange="checkValues()"> /
					<label for="stopDate_1">MM</label>
				</span>
				<span>
					<input id="stopDate_2" name="stopDate_2" class="element text" size="2" maxlength="2" value="" type="text" onChange="checkValues()"> /
					<label for="stopDate_2">DD</label>
				</span>
				<span>
					<input id="stopDate_3" name="stopDate_3" 
					class="element text" size="4" maxlength="4" 
					value="" type="text"
					onChange="checkValues()">
					<label for="stopDate_3">YYYY</label></td>
			</tr>
			<tr>
				<td>Tech</td>
				<td><select class="element select medium" id="techID" name="techID"> 
							<option value="0">Choose</option>
							<?
								$users=getUsers();
								for($i=0;$i<count($users);$i++)
								{
									$rowArray = $users[$i];
										$id = $rowArray['id'];
										$name = $rowArray['username'];
									echo "<option value='$id'>$name</option>";
								}
							?>

						</select></td>
			</tr>
			<tr>
				<td><input type="submit" value="Clear Filters" onClick="clearFilters()"/></td>
				<td><input type="submit" value="Filter" onClick="filterIncidents()"/>
					<input type="hidden" name="filter" id="filter" value="true" /></form></td>
			</tr>
		</table>

	<h3>Incident List</h3>
	<STYLE>
		tr { background-color: #DDDDDD}
			.initial { background-color: #DDDDDD; color:#000000 }
			.normal { background-color: #CCCCCC }
			.highlight { background-color: #8888FF }
	</style>
	<?
	
		if($pageNum != 1)
		{
			echo "<a href='{$_SERVER['PHP_SELF']}?pageNum=1&typeOfSearch=$typeOfSearch&clientID=$clientID&startDate=$startDate&stopDate=$stopDate&techID=$techID'> <<-First</a> ";
			echo " ";
			$previous = $pageNum-1;
			echo " <a href='{$_SERVER['PHP_SELF']}?pageNum=$previous&typeOfSearch=$typeOfSearch&clientID=$clientID&startDate=$startDate&stopDate=$stopDate&techID=$techID'> <-Previous</a> ";
		}
		echo " --- ";
		if($pageNum != $lastPage)
		{
			$next = $pageNum+1;
			echo " <a href='{$_SERVER['PHP_SELF']}?pageNum=$next&typeOfSearch=$typeOfSearch&clientID=$clientID&startDate=$startDate&stopDate=$stopDate&techID=$techID'>Next -></a> ";
			echo " ";
			echo " <a href='{$_SERVER['PHP_SELF']}?pageNum=$lastPage&typeOfSearch=$typeOfSearch&clientID=$clientID&startDate=$startDate&stopDate=$stopDate&techID=$techID'>Last ->></a> ";
		}
	
	?>
	<table border="1"  width="100%" cellpadding="1" cellspacing="1" class="sortable">
	<tr>
		<th>Date</th>
		<th>Company Name</th>
		<th>Client Name</th>
		<th>Reports Link</th>
		<th>Time Spent</th>
		<th>Tech</th>
		<th>Edit</th>
	</tr>
	
	<?

	
		$tableData = searchIncidents($typeOfSearch,$clientID,$startDate,$stopDate,$techID,$pageNum);
		
		for($i=0; $i < count($tableData); $i++)
		{
		
			$thisRow = $tableData[$i];
			$reportsID=$thisRow['reportsID'];
			$reportsProject=$thisRow['reportsProject'];
			$companyName = $companyLookupTable[(int)$thisRow['clientID']];
			$techName = $userLookupTable[(int)$thisRow['tech']];
			$clientName = $thisRow['requestor'];
			$date = epochToHuman($thisRow['timestamp']);
			$timeSpent = $thisRow['timeSpent'];
			$id = $thisRow['id'];
			
			echo "<tr>";
				echo "<td>$date</td>";
				echo "<td><a href=\"http://report.vndx.com/reports/editcustomer.asp?id=$reportsID\" target=_blank>
					$companyName</a></td>";
				echo "<td>$clientName</td>";
				echo "<td><button onclick=\"openInReports($reportsID,$reportsProject)\">Reports</button></td>";
				echo "<td>$timeSpent</td>";
				echo "<td>$techName</td>";
				if($session->isAdmin() || $_SESSION['techID'] == (int)$thisRow['tech'])
				{
					echo "<td><a href=\"editIncident.php?id=$id\">Edit</a></td>";
				}
				else
				{
					echo "<td>&nbsp;</td>";
				}
			echo "</tr>";
			
			
		}
		echo "</table>";
		if($pageNum != 1)
		{
			echo "<a href='{$_SERVER['PHP_SELF']}?pageNum=1&typeOfSearch=$typeOfSearch&clientID=$clientID&startDate=$startDate&stopDate=$stopDate&techID=$techID'> <<-First</a> ";
			echo " ";
			$previous = $pageNum-1;
			echo " <a href='{$_SERVER['PHP_SELF']}?pageNum=$previous&typeOfSearch=$typeOfSearch&clientID=$clientID&startDate=$startDate&stopDate=$stopDate&techID=$techID'> <-Previous</a> ";
		}
		echo " --- ";
		if($pageNum != $lastPage)
		{
			$next = $pageNum+1;
			echo " <a href='{$_SERVER['PHP_SELF']}?pageNum=$next&typeOfSearch=$typeOfSearch&clientID=$clientID&startDate=$startDate&stopDate=$stopDate&techID=$techID'>Next -></a> ";
			echo " ";
			echo " <a href='{$_SERVER['PHP_SELF']}?pageNum=$lastPage&typeOfSearch=$typeOfSearch&clientID=$clientID&startDate=$startDate&stopDate=$stopDate&techID=$techID'>Last ->></a> ";
		}
	?>


</div>

<?php include("includes/php/footer.php"); ?>

</body>
</html>