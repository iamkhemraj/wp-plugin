jQuery(document).ready(function ($) {

  function toggleFieldVisibility(checked, property) { // Toggle visibility of cpt fields
    if (checked) {
      $(property).removeClass("d-none");
    } else {
      $(property).addClass("d-none");
    }
  }

  $('#category_check').change(function () { // Query for cotegory check box
    var isChecked = $(this).prop('checked');
    var property = '#category';
    toggleFieldVisibility(isChecked, property);
  });

  $('#tags_check').change(function () {  // Query for tags check box
    var isChecked = $(this).prop('checked');
    var property = '#tags';
    toggleFieldVisibility(isChecked, property);
  });

//   $('.cpt-list').change(function () {  // Check value cpt is exsit or not 
//     const cptArray = $('.cpt-list:checked').map(function () {
//       return $(this).val().trim();
//     }).get();

//     const postName = $(this).val().trim(); // get post type val
  
//     if (cptArray.indexOf(postName)) {
//         unregister_cpt(postName);
//         function unregister_cpt($post_type){


//         }

//     } else {
//       alert(postName+ "does not unregister !" );
//     }
//   });







});

