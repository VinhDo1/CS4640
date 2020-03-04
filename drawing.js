
//Sources: https://developer.mozilla.org/en-US/docs/Web/API/Canvas_API/Tutorial, https://www.sitepoint.com/basic-animation-with-canvas-and-javascript/
//JS for Canvas Drawing
var canvas = document.getElementById('myCanvas');
var context= canvas.getContext('2d');


var radius = 5; /* radius of drawing point*/
var dragging = false;

context.lineWidth = radius*2;

/*allows for point to be made on canvas and extended into a line */
var putPoint = function(e){
 if(dragging){
    context.lineTo(e.offsetX,e.offsetY);
    context.stroke();
    context.beginPath();
    context.arc(e.offsetX,e.offsetY,radius,0,Math.PI*2);
    context.fill();
    context.beginPath();
    context.moveTo(e.offsetX,e.offsetY);
    }
}

/* if mouse dragging drawing continues*/
var engage = function(e){
    dragging = true;
    putPoint(e);
}

/* when mouse stops clicking stop drawing */
var disengage = function(){
    dragging = false;
    context.beginPath();
}
canvas.addEventListener('mousedown',engage);
canvas.addEventListener('mouseup',disengage);
canvas.addEventListener('mousemove', putPoint);

//JS for changing colors

//adding click to all colors
var shades = document.getElementsByClassName('shade');
for(var i=0;i<shades.length;i++){
    shades[i].addEventListener('click', changeColor);
}

//set active color
function setShade(color){
    context.fillStyle = color;
    context.strokeStyle = color;
    var active = document.getElementsByClassName('active')[0];
    if (active){
        active.className = 'shade';
    }
}
//select color and give active class
function changeColor(e){
    var shade = e.target;
    setShade(shade.style.backgroundColor);
    shade.className += ' active';
}

