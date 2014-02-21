<?php
/**
 *
 * Andrew Herrington
 * Last Updated: 8/29/12
 */

	include('includes/php/functions.php');
	loginRedirect($session);

	if(!isset($_GET['companyID']) || $_GET['companyID'] == "")
		header("Location: index.php");
	
include('includes/php/header.php');
?>


<script src="./includes/js/sorttable.js"></script>
<SCRIPT LANGUAGE="JavaScript">
	
	
	function editComputer(id)
	{
		var baseUrl="editComputer.php?computerID=";
		var url = baseUrl.concat(id);
		window.location=url;
	}
	
	function uploadMonthly(id)
	{
		var baseUrl="uploadMonthly.php?computerID=";
		var url = baseUrl.concat(id);
		window.location=url;
	}

	function delete(id)
	{
		var baseUrl="deleteComputer.php?computerID=";
		var url= baseUrl.concat(id);
		window.location=url;
	}
</script>
<div id='form_container'>
	
	<form name="addComputer" action="addComputer.php" method="POST">
		<h3>Add New Computer</h3>
		<input type="hidden" value="<? echo $_GET['companyID'] ?>" name="companyID" />
		<input type="submit" value="Add New Computer" />
	</form>
	
	<h3>Inventory for 
		<?
		 echo idToCompanyName($_GET['companyID']);
		?>
	</h3>
	<STYLE>
		tr { background-color: #DDDDDD}
			.initial { background-color: #DDDDDD; color:#000000 }
			.normal { background-color: #CCCCCC }
			.highlight { background-color: #8888FF }
	</style>

	<table border="1"  width="100%" cellpadding="1" cellspacing="1" class="sortable">
	<tr>
		<th>&nbsp;</th>
		<th>Computer Name</th>
		<th>Edit</th>
		<th>Upload Monthly Stats</th>
		<? if($session->isAdmin())
			echo "<th>Delete</th>"
		?>
	</tr>
	<?
		$tableData = getClientWorkstations($_GET['companyID']);
		
		for($i=0; $i < count($tableData); $i++)
		{
		
			$thisRow = $tableData[$i];
			$computerName = $thisRow['computerName'];		
			$id = $thisRow['id'];
			$count = $i+1;	
			echo "<tr>";
				echo "<td>$count</td>";
				echo "<td><a href='./computer.php?id=$id'>$computerName</a></td>";
				echo "<td><button onclick=\"editComputer($id)\">Edit</button></td>";
				echo "<td><button onclick=\"uploadMonthly($id)\">Upload Monthly Data</button></td>";
				if($session->isAdmin())
					echo "<td><button onclick=\"delete($id)\">Delete</td>";
			echo "</tr>";
			
			
		}
		

	?>
	</table>
</div>

<?php include("includes/php/footer.php"); ?>

</body>
</html>
