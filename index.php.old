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
			<?php
			echo "<div class=\"accordion\">Alexa Ranking</div>";
			$query_string = "select message from Alexa_Ranking";
			$query_msg = mysql_query($query_string) or DIE('query non riuscita: '.$query_string.' '.mysql_error());
			if (mysql_num_rows($query_msg) > 0) {
				echo "<div class=\"panel\">";
				echo "<table cellpadding=\"5\" cellspacing=\"5\">";

				while ($row_msg = mysql_fetch_row($query_msg)) {
					$msg = $row_msg[0];
					echo "<tr>";
					echo "<td>".$msg."</td>";
					echo "<td><input type=\"checkbox\" />";
					echo "</tr>";
				}
				echo "</table>";
				echo "</div>";
			}

			/*
			 *
			 */

			echo "<div class=\"accordion\">Archived Domain</div>";
			$query_string = "select message from Archived_Domain";
			$query_msg = mysql_query($query_string) or DIE('query non riuscita: '.$query_string.' '.mysql_error());
			if (mysql_num_rows($query_msg) > 0) {
				echo "<div class=\"panel\">";
				echo "<table cellspacing=\"5\" cellpadding=\"5\">";

				while ($row_msg = mysql_fetch_row($query_msg)) {
					$msg = $row_msg[0];
					echo "<tr>";
					echo "<td>".$msg."</td>";
					echo "<td><input type=\"checkbox\" />";
					echo "</tr>";
				}
				echo "</table>";
				echo "</div>";
			}

			/*
			 *
			 */

			 echo "<div class=\"accordion\">Name Length</div>";
			 $query_string = "select message from Name_Length";
			 $query_msg = mysql_query($query_string) or DIE('query non riuscita: '.$query_string.' '.mysql_error());
			 if (mysql_num_rows($query_msg) > 0) {
				 echo "<div class=\"panel\">";
				 echo "<table cellpadding=\"5\" cellspacing=\"5\">";

				 while ($row_msg = mysql_fetch_row($query_msg)) {
					 $msg = $row_msg[0];
					 echo "<tr>";
					 echo "<td>".$msg."</td>";
					 echo "<td><input type=\"checkbox\" />";
					 echo "</tr>";
				 }
				 echo "</table>";
				 echo "</div>";
			 }

			 /*
				*
				*/

			 echo "<div class=\"accordion\">Self-Signed_HTTPs_cetrificate</div>";
			 $query_string = "select message from `Self-Signed_HTTPs_cetrificate`";
			 $query_msg = mysql_query($query_string) or DIE('query non riuscita: '.$query_string.' '.mysql_error());
			 if (mysql_num_rows($query_msg) > 0) {
				 echo "<div class=\"panel\">";
				 echo "<table cellspacing=\"5\" cellpadding=\"5\">";

				 while ($row_msg = mysql_fetch_row($query_msg)) {
					 $msg = $row_msg[0];
					 echo "<tr>";
					 echo "<td>".$msg."</td>";
					 echo "<td><input type=\"checkbox\" />";
					 echo "</tr>";
				 }
				 echo "</table>";
				 echo "</div>";
			 }

			 /*
				*
				*/

				echo "<div class=\"accordion\">Server Location</div>";
				$query_string = "select message from Server_Location";
				$query_msg = mysql_query($query_string) or DIE('query non riuscita: '.$query_string.' '.mysql_error());
				if (mysql_num_rows($query_msg) > 0) {
					echo "<div class=\"panel\">";
					echo "<table cellpadding=\"5\" cellspacing=\"5\">";

					while ($row_msg = mysql_fetch_row($query_msg)) {
						$msg = $row_msg[0];
						echo "<tr>";
						echo "<td>".$msg."</td>";
						echo "<td><input type=\"checkbox\" />";
						echo "</tr>";
					}
					echo "</table>";
					echo "</div>";
				}

				/*
				 *
				 */

				echo "<div class=\"accordion\">Time Life (Age)</div>";
				$query_string = "select message from `Time_Life_(Age)`";
				$query_msg = mysql_query($query_string) or DIE('query non riuscita: '.$query_string.' '.mysql_error());
				if (mysql_num_rows($query_msg) > 0) {
					echo "<div class=\"panel\">";
					echo "<table cellspacing=\"5\" cellpadding=\"5\">";

					while ($row_msg = mysql_fetch_row($query_msg)) {
						$msg = $row_msg[0];
						echo "<tr>";
						echo "<td>".$msg."</td>";
						echo "<td><input type=\"checkbox\" />";
						echo "</tr>";
					}
					echo "</table>";
					echo "</div>";
				}

				/*
				 *
				 */

				 echo "<div class=\"accordion\">Top-level Domain</div>";
				 $query_string = "select message from `Top-level_Domain`";
				 $query_msg = mysql_query($query_string) or DIE('query non riuscita: '.$query_string.' '.mysql_error());
				 if (mysql_num_rows($query_msg) > 0) {
					 echo "<div class=\"panel\">";
					 echo "<table cellpadding=\"5\" cellspacing=\"5\">";

					 while ($row_msg = mysql_fetch_row($query_msg)) {
						 $msg = $row_msg[0];
						 echo "<tr>";
						 echo "<td>".$msg."</td>";
						 echo "<td><input type=\"checkbox\" />";
						 echo "</tr>";
					 }
					 echo "</table>";
					 echo "</div>";
				 }

				 /*
					*
					*/

				 echo "<div class=\"accordion\">URL Mimicking</div>";
				 $query_string = "select message from `URL_Mimicking`";
				 $query_msg = mysql_query($query_string) or DIE('query non riuscita: '.$query_string.' '.mysql_error());
				 if (mysql_num_rows($query_msg) > 0) {
					 echo "<div class=\"panel\">";
					 echo "<table cellspacing=\"5\" cellpadding=\"5\">";

					 while ($row_msg = mysql_fetch_row($query_msg)) {
						 $msg = $row_msg[0];
						 echo "<tr>";
						 echo "<td>".$msg."</td>";
						 echo "<td><input type=\"checkbox\" />";
						 echo "</tr>";
					 }
					 echo "</table>";
					 echo "</div>";
				 }
			?>

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
