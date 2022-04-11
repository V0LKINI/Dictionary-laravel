$(document).ready(function () {
    initializeCanvas();
});

function initializeCanvas(){
    var canvas1 = document.getElementById("canvas1");
    var canvas2 = document.getElementById("canvas2");
    var canvas3 = document.getElementById("canvas3");
    drawCircle(canvas1, 270, 10)
    drawCircle(canvas2, 270, 150)
    drawCircle(canvas3, 270, 100)
}

function drawCircle(canvas, start, end){
    var context = canvas.getContext('2d');
    canvas.height = 160;
    canvas.width = 160;

    drawArc(80, 80, 70, start, end, false, "#0011FF", "#FFFFFF", context);
    drawArc(80, 80, 70, end, start, false, "#EDEDED", "#FFFFFF", context);
}

function drawArc(xPos, yPos, radius, startAngle, endAngle, anticlockwise, lineColor, fillColor, context)
{
    var startAngle = startAngle * (Math.PI/180);
    var endAngle = endAngle * (Math.PI/180);
    var radius = radius;
    context.strokeStyle = lineColor;
    context.fillStyle = fillColor;
    context.lineWidth = 16;
    context.beginPath();
    context.arc(xPos, yPos, radius, startAngle, endAngle, anticlockwise);
    context.fill();
    context.stroke();
}