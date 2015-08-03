/**
 * Created by JoeriSmits on 11/06/2015.
 */

$(document).ready(function () {
    setSideBarHeight();
});

$(window).resize(function () {
    setSideBarHeight();
});

$('#main-content').bind('heightChange', function(){
    setSideBarHeight();
});

/**
 * Resizes the sideBar clientHeight to match the screen height,
 * or if the content is bigger than the screen height it will adapt to the height of the content
 */
function setSideBarHeight() {
    var sideBar = document.getElementsByClassName('sidebar')[0];
    var header = document.getElementById('header');

    if (window.innerHeight > sideBar.clientHeight)
        sideBar.style.height = window.innerHeight - header.clientHeight + 'px';
}
