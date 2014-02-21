<?php
/**
 *
 * Andrew Herrington
 * Last Updated: 8/29/12
 */

include('includes/php/functions.php');
loginRedirect($session);
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
	<form name="ipRange" action="customers.php" method="GET">
		<h3>Search</h3>
		<input type="hidden" name="ip" value="" />
		<table>
			<tr>
				<th>Company Name</th>
				<th>Client Name</th>
			</tr>
			<tr>
				<td><input type="text" name="companyName" /></td>
				<td><input type="text" name="clientName" /></td>
				<td><input type="submit" value="Search" /></td>
			</tr>
		</table>
	</form>
	<form name="addCustomer" action="addCustomer.php" method="POST">
		<h3>Add New Client</h3>
		<input type="submit" value="Add New Client" />
	</form>
	
	<h3>Customer List</h3>
	<STYLE>
		tr { background-color: #DDDDDD}
			.initial { background-color: #DDDDDD; color:#000000 }
			.normal { background-color: #CCCCCC }
			.highlight { background-color: #8888FF }
	</style>

	<table border="1"  width="100%" cellpadding="1" cellspacing="1" class="sortable">
	<tr>
		<th>ID</th>
		<th>Company Name</th>
		<th>Client Name</th>
		<th>Email</th>
		<th>Plan</th>
		<th>Incidents Remaining</th>
		<th>View Incidents</th>
		<th>Record Incident</th>
		<th>Workstation Inventory</th>
		<th>Edit</th>
		<? if($session->isAdmin())
			echo "<th>Delete</th>"
		?>
	</tr>
	<?
		if(isset($_GET['companyName']) || isset($_GET['clientName']))
		{
			if(isset($_GET['companyName']) && !isset($_GET['clientName']))
			{
				$tableData = searchClients('company',$_GET['companyName'],'');
			}
			if(!isset($_GET['companyName']) && isset($_GET['clientName']))
			{
				$tableData = searchClients('client','',$_GET['clientName']);
			}
			if(isset($_GET['companyName']) && isset($_GET['clientName']));
			{
				$tableData = searchClients('both',$_GET['companyName'],$_GET['clientName']);
			}
		}
		else
		{
			$tableData = searchClients('all','','');
		}
		
		$planLookup = planLookupTable();

		
		for($i=0; $i < count($tableData); $i++)
		{
		
			$thisRow = $tableData[$i];
			$id=$thisRow['id'];
			$reportsID=$thisRow['reportsID'];
			$companyName = $thisRow['companyName'];
			$clientName = $thisRow['clientName'];
			$email = $thisRow['email'];
			$plan = $thisRow['plan'];
			$thisRowPlanArray = $planLookup[$plan];
			$planName=$thisRowPlanArray['name'];
			$planIncidents=$thisRowPlanArray['numberOfIncidents'];
			
			echo "<tr>";
				echo "<td>$id</td>";
				echo "<td><a href=\"http://report.vndx.com/reports/editcustomer.asp?id=$reportsID\" target=_blank>
					$companyName</a></td>";
				echo "<td>$clientName</td>";
				echo "<td>$email</td>";
				echo "<td>$planName</td>";
				echo "<td>" . remainingIncidents($id,$planIncidents) . "</td>";
				echo "<td><button onclick=\"viewIncident($id)\">View Incidents</button></td>";
				echo "<td><button onclick=\"recordIncident($id)\">Record Incident</button></td>";
				echo "<td><button onclick=\"computerInventory($id)\">Inventory</button></td>";
				echo "<td><button onclick=\"edit($id)\">Edit</button></td>";
				if($session->isAdmin())
					echo "<td><input type=\"submit\" value=\"Delete\" /></td>";
			echo "</tr>";
			
			
		}
		

	?>
	</table>
</div>

<?php include("includes/php/footer.php"); ?>

</body>
</html>
