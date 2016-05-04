<?php
/*
Template Name: Full Width Template
*/
get_header(); ?>

<?php 
	$bg = get_field('aerial_tour_page_background_image', 'options'); 

?>
<?php if(have_posts()) : while( have_posts() ) : the_post(); ?>

<!-- Start the main container -->
<section class="container" role="document" style="background-image: url(<?php echo $bg; ?>);">

	<div class="row content location">
		<h2 class="page-title"><?php the_title(); ?></h2>
<!-- Row for main content area -->
	<div class="small-12 columns" role="main">
		
			<?php the_content(); ?>
		

	</div>

	</div>

</section>
<?php endwhile; endif; ?>
<?php get_footer(); ?>