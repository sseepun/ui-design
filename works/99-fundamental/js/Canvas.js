import {
    Clock, LinearFilter, Math as THREEMath, Mesh, MeshBasicMaterial, PerspectiveCamera,
    PlaneBufferGeometry, Scene, LoadingManager, TextureLoader, WebGLRenderer
} from '../../../extensions/three/build/three.module.js';
  
import Slides from './Slides.js';
  
export default class Canvas {
    constructor(selector, images){
        this.clock = new Clock();
        this.images = images;
        this.createRenderer(selector);
        this.createScene();
        this.createTextures();
    }
  
    createRenderer(selector){
        this.renderer = new WebGLRenderer({ antialias: true, alpha: true });
        this.renderer.setPixelRatio(window.devicePixelRatio);
        this.renderer.setSize(window.innerWidth, window.innerHeight);
        document.querySelector(selector).appendChild(this.renderer.domElement);
    }
    createScene(){
        this.scene = new Scene();
        this.camera = new PerspectiveCamera(
            45, window.innerWidth / window.innerHeight, 1, 500
        );
        this.camera.position.z = 300;
  
        const fov = THREEMath.degToRad(this.camera.fov);
        const height = 2 * Math.tan(fov / 2) * this.camera.position.z;
        const width = height * this.camera.aspect;
  
        this.environment = { height, width };
    }
    createTextures() {
        this.covers = [];
        
        var manager = new LoadingManager();
        manager.onProgress = function(url, itemsLoaded, itemsTotal){
            console.log('Image loaded - '+Math.round(itemsLoaded / itemsTotal * 100)+'%');
        };
        manager.onStart = function(url, itemsLoaded, itemsTotal){ console.log('Image - Start loading'); };
        manager.onLoad = function(){ console.log('Image - Loading complete!'); };
        manager.onError = function(url){ console.log('Image - Error loading '+url); };
        this.loader = new TextureLoader(manager);
    
        let self = this;
        self.images.forEach(function(cover){
            self.loader.load(cover, function(texture){
                texture.generateMipmaps = false;
                texture.minFilter = LinearFilter;
                texture.needsUpdate = true;
        
                // Implemented in newest Three.js
                // this.renderer.initTexture(texture, 0);
        
                self.covers.push(texture);
                if(self.covers.length===self.images.length) self.createSlides();
            });
        });
    }
    createSlides(){
        this.slides = new Slides( this.covers, this.environment, this.scene );
    }
  
    onTouchDown(e){
        if(this.slides) this.slides.onTouchDown(e);
    }
    onTouchMove(e){
        if(this.slides) this.slides.onTouchMove(e);
    }
    onTouchUp(e){
        if(this.slides) this.slides.onTouchUp(e);
    }
    onWheel(e){
        if(this.slides) this.slides.onWheel(e);
    }
    onResize(){
        this.camera.aspect = window.innerWidth / window.innerHeight;
        this.camera.updateProjectionMatrix();
        this.renderer.setSize(window.innerWidth, window.innerHeight);
  
        const fov = THREEMath.degToRad(this.camera.fov);
        const height = 2 * Math.tan(fov / 2) * this.camera.position.z;
        const width = height * this.camera.aspect;
        this.environment = { height, width };

        if(this.slides) this.slides.onResize(this.environment);
    }
  
    update(){
        const time = this.clock.getElapsedTime();
        if(this.slides) this.slides.update(time);
        this.renderer.render(this.scene, this.camera);
    }
}
  