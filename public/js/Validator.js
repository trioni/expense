(function($) {
    var Validator = function() {
    };
    Validator.prototype = {
        isValid: function($el) {
            var isValid = false;
            if($el.has('input[type=radio]').length ) {
                isValid = this.isValidRadio( $el );
            } else if($el.has('input[type=text]').length ) {
                isValid = this.isValidText( $el );
            } else if($el.has('input[type=number]').length ) {
                isValid = this.isValidNumber( $el );
            } else if($el.has('input[type=date]').length ) {
            }
            this.updateState(isValid, $el);
            return isValid;
        },
        updateState: function( isValid, $el ) {
            if( !isValid ) {
                $el.addClass('invalid');
            } else {
                $el.removeClass('invalid');
            }
        },
        isValidText: function( $el ) {
            var $text = this.getElement($el, 'input[type=text].tt-input'),
                textValue = $text.val().trim();

            if(textValue.length > 0) {
                return true;
            }
            return false;
        },
        isValidRadio: function( $el ) {
            var $radio = this.getElement($el, 'input[type=radio]:checked');
            window.radio = $radio;
            if($radio.val() !== undefined ) {
                return true;
            }
            return false;
        },
        isValidNumber: function( $el ) {
            var $number = this.getElement($el, 'input[type=number]');
            if( parseInt($number.val()) ) {
                return true;
            }
            return false;
        },
        getElement: function($root, selector) {
            if( $root.is(selector) ) {
                return $root;
            } else {
                var $el = $root.find(selector);
                return $el;
            }
        }
    };
    $.fn.validate = function() {
        var validator = new Validator();
        return this.each(function() {
            return validator.isValid( $(this) );
        });
    };
})(jQuery);
