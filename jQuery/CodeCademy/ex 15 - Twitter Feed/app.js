var main = function () {
    $('.btn').click(function () {
        var post = $('.status-box').val();
        $('<li>').text(post).prependTo('.posts');
        $('.status-box').val('');
        $('.counter').text('140');
        $('.btn').addClass('disabled');
    });
}
$('.status-box').keyup(function () {
    var postLength = $(this).val().length;
    var charLeft = 140 - postLength;
    $('.counter').text(charLeft);
    if (charLeft < 0) {
        $('.btn').addClass('disabled');
    } else if (charLeft === 140) {
        $('.btn').addClass('disabled');
    } else {
        $('.btn').removeClass('disabled');
    }
});
$('.btn').addClass('disabled');
$(document).ready(main);