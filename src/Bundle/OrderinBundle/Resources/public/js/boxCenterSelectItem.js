(function($) {
    "use strict";

    // Global Variables
    var MAX_HEIGHT = 100;

    $.boxCenterSelectItem = function(el, options) {

        // Global Private Variables
        var MAX_WIDTH = 200;
        // var DELAY = 800;
        var base = this;
        var boxLeftId = null;
        var boxCenter = null;
        var boxRight = null;
        // var globalTimeout = null;
        var msg_default = '<p><i class="fa fa-fw fa-info"></i> Seleccione un item.</p>';
        var msg_error = '<i class="fa fa-fw fa-warning"></i> Seleccion derecha Error: reintentar';
        var msg_assign_error = '<i class="fa fa-fw fa-warning"></i> Error al asignar items.';
        var msgboxCenterNotValue = '<i class="fa fa-fw fa-warning"></i> Tiene que seleccionar un item de la izquierda.';
        var error_boxCenter_not_value = 'box_left_no_value';

        base.$el = $(el);
        base.el = el;
        base.$el.data('boxCenterSelectItem', base);

        base.init = function(){
            var totalButtons = 0;
            boxLeftId = $('div#' + options.boxLeftId);
            boxCenter = $('div#' + options.boxCenterId);
            boxRight = $('div#' + options.boxRightId);
            // base.$el.append('<button name="public" style="'+base.options.buttonStyle+'">Private</button>');
        };

        base.setMessageCallout = function(message){
            var div = boxCenter.find('.callout');
            div.html(message);
        };

        base.addClassCallout = function(addClass){
            var div = boxCenter.find('.callout');
            div.removeClass('callout-info').removeClass('callout-success').removeClass('callout-danger');
            div.addClass('callout-' + addClass);
        };

        base.selectItem = function(context) {
            // debug(e);
            // base.options.buttonPress.call( this );

            /* ****CHECKBOX TOOGLE **** */
            var checkboxRight = $(context).find('input[type=checkbox]');
            var radioCenter = $(context).find('input[type=radio]');
            var pointOfSaleId = $('#' + options.boxLeftId + ' input[name=' + options.boxLeftLiInputName + ']:checked').val();
            var userId = $(context).data('id');
            var boxUl = boxRight.find('.box-body');

            // if(checkboxRight.is(':checked')){
            //     checkboxRight.prop('checked', false);
            // }else{
            //     checkboxRight.prop('checked', true);
            // }
            /* ****CHECKBOX TOOGLE **** */



            // var checkboxAll = boxRight.find('input[type=checkbox]');
            // var boxCenterValue = $('#' + options.boxCenterId + ' input[name=' + options.boxCenterLiInputName + ']:checked').val();
            // var boxRightValues = $('#' + options.boxRightId + ' input:checkbox:checked').map(function() {
            //     return this.value;
            // }).get();


            $.ajax({
                url: options.routeSelectItem,
                type: 'POST',
                dataType: 'html',
                data: {
                    userId:userId,
                    pointOfSaleId:pointOfSaleId,
                    // boxCenterValue:boxCenterValue,
                    // boxRightValues:boxRightValues
                },
                cache: true,
                beforeSend: function(jqXHR, settings) {
                    boxUl.html('<ul class="todo-list ui-sortable"><li style="text-align: center"><span class="text"><i class="fa fa-2x fa-refresh fa-spin"></i></span></li></ul>');
                    radioCenter.prop('checked', true);
                    // boxRight.find('i.fa-refresh').show();
                },
                success: function(data, textStatus, jqXHR) {

                    // boxRight.find('i.fa-refresh').hide();

                    boxUl.html(data);

                    if(data.status){

                        // base.addClassCallout('success');
                        // base.setMessageCallout('<p><i class="fa fa-fw fa-thumbs-up"></i> Exito: <span class="badge bg-green-active">' + boxCenterValue + '</span></p>');
                        //
                        // setTimeout(function(){
                        //     base.setMessageCallout(msg_default)
                        // }, 800);

                    }else{
                        // base.addClassCallout('danger');
                        // checkboxAll.prop('checked', false);
                        // boxRight.find('li').removeClass(options.liClass);
                    }
                },
                error: function(jqXHR, exception) {
                    // base.addClassCallout('danger');
                    // base.setMessageCallout(msg_error);
                    // boxRight.find('i.fa-refresh').hide();
                }
            });
        };

        base.isValid = function(event) {

            // if (!$('input[type=radio]:checked').val()) {
            //     base.addClassCallout('danger');
            //     base.setMessageCallout(msgboxCenterNotValue);
            //
            //     event.preventDefault();
            //
            //     return false;
            // }

            return true;
        };

        // Private Functions
        function debug(e) {
            console.log(e);
        }

        base.init();
    };

    $.fn.boxCenterSelectItem = function(options){

        return this.each(function(){

            var bp = new $.boxCenterSelectItem(this, options);

            $(document).on('click', 'li.' + options.liClass, function(event) {
                bp.selectItem(this);
            });
        });
    };

})(jQuery);