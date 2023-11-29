$(function(){
    // DROPDOWN

    $('.header-dropdown').on('click', function(){
        $('.header-dropdown').toggleClass('active')
    })

    // SLIDERS
    $('.header__slider').slick({
        slidesToShow: 1,
        arrows: false,
        dots: true,
        dotsClass: 'header-dots',
        initialSlide: 1,
    })

    $('.news__slider').slick({
        slidesToShow: 3,
        slidesToScroll: 1,
        initialSlide: 2,
        nextArrow: `<img class="slider__arrow" src="images/slider-next.png" alt="slider arrow">`,
        prevArrow: `<img class="slider__arrow" src="images/slider-prev.png" alt="slider arrow">`,
        responsive: [
            {
                breakpoint: 1001,
                settings: {
                    slidesToShow: 2,
                }
            },

            {
                breakpoint: 621,
                settings: {
                    slidesToShow: 1,
                    arrows: false,
                    autoplay: true,
                    autoplaySpeed: 3000,
                    speed: 1000,
                }
            }

        ]
    })

    $('.partner__slider').slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        nextArrow: `<img class="slider__arrow" src="images/slider-next.png" alt="slider arrow">`,
        prevArrow: `<img class="slider__arrow" src="images/slider-prev.png" alt="slider arrow">`,
        responsive: [
            {
                breakpoint: 481,
                settings: {
                    arrows: false,
                    autoplay: 3000,
                }
            }
        ]
    })

    // HEADER BTN

    $('.header-btn').on('click', function(){
        $('.sidebar').addClass('active')
    })

    $('.sidebar__close').on('click', function(){
        $('.sidebar').removeClass('active')
    })

    AOS.init();

});