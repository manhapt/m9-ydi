        <footer id="footer" role="contentinfo">
            <div class="footer-wrapper clearfix">
                <div class="region region-footer">
                    <div id="block-block-5" class="block block-block block-even">
                        <div class="content">
                            <div style="float:left; width:240px;">
                                <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/logo.png" width="200px">
                            </div>
                            <?php if ( is_active_sidebar( 'footer' ) ) : ?>
                                <?php dynamic_sidebar( 'footer' ); ?>
                            <?php endif; ?>
                        </div><!-- /.content -->
                    </div><!-- /.block -->
                </div>
            </div><!-- /#footer-wrapper -->
        </footer>
    </div>
</div>
<?php wp_footer(); ?>
<script type="text/javascript" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/js/jquery.js"></script>
<script type="text/javascript" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/js/jquery.once.js"></script>
<script type="text/javascript" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/js/drupal.js"></script>
<script type="text/javascript" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/js/jquery.effects.core.min.js"></script>
<script type="text/javascript" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/js/jquery.flexslider-min.js"></script>
<script type="text/javascript" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/js/back_to_top.js"></script>
<script type="text/javascript" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/js/addthis.js"></script>
<script type="text/javascript" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/js/jquery.colorbox-min.js"></script>
<script type="text/javascript" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/js/colorbox.js"></script>
<script type="text/javascript" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/js/colorbox_style.js"></script>
<script type="text/javascript" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/js/getlocations_colorbox.js"></script>
<script type="text/javascript" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/js/panels.js"></script>
<script type="text/javascript" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/js/jquery.hoverIntent.minified.js"></script>
<script type="text/javascript" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/js/jquery.bgiframe.min.js"></script>
<script type="text/javascript" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/js/superfish.js"></script>
<script type="text/javascript" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/js/supersubs.js"></script>
<script type="text/javascript" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/js/supposition.js"></script>
<script type="text/javascript" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/js/sftouchscreen.js"></script>
<script type="text/javascript" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/js/views_slideshow.js"></script>
<script type="text/javascript" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/js/flexslider.load.js"></script>
<script type="text/javascript" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/js/flexslider_views_slideshow.js"></script>
<script type="text/javascript">
    jQuery(function () {
        jQuery('#superfish-1').supersubs({minWidth: 12, maxWidth: 27, extraWidth: 1}).superfish({
            animation: {opacity: 'show'},
            speed: 'fast',
            autoArrows: false,
            dropShadows: false
        });
    });
