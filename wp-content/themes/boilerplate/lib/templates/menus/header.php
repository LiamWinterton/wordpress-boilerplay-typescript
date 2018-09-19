<div class="main-menu">
	<label data-toggle='header-menu'>
		<i class="fas fa-caret-right"></i>
	</label>

	<div id="header-menu" class="mobile-menu">
		<div class="menu-header">
			<h2>Header MMenu</h2>
		</div>

		<div class="menu-content">
			<?php wp_nav_menu( array( 'theme_location' => 'header-menu', 'container' => 'nav' ) ); ?>
		</div>

		<div class="menu-footer">
			<?php // get_template_part( 'lib/templates/global/social' ); ?>
		</div>

		<div class="menu-overlay"></div>
	</div>
</div>