<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Fundamental</title>
    <link rel="stylesheet" href="css/style.css">
    <style>
        .canvas-container{width:100vw; height:100vh;}
    </style>
</head>
<body>
    <div class="canvas-container" id="container-01"></div>
    <div class="canvas-container" id="container-02"></div>
    <div class="canvas-container" id="container-03"></div>
    <div class="canvas-container" id="container-04"></div>
    
    <script src="js/utils.js"></script>
    <script src="js/webgl-utils.js"></script>
    <script src="js/gyronorm.js"></script>
    <script type="module">
        import Backgrounds from './js/Backgrounds.js';
        
        class App {
            constructor(){
                this.imageSets = [
                    {
                        selector: '#container-01',
                        image: 'img/car.jpg',
                        depth: 'img/car-map.jpg',
                        hthreshold: 34,
                        vthreshold: 18
                    }, 
                    // {
                    //     selector: '#container-01',
                    //     image: 'img/ball.jpg',
                    //     depth: 'img/ball-map.jpg',
                    //     hthreshold: 34,
                    //     vthreshold: 18
                    // }, 
                    // {
                    //     selector: '#container-02',
                    //     image: 'img/canyon.jpg',
                    //     depth: 'img/canyon-map.jpg',
                    //     hthreshold: 34,
                    //     vthreshold: 18
                    // }, 
                    // {
                    //     selector: '#container-03',
                    //     image: 'img/lady.jpg',
                    //     depth: 'img/lady-map.jpg',
                    //     hthreshold: 34,
                    //     vthreshold: 18
                    // }, 
                    // {
                    //     selector: '#container-04',
                    //     image: 'img/mount.jpg',
                    //     depth: 'img/mount-map.jpg',
                    //     hthreshold: 34,
                    //     vthreshold: 18
                    // }
                ];
                this.backgrounds = new Backgrounds(this.imageSets);
                
                this.addEventListeners();
                this.update();
            }

            onMouseMove(e){
                if(this.backgrounds) this.backgrounds.onMouseMove(e);
            }
            onResize(){
                if(this.backgrounds) this.backgrounds.onResize();
            }
            addEventListeners(){
                window.addEventListener('mousemove', this.onMouseMove.bind(this));
                window.addEventListener('resize', this.onResize.bind(this));
            }

            update(){
                if(this.backgrounds) this.backgrounds.update();
                window.requestAnimationFrame(this.update.bind(this));
            }
        }
        new App();
    </script>
</body>
</html>
