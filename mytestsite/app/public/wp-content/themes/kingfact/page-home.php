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
<?php endif; ?>


    </main>

    <?php  get_footer(); ?>
