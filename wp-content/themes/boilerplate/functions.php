<?php

/**
 * Registers an array of theme supports
 * 
 * @return void
 */
function prefix_theme_support( $features ) {
    foreach( $features as $key => $feature ) {
        add_theme_support( $feature );
    }
}
prefix_theme_support( array( 'post-thumbnails' ) );

/**
 * Adds our stylesheet into the header
 *
 * @return void
 */
function prefix_enqueue_styles() {
    wp_enqueue_style( 'reset', get_stylesheet_directory_uri() . '/reset.css' );

    if(defined('WP_LOCALHOST')) {
        wp_enqueue_style( 'prefix', 'http://localhost:8080/stylesheet.css' );
    } else {
        wp_enqueue_style( 'prefix', get_stylesheet_directory_uri() . '/stylesheet.css' );
    }
}

/**
 * Adds our javascript into the header
 *
 * @return void
 */
function prefix_enqueue_scripts() {
    if(defined('WP_LOCALHOST')) {
        wp_enqueue_script( 'prefix', 'http://localhost:8080/bundle.js', array( 'jquery' ) );
    } else {
        wp_enqueue_script( 'prefix', get_stylesheet_directory_uri() . '/bundle.js', array( 'jquery' ) );
    }
}
add_action( 'wp_enqueue_scripts', 'prefix_enqueue_styles' );
add_action( 'wp_enqueue_scripts', 'prefix_enqueue_scripts' );

/**
 * Add custom menus in the admin
 *
 * @return void
 */
function prefix_custom_menus() {
    register_nav_menus(array(
        'header-menu' => 'Header Menu',
        'footer-menu' => 'Footer Menu',
    ));
}
add_action( 'init', 'prefix_custom_menus' );

/**
 * Create footer "sidebars" for use in template
 *
 * @return void
 */
function prefix_custom_sidebars() {
    for($i = 1; $i < 5; $i++ ) {
        $args = array(
            'id'            => 'footer-section-' . $i,
            'name'          => __( 'Footer section - ' . $i, 'text_domain' ),
            'before_title'  => '<h2 class="title">',
            'after_title'   => '</h2>',
            'before_widget' => '<div class="widgetarea">',
            'after_widget'  => '</div>',
        );
        register_sidebar( $args );
    }        
}
add_action( 'widgets_init', 'prefix_custom_sidebars' );

/**
 * Alters the default read more html given by wordpress
 */
function prefix_excerpt_trail( $more ) {
    return '<span class="read-more">...</span>';
}
add_filter('excerpt_more', 'prefix_excerpt_trail');

// =============================================================================================================================================
// =============================================================================================================================================
// =============================================================================================================================================
// END CUSTOM CODE - BELOW IS OPTIMIZING WORDPRESS
// =============================================================================================================================================
// =============================================================================================================================================
// =============================================================================================================================================

/**
* Remove query strings
*/
function crave_remove_script_version( $src ) {
	$parts = explode( '?ver', $src );
	return $parts[0]; 
} 
add_filter( 'script_loader_src', 'crave_remove_script_version', 15, 1 );
add_filter( 'style_loader_src', 'crave_remove_script_version', 15, 1 );

/**
* Disable the emoji's
*/
function crave_disable_emojis() {
	remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
	remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
	remove_action( 'wp_print_styles', 'print_emoji_styles' );
	remove_action( 'admin_print_styles', 'print_emoji_styles' ); 
	remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
	remove_filter( 'comment_text_rss', 'wp_staticize_emoji' ); 
	remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
	add_filter( 'tiny_mce_plugins', 'crave_disable_emojis_tinymce' );
	add_filter( 'wp_resource_hints', 'crave_disable_emojis_remove_dns_prefetch', 10, 2 );
}
add_action( 'init', 'crave_disable_emojis' );

/**
* Filter function used to remove the tinymce emoji plugin.
* 
* @param array $plugins 
* @return array Difference betwen the two arrays
*/
function crave_disable_emojis_tinymce( $plugins ) {
	if ( is_array( $plugins ) ) {
		return array_diff( $plugins, array( 'wpemoji' ) );
	} else {
		return array();
	}
}

/**
* Remove emoji CDN hostname from DNS prefetching hints.
*
* @param array $urls URLs to print for resource hints.
* @param string $relation_type The relation type the URLs are printed for.
* @return array Difference betwen the two arrays.
*/
function crave_disable_emojis_remove_dns_prefetch( $urls, $relation_type ) {
	if ( 'dns-prefetch' == $relation_type ) {
		/** This filter is documented in wp-includes/formatting.php */
		$emoji_svg_url = apply_filters( 'emoji_svg_url', 'https://s.w.org/images/core/emoji/2/svg/' );
		$urls = array_diff( $urls, array( $emoji_svg_url ) );
	}
	return $urls;
}

function crave_remove_jquery_migrate( &$scripts) {
	if(!is_admin()) {
		$scripts->remove('jquery');
		$scripts->add('jquery', false, array( 'jquery-core' ), '1.12.4');
	}
}
add_action( 'wp_default_scripts', 'crave_remove_jquery_migrate' );

/**
* Function to defer all scripts which are not excluded
*/
function crave_js_defer_attr($tag) {
	if (is_admin()) {
		return $tag;
	}
	// Do not add defer attribute to these scripts
	$scripts_to_exclude = array('jquery.js'); // add a string of js file e.g. script.js

	foreach($scripts_to_exclude as $exclude_script) {
		if (true == strpos($tag, $exclude_script ) )
			return $tag; 
	}
	// Defer all remaining scripts not excluded above
	return str_replace( ' src', ' defer src', $tag );
}
add_filter( 'script_loader_tag', 'crave_js_defer_attr', 10);

/**
* Remove junk from head
*/
function crave_remove_version() {
	return '';
}
add_filter('the_generator', 'crave_remove_version');
remove_action('wp_head', 'wp_generator');

remove_action('wp_head', 'rsd_link'); // remove really simple discovery (RSD) link
remove_action('wp_head', 'wlwmanifest_link'); // remove wlwmanifest.xml (needed to support windows live writer)

remove_action('wp_head', 'feed_links', 2); // remove rss feed links (if you don't use rss)
remove_action('wp_head', 'feed_links_extra', 3); // removes all extra rss feed links

remove_action('wp_head', 'index_rel_link'); // remove link to index page

remove_action('wp_head', 'start_post_rel_link', 10, 0); // remove random post link
remove_action('wp_head', 'parent_post_rel_link', 10, 0); // remove parent post link
remove_action('wp_head', 'adjacent_posts_rel_link', 10, 0); // remove the next and previous post links
remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 );

remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0 ); // remove shortlink