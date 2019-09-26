window.addEventListener('load', function(){
    //added curosr pointer for the hover
    $('.btn-like').css('cursor', 'pointer');
    $('.btn-dislike').css('cursor', 'pointer');

    //like function
    function like(){
        $('.btn-like').unbind('click').click(function(){
            console.log('like');
            $(this).addClass('btn-dislike').removeClass('btn-like');
            $(this).attr('src', 'img/heart-red.png');
            dislike();
        });
    }
    like();

    //dislike function
    function dislike(){
        $('.btn-dislike').unbind('click').click(function(){
            console.log('dislike');
            $(this).addClass('btn-like').removeClass('btn-dislike');
            $(this).attr('src', 'img/heart-black.png');
            like();
        });
    }
    dislike();
});