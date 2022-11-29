$(document).ready(function(){
  
  $('ul.tabs li').click(function(){
    var tab_id = $(this).attr('data-tab');

    $('ul.tabs li').removeClass('current');
    $('.tab-content').removeClass('current');

    $(this).addClass('current');
    $("#"+tab_id).addClass('current');
  })
  $(".js-example-placeholder-multiple").select2({
      placeholder: "Select a state"
  });

})

// TAB JS

$(".Click-here").on('click', function() {
  $(".custom-model-main").addClass('model-open');
}); 
$(".close-btn, .bg-overlay").click(function(){
  $(".custom-model-main").removeClass('model-open');
});
// ADD PRODUCT JS

$(".csv-button").on('click', function() {
  $(".csv-model-main").addClass('csv-open');
}); 
$(".close-btn, .bg-overlay").click(function(){
  $(".csv-model-main").removeClass('csv-open');
});
// ADD PRODUCT JS


$(function(){
  
  $('li.dropdown-select > a').on('click',function(event){ 
    event.preventDefault()
    
    $(this).parent().find('ul').first().toggle(300);
    
    $(this).parent().siblings().find('ul').hide(200);
    
    //Hide menu when clicked outside
    $(this).parent().find('ul').mouseleave(function(){  
      var thisUI = $(this);
      $('html').click(function(){
        thisUI.hide();
        $('html').unbind('click');
      });
    });
      
  });

});

// MENU JS DROPDOWN