<?php
/**
 *
 * Andrew Herrington
 * Last Updated: 8/29/12
 */

include('includes/php/functions.php');
include('includes/php/header.php');

/**
 * User has already logged in, so display relavent links, including
 * a link to the admin center if the user is an administrator.
 */
if($session->logged_in){

}
else
{
?>
<div id="form_container">
<h1>Login</h1>
<?
/**
 * User not logged in, display the login form.
 * If user has already tried to login, but errors were
 * found, display the total number of errors.
 * If errors occurred, they will be displayed.
 */
if($form->num_errors > 0){
   echo "<font size=\"2\" color=\"#ff0000\">".$form->num_errors." error(s) found</font>";
}
?>
<div id='form_container'>


<h3>Incident Tracker Login</h3>

<form id="form_357374" class="appnitro"  method="post" action="process.php">					
	<ul >
		<li id="li_1" ><label class="description" for="element_1">Username </label>
			<div>
				<input id="element_1" name="user" class="element text medium" type="text" maxlength="255" value=""/> 
			</div><p class="guidelines" id="guide_1"><small>Enter your Username</small></p> 
		</li>		
		<li id="li_2" >
			<label class="description" for="element_2">Password </label>
			<div>
				<input id="element_2" name="pass" class="element text medium" type="password" maxlength="255" value=""/> 
			</div><p class="guidelines" id="guide_2"><small>Enter your Password</small></p> 
		</li>		
		<li id="li_3" >
			<label class="description" for="element_3"> </label>
			<span>
				<input id="element_3_1" name="remember" class="element checkbox" type="checkbox" value="1" />
				<label class="choice" for="element_3_1">Remember Me</label>
			</span><p class="guidelines" id="guide_3"><small>Check here to remember your login (requires Cookies).</small></p> 
		</li>
			
			<li class="buttons">
			<input type="hidden" name="form_id" value="357374" />
			<input type="hidden" name="sublogin" value="1">
				<input id="saveForm" class="clockButton" type="submit" name="submit" value="Submit" />
		</li>
</form>
		<li>
			<br /><br /><br />
			<form name="forgotPass" action="forgotpass.php">
				<input id="forgotPass" class="clockButton" type="submit" name="submit" value="Forgot Password" />
			</form>
	</ul>


</div>
<?
}



?>



</table>


<?php include("includes/php/footer.php"); ?>

</body>
</html>
