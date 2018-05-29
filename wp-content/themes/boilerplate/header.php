<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php wp_title(' - ', TRUE, 'right'); bloginfo('name'); ?></title>
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
    <header>
        <div class="container">
            <div id="logo">
                <a href="<?php echo get_site_url(); ?>"><img src="<?php echo get_stylesheet_directory_uri() . '/lib/images/logo.png'; ?>" alt="prefix" /></a>
            </div>
            <?php wp_nav_menu( array( 'theme_location' => 'header-menu', 'container' => 'nav' ) ); ?>
        </div>
    </header>