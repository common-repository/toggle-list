// adapted from SimpleTree jQuery plugin http://acesubido.com/SimpleTreejs/
(function($) {

  $.fn.extend({
    simpletree: function() {
      var attach;

      attach = function(el) {
        return el.delegate("ul.parent > li .toggler", "click", function(e) {
          e.preventDefault();
          $(this).parent().find("ul.child").first().slideToggle( 200 );
          if ($(this).hasClass("closed")) {
            return $(this).removeClass("closed");
          } else {
            return $(this).addClass("closed");
          }
        });
      };
      return attach(this);
    }
  });

  var simpletree_uls = $('ul:has(a.toggler):not(ul ul)');
  simpletree_uls.addClass('parent').wrap('<div class="simpletree"></div>');

  $('ul:not(.parent)', '.simpletree').addClass('child');

  $('a.toggler', '.simpletree').next('ul').slideToggle({
            duration: 100
          });

  $('.simpletree').simpletree();
  
})(jQuery);