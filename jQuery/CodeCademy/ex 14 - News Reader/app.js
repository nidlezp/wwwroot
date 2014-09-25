var main = function () {
    $('.article').click(function () {
        $('.article').removeClass('current');
        $('.description').hide();

        $(this).addClass('current');
        $(this).children('.description').show();
    });

    $(document).keypress(function (event) {
        if (event.which === 111) {//o
            if ($('.description').is(":visible")) {
                $('.description').hide();
            } else {
                $('.description').hide();
                $('.current').children('.description').show();
            }
        }
        else if (event.which === 99) {//c
            $('.description').hide();
            //$('.current').children('.description').show();
        }
        else if (event.which === 110) {//n
            var currentArticle = $('.current');
            var nextArticle = currentArticle.next();
            
            currentArticle.removeClass('current');
            nextArticle.addClass('current');
        }
        else if (event.which === 112) {//p
            var currentArticle = $('.current');
            var prevArticle = currentArticle.prev();
            currentArticle.removeClass('current');
            prevArticle.addClass('current');
        }
    });
}
$(document).ready(main);