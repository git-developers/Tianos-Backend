(function($) {
    "use strict";

    // Global Variables
    var MAX_HEIGHT = 100;

    $.boxFourSelectItem = function(el, options) {

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
        base.$el.data('boxFourSelectItem', base);

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

        base.upSerting = function(context) {
            // debug(e);
            // base.options.buttonPress.call( this );

            var boxUlOne = boxOne.find('ul');
            var boxUlTwo = boxTwo.find('ul');
            var boxUlThree = boxThree.find('ul');
            var boxUlFour = boxFour.find('ul');

            var boxThreeId = boxUlThree.find('input[type=radio]:checked').val();
            var boxFourId = $(context).parent().data('box-four-id');

            if (typeof boxThreeId == 'undefined'){

                errorMsg.html('<i class="fa fa-fw fa-warning"></i> Seleccione una facultad.');

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
                    boxThreeId: boxThreeId,
                    boxFourId: boxFourId,
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

        /*
        var isUserSelected = false;

        function setUserSelected(value) {
            isUserSelected = value;
        }
        */


        base.init();
    };

    // $.boxFourSelectItem.defaultOptions = {
    //     buttonStyle: "border: 1px solid #fff; background-color:#000; color:#fff; padding:20px 50px",
    //     buttonPress: function () {}
    // };

    $.fn.boxFourSelectItem = function(options){

        return this.each(function(){

            var bp = new $.boxFourSelectItem(this, options);

            $(document).on('click', 'li.' + options.liClass + ' > input[type=checkbox]', function(event) {
                bp.upSerting(this);
            });

        });

    };

})(jQuery);