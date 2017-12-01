(function($) {
    "use strict";

    // Global Variables
    var MAX_HEIGHT = 100;

    $.boxRightAssign = function(el, options) {

        // Global Private Variables
        var MAX_WIDTH = 200;
        var base = this;
        var modal = null;
        var boxLeft = null;
        var msg_loading = '<div align="center"><i class="fa fa-2x fa-refresh fa-spin"></i></div>';
        var msg_error = 'INFO: Oops!, no se completo el proceso. Contacte a su proveedor';
        var msg_boxleft_not_value = '<i class="fa fa-fw fa-warning"></i> Tiene que seleccionar un item de la izquierda.';

        base.$el = $(el);
        base.el = el;
        base.$el.data('boxRightAssign', base);

        base.init = function(){
            var totalButtons = 0;
            // base.$el.append('<button name="public" style="'+base.options.buttonStyle+'">Private</button>');

            modal = $('#' + options.modal_assign_id);
            boxLeft = $('div#' + options.box_left_id);
        };

        base.setMessageCallout = function(message){
            var div = boxLeft.find('.callout');
            div.html(message);
        };

        base.addClassCallout = function(addClass){
            var div = boxLeft.find('.callout');
            div.removeClass('callout-info').removeClass('callout-success').removeClass('callout-danger');
            div.addClass('callout-' + addClass);
        };

        base.selectLi = function(context) {
            var radio = $(context).find('input[type=radio]');
            radio.prop("checked", true);
        };

        base.openModal = function(event) {
            // debug(e);
            // base.options.buttonPress.call( this );

            var modalMsgDiv = modal.find('div#message');
            var modalMsgText = modal.find('div#message p');

            var modalForm = modal.find('.api-content');
            var fields = $("form[name='" + options.form_name + "']").serializeArray();

            $.ajax({
                url: options.route_assign,
                type: 'POST',
                dataType: 'html',
                data: {
                    fields:fields
                },
                cache: true,
                beforeSend: function(jqXHR, settings) {
                    $('button[type="submit"]').prop('disabled', true);

                    modalMsgDiv.hide();
                    modalMsgText.empty();
                    modalForm.html(msg_loading);
                },
                success: function(data, textStatus, jqXHR) {
                    $('button[type="submit"]').prop('disabled', false);
                    modalForm.html(data);
                },
                error: function(jqXHR, exception) {
                    modalForm.html('<p>' + msg_error + '(code 3030)</p>');
                }
            });
        };

        base.save = function(event) {
            event.preventDefault();

            var modalMsgDiv = modal.find('div#message');
            var modalMsgText = modal.find('div#message p');
            var modalRefresh = modal.find('i.fa-refresh');

            var fields = $("form[name='" + options.form_assign_name + "']").serializeArray();

            $.ajax({
                url: options.route_assign,
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

                        //remove empty message
                        $('div.' + options.box_main_div).find('p.empty').remove();

                        var tmpl = $('#tmpl_jquery_1').tmpl(data.entity);
                        tmpl.prependTo('div.' + options.box_main_div + ' ul#' + options.box_main_ul);

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
                    modalMsgText.html('<p>' + msg_error + '(code 3031)</p>');
                    modalMsgDiv.show();
                    modalRefresh.hide();
                }
            });

        };

        base.isValid = function(event) {

            if (!$('input[type=radio]:checked').val()) {
                base.addClassCallout('danger');
                base.setMessageCallout(msg_boxleft_not_value);

                event.preventDefault();

                return;
            }
        };

        // Private Functions
        function debug(e) {
            console.log(e);
        }

        base.init();
    };

    // $.boxRightAssign.defaultOptions = {
    //     buttonStyle: "border: 1px solid #fff; background-color:#000; color:#fff; padding:20px 50px",
    //     buttonPress: function () {}
    // };

    $.fn.boxRightAssign = function(options){

        return this.each(function(){

            var bp = new $.boxRightAssign(this, options);

            $('button.' + options.modal_assign_id).click(function(event) {
                bp.isValid(event);
                bp.openModal(event);
            });

            $(document).on('click', 'ul.' + options.modal_assign_class + ' li' , function(event) {
                bp.selectLi(this);
            });

            $(document).on('submit', "form[name='" + options.form_assign_name + "']" , function(event) {
                bp.save(event);
            });

            $(document).on('show.bs.modal', 'div#' + options.modal_assign_id, function(event) {
                bp.isValid(event);
            });

        });

    };

})(jQuery);