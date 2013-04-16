/**
 * Fixes console for browsers that do not support it.
 */
(function() {
    var method;
    var noop = function () {};
    var methods = [
        'assert', 'clear', 'count', 'debug', 'dir', 'dirxml', 'error',
        'exception', 'group', 'groupCollapsed', 'groupEnd', 'info', 'log',
        'markTimeline', 'profile', 'profileEnd', 'table', 'time', 'timeEnd',
        'timeStamp', 'trace', 'warn'
    ];
    var length = methods.length;
    var console = (window.console = window.console || {});

    while (length--) {
        method = methods[length];

        // Only stub undefined methods.
        if (!console[method]) {
            console[method] = noop;
        }
    }
}());

// toastr 1.1.1
// By: Hans Fjällemark and John Papa
// https://github.com/CodeSeven/toastr
// 
// Modified to support css styling instead of inline styling
// Inspired by https://github.com/Srirangan/notifer.js/
;
(function (define) {
	define(['jquery'], function ($) {
		var toastr = (function () {
			var
			defaults = {
				tapToDismiss: true,
				toastClass: 'toast',
				containerId: 'toast-container',
				debug: false,
				fadeIn: 300,
				fadeOut: 1000,
				extendedTimeOut: 1000,
				iconClasses: {
					error: 'toast-error',
					info: 'toast-info',
					success: 'toast-success',
					warning: 'toast-warning'
				},
				iconClass: 'toast-info',
				positionClass: 'toast-top-right',
				timeOut: 5000, // Set timeOut to 0 to make it sticky
				titleClass: 'toast-title',
				messageClass: 'toast-message'
			},

			error = function (message, title, optionsOverride) {
				return notify({
					iconClass: getOptions().iconClasses.error,
					message: message,
					optionsOverride: optionsOverride,
					title: title
				});
			},

			getContainer = function (options) {
				var $container = $('#' + options.containerId);
				if ($container.length) {
					return $container;
				}
				$container = $('<div/>')
				.attr('id', options.containerId)
				.addClass(options.positionClass);
				$container.appendTo($('body'));
				return $container;
			},

			getOptions = function () {
				return $.extend({}, defaults, toastr.options);
			},

			info = function (message, title, optionsOverride) {
				return notify({
					iconClass: getOptions().iconClasses.info,
					message: message,
					optionsOverride: optionsOverride,
					title: title
				});
			},

			notify = function (map) {
				var 
				options = getOptions(),
				iconClass = map.iconClass || options.iconClass;

				if (typeof (map.optionsOverride) !== 'undefined') {
					options = $.extend(options, map.optionsOverride);
					iconClass = map.optionsOverride.iconClass || iconClass;
				}

				var 
				intervalId = null,
				$container = getContainer(options),
				$toastElement = $('<div/>'),
				$titleElement = $('<div/>'),
				$messageElement = $('<div/>'),
				response = {
					options: options, 
					map: map
				};

				if (map.iconClass) {
					$toastElement.addClass(options.toastClass).addClass(iconClass);
				}

				if (map.title) {
					$titleElement.append(map.title).addClass(options.titleClass);
					$toastElement.append($titleElement);
				}

				if (map.message) {
					$messageElement.append(map.message).addClass(options.messageClass);
					$toastElement.append($messageElement);
				}

				var fadeAway = function () {
					if ($(':focus', $toastElement).length > 0) {
						return;
					}
					var fade = function (callback) {
						return $toastElement.fadeOut(options.fadeOut, callback);
					};
					var removeToast = function () {
						if ($toastElement.is(':visible')) {
							return;
						}
						$toastElement.remove();
						if ($container.children().length === 0) {
							$container.remove();
						}
					};
					fade(removeToast);
				};
				var delayedFadeAway = function () {
					if (options.timeOut > 0 || options.extendedTimeOut > 0) {
						intervalId = setTimeout(fadeAway, options.extendedTimeOut);
					}
				};
				var stickAround = function () {
					clearTimeout(intervalId);
					$toastElement.stop(true, true).fadeIn(options.fadeIn);
				};
				$toastElement.hide();
				$container.prepend($toastElement);
				$toastElement.fadeIn(options.fadeIn);
				if (options.timeOut > 0) {
					intervalId = setTimeout(fadeAway, options.timeOut);
				}

				$toastElement.hover(stickAround, delayedFadeAway);
				if (!options.onclick && options.tapToDismiss) {
					$toastElement.click(fadeAway);
				}

				if (options.onclick) {
					$toastElement.click(function () {
						options.onclick() && fadeAway();
					});
				}

				if (options.debug && console) {
					console.log(response);
				}
				return $toastElement;
			},

			success = function (message, title, optionsOverride) {
				return notify({
					iconClass: getOptions().iconClasses.success,
					message: message,
					optionsOverride: optionsOverride,
					title: title
				});
			},

			warning = function (message, title, optionsOverride) {
				return notify({
					iconClass: getOptions().iconClasses.warning,
					message: message,
					optionsOverride: optionsOverride,
					title: title
				});
			},


			clear = function () {
				var options = getOptions();
				var $container = $('#' + options.containerId);
				if ($container.length) {
					$container.fadeOut(options.fadeOut, function () {
						$container.remove();
					});
				}
			};
			return {
				clear: clear,
				error: error,
				info: info,
				options: {},
				success: success,
				version: '1.1.1',
				warning: warning
			};
		})();
		return toastr;
	});
}(typeof define === 'function' && define.amd ? define : function (deps, factory) {
	if (typeof module !== 'undefined' && module.exports) { //Node
		module.exports = factory(require(deps[0]));
	} else {
		window['toastr'] = factory(window['jQuery']);
	}
}));