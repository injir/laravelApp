// offcanvas-navi.js
// @desc for offcanvas navi menu
// variables for elements
window.onload = function() {
    var nav = document.getElementById('nav'),
        navToggle = document.getElementById('nav-toggle'),
        pageWrap = document.getElementById('page-wrap');
    navToggle.addEventListener( 'click', toggleNav, false );
    function toggleNav() {
        nav.classList.toggle( 'nav--open' );
        pageWrap.classList.toggle( 'nav--open' );
    }
}



// event listener attached to the nav toggle button
