app.filter('statusClass', function() {
    return function(input) {
        switch( input ) {
            case 'success':
                return 'label-success';
            case 'error':
                return 'label-danger';
        }
    }
});

app.filter('excludedClass', function() {
    return function(item) {
        switch (item.include) {
            case 0:
                return '-excluded';
            default:
                return '';
        }
    }
});

app.filter('isActive', function() {
    return function(input, compareValue) {
        return (input === compareValue) ? " active":"";
    };
});

app.filter('urlTo', function() {
    return function(input, action) {
        switch (action) {
            case 'type':
                return '/#/filter?type=' + input.type;
            case 'excluded':
                return '/#/filter?excluded=' + !input.include;
            case 'title':
                return '/#/filter?title=' + input.title;
            case 'delete':
                return '/#/expenses/delete/' + input.id;
            case 'edit':
                return '/#/expenses/' + input.id + '/edit';
            default:
                return '/notvalid';
        }
    }
});

app.filter('typeClass', function optionColorFactory() {
    return function( type ) {
        var typeClass = '';
        switch(type) {
            case 'mat':
                typeClass = ' label-primary';
                break;
            case 'restaurang':
                typeClass = ' label-success';
                break;
            case 'bar':
                typeClass = ' label-info';
                break;
            case 'hem':
                typeClass = ' label-warning';
                break;
            case 'resa':
                typeClass = ' label-danger';
                break;
            case 'övrigt':
                typeClass = ' label-default';
                break;
        }
        return typeClass;
    };
});
