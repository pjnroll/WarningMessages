<?php
include("utils/db_con.php");
session_start();

$inds = ["URL Mimicking", "Self-Signed HTTPs cetrificate", "Time Life (Age)", "Archived Domain", "Server Location", "Alexa Ranking", "Name Length", "Top-level Domain"];
$placeholders = ["Actual web address", "", "Age of the domain (e.g. 2 days)", "", "Location of the server (e.g. Russia)", "Alexa Ranking score (e.g. 24)", "", "Full top level domain (e.g. .cf)"];

?>

<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<script
	  src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
	  integrity="sha256-pasqAKBDmFT4eHoN2ndd6lN370kFiGUFyTiUHWhU7k8="
	  crossorigin="anonymous"></script>

  <!-- Material Design Lite -->
  <script src="https://code.getmdl.io/1.3.0/material.min.js"></script>
  <link rel="stylesheet" href="https://code.getmdl.io/1.3.0/material.indigo-pink.min.css">
  <!-- Material Design icon font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

	<!--<script src="setup.js"></script>-->
	<script src="check.js"></script>

	<style media="screen">
		.content {
			padding: 0 18px;
			display: none;
			overflow: hidden;
			background-color: #f1f1f1;
		}
	</style>
	<title>Warning Messages</title>
</head>
<body id="body">
	<div class = "mdl-layout mdl-js-layout mdl-layout--fixed-header">
		 <header class = "mdl-layout__header">
				<div class = "mdl-layout__header-row">
					 <span class = "mdl-layout-title">Warning Interface Setup</span>
				</div>
		 </header>

		 <main class = "mdl-layout__content">
				<div class = "mdl-tabs mdl-js-tabs">
					 <div class = "mdl-tabs__tab-bar">
							<a href = "#tab1-panel" class = "mdl-tabs__tab is-active">Dynamic</a>
							<a href = "#tab2-panel" class = "mdl-tabs__tab">Manual</a>
					 </div>

					 <div class = "mdl-tabs__panel is-active" id = "tab1-panel">
						 <h1 style="text-align: center; margin: auto; width: 80%;  padding: 10px;">Dynamic Setup</h1>
						 <div class="mdl-card mdl-shadow--2dp" style="margin: auto; width: 80%;  padding: 10px;">
							 <form id="warn_form_dynamic" method="get" action="warning_page.php">
								 <div style="text-align: center;">

									 <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
								     <input class="mdl-textfield__input" name ="address" type="text" id="address">
								     <label class="mdl-textfield__label" for="sample1">Insert the phishing web address</label>
								   </div>
	 						 	</div>


								 <h4 style="text-align: center;">Select the indicators you want to show</h4>

								 <ul class="mdl-list" id="indicators">
									 <?php
									 for ($i = 0; $i < count($inds); $i++) {
											echo "<li class=\"mdl-list__item\">";
							 				echo "	<span class=\"mdl-list__item-secondary-action\">";
							 				echo "		<label class=\"mdl-checkbox mdl-js-checkbox mdl-js-ripple-effect\" for=\"".$inds[$i]."\">";
							 				echo "			<input class=\"mdl-checkbox__input\" type=\"checkbox\" name=\"indicators[]\" id=\"".$inds[$i]."\" value=\"".$inds[$i]."\"/>";
							 				echo "		</label>";
							 				echo "	</span>";
							 				echo "	<span class=\"mdl-list__item-primary-content\">";
							 				echo "		<label for=\"".$inds[$i]."\"><b>".$inds[$i]."</b></label>";
							 				echo "	</span>";
							 				if ($placeholders[$i] != "") {
								 				echo "	<span class=\"mdl-list__item-secondary-content\">";
								 				echo "		<label for=\"".$inds[$i]."_param\">".$placeholders[$i]."&ensp;</label>";
								 				echo "	</span>";

												//echo "	<input type=\"text\" placeholder=\"".$placeholders[$i]."\" name=\"".$inds[$i]."_param\" id =\"".$inds[$i]."_param\" />&ensp;";
												echo "	<input type=\"text\" name=\"".$inds[$i]."_param\" id =\"".$inds[$i]."_param\" />&ensp;";
											}

							 				echo "</li>";
										}
										?>
								 </ul>
								 <br>


								 <h4 style="text-align: center;">Select how to show the messages for each indicator</h4>

								 <select id="method" name="method" class="mdl-textfield__input">
									 <option value="random" selected="selected">random</option>
									 <option value="latin square">latin square</option>
								 </select>
								 <br><br>

							 </form>
							 <button class="mdl-button mdl-js-button mdl-button--raised" onClick="checkFormDynamic();">Continue</button>

						 </div>

					 </div>

					 <div class = "mdl-tabs__panel" id = "tab2-panel">
						 <h1 style = "text-align: center; margin: auto; width: 80%; padding: 10px;">Manual Setup</h1>
		 					<div class="mdl-card mdl-shadow--2dp" style="margin: auto; width: 70%; padding: 10px;">
		 						<form id="warn_form_manual" name="warn_form_manual" method="get" action="warning_page.php">
									<div style="text-align: center;">

 									 <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
 								     <input class="mdl-textfield__input" name ="address_manual" type="text" id="address_manual">
 								     <label class="mdl-textfield__label" for="sample1">Insert the phishing web address</label>
 								   </div>
 	 						 		</div>
		 							<h4 style="text-align: center;">Select the indicators (and messages) you want to show</h4>
									<?php
									for ($j = 0; $j < count($inds); $j++) {
									  echo "<div style=\"margin:0;\" class=\"mdl-grid mdl-shadow--2dp\">\n";
									  echo "	<label class=\"mdl-cell mdl-cell--1-col mdl-checkbox mdl-js-checkbox mdl-js-ripple-effect\">\n";
									  echo "		<input class=\"collapsible mdl-checkbox__input\" type=\"checkbox\" name=\"indicators[]\" id=\"chk_".$inds[$j]."\" value=\"".$inds[$j]."\" onclick=\"checkCheckbox('$inds[$j]')\"/>\n";
									  echo "	</label>\n";
										if ($placeholders[$j] != "")	{
                    	echo "	<h5 class=\"mdl-cell mdl-cell--3-col\">".$inds[$j]."</h5>\n";
									    echo "	<h6 style='text-align:right;' class=\"mdl-cell mdl-cell--5-col\">$placeholders[$j]</h5>\n";
                      echo "	<input  style='height: 20%;' class=\"mdl-cell mdl-cell--3-col\" type=\"text\" name=\"".$inds[$j]."_param_manual\" id =\"".$inds[$j]."_param_manual\" />&ensp;";
                     /* echo "	<button style='margin:0;' type=\"button\" class=\"collapsible mdl-cell mdl-cell--1-col mdl-button mdl-button--icon mdl-js-button mdl-js-ripple-effect\" id=\"btn_".$inds[$j]."\">";
                      echo '		<i class="material-icons">keyboard_arrow_down</i>';
                      echo '	</button>';*/
                    } else {
                    	echo "	<h5 class=\"mdl-cell mdl-cell--11-col\">".$inds[$j]."</h5>\n";
                     /* echo "	<button type=\"button\" class=\"collapsible mdl-cell mdl-cell--1-col mdl-button mdl-button--icon mdl-js-button mdl-js-ripple-effect\" id=\"btn_".$inds[$j]."\">";
                      echo '		<i class="material-icons">keyboard_arrow_down</i>';
                      echo '	</button>';*/
                    }

										$tbl_name = str_replace(" ", "_", $inds[$j]);
									  $query_string = "select message from `".$tbl_name."`";
									  $query_msg = mysql_query($query_string) or DIE('query non riuscita: '.$query_string.' '.mysql_error());
									  if (mysql_num_rows($query_msg) > 0) {
									    echo '<div class="content">';
									    echo '		<table cellpadding="5" cellspacing="5" class="mdl-data-table--selectable mdl-shadow--2dp">';
									    echo '		<tbody>';
									    $i = 0;
									    while ($row_msg = mysql_fetch_row($query_msg)) {
									      $msg = $row_msg[0];
									      echo "	<tr>\n";
									      echo "		<td>\n";
									      echo "			<label class=\"mdl-radio mdl-js-radio mdl-js-ripple-effect\">\n";
									      echo "				<input type=\"radio\" name=\"".$inds[$j]."\" id=\"mess_".$inds[$j]."\" class=\"mdl-radio__button\" value=\"".$i."\" >\n";
									      echo "			</label>\n";
									      echo "		</td>\n";
									      echo "		<td>".$msg."</td></tr>\n";
									      $i++;
									    }
									    echo "		</tbody></table></div></div>";
									  }
									}
									?>
		 						</form>

		 						<button class="mdl-button mdl-js-button mdl-button--raised" onClick="readForm()" class="collapsible">
		 							Continue
		 						</button>
								<br>
							</div>
					 </div>
				</div>
		 </main>
	</div>

	<script type="text/javascript">
			var coll = document.getElementsByClassName("collapsible");
			var i;

			for (i = 0; i < coll.length; i++) {
				coll[i].addEventListener("click", function() {
					this.classList.toggle("active");
					var content = this.parentNode.nextElementSibling;
					while(content.nodeName  != "DIV" && content != null){
						content = content.nextElementSibling
						console.log(content)

					}
					if (content.style.display === "block") {
						content.style.display = "none";
					} else {
						content.style.display = "block";
					}
				});
			}
	</script>



</body>
</html>
