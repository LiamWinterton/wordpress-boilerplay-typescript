<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php wp_title(' - ', TRUE, 'right'); ?></title>
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
    <header>
        <div class="container">
            
            <?php get_template_part( 'lib/templates/global/logo' ); ?>

            <?php get_template_part( 'lib/templates/menus/header' ); ?>

        </div>
    </header>