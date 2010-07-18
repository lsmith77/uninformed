/* 
 * Collapse boxes with jQuery
 */
$(function(){
    // click handler
    $(".toggleCol").click(function(event) {
        event.preventDefault();
        var targetSelector = '#'+$(this).attr('target');
        if ($(targetSelector).attr('style')==='display: none;') {
            $(this).removeClass('closed');
        } else {
            $(this).addClass('closed');
        }
        $(targetSelector).slideToggle();
    });
    // auto hide all elements with the class collapsed
    $(".collapsed").each(function(){
        var targetSelector = 'a[target="'+$(this).attr('id')+'"]';
        $(targetSelector).addClass('closed');
    }).hide();
});