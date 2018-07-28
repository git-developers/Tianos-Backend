(function($) {
    "use strict";

    // Global Variables
    var MAX_HEIGHT = 100;

    $.boxTwoSelectItem = function(el, options) {

        // Global Private Variables
        var MAX_WIDTH = 200;
        var DELAY = 400;
        var base = this;
        // var boxOne = null;
        var boxTwo = null;
        var boxThree = null;
        var boxFour = null;
        var msgLoading = '<p align="center"><i class="fa fa-1x fa-refresh fa-spin"></i></p>';
        var msgError = '<i class="fa fa-fw fa-warning"></i> Buscador izquierda Error: reintentar';
        var msgSuccess = '<i class="fa fa-fw fa-info"></i> Selecciono item con id: ';

        base.$el = $(el);
        base.el = el;
        base.$el.data('boxTwoSelectItem', base);

        base.init = function(){
            var totalButtons = 0;
            // boxOne = $('div#' + options.boxOneId);
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

            var radioTwo = $(context).find('input[type=radio]');

            var boxUlTwo = boxTwo.find('ul');
            var boxUlThree = boxThree.find('ul');
            var id = $(context).data('id');

            $.ajax({
                url: options.routeSelectItem,
                type: 'POST',
                dataType: 'html',
                data: {
                    id:id
                },
                cache: true,
                beforeSend: function(jqXHR, settings) {
                    base.setMessageCallout(msgLoading);
                    boxUlTwo.html('<li style="text-align: center"><span class="text"><i class="fa fa-2x fa-refresh fa-spin"></i></span></li>');
                },
                success: function(data, textStatus, jqXHR) {

                    boxUlTwo.html(data);
                    boxUlThree.html('<li><span class="text">Seleccione un área académica.</span></li>');

                    radioTwo.prop('checked', true);

                    base.addClassCallout('success');
                    base.setMessageCallout(msgSuccess + '<span class="badge bg-green-active">' + id + '</span>');

                    // boxOne.find('li').removeClass(options.box_li_class);
                    // $(context).addClass(options.box_li_class);
                },
                error: function(jqXHR, exception) {
                    base.addClassCallout('danger');
                    base.setMessageCallout(msgError);
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

    // $.boxTwoSelectItem.defaultOptions = {
    //     buttonStyle: "border: 1px solid #fff; background-color:#000; color:#fff; padding:20px 50px",
    //     buttonPress: function () {}
    // };

    $.fn.boxTwoSelectItem = function(options){

        return this.each(function(){

            var bp = new $.boxTwoSelectItem(this, options);

            $(document).on('click', 'li.' + options.liClass, function(event) {
                bp.selectItem(this);
            });

        });

    };

})(jQuery);