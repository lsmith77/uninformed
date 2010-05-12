/* 
 * Collapse boxes with jQuery
 */
$(function(){
    $(".toggleCol").click(function(event) {
        event.preventDefault();
        var targetSelector ='#'+$(this).attr('target');
        $(targetSelector ).slideToggle();
    });
    $(".collapsed").hide();
});