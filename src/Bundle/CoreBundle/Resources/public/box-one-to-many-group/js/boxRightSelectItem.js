(function($) {
    "use strict";

    // Global Variables
    var MAX_HEIGHT = 100;

    $.boxRightSelectItem = function(el, options) {

        // Global Private Variables
        var MAX_WIDTH = 200;
        var DELAY = 800;
        var base = this;
        var boxLeft = null;
        var boxRight = null;
        var globalTimeout = null;
        var msg_error = '<i class="fa fa-fw fa-warning"></i> Seleccion derecha Error: reintentar';
        var msg_boxleft_not_value = '<i class="fa fa-fw fa-warning"></i> Tiene que seleccionar un item de la izquierda.';
        var msg_assign_error = '<i class="fa fa-fw fa-warning"></i> Error al asignar items.';
        var error_boxleft_not_value = 'box_left_no_value';

        base.$el = $(el);
        base.el = el;
        base.$el.data('boxRightSelectItem', base);

        base.init = function(){
            var totalButtons = 0;
            boxLeft = $('div#' + options.box_left_id);
            boxRight = $('div#' + options.box_right_id);
            // base.$el.append('<button name="public" style="'+base.options.buttonStyle+'">Private</button>');
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

        base.selectItem = function(context) {
            // debug(e);
            // base.options.buttonPress.call( this );

            var checkbox = $(context).find('input[type=checkbox]');
            var checkboxHidden = $(context).find('input[name=' + options.box_value_hidden + ']');
            var checkboxAll = boxRight.find('input[type=checkbox]');

            var id = checkbox.val();

            if (checkbox.is(':checked')) {
                checkbox.prop('checked', false);
                $(context).removeClass(options.box_li_class);
                checkboxHidden.val(id + options.box_separator + options.action.delete);

                var tools = $(context).find('div.tools');
                tools.hide();
            }else{
                checkbox.prop('checked', true);
                $(context).addClass(options.box_li_class);
                checkboxHidden.val(id + options.box_separator + options.action.create);
            }

            var fields = $("form[name='" + options.form_name + "']").serializeArray();

            if(globalTimeout != null){
                clearTimeout(globalTimeout);
            }

            globalTimeout = setTimeout(function() {

                $.ajax({
                    url: options.route_select_item,
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        fields:fields
                    },
                    cache: true,
                    beforeSend: function(jqXHR, settings) {
                        boxRight.find('i.fa-refresh').show();
                    },
                    success: function(data, textStatus, jqXHR) {
                        boxRight.find('i.fa-refresh').hide();

                        if(!data.status){

                            base.addClassCallout('danger');
                            checkboxAll.prop('checked', false);
                            boxRight.find('li').removeClass(options.box_li_class);

/*                            if(jQuery.inArray(error_boxleft_not_value, data.errors) > -1){
                                base.setMessageCallout(msg_boxleft_not_value);
                            }else{
                                base.setMessageCallout(msg_assign_error);
                            }*/
                        }
                    },
                    error: function(jqXHR, exception) {
                        base.addClassCallout('danger');
                        base.setMessageCallout(msg_error);
                        boxRight.find('i.fa-refresh').hide();
                    }
                });

            }, DELAY);

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

    // $.boxRightSelectItem.defaultOptions = {
    //     buttonStyle: "border: 1px solid #fff; background-color:#000; color:#fff; padding:20px 50px",
    //     buttonPress: function () {}
    // };

    $.fn.boxRightSelectItem = function(options){

        return this.each(function(){

            var bp = new $.boxRightSelectItem(this, options);

            $(document).on('click', 'li.' + options.box_li_id, function(event) {

                if($(event.target).is('i')){
                    return;
                }

                // bp.isValid(event);
                bp.selectItem(this);
            });

        });

    };

})(jQuery);