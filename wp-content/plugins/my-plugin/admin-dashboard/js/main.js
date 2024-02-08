jQuery(document).ready(function($){

  function toggleFieldVisibility(checked, property) { // Toggle visibility of cpt fields
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

  $("#form").validate({  // jQuery cpt form validation
    rules: {
        post_type: {
            required: true,
            minlength: 2,
            maxlength:15
        },
  
    },
    messages: {
        post_type: {
            required: "Please enter post type",
            maxlength:"max length 15 digits",
            minlength: "Your username must consist of at least 2 characters"
        },
      
    }
  });

});




