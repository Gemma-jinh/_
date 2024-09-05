$(function () {
  // menu button
  var num = 0;
  var flag = true;
  $(".m-menu-btn")
    .unbind("click")
    .bind("click", function () {
      num++;
      if (flag) {
        $("#header .m-gnb-bg").fadeIn();
        $("#header .gnb").animate({ right: 0, opacity: 1 }, 500);
        $("#header .m-lang").animate({ right: 0, opacity: 1 }, 500);
        //			$("body").css("overflow","hidden");
        $("body").addClass("gnb-open");
        flag = false;
      } else {
        $("#header .m-gnb-bg").fadeOut();
        $("#header .gnb").animate({ right: -100 + "%", opacity: 1 }, 500);
        $("#header .m-lang").animate({ right: -100 + "%", opacity: 0 }, 500);
        flag = true;
        //			$("body").css("overflow","visible");
        $("body").removeClass("gnb-open");
      }
      $(this).toggleClass("on");
    });

  // gnb current menu
  var _pathname = location.pathname;
  _pathname = _pathname.split("/");
  if ($("html").attr("lang") == "ko") {
    _pathname = _pathname[1];
  } else {
    _pathname = _pathname[2];
  }
  $("#header .gnb > ul > li > a").each(function () {
    var _href = $(this).attr("href");
    if (_href.indexOf(_pathname) != -1) $(this).addClass("current");
  });

  // mobile 2depth
  function gnbClickOn() {
    $(".gnb>ul>li>a")
      .unbind("click")
      .bind("click", function (e) {
        var tag = $(this).parent().has("ul").text();
        if (tag.length != 0) {
          e.preventDefault();
          $(".gnb>ul>li>a")
            .not(this)
            .parent()
            .removeClass("on")
            .children("ul")
            .slideUp(200);
          $(this)
            .parent()
            .addClass("on")
            .children("ul")
            .slideToggle(200, function () {
              if ($(this).css("display") == "none") {
                $(this).parent().removeClass("on");
              }
            });
        }
      });
  }
  function gnbClickOff() {
    $(".gnb>ul>li>a")
      .unbind("click")
      .bind("click", function (e) {
        e.stopPropagation();
      });
  }

  // mobile footermenu
  function footergnbClickOn() {
    $("#footerSitemap>.inner>ul>li>a")
      .unbind("click")
      .bind("click", function (e) {
        var tag = $(this).parent().has("ul").text();
        if (tag.length != 0) {
          e.preventDefault();
          $("#footerSitemap>.inner>ul>li>a")
            .not(this)
            .parent()
            .removeClass("on")
            .children("ul")
            .slideUp(200);
          $(this)
            .parent()
            .addClass("on")
            .children("ul")
            .slideToggle(200, function () {
              if ($(this).css("display") == "none") {
                $(this).parent().removeClass("on");
              }
            });
        }
      });
  }
  function footergnbClickOff() {
    $("#footerSitemap>.inner>ul>li>a")
      .unbind("click")
      .bind("click", function (e) {
        e.stopPropagation();
      });
  }
  $(document).ready(function () {
    var w = $(window).width() + 18;
    if (w <= 1200) {
      gnbClickOn();
    } else {
      gnbClickOff();
    }

    if (w <= 767) {
      footergnbClickOn();
    }
  });
  $(window).on("load resize", function () {
    var w = $(window).width() + 18;
    if (w <= 1200) {
      gnbClickOn();
    } else {
      gnbClickOff();
    }

    if (w <= 767) {
      footergnbClickOn();
    }
  });

  // var sta = 50;
  $(window).scroll(function () {
    var scrollTop = $(window).scrollTop();
    var headerHeight = $("#header").outerHeight();
    //		var sta = $('.sta').outerHeight();
    if (scrollTop >= 30) {
      $("#header").addClass("fixed");
      $("#quickRight").addClass("fixed");
      $("body").addClass("gnb-fixed-padding");

      if (scrollTop >= 100) {
        $("#header").addClass("dark");
      } else {
        $("#header").removeClass("dark");
      }
    } else {
      $("#header").removeClass("fixed dark");
      $("#quickRight").removeClass("fixed");
      $("body").removeClass("gnb-fixed-padding");
    }
  });
  $(window).on("load resize", function () {
    var scrollTop = $(window).scrollTop();
    var headerHeight = $("#header").outerHeight();
    //		var sta = $('.sta').outerHeight();
    if (scrollTop >= 30) {
      $("#header").addClass("fixed");
      $("#quickRight").addClass("fixed");
      $("body").addClass("gnb-fixed-padding");

      if (scrollTop >= 100) {
        $("#header").addClass("dark");
      } else {
        $("#header").removeClass("dark");
      }
    } else {
      $("#header").removeClass("fixed dark");
      $("#quickRight").removeClass("fixed");
      $("body").removeClass("gnb-fixed-padding");
    }
  });

  /* sitemap */
  /*var headerSitemap = $('#headerSitemap');
	var gnbList = $('#header .gnb > ul');
	gnbList.clone().appendTo(headerSitemap);
	
	var sitemapBtn = $('.pc_sitemap_btn');
	sitemapBtn.on('click', function(){
		$(this).toggleClass('on');
		headerSitemap.toggleClass('on');
	});	
	
	*/

  var footerSitemap = $("#footerSitemap > .inner");
  var gnbList = $("#header .gnb > ul");
  gnbList.clone().appendTo(footerSitemap);

  /* footer family site */
  $(function () {
    $(".familySite h3 a").on("click", function (e) {
      e.preventDefault();
      if ($(".familySite").hasClass("on")) {
        $(".familySite").removeClass("on");
        $(".footSelect > ul").slideUp();
      } else {
        $(".familySite").addClass("on");
        $(".footSelect > ul").slideDown();
      }
    });
    $(document).click(function (event) {
      if (!$(event.target).closest(".familySite").length) {
        $(".familySite").removeClass("on");
        $(".footSelect > ul").slideUp();
      }
    });
  });

  // scroll link
  var href = window.location.href;

  // function linkTarket () {
  // 	$("#header .m-gnb-bg").fadeOut();
  // 	$("#header .gnb").animate({"right":-100+"%","opacity":1},500);
  // 	$("#header .m-lang").animate({"right":-100+"%","opacity":0},500);
  // 	flag = true;
  // 	$("body").css("overflow","visible");
  // 	$(".m-menu-btn").removeClass("on");
  // }

  $(
    "#header .gnb .depth2 a, .category_list--fc.depth2>li>a, #footerSitemap .depth2>li>a"
  ).on("click", function (e) {
    var gnbHref = $(this).attr("href");
    var w = $(window).width() + 18;

    if (gnbHref.indexOf("/company/") != -1) {
      e.preventDefault();
      var strArray = gnbHref.split("/company/");
      window.location.replace("/company#" + strArray[1]);

      // if ( w <= 1200) {
      //  	linkTarket();
      // }

      if (href.indexOf("/company") != -1) {
        hashScroll();
      }
    } else if (gnbHref.indexOf("/products/") != -1) {
      // products
      e.preventDefault();
      var strArray2 = gnbHref.split("/products/");
      window.location.replace("/products#" + strArray2[1]);

      // if ( w <= 1200) {
      // 	linkTarket();
      // }

      if (href.indexOf("/products") != -1) {
        hashScroll();
      }
    }
  });

  var w = $(window).width() + 18;
  if (w <= 1200) {
    $("#header .gnb .depth2 a").on("click", function (e) {
      $("#header .m-gnb-bg").fadeOut();
      $("#header .gnb").animate({ right: -100 + "%", opacity: 1 }, 500);
      $("#header .m-lang").animate({ right: -100 + "%", opacity: 0 }, 500);
      flag = true;
      $("body").css("overflow", "visible");
      $(".m-menu-btn").removeClass("on");
    });
  }
});

