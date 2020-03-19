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


function checkForm() {
	var checkedBoxes = getCheckedBoxes("warn_form");
	if (checkedBoxes===null){
    	alert("You didn't check any indicator!");
    } else {
		document.getElementById("warn_form").submit();
	}
}