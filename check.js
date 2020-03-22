function getCheckedBoxes(formName) {
  var checkboxes = document.getElementById(formName);
  var checkboxesChecked = [];

  for (var i=0; i<checkboxes.length; i++) {
     if (checkboxes[i].checked) {
        checkboxesChecked.push(checkboxes[i].value);
     }
  }
  return checkboxesChecked.length > 0 ? checkboxesChecked : null;
}

function checkFormDynamic() {
	var checkedBoxes = getCheckedBoxes("warn_form_dynamic");
	if (checkedBoxes===null){
    	alert("You didn't check any indicator!");
    } else {
		document.getElementById("warn_form_dynamic").submit();
	}
}

function validIndicators(indicators) {
  for (var i = 0; i < indicators.length; i++) {
    //alert("Indicators->"+indicators[i]);
    if (!isValidIndicator(indicators[i])) {
      return false;
    }
  }
  return true;
}

function isValidIndicator(indicator) {
  if (indicator >= 0 && indicator <= 4) {
    return false;
  }
  return true;
}

function validMessages(messages) {
  for (var i = 0; i < messages.length; i++) {
    //alert("Messages->"+messages[i]);
    if (!isValidMessage(messages[i])) {
      return false;
    }
  }
  return true;
}

function isValidMessage(message) {
  if (message >= 0 && message <= 4) {
    return true;
  }
  return false;
}

function checkFormManual(indicators, messages) {
  if (!validIndicators(indicators) || !validMessages(messages)) {
    return "You made mistakes in choosing indicators and messages. Check better.";
  } else if (indicators.length != messages.length) {
    return "You didn't chose one ore more messages";
  } else if (indicators.length > 3) {
    return "You selected more than 3 indicators. 3 maximum allowed.";
  }

  return "true";
}

function readForm() {
  var method = "manual";
  var checkedBoxesRadios = getCheckedBoxes("warn_form_manual");
  var indicators = [];
  var messages = [];
  for (var i=0; i < checkedBoxesRadios.length; i++) {
    // it gets 1 indicator and 1 message, alternating each time
    if (i % 2 == 0) {
      indicators.push(checkedBoxesRadios[i]);
    } else {
      messages.push(checkedBoxesRadios[i]);
    }
  }
  var ans = checkFormManual(indicators, messages);
  if (ans != "true") {
    alert(ans);
  } else {
    var json_params = {"method":method, "indicators":indicators, "messages":messages};
    location.replace("/warning_page.php" + "?" + $.param(json_params));
  }
}

function checkCheckbox(ident) {
  /*var form = document.getElementById("warn_form_manual").innerHTML;
  alert("form\n"+form);*/
  var el = document.getElementById("chk_" + ident);
  alert(el.type);
  alert(ident + "->" + el.checked);
  if (el.checked == false) {
    var radio = document.getElementById("mess_" + ident);
    radio.checked = true;
    radio.checked = false;
  }

}
