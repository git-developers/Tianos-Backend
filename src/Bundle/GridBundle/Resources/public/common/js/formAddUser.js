(function($) {
    "use strict";

    // Global Variables
    var MAX_HEIGHT = 100;

    $.formAddUser = function(el, options) {

        // Global Private Variables
        var MAX_WIDTH = 200;
        var base = this;

        base.$el = $(el);
        base.el = el;
        base.$el.data('formAddUser', base);

        base.init = function(){
            var totalButtons = 0;
            // base.$el.append('<button name="public" style="'+base.options.buttonStyle+'">Private</button>');
        };

        base.redirect = function(event, context) {
            // debug(e);

            var id = $(context).parent().parent().data('id');

            window.location.href = options.route.replace("/-1", "") + "/" + id;

        };

        // Private Functions
        function debug(e) {
            console.log(e);
        }

        base.init();
    };

    $.fn.formAddUser = function(options){

        return this.each(function(){

            var bp = new $.formAddUser(this, options);

            $(document).on('click', 'button.' + options.buttonId, function() {
                bp.redirect(event, this);
            });

        });
    };

})(jQuery);