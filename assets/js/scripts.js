(function ($) {
    "use strict";
  
//news ticker
$(document).ready(function () {
  if ($(".site-header").find(".xews-ticker-wrapper").length > 0) {
    $(".xews-ticker-wrapper ul").not(".slick-initialized").slick({
      autoplay: true,
      vertical: true,
      arrows: false,
      slidesToShow: 1,
      slidesToScroll: 1,
    });
  }
});


})(jQuery);