<?php
/*
Template Name: Services
Description: Services page template with grid layout
*/
get_header();
?>

<main id="services-page" class="site-main">

    <!-- Page Header -->
    <section class="page-header">
        <div class="container">
            <h1 class="page-title"><?php the_title(); ?></h1>
            <p class="page-subtitle">Discover what we can do for you</p>
        </div>
    </section>

    <!-- Intro Content -->
    <section class="services-intro">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <?php while ( have_posts() ) : the_post(); ?>
                        <div class="intro-text">
                            <?php the_content(); ?>
                        </div>
                    <?php endwhile; ?>
                </div>
            </div>
        </div>
    </section>

    <!-- Services Grid -->
    <section class="services-grid">
        <div class="container">
            <div class="row">
                
                <!-- Service 1 -->
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="service-box">
                        <div class="service-icon">
                            <i class="fas fa-hard-hat"></i>
                        </div>
                        <h3>Construction</h3>
                        <p>Comprehensive construction services from planning to execution. We handle residential, commercial, and industrial projects.</p>
                        <a href="#" class="service-link">Learn More →</a>
                    </div>
                </div>

                <!-- Service 2 -->
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="service-box">
                        <div class="service-icon">
                            <i class="fas fa-tools"></i>
                        </div>
                        <h3>Renovation</h3>
                        <p>Transform your existing space with our expert renovation services. Quality workmanship and attention to detail.</p>
                        <a href="#" class="service-link">Learn More →</a>
                    </div>
                </div>

                <!-- Service 3 -->
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="service-box">
                        <div class="service-icon">
                            <i class="fas fa-building"></i>
                        </div>
                        <h3>Architecture</h3>
                        <p>Innovative architectural design solutions that blend functionality with aesthetics for modern living.</p>
                        <a href="#" class="service-link">Learn More →</a>
                    </div>
                </div>

                <!-- Service 4 -->
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="service-box">
                        <div class="service-icon">
                            <i class="fas fa-paint-roller"></i>
                        </div>
                        <h3>Interior Design</h3>
                        <p>Create beautiful, functional interiors that reflect your style and enhance your living experience.</p>
                        <a href="#" class="service-link">Learn More →</a>
                    </div>
                </div>

                <!-- Service 5 -->
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="service-box">
                        <div class="service-icon">
                            <i class="fas fa-wrench"></i>
                        </div>
                        <h3>Maintenance</h3>
                        <p>Regular maintenance and repair services to keep your property in top condition year-round.</p>
                        <a href="#" class="service-link">Learn More →</a>
                    </div>
                </div>

                <!-- Service 6 -->
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="service-box">
                        <div class="service-icon">
                            <i class="fas fa-clipboard-check"></i>
                        </div>
                        <h3>Consultation</h3>
                        <p>Expert consultation services to guide your project from concept to completion with professional advice.</p>
                        <a href="#" class="service-link">Learn More →</a>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- Call to Action -->
    <section class="services-cta">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center">
                    <h2>Ready to Start Your Project?</h2>
                    <p>Contact us today for a free consultation and quote</p>
                    <a class="b-btn btn-black" href="<?php echo esc_url( home_url( '/contact/' ) ); ?>">
                        <span>Get In Touch</span>
                    </a>
                </div>
            </div>
        </div>
    </section>

</main>

<?php get_footer(); ?>
