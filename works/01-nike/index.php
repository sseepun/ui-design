<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Nike Shoes</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Oswald&display=swap">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/navbar.css">
</head>
<body>
    <nav class="topnav">
        <div class="logo">NIKE</div>
        <div class="hamburger">
            <div></div><div></div><div></div>
        </div>
    </nav>
    <nav class="sidenav">
        <div class="wrapper">
            <div class="top-container">
                <div class="logo">NIKE</div>
                <div class="hamburger">
                    <div></div><div></div><div></div>
                </div>
            </div>

            <div class="menu-wrapper">
                <div class="menus">
                    <div class="menu">
                        <span>LIMITED COLLECTIONS</span>
                    </div>
                    <div class="menu">
                        <span>NIKE SPORT SHOES</span>
                    </div>
                    <div class="menu">
                        <span>MEN'S SHOES</span>
                    </div>
                    <div class="menu">
                        <span>WOMEN'S SHOES</span>
                    </div>
                    <div class="menu">
                        <span>CONTACT US</span>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <nav class="footer">
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

        <div class="options">
            <div class="toggle-wireframe"></div>
            <ul id="menu">
                <li><div href="1" class="active"></div></li>
                <li><div href="2"></div></li>
                <li><div href="3"></div></li>
                <li><div href="4"></div></li>
                <li><div href="5"></div></li>
            </ul>
        </div>
    </nav>

    <div id="loader">
        <div class="text-container">
            <div class="text">JUST DO IT</div>
        </div>
    </div>
    <div id="shoe-canvas"></div>
    
    <div class="slides">
        <div class="slide">
            <div class="wrapper">
            </div>
        </div>

        <div class="slide">
            <div class="wrapper">
                <div class="text-container">
                    <div class="text-wrapper">
                        <h5 class="animate" style="--delay:.1s;">
                            <div>MEN'S SPORT SHOES</div>
                        </h5>
                        <h1 class="animate" style="--delay:.4s;">
                            <div>NIKE SPORT SHOES</div>
                        </h1>
                        <h3 class="animate" style="--delay:.7s;">
                            <div>$80</div>
                        </h3>
                        <div class="desc animate2" style="--delay:1s;">
                            <div>
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor 
                                incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud 
                                exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute 
                                irure dolor in reprehenderit.
                            </div>
                        </div>
                        <div class="btns animate3" style="--delay:1.3s;">
                            <div class="btn">LEARN MORE</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="slide">
            <div class="wrapper">
                <div class="text-container">
                    <div class="text-wrapper">
                        <h5 class="animate" style="--delay:.1s;">
                            <div>MEN'S SPORT SHOES</div>
                        </h5>
                        <h1 class="animate" style="--delay:.4s;">
                            <div>NIKE SPORT SHOES</div>
                        </h1>
                        <h3 class="animate" style="--delay:.7s;">
                            <div>$80</div>
                        </h3>
                        <div class="desc animate2" style="--delay:1s;">
                            <div>
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor 
                                incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud 
                                exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute 
                                irure dolor in reprehenderit.
                            </div>
                        </div>
                        <div class="btns animate3" style="--delay:1.3s;">
                            <div class="btn">LEARN MORE</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="slide">
            <div class="wrapper">
                
            </div>
        </div>

        <div class="slide">
            <div class="wrapper">
                
            </div>
        </div>
    </div>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/2.1.2/TweenMax.min.js"></script>
    <script src="js/utils.js"></script>
    <script type="module">
        import * as THREE from '../../extensions/three/build/three.module.js';
        import { OrbitControls } from '../../extensions/three/examples/jsm/controls/OrbitControls.js';
        import { GLTFLoader } from '../../extensions/three/examples/jsm/loaders/GLTFLoader.js';
        import { RGBELoader } from '../../extensions/three/examples/jsm/loaders/RGBELoader.js';
        import { EquirectangularToCubeGenerator } from '../../extensions/three/examples/jsm/loaders/EquirectangularToCubeGenerator.js';
        import { PMREMGenerator } from '../../extensions/three/examples/jsm/pmrem/PMREMGenerator.js';
        import { PMREMCubeUVPacker } from '../../extensions/three/examples/jsm/pmrem/PMREMCubeUVPacker.js';

        var container, stats, controls;
        var camera, scene, renderer;
        var object;

        var fps = 0, scrollReady = false, currentSlide = 1;
        var bgColors = ['#edf0f6', '#edf0f6', '#edf0f6', '#edf0f6', '#101010'];

        init();
        function init(){
            container = document.querySelector('div#shoe-canvas');

            camera = new THREE.PerspectiveCamera(60, window.innerWidth / window.innerHeight, 0.001, 1000);
            camera.position.set(0, 0, 75);
            camera.rotation.set(0, 0, radians2(15));

            scene = new THREE.Scene();
            
            // Loader manager
            var manager = new THREE.LoadingManager();
            manager.onProgress = function(url, itemsLoaded, itemsTotal){
                console.log('GLTF loaded - '+Math.round(itemsLoaded / itemsTotal * 100)+'%');
            };
            manager.onStart = function(url, itemsLoaded, itemsTotal){ console.log('GLTF - Start loading'); };
            manager.onLoad = function(){ console.log('GLTF - Loading complete!'); };
            manager.onError = function(url){ console.log('GLTF - Error loading '+url); };

            new RGBELoader().setDataType(THREE.UnsignedByteType).setPath('assets/hdr/')
                .load('colorful_studio_1k.hdr', function(hdr){
                    var cubeGenerator = new EquirectangularToCubeGenerator(hdr, {resolution: 1024});
                    cubeGenerator.update(renderer);

                    var pmremGenerator = new PMREMGenerator(cubeGenerator.renderTarget.texture);
                    pmremGenerator.update(renderer);

                    var pmremCubeUVPacker = new PMREMCubeUVPacker(pmremGenerator.cubeLods);
                    pmremCubeUVPacker.update(renderer);

                    var envMap = pmremCubeUVPacker.CubeUVRenderTarget.texture;

                    // Load GLTF model
                    var loader = new GLTFLoader(manager).setPath('assets/nike/black/');
                    loader.load('model.gltf', function(gltf){
                        gltf.scene.traverse(function(child){
                            if(child.isMesh){
                                child.material.side = THREE.DoubleSide;
                                child.material.envMap = envMap;
                                child.material.wireframeLinewidth = 0.1;
                            }
                        });

                        object = gltf.scene.children[0];
                        scene.add(gltf.scene);
                        
                        object.position.set(0.03, 0, 0);
                        object.rotation.set(0, radians2(-720), 0);
                        
                        pageInit();
                    });

                    pmremGenerator.dispose();
                    pmremCubeUVPacker.dispose();

                    // scene.background = cubeGenerator.renderTarget;
                    // scene.background = new THREE.Color(0xFFFFFF);
                });

            renderer = new THREE.WebGLRenderer({antialias: true, alpha: true});
            renderer.setClearColor(0x000000, 0);
            renderer.setPixelRatio(window.devicePixelRatio);
            renderer.setSize(window.innerWidth, window.innerHeight);
            renderer.gammaOutput = true;
            
            container.appendChild(renderer.domElement);

            window.addEventListener('resize', onWindowResize, false);
        }
        function onWindowResize(){
            if(scrollReady){
                scrollReady = false;
                pageUpdate($('#menu li > *.active').attr('href'));
            }
            camera.aspect = window.innerWidth / window.innerHeight;
            camera.updateProjectionMatrix();
            renderer.setSize(window.innerWidth, window.innerHeight);
        }
        function animate(){
            if(fps>0){
                scrollReady = false;
                setTimeout(function(){
                    requestAnimationFrame(animate);
                }, 1000/fps);
            }else scrollReady = true;
            renderer.render(scene, camera);
        }


        var body = $('body'),
            topnav = $('nav.topnav'),
            footer = $('nav.footer'),
            loader = $('#loader');

        var slides = $('.slides > .slide'),
            menus = $('#menu li > *');
        menus.click(function(e){
            e.preventDefault();
            if(scrollReady){
                scrollReady = false;
                let self = $(this),
                    nextSlide = Number(self.attr('href'));
                if(nextSlide!=currentSlide){
                    pageAnimation(nextSlide, currentSlide > nextSlide);
                    currentSlide = nextSlide;
                }else scrollReady = true;
            }
        });

        body.bind('mousewheel', function(e){
            if(scrollReady){
                scrollReady = false;
                if(e.originalEvent.wheelDelta/120 > 0){
                    let nextSlide = Math.max(1, currentSlide - 1);
                    if(nextSlide!=currentSlide){
                        scrollReady = false;
                        currentSlide = nextSlide;
                        pageAnimation(currentSlide, true);
                    }else scrollReady = true;
                }else{
                    let nextSlide = Math.min(5, currentSlide + 1);
                    if(nextSlide!=currentSlide){
                        scrollReady = false;
                        currentSlide = nextSlide;
                        pageAnimation(currentSlide);
                    }else scrollReady = true;
                }
            }
        });


        var hamburgers = $('.hamburger');
        var sidenavTl = new TimelineMax({paused: true})
            .to('nav.sidenav', .6, {
                css: {width: '100vw'}, ease: Power2.easeInOut
            })
            .from('nav.sidenav > .wrapper', .6, {
                css: {left: '-100vw'}, ease: Power2.easeInOut
            }, '-=.8s')
            .staggerFrom('nav.sidenav .menu', .8, {
                y: 120, opacity: 0, ease: Power3.easeInOut
            }, .1, '-=.3s')
            .reverse();
        hamburgers.click(function(e){
            e.preventDefault();
            hamburgers.toggleClass('active');
            sidenavTl.reversed(!sidenavTl.reversed());
        });


        $('.toggle-wireframe').click(function(){
            if(scrollReady){
                scrollReady = false;
                fps = 90; animate();

                if($(this).hasClass('active')){
                    $(this).removeClass('active');
                    object.children[0].children[0].material.wireframe = false;
                }else{
                    $(this).addClass('active');
                    object.children[0].children[0].material.wireframe = true;
                }

                setTimeout(function(){ fps = 0; }, 300);
            }
        });
        
        function pageInit(){
            new TimelineMax()
                .to('#loader .text', 1.2, {
                    css: {'background-size': '100% 100%'}, ease: Power2.easeOut,
                    onComplete: function(){
                        pageAnimation();
                    }
                });
            setTimeout(function(){
                new TimelineMax()
                    .to('nav.topnav', .01, {opacity: 1})
                    .staggerFrom('nav.topnav > *', 1, {
                        y: -160, opacity: 0, ease: Power2.easeInOut
                    }, .12);
                new TimelineMax().delay(.24)
                    .to('nav.footer', .01, {opacity: .2})
                    .staggerFrom('nav.footer > *', 1, {
                        y: 160, opacity: 0, ease: Power2.easeInOut
                    }, .12);
            }, 2500);
        }
        function pageAnimation(slide=1, back=false){
            if(object!==undefined){
                pageSlide(slide);
                fps = 90; animate();
                if(slide==1){
                    let t = back? 0.8: 1.5,
                        zoom = (window.innerWidth<1199.98)? 0.82: 0.7;
                    if(window.innerWidth<991.98){ zoom = 1.53; }
                    body.css({'background': bgColors[slide-1]});
                    topnav.removeClass('white');
                    footer.removeClass('white');
                    loader.css('opacity', .55);
                    new TimelineMax()
                        .to(camera.position, t, {
                            x: 0, y: 0, z: zoom, ease: Power3.easeOut
                        })
                        .to(camera.rotation, t, {
                            x: radians2(0, camera.rotation.x), y: radians2(0, camera.rotation.y), 
                            z: radians2(15, camera.rotation.z), ease: Power3.easeOut
                        }, '-='+t+'s')
                        .to(object.position, t, {
                            x: 0.045, y: 0.03, z: 0, ease: Power1.easeOut
                        }, '-='+t+'s')
                        .to(object.rotation, t, {
                            x: radians2(0, object.rotation.x), y: radians2(-90), 
                            z: radians2(0, object.rotation.z), ease: Power1.easeOut,
                            onComplete: function(){
                                fps = 0; slides.eq(slide-1).addClass('active');
                            }
                        }, '-='+t+'s');
                }else if(slide==2){
                    let t = back? 0.7: 0.9,
                        x = (window.innerWidth<1199.98)? -0.25: -0.34,
                        z = (window.innerWidth<1199.98)? radians2(20, object.rotation.z): radians2(24, object.rotation.z),
                        zoom = 0.77;
                    if(window.innerWidth<991.98){ x = -0.26; z = radians2(8, object.rotation.z); zoom = 1.65; }
                    body.css({'background': bgColors[slide-1]});
                    topnav.removeClass('white');
                    footer.removeClass('white');
                    loader.css('opacity', .12);
                    new TimelineMax()
                        .to(camera.position, t, {
                            x: 0, y: 0, z: zoom, ease: Power3.easeOut
                        })
                        .to(camera.rotation, t, {
                            x: radians2(0, camera.rotation.x), y: radians2(0, camera.rotation.y), 
                            z: radians2(0, camera.rotation.z), ease: Power3.easeOut
                        }, '-='+t+'s')
                        .to(object.position, t, {
                            x: x, y: -0.03, z: 0.05, ease: Power3.easeOut
                        }, '-='+t+'s')
                        .to(object.rotation, t, {
                            x: radians2(90, object.rotation.x), y: radians2(-180, object.rotation.y), 
                            z: z, ease: Power3.easeOut,
                            onComplete: function(){
                                fps = 0; slides.eq(slide-1).addClass('active');
                            }
                        }, '-='+t+'s');
                }else if(slide==3){
                    let t = back? 0.7: 0.9,
                        x = (window.innerWidth<1199.98)? -0.28: -0.42,
                        z = (window.innerWidth<1199.98)? radians2(190, object.rotation.z): radians2(205, object.rotation.z),
                        zoom = 0.92;
                    if(window.innerWidth<991.98){ x = -0.29; z = radians2(180, object.rotation.z); zoom = 1.92; }
                    body.css({'background': bgColors[slide-1]});
                    topnav.removeClass('white');
                    footer.removeClass('white');
                    loader.css('opacity', .12);
                    new TimelineMax()
                        .to(camera.position, t, {
                            x: 0, y: 0, z: zoom, ease: Power3.easeOut
                        })
                        .to(camera.rotation, t, {
                            x: radians2(0, camera.rotation.x), y: radians2(0, camera.rotation.y), 
                            z: radians2(0, camera.rotation.z), ease: Power3.easeOut
                        }, '-='+t+'s')
                        .to(object.position, t, {
                            x: x, y: -0.01, z: 0.05, ease: Power3.easeOut
                        }, '-='+t+'s')
                        .to(object.rotation, t, {
                            x: radians2(90, object.rotation.x), y: radians2(-180, object.rotation.y), 
                            z: z, ease: Power3.easeOut,
                            onComplete: function(){
                                fps = 0; slides.eq(slide-1).addClass('active');
                            }
                        }, '-='+t+'s');
                }else if(slide==4){
                    let t = back? 0.7: 0.9,
                        zoom = (window.innerWidth<1199.98)? 0.62: 0.5;
                    if(window.innerWidth<991.98){ zoom = 1.45; }
                    body.css({'background': bgColors[slide-1]});
                    topnav.removeClass('white');
                    footer.removeClass('white');
                    loader.css('opacity', .75);
                    new TimelineMax()
                        .to(camera.position, t, {
                            x: 0.02, y: -0.02, z: zoom, ease: Power3.easeOut
                        })
                        .to(camera.rotation, t, {
                            x: radians2(0, camera.rotation.x), y: radians2(0, camera.rotation.y), 
                            z: radians2(-15, camera.rotation.z), ease: Power3.easeOut
                        }, '-='+t+'s')
                        .to(object.position, t, {
                            x: 0, y: 0, z: 0, ease: Power3.easeOut
                        }, '-='+t+'s')
                        .to(object.rotation, t, {
                            x: radians2(40, object.rotation.x), y: radians2(-270, object.rotation.y), 
                            z: radians2(360, object.rotation.z), ease: Power3.easeOut,
                            onComplete: function(){
                                fps = 0; slides.eq(slide-1).addClass('active');
                            }
                        }, '-='+t+'s');
                }else if(slide==5){
                    let t = back? 0.7: 1.2,
                        zoom = (window.innerWidth<1199.98)? 1: 0.9;
                    if(window.innerWidth<991.98){ zoom = 1.84; }
                    body.css({'background': bgColors[slide-1]});
                    topnav.addClass('white');
                    footer.addClass('white');
                    loader.css('opacity', .07);
                    new TimelineMax()
                        .to(camera.position, t, {
                            x: 0, y: 0, z: zoom, ease: Power3.easeOut
                        })
                        .to(camera.rotation, t, {
                            x: radians2(0, camera.rotation.x), y: radians2(0, camera.rotation.y), 
                            z: radians2(0, camera.rotation.z), ease: Power3.easeOut
                        }, '-='+t+'s')
                        .to(object.position, t, {
                            x: 0, y: 0, z: 0, ease: Power3.easeOut
                        }, '-='+t+'s')
                        .to(object.rotation, t, {
                            x: radians2(0, object.rotation.x), y: radians2(-270, object.rotation.y), 
                            z: radians2(360, object.rotation.z), ease: Power3.easeOut,
                            onComplete: function(){
                                fps = 0; slides.eq(slide-1).addClass('active');
                            }
                        }, '-='+t+'s')
                }
            }
        }
        function pageUpdate(slide=1){
            if(object!==undefined){
                fps = 90; animate();
                if(slide==1){
                    let zoom = (window.innerWidth<1199.98)? 0.82: 0.7;
                    if(window.innerWidth<991.98){ zoom = 1.53; }
                    
                    camera.position.set(0, 0, zoom);
                    camera.rotation.set(
                        radians2(0, camera.rotation.x),
                        radians2(0, camera.rotation.y),
                        radians2(15, camera.rotation.z)
                    );
                    object.position.set(0.045, 0.03, 0);
                    object.rotation.set(
                        radians2(0, object.rotation.x),
                        radians2(-90),
                        radians2(0, object.rotation.z)
                    );
                    setTimeout(function(){ fps = 0; }, 400);
                }else if(slide==2){
                    let x = (window.innerWidth<1199.98)? -0.25: -0.34,
                        z = (window.innerWidth<1199.98)? radians2(20, object.rotation.z): radians2(24, object.rotation.z),
                        zoom = 0.77;
                    if(window.innerWidth<991.98){ x = -0.26; z = radians2(8, object.rotation.z); zoom = 1.65; }
                    
                    camera.position.set(0, 0, zoom);
                    camera.rotation.set(
                        radians2(0, camera.rotation.x),
                        radians2(0, camera.rotation.y),
                        radians2(0, camera.rotation.z)
                    );
                    object.position.set(x, -0.03, 0.05);
                    object.rotation.set(
                        radians2(90, object.rotation.x),
                        radians2(-180, object.rotation.y),
                        z
                    );
                    setTimeout(function(){ fps = 0; }, 400);
                }else if(slide==3){
                    let x = (window.innerWidth<1199.98)? -0.28: -0.42,
                        z = (window.innerWidth<1199.98)? radians2(190, object.rotation.z): radians2(205, object.rotation.z),
                        zoom = 0.92;
                    if(window.innerWidth<991.98){ x = -0.29; z = radians2(180, object.rotation.z); zoom = 1.92; }
                    
                    camera.position.set(0, 0, zoom);
                    camera.rotation.set(
                        radians2(0, camera.rotation.x),
                        radians2(0, camera.rotation.y),
                        radians2(0, camera.rotation.z)
                    );
                    object.position.set(x, -0.01, 0.05);
                    object.rotation.set(
                        radians2(90, object.rotation.x),
                        radians2(-180, object.rotation.y),
                        z
                    );
                    setTimeout(function(){ fps = 0; }, 400);
                }else if(slide==4){
                    let zoom = (window.innerWidth<1199.98)? 0.62: 0.5;
                    if(window.innerWidth<991.98){ zoom = 1.45; }
                    
                    camera.position.set(0.02, -0.02, zoom);
                    camera.rotation.set(
                        radians2(0, camera.rotation.x),
                        radians2(0, camera.rotation.y),
                        radians2(-15, camera.rotation.z)
                    );
                    object.position.set(0, 0, 0);
                    object.rotation.set(
                        radians2(40, object.rotation.x),
                        radians2(-270, object.rotation.y),
                        radians2(360, object.rotation.z)
                    );
                    setTimeout(function(){ fps = 0; }, 400);
                }else if(slide==5){
                    let zoom = (window.innerWidth<1199.98)? 1: 0.9;
                    if(window.innerWidth<991.98){ zoom = 1.84; }
                    
                    camera.position.set(0, 0, zoom);
                    camera.rotation.set(
                        radians2(0, camera.rotation.x),
                        radians2(0, camera.rotation.y),
                        radians2(0, camera.rotation.z)
                    );
                    object.position.set(0, 0, 0);
                    object.rotation.set(
                        radians2(0, object.rotation.x),
                        radians2(-270, object.rotation.y),
                        radians2(360, object.rotation.z)
                    );
                    setTimeout(function(){ fps = 0; }, 400);
                }
            }
        }
        function pageSlide(slide){
            setTimeout(function(){
                $('.slide').css('transform', 'translateY(-'+(window.innerHeight * (slide-1))+'px)');
            }, 500)
            slides.removeClass('active');
            menus.removeClass('active');
            menus.filter('[href='+slide+']').addClass('active');
        }
    </script>
</body>
</html>
