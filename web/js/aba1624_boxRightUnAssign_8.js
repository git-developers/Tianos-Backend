(function($) {
    "use strict";

    // Global Variables
    var MAX_HEIGHT = 100;

    $.boxRightUnAssign = function(el, options) {

        // Global Private Variables
        var MAX_WIDTH = 200;
        var base = this;

        base.$el = $(el);
        base.el = el;
        base.$el.data('boxRightUnAssign', base);

        base.init = function(){
            var totalButtons = 0;
            // base.$el.append('<button name="public" style="'+base.options.buttonStyle+'">Private</button>');
        };

        base.unAssign = function(context) {
            // debug(e);
            // base.options.buttonPress.call( this );

            var left_has_right = $(context).parent('div').parent('span').parent('li').data('id');
            $('#li-' + left_has_right).remove();
            $('.tooltip').remove();

            $.ajax({
                url: options.route_unassign,
                type: 'DELETE',
                dataType: 'json',
                data: {
                    left_has_right:left_has_right
                },
                cache: true,
                beforeSend: function(jqXHR, settings) {

                },
                success: function(data, textStatus, jqXHR) {
                    if(!data.status){
                        console.log('success error:');
                        console.log(data.errors);
                    }
                },
                error: function(jqXHR, exception) {
                    console.log('error info: function');
                }
            });
        };

        // Private Functions
        function debug(e) {
            console.log(e);
        }

        base.init();
    };

    // $.boxRightUnAssign.defaultOptions = {
    //     buttonStyle: "border: 1px solid #fff; background-color:#000; color:#fff; padding:20px 50px",
    //     buttonPress: function () {}
    // };

    $.fn.boxRightUnAssign = function(options){

        return this.each(function(){

            var bp = new $.boxRightUnAssign(this, options);

            $(document).on('click', 'i.' + options.modal_unassign_child_id, function() {
                bp.unAssign(this);
            });

        });

    };

})(jQuery);