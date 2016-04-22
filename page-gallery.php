<?php
/*
Template Name: Gallery Page
*/
get_header(); ?>

<!-- Start the main container -->
<section class="container" role="document" style="background-image: url(<?php the_field('gallery_page_background_image', 'options'); ?>);">

	<div class="row content gallery">
		

<!-- Row for main content area -->
		<div class="small-12 columns" role="main">


			<?php

			$images = get_field('gallery');

			//var_dump($images);

			if( $images ): ?>
				<div class="slider-wrap">
				    <div id="slider" class="slider">
				        
				            <?php foreach( $images as $image ): ?>
				                <div>
				                    <img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" />
				                </div>
				            <?php endforeach; ?>

				    </div>
				    <div class="prevnext"></div>
			    </div>

			    <div class="slider-nav-wrap">
			    	<div class="slider-nav">
			    		<?php foreach( $images as $image ): ?>
			                <div>
			                    <img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" />
			                </div>
			            <?php endforeach; ?>
			    	</div>
			    	<div class="nav-prevnext"></div>
			    </div>
			<?php endif; ?>
		</div>

		
	</div>

</section>

<?php get_footer(); ?>