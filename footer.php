
<?php 

$agent = get_posts(array(
							'posts_per_page' => 1,
							'post_type' => 'agents'
						));
$showagent = get_field('always_show_agent', 'options');

?>

<footer class="container full-width" role="contentinfo">
	<?php if(!$showagent) : ?>
	<div class="contact-toggle">Contact Agent</div>
	<?php endif; ?>
	<div class="centered agent-wrap <?= $showagent ? 'always-open' : ''; ?>">
		<div class="agent-info">
			<div class="agent-photo">
				<?php foreach ($agent as $a) : $id = $a->ID; ?>

					<img src="<?php the_field('agent_image', $id); ?>">
				<?php endforeach; ?>
			</div>
			<div class="agent-contact">
				<?php foreach ($agent as $a) : $id = $a->ID; ?>
				<div class="top">
					<h3>
						<?php if( get_field('agent_website', $id) ) : ?>
						<a href="http://<?php the_field('agent_website', $id); ?>">
							<?php echo get_field('name', $id); ?>
						</a>
					<?php else : ?>
						<?php echo get_field('name', $id); ?>
					<?php endif; ?>
					</h3>
					<p class="agent-title"><?php the_field('title', $id); ?>
						<?php if( get_field('elite_25', $id) ) : ?>
						,<img src="<?php echo get_template_directory_uri() . '/img/Elite25Logo-New.png'; ?>" />
						<?php endif; ?>
					</p>
				</div>
				<div class="bottom">
					<p class="phone">c: <?php the_field('agent_mobile_phone', $id); ?></p>
					<p class="phone">o: <?php the_field('agent_office_phone', $id); ?></p>
					<p class="email">e: <a href="mailto:<?php the_field('agent_email', $id); ?>"><?php the_field('agent_email', $id); ?></a></p>
				</div>
					
				<?php endforeach; ?>
			</div>
		</div>
	</div>

	
	<div class="logos">
		<img src="<?php echo get_template_directory_uri() . '/img/LREC-logo.svg'; ?>">
		<img src="<?php echo get_template_directory_uri() . '/img/CIRE-logo.svg'; ?>">
		<img src="<?php echo get_template_directory_uri() . '/img/LPI-logo.svg'; ?>">
	</div>
</footer>

<?php wp_footer(); ?>

<script>
	(function($) {

		$('.menu-toggle').click(function(){
			$('.top-nav').slideToggle('slow');
		});

		$('.contact-toggle').click(function(){
			$('.agent-wrap').slideToggle('slow');
		});

	})(jQuery);
</script>

<?php if( is_home() || is_front_page() ) : ?>
<script>
	jQuery(document).ready(function($) {
		$('.slider').slick({
			slidesToShow: 1,
			arrows: true,
			appendArrows: '.prevnext',
			//asNavFor: '.slider-nav',
			prevArrow: '<span class="slick-prev"><i class="fa fa-angle-left"></i></span>',
			nextArrow: '<span class="slick-next"><i class="fa fa-angle-right"></i></span>'
		});
		$('.slider-nav').slick({
			slidesToShow: 6,
			//centerMode: true,
			centerPadding: 0,
			slidesToScroll: 6,
			asNavFor: '.slider',
			arrows: true,
			focusOnSelect: true,
			appendArrows: '.nav-prevnext',
			prevArrow: '<span class="slick-prev"><i class="fa fa-angle-left"></i></span>',
			nextArrow: '<span class="slick-next"><i class="fa fa-angle-right"></i></span>'
		});
	});
</script>
<?php endif; ?>

<?php if( $post->ID == 10) : //this is the gallery page ?>
<script>
	jQuery(document).ready(function($) {
		$('.slider').slick({
			slidesToShow: 1,
			//centerMode: true,
			arrows: true,
			appendArrows: '.prevnext',
			//asNavFor: '.slider-nav',
			prevArrow: '<span class="slick-prev"><i class="fa fa-angle-left"></i></span>',
			nextArrow: '<span class="slick-next"><i class="fa fa-angle-right"></i></span>'
		});
		$('.slider-nav').slick({
			slidesToShow: 6,
			//centerMode: true,
			centerPadding: 0,
			slidesToScroll: 6,
			asNavFor: '.slider',
			arrows: true,
			focusOnSelect: true,
			appendArrows: '.nav-prevnext',
			prevArrow: '<span class="slick-prev"><i class="fa fa-angle-left"></i></span>',
			nextArrow: '<span class="slick-next"><i class="fa fa-angle-right"></i></span>'
		});
	});
</script>
<?php endif; ?>

</body>
</html>