(function($) {
    "use strict";

    // Global Variables
    var MAX_HEIGHT = 100;

    $.boxInfo = function(el, options) {

        // Global Private Variables
        var MAX_WIDTH = 200;
        var base = this;
        var modal = null;
        var msg_loading = '<div align="center"><i class="fa fa-2x fa-refresh fa-spin"></i></div>';
        var msg_error = 'INFO: Oops!, no se completo el proceso. Contacte a su proveedor';

        base.$el = $(el);
        base.el = el;
        base.$el.data('boxInfo', base);

        base.init = function(){
            var totalButtons = 0;
            // base.$el.append('<button name="public" style="'+base.options.buttonStyle+'">Private</button>');

            modal = $('#' + options.modal_info_id);
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
                cache: true,
                beforeSend: function(jqXHR, settings) {
                    modalBody.html(msg_loading);
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

    // $.boxInfo.defaultOptions = {
    //     buttonStyle: "border: 1px solid #fff; background-color:#000; color:#fff; padding:20px 50px",
    //     buttonPress: function () {}
    // };

    $.fn.boxInfo = function(options){

        return this.each(function(){

            var bp = new $.boxInfo(this, options);

            $('button.' + options.modal_info_id).click(function(event) {
                bp.openModal(event);
            });

        });

    };

})(jQuery);