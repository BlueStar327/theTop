$(document).on('ready', function() {
    $('.cast_detail_slider').slick({
        dots: false,
        infinite: true,
        centerMode: true,
        centerPadding: '0px',
        speed: 800,
        slidesToShow: 3,
        slidesToScroll: 1,
        autoplay: true,
        pauseOnFocus: true,
        responsive: [
            {
                breakpoint: 1024,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 1,
                    infinite: true,
                    dots: true
                }
            },
            {
                breakpoint: 769,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1
                }
            }
        ]
    });
});