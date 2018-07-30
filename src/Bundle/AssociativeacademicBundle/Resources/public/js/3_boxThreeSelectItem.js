(function($) {
    "use strict";

    // Global Variables
    var MAX_HEIGHT = 100;

    $.boxThreeSelectItem = function(el, options) {

        // Global Private Variables
        var MAX_WIDTH = 200;
        var DELAY = 400;
        var base = this;
        var errorMsg = null;
        var successMsg = null;
        var boxOne = null;
        var boxTwo = null;
        var boxThree = null;
        var boxFour = null;
        var msgLoading = '<p align="center"><i class="fa fa-1x fa-refresh fa-spin"></i></p>';
        var msgError = '<i class="fa fa-fw fa-warning"></i> Buscador izquierda Error: reintentar';
        var msgSuccess = '<i class="fa fa-fw fa-info"></i> Selecciono item con id: ';

        base.$el = $(el);
        base.el = el;
        base.$el.data('boxThreeSelectItem', base);

        base.init = function(){
            var totalButtons = 0;
            errorMsg = $('small.error');
            successMsg = $('small.success');
            boxOne = $('div#' + options.boxOneId);
            boxTwo = $('div#' + options.boxTwoId);
            boxThree = $('div#' + options.boxThreeId);
            boxFour = $('div#' + options.boxFourId);
            // base.$el.append('<button name="public" style="'+base.options.buttonStyle+'">Private</button>');
        };

        base.setMessageCallout = function(message){
            var div = boxOne.find('.callout');
            div.html(message);
        };

        base.addClassCallout = function(addClass){
            var div = boxOne.find('.callout');
            div.removeClass('callout-info').removeClass('callout-success').removeClass('callout-danger');
            div.addClass('callout-' + addClass);
        };

        base.selectItem = function(context) {
            // debug(e);
            // base.options.buttonPress.call( this );

            // var checkboxTwo = $(context).find('input[type=checkbox]');

            var boxUlTwo = boxTwo.find('ul');
            var boxUlThree = boxThree.find('ul');
            var boxUlFour = boxFour.find('ul');
            var boxThreeId = $(context).parent().parent().data('box-three-id');
            var radioThree = $(context).parent().parent().find('input[type=radio]');

            $.ajax({
                url: options.routeSelectItem,
                type: 'POST',
                dataType: 'html',
                data: {
                    boxThreeId:boxThreeId
                },
                cache: true,
                beforeSend: function(jqXHR, settings) {
                    // base.setMessageCallout(msgLoading);
                    boxUlFour.html('<li style="text-align: center"><span class="text"><i class="fa fa-2x fa-refresh fa-spin"></i></span></li>');
                },
                success: function(data, textStatus, jqXHR) {

                    radioThree.prop('checked', true);
                    boxUlThree.find('li').css('background-color', 'unset');
                    $(context).parent().parent().css('background-color', '#ddd');

                    boxUlFour.html(data);
                    // boxUlFour.html('<li><span class="text">Seleccione una facultad dddd.</span></li>');

                    // base.addClassCallout('success');
                    // base.setMessageCallout(msgSuccess + '<span class="badge bg-green-active">' + boxThreeId + '</span>');
                },
                error: function(jqXHR, exception) {
                    // base.addClassCallout('danger');
                    // base.setMessageCallout(msgError);
                }
            });

        };

        base.upSerting = function(context) {
            // debug(e);
            // base.options.buttonPress.call( this );

            var boxUlOne = boxOne.find('ul');
            var boxUlTwo = boxTwo.find('ul');
            var boxUlThree = boxThree.find('ul');
            var boxUlFour = boxFour.find('ul');

            // var boxTwoId = boxUlTwo.find('input:checked').val();
            var boxTwoId = boxUlTwo.find('input[type=radio]:checked').val();
            var boxThreeId = $(context).parent().data('box-three-id');

            console.log("boxTwoId:: " + boxTwoId);

            if (typeof boxTwoId == 'undefined'){

                errorMsg.html('<i class="fa fa-fw fa-warning"></i> Seleccione un área académica.');

                setTimeout(function(){
                    errorMsg.html('');
                }, 1000);

                boxUlTwo.find('input:checkbox').attr('checked', false);

                return false;
            }

            $.ajax({
                url: options.routeUpSerting,
                type: 'POST',
                dataType: 'json',
                data: {
                    boxTwoId: boxTwoId,
                    boxThreeId: boxThreeId,
                    isChecked: $(context).is(':checked')
                },
                cache: true,
                beforeSend: function(jqXHR, settings) {

                },
                success: function(data, textStatus, jqXHR) {

                    if (data.status) {
                        successMsg.html('<i class="fa fa-fw fa-check"></i> Se guardo.');

                        setTimeout(function(){
                            successMsg.html('');
                        }, 1000);
                    }

                },
                error: function(jqXHR, exception) {
                    // base.addClassCallout('danger');
                    // base.setMessageCallout(msgError);
                }
            });
        };

        // Private Functions
        function debug(e) {
            console.log(e);
        }

        base.radioButtonClick = function(context) {
            var boxUlThree = boxThree.find('ul');

            boxUlThree.find('li').css('background-color', 'unset');
            $(context).parent().css('background-color', '#ddd');
        };

        base.init();
    };

    // $.boxThreeSelectItem.defaultOptions = {
    //     buttonStyle: "border: 1px solid #fff; background-color:#000; color:#fff; padding:20px 50px",
    //     buttonPress: function () {}
    // };

    $.fn.boxThreeSelectItem = function(options){

        return this.each(function(){

            var bp = new $.boxThreeSelectItem(this, options);

            $(document).on('click', 'li.' + options.liClass + ' > .tools > i', function(event) {
                bp.selectItem(this);
            });

            $(document).on('click', 'li.' + options.liClass + ' > input[type=checkbox]', function(event) {
                bp.upSerting(this);
            });

            $(document).on('click', 'li.' + options.liClass + ' > input[type=radio]', function(event) {
                bp.radioButtonClick(this);
            });

        });

    };

})(jQuery);