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
	$companyName = $_POST['companyName'];
	$clientName = $_POST['clientName'];
	$email = $_POST['email'];
	$reportsID = $_POST['reportsID']; 
	$plan = $_POST['plan'];
	
	addClient($companyName, $clientName, $email, $reportsID, $plan);
	
	echo "<h3>Client successfully Added</h3>";
}
else
{
?>
	<div id='form_container'>
		<form name="addCustomer" action="addCustomer.php" method="post">
		<div class="form_description">
				<h2>Adding Service Agreement Customer</h2>
				<p></p>
			</div>						
			<ul>
				<li id="li_1" >
					<label class="description" for="companyName">Company Name</label>
					<div>
						<input id="companyName" name="companyName" class="element text medium" type="text" maxlength="255" value=""/> 
					</div><p class="guidelines" id="guide_1"><small>The DBA of the company</small></p> 
				</li>		
					
				<li id="li_2" >
					<label class="description" for="clientName">Client Name</label>
					<div>
						<input id="clientName" name="clientName" class="element text medium" type="text" maxlength="255" value="" /> 
					</div><p class="guidelines" id="guide_2"><small>The name of the person that we'll most likely be talking to</small></p> 
				</li>
				<li id="li_3" >
					<label class="description" for="email">Email </label>
					<div>
						<input id="email" name="email" class="element text medium" type="text" maxlength="255" value="" /> 
					</div><p class="guidelines" id="guide_3"><small>Billing email for this client</small></p> 
				</li>		
				<li id="li_4" >
					<label class="description" for="reportsID">Reports ID</label>
						<input id="reportsID" name="reportsID" class="element text small" type="text" maxlength="10" value="" /> 
					<p class="guidelines" id="guide_4"><small>Customers ID in reports.vndx.com</small></p> 
				</li>
				<li id="li_5" >
					<label class="description" for="plan">Customers Support Plan</label>

					<div>
						<select class="element select medium" id="plan" name="plan"> 
							<option value="" selected="selected">Choose Plan</option>
							<?
								$plans = getPlans();
								for($i=0;$i<count($plans);$i++)
								{
									$rowArray = $plans[$i];
										$id = $rowArray['id'];
										$name = $rowArray['name'];
									echo "<option value='$id'>$name</option>";
								}
							?>

						</select>
					</div><p class="guidelines" id="guide_5"><small>Choose Their Service Agreement plan</small></p> 
				</li>

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