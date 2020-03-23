<?php
include("utils/db_con.php");
session_start();

$indicators = isset($_GET["indicators"]) ? $_GET["indicators"] : array();
$parameters = isset($_GET["parameters"]) ? $_GET["parameters"] : array();
$n_indicators = count($indicators);
//$n_indicators = 3;
/*for ($i = 0; $i < count($parameters); $i++) {
 echo "param".$i.": ".$parameters[$i]."\n";
}
for ($i = 0; $i < count($indicators); $i++) {
 echo "indic".$i.": ".$indicators[$i]."\n";
}*/
$mtd = $_GET["method"];

$address = $_GET["address"];

//echo "prima di if index:".$_SESSION["index"];
if ($mtd == "latin square" && ($_SESSION["index"] == null || $_SESSION["index"] == -1)) {
	//echo "prima index:".$_SESSION["index"];
	$_SESSION["index"] = 0;
	//echo "\ndopo index:".$_SESSION["index"];
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <div class="row mt-5">
            <div class="col-md offset-md-1">
                <img src="Group.svg" alt="">
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-md offset-md-1">
                <h1 class="white">Deceptive Site</h1>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-md-9 offset-md-1">
                <p class="white">
                  There is evidence that <b><?php echo $address ?></b> may be a fraudolent site. It is attempting to steal
                  your information (passwords, messages or credit cards informations).<br>
                </p>

            </div>
        </div>

        <!-- start indicators panels -->
        <?php
          if ($n_indicators == 1) {
	          $class = "col-md-9";
          } else if ($n_indicators == 2) {
	          $class = "col-md-4";
          } else if ($n_indicators == 3) {
	          $class = "col-md-3";
          } else if ($n_indicators > 3) {
	          $class = "col-md-2";
          }
         ?>

        <div class="row mt-3">
          <?php
          $inds_msgs = array();
          if ($mtd == "random") {
            $_SESSION["index"] = -1;

            for ($i = 0; $i < $n_indicators; $i++) {
              $rand = rand(0, count($indicators)-1);
              echo "<div class=\"".$class; if ($i == 0 || $n_indicators == 2) echo " offset-md-1"; echo "\">\n";
              echo "    <div class=\"card\">\n";
              echo "        <div class=\"card-header\">\n";
              echo "<b>".$indicators[$rand]."</b>\n";

              // I get the value of the associated indicator (if present)
              $variable = $indicators[$rand]."_param";
              $variable = str_replace(" ", "_", $variable);
              $indicator_parameter = isset($_GET[$variable]) ? $_GET[$variable] : null;

              // I get the number of messages of a specific indicator
              $tbl_to_query = str_replace(" ", "_", $indicators[$rand]);
              $query_string = "select count(*) from `" . $tbl_to_query . "`";
              $query_num_msgs = mysql_query($query_string) or DIE('query non riuscita: '.$query_string.' '.mysql_error());
              if (mysql_num_rows($query_num_msgs) > 0) {
                while ($row_num_msgs = mysql_fetch_row($query_num_msgs)) {
                  $num_msgs = $row_num_msgs[0];
                }
              }

              // I choose a random message
              $msg_id = rand(1,$num_msgs);

							// I save the indicator and the id msg to show a different message
							// in the Explain More section
	            $inds_msgs[$i] = [$indicators[$rand], $msg_id];

              // I retrieve a message
              $query_string = "select message from `" . $tbl_to_query . "` where id = " . $msg_id;
              $query_msg = mysql_query($query_string) or DIE('query non riuscita: '.$query_string.' '.mysql_error());
              if (mysql_num_rows($query_msg) > 0) {
                while ($row_msg = mysql_fetch_row($query_msg)) {
                  $msg = $row_msg[0];
                }
              }

              // Replace XXX in the message with the parameters from the configuration page
              $msg = str_replace("XXX", "<b>$indicator_parameter</b>", $msg);

              // Replace YYY in the message with the address of the phishing website
              $msg = str_replace("YYY", "<b>$address</b>", $msg);

              echo "        </div>\n";
              echo "        <div class=\"card-body\">\n";
              //echo "            <h5 class=\"card-title\">Special title treatment</h5>\n";
              echo "            <p class=\"card-text\">".$msg."</p>\n";

              echo "        </div>\n";
              echo "    </div>\n";
              echo "</div>\n";

							// I remove the indicator and sort the array to randomize
							// the indicators order
              unset($indicators[$rand]);
              sort($indicators);
            }
          } else if ($mtd == "latin square") {
						//$index_ls_msg = $_SESSION["index"];
						for ($i = 0; $i < count($indicators); $i++) {
							$index_ls_ind = ($i+$_SESSION["index"])%count($indicators);
							echo "<div class=\"".$class; if ($i == 0 || $n_indicators == 2) echo " offset-md-1"; echo "\">\n";
              echo "    <div class=\"card\">\n";
              echo "        <div class=\"card-header\">\n";
              echo "<b>".$indicators[$index_ls_ind]."</b>\n";

							// I get the value of the associated indicator (if present)
							$variable = $indicators[$index_ls_ind]."_param";
							$variable = str_replace(" ", "_", $variable);
							$indicator_parameter = isset($_GET[$variable]) ? $_GET[$variable] : null;

							// I get the number of messages of a specific indicator
							$tbl_to_query = str_replace(" ", "_", $indicators[$index_ls_ind]);
							$query_string = "select count(*) from `" . $tbl_to_query . "`";
							$query_num_msgs = mysql_query($query_string) or DIE('query non riuscita: '.$query_string.' '.mysql_error());
							if (mysql_num_rows($query_num_msgs) > 0) {
								while ($row_num_msgs = mysql_fetch_row($query_num_msgs)) {
									$num_msgs = $row_num_msgs[0];
								}
							}

							$msg_id = ($_SESSION["index"] % $num_msgs)+1;
							//echo "msg:$msg_id";

							// I save the indicator and the id msg to show a different message
							// in the Explain More section
	            $inds_msgs[$i] = [$indicators[$index_ls_ind], $msg_id];
							echo "ind:".$inds_msgs[$i][0]." msg:".$inds_msgs[$i][1];

							// I retrieve a message
							$query_string = "select message from `" . $tbl_to_query . "` where id = " . $msg_id;

							$query_msg = mysql_query($query_string) or DIE('query non riuscita: '.$query_string.' '.mysql_error());
							if (mysql_num_rows($query_msg) > 0) {
								while ($row_msg = mysql_fetch_row($query_msg)) {
									$msg = $row_msg[0];
								}
							}

							// Replace XXX in the message with the parameters from the configuration page
							$msg = str_replace("XXX", "<b>$indicator_parameter</b>", $msg);

							// Replace YYY in the message with the address of the phishing website
							$msg = str_replace("YYY", "<b>$address</b>", $msg);

							echo "        </div>\n";
							echo "        <div class=\"card-body\">\n";
							//echo "            <h5 class=\"card-title\">Special title treatment</h5>\n";
							echo "            <p class=\"card-text\">".$msg."</p>\n";

							echo "        </div>\n";
							echo "    </div>\n";
							echo "</div>\n";

						}
						$_SESSION["index"]++;

					}
          ?>
        </div>

        <!-- end indicators panels -->

        <div class="row mt-4 offset-md-6">
            <!--<div class="col-md-2 offset-md-1">
                <a href="#" class="white underline" onclick="handleProceedingMessages(this)">Advanced</a>
            </div>-->
            <div class="col-md-2 offset-md-3">
                <button id="explain-more-button" class="btn btn-danger float-right">Explain more</button>
            </div>
            <div class="col-md-2 offset-md-1">
                <button class="btn btn-danger float-right">Back to safety</button>
            </div>
        </div>
        <!-- Explain more cards -->
        <div id="explain-more-cards" class="row mt-3">

          <?php
					if ($mtd == "random") {
	          for ($i = 0; $i < $n_indicators; $i++) {
	            echo "<div class=\"".$class; if ($i == 0 || $n_indicators == 2) echo " offset-md-1"; echo "\">\n";
	            echo "    <div class=\"card\">\n";
	            echo "        <div class=\"card-header\">\n";
	            echo "<b>".$inds_msgs[$i][0]."</b>\n";

	            // I get the value of the associated indicator (if present)
	            $variable = $inds_msgs[$i][0]."_param";
	            $variable = str_replace(" ", "_", $variable);
	            $indicator_parameter = isset($_GET[$variable]) ? $_GET[$variable] : null;

	            // I get the number of messages of a specific indicator
	            $tbl_to_query = str_replace(" ", "_", $inds_msgs[$i][0]);
	            $query_string = "select count(*) from `" . $tbl_to_query . "`";
	            $query_num_msgs = mysql_query($query_string) or DIE('query non riuscita: '.$query_string.' '.mysql_error());
	            if (mysql_num_rows($query_num_msgs) > 0) {
	              while ($row_num_msgs = mysql_fetch_row($query_num_msgs)) {
	                $num_msgs = $row_num_msgs[0];
	              }
	            }

	            // I choose a random message
	            $msg_id = rand(1,$num_msgs);
	            while ($msg_id == $inds_msgs[$i][1]) {
	              $msg_id = rand(1,$num_msgs);
	            }

	            // I retrieve a message
	            $query_string = "select message from `" . $tbl_to_query . "` where id = " . $msg_id;
	            $query_msg = mysql_query($query_string) or DIE('query non riuscita: '.$query_string.' '.mysql_error());
	            if (mysql_num_rows($query_msg) > 0) {
	              while ($row_msg = mysql_fetch_row($query_msg)) {
	                $msg = $row_msg[0];
	              }
	            }

	            // Replace XXX in the message with the parameters from the configuration page
	            $msg = str_replace("XXX", "<b>$indicator_parameter</b>", $msg);

	            // Replace YYY in the message with the address of the phishing website
	            $msg = str_replace("YYY", "<b>$address</b>", $msg);

	            echo "        </div>\n";
	            echo "        <div class=\"card-body\">\n";
	            //echo "            <h5 class=\"card-title\">Special title treatment</h5>\n";
	            echo "            <p class=\"card-text\">".$msg."</p>\n";

	            echo "        </div>\n";
	            echo "    </div>\n";
	            echo "</div>\n";
	          }
					} else if ($mtd == "latin square") {
		          for ($i = 0; $i < $n_indicators; $i++) {
		            echo "<div class=\"".$class; if ($i == 0 || $n_indicators == 2) echo " offset-md-1"; echo "\">\n";
		            echo "    <div class=\"card\">\n";
		            echo "        <div class=\"card-header\">\n";
		            echo "<b>".$inds_msgs[$i][0]."</b>\n";

		            // I get the value of the associated indicator (if present)
		            $variable = $inds_msgs[$i][0]."_param";
		            $variable = str_replace(" ", "_", $variable);
		            $indicator_parameter = isset($_GET[$variable]) ? $_GET[$variable] : null;

		            // I get the number of messages of a specific indicator
		            $tbl_to_query = str_replace(" ", "_", $inds_msgs[$i][0]);
		            $query_string = "select count(*) from `" . $tbl_to_query . "`";
		            $query_num_msgs = mysql_query($query_string) or DIE('query non riuscita: '.$query_string.' '.mysql_error());
		            if (mysql_num_rows($query_num_msgs) > 0) {
		              while ($row_num_msgs = mysql_fetch_row($query_num_msgs)) {
		                $num_msgs = $row_num_msgs[0];
		              }
		            }

		            // I choose a random message
								//$msg_id = (($inds_msgs[$i][1]+1) % $num_msgs)+1;
		            /*$msg_id = rand(1,$num_msgs);
		            while ($msg_id == $inds_msgs[$i][1]) {
		              $msg_id = rand(1,$num_msgs);
		            }*/

								echo "ind:".$inds_msgs[$i][0]." msg:".$inds_msgs[$i][1];
								echo "\nprima msg:".$msg_id;
								$msg_id = ($msg_id+1)%$num_msgs;// = $inds_msgs[$i][1] + 1;

								echo "\ndopo msg:".$msg_id;
		            // I retrieve a message
		            $query_string = "select message from `" . $tbl_to_query . "` where id = " . $msg_id;
		            $query_msg = mysql_query($query_string) or DIE('query non riuscita: '.$query_string.' '.mysql_error());
		            if (mysql_num_rows($query_msg) > 0) {
									echo "Lo prendo nuovo";
		              while ($row_msg = mysql_fetch_row($query_msg)) {
		                $msg = $row_msg[0];
		              }
		            } else {echo "Uso il vecchio";}

		            // Replace XXX in the message with the parameters from the configuration page
		            $msg = str_replace("XXX", "<b>$indicator_parameter</b>", $msg);

		            // Replace YYY in the message with the address of the phishing website
		            $msg = str_replace("YYY", "<b>$address</b>", $msg);

		            echo "        </div>\n";
		            echo "        <div class=\"card-body\">\n";
		            //echo "            <h5 class=\"card-title\">Special title treatment</h5>\n";
		            echo "            <p class=\"card-text\">".$msg."</p>\n";

		            echo "        </div>\n";
		            echo "    </div>\n";
		            echo "</div>\n";
		          }
					}
          ?>

        </div>
        <div class="row mt-4">
          <div class="col-md-2 offset-md-1">
              <a href="#" class="white underline" onclick="handleProceedingMessages(this)">Advanced</a>
          </div>
        </div>
        <!-- END Explain more cards -->


        <!--<div class="row">1
            <div class="col-md-8 offset-md-2">
                <p class="white">
                    Do you really want to proceed?
                </p>
            </div>
        </div>
        <div class="row mt-5">
            <div class="col-md-4 offset-md-2">
                <a id="why-message-button" href="#" class="white underline">Why this message?</a>
            </div>
            <div class="col-md-4 offset-md-2">
                <button class="btn btn-primary" type="#">Back to safety</button>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-md-7 offset-md-2">
                <ul id="indicators-list">
                    <li>
                        <span>
                            <img src="baseline_highlight_off_white_18dp.png" alt="">
                        </span>
                        <span class="white underline my-auto">
                            URL MIMICKING
                        </span>
                        <p id="test" class="white indicator-description">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit,
                            sed do eiusmod tempor incididunt ut labore et dolore magna
                            aliqua. Ut enim ad minim veniam, quis nostrud exercitation
                            ullamco laboris nisi ut aliquip ex ea commodo consequat.
                        </p>
                    </li>
                    <li>
                        <span>
                            <img src="baseline_highlight_off_white_18dp.png" alt="">
                        </span>
                        <span class="white underline">
                            SELF SIGNED CERTIFICATE
                        </span>
                        <p class="white indicator-description">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit,
                            sed do eiusmod tempor incididunt ut labore et dolore magna
                            aliqua. Ut enim ad minim veniam, quis nostrud exercitation
                            ullamco laboris nisi ut aliquip ex ea commodo consequat.
                        </p>
                    </li>
                    <li>
                        <span>
                            <img src="baseline_highlight_off_white_18dp.png" alt="">
                        </span>
                        <span class="white underline">
                            ALEXA RANKING
                        </span>
                        <p class="white indicator-description">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit,
                            sed do eiusmod tempor incididunt ut labore et dolore magna
                            aliqua. Ut enim ad minim veniam, quis nostrud exercitation
                            ullamco laboris nisi ut aliquip ex ea commodo consequat.
                        </p>
                    </li>
                </ul>
            </div>
        </div>
        <div class="row mt-5" id="proceeding-info">
            <div class="col-md offset-md-2">
                <p class="white">If you want to proceed, you must read all the risks explanations.</p>
            </div>
        </div>-->
        <div class="row mt-5">
            <div class="col-md offset-md-1 mb-5">
                <p id="proceed-message" class="white mb-3">If you understand the risks to your security,
                     you may <a href="#" class="white underline">visit this site</a> (Not recommended).</p>
            </div>
        </div>


    		<br><br>
    		<div class="row mt-1">
          <div class="col-md-1 offset-md-3">
            <a href="."><button class="btn">Back to configuration</button></a>
          </div>
      			<?php if ($mtd != "manual") echo "<div class=\"col-md-2 offset-md-1\"><a><button onClick=\"window.location.reload()\" class=\"btn\">Generate new messages</button></a></div>";?>
    		</div>
    		<br>

    </div>

</body>

<style>
    body {
        background-color: #F74242;
    }

    .white {
        color: white !important;
    }

    .underline {
        text-decoration: underline !important;
    }

    ul {
        list-style-type: none;
    }

    li {
        margin-bottom: 10px;
    }

    li:hover {
        cursor: pointer;
    }

    .indicator-description {
        margin-left: 40px
    }

    li>p {
        display: none;
    }

    #proceed-message {
        display: none;
    }

    #explain-more-cards {
        display: none;
    }
