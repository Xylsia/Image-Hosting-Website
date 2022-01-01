var i = 0;
var img = ["slide1.jpg",  "slide2.jpg", "slide3.jpg", "slide4.jpg", "slide5.jpg", "slide6.jpg"];
slider();
function slider(){
    document.querySelector(".slideshow").src = "../img/"+ img[i];
    i ++;
    if(i == img.length){
        i = 0;
    }
    setTimeout(slider, 2000);
}