(function($) {
    "use strict";

    // Global Variables
    var MAX_HEIGHT = 100;

    $.formInfo = function(el, options) {

        // Global Private Variables
        var MAX_WIDTH = 200;
        var base = this;
        var modal = null;
        var msg_error = 'INFO: Oops!, no se completo el proceso. Contacte a su proveedor ';

        base.$el = $(el);
        base.el = el;
        base.$el.data('formInfo', base);

        base.init = function(){
            var totalButtons = 0;
            modal = $('#' + options.modal_info_id);

            // base.$el.append('<button name="public" style="'+base.options.buttonStyle+'">Private</button>');
        };

        base.openModal = function(event) {
            // debug(e);

            // base.options.buttonPress.call( this );
            var modalBody = modal.find('.modal-body');

            $.ajax({
                url: options.route_info,
                type: 'POST',
                dataType: 'html',
                data: '',
                beforeSend: function(jqXHR, settings) {
                    modalBody.html('<div align="center"><i class="fa fa-2x fa-refresh fa-spin"></i></div>');
                },
                success: function(data, textStatus, jqXHR) {
                    modalBody.html(data);
                },
                error: function(jqXHR, exception) {
                    modalBody.html('<p>' + msg_error + '(code 7070)</p>');
                }
            });
        };

        // Private Functions
        function debug(e) {
            console.log(e);
        }

        base.init();
    };

    // $.formInfo.defaultOptions = {
    //     buttonStyle: "border: 1px solid #fff; background-color:#000; color:#fff; padding:20px 50px",
    //     buttonPress: function () {}
    // };

    $.fn.formInfo = function(options){

        return this.each(function(){

            var bp = new $.formInfo(this, options);

            $('button.' + options.modal_info_id).click(function(event) {
                bp.openModal(event);
            });

        });

    };

})(jQuery);