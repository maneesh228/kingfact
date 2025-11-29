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

                    
                        // build specific animation frames for different layers
                        $group_frames = array(
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

                        $subtitle_frames = array(
                            array(
                                'delay' => '+620',
                                'speed' => 300,
                                'frame' => '0',
                                'from'  => 'x:-50px;opacity:0;',
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

                        $title_frames = array(
                            array(
                                'from'  => 'z:0;rX:0deg;rY:0;rZ:0;sX:1.5;sY:1.5;skX:0;skY:0;opacity:0;',
                                'mask'  => 'x:0px;y:0px;',
                                'speed' => 1500,
                                'to'    => 'o:1;',
                                'delay' => 1000,
                                'ease'  => 'Power3.easeInOut',
                            ),
                            array(
                                'delay' => 'wait',
                                'speed' => 1000,
                                'to'    => 'y:[100%];',
                                'mask'  => 'x:inherit;y:inherit;',
                                'ease'  => 'Power2.easeInOut',
                            ),
                        );

                        $desc_frames = array(
                            array(
                                'from'  => 'z:0;rX:0deg;rY:0;rZ:0;sX:1.5;sY:1.5;skX:0;skY:0;opacity:0;',
                                'mask'  => 'x:0px;y:0px;',
                                'speed' => 1500,
                                'to'    => 'o:1;',
                                'delay' => 1000,
                                'ease'  => 'Power3.easeInOut',
                            ),
                            array(
                                'delay' => 'wait',
                                'speed' => 1000,
                                'to'    => 'y:[100%];',
                                'mask'  => 'x:inherit;y:inherit;',
                                'ease'  => 'Power2.easeInOut',
                            ),
                        );

                        $button_frames = array(
                            array(
                                'delay' => '+1620',
                                'speed' => 300,
                                'frame' => '0',
                                'from'  => 'y:50px;opacity:0;',
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
                            array(
                                'frame' => 'hover',
                                'speed' => '0',
                                'ease'  => 'Linear.easeNone',
                                'to'    => 'o:1;rX:0;rY:0;rZ:0;z:0;',
                            ),
                        );

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
                            <div class="tp-caption     rev_group" id="rs-layes-<?php echo esc_attr( $i + 1 ); ?>" data-x="['center','center','center','center']"
                                data-hoffset="['0','0','0','0']"
                                data-y="['middle','middle','middle','middle']"
                                data-voffset="['0','0','0','-80']"
                                data-width="['988','772','595','99%']"
                                data-height="['370','280','230','200']" data-whitespace="nowrap"
                                data-type="group" data-responsive_offset="on" data-responsive="off"
                                data-frames='<?php echo esc_attr( wp_json_encode( $group_frames ) ); ?>'
                                data-margintop="[0,0,0,0]" data-marginright="[0,0,0,0]" data-marginbottom="[0,0,0,0]"
                                data-marginleft="[0,0,0,0]" data-textAlign="['inherit','inherit','inherit','inherit']"
                                data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]" data-paddingbottom="[0,0,0,0]"
                                data-paddingleft="[0,0,0,0]"
                                style="z-index: 5; min-width: 988px; max-width: 988px; max-width: 454px; max-width: 454px; white-space: nowrap; font-size: 20px; line-height: 22px; font-weight: 400; color: #ffffff; letter-spacing: 0px;"> 

                                <!-- Subtitle -->
                                <?php if ( $subtitle ) : ?>
                                    <div class="tp-caption  " id="rs-layes-sub-<?php echo esc_attr( $i + 1 ); ?>"
                                        data-x="['center','center','center','center']" data-hoffset="['0','0','0','0']"
                                        data-y="['top','top','top','top']" data-voffset="['0','0','0','0']"
                                        data-width="['988','772','595','350']"
                                        data-lineheight="['25','25','25','25']"
                                        data-height="none"
                                        data-whitespace="normal"
                                        data-type="text"
                                        data-responsive_offset="off"
                                        data-responsive="off"
                                        data-frames='<?php echo esc_attr( wp_json_encode( $subtitle_frames ) ); ?>'
                                        data-margintop="[0,0,0,0]" data-marginright="[0,0,0,0]" data-marginbottom="[0,0,0,0]" data-marginleft="[0,0,0,0]"
                                        data-textAlign="['center','center','center','center']" data-paddingtop="[10,10,10,10]"
                                        data-paddingright="[10,10,10,10]" data-paddingbottom="[10,10,10,10]" data-paddingleft="[10,10,10,10]"
                                        style="z-index: 7; white-space: normal; font-size: 14px; line-height: 12px; font-weight: 700; color: #ffffff; letter-spacing: 2px;font-family:'Roboto', sans-serif;text-transform:uppercase;text-align: center;">
                                        <?php echo esc_html( $subtitle ); ?>
                                    </div>
                                <?php endif; ?>

                                <!-- Big Title -->
                                    <div class="tp-caption  " id="rs-layes-title-<?php echo esc_attr( $i + 1 ); ?>"
                                        data-x="['center','center','center','center']"
                                        data-hoffset="['0','0','0','0']"
                                        data-y="['top','top','top','top']"
                                        data-voffset="['70','50','50','80']"
                                        data-fontsize="['95','80','50','30']"
                                        data-lineheight="['100','90','60','35']"
                                        data-fontweight="['700','700','700','700']" data-width="['970','900','550','350']" data-height="none"
                                        data-whitespace="normal" data-type="text" data-responsive_offset="off" data-responsive="off"
                                        data-frames='<?php echo esc_attr( wp_json_encode( $title_frames ) ); ?>'
                                        data-margintop="[0,0,0,0]" data-marginright="[0,0,0,0]" data-marginbottom="[0,0,0,0]" data-marginleft="[0,0,0,0]"
                                        data-textAlign="['center','center','center','center']" data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                        data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                        style="z-index: 6; min-width: 350px; max-width: 800px; white-space: normal; font-size: 90px; line-height: 105px; font-weight: 900; color: #ffffff; letter-spacing: 0px;font-family:'Roboto', sans-serif;">
                                        <?php echo esc_html( $bigtitle ); ?>
                                </div>

                                <!-- Description (editor content) -->
                                <?php if ( $content ) : ?>
                                    <div class="tp-caption  " id="rs-layes-desc-<?php echo esc_attr( $i + 1 ); ?>"
                                        data-x="['center','center','center','center']"
                                        data-hoffset="['0','0','0','0']"
                                        data-y="['top','top','top','top']"
                                        data-voffset="['190','150','120','130']"
                                        data-fontsize="['16','16','16','16']" data-lineheight="['30','30','30','30']"
                                        data-fontweight="['500','500','500','500']" data-width="['750','750','550','350']" data-height="none"
                                        data-whitespace="normal" data-type="text" data-responsive_offset="off" data-responsive="off"
                                        data-frames='<?php echo esc_attr( wp_json_encode( $desc_frames ) ); ?>'
                                        data-margintop="[0,0,0,0]" data-marginright="[0,0,0,0]" data-marginbottom="[0,0,0,0]" data-marginleft="[0,0,0,0]"
                                        data-textAlign="['center','center','center','center']" data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                        data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                        style="z-index: 6; white-space: normal; font-size: 16px; font-weight: 500; color: #ffffff; letter-spacing: 0px;font-family:'Roboto', sans-serif;">
                                        <?php echo wp_kses_post( $content ); ?>
                                    </div>
                                <?php endif; ?>

                                <!-- Button -->
                                <?php if ( $btn_text && $btn_url ) : ?>
                                    <div class="tp-caption" id="rs-layes-btn-<?php echo esc_attr( $i + 1 ); ?>"
                                        data-x="['center','center','center','center']"
                                        data-hoffset="['0','0','0','0']"
                                        data-y="['bottom','bottom','bottom','bottom']"
                                        data-voffset="['0','-20','-50','-130']" data-width="none"
                                        data-height="none" data-whitespace="nowrap" data-type="button" data-actions='' data-responsive_offset="off"
                                        data-responsive="off"
                                        data-frames='<?php echo esc_attr( wp_json_encode( $button_frames ) ); ?>'
                                        data-margintop="[0,0,0,0]" data-marginright="[0,0,0,0]" data-marginbottom="[0,0,0,0]"
                                        data-marginleft="[0,0,0,0]" data-textAlign="['inherit','inherit','inherit','inherit']"
                                        data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]" data-paddingbottom="[0,0,0,0]"
                                        data-paddingleft="[0,0,0,0]"
                                        style="z-index: 9;">
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

            <!-- counter-area-start -->
            <?php
            // Counter 1
            $counter1_icon = get_field('counter1_icon');
            $counter1_number = get_field('counter1_number');
            $counter1_label = get_field('counter1_label');
            
            // Counter 2
            $counter2_icon = get_field('counter2_icon');
            $counter2_number = get_field('counter2_number');
            $counter2_label = get_field('counter2_label');
            
            // Counter 3
            $counter3_icon = get_field('counter3_icon');
            $counter3_number = get_field('counter3_number');
            $counter3_label = get_field('counter3_label');
            ?>
            <div class="counter-area pos-rel pt-120 pb-90" style="background-image:url(<?php echo get_template_directory_uri(); ?>/assets/img/bg/fact-bg.jpg)">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-3 col-lg-3 col-md-6">
                            <div class="section-title mt-15 mb-30">
                                <span>fun fact</span>
                                <h1>Let's See Our Fun Facts</h1>
                                <div class="mb-20"></div>
                                <p>But I must explain to you how amistaken idea denouncing pleasure praising</p>
                                <div class="fact-btn mt-20">
                                    <a class="text-btn" href="/products">
                                        read more
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-3 col-md-6">
                            <div class="counter-wrapper counter-wrapper-2 mb-30">
                                <div class="counter-icon">
                                    <i class="<?php echo $counter1_icon ? esc_attr($counter1_icon) : 'fal fa-anchor'; ?>"></i>
                                </div>
                                <div class="counter-text">
                                    <h1 class="counter"><?php echo $counter1_number ? esc_html($counter1_number) : '2000'; ?></h1>
                                    <span><?php echo $counter1_label ? esc_html($counter1_label) : 'Project Done'; ?></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-3 col-md-6">
                            <div class="counter-wrapper counter-wrapper-2 mb-30">
                                <div class="counter-icon">
                                    <i class="<?php echo $counter2_icon ? esc_attr($counter2_icon) : 'fal fa-ball-pile'; ?>"></i>
                                </div>
                                <div class="counter-text">
                                    <h1 class="counter"><?php echo $counter2_number ? esc_html($counter2_number) : '3500'; ?></h1>
                                    <span><?php echo $counter2_label ? esc_html($counter2_label) : 'Power Plants'; ?></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-3 col-md-6">
                            <div class="counter-wrapper counter-wrapper-2 mb-30">
                                <div class="counter-icon">
                                    <i class="<?php echo $counter3_icon ? esc_attr($counter3_icon) : 'fal fa-hospital-user'; ?>"></i>
                                </div>
                                <div class="counter-text">
                                    <h1 class="counter"><?php echo $counter3_number ? esc_html($counter3_number) : '2630'; ?></h1>
                                    <span><?php echo $counter3_label ? esc_html($counter3_label) : 'Qualified Staff'; ?></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- counter-area-end -->

            <!-- testimonial-area -->
            <div class="client-area black-bg pt-125 pb-130">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-6 col-lg-6 offset-lg-3 offset-xl-3">
                            <div class="section-title white-title text-center mb-75">
                                <span>what our clients say</span>
                                <h1>Clients Testimonials</h1>
                            </div>
                        </div>
                    </div>
                    <div class="row client-active arrow-style">
                        <?php
                        // Query testimonials
                        $testimonials_query = new WP_Query(array(
                            'post_type' => 'testimonial',
                            'posts_per_page' => -1,
                            'post_status' => 'publish',
                            'orderby' => 'menu_order',
                            'order' => 'ASC'
                        ));
                        
                        if ($testimonials_query->have_posts()) :
                            while ($testimonials_query->have_posts()) : $testimonials_query->the_post();
                                $client_name = get_post_meta(get_the_ID(), '_testimonial_client_name', true);
                                $client_position = get_post_meta(get_the_ID(), '_testimonial_client_position', true);
                                
                                // Fallback to post title if name not set
                                if (empty($client_name)) {
                                    $client_name = get_the_title();
                                }
                        ?>
                        <div class="col-xl-12">
                            <div class="client-wrapper text-center">
                                <?php if (has_post_thumbnail()) : ?>
                                <div class="client-img pos-rel">
                                    <?php the_post_thumbnail('thumbnail', array('alt' => esc_attr($client_name))); ?>
                                </div>
                                <?php endif; ?>
                                <div class="client-content">
                                    <?php if (get_the_content()) : ?>
                                    <p><?php echo wp_kses_post(get_the_content()); ?></p>
                                    <?php endif; ?>
                                    <div class="client-text">
                                        <h4><?php echo esc_html($client_name); ?></h4>
                                        <?php if ($client_position) : ?>
                                        <span><?php echo esc_html($client_position); ?></span>
                                        <?php endif; ?>
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
                            <p class="text-center" style="color: #fff;">No testimonials found. Please add testimonials from WordPress Admin → Testimonials.</p>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <!-- testimonial-area end -->

            <!-- our goals section -->
            <?php echo do_shortcode('[our_goals]'); ?>
            <!-- our goals section end -->

            <!-- blog-area-start -->
            <div class="blog-area pt-125 pb-100 grey-2-bg">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-6 col-lg-6 offset-lg-3 offset-xl-3">
                            <div class="section-title text-center mb-75">
                                <span>articles & tips</span>
                                <h1>Latest News & Blog</h1>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <?php
                        // Query for latest 2 blog posts
                        $blog_args = array(
                            'post_type' => 'post',
                            'posts_per_page' => 2,
                            'orderby' => 'date',
                            'order' => 'DESC',
                        );
                        $blog_query = new WP_Query($blog_args);
                        
                        if ($blog_query->have_posts()) : 
                        ?>
                        <div class="col-xl-8 col-lg-8">
                            <?php 
                            while ($blog_query->have_posts()) : $blog_query->the_post(); 
                                $post_date = get_the_date('d M Y');
                                $comments_count = get_comments_number();
                                $featured_img = get_the_post_thumbnail_url(get_the_ID(), 'full');
                                if (!$featured_img) {
                                    $featured_img = get_template_directory_uri() . '/assets/img/blog/blog-01.jpg';
                                }
                            ?>
                            <div class="blog-bg bg-white mb-30">
                                <div class="row no-gutters">
                                    <div class="col-xl-6">
                                        <div class="blog-img">
                                            <a href="<?php the_permalink(); ?>"><img src="<?php echo esc_url($featured_img); ?>" alt="<?php the_title_attribute(); ?>"></a>
                                        </div>
                                    </div>
                                    <div class="col-xl-6">
                                        <div class="single-blog">
                                            <div class="blog-text">
                                                <div class="blog-meta">
                                                    <span class="meta-date-bg"> <i class="far fa-calendar-alt"></i> <?php echo esc_html($post_date); ?></span>
                                                    <span> <a href="<?php the_permalink(); ?>"><i class="far fa-comment"></i> Comments (<?php echo esc_html($comments_count); ?>)</a></span>
                                                </div>
                                                <h4><a href="<?php the_permalink(); ?>"><?php echo wp_trim_words(get_the_title(), 12, '...'); ?></a></h4>
                                                <a href="<?php the_permalink(); ?>">Read More <i class="dripicons-arrow-thin-right"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php 
                            endwhile;
                            ?>
                        </div>
                        <div class="col-xl-4 col-lg-4">
                            <div class="blog-banner-img mb-30">
                                <?php
                                // Get the very latest blog post for the banner (separate query to ensure we get the most recent)
                                $banner_query = new WP_Query(array(
                                    'post_type' => 'post',
                                    'posts_per_page' => 1,
                                    'orderby' => 'date',
                                    'order' => 'DESC',
                                ));
                                
                                
                                if ($banner_query->have_posts()) {
                                    $banner_query->the_post();
                                    $banner_link = get_permalink();
                                    $banner_img = get_the_post_thumbnail_url(get_the_ID(), 'full');
                                    if (!$banner_img) {
                                        $banner_img = get_template_directory_uri() . '/assets/img/blog/blog.jpg';
                                    }
                                    wp_reset_postdata();
                                } else {
                                    $banner_link = home_url('/blog');
                                    $banner_img = get_template_directory_uri() . '/assets/img/blog/blog.jpg';
                                }
                                ?>
                                <a href="<?php echo esc_url($banner_link); ?>">
                                    <img src="<?php echo esc_url($banner_img); ?>" alt="Latest Blog Post">
                                </a>
                            </div>
                        </div>
                        <?php 
                            wp_reset_postdata();
                        else : ?>
                        <div class="col-xl-12">
                            <p class="text-center">No blog posts found.</p>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <!-- blog-area-end -->

            <!-- brand-area-start -->
            <div class="brand-area pt-130 pb-130">
                <div class="container">
                    <div class="row brand-active">
                        <?php
                        // Query for brand images from WordPress Media Library
                        $brand_args = array(
                            'post_type' => 'attachment',
                            'post_mime_type' => 'image',
                            'post_status' => 'inherit',
                            'posts_per_page' => -1,
                            'orderby' => 'date',
                            'order' => 'DESC',
                            'meta_query' => array(
                                array(
                                    'key' => '_wp_attachment_image_alt',
                                    'value' => 'brand',
                                    'compare' => 'LIKE'
                                )
                            )
                        );
                        
                        $brand_query = new WP_Query($brand_args);
                        
                        if ($brand_query->have_posts()) :
                            while ($brand_query->have_posts()) : $brand_query->the_post();
                                $brand_img_url = wp_get_attachment_url(get_the_ID());
                                $brand_alt = get_post_meta(get_the_ID(), '_wp_attachment_image_alt', true);
                        ?>
                        <div class="col-xl-12">
                            <div class="brand-img text-center">
                                <img src="<?php echo esc_url($brand_img_url); ?>" alt="<?php echo esc_attr($brand_alt); ?>" />
                            </div>
                        </div>
                        <?php 
                            endwhile;
                            wp_reset_postdata();
                        else : 
                            // Fallback to default brand images if no media found
                            for ($i = 1; $i <= 5; $i++) :
                        ?>
                        <div class="col-xl-12">
                            <div class="brand-img text-center">
                                <img src="<?php echo get_template_directory_uri(); ?>/assets/img/brand/0<?php echo $i; ?>.png" alt="Brand <?php echo $i; ?>" />
                            </div>
                        </div>
                        <?php 
                            endfor;
                        endif; 
                        ?>
                    </div>
                </div>
            </div>
            <!-- brand-area-end -->

            <!-- newsletter-area-start -->
            <div class="newsletter-area pt-60 pb-30" style="background-image:url(<?php echo get_template_directory_uri(); ?>/assets/img/bg/newsletter.jpg)">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-5 col-lg-5 mb-30">
                            <div class="newsletter-text">
                                <span>to get more information</span>
                                <h1>Subscribe Newsletter</h1>
                            </div>
                        </div>
                        <div class="col-xl-7 col-lg-7 mb-30">
                            <div class="single-newsletters ">
                                <div class="newsletter-form">
                                    <form id="newsletter-form" method="post">
                                        <input id="newsletter-email" name="newsletter_email" placeholder="Enter Your Email :" type="email" required>
                                        <div class="newsletter-btn">
                                            <button class="b-btn btn-black-bg" type="submit"><span>subscribe</span></button>
                                        </div>
                                        <div id="newsletter-message" style="margin-top: 15px; color: #fff;"></div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- newsletter-area-end -->

    </main>

    <?php  get_footer(); ?>
