<html>
<head>
  <script src="jquery-1.11.1.min.js"></script>
</head>
<style>
   .error { color: #FF0000; }
</style>
<body>
<h1>Facilities Management</h1>
<h2>Maintenance Request Form</h2>

<div>
<script>
   function showSubIssue(){
     var e = document.getElementById("issue");
     
     // Checks if the user selected the default issue
     if (e.selectedIndex != 0){

       // Shows just the selected one
       var selectedIssue = e.options[e.selectedIndex].value;

       document.getElementById(selectedIssue).style.display = 'none';
     }
    }

   // Hides the various sub-issue fields
   $(function() {
       $('#issue').change(function(){
	   $('.subIssues').prop('disabled', true);
	   $('.subIssues').hide();
	   $('#' + $(this).val().split(' ').join('_')).show();
	   $('#' + $(this).val().split(' ').join('_')).prop('disabled', false);
	 });
     });

</script>

<?php
    include('CommonMethods.php');
    $debug = false;
    $COMMON = new Common($debug); // common methods

    function test_input($data){
      $data = trim($data);
      $data = stripslashes($data);
      $data = htmlspecialchars($data);
      $data = str_replace("'", "`", $data); // Removes escape characters
      return $data;
    }
    function isValidEmail($email){ 
      $pattern = "^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$"; 
      
      if (eregi($pattern, $email)){ 
	return false; 
      } 
      else { 
	return true; 
      }
    }
    
    $nameErr = $emailErr = $phoneErr = $locationErr = $issueErr = "";
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phoneNumber = $_POST['phoneNumber'];
    $location = $_POST['location'];
    $issue = $_POST['issue'];
    $subIssue = $_POST['subIssue'];
    $description = $_POST['description'];

    $invalid = false;
    
    // Checks if a user submitted the form
    if ($_SERVER['REQUEST_METHOD'] == "POST"){
            
      if (empty($name)){
	$nameErr = "Name is required";
      }
      else {
	$name = test_input($name);
      }
      
      if (empty($email)){
	$emailErr = "Email is required";
      }
      elseif(isValidEmail($email)){
	$emailErr = "Invalid email address";
      }
      else {   
	$email = test_input($email);
      }
      
      if (empty($phoneNumber)){
	$phoneErr = "Phone Number is required";
      }
      else {
	$phoneNumber = test_input($phoneNumber);
	 
	if (intval($phoneNumber) < 1000000000){
	  $phoneErr = "Invalid Phone Number";
	}
      }
      
      if (empty($location)){
	$locationErr = "Location is required";
      }
      
      if (empty($issue)){
	$issueErr = "Issue is required";
      }
      
      $description = test_input($description);
      

      // Checks if everything is valid
      if (empty($nameErr) && empty($emailErr) && empty($phoneErr) && empty($locationErr) && empty($issueErr)){
	  
          // Constructs the date
	  $date = getdate();
	  $dateRequested = $date['year'] . "-" . $date['mon'] . "-" . $date['mday'];
	  
	  // Get the issue number rather than the name
	  $issueCode = "";
	  $sql = "SELECT `code` FROM `issues` WHERE issue='" . $issue . "'";
	  
	  $rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);

	  while ($row = mysql_fetch_row($rs)) {
	    foreach ($row as $element) {
	      $issueCode = $element;
	    }
	  }


	  // Creates the description 
	  $description = $location . " | ";

	  if ($subIssue != ""){
	    $description = $description . $subIssue . " | ";
	  }
	  
	  $description = $description . $_POST['description'];


	  // Insert the data into the database
	  $sql = "INSERT INTO `issueReport` VALUES ('','" . $name. "','" . $email . "','" . $phoneNumber . "','" . $location . "','" . $issueCode . "','" . $description . "','" . $dateRequested . "')";

	  $rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);


	  // Reset everything
	  $nameErr = $emailErr = $phoneErr = $locationErr = $issueErr = "";
	  $name = $email = $phoneNumber = $location = $issue = $subIssue = $description = $date = "";

	  //$_POST['name'] = $_POST['email'] = $_POST['phoneNumber'] = $_POST['location'] = $_POST['issue'] = $_POST['subIssue'] = $_POST['description'] = "";
      }
      else {
	$invalid = true;
      }
    }
    else {
      $invalid = true;
    }
?>




<span class='error'>* Required Field</span><br /><br />

