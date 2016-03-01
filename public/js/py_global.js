$(document).ready(function() {
    setBlur($('.ceitem'));
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