<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Interior Innovations</title>
    <link rel="stylesheet" href="../../extensions/slick-1.8.1/slick/slick.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900&display=swap">
    <link rel="stylesheet" href="css/style.css">
</head>
<body class="loading">
    <nav class="sidenav">
        <div class="container">
            <div class="hamburger sidenav-toggle">
                <div></div><div></div>
            </div>
        </div>
        <div class="menu-wrapper">
            <div class="menu-container">
                <div class="menu"><div data-slide="1">Living</div></div>
                <div class="menu"><div data-slide="2">Dining</div></div>
                <div class="menu"><div data-slide="3">Working</div></div>
                <div class="menu"><div data-slide="4">Kitchen</div></div>
                <div class="menu"><div data-slide="5">Bathroom</div></div>
            </div>
        </div>
    </nav>

    <section class="banner-01">
        <div class="topnav">
            <div class="container">
                <div class="logo"><div>INTERIOR</div></div>
                <div class="menu-container">
                    <div class="menu">
                        <div>home</div>
                    </div>
                    <div class="menu">
                        <div>our philosophy</div>
                    </div>
                    <div class="menu">
                        <div>high class design</div>
                    </div>
                    <div class="menu">
                        <div>about us</div>
                    </div>
                    <div class="menu">
                        <div>contact us</div>
                    </div>
                    <div class="hamburger sidenav-toggle">
                        <div></div><div></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container">
            <div class="slide-container">
                <div class="slides">
                    <?php foreach([15, 19, 18, 12, 17, 6, 10, 11, 13, 14, 1] as $i){?>
                        <div class="slide">
                            <div class="img-bg" style="background-image:url('assets/img/<?php echo sprintf('%02d', $i); ?>.jpg');"></div>
                            <div class="filter"></div>
                            <div class="text-container">
                                <h1 class="animate" style="--delay:1.15s;">
                                    Interior Innovations
                                </h1>
                                <div class="animate btn-next" style="--delay:1.4s;" data-img="assets/img/<?php echo sprintf('%02d', $i); ?>.jpg">
                                    enter
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
                        <h1 class="title">Luxury Design</h1>
                        <div class="scroll-wrapper">
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
                            <div class="gallery">
                                <?php foreach([15, 12, 6] as $i){?>
                                    <div class="img">
                                        <div class="bg-img" style="background-image:url('assets/img/<?php echo sprintf('%02d', $i); ?>.jpg');"></div>
                                    </div>
                                <?php }?>
                            </div>
                            <p>
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor 
                                incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis 
                                nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. 
                                Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu 
                                fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident.
                            </p>
                            <p>
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor 
                                incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis 
                                nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. 
                                Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu 
                                fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident.
                            </p>
                            <div class="gallery">
                                <?php foreach([14, 17, 1] as $i){?>
                                    <div class="img">
                                        <div class="bg-img" style="background-image:url('assets/img/<?php echo sprintf('%02d', $i); ?>.jpg');"></div>
                                    </div>
                                <?php }?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="btn-back">
                <div class="hamburger active">
                    <div></div><div></div>
                </div>
            </div>
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
        var banner = $('.banner-01');

        // Welcome
        var welcomeTl = new TimelineMax({paused: true})
            .from('.topnav .logo', 1, 
                {css: {transform: 'translateY(-100px)', opacity: 0}, ease: Power2.easeInOut}
            )
            .staggerFrom('.topnav .menu-container > *', 1, 
                {css: {transform: 'translateY(-100px)', opacity: 0}, ease: Power2.easeInOut},
                .08, '-=.92'
            )
            .staggerFrom('.footer .social', 1, 
                {css: {transform: 'translateY(100px)', opacity: 0}, ease: Power2.easeInOut},
                .08, '-=.8'
            )
            .from('.banner-01 .dots', 1, 
                {css: {transform: 'translateY(100px)', opacity: 0}, ease: Power2.easeInOut}, '-=.68'
            );

        $(document).ready(function(){
            $('body').removeClass('loading');
            setTimeout(function(){
                welcomeTl.play();
            }, 1250);
        });


        // Presentation
        var slickBanner = banner.find('.slides').slick({
            infinite: false, slidesToShow: 1, slidesToScroll: 1,
            arrows: false, dots: true, appendDots: banner.find('.dots'),
            autoplay: false, autoplaySpeed: 4500, speed: 1000,
            pauseOnFocus: false, pauseOnHover: false
        });

        // Detail Toggle
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
            .staggerFrom('.info-01 .info p, .info-01 .info .gallery > .img', .8, 
                {css: {transform: 'translateY(60px)', opacity: 0}, ease: Power3.easeInOut}, 
                .08, '-=.7'
            )
            .reverse();
        banner.find('.btn-next').click(function(e){
            e.preventDefault();
            $('.info-01 .info-img > .bg-img').css(
                'background-image', 'url('+$(this).data('img')+')'
            );
            $('.info-01 .info .scroll-wrapper').scrollTop(0);
            timeline.reversed( false );
        });
        $('.info-01').find('.btn-back').click(function(e){
            e.preventDefault();
            timeline.reversed( true );
        });

        // Sidenav
        var hamburgers = $('.hamburger.sidenav-toggle');
        var sidenavTl = new TimelineMax({paused: true})
            .to('.banner-01 .slides', .8, {
                css: {transform: 'scale(.75)', opacity: .4}, ease: Power3.easeInOut
            })
            .staggerTo('.banner-01 .topnav .menu', .8, {
                opacity: 0, ease: Power3.easeInOut
            }, .08, '-=.8')
            .from('nav.sidenav', .8, {
                autoAlpha: 0, width: 0, ease: Power3.easeInOut
            }, '-=.8')
            .staggerFrom('nav.sidenav .menu', .8, {
                opacity: 0, ease: Power3.easeInOut
            }, .08, '-=.55')
            .reverse();
        hamburgers.click(function(e){
            e.preventDefault();
            hamburgers.toggleClass('active');
            sidenavTl.reversed( !sidenavTl.reversed() );
        });
        $('.sidenav .menu').click(function(e){
            e.preventDefault();
            hamburgers.removeClass('active');
            sidenavTl.reversed(true);
            let slideIndex = Number($(this).find('> *:first-child').data('slide'));
            setTimeout(function(){
                slickBanner.slick('slickGoTo', slideIndex);
            }, 300);
        });

    </script>
</body>
</html>
