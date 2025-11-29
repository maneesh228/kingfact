<?php
/*
Template Name: About — Profile / Vision / Mission / Why Us
Description: Custom About page template with Profile, Vision, Mission and Why Us sections.
*/
get_header();

// Get featured image or fallback to default
$breadcrumb_bg = get_the_post_thumbnail_url(get_the_ID(), 'full');
if (!$breadcrumb_bg) {
    $breadcrumb_bg = get_template_directory_uri() . '/assets/img/bg/bg-9.jpg';
}
?>

<main>
      <div class="breadcrumb-area pt-245 pb-255" style="background-image:url(<?php echo esc_url( $breadcrumb_bg ); ?>)">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="breadcrumb-text text-center">
                        <h1>About Us</h1>
                        <ul class="breadcrumb-menu">
                            <li><a href="<?php echo esc_url( home_url( '/' ) ); ?>">home</a></li>
                            <li><span>About Us</span></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- breadcrumb-area-end -->

    <!-- history-area-start -->
    <div class="history-area pt-130 pb-50">
        <div class="container">
            <div class="row">
                <div class="col-xl-5 col-lg-5">
                    <div class="single-history mb-30">
                        <div class="history-text">
                            <?php
                            $history_subtitle = get_field('history_subtitle');
                            $history_title = get_field('history_title');
                            
                            if (!$history_subtitle) $history_subtitle = 'who we are';
                            if (!$history_title) $history_title = 'Quality & Integrity Service Agency';
                            ?>
                            <span><?php echo esc_html($history_subtitle); ?></span>
                            <h1><?php echo esc_html($history_title); ?></h1>
                        </div>
                    </div>
                </div>
                <div class="col-xl-7 col-lg-7">
                    <div class="history-wrapper mb-30">
                        <div class="history-content">
                            <?php
                            $history_heading = get_field('history_heading');
                            $history_content = get_field('history_content');
                            
                            if (!$history_heading) $history_heading = 'Company History';
                            if (!$history_content) $history_content = 'Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odite.';
                            ?>
                            <h4><?php echo esc_html($history_heading); ?></h4>
                            <p><?php echo wp_kses_post($history_content); ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- history-area-end -->

</main>

<?php get_footer(); ?>