</script>
<script type="text/javascript" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/js/theme764.core.js"></script>
<script type="text/javascript" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/js/jquery.loader.js"></script>
<script type="text/javascript">
    jQuery.extend(Drupal.settings, {
        "basePath": "",
        "pathPrefix": "",
        "ajaxPageState": {
            "theme": "",
            "theme_token": "",
            "js": {
                "0": 1,
                "misc\/jquery.js": 1,
                "misc\/jquery.once.js": 1,
                "misc\/drupal.js": 1,
                "misc\/ui\/jquery.effects.core.min.js": 1,
                "sites\/js\/jquery.flexslider-min.js": 1,
                "sites\/js\/back_to_top.js": 1,
                "sites\/js\/addthis.js": 1,
                "sites\/js\/jquery.colorbox-min.js": 1,
                "sites\/js\/colorbox.js": 1,
                "sites\/js\/colorbox_style.js": 1,
                "sites\/js\/getlocations_colorbox.js": 1,
                "sites\/js\/panels.js": 1,
                "sites\/js\/jquery.hoverIntent.minified.js": 1,
                "sites\/js\/jquery.bgiframe.min.js": 1,
                "sites\/js\/superfish.js": 1,
                "sites\/js\/supersubs.js": 1,
                "sites\/js\/supposition.js": 1,
                "sites\/js\/sftouchscreen.js": 1,
                "sites\/js\/views_slideshow.js": 1,
                "sites\/js\/flexslider.load.js": 1,
                "sites\/js\/flexslider_views_slideshow.js": 1,
                "1": 1,
                "sites\/js\/theme764.core.js": 1,
                "sites\/js\/jquery.loader.js": 1
            },
            "css": {
                "css\/system.base.css": 1,
                "css\/system.menus.css": 1,
                "css\/system.messages.css": 1,
                "css\/system.theme.css": 1,
                "css\/flexslider.css": 1,
                "css\/flexslider_img.css": 1,
                "css\/back_to_top.css": 1,
                "css\/aggregator.css": 1,
                "css\/book.css": 1,
                "css\/comment.css": 1,
                "css\/field.css": 1,
                "css\/node.css": 1,
                "modules\/poll\/poll.css": 1,
                "css\/search.css": 1,
                "css\/user.css": 1,
                "css\/forum.css": 1,
                "css\/views.css": 1,
                "css\/colorbox_style.css": 1,
                "css\/ctools.css": 1,
                "css\/follow.css": 1,
                "css\/panels.css": 1,
                "css\/superfish.css": 1,
                "css\/superfish-vertical.css": 1,
                "css\/superfish-navbar.css": 1,
                "css\/views_slideshow.css": 1,
                "css\/style\/default.css": 1,
                "css\/boilerplate.css": 1,
                "css\/style.css": 1,
                "css\/maintenance-page.css": 1
            }
        },
        "back_to_top": {
            "back_to_top_button_trigger": 100,
            "back_to_top_prevent_on_mobile": true,
            "back_to_top_prevent_in_admin": true,
            "back_to_top_button_type": "image"
        },
        "colorbox": {
            "opacity": "0.85",
            "current": "{current} of {total}",
            "previous": "\u00ab Prev",
            "next": "Next \u00bb",
            "close": "Close",
            "maxWidth": "98%",
            "maxHeight": "98%",
            "fixed": true
        },
        "getlocations_colorbox": {
            "enable": 0,
            "width": "600",
            "height": "600",
            "marker_enable": 0,
            "marker_width": "600",
            "marker_height": "600"
        },
        "viewsSlideshow": {
            "slider-block": {
                "methods": {
                    "goToSlide": ["viewsSlideshowPager", "viewsSlideshowSlideCounter"],
                    "nextSlide": ["viewsSlideshowPager", "viewsSlideshowSlideCounter", "flexsliderViewsSlideshow"],
                    "pause": ["viewsSlideshowControls", "flexsliderViewsSlideshow"],
                    "play": ["viewsSlideshowControls", "flexsliderViewsSlideshow"],
                    "previousSlide": ["viewsSlideshowPager", "viewsSlideshowSlideCounter", "flexsliderViewsSlideshow"],
                    "transitionBegin": ["viewsSlideshowPager", "viewsSlideshowSlideCounter"],
                    "transitionEnd": []
                }, "paused": 0
            }
        },
        "flexslider_views_slideshow": {
            "#flexslider_views_slideshow_main_slider-block": {
                "num_divs": 5,
                "id_prefix": "#flexslider_views_slideshow_main_",
                "vss_id": "slider-block",
                "animation": "fade",
                "animationDuration": 600,
                "slideDirection": "horizontal",
                "slideshow": 1,
                "slideshowSpeed": 7000,
                "animationLoop": 1,
                "randomize": 0,
                "slideToStart": 0,
                "directionNav": 0,
                "controlNav": 1,
                "keyboardNav": 0,
                "mousewheel": 0,
                "prevText": "Previous",
                "nextText": "Next",
                "pausePlay": 0,
                "pauseText": "Pause",
                "playText": "Play",
                "pauseOnAction": 1,
                "controlsContainer": ".flex-nav-container",
                "manualControls": ""
            }
        },
        "addthis": {"": ""}
    });
</script>
<script>(function (d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s);
        js.id = id;
        js.src = "//connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v2.10&appId=1443642219198207";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));
</script>
</body>
</html>
