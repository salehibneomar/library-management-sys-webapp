/** add active class and stay opened when selected */
var url = window.location;

// for sidebar menu entirely but not cover treeview
$('ul.nav-sidebar a').filter(function() {
    return this.href == url;
}).addClass('active');

// for treeview
$('ul.nav-treeview a').filter(function() {
    return this.href == url;
}).parentsUntil(".nav-sidebar > .nav-treeview").addClass('menu-open').prev('a').addClass('active');


$('.nav-dropdown-item').on('click', function(){
    //let link = $(this).attr('href');
    $('.nav-dropdown-item').removeClass('active');
    $(this).addClass('active');
});

