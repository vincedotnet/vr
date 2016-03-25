$(document).ready(function() {
    setBlur($('.ceitem'));

    $('.snsbtn.weixin, #forweixin').mouseenter(function(){
        $('.showqrly').fadeIn(200);
    });
    $('.snsbtn.weixin, #forweixin').mouseleave(function(){
        $('.showqrly').fadeOut(200);
    });

    $(window).resize(function() {
        if($(window).width() < 690) {
            $('.container').width('auto');
            $('.home_block.fullheight').addClass('sm');
            $('.ceitem').addClass('sm');
            $('.top-I-h').show();
            $('.big_menu').hide();
            $('.bist03').addClass('sm');
        } else {
            $('.home_block.fullheight').removeClass('sm');
            $('.ceitem').removeClass('sm');
            $('.top-I-h').hide();
            $('.big_menu').show();
            $('.bist03').removeClass('sm');
        }
    });
    $(window).resize();

    $('.top-I-h').click(function(){
        $('.top-I-ddl').toggle();
    });
});

function setBlur(target) {
    target.mouseenter(function() {
        var $this = $(this);
        var myid = $this.attr('id');
        target.each(function() {
            var i = $(this);

            if (myid !== i.attr('id')) {
                i.addClass('blur');
            }
        });
    });
    target.mouseleave(function() {
        target.removeClass('blur');
    });
}


/*
 * 参数 	maxOffset	number		触发偏移量（默认值100）
 * 参数 	stickyClass	string		固定布局引用的css class名
 * 描述	当页面滚动偏移量超过指定值时出现固定布局
 */
$.fn.stickyBox = function(maxOffset, stickyClass) {
    var object = $(this);
    $(window).scroll(function() {

        if (typeof(maxOffset) != 'number') {
            maxOffset = 100;
        }
        if (typeof(stickyClass) != 'string' || stickyClass.length == 0) {
            stickyClass = 'sticky';
        }

        var offset = $(window).scrollTop();
        if (offset > maxOffset) {
            object.addClass(stickyClass);

        } else {
            object.removeClass(stickyClass);
        }

    });
}

