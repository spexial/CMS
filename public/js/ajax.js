$(function() {
    /**微信回复**/
    $('.replay button').click(function () {
        var form = new FormData(document.getElementById("form"));
        //文本消息
        $.ajax({
            headers: {'X-CSRF-Token': $('meta[name=csrf-token]').attr('content')},
            type: 'post',
            url: '/admin/wereplay/save',
            data: form,
            cache: false,
            contentType: false,
            processData: false,
            success: function (data) {
                    location = "/admin/wereplay";
            },
            error: function (msg) {
                var json = JSON.parse(msg.responseText);
                console.info(json);
                $('.alert-danger').show();
                if (json.keywords) {
                    $('#keywords').parents('.group').addClass('has-error');
                    $('.error1').show().text(json.keywords);
                }if (json.content) {
                    $('#content').parents('.group').addClass('has-error');
                    $('.error2').show().text(json.content);
                }if (json.image) {
                    $('#images').parents('.group').addClass('has-error');
                    $('.error2').show().text(json.image);
                }if (json.voice) {
                    $('#voice').parents('.group').addClass('has-error');
                    $('.error2').show().text(json.voice);
                }if (json.video) {
                    $('#video').parents('.group').addClass('has-error');
                    $('.error2').show().text(json.video);
                }if (json.music) {
                    $('#music').parents('.group').addClass('has-error');
                    $('.error2').show().text(json.music);
                }if (json.article) {
                    $('#article').parents('.group').addClass('has-error');
                    $('.error2').show().text(json.article);
                }
            }

        })
    });
    /**微信菜单**/
    $('.wemenu button').click(function () {
        var form = new FormData(document.getElementById("form"));
        //文本消息
        $.ajax({
            headers: {'X-CSRF-Token': $('meta[name=csrf-token]').attr('content')},
            type: 'post',
            url: '/admin/wemenu/save',
            data: form,
            cache: false,
            contentType: false,
            processData: false,
            success: function (data) {
                if(data.code==1) {
                    $('.group').removeClass('has-error');
                    $('.alert-danger').hide();
                    location = "/admin/wemenu";
                }
                else{
                    console.info(data.msg);
                    error(data.msg);
                }
            },
            error: function (msg) {
                var json = JSON.parse(msg.responseText);
                console.info(json);
                $('.alert-danger').show();
                if (json.name) {
                    $('#name').parents('.group').addClass('has-error');
                    $('.error-name').show().text(json.name);
                }else{
                    $('#name').parents('.group').removeClass('has-error');
                    $('.error-name').hide();
                }
                if (json.key) {
                    $('#key').parents('.group').addClass('has-error');
                    $('.error-key').show().text(json.key);
                }else{
                    $('#key').parents('.group').removeClass('has-error');
                    $('.error-key').hide();
                }
                if (json.title) {
                    $('#title').parents('.group').addClass('has-error');
                    $('.error-title').show().text(json.title);
                }else{
                    $('#title').parents('.group').removeClass('has-error');
                    $('.error-title').hide();
                }
                if (json.description) {
                    $('#description').parents('.group').addClass('has-error');
                    $('.error-description').show().text(json.description);
                }else{
                    $('#description').parents('.group').removeClass('has-error');
                    $('.error-description').hide();
                }
                if (json.image) {
                    $('#images').parents('.group').addClass('has-error');
                    $('.error-images').show().text(json.image);
                }else{
                    $('#images').parents('.group').removeClass('has-error');
                    $('.error-images').hide();
                }
                if (json.imgUrl) {
                    $('#imgUrl').parents('.group').addClass('has-error');
                    $('.error-imgUrl').show().text(json.imgUrl);
                }else{
                    $('#imgUrl').parents('.group').removeClass('has-error');
                    $('.error-imgUrl').hide();
                }
                if (json.url) {
                    $('#url').parents('.group').addClass('has-error');
                    $('.error-url').show().text(json.url);
                }else{
                    $('#url').parents('.group').removeClass('has-error');
                    $('.error-url').hide();
                }
            }

        })
    });
    /**显示错误弹框**/
    function error(data)
    {
        $('.error-msg').each(function(){
            $(this).css('display','block');
            $(this).html(data);
            var time =2;
            timeOut();
            function timeOut(){
                if(time == 0) {
                    $('.error-msg').fadeOut(100,function(){
                        $(this).css('display','none');
                    });
                }else{
                    setTimeout(function(){
                        time=time-1;
                        timeOut();
                    },1000);
                }
            }
        });
    }
});