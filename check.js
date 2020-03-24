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
  if (indicators == null) {
    return "You must choose at least one indicator";
  } else if (!validIndicators(indicators) || !validMessages(messages)) {
    return "You made mistakes in choosing indicators and messages. Check better.";
  } else if (indicators.length != messages.length) {
    return "You didn't chose one ore more messages";
  } else if (indicators.length > 3) {
    return "You selected more than 3 indicators. 3 maximum allowed.";
  }

  return "true";
}

function readForm() {
  /*var params = document.getElementsByClassName("parameters");
  var param_name = [];
  var param_value = [];
  for (var i = 0; i < params.length; i++) {
    param_name.push(params[i].id);
    param_value.push(params[i].value);
    alert((i+1) + "->" + param_name[i]+":"+param_value[i]);
  }*/
  var address = document.getElementById("address_manual").value;
  var method = "manual";
  var checkedBoxesRadios = getCheckedBoxes("warn_form_manual");
  var indicators = [];
  var messages = [];
  if (checkedBoxesRadios == null) {
    alert("You must choose at least one indicator.");
  } else {
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
      var json_params = {"method":method, "address":address, "indicators":indicators, "messages":messages};
      //alert("we->" + JSON.stringify(json_params));
      var my_params = "{";
      for (var i = 0; i < indicators.length; i++) {
        var val = document.getElementById(indicators[i]+"_param_manual");
        if (val != null) {
          val = val.value;
          my_params += "\"" + indicators[i] + "_param\":\""+val+"\",";
        }
      }
      var l = my_params.length;
      if (l > 1) {
        my_params = my_params.substring(0, l-1);
      }
      my_params += "}";

      my_params = JSON.parse(my_params);
      //alert("my->" + my_params);
      location.replace("/warning_page.php" + "?" + $.param(json_params) + "&" + $.param(my_params));
    }
  }
}

function checkCheckbox(ident) {
  //document.getElementById("btn_"+ident).click();
  var el = document.getElementById("chk_" + ident);
  if (el.checked == false) {
    var radio = document.getElementById("mess_" + ident);
    radio.click();
    radio.checked = false;
  }
}