$(window).on("load", function () {
  var href = window.location.href;

  // href 따로 적용해서 작동함
  if (href.indexOf("/company#") != -1) {
    // company
    hashScroll();
  } else if (href.indexOf("/products#") != -1) {
    // products
    hashScroll();
  }

  $(
    "#header .gnb .depth2 a, .category_list--fc.depth2>li>a, #footerSitemap .depth2>li>a"
  ).on("click", function (e) {
    var gnbHref = $(this).attr("href");

    if (gnbHref.indexOf("/company/") != -1) {
      //company
      e.preventDefault();
      var strArray = gnbHref.split("/company/");
      window.location.replace("/company#" + strArray[1]);

      //     if ( w <= 1200) {
      //         linkTarket();
      //    }

      if (href.indexOf("/company") != -1) {
        hashScroll();
      }
    } else if (gnbHref.indexOf("/products/") != -1) {
      // products
      e.preventDefault();
      var strArray2 = gnbHref.split("/products/");
      window.location.replace("/products#" + strArray2[1]);

      // if ( w <= 1200) {
      // 	linkTarket();
      // }

      if (href.indexOf("/products") != -1) {
        hashScroll();
      }
    }
  });
  var w = $(window).width() + 18;
  if (w <= 1200) {
    $("#header .gnb .depth2 a").on("click", function (e) {
      $("#header .m-gnb-bg").fadeOut();
      $("#header .gnb").animate({ right: -100 + "%", opacity: 1 }, 500);
      $("#header .m-lang").animate({ right: -100 + "%", opacity: 0 }, 500);
      flag = true;
      $("body").css("overflow", "visible");
      $(".m-menu-btn").removeClass("on");
    });
  }
});

function hashScroll() {
  //    /var headerHeight = $("#header").outerHeight();
  if (window.location.hash) {
    var hashA = location.hash;
    //console.log(hashA);

    if (matchMedia("(max-width: 767px)").matches) {
      $("html,body").animate({
        // scrollTop: $(hashA).offset().top + 2
        scrollTop: $(hashA + "Target").offset().top - 41,
      });
      return false;
    } else {
      $("html,body").animate({
        // scrollTop: $(hashA).offset().top + 2
        scrollTop: $(hashA + "Target").offset().top,
      });
      return false;
    }

    // if ($('#cateBoxDepth2').hasClass('fixed') === true ) {
    // 	console.log('fixed');
    // 	$("html,body").animate({
    // 		scrollTop: $(hashA + "Target").offset().top - 5
    // 	});
    // } else {
    // 	$("html,body").animate({
    // 		scrollTop: $(hashA + "Target").offset().top - headerHeight
    // 	});
    // }
  }
}
