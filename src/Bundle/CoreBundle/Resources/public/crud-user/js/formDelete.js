(function($) {
    "use strict";

    // Global Variables
    var MAX_HEIGHT = 100;

    $.formDelete = function(el, options) {

        // Global Private Variables
        var MAX_WIDTH = 200;
        var base = this;
        var modal = null;

        var apiContent = null;
        var modalMsgDiv = null;
        var modalMsgText = null;
        var modalRefresh = null;

        var msg_error = '<p>INFO: Oops!, no se completo el proceso. Contacte a su proveedor (code 3030)</p>';
        var msg_loading = '<div class="modal-body" align="center"><i class="fa fa-2x fa-refresh fa-spin"></i></div>';

        base.$el = $(el);
        base.el = el;
        base.$el.data('formDelete', base);

        base.init = function(){
            var totalButtons = 0;
            // base.$el.append('<button name="public" style="'+base.options.buttonStyle+'">Private</button>');

            modal = $('#' + options.modal_delete_id);
            apiContent = modal.find('.api-content');
        };

        base.openModal = function(event, context) {
            // debug(e);

            modalMsgDiv = modal.find('div#message');
            modalMsgText = modal.find('div#message p');
            modalRefresh = modal.find('i.fa-refresh');

            var id = $(context).parent().parent().data('id');

            modal.find('small.label').html('Item ' + id);

            $.ajax({
                url: options.route_delete,
                type: 'POST',
                dataType: 'html',
                data: {
                    id:id,
                    form_data:options.form_data
                },
                cache: true,
                beforeSend: function(jqXHR, settings) {
                    $('button[type="submit"]').prop('disabled', true);

                    modalMsgDiv.hide();
                    modalMsgText.empty();
                    apiContent.html(msg_loading);
                },
                success: function(data, textStatus, jqXHR) {
                    $('button[type="submit"]').prop('disabled', false);
                    apiContent.html(data);
                },
                error: function(jqXHR, exception) {
                    apiContent.html(msg_error);
                }
            });
        };

        base.delete = function(event) {
            event.preventDefault();

            modalMsgDiv = modal.find('div#message');
            modalMsgText = modal.find('div#message p');
            modalRefresh = modal.find('i.fa-refresh');

            var fields = $("form[name='" + options.form_delete_name + "']").serializeArray();

            $.ajax({
                url: options.route_delete,
                type: 'DELETE',
                dataType: 'json',
                data: fields,
                beforeSend: function(jqXHR, settings) {
                    $('button[type="submit"]').prop('disabled', true);
                    modalMsgDiv.hide();
                    modalMsgText.empty();
                    modalRefresh.show();
                },
                success: function(data, textStatus, jqXHR) {

                    $('button[type="submit"]').prop('disabled', false);
                    modalRefresh.hide();

                    if(data.status){
                        var row = options.table_json.row('[data-id="' + data.id + '"]');
                        row.remove().draw();
                        modal.modal('hide');
                    }else{
                        modalMsgText.html(data.errors);
                        modalMsgDiv.show();
                    }

                },
                error: function(jqXHR, exception) {
                    $('button[type="submit"]').prop('disabled', false);
                    modalMsgDiv.show();
                    modalMsgText.html(msg_error);
                    modalRefresh.hide();
                }
            });

        };

        // Private Functions
        function debug(e) {
            console.log(e);
        }

        base.init();
    };

    // $.formDelete.defaultOptions = {
    //     buttonStyle: "border: 1px solid #fff; background-color:#000; color:#fff; padding:20px 50px",
    //     buttonPress: function () {}
    // };

    $.fn.formDelete = function(options){

        return this.each(function(){

            var bp = new $.formDelete(this, options);

            $(document).on('click', 'button.' + options.modal_delete_id, function() {
                bp.openModal(event, this);
            });

            $(document).on('submit', "form[name='" + options.form_delete_name + "']" , function(event) {
                bp.delete(event);
            });

        });

    };

})(jQuery);