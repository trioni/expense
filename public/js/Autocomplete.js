var Autocomplete = function() {};

Autocomplete.prototype = {
    datumize: function(arr) {
        var datums = [], i = 0, len = arr.length;

        for( i; i<len; ++i ) {
            datums.push({
                val: arr[i]
            });
        }
        return datums;
    }
};
