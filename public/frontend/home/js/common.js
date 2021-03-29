$(function () {
 
    if(jQuery("#img").length > 0) {
        jQuery("#img").fadegallery({
            control_event: "mouseover",
            auto_play: true,
            control: jQuery("ul#imgControl"),
            delay: 3
        });
    }        
});



var Common = {
    toCenter: function(objOut, objIn) {
        var top = parseInt(jQuery(objOut).scrollTop());
        var left = parseInt(jQuery(objOut).scrollLeft());
        var boxX = parseInt(jQuery(objIn).width());
        var boxY = parseInt(jQuery(objIn).height());
        var centerX = parseInt(jQuery(objOut).width()) / 2 - boxX / 2 + left;
        var centerY = parseInt(jQuery(objOut).height()) / 2 - boxY / 2 /*+ top*/;
        jQuery(objIn).css({left : centerX + 'px', top : centerY + 'px'});
    }

    ,toCenterWindow: function(obj) {
        this.toCenter(window, obj);
    }
}

Common.Overlay = {
    id : '#overlay'
    ,idBg : '#overlay-bg'
    ,show : function() {
        jQuery(this.idBg).show();
        jQuery(this.id).show();
    }

    ,showEffect : function(time) {
        setTimeout("Common.Overlay.show()", time);
    }

    ,hide : function() {
        jQuery(this.id).hide();
        jQuery(this.idBg).hide();
    }

    ,hideEffect : function(time) {
        setTimeout("Common.Overlay.hide()",time);
    }

    ,setContent : function(content) {
        jQuery(this.id).html(content);
    }
}

Common.Loading = {
    id : '#loading'

    ,show: function() {
        var _id = this.id;
        if (arguments.length > 0) {
            _id = arguments[0];
        }
        jQuery(_id).show();
    }

    ,hide: function() {
        var _id = this.id;
        if (arguments.length > 0) {
            _id = arguments[0];
        }
        jQuery(_id).hide();
    }
}


              
   
   
   

