// main script js custom
(function ($) {
    "use strict";

    /*------------------------------------------
        = ALL ESSENTIAL FUNCTIONS
    -------------------------------------------*/

    // Toggle mobile navigation
    function toggleMobileNavigation() {
        var navbar = $(".navigation-holder");
        var openBtn = $(".mobail-menu .open-btn");
        var xbutton = $(".mobail-menu .navbar-toggler");

        openBtn.on("click", function (e) {
            e.stopImmediatePropagation();
            navbar.toggleClass("slideInn");
            xbutton.toggleClass("x-close");
            return false;
        });
    }

    toggleMobileNavigation();

    // Function for toggle class for small menu
    function toggleClassForSmallNav() {
        var windowWidth = window.innerWidth;
        var mainNav = $("#navbar > ul");

        if (windowWidth <= 991) {
            mainNav.addClass("small-nav");
        } else {
            mainNav.removeClass("small-nav");
        }
    }

    toggleClassForSmallNav();

    // Function for small menu
    function smallNavFunctionality() {
        var windowWidth = window.innerWidth;
        var mainNav = $(".navigation-holder");
        var smallNav = $(".navigation-holder > .small-nav");
        var subMenu = smallNav.find(".sub-menu");
        var megamenu = smallNav.find(".mega-menu");
        var menuItemWidthSubMenu = smallNav.find(".menu-item-has-children > a");

        if (windowWidth <= 991) {
            subMenu.hide();
            megamenu.hide();
            menuItemWidthSubMenu.on("click", function (e) {
                var $this = $(this);
                $this.siblings().slideToggle();
                e.preventDefault();
                e.stopImmediatePropagation();
                $this.toggleClass("rotate");
            });
        } else if (windowWidth > 991) {
            mainNav.find(".sub-menu").show();
            mainNav.find(".mega-menu").show();
        }
    }

    smallNavFunctionality();

    $("body").on("click", function () {
        $(".navigation-holder").removeClass("slideInn");
    });
    $(".menu-close").on("click", function () {
        $(".navigation-holder").removeClass("slideInn");
    });
    $(".menu-close").on("click", function () {
        $(".open-btn").removeClass("x-close");
    });

    // Parallax background
    function bgParallax() {
        if ($(".parallax").length) {
            $(".parallax").each(function () {
                var height = $(this).position().top;
                var resize = height - $(window).scrollTop();
                var doParallax = -(resize / 5);
                var positionValue = doParallax + "px";
                var img = $(this).data("bg-image");

                $(this).css({
                    backgroundImage: "url(" + img + ")",
                    backgroundPosition: "50%" + positionValue,
                    backgroundSize: "cover",
                });
            });
        }
    }

    // HERO SLIDER
    var menu = [];
    jQuery(".swiper-slide").each(function (index) {
        menu.push(jQuery(this).find(".slide-inner").attr("data-text"));
    });
    var interleaveOffset = 0.5;
    var swiperOptions = {
        loop: true,
        speed: 1000,
        parallax: true,
        autoplay: {
            delay: 6500,
            disableOnInteraction: false,
        },
        watchSlidesProgress: true,
        pagination: {
            el: ".swiper-pagination",
            clickable: true,
        },

        navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev",
        },

        on: {
            progress: function () {
                var swiper = this;
                for (var i = 0; i < swiper.slides.length; i++) {
                    var slideProgress = swiper.slides[i].progress;
                    var innerOffset = swiper.width * interleaveOffset;
                    var innerTranslate = slideProgress * innerOffset;
                    swiper.slides[i].querySelector(
                        ".slide-inner"
                    ).style.transform =
                        "translate3d(" + innerTranslate + "px, 0, 0)";
                }
            },

            touchStart: function () {
                var swiper = this;
                for (var i = 0; i < swiper.slides.length; i++) {
                    swiper.slides[i].style.transition = "";
                }
            },

            setTransition: function (speed) {
                var swiper = this;
                for (var i = 0; i < swiper.slides.length; i++) {
                    swiper.slides[i].style.transition = speed + "ms";
                    swiper.slides[i].querySelector(
                        ".slide-inner"
                    ).style.transition = speed + "ms";
                }
            },
        },
    };

    var swiper = new Swiper(".swiper-container", swiperOptions);

    // DATA BACKGROUND IMAGE
    var sliderBgSetting = $(".slide-bg-image");
    sliderBgSetting.each(function (indx) {
        if ($(this).attr("data-background")) {
            $(this).css(
                "background-image",
                "url(" + $(this).data("background") + ")"
            );
        }
    });

    /*------------------------------------------
        = HIDE PRELOADER
    -------------------------------------------*/
    function preloader() {
        if ($(".preloader").length) {
            $(".preloader")
                .delay(100)
                .fadeOut(500, function () {
                    //active wow
                    wow.init();
                });
        }
    }

    /*------------------------------------------
        = WOW ANIMATION SETTING
    -------------------------------------------*/
    var wow = new WOW({
        boxClass: "wow", // default
        animateClass: "animated", // default
        offset: 0, // default
        mobile: true, // default
        live: true, // default
    });

    /*------------------------------------------
        = ACTIVE POPUP IMAGE
    -------------------------------------------*/
    if ($(".fancybox").length) {
        $(".fancybox").fancybox({
            openEffect: "elastic",
            closeEffect: "elastic",
            wrapCSS: "project-fancybox-title-style",
        });
    }

    /*------------------------------------------
        = POPUP VIDEO
    -------------------------------------------*/
    if ($(".video-btn").length) {
        $(".video-btn").on("click", function () {
            $.fancybox({
                href: this.href,
                type: $(this).data("type"),
                title: this.title,
                helpers: {
                    title: {
                        type: "inside",
                    },
                    media: {},
                },

                beforeShow: function () {
                    $(".fancybox-wrap").addClass("gallery-fancybox");
                },
            });
            return false;
        });
    }

    /*------------------------------------------
        = ACTIVE GALLERY POPUP IMAGE
    -------------------------------------------*/
    if ($(".popup-gallery").length) {
        $(".popup-gallery").magnificPopup({
            delegate: "a",
            type: "image",

            gallery: {
                enabled: true,
            },

            zoom: {
                enabled: true,

                duration: 300,
                easing: "ease-in-out",
                opener: function (openerElement) {
                    return openerElement.is("img")
                        ? openerElement
                        : openerElement.find("img");
                },
            },
        });
    }

    /*------------------------------------------
        = FUNCTION FORM SORTING GALLERY
    -------------------------------------------*/
    function sortingGallery() {
        if ($(".sortable-gallery .gallery-filters").length) {
            var $container = $(".gallery-container");
            $container.isotope({
                filter: "*",
                animationOptions: {
                    duration: 750,
                    easing: "linear",
                    queue: false,
                },
            });

            $(".gallery-filters li a").on("click", function () {
                $(".gallery-filters li .current").removeClass("current");
                $(this).addClass("current");
                var selector = $(this).attr("data-filter");
                $container.isotope({
                    filter: selector,
                    animationOptions: {
                        duration: 750,
                        easing: "linear",
                        queue: false,
                    },
                });
                return false;
            });
        }
    }

    sortingGallery();

    /*------------------------------------------
        = MASONRY GALLERY SETTING
    -------------------------------------------*/
    function masonryGridSetting() {
        if ($(".masonry-gallery").length) {
            var $grid = $(".masonry-gallery").masonry({
                itemSelector: ".grid-item",
                columnWidth: ".grid-item",
                percentPosition: true,
            });

            $grid.imagesLoaded().progress(function () {
                $grid.masonry("layout");
            });
        }
    }

    // masonryGridSetting();

    /*------------------------------------------
        = FUNFACT
    -------------------------------------------*/
    if ($(".odometer").length) {
        $(".odometer").appear();
        $(document.body).on("appear", ".odometer", function (e) {
            var odo = $(".odometer");
            odo.each(function () {
                var countNumber = $(this).attr("data-count");
                $(this).html(countNumber);
            });
        });
    }

    /*------------------------------------------
        = STICKY HEADER
    -------------------------------------------*/

    // Function for clone an element for sticky menu
    function cloneNavForSticyMenu($ele, $newElmClass) {
        $ele.addClass("original")
            .clone()
            .insertAfter($ele)
            .addClass($newElmClass)
            .removeClass("original");
    }

    // clone home style 1 navigation for sticky menu
    if ($(".wpo-site-header .navigation").length) {
        cloneNavForSticyMenu(
            $(".wpo-site-header .navigation"),
            "sticky-header"
        );
    }

    var lastScrollTop = "";

    function stickyMenu($targetMenu, $toggleClass) {
        var st = $(window).scrollTop();
        var mainMenuTop = $(".wpo-site-header .navigation");

        if ($(window).scrollTop() > 1000) {
            if (st > lastScrollTop) {
                // hide sticky menu on scroll down
                $targetMenu.removeClass($toggleClass);
            } else {
                // active sticky menu on scroll up
                $targetMenu.addClass($toggleClass);
            }
        } else {
            $targetMenu.removeClass($toggleClass);
        }

        lastScrollTop = st;
    }

    /*------------------------------------------
            = language
        -------------------------------------------*/
    $(document).ready(function () {
        var activeLang = $(".flag-item .flag-img.active").parent().html();
        $(".flag-button").html(activeLang);

        $(".flag-item").click(function () {
            var selectedLanguage = $(this).data("lang");
            var selectedLanguageId = $(this).data("id");
            console.log(selectedLanguageId);
            $("#language").val(selectedLanguage);
            $("#language_id").val(selectedLanguageId);

            // Remove active class from all flag items
            $(".flag-item .flag-img").removeClass("active");

            // Add active class to the clicked flag item
            $(this).find(".flag-img").addClass("active");

            // Update the flag button with the selected flag
            var flagItem = $(this).html();
            $(".flag-button").empty().html(flagItem);

            // Submit the form
            $("#languageForm").submit();
        });

        $(".lang-menu").find("ul").addClass("sh active");

        $(".flag-button,.flag-item").on("click", function () {
            $(".lang-menu").find("ul").toggleClass("sh");
        });
    });

    /*------------------------------------------
            = Header search toggle
        -------------------------------------------*/
    if ($(".header-search-form-wrapper").length) {
        var searchToggleBtn = $(".search-toggle-btn");
        var searchToggleBtnIcon = $(".search-toggle-btn i");
        var searchContent = $(".header-search-form");
        var body = $("body");

        searchToggleBtn.on("click", function (e) {
            searchContent.toggleClass("header-search-content-toggle");
            searchToggleBtnIcon.toggleClass(
                "fi flaticon-magnifiying-glass fi ti-close"
            );
            e.stopPropagation();
        });

        body.on("click", function () {
            searchContent.removeClass("header-search-content-toggle");
        })
            .find(searchContent)
            .on("click", function (e) {
                e.stopPropagation();
            });
    }

    /*------------------------------------------
        = Testimonial SLIDER
    -------------------------------------------*/
    if ($(".testimonials-wrapper").length) {
        $(".testimonials-wrapper").owlCarousel({
            autoplay: false,
            smartSpeed: 300,
            margin: 40,
            loop: true,
            autoplayHoverPause: true,
            dots: false,
            nav: false,
            responsive: {
                0: {
                    items: 1,
                },

                500: {
                    items: 1,
                },

                768: {
                    items: 2,
                },

                1200: {
                    items: 2,
                },

                1400: {
                    items: 3,
                },
            },
        });
    }

    /*------------------------------------------
        = Testimonial SLIDER
    -------------------------------------------*/
    if ($(".wpo-service-slide").length) {
        $(".wpo-service-slide").owlCarousel({
            autoplay: false,
            smartSpeed: 300,
            margin: 30,
            loop: true,
            autoplayHoverPause: true,
            dots: false,
            nav: false,
            center: true,
            items: 5,
            autoplay: true,
            center: true,
            responsive: {
                0: {
                    items: 1,
                    nav: false,
                },

                500: {
                    items: 1,
                    nav: false,
                },

                768: {
                    items: 3,
                },

                1200: {
                    items: 3,
                },

                1400: {
                    items: 5,
                },
            },
        });
    }

    /*------------------------------------------
        = wpo-blog-slide 
    -------------------------------------------*/
    if ($(".wpo-blog-slide").length) {
        $(".wpo-blog-slide").owlCarousel({
            autoplay: false,
            smartSpeed: 300,
            margin: 30,
            loop: true,
            autoplayHoverPause: true,
            dots: false,
            nav: true,
            navText: [
                '<i class="fa fa-angle-double-left" aria-hidden="true"></i>',
                '<i class="fa fa-angle-double-right" aria-hidden="true"></i>',
            ],
            autoplay: true,
            responsive: {
                0: {
                    items: 1,
                    nav: false,
                },

                500: {
                    items: 1,
                    nav: false,
                },

                768: {
                    items: 2,
                },

                1200: {
                    items: 3,
                },

                1400: {
                    items: 3,
                },
            },
        });
    }
    /*------------------------------------------
       wpo-project-slider
    -------------------------------------------*/
    if ($(".wpo-project-slider").length) {
        $(".wpo-project-slider").owlCarousel({
            autoplay: false,
            smartSpeed: 300,
            margin: 30,
            loop: true,
            autoplayHoverPause: true,
            dots: false,
            nav: true,
            navText: [
                '<i class="fa fa-angle-double-left" aria-hidden="true"></i>',
                '<i class="fa fa-angle-double-right" aria-hidden="true"></i>',
            ],
            autoplay: true,
            responsive: {
                0: {
                    items: 1,
                    nav: false,
                },

                500: {
                    items: 2,
                    nav: false,
                    dots: true,
                },

                768: {
                    items: 2,
                },

                1200: {
                    items: 3,
                },

                1400: {
                    items: 4,
                },
            },
        });
    }

    /*------------------------------------------
        = PARTNERS SLIDER
    -------------------------------------------*/
    if ($(".partners-slider").length) {
        $(".partners-slider").owlCarousel({
            autoplay: true,
            smartSpeed: 300,
            margin: 30,
            loop: true,
            autoplayHoverPause: true,
            dots: false,
            responsive: {
                0: {
                    items: 2,
                },

                550: {
                    items: 3,
                },

                992: {
                    items: 4,
                },

                1200: {
                    items: 5,
                },
            },
        });
    }

    /*------------------------------------------
        = POST SLIDER
    -------------------------------------------*/
    if ($(".post-slider".length)) {
        $(".post-slider").owlCarousel({
            mouseDrag: false,
            smartSpeed: 500,
            margin: 30,
            loop: true,
            nav: true,
            navText: [
                '<i class="fi ti-arrow-left"></i>',
                '<i class="fi ti-arrow-right"></i>',
            ],
            dots: false,
            items: 1,
        });
    }

    /*------------------------------------------
        = BACK TO TOP BTN SETTING
    -------------------------------------------*/
    $("body").append(
        "<a href='#' class='back-to-top'><i class='ti-arrow-up'></i></a>"
    );

    function toggleBackToTopBtn() {
        var amountScrolled = 1000;
        if ($(window).scrollTop() > amountScrolled) {
            $("a.back-to-top").fadeIn("slow");
        } else {
            $("a.back-to-top").fadeOut("slow");
        }
    }

    $(".back-to-top").on("click", function () {
        $("html,body").animate(
            {
                scrollTop: 0,
            },
            700
        );
        return false;
    });


   

    /*==========================================================================
        WHEN DOCUMENT LOADING
    ==========================================================================*/
    $(window).on("load", function () {
        preloader();

        sortingGallery();

        toggleMobileNavigation();

        smallNavFunctionality();
    });

    /*==========================================================================
        WHEN WINDOW SCROLL
    ==========================================================================*/
    $(window).on("scroll", function () {
        if ($(".wpo-site-header").length) {
            stickyMenu($(".wpo-site-header .navigation"), "sticky-on");
        }

        toggleBackToTopBtn();
    });

    /*==========================================================================
        WHEN WINDOW RESIZE
    ==========================================================================*/
    $(window).on("resize", function () {
        toggleClassForSmallNav();
        //smallNavFunctionality();

        clearTimeout($.data(this, "resizeTimer"));
        $.data(
            this,
            "resizeTimer",
            setTimeout(function () {
                smallNavFunctionality();
            }, 200)
        );
    });
})(window.jQuery);

