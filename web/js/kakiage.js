jQuery.noConflict();
(function($){
  $(function() {
    var pjax_options = {
      success: on_success
    };

    // pjax
    $("#kakiages .prev a").pjax("#Center", pjax_options);
    $("#kakiages .next a").pjax("#Center", pjax_options); 

    // mine first
    sort_mine_first();
  });
  function on_success() {
    sort_mine_first();
  }
  function sort_mine_first() {
    $("#kakiages .kakiage_mine").insertAfter("#topEditLink")
  }
})(jQuery);
