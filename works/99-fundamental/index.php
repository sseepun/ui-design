<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Fundamental</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/2.1.2/TweenMax.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lodash.js/4.17.15/lodash.min.js"></script>
    <script src="js/utils.js"></script>
    <script type="module">
        import Canvas from './js/Canvas.js';

        class App {
            constructor() {
                this.images = [
                    'assets/01.jpg',
                    'assets/02.jpg',
                    'assets/03.jpg',
                    'assets/04.jpg',
                    'assets/05.jpg',
                ];
                this.mouse = { x: 0, y: 0 };
                this.canvas = new Canvas(this.images);

                this.addEventListeners();
                this.update();
            }

            onTouchDown(e){
                e.stopPropagation();
                this.mouse.x = e.touches ? e.touches[0].clientX : e.clientX;
                this.mouse.y = e.touches ? e.touches[0].clientY : e.clientY;
                if(this.canvas) this.canvas.onTouchDown(this.mouse);
            }
            onTouchMove(e){
                e.stopPropagation();
                this.mouse.x = e.touches ? e.touches[0].clientX : e.clientX;
                this.mouse.y = e.touches ? e.touches[0].clientY : e.clientY;
                if(this.canvas) this.canvas.onTouchMove(this.mouse);
            }
            onTouchUp(e){
                e.stopPropagation();
                this.mouse.x = e.changedTouches ? e.changedTouches[0].clientX : e.clientX;
                this.mouse.y = e.changedTouches ? e.changedTouches[0].clientY : e.clientY;
                if(this.canvas) this.canvas.onTouchUp(this.mouse);
            }
            onWheel(e){
                // const normalized = Normalize(e);
                // const speed = normalized.pixelY * 0.2;
                // if(this.canvas) this.canvas.onWheel(speed);

                if(this.canvas) this.canvas.onWheel(e.deltaY * 0.4);
            }
            onResize(){
                if(this.canvas) this.canvas.onResize();
            }
            addEventListeners() {
                window.addEventListener('mousewheel', this.onWheel.bind(this));
                window.addEventListener('wheel', this.onWheel.bind(this));

                window.addEventListener('mousedown', this.onTouchDown.bind(this));
                window.addEventListener('mousemove', this.onTouchMove.bind(this));
                window.addEventListener('mouseup', this.onTouchUp.bind(this));

                window.addEventListener('touchstart', this.onTouchDown.bind(this));
                window.addEventListener('touchmove', this.onTouchMove.bind(this));
                window.addEventListener('touchend', this.onTouchUp.bind(this));

                window.addEventListener('resize', this.onResize.bind(this));
            }

            update(){
                if(this.canvas) this.canvas.update();
                window.requestAnimationFrame(this.update.bind(this));
            }
        }

        new App();

    </script>
</body>
</html>