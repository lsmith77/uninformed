(function($) {
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
                    prefillTags.push({ value: tagId, name: this.value });
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

        function selectionAdded(elem) {
            var tagId = getTagIdForSelectionItem(elem);
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
})(jQuery);