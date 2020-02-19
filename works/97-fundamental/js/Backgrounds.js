import Background from './Background.js';
const gn = new GyroNorm();

export default class Backgrounds {
    constructor(imageSets){
        this.imageSets = imageSets;
        this.createBackgrounds();

        this.windowWidth = window.innerWidth;
        this.windowHeight = window.innerHeight;
        this.mouseX = 0;
        this.mouseY = 0;
    
        this.mouseTargetX = 0;
        this.mouseTargetY = 0;
        
        this.startTime = new Date().getTime();
        
        this.maxTilt = 15;
        this.rotationCoef = 0.15;
        this.mouseMove();
        this.gyro();
    }

    createBackgrounds(){
        let self = this;
        self.backgrounds = self.imageSets.map(function(imageSet){
            return new Background(imageSet);
        });
    }

    mouseMove(){
        let self = this;
        document.addEventListener('mousemove', function(e){
            let halfX = self.windowWidth / 2,
                halfY = self.windowHeight / 2;
            self.mouseTargetX = (halfX - e.clientX) / halfX;
            self.mouseTargetY = (halfY - e.clientY) / halfY;
        });
    }
    gyro(){
        let self = this;
        gn.init({ gravityNormalized: true }).then(function(){
            gn.start(function(data){
                let y = data.do.gamma,
                    x = data.do.beta;
                self.mouseTargetY = clamp(x, -self.maxTilt, self.maxTilt) / self.maxTilt;
                self.mouseTargetX = -clamp(y, -self.maxTilt, self.maxTilt) / self.maxTilt;
            });
        }).catch(function(e){
            console.log('Your browser does not support DeviceOrientation.');
        });
    }
    
    onMouseMove(e){
        let halfX = this.windowWidth / 2,
            halfY = this.windowHeight / 2;
        this.mouseTargetX = (halfX - e.clientX) / halfX;
        this.mouseTargetY = (halfY - e.clientY) / halfY;
    }
    onResize(){
        let self = this;
        self.windowWidth = window.innerWidth;
        self.windowHeight = window.innerHeight;
        self.backgrounds.forEach(function(child){
            child.onResize();
        });
    }

    update(){
        let currentTime = ( new Date().getTime() - this.startTime ) / 1000;

        // Inertia
        this.mouseX += (this.mouseTargetX - this.mouseX) * 0.05;
        this.mouseY += (this.mouseTargetY - this.mouseY) * 0.05;
    
        // Render
        let self = this;
        self.backgrounds.forEach(function(child){
            child.animate(currentTime, self.mouseX, self.mouseY);
        });
    }
}
