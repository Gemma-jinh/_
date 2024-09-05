(function ($) {
function sub_nav(){
	var controller = new ScrollMagic.Controller();
	var tgt = $('section.sub_navigation');
	var tween1 = TweenLite.to( tgt, 1.5, { position: 'fixed', top:0 }, 0.5);
	var scene1 = new ScrollMagic.Scene({
		triggerElement: 'tgt',
		triggerHook: 'onEnter',
		offset: 500
	})
	.setTween(tween1)
	.addTo(controller);
}
function initPageIndex() {
	var controller = new ScrollMagic.Controller();
	var tween1 = TweenMax.staggerTo($('section.part .index_banner_wrap>ul>li'), 0.3, { css: {autoAlpha:1 }, ease: Power4.easeInOut }, 0.3 );
	var scene1 = new ScrollMagic.Scene({
		triggerElement: 'section.part',
		triggerHook: 'onEnter',
		offset: 200
	})
	.setTween(tween1)
	.addTo(controller);
}
function contribution(){
	var controller = new ScrollMagic.Controller();
	var tween1 = function(){
		var el = $('div.s_wrap figure');
		$.each(el, function(e){
			var _ = $(this);
			var delay = 500;
			setTimeout(function(){
				TweenLite.fromTo(_, 1.5, {autoAlpha:0}, { autoAlpha:1} );
			}, e * delay);
		})
	}
	var scene1 = new ScrollMagic.Scene({
		triggerElement: 'div.s_wrap',
		triggerHook: 'onEnter',
		offset: 200,
		reverse: false // once animating
	})
	.setTween(tween1)
	.addTo(controller);

}
function initFade() {
	var controller = new ScrollMagic.Controller();
    $('.fadeIn, .fadeUp, .fadeUp1, .fadeDown, .fadeLeft, .fadeRight').each(function (index, elem) {
        var $this = $(this);
        var zDuration = 0.8;
        var zEase = 'Power4.easeInOut';
        var yValue = 0, xValue = 0;
		var zDelay = 0;

        if ($this.hasClass('fadeIn')) {
            yValue = xValue = 0;
        } else if ($this.hasClass('fadeUp')) {
            yValue = 20;
        } else if ($this.hasClass('fadeUp1')) {
            yValue = 20;
			zDuration = 1.2;
        } else if ($this.hasClass('fadeDown')) {
            yValue = -20;
        } else if ($this.hasClass('fadeLeft')) {
            xValue = 20;
        } else if ($this.hasClass('fadeRight')) {
            xValue = -20;
        }

        if ($this.hasClass('slow')) {
            zDuration = 1.6;
            zEase = 'Power4.easeOut';
			var tween = TweenMax.staggerTo($('.slow'), 1, { css:{autoAlpha: 1}, delay:0.15 }, 0.6);
        }else{
			var tween = new TweenMax.fromTo( elem, zDuration, { css: { autoAlpha: 0, y: yValue, x: xValue } }, { css: { autoAlpha: 1, y: 0, x: 0 }, ease: zEase});
		}

        var scene = new ScrollMagic.Scene({
            triggerElement: this,
            triggerHook: 'onEnter',
            offset:100,
//			reverse: false // once animating
        })

        .setTween(tween)
        .addTo(controller)
    });
}
	$.fn.rotationInfo = function() {
        var el = $(this),
            tr = el.css("-webkit-transform") || el.css("-moz-transform") || el.css("-ms-transform") || el.css("-o-transform") || '',
            info = {rad: 0, deg: 0};
        if (tr == tr.match('matrix\\((.*)\\)')) {
            tr = tr[1].split(',');
            if(typeof tr[0] != 'undefined' && typeof tr[1] != 'undefined') {
                info.rad = Math.atan2(tr[1], tr[0]);
                info.deg = parseFloat((info.rad * 180 / Math.PI).toFixed(1));
            }
        }
        return info;
    };
	$(document).ready(function(){
		initFade();
		contribution();
//		sub_nav();
//		initPageIndex();
	});

})(jQuery);
