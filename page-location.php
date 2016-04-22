<?php
/*
Template Name: Location Page
*/
get_header(); ?>

<?php 
if ( get_field('location_page_background_image', 'options') ) :
	$bg = get_field('location_page_background_image', 'options'); 
else :
	$bg = get_field('home_bg_image', 'optons'); 
endif;
?>

<!-- Start the main container -->
<section class="container" role="document" style="background-image: url(<?php echo $bg; ?>);">

	<div class="row content location">
		<h2 class="page-title">Location</h2>
<!-- Row for main content area -->
	<div class="small-12 columns" role="main">

		<?php echo do_shortcode('[mappress mapid="1"]'); ?>

		<div style="margin-top: 36px;">
			<?php the_post_thumbnail(); ?>
		</div>

	</div>

	</div>

</section>
<?php get_footer(); ?>