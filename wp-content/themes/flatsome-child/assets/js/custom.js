var $ = jQuery.noConflict();

jQuery( document ).ready(function( $ ) {

document.addEventListener('wpcf7mailsent', function(event) {
var status = event.detail.apiResponse.status;
	if (status === 'mail_sent') {
		$('.mfp-close').trigger('click');
		$('.success a').trigger('click');
	} 
});	
/*--------------------------------------------------------------*/
document.addEventListener('wpcf7invalid', function(event) {
	$('.error__mess').addClass('visible-block');
	setTimeout(function() {
	$('.error__mess').removeClass('visible-block');
	}, 3000); 
});

$("a[href='#top']").on("click", function() {
	$("html, body").animate({scrollTop: 0}, "slow");
	return false;
});
/*----------------------------------------------------------------*/
$(".search").on("click", function (e) {
  e.stopPropagation(); 

  $(".search-bottom").toggleClass("active");
  $(this).toggleClass("active");
	$(".menu-block").removeClass("active");
  $(".link-category").removeClass("active");
});

$(".search-bottom").on("click", function (e) {
  e.stopPropagation();
});

$(document).on("click", function () {
  $(".search-bottom").removeClass("active");
  $(".search").removeClass("active");
});
/*-----------------------------------------------------------------*/
$(".link-category").on("click", function (m) {
  m.stopPropagation(); 

  $(".menu-block").toggleClass("active");
  $(this).toggleClass("active");
	$(".search-bottom").removeClass("active");
  $(".search").removeClass("active");
});

$(".menu-block").on("click", function (m) {
  m.stopPropagation();
});

$(document).on("click", function () {
  $(".menu-block").removeClass("active");
  $(".link-category").removeClass("active");
});
/*-----------------------------------------------------------------*/
/*
$(".link-category").on("click", function() {
	$(".menu-block").toggleClass("active");
	this.classList.toggle("active");
	//$("html").toggleClass("no-scroll");
});
/*
$(window).on("scroll", function() {
  $(".search-bottom").removeClass("active");
  $(".menu-block").removeClass("active");
  $(".link-category").removeClass("active");
});*/

window.addEventListener('scroll', function() {
var element = document.querySelector('.scroll-top');
	if (window.scrollY > 150) {
	element.classList.add('active');
	} else {
	element.classList.remove('active');
	}
});

$('.arrow__carousel .arrow__left').on('click', function(){     
	$('.slider').find('.previous').trigger('click');
})
$('.arrow__carousel .arrow__right').on('click', function(){     
	$('.slider').find('.next').trigger('click');
})


});
/*-----------------------------------------------------------------*/
document.addEventListener("DOMContentLoaded", function () {
	let circle = document.querySelector(".progress-ring__circle");
	if (!circle) {
			console.error(".progress-ring__circle не знайден!");
			return;
	}
	document.addEventListener("scroll", function () {
			let scrollTop = window.scrollY;
			let documentHeight = document.documentElement.scrollHeight - window.innerHeight;
			let scrollFraction = scrollTop / documentHeight;

			let circumference = 2 * Math.PI * 22; // 2πr
			let offset = circumference * (1 - scrollFraction); 

			circle.style.strokeDashoffset = offset;
	});

});
/*-----------------------------------------------------------------*/
  // Все блоки с products-swiper
  document.querySelectorAll('.products-swiper').forEach(function (swiperEl) {

    if (swiperEl.classList.contains('swiper-initialized')) return;

    new Swiper(swiperEl, {
      slidesPerView: 4,
      spaceBetween: 24,
      loop: false,
      pagination: {
        el: swiperEl.querySelector('.swiper-pagination'),
        clickable: true,
      },
      navigation: {
        nextEl: swiperEl.querySelector('.swiper-button-next'),
        prevEl: swiperEl.querySelector('.swiper-button-prev'),
      },
      breakpoints: {
        320: { slidesPerView: 1.2 },
        768: { slidesPerView: 2.2 },
        1024:{ slidesPerView: 4 }
      }
    });

  });

  // Все блоки с category-swiper
  document.querySelectorAll('.category-swiper').forEach(function (swiperEl) {

    if (swiperEl.classList.contains('swiper-initialized')) return;

    new Swiper(swiperEl, {
      slidesPerView: 2,
      spaceBetween: 24,
      loop: false,
      pagination: {
        el: swiperEl.querySelector('.swiper-pagination'),
        clickable: true,
      },
      navigation: {
        nextEl: swiperEl.querySelector('.swiper-button-next'),
        prevEl: swiperEl.querySelector('.swiper-button-prev'),
      },
      breakpoints: {
        320: { slidesPerView: 1.2 },
        768: { slidesPerView: 2.2 },
        1024:{ slidesPerView: 4 }
      }
    });

  });

// Dynex sort dropdown
document.addEventListener('DOMContentLoaded', function () {
    var btn = document.getElementById('dynexSortBtn');
    var dropdown = document.getElementById('dynexSortDropdown');
    if (!btn || !dropdown) return;

    btn.addEventListener('click', function (e) {
        e.stopPropagation();
        btn.classList.toggle('open');
        dropdown.classList.toggle('open');
    });

    document.addEventListener('click', function () {
        btn.classList.remove('open');
        dropdown.classList.remove('open');
    });
});



