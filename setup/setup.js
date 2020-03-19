 $(document).ready(function(){
		var indicators = [
				"URL Mimicking", 
				"Self-Signed HTTPs cetrificate", 
				"Time Life (Age)",
				"Archived Domain",
				"Server Location",
				"Alexa Ranking",
				"Name Length",
				"Top-level Domain"
			]
//	pippo
		for (var i = indicators.length - 1; i >= 0; i--) {
			$( "#indicators" )
			.append(
				  '<li class="mdl-list__item">'+
				    '<span class="mdl-list__item-primary-content">'+
				      '<label for="'+indicators[i]+i+'"> '+indicators[i]+'</label>'+
				    '</span>'+
				    '<span class="mdl-list__item-secondary-action">'+
				      '<label class="mdl-checkbox mdl-js-checkbox mdl-js-ripple-effect" for="'+indicators[i]+i+'">'+
				        '<input class="mdl-checkbox__input" type="checkbox" name="indicators[]" id="'+indicators[i]+i+'" value="'+indicators[i]+'"/>'+
				      '</label>'+
				    '</span>'+
				  '</li>' );

		}

		componentHandler.upgradeAllRegistered()

    });


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




function readForm() {
	var method = document.getElementById("method").value;
    var checkedBoxes = getCheckedBoxes("warn_form");
    var json_params = {"indicators":checkedBoxes, "method":method} 
    location.replace("../warning/warning_page.php" + "?" + $.param(json_params));

}