(function ($) {
    $(window).on('elementor/frontend/init', function (module) {
        "use strict";
        // Attach to Widgets
        elementorFrontend.hooks.addAction('frontend/element_ready/widget', function ($scope) {
           // _light_box($scope);
        });
    });

    function _light_box($scope) {
        var _Light_Box = elementorModules.frontend.handlers.Base.extend({
            bindEvents: function bindEvents() {

                elementorFrontend.elements.$document.on('click', this.getSettings('selectors.links'), this.runLinkAction.bind(this));
            },
            initActions: function initActions() {
                this.actions = {
                    lightbox: function lightbox(settings) {

                        return elementorFrontend.utils.lightbox.showModal(settings);
                    }
                }
            },
            runAction: function runAction(url, event) {
                url = decodeURIComponent(url);
                var actionMatch = url.match(/action=(.+?) /),
                    settingsMatch = url.match(/settings=(.+)/);
                if (!actionMatch) {
                    return;
                }
                var action = this.actions[actionMatch[1]];
                if (!action) {
                    return;
                }
                var settings = {};
                if (settingsMatch) {
                    settings = JSON.parse(atob(settingsMatch[1]));
                }
                for (var _len = arguments.length, restArgs = Array(_len > 1 ? _len - 1 : 0), _key = 1; _key < _len; _key++) {
                    restArgs[_key - 1] = arguments[_key];
                }

                action.apply(undefined, [settings].concat(restArgs));
            },
            runLinkAction: function runLinkAction(event) {
                event.preventDefault();

                this.runAction(event.currentTarget.href, event);
            },
            onInit: function onInit() {
                this.bindEvents();
                this.initActions();
            },
            getDefaultSettings: function getDefaultSettings() {
                return {
                    selectors: {
                        links: 'a[href^="#elementor-action"]'
                    }
                };
            }
        });
        new _Light_Box({$element: $scope}).onInit();
    }

})(jQuery);
