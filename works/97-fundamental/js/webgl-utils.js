
function clamp(number, lower, upper){
    if(number===number){
        if(upper!==undefined) number = number <= upper ? number : upper;
        if(lower!==undefined) number = number >= lower ? number : lower;
    }
    return number;
}

function Uniform(name, suffix, program,gl){
    this.name = name;
    this.suffix = suffix;
    this.gl = gl;
    this.program = program;
    this.location = gl.getUniformLocation( program, name );
}
Uniform.prototype.set = function( ...values ){
    let method = 'uniform' + this.suffix;
    let args = [ this.location ].concat( values );
    this.gl[ method ].apply( this.gl, args );
}

function Rect(gl){
    var buffer = gl.createBuffer();
    gl.bindBuffer( gl.ARRAY_BUFFER, buffer );
    gl.bufferData( gl.ARRAY_BUFFER, Rect.verts, gl.STATIC_DRAW );
}
Rect.verts = new Float32Array([ -1, -1, 1, -1, -1, 1, 1, 1, ]);
Rect.prototype.render = function(gl){
    gl.drawArrays( gl.TRIANGLE_STRIP, 0, 4 );
}
