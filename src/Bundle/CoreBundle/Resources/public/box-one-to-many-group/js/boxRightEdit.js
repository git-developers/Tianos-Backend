(function($) {
    "use strict";

    // Global Variables
    var MAX_HEIGHT = 100;

    $.boxRightEdit = function(el, options) {

        // Global Private Variables
        var MAX_WIDTH = 200;
        var base = this;
        var modal = null;
        var msg_error = 'INFO: Oops!, no se completo el proceso. Contacte a su proveedor';
        var msg_loading = '<div class="modal-body" align="center"><i class="fa fa-2x fa-refresh fa-spin"></i></div>';

        base.$el = $(el);
        base.el = el;
        base.$el.data('boxRightEdit', base);

        base.init = function(){
            var totalButtons = 0;
            modal = $('#' + options.modal_edit_id);

            // base.$el.append('<button name="public" style="'+base.options.buttonStyle+'">Private</button>');
        };

        base.openModal = function(event, context) {
            // debug(e);

            var id = $(context).data('id');
            var modalForm = modal.find('.api-content');

            $.ajax({
                url: options.assoc_route_edit,
                type: 'POST',
                dataType: 'html',
                data: {id:id},
                beforeSend: function(jqXHR, settings) {
                    $('button[type="submit"]').prop('disabled', true);
                    modalForm.html(msg_loading);
                },
                success: function(data, textStatus, jqXHR) {
                    $('button[type="submit"]').prop('disabled', false);
                    modalForm.html(data);
                },
                error: function(jqXHR, exception) {
                    modalForm.html('<div class="modal-body"><p>' + msg_error + '(code 4040)</p></div>');
                }
            });

        };

        base.edit = function(event) {
            event.preventDefault();


            var modalMsgDiv = modal.find('div#message');
            var modalMsgText = modal.find('div#message p');
            var modalRefresh = modal.find('i.fa-refresh');

            var fields = $("form[name='" + options.modal_edit_form_name + "']").serializeArray();

            $.ajax({
                url: options.assoc_route_edit,
                type: 'POST',
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
                        modal.modal('hide');
                    }else{

                        var items = [];
                        $(data.errors).each(function(key, value) {
                            items.push($('<li/>').text(value));
                        });

                        modalMsgText.html(items);
                        modalMsgDiv.show();
                    }

                },
                error: function(jqXHR, exception) {
                    $('button[type="submit"]').prop('disabled', false);
                    modalMsgText.html('<p>' + msg_error + '(code 4041)</p>');
                    modalMsgDiv.show();
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

    // $.boxRightEdit.defaultOptions = {
    //     buttonStyle: "border: 1px solid #fff; background-color:#000; color:#fff; padding:20px 50px",
    //     buttonPress: function () {}
    // };

    $.fn.boxRightEdit = function(options){

        return this.each(function(){

            var bp = new $.boxRightEdit(this, options);

            $(document).on('click', 'i.' + options.modal_edit_id, function() {
                bp.openModal(event, this);
            });

            $(document).on('submit', "form[name='" + options.modal_edit_form_name + "']" , function(event) {
                bp.edit(event);
            });

        });

    };

})(jQuery);