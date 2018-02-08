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

    $(".toggle-accordion").on("click", function () {
        var accordionId = $(this).attr("accordion-id"),
            numPanelOpen = $(accordionId + ' .collapse.in').length;

        $(this).toggleClass("active");

        if (numPanelOpen == 0) {
            openAllPanels(accordionId);
        } else {
            closeAllPanels(accordionId);
        }
    });

    $('.to-clouds').click(function () {
        $('body, html').animate({
            scrollTop: '0px'
        }, 300);
    });

    $(window).scroll(function () {
        if ($(this).scrollTop() > 0) {
            $('.to-clouds').slideDown(300);
        } else {
            $('.to-clouds').slideUp(300);
        }
    });

    $('#comments').submit(function (e) {
        function validate() {

            var valid = true;
            var input = $('#comment').val();

            if (input.length == 0) {
                alert('invalid comment');
                valid = false;
            }
            return valid;
        }

        e.preventDefault(); // Prevent Default Submission / Inputs prevent default

        if (validate()) {
            $.ajax({
                url: '/posts/savecomments/',
                type: 'POST',
                async: true,
                data: $(this).serialize(), // it will serialize the form data
                dataType: 'text',
                success: function (response) {
                    if (response) {
                        confirm('Mensaje enviado para su revision con un moderador');
                        console.log(response);
                        $('#comments').fadeOut('slow', function () {
                            $('#comments').fadeIn('slow').html();
                            $('#comment').val('');
                        });
                    }
                }
            })
                .fail(function () {
                    alert('Algo a salido mal...');
                });
        }
    });


});


