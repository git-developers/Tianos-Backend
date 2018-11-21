(function($) {
    "use strict";

    // Global Variables
    var MAX_HEIGHT = 100;

    $.formServices = function(el, options) {

        // Global Private Variables
        var MAX_WIDTH = 200;
        var base = this;
        var modal = null;

        var apiContent = null;
        var modalMsgDiv = null;
        var modalMsgText = null;
        var modalRefresh = null;

        var msg_error = '<tr><td colspan="5"><p>INFO: Oops!, no se completo el proceso. Contacte a su proveedor (code 6060)</p></td></tr>';
        var msg_loading = '<div align="center"><i class="fa fa-2x fa-refresh fa-spin"></i></div>';

        base.$el = $(el);
        base.el = el;
        base.$el.data('formServices', base);

        base.init = function(){
            var totalButtons = 0;
            // base.$el.append('<button name="public" style="'+base.options.buttonStyle+'">Private</button>');

            modal = $('#' + options.modalId);
            apiContent = modal.find('div.modal-content');
        };

        base.openModal = function(event, context) {

            $.ajax({
                url: options.route,
                type: 'PUT',
                dataType: 'html',
                data: {},
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

        base.submit = function(event) {
            event.preventDefault();

            var table = $('table.box-table-service tbody');
            var fields = $("form[name='" + options.formName + "']").serialize();

            $.ajax({
                url: options.route,
                type: 'POST',
                dataType: 'html',
                data: fields,
                beforeSend: function(jqXHR, settings) {
                    table.html(msg_loading);
                },
                success: function(data, textStatus, jqXHR) {
                    table.html(data);
                    $('div#modal-create-service').modal('hide');
                },
                error: function(jqXHR, exception) {
                    table.html(msg_error);
                }
            });
        };

        base.removeService = function(context) {

            if (confirm('Esta seguro?')) {
                $(context).parents('tr').remove();
                //$('table.box-table-employee').html('<tr><td colspan="5">Seleccione un empleado.</td></tr>');
            }

            return false;
        };

        base.selectCategoryTicket = function(context) {

            var idCategory = $(context).data('category');

            $('table.service > tbody > .tr-service').hide();
            $('table.service > tbody > .tr-service-' + idCategory).show();
        };

        // Private Functions
        function debug(e) {
            console.log(e);
        }

        base.init();
    };

    // $.formServices.defaultOptions = {
    //     buttonStyle: "border: 1px solid #fff; background-color:#000; color:#fff; padding:20px 50px",
    //     buttonPress: function () {}
    // };

    $.fn.formServices = function(options){

        return this.each(function(){

            var bp = new $.formServices(this, options);

            $(document).on('click', 'span.add-services', function(event) {
                bp.openModal(event, this);
            });

            $(document).on('click', 'button.btn-remove-services', function(event) {
                bp.removeService(this);
            });

            $(document).on('click', 'li.category-ticket', function(event) {
                event.stopPropagation();

                bp.selectCategoryTicket(this);
            });

            $(document).on('submit', "form[name='" + options.formName + "']" , function(event) {
                bp.submit(event);
            });

        });
    };

})(jQuery);