// jQuery Alert Dialogs Plugin
//
// Version 1.1
//
// Cory S.N. LaViska
// A Beautiful Site (http://abeautifulsite.net/)
// 14 May 2009
//
// Visit http://abeautifulsite.net/notebook/87 for more information
//
// Usage:
//		jAlert( message, [title, callback] )
//		jConfirm( message, [title, callback] )
//		jPrompt( message, [value, title, callback] )
//
// History:
//
//		1.00 - Released (29 December 2008)
//
//		1.01 - Fixed bug where unbinding would destroy all resize events
//
// License:
//
// This plugin is dual-licensed under the GNU General Public License and the MIT License and
// is copyright 2008 A Beautiful Site, LLC.
//
/**
 * ****************************************************************************
 * @package        :    COMMON
 * @version        :    1.0.0
 * ****************************************************************************
 */
(function ($) {
    $.alerts = {
        // These properties can be read/written by accessing $.alerts.propertyName from your scripts at any time
        verticalOffset: -75,                // vertical offset of the dialog from center screen, in pixels
        horizontalOffset: 0,                // horizontal offset of the dialog from center screen, in pixels/
        repositionOnResize: true,           // re-centers the dialog on window resize
        overlayOpacity: 1,                // transparency level of overlay
        overlayColor: 'rgba(0, 0, 0, 0.4)',               // base color of overlay
        draggable: false,                    // make the dialogs draggable (requires UI Draggables plugin)
        okButton: '&nbsp;OK&nbsp;', // text for the OK button
        cancelButton: '&nbsp;Cancel&nbsp;', // text for the Cancel button
        dialogClass: null,                  // if specified, this class will be applied to all dialogs
        // Public methods
        // confirm
        alert: function (message, callback) {
            $.alerts._show('Alert', message, 'alert', function (result) {
                if (callback) callback(result);
            });
        },
        confirm: function (message, callback) {
            $.alerts._show('Confirm', message, 'confirm', function (result) {
                if (callback) callback(result);
                // $(":input:not([readonly],[disabled],:hidden,button)").first().focus();
            });
        },
        // success
        success: function (message, callback) {
            $.alerts._show('Success', message, 'success', function (result) {
                if (callback) callback(result);
                $(":input:not([readonly],[disabled],:hidden,button)").first().focus();
            });
        },
        // warning
        warning: function (message, callback) {
            $.alerts._show('Warning', message, 'warning', function (result) {
                if (callback) callback(result);
                $(":input:not([readonly],[disabled],:hidden,button)").first().focus();
            });
        },
        //error
        error: function (message, callback) {
            $.alerts._show('Error', message, 'error', function (result) {
                if (callback) callback(result);
            });
        },
        // Private methods
        // show method
        _show: function (title, msg, type, callback) {
            $.alerts._hide();
            setTimeout(function () {
                $.alerts._overlay('show');
                $("body").append(
                    '<div id="popup_container" class="animated zoomIn">' +
                    '<div id="popup_title"><span class="title-text"></span></div>' +
                    '<div id="popup_icon"></div>' +
                    '<div id="popup_content">' +
                    '<div id="popup_message"></div>' +
                    '</div>' +
                    '</div>');
                if ($.alerts.dialogClass) $("#popup_container").addClass($.alerts.dialogClass);

                $("#popup_icon").addClass(type);
                $("#popup_title").addClass(type + '-bg');
                $("#popup_title .title-text").text(title);
                $("#popup_message").text(msg);
                $("#popup_message").html($("#popup_message").text().replace(/\n/g, '<br />'));
                $.alerts._reposition();
                $.alerts._maintainPosition(true);
                switch (type) {
                    case 'confirm':
                        $("#popup_message").after('<div id="popup_panel" tabindex="99"><button id="popup_ok" class="btn btn-default" style="border:1px solid cadetblue" tabindex="100">' + $.alerts.okButton + '</button> <button id="popup_cancel" class="btn btn-default" tabindex="101">' + $.alerts.cancelButton + '</button></div><div id="tab_loop" tabindex="102"></div>');
                        $("#popup_ok").click(function () {
                            $.alerts._hide();
                            setTimeout(function () {
                                if (callback) callback(true);
                            }, 50);
                        });

                        $('#popup_panel').on('focus', function () {
                            $('#popup_cancel').focus();
                        });
                        $('#tab_loop').on('focus', function () {
                            $('#popup_ok').focus();
                        });

                        $("#popup_cancel").click(function () {
                            $.alerts._hide();
                            setTimeout(function () {
                                if (callback) callback(false);
                            }, 200);
                        });


                        $("#popup_ok").focus();
                        $("#popup_ok, #popup_cancel").keypress(function (e) {
                            if (e.keyCode == 27)
                                $("#popup_cancel").trigger('click');
                        });
                        break;
                    default:
                        $("#popup_message").after('<div id="popup_panel1"><button id="popup_ok" class="btn btn-default" >' + $.alerts.okButton + '</button></div>');
                        $("#popup_ok").click(function () {
                            $.alerts._hide();
                            callback(true);
                        });
                        $("#popup_ok").focus().keypress(function (e) {
                            if (e.keyCode == 13 || e.keyCode == 27) $("#popup_ok").trigger('click');
                        });
                        console.log(type);
                        break;
                }
                // Make draggable
                if ($.alerts.draggable) {
                    try {
                        $("#popup_container").draggable({handle: $("#popup_title")});
                        $("#popup_title").css({cursor: 'move'});
                    } catch (e) { /* requires jQuery UI draggables */
                    }
                }
            }, 50);
        },
        // hide method
        _hide: function () {
            $("#popup_container").removeClass('zoomIn').addClass('zoomOut');
            $('#popup_container').delay(0).fadeOut(50, function () {
                $("#popup_container").remove();
                $.alerts._overlay('hide');
                $.alerts._maintainPosition(false);

            });
        },
        // overlay method
        _overlay: function (status) {
            switch (status) {
                case 'show':
                    $.alerts._overlay('hide');
                    $("BODY").append('<div id="popup_overlay"></div>');
                    $("#popup_overlay").css({
                        height: $(document).height(),
                        background: $.alerts.overlayColor,
                        opacity: $.alerts.overlayOpacity
                    });
                    break;
                case 'hide':
                    $("#popup_overlay").remove();
                    break;
            }
        },
        // reposition method
        _reposition: function () {
            var top = (($(window).height() / 2) - ($("#popup_container").outerHeight() / 2)) + $.alerts.verticalOffset;
            var left = (($(window).width() / 2) - ($("#popup_container").outerWidth() / 2)) + $.alerts.horizontalOffset;
            if (top < 0) top = 0;
            if (left < 0) left = 0;
            // IE6 fix
//			if( $.browser.msie && parseInt($.browser.version) <= 6 ) top = top + $(window).scrollTop();
//			$("#popup_container").css({
//				top: top + 'px',
//				left: left + 'px'
//			});
            $("#popup_overlay").height($(document).height());
        },
        // _maintainPosition method
        _maintainPosition: function (status) {
            if ($.alerts.repositionOnResize) {
                switch (status) {
                    case true:
                        $(window).bind('resize', $.alerts._reposition);
                        break;
                    case false:
                        $(window).unbind('resize', $.alerts._reposition);
                        break;
                }
            }
        }
    };
    // Shortuct functions
    // jConfirm function
    jAlert = function (message, callback) {
        if (typeof message == 'undefined')
            message = 'Message does not exist. Please contact the system administrator.';
        $.alerts.alert(message, callback);
    };
    jConfirm = function (message, callback) {
        if (typeof message == 'undefined')
            message = 'Message does not exist. Please contact the system administrator.';
        $.alerts.confirm(message, callback);
    };
    // jSuccess function
    jSuccess = function (message, callback) {
        if (typeof message == 'undefined')
            message = 'Message does not exist. Please contact the system administrator.';
        $.alerts.success(message, callback);
    };
    // jWarning function
    jWarning = function (message, callback) {
        if (typeof message == 'undefined')
            message = 'Message does not exist. Please contact the system administrator.';
        $.alerts.warning(message, callback);
    };
    // jError function
    jError = function (message, callback) {
        if (typeof message == 'undefined')
            message = 'Message does not exist. Please contact the system administrator.';
        $.alerts.error(message, callback);
    };
})(jQuery);