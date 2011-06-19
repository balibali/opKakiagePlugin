jQuery.noConflict();
(function($){
  $(function() {
    $("#kakiages .prev a").pjax("#Center");
    $("#kakiages .next a").pjax("#Center");
  });
})(jQuery);
