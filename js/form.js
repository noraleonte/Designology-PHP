$(document).ready(function () {
    //remember scroll position on reload

    const myScrollPos = localStorage.getItem('myScrollPos');
    $(window).scrollTop(myScrollPos);

    $(window).scroll(function () {
        localStorage.setItem('myScrollPos', $(window).scrollTop());
    });
});