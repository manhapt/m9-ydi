<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js no-svg">
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <?php wp_head(); ?>
    <link rel='stylesheet' id='twentyfifteen-style-css'  href='<?php echo get_stylesheet_directory_uri(); ?>/style.css' type='text/css' media='all' />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
</head>
<body id="body" class="html front not-logged-in one-sidebar sidebar-second page-node with-navigation with-subnav">
<div id="fb-root"></div>
<script>(function (d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s);
        js.id = id;
        js.src = "//connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v2.10&appId=1443642219198207";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));</script>

<div id="page-wrapper">
    <div id="page">
        <header id="header" role="banner" class="clearfix">
            <div class="section-1 clearfix">
                <div class="col1">
                    <a href="<?php echo get_site_url(); ?>" title="Home" rel="home" id="logo">
                        <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/logo.png" alt="Home"/>
                    </a>
                </div>
                <div class="col2">
                    <div class="region region-user-menu">
                        <?php get_template_part( 'theme-parts/navigation/control' ); ?>
                        <?php get_template_part( 'theme-parts/navigation/top' ); ?>
                    </div>
                </div>
            </div>
            <div class="section-2 clearfix">
                <?php get_template_part( 'theme-parts/navigation/main' ); ?>
            </div>
            <div class="section-3 clearfix">
                <div class="region region-header">
                    <div id="block-views-slider-block" class="block block-views block-even">
                        <div class="content">
                            <div class="view view-slider view-id-slider view-display-id-block view-dom-id-c19dcd19cd6fd702cfc4869516210b9a">
                                <div class="view-content">
                                    <div class="skin-default">
                                        <div id="flexslider_views_slideshow_main_slider-block"
                                             class="flexslider_views_slideshow_main views_slideshow_main">
                                            <div class="flex-nav-container">
                                                <div class="flexslider">
                                                    <ul id="flexslider_views_slideshow_slider-block"
                                                        class="flexslider-views-slideshow-main-frame slides">
                                                        <li class="flexslider-views-slideshow-main-frame-row flexslider_views_slideshow_slide views-row-1 views-row-odd">
                                                            <div class="views-field views-field-field-slide-image">
                                                                <div class="field-content">
                                                                    <img
                                                                            src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/slide1.png"
                                                                            width="1049"
                                                                            height="470" alt=""/>
                                                                </div>
                                                            </div>
                                                        </li>
                                                        <li class="flexslider-views-slideshow-main-frame-row flexslider_views_slideshow_slide views-row-5 views_slideshow_cycle_hidden views-row-odd">
                                                            <div class="views-field views-field-field-slide-image">
                                                                <div class="field-content">
                                                                    <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/slide5.png"
                                                                         width="1049"
                                                                         height="470" alt=""/>
                                                                </div>
                                                            </div>
                                                        </li>
                                                    </ul>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div><!--posttent -->
                    </div><!-- /.block -->
            </div><!-- /.section -->
        </header><!-- /#header -->


