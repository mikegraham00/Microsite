<?php

/*

Template Name: Details Page

*/

get_header(); ?>



<!-- Start the main container -->

<section class="container" role="document" style="background-image: url(<?php the_field('details_page_background_image', 'options'); ?>);">



	<div class="row content">

		<h2 class="page-title">Property Details</h2>

		<?php /* Start loop */ ?>

		<?php $args = array ('post_type' => 'properties', 'posts_per_page' => 1); ?>

		<?php $prop = new WP_Query($args); ?>

		<?php while ($prop->have_posts()) : $prop->the_post(); ?>

		<div class="video-link">

			<?php if(get_field('lifestyle_video_title')) : ?>

				

				<div class="modal">

				  <label for="modal-1">

				    <a class="modal-trigger">Watch <?php the_field('lifestyle_video_title'); ?> Lifestyle Video</a>

				  </label>

				  <input class="modal-state" id="modal-1" type="checkbox" />

				  <div class="modal-fade-screen">

				    <div class="modal-inner">

				      <div class="modal-close" for="modal-1"></div>

				      

				      <div class="video-wrapper">

				      	<iframe src="<?php the_field('lifestyle_video'); ?>" height="560" width="315" allowfullscreen="" frameborder="0"></iframe>

				      </div>

				    </div>

				  </div>

				</div>

			<?php endif; ?>

		</div>



<!-- Row for main content area -->

	<div class="main" role="main">

	

	

	<div>

		<div >

			<?php 

				$rows = get_field('details');



				$row_count = count($rows);

				

				$halfrows = $row_count / 2;

				

			?>

			<div class="property-details-wrap">

			<?php if( have_rows('details') ) : ?>

				<div class="property-details first">

					<?php $rownum = 1; ?>

					<?php for( $i = 0; $i < $halfrows; $i+=1) : ?>

					

					

					

					<div class="details-block <?php echo ($rownum % 2 == 0) ? 'even' : 'odd'; ?>">

						

						<div class="detail-item"><?php echo $rows[$i]['detail_title']; ?></div><div class="detail-item"><?php echo $rows[$i]['detail_value']; ?></div>

						

					</div>

					<?php $rownum++; ?>

					<?php endfor; ?>

				</div>

				<div class="property-details">

					<?php $rownum = 1; ?>

					<?php for( $i = $halfrows; $i < $row_count; $i+=1) : ?>

					

					<div class="details-block <?php echo ($rownum % 2 == 0) ? 'even' : 'odd'; ?>">

						

						<div class="detail-item"><?php echo $rows[$i]['detail_title']; ?><?php echo strlen($rows[$i]['detail_title']) === 0 ? '&nbsp;' : ':'; ?></div><div class="detail-item"><?php echo $rows[$i]['detail_value']; ?></div>

						

					</div>

					

					<?php $rownum++; ?>

					<?php endfor; ?>

					<?php if( $row_count % 2 != 0) : //odd number of rows. add spacer cell. ?>

					<div class="details-block odd spacer">

						

						<div class="detail-item">&nbsp;</div><div class="detail-item">&nbsp;</div>

						

					</div>

					<?php endif; ?>

				</div>

			<?php endif; ?>

			</div>

		</div>

		

	</div>



	<?php if(get_field('property_description')) : ?>

	<div>

		<div class="">

			<h2>Description</h2>

			<?php the_field('property_description'); ?>

			

		</div>

	</div>

	<?php endif; ?>



	<div class="lower">

		

		<div class="printable">

			<?php if(have_rows('additional_pdfs')) : ?>

				<h2>Printable Information</h2>



					<?php while( have_rows('additional_pdfs') ) : the_row(); ?>

						<p><a href="<?php the_sub_field('pdf_file'); ?>" target="_blank"><?php the_sub_field('file_title'); ?></a></p>

					<?php endwhile; ?>



			<?php endif; ?>

		</div>

	</div>



	

	<?php endwhile; // End the loop ?>



	</div>

	</div>







</section>

<?php get_footer(); ?>