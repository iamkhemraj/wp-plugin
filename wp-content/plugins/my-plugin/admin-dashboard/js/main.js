jQuery(document).ready(function ($) {

  function toggleFieldVisibility(checked, property) { // Toggle visibility of cpt fields
    if (checked) {
      $(property).removeClass("d-none");
    } else {
      $(property).addClass("d-none");
    }
  }

  $('#category_check').change(function () {
    var isChecked = $(this).prop('checked');
    var property  = '#category';
    toggleFieldVisibility(isChecked, property);
  });

  $('#tags_check').change(function () {
    var isChecked = $(this).prop('checked');
    var property  = '#tags';
    toggleFieldVisibility(isChecked, property);
  });
  
  $('.cpt-list').change(function () {  // When the checkbox is clicked
   
    const cptArrame  =  $('.post_type-list').text();
    const cptName    =  cptArrame.split(" ");
    const result     =  myWords.filter(e =>  e);
    const postName   =  $('.cpt-list').text();

    if(result.indexOf(postName) !== -1)  
    {  
      alert( postName + "Yes, the value exists!"); 
    }   
    else  
    {  
      alert("No, the value is absent.");
    }  

});


