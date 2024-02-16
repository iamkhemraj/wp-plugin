jQuery(document).ready(function ($) {

  function toggleFieldVisibility(ischecked, property, check) { // Toggle visibility of cpt fields
    if (ischecked) {
      $(check).prop('checked', true); // Ensure checkbox is checked
      $(property).removeClass("d-none");
    } else {
      $(property).addClass("d-none");
    }
  }

  $('#category_check').change(function () { // Query for category checkbox
     var check     = $(this);
     var isChecked = $(this).prop('checked');
     var property  = '#category';
     toggleFieldVisibility(isChecked, property, check);
  }).change(); 
  $('#tags_check').change(function () { // Query for tags checkbox
     var check     = $(this);
     var isChecked = $(this).prop('checked');
     var property  = '#tags';
     toggleFieldVisibility(isChecked, property, check);
  }).change(); 

  //After registration alert close auto
  setTimeout(function () {  
    $('#alert').alert('close');  
  }, 5000); 

});