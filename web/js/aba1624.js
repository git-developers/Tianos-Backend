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
            // base.$el.append('<button name="public" style="'+base.options.buttonStyle+'">Private</button>');

            modal = $('#' + options.modal_info_id);
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

            var boxUl = boxRight.find('ul');
            var id = $(context).data('id');
            var radio = $(context).find('input[type=radio]');

            $.ajax({
                url: options.route_select_item,
                type: 'POST',
                dataType: 'html',
                data: {
                    id:id
                },
                cache: true,
                beforeSend: function(jqXHR, settings) {
                    boxRight.find('i.fa-refresh').show();

                    base.setMessageCallout(msg_loading);
                },
                success: function(data, textStatus, jqXHR) {

                    base.addClassCallout('success');
                    base.setMessageCallout(msg_success + '<span class="badge bg-green-active">' + id + '</span>');

                    boxUl.html(data);

                    radio.prop('checked', true);

                    boxLeft.find('li').removeClass(options.box_li_class);
                    $(context).addClass(options.box_li_class);

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

    $.boxRightAssign = function(el, options) {

        // Global Private Variables
        var MAX_WIDTH = 200;
        var base = this;
        var modal = null;
        var boxLeft = null;
        var msg_loading = '<div align="center"><i class="fa fa-2x fa-refresh fa-spin"></i></div>';
        var msg_error = 'INFO: Oops!, no se completo el proceso. Contacte a su proveedor';
        var msg_boxleft_not_value = '<i class="fa fa-fw fa-warning"></i> Tiene que seleccionar un item de la izquierda.';

        base.$el = $(el);
        base.el = el;
        base.$el.data('boxRightAssign', base);

        base.init = function(){
            var totalButtons = 0;
            // base.$el.append('<button name="public" style="'+base.options.buttonStyle+'">Private</button>');

            modal = $('#' + options.modal_assign_id);
            boxLeft = $('div#' + options.box_left_id);
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

        base.selectLi = function(context) {
            var radio = $(context).find('input[type=radio]');
            radio.prop("checked", true);
        };

        base.openModal = function(event) {
            // debug(e);
            // base.options.buttonPress.call( this );

            var modalMsgDiv = modal.find('div#message');
            var modalMsgText = modal.find('div#message p');

            var modalForm = modal.find('.api-content');
            var fields = $("form[name='" + options.form_name + "']").serializeArray();

            $.ajax({
                url: options.route_assign,
                type: 'POST',
                dataType: 'html',
                data: {
                    fields:fields
                },
                cache: true,
                beforeSend: function(jqXHR, settings) {
                    $('button[type="submit"]').prop('disabled', true);

                    modalMsgDiv.hide();
                    modalMsgText.empty();
                    modalForm.html(msg_loading);
                },
                success: function(data, textStatus, jqXHR) {
                    $('button[type="submit"]').prop('disabled', false);
                    modalForm.html(data);
                },
                error: function(jqXHR, exception) {
                    modalForm.html('<p>' + msg_error + '(code 3030)</p>');
                }
            });
        };

        base.save = function(event) {
            event.preventDefault();

            var modalMsgDiv = modal.find('div#message');
            var modalMsgText = modal.find('div#message p');
            var modalRefresh = modal.find('i.fa-refresh');

            var fields = $("form[name='" + options.form_assign_name + "']").serializeArray();

            $.ajax({
                url: options.route_assign,
                type: 'POST',
                dataType: 'json',
                data: fields,
                cache: true,
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

                        //remove empty message
                        $('div.' + options.box_main_div).find('p.empty').remove();

                        var tmpl = $('#tmpl_jquery_1').tmpl(data.entity);
                        tmpl.prependTo('div.' + options.box_main_div + ' ul#' + options.box_main_ul);

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
                    modalMsgText.html('<p>' + msg_error + '(code 3031)</p>');
                    modalMsgDiv.show();
                    modalRefresh.hide();
                }
            });

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

    // $.boxRightAssign.defaultOptions = {
    //     buttonStyle: "border: 1px solid #fff; background-color:#000; color:#fff; padding:20px 50px",
    //     buttonPress: function () {}
    // };

    $.fn.boxRightAssign = function(options){

        return this.each(function(){

            var bp = new $.boxRightAssign(this, options);

            $('button.' + options.modal_assign_id).click(function(event) {
                bp.isValid(event);
                bp.openModal(event);
            });

            $(document).on('click', 'ul.' + options.modal_assign_class + ' li' , function(event) {
                bp.selectLi(this);
            });

            $(document).on('submit', "form[name='" + options.form_assign_name + "']" , function(event) {
                bp.save(event);
            });

            $(document).on('show.bs.modal', 'div#' + options.modal_assign_id, function(event) {
                bp.isValid(event);
            });

        });

    };

})(jQuery);
(function($) {
    "use strict";

    // Global Variables
    var MAX_HEIGHT = 100;

    $.boxRightAssignView = function(el, options) {

        // Global Private Variables
        var MAX_WIDTH = 200;
        var base = this;
        var modal = null;
        var msg_error = 'INFO: Oops!, no se completo el proceso. Contacte a su proveedor';
        var msg_loading = '<div align="center"><i class="fa fa-2x fa-refresh fa-spin"></i></div>';

        base.$el = $(el);
        base.el = el;
        base.$el.data('boxRightAssignView', base);

        base.init = function(){
            var totalButtons = 0;
            // base.$el.append('<button name="public" style="'+base.options.buttonStyle+'">Private</button>');

            modal = $('#' + options.modal_assign_view_id);
        };

        base.openModal = function(event, context) {
            // debug(e);
            // base.options.buttonPress.call( this );

            modal.modal('show');
            var id = $(context).data('id');
            var modalBody = modal.find('.modal-body');

            $.ajax({
                url: options.route_assign_view,
                type: 'POST',
                dataType: 'html',
                data: {id:id},
                beforeSend: function(jqXHR, settings) {
                    modalBody.html(msg_loading);
                },
                success: function(data, textStatus, jqXHR) {
                    modalBody.html(data);
                },
                error: function(jqXHR, exception) {
                    modalBody.html('<p>' + msg_error + '(code 6060)</p>');
                }
            });
        };

        base.isValid = function(event) {


        };

        base.clearModal = function() {
            var modalBody = modal.find('.modal-body');
            modalBody.html('');
        };

        // Private Functions
        function debug(e) {
            console.log(e);
        }

        base.init();
    };

    // $.boxRightAssignView.defaultOptions = {
    //     buttonStyle: "border: 1px solid #fff; background-color:#000; color:#fff; padding:20px 50px",
    //     buttonPress: function () {}
    // };

    $.fn.boxRightAssignView = function(options){

        return this.each(function(){

            var bp = new $.boxRightAssignView(this, options);

            $(document).on('hidden.bs.modal', 'div#' + options.modal_assign_view_id, function(event) {
                bp.clearModal();
            });

            $(document).on('click', 'ul#' + options.box_main_ul + ' li', function(event) {
                event.stopPropagation();

                if(!$(event.target).is('i')){
                    bp.openModal(event, this);
                }

            });

        });

    };

})(jQuery);
(function($) {
    "use strict";

    // Global Variables
    var MAX_HEIGHT = 100;

    $.boxRightAssignEdit = function(el, options) {

        // Global Private Variables
        var MAX_WIDTH = 200;
        var base = this;
        var modal = null;
        var boxLeft = null;
        var msg_loading = '<div align="center"><i class="fa fa-2x fa-refresh fa-spin"></i></div>';
        var msg_error = 'INFO: Oops!, no se completo el proceso. Contacte a su proveedor';
        var msg_boxleft_not_value = '<i class="fa fa-fw fa-warning"></i> Tiene que seleccionar un item de la izquierda.';

        base.$el = $(el);
        base.el = el;
        base.$el.data('boxRightAssignEdit', base);

        base.init = function(){
            var totalButtons = 0;
            // base.$el.append('<button name="public" style="'+base.options.buttonStyle+'">Private</button>');

            modal = $('#' + options.modal_assign_edit_id);
            boxLeft = $('div#' + options.box_left_id);
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

        base.selectLi = function(context) {
            var radio = $(context).find('input[type=radio]');
            radio.prop("checked", true);
        };

        base.openModal = function(context) {
            // debug(e);
            // base.options.buttonPress.call( this );

            var modalMsgDiv = modal.find('div#message');
            var modalMsgText = modal.find('div#message p');

            var modalForm = modal.find('.api-content');
            var id = $(context).parent('div').parent('span').parent('li').data('id');

            var modalLabel = modal.find('small.label');
            modalLabel.html(id);

            $.ajax({
                url: options.route_assign_edit,
                type: 'POST',
                dataType: 'html',
                data: {
                    id:id
                },
                cache: true,
                beforeSend: function(jqXHR, settings) {
                    $('button[type="submit"]').prop('disabled', true);

                    modalMsgDiv.hide();
                    modalMsgText.empty();
                    modalForm.html(msg_loading);
                },
                success: function(data, textStatus, jqXHR) {
                    $('button[type="submit"]').prop('disabled', false);
                    modalForm.html(data);
                },
                error: function(jqXHR, exception) {
                    modalForm.html('<p>' + msg_error + '(code 3030)</p>');
                }
            });
        };

        base.save = function(event) {
            event.preventDefault();

            var modalMsgDiv = modal.find('div#message');
            var modalMsgText = modal.find('div#message p');
            var modalRefresh = modal.find('i.fa-refresh');

            var fields = $("form[name='" + options.form_assign_edit_name + "']").serializeArray();

            $.ajax({
                url: options.route_assign_edit,
                type: 'POST',
                dataType: 'json',
                data: fields,
                cache: true,
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
                    modalMsgText.html('<p>' + msg_error + '(code 3031)</p>');
                    modalMsgDiv.show();
                    modalRefresh.hide();
                }
            });

        };

        base.isValid = function(event) {

            /*
            if (!$('input[type=radio]:checked').val()) {
                base.addClassCallout('danger');
                base.setMessageCallout(msg_boxleft_not_value);

                event.preventDefault();

                return;
            }
            */
        };

        // Private Functions
        function debug(e) {
            console.log(e);
        }

        base.init();
    };

    // $.boxRightAssignEdit.defaultOptions = {
    //     buttonStyle: "border: 1px solid #fff; background-color:#000; color:#fff; padding:20px 50px",
    //     buttonPress: function () {}
    // };

    $.fn.boxRightAssignEdit = function(options){

        return this.each(function(){

            var bp = new $.boxRightAssignEdit(this, options);

            $(document).on('click', 'i.' + options.modal_assign_edit_id, function() {
                bp.isValid(event);
                bp.openModal(this);
            });

            // $(document).on('click', 'ul.' + options.modal_assign_class + ' li' , function(event) {
            //     bp.selectLi(this);
            // });

            $(document).on('submit', "form[name='" + options.form_assign_edit_name + "']" , function(event) {
                bp.save(event);
            });

            // $(document).on('show.bs.modal', 'div#' + options.modal_assign_id, function(event) {
            //     bp.isValid(event);
            // });

        });

    };

})(jQuery);
(function($) {
    "use strict";

    // Global Variables
    var MAX_HEIGHT = 100;

    $.boxRightAssignChild = function(el, options) {

        // Global Private Variables
        var MAX_WIDTH = 200;
        var base = this;
        var modal = null;
        var boxLeft = null;
        var msg_loading = '<div align="center"><i class="fa fa-2x fa-refresh fa-spin"></i></div>';
        var msg_error = 'INFO: Oops!, no se completo el proceso. Contacte a su proveedor';
        var msg_boxleft_not_value = '<i class="fa fa-fw fa-warning"></i> Tiene que seleccionar un item de la izquierda.';

        base.$el = $(el);
        base.el = el;
        base.$el.data('boxRightAssignChild', base);

        base.init = function(){
            var totalButtons = 0;
            // base.$el.append('<button name="public" style="'+base.options.buttonStyle+'">Private</button>');

            modal = $('#' + options.modal_assign_child_id);
            boxLeft = $('div#' + options.box_left_id);
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

        base.selectLi = function(context) {
            var radio = $(context).find('input[type=radio]');
            radio.prop("checked", true);
        };

        base.openModal = function(context) {
            // debug(e);
            // base.options.buttonPress.call( this );

            var parent = $(context).parent('div').parent('span').parent('li').data('id');

            var modalLabel = modal.find('small.label');
            modalLabel.html('Parent ' + parent);

            var modalMsgDiv = modal.find('div#message');
            var modalMsgText = modal.find('div#message p');

            var modalForm = modal.find('.api-content');
            var fields = $("form[name='" + options.form_name + "']").serializeArray();

            $.ajax({
                url: options.route_assign_child,
                type: 'POST',
                dataType: 'html',
                data: {
                    fields:fields,
                    parent:parent
                },
                cache: true,
                beforeSend: function(jqXHR, settings) {
                    $('button[type="submit"]').prop('disabled', true);

                    modalMsgDiv.hide();
                    modalMsgText.empty();
                    modalForm.html(msg_loading);
                },
                success: function(data, textStatus, jqXHR) {
                    $('button[type="submit"]').prop('disabled', false);
                    modalForm.html(data);
                },
                error: function(jqXHR, exception) {
                    modalForm.html('<p>' + msg_error + '(code 3030)</p>');
                }
            });
        };

        base.save = function(event) {
            event.preventDefault();

            var modalMsgDiv = modal.find('div#message');
            var modalMsgText = modal.find('div#message p');
            var modalRefresh = modal.find('i.fa-refresh');

            var fields = $("form[name='" + options.form_assign_child_name + "']").serializeArray();

            $.ajax({
                url: options.route_assign_child,
                type: 'POST',
                dataType: 'json',
                data: fields,
                cache: true,
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

                        //remove empty message
                        $('div.' + options.box_main_div).find('p.empty').remove();

                        var tmpl = $('#tmpl_jquery_1').tmpl(data.entity);
                        tmpl.prependTo('div.' + options.box_main_div + ' ul.' + options.box_child_ul + data.parent_id);

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
                    modalMsgText.html('<p>' + msg_error + '(code 3031)</p>');
                    modalMsgDiv.show();
                    modalRefresh.hide();
                }
            });

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

    // $.boxRightAssignChild.defaultOptions = {
    //     buttonStyle: "border: 1px solid #fff; background-color:#000; color:#fff; padding:20px 50px",
    //     buttonPress: function () {}
    // };

    $.fn.boxRightAssignChild = function(options){

        return this.each(function(){

            var bp = new $.boxRightAssignChild(this, options);

            $(document).on('click', 'i.' + options.modal_assign_child_id, function(event) {
                bp.isValid(event);
                bp.openModal(this);
            });

            $(document).on('click', 'ul.' + options.modal_assign_class + ' li' , function(event) {
                bp.selectLi(this);
            });

            $(document).on('submit', "form[name='" + options.form_assign_child_name + "']" , function(event) {
                bp.save(event);
            });

            $(document).on('show.bs.modal', 'div#' + options.modal_assign_child_id, function(event) {
                bp.isValid(event);
            });

        });

    };

})(jQuery);
(function($) {
    "use strict";

    // Global Variables
    var MAX_HEIGHT = 100;

    $.boxRightUnAssign = function(el, options) {

        // Global Private Variables
        var MAX_WIDTH = 200;
        var base = this;

        base.$el = $(el);
        base.el = el;
        base.$el.data('boxRightUnAssign', base);

        base.init = function(){
            var totalButtons = 0;
            // base.$el.append('<button name="public" style="'+base.options.buttonStyle+'">Private</button>');
        };

        base.unAssign = function(context) {
            // debug(e);
            // base.options.buttonPress.call( this );

            var left_has_right = $(context).parent('div').parent('span').parent('li').data('id');
            $('#li-' + left_has_right).remove();
            $('.tooltip').remove();

            $.ajax({
                url: options.route_unassign,
                type: 'DELETE',
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

    // $.boxRightUnAssign.defaultOptions = {
    //     buttonStyle: "border: 1px solid #fff; background-color:#000; color:#fff; padding:20px 50px",
    //     buttonPress: function () {}
    // };

    $.fn.boxRightUnAssign = function(options){

        return this.each(function(){

            var bp = new $.boxRightUnAssign(this, options);

            $(document).on('click', 'i.' + options.modal_unassign_child_id, function() {
                bp.unAssign(this);
            });

        });

    };

})(jQuery);
/*
 * jQuery Templates Plugin 1.0.0pre
 * http://github.com/jquery/jquery-tmpl
 * Requires jQuery 1.4.2
 *
 * Copyright Software Freedom Conservancy, Inc.
 * Dual licensed under the MIT or GPL Version 2 licenses.
 * http://jquery.org/license
 */
(function(a){var r=a.fn.domManip,d="_tmplitem",q=/^[^<]*(<[\w\W]+>)[^>]*$|\{\{\! /,b={},f={},e,p={key:0,data:{}},i=0,c=0,l=[];function g(g,d,h,e){var c={data:e||(e===0||e===false)?e:d?d.data:{},_wrap:d?d._wrap:null,tmpl:null,parent:d||null,nodes:[],calls:u,nest:w,wrap:x,html:v,update:t};g&&a.extend(c,g,{nodes:[],parent:d});if(h){c.tmpl=h;c._ctnt=c._ctnt||c.tmpl(a,c);c.key=++i;(l.length?f:b)[i]=c}return c}a.each({appendTo:"append",prependTo:"prepend",insertBefore:"before",insertAfter:"after",replaceAll:"replaceWith"},function(f,d){a.fn[f]=function(n){var g=[],i=a(n),k,h,m,l,j=this.length===1&&this[0].parentNode;e=b||{};if(j&&j.nodeType===11&&j.childNodes.length===1&&i.length===1){i[d](this[0]);g=this}else{for(h=0,m=i.length;h<m;h++){c=h;k=(h>0?this.clone(true):this).get();a(i[h])[d](k);g=g.concat(k)}c=0;g=this.pushStack(g,f,i.selector)}l=e;e=null;a.tmpl.complete(l);return g}});a.fn.extend({tmpl:function(d,c,b){return a.tmpl(this[0],d,c,b)},tmplItem:function(){return a.tmplItem(this[0])},template:function(b){return a.template(b,this[0])},domManip:function(d,m,k){if(d[0]&&a.isArray(d[0])){var g=a.makeArray(arguments),h=d[0],j=h.length,i=0,f;while(i<j&&!(f=a.data(h[i++],"tmplItem")));if(f&&c)g[2]=function(b){a.tmpl.afterManip(this,b,k)};r.apply(this,g)}else r.apply(this,arguments);c=0;!e&&a.tmpl.complete(b);return this}});a.extend({tmpl:function(d,h,e,c){var i,k=!c;if(k){c=p;d=a.template[d]||a.template(null,d);f={}}else if(!d){d=c.tmpl;b[c.key]=c;c.nodes=[];c.wrapped&&n(c,c.wrapped);return a(j(c,null,c.tmpl(a,c)))}if(!d)return[];if(typeof h==="function")h=h.call(c||{});e&&e.wrapped&&n(e,e.wrapped);i=a.isArray(h)?a.map(h,function(a){return a?g(e,c,d,a):null}):[g(e,c,d,h)];return k?a(j(c,null,i)):i},tmplItem:function(b){var c;if(b instanceof a)b=b[0];while(b&&b.nodeType===1&&!(c=a.data(b,"tmplItem"))&&(b=b.parentNode));return c||p},template:function(c,b){if(b){if(typeof b==="string")b=o(b);else if(b instanceof a)b=b[0]||{};if(b.nodeType)b=a.data(b,"tmpl")||a.data(b,"tmpl",o(b.innerHTML));return typeof c==="string"?(a.template[c]=b):b}return c?typeof c!=="string"?a.template(null,c):a.template[c]||a.template(null,q.test(c)?c:a(c)):null},encode:function(a){return(""+a).split("<").join("&lt;").split(">").join("&gt;").split('"').join("&#34;").split("'").join("&#39;")}});a.extend(a.tmpl,{tag:{tmpl:{_default:{$2:"null"},open:"if($notnull_1){__=__.concat($item.nest($1,$2));}"},wrap:{_default:{$2:"null"},open:"$item.calls(__,$1,$2);__=[];",close:"call=$item.calls();__=call._.concat($item.wrap(call,__));"},each:{_default:{$2:"$index, $value"},open:"if($notnull_1){$.each($1a,function($2){with(this){",close:"}});}"},"if":{open:"if(($notnull_1) && $1a){",close:"}"},"else":{_default:{$1:"true"},open:"}else if(($notnull_1) && $1a){"},html:{open:"if($notnull_1){__.push($1a);}"},"=":{_default:{$1:"$data"},open:"if($notnull_1){__.push($.encode($1a));}"},"!":{open:""}},complete:function(){b={}},afterManip:function(f,b,d){var e=b.nodeType===11?a.makeArray(b.childNodes):b.nodeType===1?[b]:[];d.call(f,b);m(e);c++}});function j(e,g,f){var b,c=f?a.map(f,function(a){return typeof a==="string"?e.key?a.replace(/(<\w+)(?=[\s>])(?![^>]*_tmplitem)([^>]*)/g,"$1 "+d+'="'+e.key+'" $2'):a:j(a,e,a._ctnt)}):e;if(g)return c;c=c.join("");c.replace(/^\s*([^<\s][^<]*)?(<[\w\W]+>)([^>]*[^>\s])?\s*$/,function(f,c,e,d){b=a(e).get();m(b);if(c)b=k(c).concat(b);if(d)b=b.concat(k(d))});return b?b:k(c)}function k(c){var b=document.createElement("div");b.innerHTML=c;return a.makeArray(b.childNodes)}function o(b){return new Function("jQuery","$item","var $=jQuery,call,__=[],$data=$item.data;with($data){__.push('"+a.trim(b).replace(/([\\'])/g,"\\$1").replace(/[\r\t\n]/g," ").replace(/\$\{([^\}]*)\}/g,"{{= $1}}").replace(/\{\{(\/?)(\w+|.)(?:\(((?:[^\}]|\}(?!\}))*?)?\))?(?:\s+(.*?)?)?(\(((?:[^\}]|\}(?!\}))*?)\))?\s*\}\}/g,function(m,l,k,g,b,c,d){var j=a.tmpl.tag[k],i,e,f;if(!j)throw"Unknown template tag: "+k;i=j._default||[];if(c&&!/\w$/.test(b)){b+=c;c=""}if(b){b=h(b);d=d?","+h(d)+")":c?")":"";e=c?b.indexOf(".")>-1?b+h(c):"("+b+").call($item"+d:b;f=c?e:"(typeof("+b+")==='function'?("+b+").call($item):("+b+"))"}else f=e=i.$1||"null";g=h(g);return"');"+j[l?"close":"open"].split("$notnull_1").join(b?"typeof("+b+")!=='undefined' && ("+b+")!=null":"true").split("$1a").join(f).split("$1").join(e).split("$2").join(g||i.$2||"")+"__.push('"})+"');}return __;")}function n(c,b){c._wrap=j(c,true,a.isArray(b)?b:[q.test(b)?b:a(b).html()]).join("")}function h(a){return a?a.replace(/\\'/g,"'").replace(/\\\\/g,"\\"):null}function s(b){var a=document.createElement("div");a.appendChild(b.cloneNode(true));return a.innerHTML}function m(o){var n="_"+c,k,j,l={},e,p,h;for(e=0,p=o.length;e<p;e++){if((k=o[e]).nodeType!==1)continue;j=k.getElementsByTagName("*");for(h=j.length-1;h>=0;h--)m(j[h]);m(k)}function m(j){var p,h=j,k,e,m;if(m=j.getAttribute(d)){while(h.parentNode&&(h=h.parentNode).nodeType===1&&!(p=h.getAttribute(d)));if(p!==m){h=h.parentNode?h.nodeType===11?0:h.getAttribute(d)||0:0;if(!(e=b[m])){e=f[m];e=g(e,b[h]||f[h]);e.key=++i;b[i]=e}c&&o(m)}j.removeAttribute(d)}else if(c&&(e=a.data(j,"tmplItem"))){o(e.key);b[e.key]=e;h=a.data(j.parentNode,"tmplItem");h=h?h.key:0}if(e){k=e;while(k&&k.key!=h){k.nodes.push(j);k=k.parent}delete e._ctnt;delete e._wrap;a.data(j,"tmplItem",e)}function o(a){a=a+n;e=l[a]=l[a]||g(e,b[e.parent.key+n]||e.parent)}}}function u(a,d,c,b){if(!a)return l.pop();l.push({_:a,tmpl:d,item:this,data:c,options:b})}function w(d,c,b){return a.tmpl(a.template(d),c,b,this)}function x(b,d){var c=b.options||{};c.wrapped=d;return a.tmpl(a.template(b.tmpl),b.data,c,b.item)}function v(d,c){var b=this._wrap;return a.map(a(a.isArray(b)?b.join(""):b).filter(d||"*"),function(a){return c?a.innerText||a.textContent:a.outerHTML||s(a)})}function t(){var b=this.nodes;a.tmpl(null,null,null,this).insertBefore(b[0]);a(b).remove()}})(jQuery);