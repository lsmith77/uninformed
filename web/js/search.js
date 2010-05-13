
$(function(){
    var addTag = function(item) {
        var tpl = '<li><a><img src="/images/close.gif" /></a><%= this.label %>'+
        '<input type="hidden" name="t[<%= this.id %>]" value="<%= this.label %>" /></li>';
        $('#taglist').jqoteapp(tpl, item);
    },
    loadResultsPage = function() {
        var url = '/search/results?' + $('#searchForm').serialize()
        $.getJSON(url, null, function(data, status) {
            $('.filters').jqotesub($('#filtersTpl'), data);
            $('.results').jqotesub($('#resultsTpl'), data);
        });
    },
    refreshResults = function(query, tags, tagMatch) {
        $.getJSON('/search/results', {q: query, t: tags, tm: tagMatch}, function(data, status) {
            $('.filters').jqotesub($('#filtersTpl'), data);
            $('.results').jqotesub($('#resultsTpl'), data);
        });
    };

    // handle tag removal link
    $('#taglist li a').live('click', function(e) {
        $(this).parent('li').remove();
    });

    // autocomplete
    $('#tags').autocomplete({
        source: '/search/searchTags',
        select: function(e, ui) {
            e.preventDefault();
            addTag(ui.item);
            $('#tags').val('');
        }
    });

    // results page only
    if ($('.results').length) {
        loadResultsPage();

        $('.filters').live('change', refreshResults)
    }
});