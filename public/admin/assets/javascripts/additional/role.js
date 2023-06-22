// Get the parent and child checkboxes
var parentCheckboxes = document.querySelectorAll('[id^="access_"]');
var childCheckboxes = document.querySelectorAll('[name^="post-child-"], [name^="event-child-"]');

// When the parent checkbox is clicked
parentCheckboxes.forEach(function(parentCheckbox) {
parentCheckbox.addEventListener("click", function() {
  var childCheckboxesToCheck = document.querySelectorAll('[name^="' + this.id.replace('access_', '') + '-child-"]');
  // If it is checked, check all child checkboxes
  if (parentCheckbox.checked) {
    for (var i = 0; i < childCheckboxesToCheck.length; i++) {
      childCheckboxesToCheck[i].checked = true;
    }
  }
  // If it is unchecked, uncheck all child checkboxes
  else {
    for (var i = 0; i < childCheckboxesToCheck.length; i++) {
      childCheckboxesToCheck[i].checked = false;
    }
  }
});
});

// Select all checkboxes
const checkboxes = document.querySelectorAll('input[type="checkbox"]');

// Add event listener to each checkbox
checkboxes.forEach(function(checkbox) {
  checkbox.addEventListener('change', function() {
	// If checkbox is checked, set value to '1', otherwise set value to '0'
	if (checkbox.checked) {
	  checkbox.value = '1';
	} else {
	  checkbox.value = '0';
	}
  });
});