<form action="index.php" method="post">

<?php

    echo("Customer Name: <input type='text' name='name' value='" . $name . "'>");
    echo("<span class='error'> * " . $nameErr . "</span><br />");
    echo("Customer Email: <input type='text' name='email' value='" . $email . "'>");
    echo("<span class='error'> * " . $emailErr . "</span><br />");
    echo("Customer Phone Number: <input type='number' min='100000000' name='phoneNumber' value='" . $phoneNumber . "'>");
    echo("<span class='error'> * " . $phoneErr . "</span><br />");

    // Creates the Location drop down menu
    echo("Issue Location:");
    echo("<select name='location'>");
    echo("<option value='' />");

    $sql = "SELECT `building_name` FROM `buildings`";

    $rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);

    while ($row = mysql_fetch_row($rs)) {
        foreach ($row as $element) {
	  if ($location == $element){
	    echo("<option value='" . $element . "' selected>" . $element . "</option>");
	  }
	  else {
            echo("<option value='" . $element . "'>" . $element . "</option>");
	  }
        }
    }
    echo("</select><span class='error'> * " . $locationErr . "</span>");
    echo('<br />');

    echo('<table>');
    echo('<tr><td>');
    
    // Adds the main issues to a drop down menu    
    echo('Issue:');
    echo('</td>');    
    
    echo('<td>');
    echo('<select id="issue" name="issue">');
    echo('<option value="" />');
    
    $sql= "SELECT `issue` FROM `issues`";
    $rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
    
    while ($row = mysql_fetch_row($rs)) {
      foreach ($row as $element) {
	if ($issue == $element){
	  echo("<option value='" . $element . "' selected>" . $element . "</option>");
	}
	else {
	  echo("<option value='" . $element . "'>" . $element . "</option>");
	}
      }
    }
    echo("</select><span class='error'> * ". $issueErr . "</span>");
    echo('</td></tr>');


    echo('<tr><td><div>Sub-Issue:</div></td><td>');
    echo('<select class="subIssues" style="width:160px;" disabled></select>');
    
    // Adds the Sub Issues to hidden drop down menues
    $rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);

    while ($row = mysql_fetch_row($rs)) {
      foreach ($row as $element) {
	
	// Construct Sub Issues
	echo('<select id="' . str_replace(' ', '_', $element) . '" name="subIssue" class="subIssues" style="width:160px; display: none;" disabled>');
	echo('<option value="" />');
	
	$sqlSubIssue = "SELECT `subIssue` FROM `" . $element . "`";
	$rsSubIssue = $COMMON->executeQuery($sqlSubIssue, $_SERVER["SCRIPT_NAME"]);
	
	while ($rowSubIssue = mysql_fetch_row($rsSubIssue)) {
	  foreach ($rowSubIssue as $subIssue) {
	    if ($subIssue == $element){
	      echo("<option value='" . $subIssue . "' selected>" . $subIssue . "</option>");
	    }
	    else {
	      echo("<option value='" . $subIssue . "'>" . $subIssue . "</option>");
	    }
	  }
	}
	echo("<option value='OTHER'>OTHER</option>");
	echo('</select>');

      }
    }
    echo('</td></tr>');
    echo('</table>');
?>

<br />
Description:<br />

<?php
echo("<textarea name='description' rows='5' cols='60'>" . $description . "</textarea>");
?>

<br />
<input type="submit">

</form>
</div>
<?php
    if (!$invalid){
?>
Submitted:<br />
<table border=1>
  <tr>
    <td>name</td>
    <td>email</td>
    <td>phone</td>
    <td>location</td>
    <td>issue</td>
    <td>description</td>
    <td>date requested</td>
  </tr>
  <tr>
<?php
  $sql = "SELECT * FROM `issueReport` WHERE `description` = '" . $description . "', `date` = '" . $dateRequested . "'";
  
  echo("<td>" . $_POST['name'] . "</td>");
  echo("<td>" . $_POST['email'] . "</td>");
  echo("<td>" . $_POST['phoneNumber'] . "</td>");
  echo("<td>" . $_POST['location'] . "</td>");
  echo("<td>" . $_POST['issue'] . "</td>");
  echo("<td>" . $_POST['description'] . "</td>");
  echo("<td>" . $dateRequested . "</td>");
?>
  </tr>
</table>
<?php } ?>

</body>

</html>