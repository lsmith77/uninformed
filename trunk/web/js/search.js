
$(function(){
    var addTag = function(item) {
        var tpl = '<li><a><img src="/images/close.gif" /></a><%= this.label %>'+
        '<input type="hidden" name="t[<%= this.id %>]" value="<%= this.label %>" /></li>';
        $('#taglist').jqoteapp(tpl, item);
    },
    loadResultsPage = function() {
        var url = '/search/results?' + $('#searchForm').serialize();
        $.getJSON(url, null, function(data, status) {
            $('.filters').jqotesub($('#filtersTpl'), data);
            $('.results').jqotesub($('#resultsTpl'), data);
        });
    },
    refreshResults = function(page) {
        page = page || 0;
        var url = '/search/results?' + $('#searchForm').serialize();
        $('#filtersForm :input').each(function(i, el) {
            if (!$(el).attr('checked')) {
                url += '&' + $(el).attr('name') + '=' + $(el).val();
            }
        });
        url += '&p=' + page;
        $.getJSON(url, null, function(data, status) {
            $('.results').jqotesub($('#resultsTpl'), data);
        });
    },
    foldFilterGroup = function(e) {
        $(this)
            .parent('h3').next('.filterGroup').toggle('fast')
            .end().end()
            .toggleClass('folded');
    };

    // handle tag removal link
    $('#taglist li a').live('click', function(e) {
        $(this).parent('li').remove();
    });

    // load next page
    $('.results .nextPage').live('click', function(e) {
        refreshResults($('.results').data('page')+1);
    });

    // load prev page
    $('.results .prevPage').live('click', function(e) {
        refreshResults($('.results').data('page')-1);
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
        $('.filters .fold').live('click', foldFilterGroup);
    }
});
