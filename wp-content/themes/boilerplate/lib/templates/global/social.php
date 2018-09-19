<?php
$social_media = array(
	'facebook' 	 => get_field( 'facebook', 'options' ),
	'twitter' 	 => get_field( 'twitter', 'options' ),
	'instagram'   => get_field( 'instagram', 'options' ),
	'youtube'   => get_field( 'youtube', 'options' ),
	'google-plus' => get_field( 'google_plus', 'options' )
);
?>

<div class="social-media">
	<?php foreach($social_media as $social_key => $link ) { ?>
		<?php if($link) { ?>
			<div class="<?php echo $social_key; ?>">
				<a href="<?php echo $link; ?>">
					<?php if($social_key == 'instagram') { ?>
						<svg width="0" height="0" id="fake-svg">
							<radialGradient id="instagram" r="150%" cx="30%" cy="107%">
								<stop stop-color="#fdf497" offset="0" />
								<stop stop-color="#fdf497" offset="0.05" />
								<stop stop-color="#fd5949" offset="0.45" />
								<stop stop-color="#d6249f" offset="0.6" />
								<stop stop-color="#285AEB" offset="0.9" />
							</radialGradient>
						</svg>
					<?php } ?>
					<i class="fab fa-<?php echo $social_key; ?>"></i>
				</a>
			</div>
		<?php } ?>
	<?php } ?>
</div>