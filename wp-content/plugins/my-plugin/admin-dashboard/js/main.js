jQuery(document).ready(function($){

  // Toggle visibility of category and tags fields
  function toggleFieldVisibility(checked, property) {
    if (checked) {
      $(property).removeClass("d-none");
    } else {
      $(property).addClass("d-none");
    }
  }

  $('#category_check').change(function(){
    var isChecked = $(this).prop('checked');
    var property = '#category';
    toggleFieldVisibility(isChecked, property);
  });
  
  $('#tags_check').change(function(){
    var isChecked = $(this).prop('checked');
    var property = '#tags';
    toggleFieldVisibility(isChecked, property);
  });

});
