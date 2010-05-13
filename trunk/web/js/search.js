$(function(){
    var tags = {},
    lastTagsVal,
    addTag = function(item) {
        var tag = $('<li><a><img src="/images/close.gif" /></a> '+item.label+'</li>');
        tag.append('<input type="hidden" name="t['+item.id+']" value="'+item.label+'" />');
        $('#taglist').append(tag)
    };

    // handle tag removal link
    $('#taglist li a').click(function(){
        $(this).parent('li').remove();
    });

    // results page
    if (typeof(query) !== 'undefined') {
        $.getJSON('/search/results', {q: query, t: tags, tm: tagMatch}, function(data, status) {
            console.log(data);
//            $('.filters').html(data);
        });
    }

    // autocomplete
    $('#tags').autocomplete({
        source: '/search/searchTags',
        select: function(e, ui) {
            e.preventDefault();
            tags[ui.item.label] = ui.item.id;
            addTag(ui.item);
            $('#tags').val('');
        }
    });
});