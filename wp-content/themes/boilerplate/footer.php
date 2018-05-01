<footer>
    <section><?php wp_nav_menu( array( 'menu' => 'Footer menu', 'container' => 'nav' ) ); ?></section>
    <section><?php dynamic_sidebar( 'footer-section-2' ) ?></section>
    <section><?php dynamic_sidebar( 'footer-section-3' ) ?></section>
    <section><?php dynamic_sidebar( 'footer-section-4' ) ?></section>
</footer>

<?php wp_footer(); ?>
</body>
</html>