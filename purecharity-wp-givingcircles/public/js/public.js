(function( jQuery ) {
  'use strict';
  $(document).ready(function(){
    jQuery('#gc-tabs div').hide();
    jQuery('#gc-tabs div:first').show();
    jQuery('#gc-tabs ul li:first').addClass('active');
     
    jQuery('#gc-tabs ul:first li a').click(function(){
      jQuery('#gc-tabs ul:first li').removeClass('active');
      jQuery(this).parent().addClass('active');
      var currentTab = jQuery(this).attr('href');
      jQuery('#gc-tabs div').hide();
      jQuery(currentTab).show();
      return false;
    });  
  })
  

})( jQuery );

