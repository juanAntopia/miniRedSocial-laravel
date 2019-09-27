var url = 'http://redsocial-laravel.com.devel/';

window.addEventListener('load', function(){
    //added curosr pointer for the hover
    $('.btn-like').css('cursor', 'pointer');
    $('.btn-dislike').css('cursor', 'pointer');

    //like function
    function like(){
        $('.btn-like').unbind('click').click(function(){
            console.log('like');
            $(this).addClass('btn-dislike').removeClass('btn-like');
            $(this).attr('src', url+'img/heart-red.png');

            $.ajax({
                url: url+'like/'+$(this).data('id'),
                type: 'GET',
                success: function(response){
                    if(response.like){
                        console.log('has dado like a la publicación');
                    }else{
                        console.log('Error al dar like');
                    }
                }
            });

            dislike();
        });
    }
    like();

    //dislike function
    function dislike(){
        $('.btn-dislike').unbind('click').click(function(){
            console.log('dislike');
            $(this).addClass('btn-like').removeClass('btn-dislike');
            $(this).attr('src',  url+'img/heart-black.png');

            $.ajax({
                url: url+'dislike/'+$(this).data('id'),
                type:'GET',
                success:function(response){
                    if(response.like){
                        console.log('Has dado dislike a la publicación');
                    }else{
                        console.log('No pudiste dar dislike');
                    }
                }
            });

            like();
        });
    }
    dislike();
});