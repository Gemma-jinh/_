$(function () {
  // 상단비쥬얼
  var controller = new ScrollMagic.Controller();

  var scene1 = new ScrollMagic.Scene({
    triggerElement: ".main_visual",
    triggerHook: 0,
    offset: 50,
  }).on("enter", function () {
    TweenMax.to($(window), 0.2, {
      scrollTo: $("#mainSec01").offset().top,
    });
  });

  var scene2 = new ScrollMagic.Scene({
    triggerElement: "#mainSec01",
    triggerHook: 0,
    offset: -200,
  }).on("leave", function () {
    TweenMax.to($(window), 0.2, {
      scrollTo: 0,
      // scrollTo: $('.main_visual').offset().top
    });
  });

  function initYoutubePopup() {
    var popup = document.getElementById("youtubePopup");
    var closeBtn = document.querySelector(".close");
    var checkbox = document.getElementById("noPopupToday");

    function openPopup() {
      if (!getCookie("noPopupToday") && popup) {
        popup.style.display = "flex"; // 팝업이 중앙에 나타나도록 display: flex 사용
      }
    }

    function closePopup() {
      if (popup) {
        popup.style.display = "none";
        stopVideo();

        if (checkbox && checkbox.checked) {
          setCookie("noPopupToday", "true", 1);
        }
      }
    }

    function stopVideo() {
      var iframe = document.getElementById("youtubeVideo");
      if (iframe) {
        iframe.src = iframe.src;
      }
    }

    if (closeBtn) {
      closeBtn.addEventListener("click", closePopup);
    }

    if (popup) {
      popup.addEventListener("click", function (event) {
        if (event.target === popup) {
          closePopup();
        }
      });
    }

    // 쿠키 설정 함수
    function setCookie(name, value, days) {
      var expires = "";
      if (days) {
        var date = new Date();
        date.setTime(date.getTime() + days * 24 * 60 * 60 * 1000);
        expires = "; expires=" + date.toUTCString();
      }
      document.cookie = name + "=" + (value || "") + expires + "; path=/";
    }

    // 쿠키 가져오기 함수
    function getCookie(name) {
      var nameEQ = name + "=";
      var ca = document.cookie.split(";");
      for (var i = 0; i < ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) == " ") c = c.substring(1, c.length);
        if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length, c.length);
      }
      return null;
    }

    openPopup();
  }

  if (document.readyState === "loading") {
    document.addEventListener("DOMContentLoaded", initYoutubePopup);
  } else {
    initYoutubePopup();
  }
  // add scene
  if (
    matchMedia("screen and (min-width: 1200px) and (min-height: 791px)").matches
  ) {
    controller.addScene([
      scene1, // to #mainSec01 move
      scene2, // to top move
    ]);
  }

  var newsSlider = $(".main-borard-latest .gallery-latest--fc").slick({
    dots: false,
    infinite: true,
    arrows: true,
    centerMode: true,
    centerPadding: "10%",
    slidesToShow: 3,
    responsive: [
      {
        breakpoint: 768,
        settings: {
          slidesToShow: 2,
        },
      },
      {
        breakpoint: 575,
        settings: {
          slidesToShow: 1,
        },
      },
    ],
  });

  newsSlider.off().on("init", function (event, slick) {
    AOS.init({
      duration: 800,
      offset: 0,
      disable: window.innerWidth < 768,
      //once: true,
    });
  });

  AOS.init({
    duration: 800,
    //once: true,
    offset: 120,
    // delay: 100
  });
});