// jquery dl-menu
(function ($, window, undefined) {
    "use strict";

    // global
    var Modernizr = window.Modernizr,
        $body = $("body");

    $.DLMenu = function (options, element) {
        this.$el = $(element);
        this._init(options);
    };

    // the options
    $.DLMenu.defaults = {
        // classes for the animation effects
        animationClasses: {
            classin: "dl-animate-in-1",
            classout: "dl-animate-out-1",
        },
        // callback: click a link that has a sub menu
        // el is the link element (li); name is the level name
        onLevelClick: function (el, name) {
            return false;
        },
        // callback: click a link that does not have a sub menu
        // el is the link element (li); ev is the event obj
        onLinkClick: function (el, ev) {
            return false;
        },
    };

    $.DLMenu.prototype = {
        _init: function (options) {
            // options
            this.options = $.extend(true, {}, $.DLMenu.defaults, options);
            // cache some elements and initialize some variables
            this._config();

            var animEndEventNames = {
                    WebkitAnimation: "webkitAnimationEnd",
                    OAnimation: "oAnimationEnd",
                    msAnimation: "MSAnimationEnd",
                    animation: "animationend",
                },
                transEndEventNames = {
                    WebkitTransition: "webkitTransitionEnd",
                    MozTransition: "transitionend",
                    OTransition: "oTransitionEnd",
                    msTransition: "MSTransitionEnd",
                    transition: "transitionend",
                };
            // animation end event name
            this.animEndEventName =
                animEndEventNames[Modernizr.prefixed("animation")] + ".dlmenu";
            // transition end event name
            (this.transEndEventName =
                transEndEventNames[Modernizr.prefixed("transition")] +
                ".dlmenu"),
                // support for css animations and css transitions
                (this.supportAnimations = Modernizr.cssanimations),
                (this.supportTransitions = Modernizr.csstransitions);

            this._initEvents();
        },
        _config: function () {
            this.open = false;
            this.$trigger = this.$el.children(".dl-trigger");
            this.$menu = this.$el.children("ul.navbar-nav");
            this.$menuitems = this.$menu.find("li:not(.dl-back)");
            this.$el
                .find("ul.sub-menu")
                .prepend('<li class="dl-back"><a href="#">back</a></li>');
            this.$back = this.$menu.find("li.dl-back");
        },
        _initEvents: function () {
            var self = this;

            this.$trigger.on("click.dlmenu", function () {
                if (self.open) {
                    self._closeMenu();
                } else {
                    self._openMenu();
                }
                return false;
            });

            this.$menuitems.on("click.dlmenu", function (event) {
                event.stopPropagation();

                var $item = $(this),
                    $submenu = $item.children("ul.sub-menu");

                if ($submenu.length > 0) {
                    var $flyin = $submenu
                            .clone()
                            .css("opacity", 0)
                            .insertAfter(self.$menu),
                        onAnimationEndFn = function () {
                            self.$menu
                                .off(self.animEndEventName)
                                .removeClass(
                                    self.options.animationClasses.classout
                                )
                                .addClass("dl-subview");
                            $item
                                .addClass("dl-subviewopen")
                                .parents(".dl-subviewopen:first")
                                .removeClass("dl-subviewopen")
                                .addClass("dl-subview");
                            $flyin.remove();
                        };

                    setTimeout(function () {
                        $flyin.addClass(self.options.animationClasses.classin);
                        self.$menu.addClass(
                            self.options.animationClasses.classout
                        );
                        if (self.supportAnimations) {
                            self.$menu.on(
                                self.animEndEventName,
                                onAnimationEndFn
                            );
                        } else {
                            onAnimationEndFn.call();
                        }

                        self.options.onLevelClick(
                            $item,
                            $item.children("a:first").text()
                        );
                    });

                    return false;
                } else {
                    self.options.onLinkClick($item, event);
                }
            });

            this.$back.on("click.dlmenu", function (event) {
                var $this = $(this),
                    $submenu = $this.parents("ul.sub-menu:first"),
                    $item = $submenu.parent(),
                    $flyin = $submenu.clone().insertAfter(self.$menu);

                var onAnimationEndFn = function () {
                    self.$menu
                        .off(self.animEndEventName)
                        .removeClass(self.options.animationClasses.classin);
                    $flyin.remove();
                };

                setTimeout(function () {
                    $flyin.addClass(self.options.animationClasses.classout);
                    self.$menu.addClass(self.options.animationClasses.classin);
                    if (self.supportAnimations) {
                        self.$menu.on(self.animEndEventName, onAnimationEndFn);
                    } else {
                        onAnimationEndFn.call();
                    }

                    $item.removeClass("dl-subviewopen");

                    var $subview = $this.parents(".dl-subview:first");
                    if ($subview.is("li")) {
                        $subview.addClass("dl-subviewopen");
                    }
                    $subview.removeClass("dl-subview");
                });

                return false;
            });
        },
        closeMenu: function () {
            if (this.open) {
                this._closeMenu();
            }
        },
        _closeMenu: function () {
            var self = this,
                onTransitionEndFn = function () {
                    self.$menu.off(self.transEndEventName);
                    self._resetMenu();
                };

            this.$menu.removeClass("navbar-navopen");
            this.$menu.addClass("navbar-nav-toggle");
            this.$trigger.removeClass("dl-active");

            if (this.supportTransitions) {
                this.$menu.on(this.transEndEventName, onTransitionEndFn);
            } else {
                onTransitionEndFn.call();
            }

            this.open = false;
        },
        openMenu: function () {
            if (!this.open) {
                this._openMenu();
            }
        },
        _openMenu: function () {
            var self = this;
            // clicking somewhere else makes the menu close
            $body.off("click").on("click.dlmenu", function () {
                self._closeMenu();
            });
            this.$menu
                .addClass("navbar-navopen navbar-nav-toggle")
                .on(this.transEndEventName, function () {
                    $(this).removeClass("navbar-nav-toggle");
                });
            this.$trigger.addClass("dl-active");
            this.open = true;
        },
        // resets the menu to its original state (first level of options)
        _resetMenu: function () {
            this.$menu.removeClass("dl-subview");
            this.$menuitems.removeClass("dl-subview dl-subviewopen");
        },
    };

    var logError = function (message) {
        if (window.console) {
            window.console.error(message);
        }
    };

    $.fn.dlmenu = function (options) {
        if (typeof options === "string") {
            var args = Array.prototype.slice.call(arguments, 1);
            this.each(function () {
                var instance = $.data(this, "dlmenu");
                if (!instance) {
                    logError(
                        "cannot call methods on dlmenu prior to initialization; " +
                            "attempted to call method '" +
                            options +
                            "'"
                    );
                    return;
                }
                if (
                    !$.isFunction(instance[options]) ||
                    options.charAt(0) === "_"
                ) {
                    logError(
                        "no such method '" + options + "' for dlmenu instance"
                    );
                    return;
                }
                instance[options].apply(instance, args);
            });
        } else {
            this.each(function () {
                var instance = $.data(this, "dlmenu");
                if (instance) {
                    instance._init();
                } else {
                    instance = $.data(
                        this,
                        "dlmenu",
                        new $.DLMenu(options, this)
                    );
                }
            });
        }
        return this;
    };
})(jQuery, window);
