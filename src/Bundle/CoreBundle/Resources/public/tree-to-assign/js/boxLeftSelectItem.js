(function($) {
    "use strict";

    // Global Variables
    var MAX_HEIGHT = 100;

    $.boxLeftSelectItem = function(el, options) {

        // Global Private Variables
        var MAX_WIDTH = 200;
        var DELAY = 800;
        var base = this;
        var boxLeft = null;
        var boxRight = null;

        var msg_error = '<i class="fa fa-fw fa-warning"></i> BoxLeft Error: reintentar';
        var msg_loading = '<p align="center"><i class="fa fa-1x fa-refresh fa-spin"></i></p>';

        base.$el = $(el);
        base.el = el;
        base.$el.data('boxLeftSelectItem', base);

        base.init = function(){
            var totalButtons = 0;
            // base.$el.append('<button name="public" style="'+base.options.buttonStyle+'">Private</button>');

            boxLeft = $('div#' + options.box_left_id);
            boxRight = $('div#' + options.box_right_id);
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

            var boxUl = boxRight.find('ul');
            var id = $(context).parent('li').data('id');

            $.ajax({
                url: options.route_boxleft_has_boxright,
                type: 'POST',
                dataType: 'html',
                data: {id:id},
                beforeSend: function(jqXHR, settings) {
                    boxRight.find('i.fa-refresh').show();

                    base.addClassCallout('info');
                    base.setMessageCallout(msg_loading);
                },
                success: function(data, textStatus, jqXHR) {

                    base.addClassCallout('success');
                    var spanCategory = $('span#' + options.box_li_id + '-' + id).html();
                    base.setMessageCallout('Category: ' + spanCategory);

                    boxUl.html(data);

                    boxRight.find('i.fa-refresh').hide();
                },
                error: function(jqXHR, exception) {
                    base.addClassCallout('danger');
                    base.setMessageCallout(msg_error);

                    boxRight.find('i.fa-refresh').hide();
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

            $(document).on('click', 'span.' + options.box_li_id, function(event) {

                if($(event.target).is('i')){
                    return;
                }

                bp.selectItem(this);
            });

        });

    };

})(jQuery);