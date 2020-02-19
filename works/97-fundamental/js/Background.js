import { fragmentShader, vertexShader } from './Shaders.js';

export default class Background {
    constructor(imageSet){
        this.imageSet = imageSet;

        this.container = document.querySelector(imageSet.selector);
        this.canvas = document.createElement('canvas');
        this.container.appendChild(this.canvas);
        this.gl = this.canvas.getContext('webgl');
        
        this.ratio = window.devicePixelRatio;

        this.imageOriginal = imageSet.image;
        this.imageDepth = imageSet.depth;
        this.hth = imageSet.hthreshold;
        this.vth = imageSet.vthreshold;

        this.imageURLs = [this.imageOriginal, this.imageDepth];
        this.textures = [];

        this.createBackground();
        this.addTexture();
    }

    createBackground(){
        // Create program
        this.program = this.gl.createProgram();

        // Add shaders
        this.addShader( vertexShader, this.gl.VERTEX_SHADER );
        this.addShader( fragmentShader, this.gl.FRAGMENT_SHADER );

        // Link & use program
        this.gl.linkProgram(this.program);
        this.gl.useProgram(this.program);
    
        // Create fragmentShader uniforms
        this.uResolution = new Uniform( 'resolution', '4f' , this.program, this.gl );
        this.uMouse = new Uniform( 'mouse', '2f' , this.program, this.gl );
        this.uTime = new Uniform( 'time', '1f' , this.program, this.gl );
        this.uRatio = new Uniform( 'pixelRatio', '1f' , this.program, this.gl );
        this.uThreshold = new Uniform( 'threshold', '2f' , this.program, this.gl );

        // Create position attrib
        this.billboard = new Rect( this.gl );
        this.positionLocation = this.gl.getAttribLocation( this.program, 'a_position' );
        this.gl.enableVertexAttribArray( this.positionLocation );
        this.gl.vertexAttribPointer( this.positionLocation, 2, this.gl.FLOAT, false, 0, 0 );
    }
    addShader(source, type){
        let shader = this.gl.createShader( type );
        this.gl.shaderSource( shader, source );
        this.gl.compileShader( shader );
        let isCompiled = this.gl.getShaderParameter( shader, this.gl.COMPILE_STATUS );
        if(!isCompiled){
            throw new Error( 'Shader compile error: ' + this.gl.getShaderInfoLog( shader ) );
        }
        this.gl.attachShader( this.program, shader );
    }
    
    addTexture() {
        let self = this;
        let gl = self.gl;
        self.loadImages(self.imageURLs, self.start.bind(this));
    }
    loadImages(urls, callback){
        let images = [],
            imagesToLoad = urls.length;
        var onImageLoad = function(){
            --imagesToLoad;
            if(imagesToLoad===0) callback(images);
        };
        for(let ii=0; ii<imagesToLoad; ++ii){
            let image = this.loadImage(urls[ii], onImageLoad);
            images.push(image);
        }
    }
    loadImage(url, callback){
        var image = new Image();
        image.src = url;
        image.onload = callback;
        return image;
    }

    start(images){
        let self = this;
        let gl = self.gl;
    
        // connect images
        this.imageAspect = images[0].naturalHeight/images[0].naturalWidth;
        for (var i = 0; i < images.length; i++) {
          
    
          let texture = gl.createTexture();
          gl.bindTexture(gl.TEXTURE_2D, texture);
    
          // Set the parameters so we can render any size image.
          gl.texParameteri(gl.TEXTURE_2D, gl.TEXTURE_WRAP_S, gl.CLAMP_TO_EDGE);
          gl.texParameteri(gl.TEXTURE_2D, gl.TEXTURE_WRAP_T, gl.CLAMP_TO_EDGE);
          gl.texParameteri(gl.TEXTURE_2D, gl.TEXTURE_MIN_FILTER, gl.LINEAR);
          gl.texParameteri(gl.TEXTURE_2D, gl.TEXTURE_MAG_FILTER, gl.LINEAR);
    
          // Upload the image into the texture.
          gl.texImage2D(gl.TEXTURE_2D, 0, gl.RGBA, gl.RGBA, gl.UNSIGNED_BYTE, images[i]);
          this.textures.push(texture);
        }
    
        // lookup the sampler locations.
        let u_image0Location = this.gl.getUniformLocation(this.program, 'image0');
        let u_image1Location = this.gl.getUniformLocation(this.program, 'image1');
    
        // set which texture units to render with.
        this.gl.uniform1i(u_image0Location, 0); // texture unit 0
        this.gl.uniform1i(u_image1Location, 1); // texture unit 1
    
        // Set each texture unit to use a particular texture.
        this.gl.activeTexture(this.gl.TEXTURE0);
        this.gl.bindTexture(this.gl.TEXTURE_2D, this.textures[0]);
        this.gl.activeTexture(this.gl.TEXTURE1);
        this.gl.bindTexture(this.gl.TEXTURE_2D, this.textures[1]);
    
        this.onResize();
    }

    onResize(){
        this.width = this.container.offsetWidth;
        this.height = this.container.offsetHeight;
    
        this.canvas.width = this.width * this.ratio;
        this.canvas.height = this.height * this.ratio;
        this.canvas.style.width = this.width + 'px';
        this.canvas.style.height = this.height + 'px';

        let a1,a2;
        if(this.height/this.width<this.imageAspect){
            a1 = 1; a2 = (this.height / this.width) / this.imageAspect;
        }else{
            a1 = (this.width / this.height) * this.imageAspect; a2 = 1;
        }
        this.uResolution.set( this.width, this.height, a1, a2 );
        this.uRatio.set( 1 / this.ratio );
        this.uThreshold.set( this.hth, this.vth );
        this.gl.viewport( 0, 0, this.width * this.ratio, this.height * this.ratio );
    }
      
    animate(currentTime, mouseX, mouseY){
        this.uTime.set( currentTime );
        this.uMouse.set( mouseX, mouseY );
        this.billboard.render( this.gl );
    }
}
