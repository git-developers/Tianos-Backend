(function($) {
    "use strict";

    // Global Variables
    var MAX_HEIGHT = 100;

    $.boxInfo = function(el, options) {

        // Global Private Variables
        var MAX_WIDTH = 200;
        var base = this;
        var modal = null;
        var msg_loading = '<div align="center"><i class="fa fa-2x fa-refresh fa-spin"></i></div>';
        var msg_error = 'INFO: Oops!, no se completo el proceso. Contacte a su proveedor';

        base.$el = $(el);
        base.el = el;
        base.$el.data('boxInfo', base);

        base.init = function(){
            var totalButtons = 0;
            modal = $('#' + options.modal_info_id);

            // base.$el.append('<button name="public" style="'+base.options.buttonStyle+'">Private</button>');
        };

        base.openModal = function(event) {
            // debug(e);
            // base.options.buttonPress.call( this );

            var modalBody = modal.find('.modal-body');

            $.ajax({
                url: options.route_info,
                type: 'POST',
                dataType: 'html',
                data: '',
                cache: true,
                beforeSend: function(jqXHR, settings) {
                    modalBody.html(msg_loading);
                },
                success: function(data, textStatus, jqXHR) {
                    modalBody.html(data);
                },
                error: function(jqXHR, exception) {
                    modalBody.html('<p>' + msg_error + '(code 7070)</p>');
                }
            });
        };

        // Private Functions
        function debug(e) {
            console.log(e);
        }

        base.init();
    };

    // $.boxInfo.defaultOptions = {
    //     buttonStyle: "border: 1px solid #fff; background-color:#000; color:#fff; padding:20px 50px",
    //     buttonPress: function () {}
    // };

    $.fn.boxInfo = function(options){

        return this.each(function(){

            var bp = new $.boxInfo(this, options);

            $('button.' + options.modal_info_id).click(function(event) {
                bp.openModal(event);
            });

        });

    };

})(jQuery);
(function($) {
    "use strict";

    // Global Variables
    var MAX_HEIGHT = 100;

    $.boxLeftSearch = function(el, options) {

        // Global Private Variables
        var MAX_WIDTH = 200;
        var DELAY = 400;
        var base = this;
        var box = null;
        var globalTimeout = null;
        var msg_default = '<p><i class="fa fa-fw fa-info"></i> Seleccione un item.</p>';
        var msg_error = '<i class="fa fa-fw fa-warning"></i> Buscador izquierda Error: reintentar';

        base.$el = $(el);
        base.el = el;
        base.$el.data('boxLeftSearch', base);

        base.init = function(){
            var totalButtons = 0;
            box = $('div#' + options.box_id);
            // base.$el.append('<button name="public" style="'+base.options.buttonStyle+'">Private</button>');
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

        base.searchBox = function() {
            // debug(e);
            // base.options.buttonPress.call( this );

            var boxContent = box.find('div.box-content');
            var fields = $("form[name='" + options.form_name + "']").serializeArray();

            if(globalTimeout != null){
                clearTimeout(globalTimeout);
            }

            globalTimeout = setTimeout(function() {

                $.ajax({
                    url: options.route_search,
                    type: 'POST',
                    dataType: 'html',
                    data: {
                        fields:fields
                    },
                    cache: true,
                    beforeSend: function(jqXHR, settings) {
                        base.addClassCallout('info');
                        base.setMessageCallout(msg_default);
                    },
                    success: function(data, textStatus, jqXHR) {
                        boxContent.html(data);
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

        base.init();
    };

    // $.boxLeftSearch.defaultOptions = {
    //     buttonStyle: "border: 1px solid #fff; background-color:#000; color:#fff; padding:20px 50px",
    //     buttonPress: function () {}
    // };

    $.fn.boxLeftSearch = function(options){

        return this.each(function(){

            var bp = new $.boxLeftSearch(this, options);

            $('div#' + options.box_id + ' input[name=' + options.box_search + ']').keyup(function() {
                bp.searchBox();
            });

        });

    };

})(jQuery);
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
(function($) {
    "use strict";

    // Global Variables
    var MAX_HEIGHT = 100;

    $.boxRightSearch = function(el, options) {

        // Global Private Variables
        var MAX_WIDTH = 200;
        var DELAY = 400;
        var base = this;
        var boxLeft = null;
        var boxRight = null;
        var globalTimeout = null;
        var msg_default = '<p><i class="fa fa-fw fa-info"></i> Seleccione un item.</p>';
        var msg_error = '<i class="fa fa-fw fa-warning"></i> Buscador derecha Error: reintentar';

        base.$el = $(el);
        base.el = el;
        base.$el.data('boxRightSearch', base);

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

        base.searchBox = function() {
            // debug(e);
            // base.options.buttonPress.call( this );

            var boxUl = boxRight.find('ul');
            var fields = $("form[name='" + options.form_name + "']").serializeArray();

            if(globalTimeout != null){
                clearTimeout(globalTimeout);
            }

            globalTimeout = setTimeout(function() {

                $.ajax({
                    url: options.route_search,
                    type: 'POST',
                    dataType: 'html',
                    data: {
                        fields:fields
                    },
                    cache: true,
                    beforeSend: function(jqXHR, settings) {
                        boxRight.find('i.fa-refresh').show();
                    },
                    success: function(data, textStatus, jqXHR) {
                        boxRight.find('i.fa-refresh').hide();
                        boxUl.html(data);
                    },
                    error: function(jqXHR, exception) {
                        base.addClassCallout('danger');
                        base.setMessageCallout(msg_error);
                        boxRight.find('i.fa-refresh').hide();
                    }
                });

            }, DELAY);

        };

        // Private Functions
        function debug(e) {
            console.log(e);
        }

        base.init();
    };

    // $.boxRightSearch.defaultOptions = {
    //     buttonStyle: "border: 1px solid #fff; background-color:#000; color:#fff; padding:20px 50px",
    //     buttonPress: function () {}
    // };

    $.fn.boxRightSearch = function(options){

        return this.each(function(){

            var bp = new $.boxRightSearch(this, options);

            $('div#' + options.box_right_id + ' input[name=' + options.box_search + ']').keyup(function() {
                bp.searchBox();
            });

        });

    };

})(jQuery);
(function($) {
    "use strict";

    // Global Variables
    var MAX_HEIGHT = 100;

    $.boxMiddleUnAssign = function(el, options) {

        // Global Private Variables
        var MAX_WIDTH = 200;
        var base = this;

        base.$el = $(el);
        base.el = el;
        base.$el.data('boxMiddleUnAssign', base);

        base.init = function(){
            var totalButtons = 0;

            // base.$el.append('<button name="public" style="'+base.options.buttonStyle+'">Private</button>');
        };

        base.unAssign = function(context) {
            // debug(e);
            // base.options.buttonPress.call( this );

            var left_has_right = $(context).data('middle');
            $('#li-' + left_has_right).remove();
            $('.tooltip').remove();

            $.ajax({
                url: options.route_unassign_item,
                type: 'POST',
                dataType: 'json',
                data: {
                    left_has_right:left_has_right
                },
                cache: true,
                beforeSend: function(jqXHR, settings) {

                },
                success: function(data, textStatus, jqXHR) {
                    if(!data.status){
                        console.log('success error:');
                        console.log(data.errors);
                    }
                },
                error: function(jqXHR, exception) {
                    console.log('error info: function');
                }
            });
        };

        // Private Functions
        function debug(e) {
            console.log(e);
        }

        base.init();
    };

    // $.boxMiddleUnAssign.defaultOptions = {
    //     buttonStyle: "border: 1px solid #fff; background-color:#000; color:#fff; padding:20px 50px",
    //     buttonPress: function () {}
    // };

    $.fn.boxMiddleUnAssign = function(options){

        return this.each(function(){

            var bp = new $.boxMiddleUnAssign(this, options);

            $(document).on('click', 'i.fa-trash-o', function(event) {
                bp.unAssign(this);
            });

        });

    };

})(jQuery);