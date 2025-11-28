<?php
/*
Template Name: Home (Enqueue-only)
*/
get_header();
?>

    <main>
       <?php
// Query all published slides ordered by menu_order
$slides = get_posts( array(
    'post_type'      => 'slide',
    'posts_per_page' => -1,
    'post_status'    => 'publish',
    'orderby'        => 'menu_order',
    'order'          => 'ASC',
) );

if ( $slides ) : ?>
    <!-- slider start -->
    <div class="hero-slider-area">
        <div id="rs_slider_wrapper_01" class="rev_slider_wrapper fullwidthbanner-container" data-alias="home-02"
            data-source="gallery"
            style="margin:0px auto;background:transparent;padding:0px;margin-top:0px;margin-bottom:0px;">
            <div id="rs_slider_01" class="rev_slider fullwidthabanner" style="display:none;" data-version="5.4.7">
                <ul>
                    <?php foreach ( $slides as $i => $slide ) :
                        // image (featured)
                        $thumb_id = get_post_thumbnail_id( $slide->ID );
                        $img_url = $thumb_id ? wp_get_attachment_image_url( $thumb_id, 'full' ) : '';

                        // fields
                        $subtitle = get_post_meta( $slide->ID, '_slide_subtitle', true );
                        $bigtitle = get_post_meta( $slide->ID, '_slide_bigtitle', true );
                        $btn_text = get_post_meta( $slide->ID, '_slide_btn_text', true );
                        $btn_url  = get_post_meta( $slide->ID, '_slide_btn_url', true );

                        // content & title
                        $title = get_the_title( $slide->ID );
                        $content = apply_filters( 'the_content', $slide->post_content );

                        // fallback: if bigtitle empty use post title
                        if ( empty( $bigtitle ) ) {
                            $bigtitle = $title;
                        }

                        // generate slide index like rs-1, rs-2...
                        $rs_index = 'rs-' . ($i + 1);

                        // sanitize for attributes
                        $data_thumb = $img_url ? esc_url( $img_url ) : '';

                    
                        // build safe frames array (per-layer or default)
                        $layer_frames = array(
                            array(
                                'delay' => 10,
                                'speed' => 300,
                                'frame' => '0',
                                'from'  => 'opacity:0;',
                                'to'    => 'o:1;',
                                'ease'  => 'Power3.easeInOut',
                            ),
                            array(
                                'delay' => 'wait',
                                'speed' => 300,
                                'frame' => '999',
                                'to'    => 'opacity:0;',
                                'ease'  => 'Power3.easeInOut',
                            ),
                        );

                        // if caption frames are stored in meta (JSON string or array), try to use them
                        if ( isset( $caption_frames_meta ) && $caption_frames_meta ) {
                            // try decode if string
                            if ( is_string( $caption_frames_meta ) ) {
                                $candidate = json_decode( $caption_frames_meta, true );
                                if ( json_last_error() === JSON_ERROR_NONE && is_array( $candidate ) ) {
                                    $layer_frames = $candidate;
                                }
                            } elseif ( is_array( $caption_frames_meta ) ) {
                                $layer_frames = $caption_frames_meta;
                            }
                        }
                        // print layer with guaranteed data-frames (encoded safely)

                    ?>
                        <li data-index="<?php echo esc_attr( $rs_index ); ?>" data-transition="boxslide" data-slotamount="default" data-hideafterloop="0"
                            data-hideslideonmobile="off" data-easein="default" data-easeout="default" data-masterspeed="300"
                            data-thumb="<?php echo $data_thumb; ?>" data-rotate="0" data-saveperformance="off" data-title="<?php echo esc_attr( $bigtitle ); ?>"
                            data-param1="" data-param2="" data-param3="" data-param4="" data-param5="" data-param6="" data-param7=""
                            data-param8="" data-param9="" data-param10="" data-description="">

                            <?php if ( $img_url ) : ?>
                                <!-- MAIN IMAGE -->
                                <img src="<?php echo esc_url( $img_url ); ?>" alt="<?php echo esc_attr( $bigtitle ); ?>"
                                     data-bgposition="center center" data-bgfit="cover" data-bgrepeat="no-repeat"
                                     class="rev-slidebg" data-no-retina>
                            <?php endif; ?>

                            <!-- LAYERS -->
                            <div class="tp-caption rev_group" id="rs-layes-<?php echo esc_attr( $i + 1 ); ?>" data-x="['center','center','center','center']"
                                data-hoffset="['0','0','0','0']"
                                data-y="['middle','middle','middle','middle']"
                                data-voffset="['0','0','0','-80']"
                                data-width="['988','772','595','99%']"
                                data-height="['370','280','230','200']" data-whitespace="nowrap"
                                data-type="group" data-responsive_offset="on" data-responsive="off"
                                data-frames='<?php echo esc_attr( wp_json_encode( $layer_frames ) ); ?>'
                                style="z-index: 5; min-width: 988px; max-width: 988px; white-space: nowrap;"> 

                                <!-- Subtitle -->
                                <?php if ( $subtitle ) : ?>
                                    <div class="tp-caption" id="rs-layes-sub-<?php echo esc_attr( $i + 1 ); ?>"
                                        data-x="['center','center','center','center']" data-hoffset="['0','0','0','0']"
                                        data-y="['top','top','top','top']" data-voffset="['0','0','0','0']"
                                        data-width="['988','772','595','350']" data-lineheight="['25','25','25','25']"
                                        data-whitespace="normal" data-type="text" data-responsive_offset="off" data-responsive="off"
                                        data-frames='<?php echo esc_attr( wp_json_encode( $layer_frames ) ); ?>'
                                        style="z-index: 7; white-space: normal; font-size: 14px; line-height: 12px; font-weight: 700; color: #ffffff; text-transform:uppercase;text-align:center;">
                                        <?php echo esc_html( $subtitle ); ?>
                                    </div>
                                <?php endif; ?>

                                <!-- Big Title -->
                                <div class="tp-caption" id="rs-layes-title-<?php echo esc_attr( $i + 1 ); ?>"
                                    data-x="['center','center','center','center']" data-hoffset="['0','0','0','0']"
                                    data-y="['top','top','top','top']"
                                    data-voffset="['70','50','50','80']"
                                    data-fontsize="['95','80','50','30']"
                                    data-lineheight="['100','90','60','35']"
                                    data-fontweight="['700','700','700','700']"
                                    data-width="['970','900','550','350']" data-height="none" data-whitespace="normal"
                                    data-type="text" data-responsive_offset="off" data-responsive="off"
                                    data-frames='<?php echo esc_attr( wp_json_encode( $layer_frames ) ); ?>'
                                    style="z-index: 6; min-width: 350px; max-width: 800px; white-space: normal; font-weight:900; text-align:center;">
                                    <?php echo esc_html( $bigtitle ); ?>
                                </div>

                                <!-- Description (editor content) -->
                                <?php if ( $content ) : ?>
                                    <div class="tp-caption" id="rs-layes-desc-<?php echo esc_attr( $i + 1 ); ?>"
                                        data-x="['center','center','center','center']" data-hoffset="['0','0','0','0']"
                                        data-y="['top','top','top','top']" data-voffset="['190','150','120','130']"
                                        data-fontsize="['16','16','16','16']" data-lineheight="['30','30','30','30']"
                                        data-type="text" data-responsive_offset="off" data-responsive="off"
                                        data-frames='<?php echo esc_attr( wp_json_encode( $layer_frames ) ); ?>'
                                        style="z-index: 6; white-space: normal; font-size:16px; text-align:center;">
                                        <?php echo wp_kses_post( $content ); ?>
                                    </div>
                                <?php endif; ?>

                                <!-- Button -->
                                <?php if ( $btn_text && $btn_url ) : ?>
                                    <div class="tp-caption" id="rs-layes-btn-<?php echo esc_attr( $i + 1 ); ?>"
                                        data-x="['center','center','center','center']" data-hoffset="['0','0','0','0']"
                                        data-y="['bottom','bottom','bottom','bottom']" data-voffset="['0','-20','-50','-130']"
                                        data-type="button" data-responsive_offset="off" data-responsive="off" data-frames='<?php echo esc_attr( wp_json_encode( $layer_frames ) ); ?>' style="z-index:9;">
                                        <div class="bd-slider-button bd-slider-button-center">
                                            <a class="b-btn" href="<?php echo esc_url( $btn_url ); ?>"><span><?php echo esc_html( $btn_text ); ?></span></a>
                                        </div>
                                    </div>
                                <?php endif; ?>

                            </div>
                        </li>
                    <?php endforeach; ?>
                </ul>
                <div class="tp-bannertimer tp-bottom" style="visibility: hidden !important;"></div>
            </div>
        </div>
    </div>
    <!-- slider end -->
