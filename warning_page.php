<?php
include("utils/db_con.php");
session_start();

$indicators = isset($_GET["indicators"]) ? $_GET["indicators"] : array();
$parameters = isset($_GET["parameters"]) ? $_GET["parameters"] : array();

/*for ($i = 0; $i < count($parameters); $i++) {
 echo "param".$i.": ".$parameters[$i]."\n";
}
for ($i = 0; $i < count($indicators); $i++) {
 echo "indic".$i.": ".$indicators[$i]."\n";
}*/
$mtd = $_GET["method"];

$address = $_GET["address"];

if ($mtd == "latin square" && ($_SESSION["index"] == null || $_SESSION["index"] == -1)) {
	//echo "Sono dentro";
	$_SESSION["index"] = 0;
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
            <div class="col-md-2 offset-md-3">
                <img src="Group.svg" alt="">
            </div>
            <div class="col-md my-auto">
                <h1 class="white">Deceptive Site!</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-md-9 offset-md-2 mt-5">
                <p class="white">
                    There is evidence that <b><?php echo $address ?></b> may be a fraudolent site. It is attempting to steal
                    your information (passwords, messages or credit cards informations).<br>
                </p>
            </div>
            <br>
            <br>
            <div class="col-md-8 offset-md-2">
                <p class="white">
                    Do you really want to proceed?
                </p>
            </div>
        </div>
        <div class="row mt-5">
            <div class="col-md-4 offset-md-2">
                <a id="why-message-button" href="#" class="white underline">I want more information (advanced)</a>
            </div>
            <div class="col-md-4 offset-md-2">
                <button class="btn btn-primary" type="#">Back to safety</button>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-md-7 offset-md-2">
            
			<!-- tag to pass the number of indicators as a parameter -->
            <div id="indicator_nums" style="display: none;">
            	<?php
					$indicator_nums = count($indicators);
                    echo htmlspecialchars($indicator_nums); 
            	?>
	        </div>
            
            
                <ul id="indicators-list">
				<?php
					if ($mtd == "random") {
                    	$_SESSION["index"] = -1;
						for ($i = 0; $i < count($indicators); $i++) {
							echo "<li>";
							echo "    <span>";
							echo "        <img src=\"baseline_highlight_off_white_18dp.png\" alt=\"\">";
							echo "    </span>";
							echo "    <span class=\"white underline my-auto\">";
							echo $indicators[$i];
							echo "    </span>";
							
							// I get the value of the associated indicator (if present)
							$variable = $indicators[$i]."_param";
							$variable = str_replace(" ", "_", $variable);
							$indicator_parameter = isset($_GET[$variable]) ? $_GET[$variable] : null;
							
							// I get the number of messages of a specific indicator
							$tbl_to_query = str_replace(" ", "_", $indicators[$i]);
							$query_string = "select count(*) from `" . $tbl_to_query . "`";
							$query_num_msgs = mysql_query($query_string) or DIE('query non riuscita: '.$query_string.' '.mysql_error());
							if (mysql_num_rows($query_num_msgs) > 0) {
								while ($row_num_msgs = mysql_fetch_row($query_num_msgs)) {
									$num_msgs = $row_num_msgs[0];
								}
							}
							
							// I choose a random message
							$msg_id = rand(1,$num_msgs);
							
							// I retrieve a message
							$query_string = "select message from `" . $tbl_to_query . "` where id = " . $msg_id;
							$query_msg = mysql_query($query_string) or DIE('query non riuscita: '.$query_string.' '.mysql_error());
							if (mysql_num_rows($query_msg) > 0) {
								while ($row_msg = mysql_fetch_row($query_msg)) {
									$msg = $row_msg[0];
								}
							}
							
							echo "    <p id=\"test\" class=\"white indicator-description\">";
							// Replace XXX in the message with the parameters from the configuration page
							$msg = str_replace("XXX", "<b>$indicator_parameter</b>", $msg);
							echo $msg;
							echo "    </p>";
							echo "</li>";
						}
					} else if ($mtd == "latin square") {
						$index_ls = $_SESSION["index"];
						for ($i = 0; $i < count($indicators); $i++) {
							echo "<li>";
							echo "    <span>";
							echo "        <img src=\"baseline_highlight_off_white_18dp.png\" alt=\"\">";
							echo "    </span>";
							echo "    <span class=\"white underline my-auto\">";
							echo $indicators[$i];
							echo "    </span>";
							
							// I get the value of the associated indicator (if present)
							$variable = $indicators[$i]."_param";
							$variable = str_replace(" ", "_", $variable);
							$indicator_parameter = isset($_GET[$variable]) ? $_GET[$variable] : null;
							
							// I get the number of messages of a specific indicator
							$tbl_to_query = str_replace(" ", "_", $indicators[$i]);
							$query_string = "select count(*) from `" . $tbl_to_query . "`";
							$query_num_msgs = mysql_query($query_string) or DIE('query non riuscita: '.$query_string.' '.mysql_error());
							if (mysql_num_rows($query_num_msgs) > 0) {
								while ($row_num_msgs = mysql_fetch_row($query_num_msgs)) {
									$num_msgs = $row_num_msgs[0];
								}
							}
							
							/*// I choose a random message
							$msg_id = rand(1,$num_msgs);*/
							
							$msg_id = ($index_ls % $num_msgs)+1;
							//echo "ls_index: " . $index_ls . "<br>";
							//echo "num msg tab: " . $num_msgs . "<br>";
							//echo "message n. " . $msg_id;
							
							// I retrieve a message
							$query_string = "select message from `" . $tbl_to_query . "` where id = " . $msg_id;
							//echo "select message from `" . $tbl_to_query . "` where id = " . $msg_id;
							
							$query_msg = mysql_query($query_string) or DIE('query non riuscita: '.$query_string.' '.mysql_error());
							if (mysql_num_rows($query_msg) > 0) {
								while ($row_msg = mysql_fetch_row($query_msg)) {
									$msg = $row_msg[0];
								}
							}
							
							echo "    <p id=\"test\" class=\"white indicator-description\">";
							// Replace XXX in the message with the parameters from the configuration page
							$msg = str_replace("XXX", "<b>$indicator_parameter</b>", $msg);
							echo $msg;
							echo "    </p>";
							echo "</li>";
							
							// I increment the index
							$index_ls++;
						}
						$_SESSION["index"]++;
					}
				?>
                </ul>
            </div>
        </div>
        <div class="row mt-5" id="proceeding-info">
            <div class="col-md offset-md-2">
                <p class="white">If you want to proceed, you must read all the risks explanations.</p>
            </div>
        </div>
        <div class="row mt-5">
            <div class="col-md offset-md-2 mb-5">
                <a id="proceed-message" href="#" class="white underline">I know all the risks and I want to proceed.
                    (Not recommended)</a>
            </div>
        </div>
		<br><br>
		<div align="center">
			<a href="."><button class="btn1">Back to configuration</button></a>
			<a><button onClick="window.location.reload()" class="btn1">Generate new messages</button></a>
		</div>
		<br>
    </div>

</body>

<style>
    body {
        background-color: #F74242;
    }

    .white {
        color: white;
    }

    .underline {
        text-decoration: underline;
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
	
	.btn1 {border-radius: 4px;}
</style>

<script>
    var ul = document.getElementById('indicators-list');  // Parent
    let counterExpandedParagraphs = 0; // Keeps track of expanded paragraphs

    ul.addEventListener('click', function (e) {
        var target = e.target; // Clicked element

        while (target && target.parentNode !== ul) {
            target = target.parentNode; // If the clicked element isn't a direct child
            if (!target) {
                return; // If element doesn't exist 
            }
        }
        if (target.tagName === 'LI') {
            for (var i = 0; i < target.childNodes.length; i++) {
                if (target.childNodes[i].tagName === 'P') {
                    if (target.childNodes[i].style.display == 'none' || target.childNodes[i].style.display == '') {
                        target.childNodes[i].style.display = 'block';
                        counterExpandedParagraphs += 1;
                    }
                    else {
                        target.childNodes[i].style.display = 'none';
                        counterExpandedParagraphs -= 1;
                    }
                    break;
                }
            }
        }
        handleProceedingMessages();
    });

    let whyMessageButton = document.getElementById("why-message-button");
    let whyMessageButtonFlag = false; //flag to keep track if all the indicators have to be hidden or shown
    whyMessageButton.addEventListener('click', function (e) {
        whyMessageButtonFlag = !whyMessageButtonFlag;
        let lis = ul.getElementsByTagName("li");
        for (let i = 0; i < lis.length; i++) {
            for (let j = 0; j < lis[i].childNodes.length; j++) {
                if (lis[i].childNodes[j].tagName === 'P') {
                    if (whyMessageButtonFlag) {
                        if (lis[i].childNodes[j].style.display == 'none' || lis[i].childNodes[j].style.display == '') {
                            lis[i].childNodes[j].style.display = 'block';
                            counterExpandedParagraphs += 1;
                        }
                    }
                    else {
                        if (lis[i].childNodes[j].style.display == 'block') {
                            lis[i].childNodes[j].style.display = 'none'
                            counterExpandedParagraphs -= 1;
                        }
                    }
                    break;
                }
            }
        }
        handleProceedingMessages();
    });

    function handleProceedingMessages() {
        // Hide/Shows the proceed link if the paragraphs are expanded
        //If proceed message is displayed, hide proceeding info
        
    	var div = document.getElementById("indicator_nums");
    	var nums = div.textContent;
        
        let proceedMessage = document.getElementById('proceed-message');
        if (counterExpandedParagraphs == nums) {
            proceedMessage.style.display = 'block';
            document.getElementById("proceeding-info").style.display = 'none';
        }
        else if (proceedMessage.style.display == 'block') {
            proceedMessage.style.display = 'none';
            document.getElementById("proceeding-info").style.display = 'block';
        }
    }
</script>

</html>