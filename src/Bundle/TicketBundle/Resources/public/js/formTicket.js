(function($) {
    "use strict";

    // Global Variables
    var MAX_HEIGHT = 100;

    $.formTicket = function(el, options) {

        // Global Private Variables
        var MAX_WIDTH = 200;
        var base = this;

        var msg_error = '<tr><td colspan="5"><p>INFO: Oops!, no se completo el proceso. Contacte a su proveedor (code 6060)</p></td></tr>';
        var msg_loading = '<div align="center"><i class="fa fa-2x fa-refresh fa-spin"></i></div>';

        base.$el = $(el);
        base.el = el;
        base.$el.data('formTicket', base);

        base.init = function(){
            var totalButtons = 0;
            // base.$el.append('<button name="public" style="'+base.options.buttonStyle+'">Private</button>');

        };

        base.submit = function(event) {
            event.preventDefault();

            // var table = $('table.box-table-client tbody');
            var fields = $("form[name='" + options.formName + "']").serialize();

            console.dir("fields ::: " + fields);

            $('div.tianos-alert-error .alert span').html('GATAZO');
            $('div.tianos-alert-error').show();

            setTimeout(function() {
                $('div.tianos-alert-error').fadeOut('slow');
            }, 2000);




            $.ajax({
                url: options.route,
                type: 'POST',
                dataType: 'html',
                data: fields,
                beforeSend: function(jqXHR, settings) {
                    // table.html(msg_loading);
                },
                success: function(data, textStatus, jqXHR) {
                    // table.html(data);
                },
                error: function(jqXHR, exception) {
                    // table.html(msg_error);
                }
            });
        };

        // Private Functions
        function debug(e) {
            console.log(e);
        }

        base.init();
    };

    // $.formTicket.defaultOptions = {
    //     buttonStyle: "border: 1px solid #fff; background-color:#000; color:#fff; padding:20px 50px",
    //     buttonPress: function () {}
    // };

    $.fn.formTicket = function(options){

        return this.each(function(){

            var bp = new $.formTicket(this, options);

            $(document).on('submit', "form[name='" + options.formName + "']" , function(event) {
                bp.submit(event);
            });

        });
    };

})(jQuery);