<?php
/*
Template Name: Home
*/
get_header(); ?>

<!-- Start the main container -->
<div>

	<div class="home-gallery">
		<div class="slider-wrap">
		<?php $gallery = get_field('homepage_gallery', 'options'); ?>
		<?php if ($gallery) : ?>
			<div class="slider">
				<?php foreach( $gallery as $image ) : ?>
					<div><img src="<?php echo $image['url']; ?>" ></div>
				<?php endforeach; ?>
				
			</div>
			<div class="prevnext"></div>
		</div>
		<div class="slider-nav-wrap">
			<div class="slider-nav">
				<?php foreach( $gallery as $image ) : ?>
					<div><img src="<?php echo $image['url']; ?>"></div>
				<?php endforeach; ?>
			</div>
			<div class="nav-prevnext"></div>
		</div>
		<?php endif; ?>
	</div>

</div>

<?php get_footer(); ?>