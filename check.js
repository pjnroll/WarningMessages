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
      alert("Checked->" + checkedBoxes.length);
		document.getElementById("warn_form_dynamic").submit();
	}
}

function prova(id) {
  var checkedBoxes = getCheckedBoxes("warn_form_manual");
  alert("Checked->"+checkedBoxes.length);
  if (checkedBoxes.length > 3) {
    alert("You cannot select more indicators (maximum 3)");
    document.getElementById(id).checked = false;
  } else {
    alert("We" + id);
  }

}
