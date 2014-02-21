<?php
/**
 *
 * Andrew Herrington
 * Last Updated: 8/29/12
 */

include('includes/php/functions.php');
loginRedirect($session);
include('includes/php/header.php');

if(isset($_POST['submit']))
{
	$_POST = inputCleaner($_POST);
	$clientID = $_POST['companyID'];
	$requestor = $_POST['requestor'];
	$reportsProject = $_POST['reportsProject'];
	$reportsID = $_POST['reportsID']; 
	$timeSpent = $_POST['timeSpent'];
	$description = $_POST['description'];
	$techID = $_POST['techID'];
	
	$date = $_POST['date_1'] . "/" . $_POST['date_2'] . "/" . $_POST['date_3'] .
		" " . $_POST['time_1'] .":" . $_POST['time_2'] . ":00 " . $_POST['time_4'];
		
	$timestamp = strtotime($date);
	

	$result = addIncident($timestamp,$requestor,$reportsProject,$reportsID,$timeSpent,$description,
		$techID,$clientID);
	if($result)
		echo "<h3>Incident successfully recorded</h3>";
	else
		echo "<h3>Some sort of error occurred. Please try again</h3>";
}
else
{
?>
	<div id='form_container'>
		<form name="recordIncident" action="recordIncident.php" method="post">
		<div class="form_description">
				<h2>Record your incident</h2>
				<p></p>
			</div>						
			<ul>
				<li id="li_1" >
					<label class="description" for="companyID">Company Name</label>
					<div>
						<?
							if(isset($_GET['companyID']))
							{
								?>
									<input id="companyID" name="companyID" 
									class="element text medium" type="hidden" maxlength="255" 
									value="<? $_GET['companyID']; ?>" /> 
									<input value="<? echo idToCompanyName($_GET['companyID']);  ?>" readonly />
								<?
							}
							
							else
							{
						?>
								<select class="element select medium" id="companyID" name="companyID"> 
									<option value="" selected="selected">Choose Company</option>
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

								</select>
						<?
							}
						?>
					</div><p class="guidelines" id="guide_1"><small>The DBA of the company</small></p> 
				</li>		
					
				<li id="li_2" >
					<label class="description" for="requestor">Client Name</label>
					<div>
						<input id="requestor" name="requestor" class="element text medium" type="text" maxlength="255" value="" /> 
					</div><p class="guidelines" id="guide_2"><small>The name of the person that requested the work</small></p> 
				</li>
				<li id="li_2" >
				<label class="description" for="date">Date </label>
				<span>
					<input id="date_1" name="date_1" class="element text" size="2" maxlength="2" value="" type="text"> /
					<label for="date_1">MM</label>
				</span>
				<span>
					<input id="date_2" name="date_2" class="element text" size="2" maxlength="2" value="" type="text"> /
					<label for="date_2">DD</label>
				</span>
				<span>
					<input id="date_3" name="date_3" class="element text" size="4" maxlength="4" value="" type="text">
					<label for="date_3">YYYY</label>
				</span>
			
				 
				</li>		<li id="li_1" >
				<label class="description" for="time">Time </label>
				<span>
					<input id="time_1" name="time_1" class="element text " size="2" type="text" maxlength="2" value=""/> : 
					<label>HH</label>
				</span>
				<span>
					<input id="time_2" name="time_2" class="element text " size="2" type="text" maxlength="2" value=""/> : 
					<label>MM</label>
				</span>
				<span>
					<select class="element select" style="width:4em" id="time_4" name="time_4">
						<option value="AM" >AM</option>
						<option value="PM" >PM</option>
					</select>
					<label>AM/PM</label>
				</span> 
				</li>
				<li id="li_4" >
					<label class="description" for="reportsID">Reports ID</label>
						<input id="reportsID" name="reportsID" class="element text small" type="text" maxlength="10" value="" /> 
					<p class="guidelines" id="guide_4"><small>Task ID in reports.vndx.com</small></p> 
				</li>				
				<li id="li_6" >
					<label class="description" for="reportsProject">Project ID</label>
						<input id="reportsID" name="reportsProject" class="element text small" type="text" maxlength="10" value="" /> 
					<p class="guidelines" id="guide_6"><small>Project ID in reports.vndx.com</small></p> 
				</li>
			<li id="li_2" >
					<label class="description" for="timeSpent">Time Spent</label>
					<div>
						<input id="timeSpent" name="timeSpent" class="element text small" type="text" maxlength="10" value="" /> 
					</div><p class="guidelines" id="guide_2"><small>Time you spent on this incident in decimal form</small></p> 
				</li>	
			<li id="li_3" >
				<label class="description" for="description">Description </label>
				<div>
					<textarea id="description" name="description" class="element textarea medium"></textarea> 
				</div><p class="guidelines" id="guide_3"><small>Description of work done</small></p> 
			</li>	
				</li>
			<?

				if($session->isAdmin())
				{

					?>
					
					<li id="li_5" >
					<label class="description" for="techID">Tech</label>

					<div>
						<select class="element select medium" id="techID" name="techID"> 
							<?
								$users=getUsers();
								for($i=0;$i<count($users);$i++)
								{
									$rowArray = $users[$i];
										$id = $rowArray['id'];
										$name = $rowArray['username'];
									echo "<option value='$id' ";
										if($id == $session->userinfo['id'])
											echo "selected=\"selected\" ";
									echo ">$name</option>";
								}
							?>

						</select>
					</div><p class="guidelines" id="guide_5"><small>Choose the tech that performed this job</small></p> 
					<?
				}
				else
				{
					echo "<input type='hidden' id='techID' name='techID' value='$session->userinfo['id']' />";
				}
			?>
				<li class="buttons">
					<input type="hidden" name="submit" value="1" />
					<input id="saveForm" class="clockButton" type="submit" name="submit" value="Submit" />
				</li>
			</ul>
			

		</form>
<? 
}
include("includes/php/footer.php"); ?>

</body>
</html>