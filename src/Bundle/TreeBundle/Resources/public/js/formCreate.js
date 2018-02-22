(function($) {
    "use strict";

    // Global Variables
    var MAX_HEIGHT = 100;

    $.formCreate = function(el, options) {

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
        base.$el.data('formCreate', base);

        base.init = function(){
            var totalButtons = 0;
            // base.$el.append('<button name="public" style="'+base.options.buttonStyle+'">Private</button>');

            modal = $('#' + options.modal_create_id);
            apiContent = modal.find('.api-content');
        };

        base.openModal = function(event) {
            // debug(e);
            // base.options.buttonPress.call( this );

            $.ajax({
                url: options.route_create,
                type: 'POST',
                dataType: 'html',
                data: '',
                cache: true,
                beforeSend: function(jqXHR, settings) {
                    $('button[type="submit"]').prop('disabled', true);
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

        base.save = function(event) {
            event.preventDefault();

            modalMsgDiv = modal.find('div#message');
            modalMsgText = modal.find('div#message p');
            modalRefresh = modal.find('i.fa-refresh');

            var fields = $("form[name='" + options.form_create_name + "']").serializeArray();

            $.ajax({
                url: options.route_create,
                type: 'POST',
                dataType: 'json',
                data: fields,
                cache: true,
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

                        var tmpl = $('#jquery_tmpl_1').tmpl(data.entity);
                        tmpl.prependTo('div.' + options.box_main_div + ' ul#' + options.box_main_ul);

                        //remove empty message
                        $('div.' + options.box_main_div).find('p').remove();

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
                    modalMsgText.html(msg_error);
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

    // $.formCreate.defaultOptions = {
    //     buttonStyle: "border: 1px solid #fff; background-color:#000; color:#fff; padding:20px 50px",
    //     buttonPress: function () {}
    // };

    $.fn.formCreate = function(options){

        return this.each(function(){

            var bp = new $.formCreate(this, options);

            $('button.' + options.modal_create_id).click(function(event) {
                bp.openModal(event);
            });

            $(document).on('submit', "form[name='" + options.form_create_name + "']" , function(event) {
                bp.save(event);
            });

        });

    };

})(jQuery);