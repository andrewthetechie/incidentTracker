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
<STYLE>
	tr { background-color: #DDDDDD}
		.initial { background-color: #DDDDDD; color:#000000 }
		.normal { background-color: #CCCCCC }
		.highlight { background-color: #8888FF }
</style>
<script src="./includes/js/sorttable.js"></script>
<div id='form_container'>
	<form name="filter" action="reports.php" method="POST">
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
		
		<h3>Quick Reports</h3>
		
		<h4>Monthly</h4>
		<table>
			<tr>
				<th>Month</th>
				<th># of Incidents</th>
				<th>Total time spent</th>
				<th>Est. income (@$30)</th>
				<th>Est. Profit</th>
			</tr>

			<?
			$totalIncidents = 0;
			$monthsWithIncidents = 0;
			$totalTime=0;
			$totalIncome = 0;
			$totalProfit = 0;
			
			for($i=12; $i>=0; $i--)
			{
				if(date("m", strtotime("-$i month", strtotime(date("F") . "1")) ) - $i > 0)
				{
					$year = date("Y");
				}
				else
				{
					$year = date("Y", strtotime("-1 year", strtotime(date("F") . "1")) );
				}
				
				echo "<tr>";
					$report = monthlyOverviewReport(monthlyIncidents(0, date("M", strtotime("-$i month", strtotime(date("F") . "1")) ), $year));
					$estProfit = $report['estimatedIncome'] - $report['estimatedCost'];
					echo "<td>" . date("M", strtotime("-$i month", strtotime(date("F") . "1")) ) . " " . $year . "</td>";
					echo "<td>" . $report['totalIncidents'] . "</td>";
					echo "<td>" . $report['totalTime'] . "</td>";
					echo"<td>$" . number_format($report['estimatedIncome'],2) . "</td>";
					echo "<td>$" . number_format($estProfit,2) . "</td>";
				echo "</tr>";
				
				if($report['totalIncidents'] > 0)
				{
					$monthsWithIncidents++;
					$totalIncidents += $report['totalIncidents'];
					$totalTime += $report['totalTime'];
					$totalIncome += $report['estimatedIncome'];
					$totalProfit += $estProfit;
				}
						
			}//end for loop
			
			echo "<tr>";
				echo "<th>Totals</th>";
				echo "<th>$totalIncidents</th>";
				echo "<th>$totalTime</th>";
				echo "<th>$".number_format($totalIncome,2)."</th>";
				echo "<th>$".number_format($totalProfit,2)."</th>";
			echo "</tr>";
			
			$timePerIncident = $totalTime / $totalIncidents;
			
			$predIncidents = round(($totalIncidents / $monthsWithIncidents),0);
			
				echo "<tr>";
					echo "<td>Next Month (EST) </td>";
					echo "<td>".$predIncidents."</td>";
					echo "<td>".round($predIncidents * $timePerIncident, 2)."</td>";
					echo "<td>$".number_format($predIncidents * INCIDENT_BILLABLE_RATE,2)."</td>";
					echo "<td>&nbsp;</td>";
				echo "</tr>";
/*
				echo "<tr>";
					$threeMonthReport = monthlyOverviewReport(monthlyIncidents(0, date("M", strtotime("-3 month", strtotime(date("F") . "1")) ), date("Y")));
					$estProfit = $threeMonthReport['estimatedIncome'] - $threeMonthReport['estimatedCost'];
					echo "<td>" . date("M", strtotime("-3 month", strtotime(date("F") . "1")) ) . " " . date("Y") . "</td>";
					echo "<td>" . $threeMonthReport['totalIncidents'] . "</td>";
					echo "<td>" . $threeMonthReport['totalTime'] . "</td>";
					echo"<td>$" . number_format($threeMonthReport['estimatedIncome'],2) . "</td>";
					echo "<td>$" . number_format($estProfit,2) . "</td>";
				echo "</tr>";
				echo "<tr>";
					$twoMonthReport = monthlyOverviewReport(monthlyIncidents(0, date("M", strtotime("-2 month", strtotime(date("F") . "1")) ), date("Y")));
					$estProfit = $twoMonthReport['estimatedIncome'] - $twoMonthReport['estimatedCost'];
					echo "<td>" . date("M", strtotime("-2 month", strtotime(date("F") . "1")) ) . " " . date("Y") . "</td>";
					echo "<td>" . $twoMonthReport['totalIncidents'] . "</td>";
					echo "<td>" . $twoMonthReport['totalTime'] . "</td>";
					echo "<td>$" . number_format($twoMonthReport['estimatedIncome'],2) . "</td>";
					echo "<td>$" . number_format($estProfit,2) . "</td>";
				echo "</tr>";
				echo "<tr>";
					$oneMonthReport = monthlyOverviewReport(monthlyIncidents(0, date("M", strtotime("-1 month", strtotime(date("F") . "1")) ), date("Y")));
					$estProfit = $oneMonthReport['estimatedIncome'] - $oneMonthReport['estimatedCost'];
					echo "<td>" . date("M", strtotime("-1 month", strtotime(date("F") . "1")) ) . " " . date("Y") . "</td>";
					echo "<td>" . $oneMonthReport['totalIncidents'] . "</td>";
					echo "<td>" . $oneMonthReport['totalTime'] . "</td>";
					echo "<td>$" . number_format($oneMonthReport['estimatedIncome'],2) . "</td>";
					echo "<td>$" . number_format($estProfit,2) . "</td>";
				echo "</tr>";
				echo "<tr>";
					$thisMonthReport = monthlyOverviewReport(monthlyIncidents(0, date("M"), date("Y")));
					$estProfit = $thisMonthReport['estimatedIncome'] - $thisMonthReport['estimatedCost'];
					echo "<td>" . date("M") . " " . date("Y") . "</td>";
					echo "<td>" . $thisMonthReport['totalIncidents'] . "</td>";
					echo "<td>" . $thisMonthReport['totalTime'] . "</td>";
					echo "<td>$" . number_format($thisMonthReport['estimatedIncome'],2) . "</td>";
					echo "<td>$" . number_format($estProfit,2) . "</td>";
				echo "</tr>";
				
*/
			?>
			
		</table>

</div>
<?php include("includes/php/footer.php"); ?>

</body>
</html>