var app = app || {};

$(document).ready(function() {

    if(app.autocomplete) {
        var ac = new Autocomplete()
            ,datums;
        datums = ac.datumize(app.autocomplete.titles);
    }

    FastClick.attach( document.body );

    // Init button-groups
    $('.btn-group').button();

    // Toggle open/close actions on a single expense
    $('.actions__toggle').on('click', function() {
        $(this).closest('.expense__container').toggleClass('open').closest('.expense__frame').toggleClass('open');
    });

    // instantiate the bloodhound suggestion engine
    var titles = new Bloodhound({
        datumTokenizer: function(d) {
            return Bloodhound.tokenizers.whitespace(d.val);
        },
        queryTokenizer: Bloodhound.tokenizers.whitespace,
        local: datums
    });

    // initialize the bloodhound suggestion engine
    titles.initialize();

    // instantiate the typeahead UI
    $('.typeahead').typeahead(null, {
        displayKey: 'val',
        source: titles.ttAdapter()
    });

    // Make sure to validate forms before sending to backend
    $('.add-form input[type=submit], .edit-form input[type=submit]').on('click',function() {
        $('.mandatory').validate();
        return ($('.invalid').length) ? false : true;
    });
});