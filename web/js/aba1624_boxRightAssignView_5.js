(function($) {
    "use strict";

    // Global Variables
    var MAX_HEIGHT = 100;

    $.boxRightAssignView = function(el, options) {

        // Global Private Variables
        var MAX_WIDTH = 200;
        var base = this;
        var modal = null;
        var msg_error = 'INFO: Oops!, no se completo el proceso. Contacte a su proveedor';
        var msg_loading = '<div align="center"><i class="fa fa-2x fa-refresh fa-spin"></i></div>';

        base.$el = $(el);
        base.el = el;
        base.$el.data('boxRightAssignView', base);

        base.init = function(){
            var totalButtons = 0;
            // base.$el.append('<button name="public" style="'+base.options.buttonStyle+'">Private</button>');

            modal = $('#' + options.modal_assign_view_id);
        };

        base.openModal = function(event, context) {
            // debug(e);
            // base.options.buttonPress.call( this );

            modal.modal('show');
            var id = $(context).data('id');
            var modalBody = modal.find('.modal-body');

            $.ajax({
                url: options.route_assign_view,
                type: 'POST',
                dataType: 'html',
                data: {id:id},
                beforeSend: function(jqXHR, settings) {
                    modalBody.html(msg_loading);
                },
                success: function(data, textStatus, jqXHR) {
                    modalBody.html(data);
                },
                error: function(jqXHR, exception) {
                    modalBody.html('<p>' + msg_error + '(code 6060)</p>');
                }
            });
        };

        base.isValid = function(event) {


        };

        base.clearModal = function() {
            var modalBody = modal.find('.modal-body');
            modalBody.html('');
        };

        // Private Functions
        function debug(e) {
            console.log(e);
        }

        base.init();
    };

    // $.boxRightAssignView.defaultOptions = {
    //     buttonStyle: "border: 1px solid #fff; background-color:#000; color:#fff; padding:20px 50px",
    //     buttonPress: function () {}
    // };

    $.fn.boxRightAssignView = function(options){

        return this.each(function(){

            var bp = new $.boxRightAssignView(this, options);

            $(document).on('hidden.bs.modal', 'div#' + options.modal_assign_view_id, function(event) {
                bp.clearModal();
            });

            $(document).on('click', 'ul#' + options.box_main_ul + ' li', function(event) {
                event.stopPropagation();

                if(!$(event.target).is('i')){
                    bp.openModal(event, this);
                }

            });

        });

    };

})(jQuery);