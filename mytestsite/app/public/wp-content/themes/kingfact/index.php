<?php
// index.php — Standalone Kingfact theme
// Reads /wp-content/themes/Kingfact/assets/index-2.html, extracts head+body,
// rewrites asset paths (assets/ -> theme assets URL) and outputs them so CSS loads.

?><!doctype html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo( 'charset' ); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">

<?php
// Path to the theme copy of the static HTML
$static_file = get_template_directory() . '/assets/index-2.html';
$head_html = '';
$body_html = '';

if ( file_exists( $static_file ) && is_readable( $static_file ) ) {
    $raw = file_get_contents( $static_file );

    // Extract head and body (if present)
    if ( preg_match( '/<head[^>]*>(.*?)<\/head>/is', $raw, $hm ) ) {
        $head_html = $hm[1];
    }

    if ( preg_match( '/<body[^>]*>(.*?)<\/body>/is', $raw, $bm ) ) {
        $body_html = $bm[1];
    } else {
        // Fallback: if no <body>, use the entire file as body
        $body_html = $raw;
    }

    // Theme assets base URL used for rewriting "assets/..." references
    $theme_url = rtrim( get_template_directory_uri(), '/' ) . '/assets/';

    // Helper: rewrite assets/... occurrences in any HTML chunk
    $rewrite_assets = function( $html_chunk ) use ( $theme_url ) {
        // 1) rewrite src/href attributes that reference assets/
        $html_chunk = preg_replace_callback(
            '/\b(src|href)\s*=\s*([\'"])\s*(?:\.\/|\/)?((?:assets\/)+)([^\'"]+)\2/i',
            function( $m ) use ( $theme_url ) {
                return $m[1] . '=' . $m[2] . $theme_url . $m[4] . $m[2];
            },
            $html_chunk
        );

        // 2) rewrite data-* attributes referencing assets (data-thumb,data-src,etc.)
        $html_chunk = preg_replace_callback(
            '/\b(data-(?:thumb|src|lazy|bg|background|image|original))\s*=\s*([\'"])\s*(?:\.\/|\/)?((?:assets\/)+)([^\'"]+)\2/i',
            function( $m ) use ( $theme_url ) {
                return $m[1] . '=' . $m[2] . $theme_url . $m[4] . $m[2];
            },
            $html_chunk
        );

        // 3) rewrite url(...) occurrences (background-image etc.)
        $html_chunk = preg_replace_callback(
            '/url\(\s*([\'"])?(?:\.\/|\/)?((?:assets\/)+)([^\'")]+)\1\s*\)/i',
            function( $m ) use ( $theme_url ) {
                return 'url(' . $theme_url . $m[3] . ')';
            },
            $html_chunk
        );

        // 4) rewrite any unquoted src/href cases (rare)
        $html_chunk = preg_replace_callback(
            '/\b(src|href)\s*=\s*(?:\.\/|\/)?((?:assets\/)+)([^>\s]+)/i',
            function( $m ) use ( $theme_url ) {
                $quote = '"';
                return $m[1] . '=' . $quote . $theme_url . $m[3] . $quote;
            },
            $html_chunk
        );

        $html_chunk = preg_replace_callback(
    '/background-image\s*:\s*url\(\s*[\'"]?(?:\.\/|\/)?assets\/([^\'")]+)[\'"]?\s*\)/i',
    function( $m ) use ( $theme_url ) {
        return 'background-image:url(' . $theme_url . $m[1] . ')';
    },
    $html_chunk
);

        

        return $html_chunk;
    };

    // Rewrite both head and body content so CSS/JS/img paths point to theme assets
    $head_html = $rewrite_assets( $head_html );
    $body_html = $rewrite_assets( $body_html );

} // end if file exists

// Print rewritten head HTML BEFORE wp_head so styles from the static file appear in <head>
if ( ! empty( $head_html ) ) {
    // Only output link/style/script tags from the head; avoid duplicating meta tags that WP manages.
    // We'll filter to common tags (link, style, script) to be safe.
    if ( preg_match_all( '/<(link|style|script)[\s\S]*?<\/(?:style|script)>|<link[^>]+>/i', $head_html, $head_matches ) ) {
        foreach ( $head_matches[0] as $tag ) {
            echo $tag . "\n";
        }
    } else {
        // If no match, output head chunk as-is (fallback)
        echo $head_html . "\n";
    }
}

// Let plugins & WP print their head items (meta, enqueued styles etc.)
wp_head();
?>

</head>
<body <?php body_class(); ?>>

  <div id="site-content">

    <?php
    // If no static file, show helpful debug
    if ( empty( $body_html ) ) {
        echo '<div style="padding:20px;background:#fff;border:1px solid #ddd;">';
        echo '<h2>Static page not found or empty</h2>';
        echo '<p>Expected: <code>' . esc_html( get_template_directory() . "/assets/index-2.html" ) . '</code></p>';
        echo '</div>';
    } else {
        // Output the processed body HTML (already had assets/ rewritten)
        echo $body_html;
    }
    ?>

  </div><!-- #site-content -->

<?php wp_footer(); ?>
</body>
</html>
