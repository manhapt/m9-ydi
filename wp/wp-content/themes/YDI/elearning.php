<?php
/**
 * Template Name: Elearning
 *
 * @package YDI
 *
 */
?>

<?php get_header(); ?>

<div id="main-wrapper">
    <div id="main" class="clearfix">
        <!--
        Teacher Area
        ==================================== -->

        <section id="slider">
            <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">

                <!-- Indicators bullet -->
                <ol class="carousel-indicators">
                    <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                    <li data-target="#carousel-example-generic" data-slide-to="1"></li>
                    <li data-target="#carousel-example-generic" data-slide-to="2"></li>
                </ol>
                <!-- End Indicators bullet -->

                <!-- Wrapper for slides -->
                <div class="carousel-inner" role="listbox">

                    <!-- single slide -->
                    <div class="item active" style="background-image: url(img/banner.jpg);">
                        <div class="carousel-caption">
                            <h2 data-wow-duration="700ms" data-wow-delay="500ms" class="wow bounceInDown animated">Meet<span> Brandi</span>!
                            </h2>
                            <h3 data-wow-duration="1000ms" class="wow slideInLeft animated"><span class="color">/creative</span>
                                one page template.</h3>
                            <p data-wow-duration="1000ms" class="wow slideInRight animated">We are a team of professionals</p>

                            <ul class="social-links text-center">
                                <li><a href=""><i class="fa fa-twitter fa-lg"></i></a></li>
                                <li><a href=""><i class="fa fa-facebook fa-lg"></i></a></li>
                                <li><a href=""><i class="fa fa-google-plus fa-lg"></i></a></li>
                                <li><a href=""><i class="fa fa-dribbble fa-lg"></i></a></li>
                            </ul>
                        </div>
                    </div>
                    <!-- end single slide -->

                    <!-- single slide -->
                    <div class="item" style="background-image: url(img/banner.jpg);">
                        <div class="carousel-caption">
                            <h2 data-wow-duration="500ms" data-wow-delay="500ms" class="wow bounceInDown animated"><span>Hieu Nguyen</span>!</h2>
                            <h3 data-wow-duration="500ms" class="wow slideInLeft animated"><span class="color">/creative</span>one page template.</h3>
                            <p data-wow-duration="500ms" class="wow slideInRight animated">We are a team of professionals</p>

                            <ul class="social-links text-center">
                                <li><a href=""><i class="fa fa-twitter fa-lg"></i></a></li>
                                <li><a href=""><i class="fa fa-facebook fa-lg"></i></a></li>
                                <li><a href=""><i class="fa fa-google-plus fa-lg"></i></a></li>
                                <li><a href=""><i class="fa fa-dribbble fa-lg"></i></a></li>
                            </ul>
                        </div>
                    </div>
                    <!-- end single slide -->

                    <!-- single slide -->
                    <div class="item" style="background-image: url(img/banner.jpg);">
                        <div class="carousel-caption">
                            <h2 data-wow-duration="500ms" data-wow-delay="500ms" class="wow bounceInDown animated"><span>Kademi Team</span>!</h2>
                            <h3 data-wow-duration="500ms" class="wow slideInLeft animated"><span class="color">/creative</span>
                                one page template.</h3>
                            <p data-wow-duration="500ms" class="wow slideInRight animated">We are a team of professionals</p>

                            <ul class="social-links text-center">
                                <li><a href=""><i class="fa fa-twitter fa-lg"></i></a></li>
                                <li><a href=""><i class="fa fa-facebook fa-lg"></i></a></li>
                                <li><a href=""><i class="fa fa-google-plus fa-lg"></i></a></li>
                                <li><a href=""><i class="fa fa-dribbble fa-lg"></i></a></li>
                            </ul>
                        </div>
                    </div>
                    <!-- end single slide -->

                </div>
                <!-- End Wrapper for slides -->

            </div>
        </section>

        <!--
        End Teacher Area
        ==================================== -->

        <!--
        Student Area
        ==================================== -->

        <section id="features" class="features">
            <div class="container">
                <div class="row">

                    <div class="sec-title text-center mb50 wow bounceInDown animated" data-wow-duration="500ms">
                        <h2>Features</h2>
                        <div class="devider"><i class="fa fa-heart-o fa-lg"></i></div>
                    </div>

                    <!-- service item -->
                    <div class="col-md-4 wow fadeInLeft" data-wow-duration="500ms">
                        <div class="service-item">
                            <div class="service-icon">
                                <i class="fa fa-envira fa-2x"></i>
                            </div>

                            <div class="service-desc">
                                <h3>Branding</h3>
                                <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque
                                    laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore</p>
                            </div>
                        </div>
                    </div>
                    <!-- end service item -->

                    <!-- service item -->
                    <div class="col-md-4 wow fadeInUp" data-wow-duration="500ms" data-wow-delay="500ms">
                        <div class="service-item">
                            <div class="service-icon">
                                <i class="fa fa-pencil fa-2x"></i>
                            </div>

                            <div class="service-desc">
                                <h3>Development</h3>
                                <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque
                                    laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore</p>
                            </div>
                        </div>
                    </div>
                    <!-- end service item -->

                    <!-- service item -->
                    <div class="col-md-4 wow fadeInRight" data-wow-duration="500ms" data-wow-delay="900ms">
                        <div class="service-item">
                            <div class="service-icon">
                                <i class="fa fa-bullhorn fa-2x"></i>
                            </div>

                            <div class="service-desc">
                                <h3>Consulting</h3>
                                <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque
                                    laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore</p>
                            </div>
                        </div>
                    </div>
                    <!-- end service item -->

                </div>
            </div>
        </section>

        <!--
        End Student Area
        ==================================== -->
    </div>
</div>
<?php get_footer(); ?>
