/**
 * Created by alejandro.chavez on 11/10/2017.
 */

//Parallax effect using jquery
$(document).ready(function () {

    $(window).scroll(function () {

        var scrollBar = $(window).scrollTop();
        var position = (scrollBar * 0.15);

        $('body').css({
            'background-position': '0-' + position + 'px'
        });
    });

    $(".toggle-accordion").on("click", function() {
        var accordionId = $(this).attr("accordion-id"),
            numPanelOpen = $(accordionId + ' .collapse.in').length;

        $(this).toggleClass("active");

        if (numPanelOpen == 0) {
            openAllPanels(accordionId);
        } else {
            closeAllPanels(accordionId);
        }
    });

    $('.to-clouds').click(function(){
        $('body, html').animate({
            scrollTop: '0px'
        }, 300);
    });

    $(window).scroll(function(){
        if( $(this).scrollTop() > 0 ){
            $('.to-clouds').slideDown(300);
        } else {
            $('.to-clouds').slideUp(300);
        }
    });

   /* openAllPanels = function(aId) {
        console.log("setAllPanelOpen");
        $(aId + ' .panel-collapse:not(".in")').collapse('show');
    }
    closeAllPanels = function(aId) {
        console.log("setAllPanelclose");
        $(aId + ' .panel-collapse.in').collapse('hide');
    }*/



});


