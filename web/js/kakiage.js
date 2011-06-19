jQuery.noConflict();
(function($){
  var kakiage = {};
  kakiage.init = function() {
    kakiage.show_config();
  };

  kakiage.show_config = function() {
    var configs = {
      pjax: {
        caption: "pjax",
        check: function() {
          return $.pjax != $.noop;
        },
        init: function(checked) {
          if (!checked)
            $.fn.pjax = $.noop;
        }
      },
      mine_first: {
        caption: "mine first",
        init: function(checked) {
          if (checked)
            kakiage.sort_mine_first();
          else
            kakiage.sort_mine_first = $.noop;
        }
      }
    };

    $('<div id="kakiage_config"></div>').css("float", "right").appendTo("#kakiages .partsHeading");

    $.each(configs, function(k, v) {
      var id = "kakiage_config_"+k, $checkbox;

      if (v.check && !v.check()) return;

      $("#kakiage_config").append(' <label><input type="checkbox" id="'+id+'" style="vertical-align: middle"> '+v.caption+'</label>');

      $checkbox = $("#"+id);
      $checkbox.attr("checked", $.cookie(id) || false);
      v.init($checkbox.attr("checked"));
      $checkbox.change(function() {
        if ($(this).attr("checked")) {
          $.cookie(id, true);
        } else {
          $.cookie(id, null);
        }
        window.location = location.href;
      });
    });
  };

  kakiage.sort_mine_first = function() {
    $("#kakiages .kakiage_mine").insertBefore($("#kakiages .kakiage:first:not(.kakiage_mine)"));
  };

  $(function() {
    kakiage.init();
    $("#kakiages .prev a, #kakiages .next a").pjax("#Center", { success: kakiage.init });
  });
})(jQuery);
