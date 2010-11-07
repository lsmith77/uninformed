
$(function(){
    var
    // adds a tag when picked in the autocomplete dropdown
    addTag = function(item) {
        var tpl = '<li><a><img src="/images/close.gif" /></a>&nbsp;<%= this.label %>'+
        '<input type="hidden" name="t[<%= this.id %>]" value="<%= this.label %>" /></li>';
        $('#taglist').jqoteapp(tpl, item);
    },
    // loads the results on page load
    loadResultsPage = function() {
        var url = '/search/results?' + $('#searchForm').serialize();
        $.getJSON(url, null, function(data, status) {
            $('.filters').jqotesub($('#filtersTpl'), data);
            $('.results').jqotesub($('#resultsTpl'), data);
        });
    },
    // refreshes the results, accounting for paging and all filters
    refreshResults = function(e, page) {
        $("#searchIndicator").html('<span>Updating results..</span>');
        $("#searchIndicator").show();

        page = page || 0;
        var url = '/search/results?' + $('#searchForm').serialize();
        $('#filtersForm :input:not(.selectAll)').each(function(i, el) {
            if (!$(el).attr('checked')) {
                url += '&' + $(el).attr('name') + '=' + $(el).val();
            }
        });
        url += '&p=' + page;
        $.getJSON(url, null, function(data, status) {
            $('.filters').jqotesub($('#filtersTpl'), data);
            $('.results').jqotesub($('#resultsTpl'), data);
            
            $("#searchIndicator").html('<span>'+data.totalResults+' results (page '+(data.page+1)+' of '+(Math.ceil(data.totalResults/data.limit))+')</span>');

            setTimeout(function() {
                $('#searchIndicator').fadeOut('slow');
            }, 2000);
        });
    },
    // folds a filter group when clicked
    foldFilterGroup = function(e) {
        $(this)
            .closest('h3').next('.filterGroup').toggle('fast')
            .end().end()
            .toggleClass('folded');
    },
    // toggle all checkboxes when the "all" one is used
    toggleFilterGroupCheckboxes = function(e) {
        $(this).closest('.filterGroup').find(':checkbox:not(.selectAll):not(:disabled)')
            .attr('checked', $(this).attr('checked')) // un|check all
            .first().trigger('change'); // trigger the result reloading
    },
    // toggle the "all" checkbox depending on the state of the others
    toggleSelectAllCheckbox = function(e) {
        var allBoxes, checked;
        allBoxes = $(this).closest('.filterGroup').find(':checkbox:not(.selectAll)'),
        checked = allBoxes.length === allBoxes.filter(':checked').length;
        $(this).closest('.filterGroup').find('.selectAll').attr('checked', checked);
    };

    // handle tag removal link
    $('#taglist li a').live('click', function(e) {
        $(this).closest('li').remove();
    });

    // load next page
    $('.results .nextPage').live('click', function(e) {
        refreshResults(null, $('.results').data('page')+1);
    });

    // load prev page
    $('.results .prevPage').live('click', function(e) {
        refreshResults(null, $('.results').data('page')-1);
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

    // autocomplete
    $('#documentCode').autocomplete({
        source: '/search/searchDocumentCode',
        select: function(e, ui) {
            e.preventDefault();
            $('#documentCode').attr.('value', ui.item.label);
        }
    });

    // autocomplete
    $('#documentCodeOld').autocomplete({
        source: '/search/searchDocumentCodeOld',
        select: function(e, ui) {
            e.preventDefault();
            if (ui.item.url.replace(/ /, '') !== '') { location.href = ui.item.url; }
        }
    });

    // results page only
    if ($('.results').length) {
        loadResultsPage();

        $('.filters :checkbox:not(.selectAll)').live('change', refreshResults)
        $('.filters .fold').live('click', foldFilterGroup);
        $('.filters .selectAll').live('click', toggleFilterGroupCheckboxes);
        $('.filters input[type=checkbox]:not(.selectAll)').live('click', toggleSelectAllCheckbox);
    }
});
