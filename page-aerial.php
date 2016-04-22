<?php
/*
Template Name: Aerial Tour Template
*/
get_header(); ?>

<?php 
	$bg = get_field('aerial_tour_page_background_image', 'options'); 

?>

<!-- Start the main container -->
<section class="container" role="document" style="background-image: url(<?php echo $bg; ?>);">

	<div class="row content">
		<h2 class="page-title"><?php echo $post->post_title; ?></h2>
<!-- Row for main content area -->
	<div class="small-12 columns" role="main">
		<div class="video-wrapper">
			<?php the_field('video_url'); ?>
		</div>

	</div>

	</div>

</section>
<?php get_footer(); ?>