</style>

<script>
    // var ul = document.getElementById('indicators-list');  // Parent
    // let counterExpandedParagraphs = 0; // Keeps track of expanded paragraphs

    // ul.addEventListener('click', function (e) {
    //     var target = e.target; // Clicked element

    //     while (target && target.parentNode !== ul) {
    //         target = target.parentNode; // If the clicked element isn't a direct child
    //         if (!target) {
    //             return; // If element doesn't exist
    //         }
    //     }
    //     if (target.tagName === 'LI') {
    //         for (var i = 0; i < target.childNodes.length; i++) {
    //             if (target.childNodes[i].tagName === 'P') {
    //                 if (target.childNodes[i].style.display == 'none' || target.childNodes[i].style.display == '') {
    //                     target.childNodes[i].style.display = 'block';
    //                     counterExpandedParagraphs += 1;
    //                 }
    //                 else {
    //                     target.childNodes[i].style.display = 'none';
    //                     counterExpandedParagraphs -= 1;
    //                 }
    //                 break;
    //             }
    //         }
    //     }
    //     handleProceedingMessages();
    // });

    // let whyMessageButton = document.getElementById("why-message-button");
    // let whyMessageButtonFlag = false; //flag to keep track if all the indicators have to be hidden or shown
    // whyMessageButton.addEventListener('click', function (e) {
    //     whyMessageButtonFlag = !whyMessageButtonFlag;
    //     let lis = ul.getElementsByTagName("li");
    //     for (let i = 0; i < lis.length; i++) {
    //         for (let j = 0; j < lis[i].childNodes.length; j++) {
    //             if (lis[i].childNodes[j].tagName === 'P') {
    //                 if (whyMessageButtonFlag) {
    //                     if (lis[i].childNodes[j].style.display == 'none' || lis[i].childNodes[j].style.display == '') {
    //                         lis[i].childNodes[j].style.display = 'block';
    //                         counterExpandedParagraphs += 1;
    //                     }
    //                 }
    //                 else {
    //                     if (lis[i].childNodes[j].style.display == 'block') {
    //                         lis[i].childNodes[j].style.display = 'none'
    //                         counterExpandedParagraphs -= 1;
    //                     }
    //                 }
    //                 break;
    //             }
    //         }
    //     }
    //     handleProceedingMessages();
    // });

    let explainMoreButton = document.getElementById("explain-more-button");
    explainMoreButton.addEventListener('click', function(e) {
        let explainMoreCards = document.getElementById("explain-more-cards");
        if(explainMoreCards.style.display == '' || explainMoreCards.style.display == 'none'){
            explainMoreCards.style.display = 'flex';
        }
        else{
            explainMoreCards.style.display = 'none';
        }
    });

    function handleProceedingMessages(self) {
        // Hide/Shows the proceed link if the paragraphs are expanded
        //If proceed message is displayed, hide proceeding info
        let proceedMessage = document.getElementById('proceed-message');
        proceedMessage.style.display = 'block';
        self.style.display = 'none';
        // if(proceedMessage.style.display == '' || proceedMessage.style.display == 'none'){
        //     proceedMessage.style.display = 'block';
        // }
        // else{
        //     proceedMessage.style.display = 'none';
        // }
        // if (counterExpandedParagraphs == 3) {
        //     proceedMessage.style.display = 'block';
        //     document.getElementById("proceeding-info").style.display = 'none';
        // }
        // else if (proceedMessage.style.display == 'block') {
        //     proceedMessage.style.display = 'none';
        //     document.getElementById("proceeding-info").style.display = 'block';
        // }
    }
</script>

</html>
