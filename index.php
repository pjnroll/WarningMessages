<?php
include("utils/db_con.php");
session_start();
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
						 <h1 style="text-align: center; margin: auto; width: 60%;  padding: 10px;">Dynamic Setup</h1>
						 <div class="mdl-card mdl-shadow--2dp" style="margin: auto; width: 60%;  padding: 10px;">
							 <form id="warn_form_dynamic" method="get" action="warning_page.php">
								 <div style="text-align: center;">

									 <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
								     <input class="mdl-textfield__input" name ="address" type="text" id="address">
								     <label class="mdl-textfield__label" for="sample1">Insert the phishing web address</label>
								   </div>
	 						 	</div>


								 <h4 style="text-align: center;">Select the indicators you want to show</h4>

								 <ul class="mdl-list" id="indicators">
										 <li class="mdl-list__item">
						 					<span class="mdl-list__item-primary-content">
						 						<label for="URL Mimicking">URL Mimicking</label>
						 					</span>
						 					<input type="text" placeholder="Actual web address" name="URL_Mimicking_param" id ="URL Mimicking_param" />&ensp;
						 					<span class="mdl-list__item-secondary-action">
						 						<label class="mdl-checkbox mdl-js-checkbox mdl-js-ripple-effect" for="URL Mimicking">
						 							<input class="mdl-checkbox__input" type="checkbox" name="indicators[]" id="URL Mimicking" value="URL Mimicking"/>
						 						</label>
						 					</span>
						 				</li>

						 				<li class="mdl-list__item">
						 					<span class="mdl-list__item-primary-content">
						 						<label for="Self-Signed HTTPs cetrificate">Self-Signed HTTPs cetrificate</label>
						 					</span>
						 					<span class="mdl-list__item-secondary-action">
						 						<label class="mdl-checkbox mdl-js-checkbox mdl-js-ripple-effect" for="Self-Signed HTTPs cetrificate">
						 							<input class="mdl-checkbox__input" type="checkbox" name="indicators[]" id="Self-Signed HTTPs cetrificate" value="Self-Signed HTTPs cetrificate"/>
						 						</label>
						 					</span>
						 				</li>


						 				<li class="mdl-list__item">
						 					<span class="mdl-list__item-primary-content">
						 						<label for="Time Life (Age)">Time Life (Age)</label>
						 					</span>
						 					<input type="text" placeholder="Age of the domain (e.g. 2 days)" name="Time_Life_(Age)_param" id ="Time Life (Age)_param" />&ensp;
						 					<span class="mdl-list__item-secondary-action">
						 						<label class="mdl-checkbox mdl-js-checkbox mdl-js-ripple-effect" for="Time Life (Age)">
						 							<input class="mdl-checkbox__input" type="checkbox" name="indicators[]" id="Time Life (Age)" value="Time Life (Age)"/>
						 						</label>
						 					</span>
						 				</li>

						 				<li class="mdl-list__item">
						 					<span class="mdl-list__item-primary-content">
						 						<label for="Archived Domain">Archived Domain</label>
						 					</span>
						 					<span class="mdl-list__item-secondary-action">
						 						<label class="mdl-checkbox mdl-js-checkbox mdl-js-ripple-effect" for="Archived Domain">
						 							<input class="mdl-checkbox__input" type="checkbox" name="indicators[]" id="Archived Domain" value="Archived Domain"/>
						 						</label>
						 					</span>
						 				</li>


						 				<li class="mdl-list__item">
						 					<span class="mdl-list__item-primary-content">
						 						<label for="Server Location">Server Location</label>
						 					</span>
						 					<input type="text" placeholder="Location of the server (e.g. Russia)" name="Server_Location_param" id ="Server Location_param" />&ensp;
						 					<span class="mdl-list__item-secondary-action">
						 						<label class="mdl-checkbox mdl-js-checkbox mdl-js-ripple-effect" for="Server Location">
						 							<input class="mdl-checkbox__input" type="checkbox" name="indicators[]" id="Server Location" value="Server Location"/>
						 						</label>
						 					</span>
						 				</li>

						 				<li class="mdl-list__item">
						 					<span class="mdl-list__item-primary-content">
						 						<label for="Alexa Ranking">Alexa Ranking</label>
						 					</span>
						 					<input type="text" placeholder="Alexa Ranking score (e.g. 24)" name="Alexa_Ranking_param" id ="Alexa Ranking_param" />&ensp;
						 					<span class="mdl-list__item-secondary-action">
						 						<label class="mdl-checkbox mdl-js-checkbox mdl-js-ripple-effect" for="Alexa Ranking">
						 							<input class="mdl-checkbox__input" type="checkbox" name="indicators[]" id="Alexa Ranking" value="Alexa Ranking"/>
						 						</label>
						 					</span>
						 				</li>


						 				<li class="mdl-list__item">
						 					<span class="mdl-list__item-primary-content">
						 						<label for="Name Length">Name Length</label>
						 					</span>
						 					<span class="mdl-list__item-secondary-action">
						 						<label class="mdl-checkbox mdl-js-checkbox mdl-js-ripple-effect" for="Name Length">
						 							<input class="mdl-checkbox__input" type="checkbox" name="indicators[]" id="Name Length" value="Name Length"/>
						 						</label>
						 					</span>
						 				</li>

						 				<li class="mdl-list__item">
						 					<span class="mdl-list__item-primary-content">
						 						<label for="Top-level Domain">Top-level Domain</label>
						 					</span>
						 					<input type="text" placeholder="Full top level domain (e.g. .cf)" name="Top-level_Domain_param" id ="Top-level Domain_param" />&ensp;
						 					<span class="mdl-list__item-secondary-action">
						 						<label class="mdl-checkbox mdl-js-checkbox mdl-js-ripple-effect" for="Top-level Domain">
						 							<input class="mdl-checkbox__input" type="checkbox" name="indicators[]" id="Top-level Domain" value="Top-level Domain"/>
						 						</label>
						 					</span>
						 				</li>
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
						 <h1 style = "text-align: center; margin: auto; width: 60%; padding: 10px;">Manual Setup</h1>
		 					<div class="mdl-card mdl-shadow--2dp" style="margin: auto; width: 60%; padding: 10px;">
		 						<form id="warn_form_manual" name="warn_form_manual" method="get" action="warning_page.php">
									<div style="text-align: center;">

 									 <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
 								     <input class="mdl-textfield__input" name ="address" type="text" id="address">
 								     <label class="mdl-textfield__label" for="sample1">Insert the phishing web address</label>
 								   </div>
 	 						 		</div>
									<input type="hidden" name="method" id="method" value="manual" />
		 							<h4 style="text-align: center;">Select the indicators (and messages) you want to show</h4>
									<?php
									$inds = ["URL Mimicking", "Self-Signed HTTPs cetrificate", "Time Life (Age)", "Archived Domain", "Server Location", "Alexa Ranking", "Name Length", "Top-level Domain"];
									for ($j = 0; $j < count($inds); $j++) {
									  echo '<div style="margin:0;" class="mdl-grid mdl-shadow--2dp">';
									  echo '	<label class="mdl-cell mdl-cell--1-col mdl-checkbox mdl-js-checkbox mdl-js-ripple-effect">';
									  echo "		<input class=\"mdl-checkbox__input\" type=\"checkbox\" name=\"indicators[]\" id=\"".$inds[$j]."\" value=\"".$inds[$j]."\" />";
									  echo '	</label>';
									  echo '	<h5 class="mdl-cell mdl-cell--10-col">'.$inds[$j].'</h5>';
									  echo '	<button type="button" class="collapsible mdl-cell mdl-cell--1-col mdl-button mdl-button--icon mdl-js-button mdl-js-ripple-effect">';
									  echo '		<i class="material-icons">keyboard_arrow_down</i>';
									  echo '	</button>';
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
									      echo '	<tr>';
									      echo '		<td>';
									      echo '			<label class="mdl-radio mdl-js-radio mdl-js-ripple-effect">';
									      echo '				<input type="radio" name="'.$inds[$j].'" id="mess_'.$inds[$j].'" class="mdl-radio__button" value="'.$i.'" >';
									      echo '			</label>';
									      echo '		</td>';
									      echo "		<td>".$msg."</td></tr>";
									      $i++;
									    }
									    echo '		</tbody></table></div></div>';
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
					var content = this.nextElementSibling;
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
