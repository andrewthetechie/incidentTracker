<?
/**
 * ForgotPass.php
 *
 * This page is for those users who have forgotten their
 * password and want to have a new password generated for
 * them and sent to the email address attached to their
 * account in the database. The new password is not
 * displayed on the website for security purposes.
 *
 * Note: If your server is not properly setup to send
 * mail, then this page is essentially useless and it
 * would be better to not even link to this page from
 * your website.
 *
 * Andrew Herrington
 * Last Updated: Mar 1 2012
 */
include("includes/php/session.php");
include("includes/php/header.php");
?>

<div id='form_container'>

<?
/**
 * Forgot Password form has been submitted and no errors
 * were found with the form (the username is in the database)
 */
if(isset($_SESSION['forgotpass'])){
   /**
    * New password was generated for user and sent to user's
    * email address.
    */
   if($_SESSION['forgotpass']){
      echo "<h1>New Password Generated</h1>";
      echo "<p>Your new password has been generated "
          ."and sent to the email <br>associated with your account. "
          ."<a href=\"index.php\">Main</a>.</p>";
   }
   /**
    * Email could not be sent, therefore password was not
    * edited in the database.
    */
   else{
      echo "<h1>New Password Failure</h1>";
      echo "<p>There was an error sending you the "
          ."email with the new password,<br> so your password has not been changed. "
          ."<a href=\"index.php\">Main</a>.</p>";
   }
       
   unset($_SESSION['forgotpass']);
}
else{

/**
 * Forgot password form is displayed, if error found
 * it is displayed.
 */
?>


	<form id="form_361303" class="appnitro"  method="post" action="process.php">
		<div class="form_description">
			<h2>Forgot Password</h2>
			<p>A new password will be generated for you and sent to the email address associated with your account, all you have to do is enter your username.</p>
			<p>	<? echo $form->error("user"); ?></p>
		</div>						
		<ul >
			<li id="li_1" >
				<label class="description" for="element_1">Username </label>
			<div>
				<input id="element_1" name="user" class="element text medium" type="text" maxlength="255" value=""/> 
			</div>
				<p class="guidelines" id="guide_1"><small>Enter your username</small></p> 
			</li>
			
			<li class="buttons">
			    <input type="hidden" name="form_id" value="361303" />
	    		<input type="hidden" name="subforgot" value="1">
			    <input id="saveForm" class="clockButton" type="submit" name="submit" value="Submit" />
			</li>

		</ul>
	</form>	

</div>
<?
}
?>
<?php include("includes/php/footer.php"); ?>
