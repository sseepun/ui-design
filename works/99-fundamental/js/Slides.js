import Slide from './Slide.js';

export default class Slides {
    constructor(covers, environment, scene){
        this.covers = covers;
        this.environment = environment;
        this.scene = scene;

        this.position = { current: 0, previous: 0 };
        this.scroll = {
            clamp: { minimum: 0, maximum: 0 },
            values: { current: 0, target: 0 },
            y: { end: 0, start: 0 }
        };
    
        let self = this;
        self.onCheckDebounce = _.debounce(self.onCheck, 200);
        self.onHoldEndDebounce = _.debounce(self.onHoldEnd, 200);
        self.createSlides();
    }
  
    createSlides(){
        let self = this;
        self.projects = self.covers.map(function(cover, index){
            const project = new Slide( cover, self.environment, index );
            self.scene.add(project);
            return project;
        });
    }
  
    onTouchDown({ y }){
        this.isDown = true;
        this.scroll.values.current = this.position.current;
        this.scroll.y.start = y;
        this.onHoldStart();
    }
    onTouchMove({ y }){
        if(!this.isDown) return;
        this.scroll.y.end = y;
        this.scroll.values.target = this.scroll.values.current + (this.scroll.y.start - this.scroll.y.end);
    }
    onTouchUp({ y }){
        this.isDown = false;
        this.onCheck();
        this.onHoldEnd();
    }
    onWheel(speed){
        this.scroll.values.target += speed;
        this.onCheckDebounce();
        this.onHoldStart();
        this.onHoldEndDebounce();
    }
  
    onHoldStart(){
        this.projects.forEach(function(child){
            child.onTouchStart();
        });
    }
    onHoldEnd(){
        this.projects.forEach(function(child){
            child.onTouchEnd();
        });
    }
    onCheck(){
        this.scroll.values.target = this.environment.height * 1.33 * this.indexInfinite;
    }
    onResize(size){
        this.projects.forEach(function(child){
            child.onResize(size);
        });
    }
  
    update(time){
        const height = this.environment.height * 1.33;
        this.indexInfinite = Math.round(this.scroll.values.target / height);
        let index = this.indexInfinite % this.covers.length;
    
        if(this.indexInfinite < 0){
            index = (this.covers.length - Math.abs(this.indexInfinite % this.covers.length)) % this.covers.length;
        }
        if(this.index !== index) this.index = index;
    
        this.current = this.projects[this.index];
    
        this.position.current += (this.scroll.values.target - this.position.current) * 0.1;
    
        this.calculate();
    
        this.position.previous = this.position.current;
        this.projects.forEach(function(child){
            child.animate(time);
        });
    }
    calculate(){
        let self = this;
        const height = self.environment.height * 1.33;
        const heightTotal = height * self.covers.length;
    
        if(self.position.current < self.position.previous) self.direction = 'up';
        else if(self.position.current > self.position.previous) self.direction = 'down';
        else self.direction = 'none';
    
        self.projects.forEach(function(child){
            child.isAfter = child.position.y < -height;
            child.isBefore = child.position.y > height;
    
            if(self.direction === 'down' && child.isBefore){
                const position = child.location - heightTotal;
                child.isBefore = false;
                child.isAfter = true;
                child.location = position;
            }else if(self.direction === 'up' && child.isAfter){
                const position = child.location + heightTotal;
                child.isBefore = true;
                child.isAfter = false;
                child.location = position;
            }
    
            child.update(self.position.current);
        });
    }
}
