<footer>
    <div class="container">
    <div class="footer-section"><?php wp_nav_menu( array( 'theme_location' => 'footer-menu', 'container' => 'nav' ) ); ?></div>
        <div class="footer-section"><?php dynamic_sidebar( 'footer-section-2' ) ?></div>
        <div class="footer-section"><?php dynamic_sidebar( 'footer-section-3' ) ?></div>
        <div class="footer-section"><?php dynamic_sidebar( 'footer-section-4' ) ?></div>
    </div>
</footer>

<?php wp_footer(); ?>
</body>
</html>