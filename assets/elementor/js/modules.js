(function ($) {
    /**
     * @param $scope The Widget wrapper element as a jQuery element
     * @param $ The jQuery alias
     */

    var WidgetFlickrTabHandler = function ($scope, $) {
        /*===== Flickr =====*/

        $scope.find(".flickr-gal").each(function () {
            let id = $(this).data("id");
            let settings = $(this).data("settings");
            $(this).jflickrfeed(settings);
        });

    };

    var WidgetJobsHandler = function ($scope, $) {
        console.log(elementorFrontend);
        if (elementorFrontend.webinane !== undefined) {
            elementorFrontend.webinane.jobs.init()
        }
    }

    var WidgetPortfolioHandler = function ($scope, $) {
        if (elementorFrontend.webinane !== undefined) {
            elementorFrontend.webinane.portfolio.init()
        }
    }

    var WidgetOnePageHeaderHandler = function ($scope, $) {
        var $body_find = $(".elementor-inner section.elementor-section") || $(".elementor-section-wrap section.elementor-section"),
            $thiss, $title, $ul = $("#one_page_header"),
            $li, $id;
        $body_find.each(function (i, ele) {
            $thiss = $(this), $title = $thiss.attr("data-title"), $id = $thiss.attr("data-id"), $thiss.attr("id", "gathemes-id-" + $id), $li = "<li><a rel='m_PageScroll2id' href='#gathemes-id-" + $id + "' data-id='" + $id + "'>" + $title + "</a></li>";
            if (typeof $title !== "undefined" && $id !== $scope.data("id")) {
                $ul.append($li);
            }
        });
        $("a[rel='m_PageScroll2id']").mPageScroll2id();
    };

    // Make sure you run this code under Elementor.
    $(window).on('elementor/frontend/init', function () {
        elementorFrontend.hooks.addAction('frontend/element_ready/webinane_elementor_portfolio.default', WidgetPortfolioHandler);
        elementorFrontend.hooks.addAction('frontend/element_ready/webinane_flickr_elementor_widget.default', WidgetFlickrTabHandler);
        elementorFrontend.hooks.addAction('frontend/element_ready/webinane_elementor_jobs.default', WidgetJobsHandler);
        elementorFrontend.hooks.addAction('frontend/element_ready/One_Page_Header.default', WidgetOnePageHeaderHandler);
        elementorFrontend.hooks.addAction('frontend/element_ready/widget', WidgetTimer);
    });

    var WidgetTimer = function ($scope, $) {
        if ($.isFunction($.fn.TimeCircles)) {
            var widget_id = $scope.context.attributes['data-id'].value;
            var t = $("body").find(".elementor-element-" + widget_id).find(".webinane-time-counter").attr("data-attribute");
            if (typeof t !== 'undefined') {
                t = JSON.parse(t);
                $(".webinane-time-counter").TimeCircles(t);
            }
        }
    }
    var lightbox_elements = $('a')
      .filter(function() {
        return this.href.match(/#action-webinane-elementor-modal/);
    })
    if (lightbox_elements.length >= 1) {
  
        lightbox_elements.on('click', function (e) {

            e.preventDefault();
            let href = $(this).attr('href');
            
            let arr = href.split("|");
            let url, type, title;
            if (arr[1] !== undefined) {
                url = arr[1];
            }
            if (arr[2] !== undefined && arr[2] !== 'video') {
                type = arr[2];
            } else {
                type = '';
            }
            if (arr[3] !== undefined) {
                title = (arr[3]) ? arr[3].replaceAll("%20", " ") : '';
            } else {
                title = '';
            }

            if (url !== undefined && $.fn.fancybox !== undefined) {
                $.fancybox.open({
                    src: url,
                    type: type,
                    opts: {
                        caption: title
                    }
                });
            }
        });
    }
})(jQuery);