jQuery.noConflict();
(function($){
  var kakiage = {};
  kakiage.init = function() {
    kakiage.show_config();
    kakiage.show_datepicker();
  };

  kakiage.show_config = function() {
    var configs = {
      pjax: {
        caption: "pjax",
        check: function() { return $.support.pjax; },
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
        var cookie_path = window.location.pathname.replace(/[0-9\/]+$/, "");
        if ($(this).attr("checked")) {
          $.cookie(id, true, { path: cookie_path });
        } else {
          $.cookie(id, null, { path: cookie_path });
        }
        window.location = location.href;
      });
    });
  };

  kakiage.sort_mine_first = function() {
    $("#kakiages .kakiage_mine script").remove();
    $("#kakiages .kakiage_mine").insertBefore($("#kakiages .kakiage:first:not(.kakiage_mine)"));
  };

  kakiage.show_datepicker = function() {
    var $h3 = $("#kakiages .partsHeading h3");
    $('<input type="text" id="dp">').insertAfter($h3).hide();
    $("#dp").datepicker({
      dateFormat: "yy/mm/dd",
      defaultDate: new Date($h3.text().substr(0, 10)),
      showOn: "button",
      buttonText: "日付選択",
      changeMonth: true,
      showAnim: "fadeIn",
      showButtonPanel: true,
      onSelect: function(dateText) {
        var path = window.location.pathname.replace(/[0-9\/]+$/, "")+"/"+dateText;
        kakiage.pjax(path);
      }
    });
    $(".ui-datepicker-trigger")
      .button({ icons: { primary: 'ui-icon-calendar' }, text: false })
      .css({ fontSize: "9px", marginLeft: "8px", top: "3px" });
  };

  kakiage.pjax = function(path) {
    $.pjax({ url: path, container: "#Center", success: kakiage.init });
  };

  $(function() {
    kakiage.init();
    $("#kakiages .prev a, #kakiages .next a").pjax("#Center", { success: kakiage.init });

    $(document).keyup(function(e) {
      if (e.altKey || e.ctrlKey) return;

      switch (e.keyCode) {
        // left key
        case 37:
          kakiage.pjax($("#kakiages .prev a").attr("href"));
          break;

        // right key
        case 39:
          kakiage.pjax($("#kakiages .next a").attr("href"));
          break;
      }
    });
  });
})(jQuery);
