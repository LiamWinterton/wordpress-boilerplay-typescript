<?php

/**
 * Adds our stylesheet into the header
 *
 * @return void
 */
function prefix_enqueue_styles() {
    wp_enqueue_style( 'reset', get_stylesheet_directory_uri() . '/reset.css' );

    if(defined('WP_LOCALHOST')) {
        wp_enqueue_style( 'prefix', 'http://localhost:8080/sites/wordpress-boilerplate/stylesheet.css' );
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
        wp_enqueue_script( 'prefix', 'http://localhost:8080/sites/wordpress-boilerplate/bundle.js' );
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
        'Header menu' => __( 'Header menu' ),
        'Footer menu' => __( 'Footer menu' ),
    ));
}
add_action( 'init', 'prefix_custom_menus' );

/**
 * Create footer "sidebars" for use in template
 *
 * @return void
 */
function prefix_custom_sidebars() {
    for($i = 2; $i < 5; $i++ ) {
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