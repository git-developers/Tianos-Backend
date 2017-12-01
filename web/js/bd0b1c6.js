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

            var boxUl = box.find('ul');
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
                        boxUl.html(data);
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
        var DELAY = 400;
        var base = this;
        var boxLeft = null;
        var boxRight = null;
        var msg_loading = '<p align="center"><i class="fa fa-1x fa-refresh fa-spin"></i></p>';
        var msg_error = '<i class="fa fa-fw fa-warning"></i> Buscador izquierda Error: reintentar';
        var msg_success = '<i class="fa fa-fw fa-info"></i> Selecciono item con id: ';

        base.$el = $(el);
        base.el = el;
        base.$el.data('boxLeftSelectItem', base);

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

            $(context).find('[type=radio]').prop('checked', true);

            var boxUl = boxRight.find('ul');
            var id = $(context).data('id');

            $.ajax({
                url: options.route_select_item,
                type: 'POST',
                dataType: 'html',
                data: {
                    id:id
                },
                cache: true,
                beforeSend: function(jqXHR, settings) {
                    base.setMessageCallout(msg_loading);
                },
                success: function(data, textStatus, jqXHR) {

                    boxUl.html(data);

                    base.addClassCallout('success');
                    base.setMessageCallout(msg_success + '<span class="badge bg-green-active">' + id + '</span>');

                    boxLeft.find('li').removeClass(options.box_li_class);
                    $(context).addClass(options.box_li_class);

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

            $(document).on('click', 'li.' + options.box_li_id, function(event) {
                bp.selectItem(this);
            });

        });

    };

})(jQuery);
(function($) {
    "use strict";

    // Global Variables
    var MAX_HEIGHT = 100;

    $.boxRightEdit = function(el, options) {

        // Global Private Variables
        var MAX_WIDTH = 200;
        var base = this;
        var modal = null;
        var msg_error = 'INFO: Oops!, no se completo el proceso. Contacte a su proveedor';
        var msg_loading = '<div class="modal-body" align="center"><i class="fa fa-2x fa-refresh fa-spin"></i></div>';

        base.$el = $(el);
        base.el = el;
        base.$el.data('boxRightEdit', base);

        base.init = function(){
            var totalButtons = 0;
            modal = $('#' + options.modal_edit_id);

            // base.$el.append('<button name="public" style="'+base.options.buttonStyle+'">Private</button>');
        };

        base.openModal = function(event, context) {
            // debug(e);

            var id = $(context).data('id');
            var modalForm = modal.find('.api-content');

            $.ajax({
                url: options.assoc_route_edit,
                type: 'POST',
                dataType: 'html',
                data: {id:id},
                beforeSend: function(jqXHR, settings) {
                    $('button[type="submit"]').prop('disabled', true);
                    modalForm.html(msg_loading);
                },
                success: function(data, textStatus, jqXHR) {
                    $('button[type="submit"]').prop('disabled', false);
                    modalForm.html(data);
                },
                error: function(jqXHR, exception) {
                    modalForm.html('<div class="modal-body"><p>' + msg_error + '(code 4040)</p></div>');
                }
            });

        };

        base.edit = function(event) {
            event.preventDefault();


            var modalMsgDiv = modal.find('div#message');
            var modalMsgText = modal.find('div#message p');
            var modalRefresh = modal.find('i.fa-refresh');

            var fields = $("form[name='" + options.modal_edit_form_name + "']").serializeArray();

            $.ajax({
                url: options.assoc_route_edit,
                type: 'POST',
                dataType: 'json',
                data: fields,
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
                    modalMsgText.html('<p>' + msg_error + '(code 4041)</p>');
                    modalMsgDiv.show();
                    modalRefresh.hide();
                }
            });

        };

        // Private Functions
        function debug(e) {
            console.log(e);
        }

        base.init();
    };

    // $.boxRightEdit.defaultOptions = {
    //     buttonStyle: "border: 1px solid #fff; background-color:#000; color:#fff; padding:20px 50px",
    //     buttonPress: function () {}
    // };

    $.fn.boxRightEdit = function(options){

        return this.each(function(){

            var bp = new $.boxRightEdit(this, options);

            $(document).on('click', 'i.' + options.modal_edit_id, function() {
                bp.openModal(event, this);
            });

            $(document).on('submit', "form[name='" + options.modal_edit_form_name + "']" , function(event) {
                bp.edit(event);
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

                bp.isValid(event);
                bp.selectItem(this);
            });

        });

    };

})(jQuery);