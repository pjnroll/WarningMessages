<?php
include("utils/db_con.php");
session_start();
?>

<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<style>
	</style>

	<script
	  src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
	  integrity="sha256-pasqAKBDmFT4eHoN2ndd6lN370kFiGUFyTiUHWhU7k8="
	  crossorigin="anonymous"></script>

  <!-- Material Design Lite -->
	<script src="https://code.getmdl.io/1.3.0/material.min.js"></script>
  <link rel="stylesheet" href="https://code.getmdl.io/1.3.0/material.indigo-pink.min.css">
  <!-- Material Design icon font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
  <link rel="stylesheet" href="my_style.css">
	<script src="./setup.js"></script>
	<script src="./check.js"></script>
	<title>Warning message configurator</title>
</head>
<body id="body">


	<h1 style="text-align: center; margin: auto; width: 40%;  padding: 10px;">Warning Setup</h1>
	<div class="mdl-card mdl-shadow--2dp" style="margin: auto; width: 55%;  padding: 10px;">
		<form id="warn_form" method="get" action="warning_page.php">
			<h4 style="text-align: center;">Select the indicators and messages you want to show</h4>
<!-- inserire qui la tabella -->
<div class="accordion">Indicator 1</div>
<div class="panel">
	<table>
		<tr>
			<td>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</td>
			<td><input type="checkbox" />
		</tr>
	</table>
</div>

<div class="accordion">Section 2</div>
<div class="panel">
  <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
</div>

<div class="accordion">Section 3</div>
<div class="panel">
  <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
</div>


		</form>
		<button class="mdl-button mdl-js-button mdl-button--raised" onClick="checkForm();">Continue</button>
	</div>

</body>
<script>
	var acc = document.getElementsByClassName("accordion");
var i;

for (i = 0; i < acc.length; i++) {
  acc[i].addEventListener("click", function() {
    this.classList.toggle("active");
    var panel = this.nextElementSibling;
    if (panel.style.display === "block") {
      panel.style.display = "none";
    } else {
      panel.style.display = "block";
    }
  });
}
</script>
</html>
