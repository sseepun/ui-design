<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Fundametal</title>

    <link rel="stylesheet" href="../../extensions/slick-1.8.1/slick/slick.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900&display=swap">
    <link rel="stylesheet" href="css/style.css">
</head>
<body class="loading">

    <section class="menu-tab">
        <div class="menu-item">
            HOME
        </div>
        <div class="cover cover-left-menu cover-03"><div class="wrapper"></div></div>
        <div class="menu-item">
            ABOUT US
        </div>
        <div class="cover cover-right-menu cover-04"><div class="wrapper"></div></div>
        <div class="menu-item">
            OUR WORK
        </div>
        <div class="cover cover-left-menu cover-05"><div class="wrapper"></div></div>
        <div class="menu-item">
            CONTACT US
        </div>
        <div class="cover cover-right-menu cover-06"><div class="wrapper"></div></div>
        <div class="btn-back"><ion-icon name="arrow-forward"></ion-icon></div>
    </section>

    <section class="banner-01">
        <div class="container">
            <div class="slide-container">
                <div class="slides">
                    <?php for($i=1; $i<=8; $i++){?>
                        <div class="slide">
                            <div class="img-bg" style="background-image:url('assets/img/<?php echo sprintf('%02d', $i); ?>.jpg');"></div>
                            <div class="filter"></div>
                            <div class="text-container">
                                <div class="btn-next" style="--delay:1s;" data-img="assets/img/<?php echo sprintf('%02d', $i); ?>.jpg">
                                    Interior Innovations
                                </div>
                                <div class="btn-menu" style="--delay:1s;" data-img="assets/img/<?php echo sprintf('%02d', $i); ?>.jpg">
                                    Back to Menu
                                </div>
                            </div>
                        </div>
                    <?php }?>
                </div>
                <div class="dots"></div>
            </div>
        </div>
        
        <div class="footer">
            <div class="socials">
                <div href="#" target="_blank" class="social">
                    <i class="fab fa-facebook-square"></i>
                </div>
                <div href="#" target="_blank" class="social">
                    <i class="fab fa-dribbble-square"></i>
                </div>
                <div href="#" target="_blank" class="social">
                    <i class="fab fa-instagram"></i>
                </div>
                <div href="#" target="_blank" class="social">
                    <i class="fab fa-twitter-square"></i>
                </div>
            </div>
        </div>
    </section>
    
    <section class="info-01">
        <div class="container">
            <div class="infos">
                <div class="info-img">
                    <div class="bg-img" style="background-image:url('assets/img/01.jpg');"></div>
                </div>
                <div class="info">
                    <div class="text-container">
                        <h1 class="title">Interior Design</h1>
                        <p>
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor 
                            incididunt ut labore et dolore magna aliqua.
                        </p>
                        <p>
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor 
                            incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis 
                            nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. 
                            Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu 
                            fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident.
                        </p>
                    </div>
                </div>
            </div>
            <div class="btn-back"><ion-icon name="arrow-forward"></ion-icon></div>
        </div>
    </section>

    <div class="cover cover-left cover-01"><div class="wrapper"></div></div>
    <div class="cover cover-right cover-02"><div class="wrapper"></div></div>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/2.1.2/TweenMax.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lodash.js/4.17.15/lodash.min.js"></script>
    <script src="https://unpkg.com/ionicons@4.5.10-0/dist/ionicons.js"></script>
    <script src="../../extensions/slick-1.8.1/slick/slick.min.js"></script>
    <script src="js/utils.js"></script>
    <script>

        $(document).ready(function(){
            $('body').removeClass('loading');
        });

        var banner = $('.banner-01');

        banner.find('.slides').slick({
            infinite: false,
            slidesToShow: 1,
            slidesToScroll: 1,
            speed: 800,
            arrows: false,
            dots: true,
            appendDots: banner.find('.dots')
        });


        var timeline = new TimelineMax({paused: true})
            .fromTo('.banner-01 .text-container', .8,
                {top: 0, opacity: 1, ease: Power1.easeInOut},
                {top: -80, opacity: 0, ease: Power1.easeInOut}
            )
            .fromTo('.banner-01', .8,
                {top: 0, opacity: 1, ease: Power3.easeInOut},
                {top: -100, opacity: 0, ease: Power3.easeInOut},
                '-=.6'
            )
            .fromTo('.info-01', .01, 
                {autoAlpha: 0},
                {autoAlpha: 1}
            )
            .fromTo('.cover-01', 1, 
                {css: {transform: 'translateY(0)'}, ease: Power2.easeInOut}, 
                {css: {transform: 'translateY(calc(-200vh - 40vw))'}, ease: Power2.easeInOut}, 
                '-=.6'
            )
            .fromTo('.cover-02', 1, 
                {css: {transform: 'translateY(0)'}, ease: Power2.easeInOut},
                {css: {transform: 'translateY(calc(-200vh - 40vw))'}, ease: Power2.easeInOut},
                '-=.9'
            )
            .from('.info-01 .info-img', .8, {top: 100, opacity: 0, ease: Power3.easeInOut}, '-=.9')
            .from('.info-01 .btn-back', .8, {top: 60, opacity: 0, ease: Power3.easeInOut}, '-=.7')
            .from('.info-01 .title', .8, 
                {css: {transform: 'translateY(60px)', opacity: 0}, ease: Power3.easeInOut}, '-=.7'
            )
            .staggerFrom('.info-01 p', .8, 
                {css: {transform: 'translateY(60px)', opacity: 0}, ease: Power3.easeInOut}, 
                .1, '-=.7'
            )
            .reverse();
        banner.find('.btn-next').click(function(e){
            e.preventDefault();
            $('.info-01 .info-img > .bg-img').css(
                'background-image', 'url('+$(this).data('img')+')'
            );
            timeline.reversed( false );
        });
        $('.info-01').find('.btn-back').click(function(e){
            e.preventDefault();
            timeline.reversed( true );
        });


        // Timeline menu tab
        var timelineMenu = new TimelineMax({paused: true})
            .fromTo('.banner-01 .text-container', .8,
                    {top: 0, opacity: 1, ease: Power1.easeInOut},
                    {top: -80, opacity: 0, ease: Power1.easeInOut}
                )
            .fromTo('.banner-01', .8,
                {top: 0, opacity: 1, ease: Power3.easeInOut},
                {top: -100, opacity: 0, ease: Power3.easeInOut},
                '-=.6'
            )
            .fromTo('.cover-03', 1, 
                {css: {transform: 'translateY(0)'}, ease: Power2.easeInOut}, 
                {css: {transform: 'translateY(calc(-200vh - 40vw))'}, ease: Power2.easeInOut}, 
                '-=.6'
            )
            .reverse();


        banner.find('.btn-menu').click(function(e){
        e.preventDefault();
        $('.menu-tab').css(
            'position', 'relative'
        );
        $('.menu-tab').css(
            'opacity', '1'
        );
        timelineMenu.reversed( false );

        });


        $('.menu-tab').find('.btn-back').click(function(e){
            e.preventDefault();
            $('.menu-tab').css(
                'position', 'fixed'
            );
            $('.menu-tab').css(
                'opacity', '0'
            );
            timelineMenu.reversed( true );
            
        });


    </script>
</body>
</html>
