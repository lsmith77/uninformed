(function($) {
    // Avoid processing this file unless we're on the results page
    if (! $('#us_results').length) {
        return;
    }

    // Enable help-mode checkbox
    function toggleBodyHelpClass() {
        $('body').toggleClass('us_help', $('#us_help').is(':checked'));
    }

    $('#us_help').change(toggleBodyHelpClass);
    toggleBodyHelpClass();

    // Enable autosuggest plugin for tags
    (function() {
        var $tagsContainer = $('#us_tags_input_container');

        function getPrefillData() {
            var prefillTags = [];
            $('input:hidden', $tagsContainer).each(function(){
                var tagId = this.name.slice(2, -1);
                if (tagId) {
                    prefillTags.push({ id: tagId, label: this.value });
                }
            });
            return prefillTags;
        }

        function getTagIdForSelectionItem(selectionItem) {
            var index = selectionItem.index();
            if (index != -1) {
                return $('#as-values-us_tags').val().split(',')[index + 1];
            }
        }

        function getTagNameForSelectionItem(selectionItem) {
            return selectionItem[0].lastChild.textContent;
        }

        function selectionAdded(elem, tagId) {
            if (typeof(tagId) == 'string' && tagId.match(/^\d+$/)) {
                $('<input type="hidden" />')
                    .attr('name', 't['+tagId+']')
                    .attr('value', getTagNameForSelectionItem(elem))
                    .appendTo($tagsContainer);
                elem.data('tag-id', tagId);
            }
        }

        function selectionRemoved(elem) {
            var tagId = elem.data('tag-id');
            if (tagId) {
                $('input[name="t['+tagId+']"]', $tagsContainer).remove();
            }
            elem.remove();
        }

        $('#us_tags').autoSuggest('/search/searchTags', {
            asHtmlID: 'us_tags',
            minChars: 2,
            neverSubmit: true,
            preFill: getPrefillData(),
            queryParam: 'term',
            searchObjProps: 'label',
            selectedItemProp: 'label',
            selectedValuesProp: 'id',
            selectionAdded: selectionAdded,
            selectionRemoved: selectionRemoved,
            startText: 'Tags',
            usePlaceholder: true
        });

        // Disable the autoSuggest plugin's own hidden input field
        $('#as-values-us_tags').removeAttr('name');
    })();

    // Enable autocomplete for query
    (function() {
        var cache = {}, lastXhr;

        function count(char, str) {
            return str.split(char).length - 1;
        }

        function indexOfLastTerm(str) {
            var numQuotes = count('"', str);
            var lastQuoteIndex = str.lastIndexOf('"');
            var lastSpaceIndex = str.lastIndexOf(' ');

            if (numQuotes % 2) {
                // Last term is an unclosed, quoted phrase
                return lastQuoteIndex + 1;
            } else {
                // Last term is a single word; do not include the leading quote/space
                var pad = (lastQuoteIndex > 0 || lastSpaceIndex > 0 ? 1 : 0);
                return pad + Math.max(lastQuoteIndex, lastSpaceIndex, 0);
            }
        }

        function extractLastTerm(str) {
            return str.substr(indexOfLastTerm(str));
        }

        $('#us_query').autocomplete({
            minLength: 2,
            focus: function(e) {
                e.preventDefault();
            },
            select: function(e, ui) {
                e.preventDefault();
                var lastTermIndex = indexOfLastTerm(this.value);
                var isQuoted = this.value.charAt(Math.max(lastTermIndex - 1, 0)) == '"';
                this.value = this.value.substring(0, lastTermIndex) + ui.item.value + (isQuoted ? '" ' : ' ');
            },
            source: function(request, response) {
                var term = extractLastTerm(request.term);
                if (term in cache) {
                    response(cache[term]);
                    return;
                }
                lastXhr = $.getJSON('/search/searchTerm', { term: term }, function(data, status, xhr) {
                    cache[term] = data;
                    if (xhr === lastXhr) {
                        response(data);
                    }
                });
            }
        });
    })();

    // Enable autocomplete for documentCode
    (function() {
        var cache = {}, lastXhr;

        $('#us_documentCode').autocomplete({
            minLength: 2,
            select: function(e, ui) {
                e.preventDefault();
                $('#us_documentCode').attr('value', ui.item.label);
            },
            source: function(request, response) {
                var term = request.term;
                if (term in cache) {
                    response(cache[term]);
                    return;
                }
                lastXhr = $.getJSON('/search/searchDocumentCode', request, function(data, status, xhr) {
                    cache[term] = data;
                    if (xhr === lastXhr) {
                        response(data);
                    }
                });
            }
        });
    })();

    // Enable placeholder plugin
    $('input[placeholder], textarea[placeholder]').placeholder();

    // Form submission
    (function() {
        function formBeforeSerialize($form, options) {
            $('#filtersForm input:not(.selectAll)').each(function() {
                if (!$(this).is(':checked')) {
                    options.data[this.name] = this.value;
                }
            });
        }

        function formBeforeSubmit(arr, $form, options) {
            // Have placeholder plugin check to restore placeholder text 
            $('input[placeholder]').trigger('blur');

            $("#searchIndicator")
                .html('<span>Updating results..</span>')
                .show();
        }

        function formSuccess(response) {
            $("#searchIndicator").html('<span>'+response.totalResults+' results (page '+(response.page+1)+' of '+(Math.ceil(response.totalResults/response.limit))+')</span>');

            window.setTimeout(function() {
                $('#searchIndicator').fadeOut('slow');
            }, 2000);

            $('#us_filters').jqotesub($('#filtersTpl'), response);
            $('#us_results')
                .data('searchType', response.searchType)
                .data('page', response.page)
                .jqotesub($('#resultsTpl'), response);
        }

        $('#us_form').submit(function(e, searchType, page) {
            e.preventDefault();

            var $form = $(this);
            var data = {};

            searchType = searchType || $('#us_results').data('searchType');
            page = Math.max(page || 0, 0);

            if (searchType) {
                data.st = searchType;
            }

            if (page) {
                data.page = page;
            }

            $form.ajaxSubmit({
                data: data,
                dataType: 'json',
                url: $form.data('ajaxAction'),
                beforeSerialize: formBeforeSerialize,
                beforeSubmit: formBeforeSubmit,
                success: formSuccess
            });
        });

        $('#us_form input:button').click(function(e) {
            $('#us_form').trigger('submit', [ $(this).data('searchType') ]);
        });
    })();

    // Live events for pagination and filters
    (function() {
        function reloadPage() {
            $('#us_form').trigger('submit', [ null, $('#us_results').data('page') ]);
        }

        function loadNextPage(e) {
            e.preventDefault();
            $('#us_form').trigger('submit', [ null, 1 + $('#us_results').data('page') ]);
        }

        function loadPrevPage(e) {
            e.preventDefault();
            $('#us_form').trigger('submit', [ null, -1 + $('#us_results').data('page') ]);
        }

        function foldFilterGroup(e) {
            e.preventDefault();
            $(this)
                .closest('h3').next('.filterGroup').toggle('fast').end().end()
                .toggleClass('folded');
        }

        // Toggle other checkboxes when the "all" checkbox is changed
        function toggleFilterGroupCheckboxes($allCheckbox) {
            var $otherCheckboxes = $allCheckbox.closest('.filterGroup').find('input:checkbox:not(.selectAll):not(:disabled)');

            if ($allCheckbox.is(':checked')) {
                $otherCheckboxes.attr('checked', 'checked');
            } else {
                $otherCheckboxes.removeAttr('checked');
            }
        }

        // Toggle the "all" checkbox depending on the state of the others
        function toggleSelectAllCheckbox($checkbox) {
            var $allCheckbox = $checkbox.closest('.filterGroup').find('input:checkbox.selectAll');
            var $otherCheckboxes = $checkbox.closest('.filterGroup').find('input:checkbox:not(.selectAll)');

            if ($otherCheckboxes.length === $otherCheckboxes.filter(':checked').length) {
                $allCheckbox.attr('checked', 'checked');
            } else {
                $allCheckbox.removeAttr('checked');
            }
        }

        // Handle checkbox group toggling and result reloading when checkboxes change
        function filterCheckboxChanged(e) {
            var $checkbox = $(e.target).filter('input:checkbox');

            if ($checkbox.length) {
                if ($checkbox.is('.selectAll')) {
                    toggleFilterGroupCheckboxes($checkbox);
                } else {
                    toggleSelectAllCheckbox($checkbox);
                }

                reloadPage();
            }
        }

        $('#us_results a.nextPage').live('click', loadNextPage);
        $('#us_results a.prevPage').live('click', loadPrevPage);
        $('#us_filters span.fold').live('click', foldFilterGroup);
        $('#us_filters input:checkbox').live('change', filterCheckboxChanged);
    })();
})(jQuery);