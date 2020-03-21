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

function getCheckedRadio(formName) {
  var radios = document.getElementById(formName);
  var radiosChecked = [];

  for (var i=0; i<radios.length; i++) {
     if (radios[i].type=="radio" && radios[i].checked) {
        radiosChecked.push(radios[i].value);
     }
  }
  return radiosChecked.length > 0 ? radiosChecked : null;
}


function checkFormDynamic() {
	var checkedBoxes = getCheckedBoxes("warn_form_dynamic");
	if (checkedBoxes===null){
    	alert("You didn't check any indicator!");
    } else {
		document.getElementById("warn_form_dynamic").submit();
	}
}

function readForm() {
  var method = "manual";
  var checkedBoxes = getCheckedBoxes("warn_form_manual");
  var indicators = [];
  var messages = [];
  for (var i=0; i < checkedBoxes.length; i++) {
    //alert("indicators:"+checkedBoxes[i]);
    if (i % 2 == 0) {
      indicators.push(checkedBoxes[i]);
    } else {
      messages.push(checkedBoxes[i]);
    }
  }
  //var checkedRadio = getCheckedRadio("warn_form_manual");
  var json_params = {"method":method, "indicators":indicators, "messages":messages};
  location.replace("/warning_page.php" + "?" + $.param(json_params));

}

function checkFormManual(ident) {
	var checkedBoxes = getCheckedBoxes("warn_form_dynamic");
	if (checkedBoxes===null){
    	alert("You didn't check any indicator!");
    } else {
		document.getElementById("warn_form_dynamic").submit();
	}

  var checkedBoxes = getCheckedBoxes("warn_form_manual");
  for (var i = 0; i < checkedBoxes.length; i++) {
    alert("chk " + checkedBoxes[i].value + " = " + checkedBoxes[i].checked);
  }
  //alert("We" + id);
  //alert("Checked->"+checkedBoxes.length);
  if (checkedBoxes.length > 3) {
    document.getElementById(id).checked = false;
    alert("You cannot select more indicators (maximum 3)");
  }
    alert("dopo chk " + ident + ":" + ident.checked);
}

function formManualSubmit() {
  document.getElementById("warn_form_manual").submit();
}
