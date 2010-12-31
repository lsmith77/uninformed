$(function(){

});

(function($) {
    $.extend({
        urlencode: function(text) {
            return encodeURIComponent(text);
        },
        htmlencode: function(text) {
            if (text.replace) {
                var findReplace = [[/&/g, "&amp;"], [/</g, "&lt;"], [/>/g, "&gt;"], [/"/g, "&quot;"]];
                for (idx in findReplace) {
                    text = text.replace(findReplace[idx][0], findReplace[idx][1]);
                }
            }
            return text;
        }
    });
})(jQuery);
