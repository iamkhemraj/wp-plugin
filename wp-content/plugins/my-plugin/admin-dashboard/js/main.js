jQuery(document).ready(function($) {
  // Function to toggle visibility of cpt fields
  function toggleFieldVisibility(ischecked, property, check) {
    if (ischecked) {
        $(check).prop('checked', true); // Ensure checkbox is checked
        $(property).removeClass("d-none");
    } else {
        $(property).addClass("d-none");
    }
  }

  // Function to save checkbox state in local storage
  function saveCheckboxState(checkboxId, isChecked) {
    localStorage.setItem(checkboxId, isChecked);
  }

  // Function to get checkbox state from local storage
  function getCheckboxState(checkboxId) {
    return localStorage.getItem(checkboxId) === "true";
  }

  // Handle category checkbox
  var categoryCheckbox = $('#category_check');
  categoryCheckbox.prop('checked', getCheckboxState('category_check')); // Set initial state from local storage
  categoryCheckbox.change(function() {
      var isChecked = $(this).prop('checked');
      saveCheckboxState('category_check', isChecked);
      var property = '#category';
      toggleFieldVisibility(isChecked, property, this);
  }).change();

    // Handle tags checkbox
    var tagsCheckbox = $('#tags_check');
    tagsCheckbox.prop('checked', getCheckboxState('tags_check')); // Set initial state from local storage
    tagsCheckbox.change(function() {
        var isChecked = $(this).prop('checked');
        saveCheckboxState('tags_check', isChecked);
        var property = '#tags';
        toggleFieldVisibility(isChecked, property, this);
    }).change();

    // Automatically close alert after 5 seconds
    setTimeout(function() {
        $('#alert').alert('close');
    }, 5000);
});