<?php endif; 

 the_content();
?>

            <!-- services-area start  -->
            <div class="services-area pt-120 pb-90">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-6 col-lg-6 offset-lg-3 offset-xl-3">
                            <div class="section-title text-center mb-75">
                                <span>what we do</span>
                                <h1>Latest Services</h1>
                            </div>
                        </div>
                    </div>
                    <div class="row service-active arrow-style">
                        <?php
                        // Query 6 services dynamically
                        $services_query = new WP_Query(array(
                            'post_type' => 'service',
                            'posts_per_page' => 6,
                            'post_status' => 'publish',
                            'orderby' => 'menu_order',
                            'order' => 'ASC'
                        ));
                        
                        if ($services_query->have_posts()) :
                            while ($services_query->have_posts()) : $services_query->the_post();
                                $service_url = get_permalink();
                                $service_link_text = get_post_meta(get_the_ID(), '_service_link_text', true);
                                if (empty($service_link_text)) {
                                    $service_link_text = 'raed more';
                                }
                                
                                // Get description
                                $description = get_the_excerpt();
                                if (empty($description)) {
                                    $description = wp_trim_words(get_the_content(), 20, '...');
                                }
                        ?>
                        <div class="col-xl-4">
                            <div class="b-services mb-30">
                                <?php if (has_post_thumbnail()) : ?>
                                <div class="b-services-img">
                                    <?php the_post_thumbnail('medium', array('alt' => get_the_title(), 'style' => 'width: 100%; height: auto;')); ?>
                                </div>
                                <?php endif; ?>
                                <div class="b-services-content">
                                    <h3><a href="<?php echo esc_url($service_url); ?>"><?php the_title(); ?></a></h3>
                                    <p><?php echo esc_html($description); ?></p>
                                    <div class="sv-link">
                                        <a href="<?php echo esc_url($service_url); ?>"><?php echo esc_html($service_link_text); ?></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php 
                            endwhile;
                            wp_reset_postdata();
                        else : 
                        ?>
                        <div class="col-xl-12">
                            <p class="text-center">No services found. Please add services from WordPress Admin → Services.</p>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <!-- services-area end  -->

             <!-- video-bg-area start  -->
              
            <div class="video-bg-area pt-120 pb-120" style="background-image:url(<?php echo get_template_directory_uri(); ?>/assets/img/bg/video.jpg)">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-8 offset-xl-2 text-center">
                            <div class="b-video">
                                <div class="b-play mb-40">
                                    <a href="#"><i class="fal fa-play"></i></a>
                                </div>
                                <h2>Need Our Premium Services
                                Full Free & More</h2>
                                <div class="b-main-btn">
                                    <a class="b-btn" href="/services">
                                        <span>read more</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- video-bg-area end  -->

            <!-- work start  -->
            <div class="work-area-start pt-120 pb-90">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-6 col-lg-6 offset-lg-3 offset-xl-3">
                            <div class="section-title text-center mb-75">
                                <span>our works</span>
                                <h1>Project We Have Done</h1>
                            </div>
                        </div>
                    </div>
                    <div class="row text-center">
                        <?php
                        // Query 6 products dynamically
                        $products_query = new WP_Query(array(
                            'post_type' => 'product',
                            'posts_per_page' => 6,
                            'post_status' => 'publish',
                            'orderby' => 'menu_order',
                            'order' => 'ASC'
                        ));
                        
                        if ($products_query->have_posts()) :
                            while ($products_query->have_posts()) : $products_query->the_post();
                                $product_url = get_permalink();
                                
                                // Get description
                                $description = get_the_excerpt();
                                if (empty($description)) {
                                    $description = wp_trim_words(get_the_content(), 15, '...');
                                }
                        ?>
                        <div class="col-xl-4 col-lg-4 col-md-6">
                            <div class="b-work position-relative mb-30">
                                <?php if (has_post_thumbnail()) : ?>
                                <div class="b-work-img">
                                    <?php the_post_thumbnail('medium', array('alt' => get_the_title(), 'style' => 'width: 100%; height: auto;')); ?>
                                </div>
                                <?php endif; ?>
                                <div class="b-work-content-2">
                                    <div class="inner-work-2">
                                        <h2><a href="<?php echo esc_url($product_url); ?>"><?php the_title(); ?></a></h2>
                                        <p><?php echo esc_html($description); ?></p>
                                        <div class="b-work-link">
                                            <a href="<?php echo esc_url($product_url); ?>"><i class="far fa-long-arrow-right"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php 
                            endwhile;
                            wp_reset_postdata();
                        else : 
                        ?>
                        <div class="col-xl-12">
                            <p class="text-center">No products found. Please add products from WordPress Admin → Products.</p>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <!-- work end  -->

    </main>

    <?php  get_footer(); ?>
