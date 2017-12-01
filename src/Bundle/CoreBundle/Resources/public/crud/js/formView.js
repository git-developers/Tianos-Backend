(function($) {
    "use strict";

    // Global Variables
    var MAX_HEIGHT = 100;

    $.formView = function(el, options) {

        // Global Private Variables
        var MAX_WIDTH = 200;
        var base = this;
        var modal = null;

        var apiContent = null;

        var msg_error = '<p>INFO: Oops!, no se completo el proceso. Contacte a su proveedor (code 3030)</p>';
        var msg_loading = '<div class="modal-body" align="center"><i class="fa fa-2x fa-refresh fa-spin"></i></div>';

        base.$el = $(el);
        base.el = el;
        base.$el.data('formView', base);

        base.init = function(){
            var totalButtons = 0;
            // base.$el.append('<button name="public" style="'+base.options.buttonStyle+'">Private</button>');

            modal = $('#' + options.modal_view_id);
            apiContent = modal.find('.api-content');
        };

        base.openModal = function(event, context) {
            // debug(e);
            // base.options.buttonPress.call( this );

            var id = $(context).parent().data('id');

            $.ajax({
                url: options.route_view,
                type: 'POST',
                dataType: 'html',
                data: {
                    id:id,
                    form_data:options.form_data
                },
                beforeSend: function(jqXHR, settings) {
                    apiContent.html(msg_loading);
                },
                success: function(data, textStatus, jqXHR) {
                    apiContent.html(data);
                },
                error: function(jqXHR, exception) {
                    apiContent.html(msg_error);
                }
            });
        };

        // Private Functions
        function debug(e) {
            console.log(e);
        }

        base.init();
    };

    // $.formView.defaultOptions = {
    //     buttonStyle: "border: 1px solid #fff; background-color:#000; color:#fff; padding:20px 50px",
    //     buttonPress: function () {}
    // };

    $.fn.formView = function(options){

        return this.each(function(){

            var bp = new $.formView(this, options);

            $(document).on('click', 'td.' + options.table_td_class, function() {
                bp.openModal(event, this);
            });

        });
    };

})(jQuery);