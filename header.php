<!doctype html>
<!-- paulirish.com/2008/conditional-stylesheets-vs-css-hacks-answer-neither/ -->
<!--[if lt IE 7]> <html class="no-js ie6 oldie" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="no-js ie7 oldie" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js ie8 oldie" lang="en"> <![endif]-->
<!-- Consider adding an manifest.appcache: h5bp.com/d/Offline -->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en"> <!--<![endif]-->
<head>
	<meta charset="<?php bloginfo('charset'); ?>">

	<title><?php wp_title('|', true, 'right'); bloginfo('name'); ?></title>

	<!-- Mobile viewport optimized: j.mp/bplateviewport -->
	<meta name="viewport" content="width=device-width,initial-scale=1" />


<?php wp_head(); ?>
<?php $propID = get_property_id(); ?>
</head>

<body <?php body_class(); ?> >

<!--<img class="bg" src="<?php the_field('home_bg_image', 'options'); ?>">-->

<div class="contain-to-grid masthead">
	<!-- Starting the Top-Bar -->
	<nav class="top">
	    <div class="title-area">
	        <div class="logo">
	        	<a href="<?= get_field('logo_link', 'options') ? get_field('logo_link', 'options') : 'http://moreland.com' ?>" target="_blank">
	        		<img src="<?php echo get_template_directory_uri() . '/img/morelandboxlogo2011.jpg'; ?>" >
	        	</a>
	        </div>
	        <div class="title">

	        	<h1>
	        		<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
	        			<?php echo get_the_title($propID); ?>
	        		</a>
	        		
	        	</h1>
	        	<?php if( get_field('price', $propID) ) : ?><h2><?php echo get_field('price_display_text', $propID).' '.get_field('price', $propID); ?></h2><?php endif; ?>
	        </div>


	    </div>
	    
	    <section class="top-nav">
	    <?php html5blank_nav(); ?>
	    </section>
	    <div class="menu-toggle"><i class="fa fa-bars"></i>Menu</div>
	</nav>
	<!-- End of Top-Bar -->
</div>