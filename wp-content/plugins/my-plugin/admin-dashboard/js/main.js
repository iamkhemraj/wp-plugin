jQuery(document).ready(function($){

  // Toggle vissiable category and tags fields
  function toggleCatnameVisibility(checked , property) {
    if (checked) {
      $(property).removeClass("d-none");
    } else {
      $(property).addClass("d-none");
    }
  }

  $('#category').click(function(){
    var isChecked = $(this).prop('checked');
    var property  = '#catname';
    toggleCatnameVisibility(isChecked , property);
  });

  $('#tags').click(function(){
    var isChecked = $(this).prop('checked');
    var property  = '#tagname';
    toggleCatnameVisibility(isChecked , property);
  });

});
