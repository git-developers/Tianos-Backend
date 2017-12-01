(function($) {
    "use strict";

    // Global Variables
    var MAX_HEIGHT = 100;

    $.boxLeftSelectItem = function(el, options) {

        // Global Private Variables
        var MAX_WIDTH = 200;
        var base = this;
        var boxLeft = null;
        var boxMiddle = null;
        var msg_loading = '<p align="center"><i class="fa fa-1x fa-refresh fa-spin"></i></p>';
        var msg_error = '<i class="fa fa-fw fa-warning"></i> Buscador izquierda Error: reintentar';

        base.$el = $(el);
        base.el = el;
        base.$el.data('boxLeftSelectItem', base);

        base.init = function(){
            var totalButtons = 0;
            boxMiddle = $('div#' + options.box_middle_id);
            boxLeft = $('div#' + options.box_left_id);
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

            $(context).find('[type=radio]').prop('checked', true);

            var id = $(context).data('id');
            var boxUl = boxMiddle.find('ul');

            $.ajax({
                url: options.route_select_item,
                type: 'POST',
                dataType: 'html',
                data: {id:id},
                cache: true,
                beforeSend: function(jqXHR, settings) {
                    base.setMessageCallout(msg_loading);
                },
                success: function(data, textStatus, jqXHR) {

                    var groupData = $(context).find('.group-selected').html();

                    base.addClassCallout('success');
                    base.setMessageCallout('Grupo: ' + groupData);

                    boxUl.html(data);
                },
                error: function(jqXHR, exception) {
                    base.addClassCallout('danger');
                    base.setMessageCallout(msg_error);
                }
            });
        };

        // Private Functions
        function debug(e) {
            console.log(e);
        }

        base.init();
    };

    // $.boxLeftSelectItem.defaultOptions = {
    //     buttonStyle: "border: 1px solid #fff; background-color:#000; color:#fff; padding:20px 50px",
    //     buttonPress: function () {}
    // };

    $.fn.boxLeftSelectItem = function(options){

        return this.each(function(){

            var bp = new $.boxLeftSelectItem(this, options);

            $(document).on('click', 'div.' + options.box_li_class, function(event) {
                bp.selectItem(this);
            });

        });

    };

})(jQuery);