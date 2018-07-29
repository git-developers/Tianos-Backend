(function($) {
    "use strict";

    // Global Variables
    var MAX_HEIGHT = 100;

    $.boxOneSearch = function(el, options) {

        // Global Private Variables
        var MAX_WIDTH = 200;
        var DELAY = 400;
        var base = this;
        var boxOne = null;
        var boxTwo = null;
        var boxThree = null;
        var boxFour = null;
        var globalTimeout = null;
        var msg_default = '<p><i class="fa fa-fw fa-info"></i> Seleccione un item.</p>';
        var msg_error = '<i class="fa fa-fw fa-warning"></i> Buscador izquierda Error: reintentar';

        base.$el = $(el);
        base.el = el;
        base.$el.data('boxOneSearch', base);

        base.init = function(){
            var totalButtons = 0;
            boxOne = $('div#' + options.boxOneId);
            boxTwo = $('div#' + options.boxTwoId);
            boxThree = $('div#' + options.boxThreeId);
            boxFour = $('div#' + options.boxFourId);
        };

        base.setMessageCallout = function(message){
            var div = box.find('.callout');
            div.html(message);
        };

        base.addClassCallout = function(addClass){
            var div = box.find('.callout');
            div.removeClass('callout-info').removeClass('callout-success').removeClass('callout-danger');
            div.addClass('callout-' + addClass);
        };

        base.searchBox = function(context) {
            // debug(e);
            // base.options.buttonPress.call( this );

            var boxUlOne = boxOne.find('ul');
            var boxUlTwo = boxTwo.find('ul');
            var boxUlThree = boxThree.find('ul');
            var boxUlFour = boxFour.find('ul');

            var q = $(context).val();

            if(globalTimeout != null){
                clearTimeout(globalTimeout);
            }

            globalTimeout = setTimeout(function() {

                $.ajax({
                    url: options.routeSearch,
                    type: 'POST',
                    dataType: 'html',
                    data: {
                        q:q
                    },
                    cache: true,
                    beforeSend: function(jqXHR, settings) {
                        // base.addClassCallout('info');
                        // base.setMessageCallout(msg_default);

                        boxUlOne.html('<li style="text-align: center"><span class="text"><i class="fa fa-2x fa-refresh fa-spin"></i></span></li>');

                        boxUlThree.html('<li><span class="text">Seleccione un área académica.</span></li>');
                        boxUlFour.html('<li><span class="text">Seleccione una facultad.</span></li>');
                    },
                    success: function(data, textStatus, jqXHR) {
                        boxUlOne.html(data);
                    },
                    error: function(jqXHR, exception) {
                        base.addClassCallout('danger');
                        base.setMessageCallout(msg_error);
                    }
                });

            }, DELAY);

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

    // $.boxOneSearch.defaultOptions = {
    //     buttonStyle: "border: 1px solid #fff; background-color:#000; color:#fff; padding:20px 50px",
    //     buttonPress: function () {}
    // };

    $.fn.boxOneSearch = function(options){

        return this.each(function(){

            var bp = new $.boxOneSearch(this, options);

            $('div#' + options.boxOneId + ' input[name=' + options.searchInputName + ']').keyup(function() {
                bp.searchBox(this);
            });

        });

    };

})(jQuery);