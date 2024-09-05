$(function(){
    
    // sub visual 선택되지 않을때
    var subVis = $('#contents').children('.sub-visual');
    if(subVis.length < 1) {
        //console.log('not');
        $('#contents').addClass('notSub');
        $('#header').addClass('dark');

    } else {
    // 상단비쥬얼
        var controller = new ScrollMagic.Controller();
            
        var scene1 = new ScrollMagic.Scene({
            triggerElement: ".sub-visual",
            triggerHook: 0,
            offset: 50,
        })
        .on('enter', function () {
            TweenMax.to($(window), 0.2, {
                scrollTo: $('#subWrap .section-01').offset().top
            });
        });
        
        var scene2 = new ScrollMagic.Scene({
            triggerElement: "#subWrap .section-01",
            triggerHook: 0,
            offset: -200,
        })
        .on('leave', function () {
            TweenMax.to($(window), 0.2, {
                scrollTo: 0          
            });
        });
        
        // add scene
        if (matchMedia("screen and (min-width: 1200px) and (min-height: 791px)").matches) {
            controller.addScene([
                scene1, // to #subWrap move
                scene2, // to top move
            ]);
        }
    }

    // 비교견적 팝업    
    $('.compare-popup-btn').on('click', function (e) {  
        e.preventDefault();
        $("#comparePopup").stop().fadeIn('slow').addClass('on');
    });

    // close
    $(".popup__wrap .popupClose").on('click', function () {
        $(".popup__wrap").stop().fadeOut('slow').removeClass('on');
    });

    // 파일업로드
	var fileTarget = $('.filebox .upload-hidden');

	fileTarget.on('change', function () {
		if (window.FileReader) { // modern browser
			var filename = $(this)[0].files[0].name;
		} else { // old IE
			var filename = $(this).val().split('/').pop().split('\\').pop();
		}

		// $(this).siblings('.upload-name').val(filename);
		$(this).parents('.filebox').find('.upload-name').val(filename);
	});

	
    // 개인정보보기
    $('.para--privacy button').on('click', function(){
        $('.privacy_box--fc').stop().slideToggle();
    });

    // 이메일 선택
    function formFunc() {

        if ($('.form-table--fc .email-form').length !== 0) {
            emailWrite();
        }

        // 이메일 선택
        function emailWrite() {
            $('#selEmail').on('change', function (e) {
                var currVal = $(this).val();
                var currIdx = $('#selEmail > option:selected').index();
                var emailAddr = $('.form-table--fc .email-form #email2');

                emailAddr.attr('disabled', true);
                emailAddr.val(currVal);

                if (currIdx === 0) {
                    emailAddr.attr('disabled', false);
                    emailAddr.val('');
                }
            });
        }
    }

    formFunc();

    //오시는길 map 리스트
    $('.acodi_menu > li h3').on('click', function(e){
        e.preventDefault();
        $(".acodi_menu").find(".acodi-tit").not(this).removeClass("on").next().slideUp(300);
        $(this).addClass("on").next().slideToggle(300,function(){
            if($(this).css("display") == "none" ){
                $(this).prev().removeClass("on");
            }
        });
        var i = $(this).parent('li').index();
        $('.acodi_map > li').hide();
        $('.acodi_map > li').eq(i).fadeIn(200);
    });


    // 연혁
    var historySlider = $('.history-slider .history_wrap1--fc');  	
    historySlider.off().on('init', function (event, slick) {
        AOS.init({
            duration: 800,
            disable: window.innerWidth < 768
            //once: true,
        });

        // let's do this after we init the banner slider
        var _slider = $('.history-slider');
        _slider.find(".paging_active").text('1');
        _slider.find(".paging_total").text(slick.slideCount);
       //$('.history-slider .history_wrap1--fc .slick-current').prev().addClass('hide');
    })
    .on('beforeChange', function (event, slick, currentSlide, nextSlide) {
        var el = $(slick.$slides[currentSlide]);
        el.closest(".history-slider").find(".paging_active").text(nextSlide+1);
        //$('.history-slider .history_wrap1--fc .slick-current').prev().addClass('hide');
    })
    .on('afterChange', function (event, slick, currentSlide, nextSlide) {
        //$('.history-slider .history_wrap1--fc .slick-current').prev().addClass('hide');
    })
    .slick({
        infinite: false, 		
        slidesToShow: 2, 		
        slidesToScroll: 1, 
        speed: 500,
        autoplay: false,
        autoplaySpeed: 3000, // css animation-duration: 3s; //동일적용
        //centerMode: true,
        //centerPadding: '20%',		
        dots:false, 		
        arrows:true,
        
        cssEase: 'linear',
        prevArrow: $('.history-slider__paging .prev-arrow'),
        nextArrow: $('.history-slider__paging .next-arrow'),
        responsive: [
            {
              breakpoint: 767,
              settings: {
                slidesToShow: 1,
                // observer: true,
                // observeParents: true,
                adaptiveHeight: true,
              }
            }
        ]
    });


    var controller = new ScrollMagic.Controller();
	$(".sub-cont-section").each(function () {

		var scene1 = new ScrollMagic.Scene({
			triggerElement: this,
			triggerHook: 0.7,
			offset: '-10%',
            
			reverse: true, // once animating
		})
            .setClassToggle(this, 'active')
			//.setTween(tween1)
            //.addIndicators()
			.addTo(controller);

	}); 

	/*
	var controller = new ScrollMagic.Controller();
	$("#contents").each(function() {
  
	  var contentTweenTL = new TimelineMax({
		repeat:0,
	  });
	  
	  var contentTween = contentTweenTL.from($(this).find(".sub-visual h2"), 0.6, {
		y: 30,
		autoAlpha: 0,
		delay: 0,
		ease: Power2.easeOut
	  }, 0.3)
	  .from($(this).find(".sub-visual  p"), 0.6, {
		y: 30,
		autoAlpha: 0,
		delay: 0.3,
		ease: Power2.easeOut
	  }, 0.3)
	  .from($(this).find(".sub-conts-title"), 0.6, {
		y: 30,
		autoAlpha: 0,
		delay: 0.6,
		ease: Power2.easeOut
	  }, 0.3)
		;

	var scene1 = new ScrollMagic.Scene({
			triggerElement: this,
			offset: -100,
			reverse:true
		})
		.setTween(contentTween)
		.addTo(controller)
		;
	});
	*/
	
	// 서브페이지 scroll section menu
    /*
    $(document).ready(function () {
        if ($('.sub-wrap-conts').children('.scroll-section').length >= 1) {
            $(document).on('click', '.category_list--fc > li > a', function (event) {
				
				//console.log(scrollPosition);
                var scrollPosition = $($(this).attr("data-target"));
                //var headerHeight = $('#header').outerHeight();
                var subVisHeight = $('.sub-visual').outerHeight();
                event.preventDefault();
                $("html,body").animate({
                    scrollTop: $(scrollPosition).offset().top - subVisHeight
                }, 300)
                return false;
				
				
            });
        }
    });
*/
	
	$(window).scroll(function () {        
        var scrollDistance = $(window).scrollTop();
		var subVisHeight = $('.sub-visual').outerHeight();

        // Assign active class to nav links while scolling
        $('.scroll-section').each(function (i) {
			
			// console.log(scrollDistance);
			//console.log(subVisHeight);
			//console.log(i);
//			console.log($("#greetingsTarget").position().top);

            if (matchMedia("(max-width: 767px)").matches) {
                if ($(this).position().top <= scrollDistance - subVisHeight + 60) {
                    $('.category_list--fc.depth2 li.on').removeClass('on');
                    $('.category_list--fc.depth2 li').eq(i).addClass('on');
                }

            } else {
                if ($(this).position().top <= scrollDistance - subVisHeight + 10) {
                    $('.category_list--fc.depth2 li.on').removeClass('on');
                    $('.category_list--fc.depth2 li').eq(i).addClass('on');
                }
            }
        });

    }).scroll();
	
	 // 탭 스크롤 fixed
    function tabScrollFixed() { 
        $(window).scroll(function () {
            if ($(window).scrollTop() >= 200) {  
                $('#cateBoxDepth2').fadeIn(300).addClass('fixed');
                
            } else {
                $('#cateBoxDepth2').fadeOut(300).removeClass('fixed');
            }

        });
    }
    
    $(document).ready(function () {
        tabScrollFixed();
    });
	
	$("#btnCateBox").on('click', function (e) {
		e.preventDefault();       
		$("#cateBoxDepth2").animate({"right":-100+"%","opacity":0},300);
	});
	
    AOS.init({
		duration: 800,
		//once: true,
		offset: 120,
		delay: 100,
        disable: window.innerWidth < 768
	});
});
