<?php
/*
 *  Author: Todd Motto | @toddmotto
 *  URL: html5blank.com | @html5blank
 *  Custom functions, support, custom post types and more.
 */

/*------------------------------------*\
	External Modules/Files
\*------------------------------------*/

// Load any external files you have here

/*------------------------------------*\
	Theme Support
\*------------------------------------*/


if (function_exists('add_theme_support'))
{
    // Add Menu Support
    add_theme_support('menus');

    // Add Thumbnail Theme Support
    add_theme_support('post-thumbnails');
    add_image_size('large', 700, '', true); // Large Thumbnail
    add_image_size('medium', 250, '', true); // Medium Thumbnail
    add_image_size('small', 120, '', true); // Small Thumbnail
    add_image_size('custom-size', 700, 200, true); // Custom Thumbnail Size call using the_post_thumbnail('custom-size');

    // Add Support for Custom Backgrounds - Uncomment below if you're going to use
    /*add_theme_support('custom-background', array(
	'default-color' => 'FFF',
	'default-image' => get_template_directory_uri() . '/img/bg.jpg'
    ));*/

    // Add Support for Custom Header - Uncomment below if you're going to use
    /*add_theme_support('custom-header', array(
	'default-image'			=> get_template_directory_uri() . '/img/headers/default.jpg',
	'header-text'			=> false,
	'default-text-color'		=> '000',
	'width'				=> 1000,
	'height'			=> 198,
	'random-default'		=> false,
	'wp-head-callback'		=> $wphead_cb,
	'admin-head-callback'		=> $adminhead_cb,
	'admin-preview-callback'	=> $adminpreview_cb
    ));*/

    // Enables post and comment RSS feed links to head
    add_theme_support('automatic-feed-links');

    // Localisation Support
    load_theme_textdomain('html5blank', get_template_directory() . '/languages');
}

/*------------------------------------*\
	Functions
\*------------------------------------*/

// HTML5 Blank navigation
function html5blank_nav()
{
	wp_nav_menu(
	array(
		'theme_location'  => 'header-menu',
		'menu'            => '',
		'container'       => 'div',
		'container_class' => 'menu-{menu slug}-container',
		'container_id'    => '',
		'menu_class'      => 'menu',
		'menu_id'         => '',
		'echo'            => true,
		'fallback_cb'     => 'wp_page_menu',
		'before'          => '',
		'after'           => '',
		'link_before'     => '',
		'link_after'      => '',
		'items_wrap'      => '<ul>%3$s</ul>',
		'depth'           => 0,
		'walker'          => ''
		)
	);
}

// Load HTML5 Blank scripts (header.php)
function html5blank_header_scripts()
{
    if ($GLOBALS['pagenow'] != 'wp-login.php' && !is_admin()) {

    	wp_register_script('conditionizr', get_template_directory_uri() . '/js/lib/conditionizr-4.3.0.min.js', array(), '4.3.0'); // Conditionizr
        wp_enqueue_script('conditionizr'); // Enqueue it!

        wp_register_script('modernizr', get_template_directory_uri() . '/js/lib/modernizr-2.7.1.min.js', array(), '2.7.1'); // Modernizr
        wp_enqueue_script('modernizr'); // Enqueue it!

        wp_register_script('html5blankscripts', get_template_directory_uri() . '/js/scripts.js', array('jquery'), '1.0.0'); // Custom scripts
        wp_enqueue_script('html5blankscripts'); // Enqueue it!


        //Flexslider
        wp_register_script( 'slick', '//cdn.jsdelivr.net/jquery.slick/1.5.9/slick.min.js', array( 'jquery' ), '2.1', true );}
        wp_enqueue_script('slick'); // Enqueue it!
}

// Load HTML5 Blank conditional scripts
function html5blank_conditional_scripts()
{
    if (is_page('pagenamehere')) {
        wp_register_script('scriptname', get_template_directory_uri() . '/js/scriptname.js', array('jquery'), '1.0.0'); // Conditional script(s)
        wp_enqueue_script('scriptname'); // Enqueue it!
    }
}

// Load HTML5 Blank styles
function html5blank_styles()
{
    wp_register_style('normalize', get_template_directory_uri() . '/css/normalize.css', array(), '1.0', 'all');
    wp_enqueue_style('normalize'); // Enqueue it!

    wp_register_style('micro', get_template_directory_uri() . '/css/style.css', array(), '1.0', 'all');
    wp_enqueue_style('micro'); // Enqueue it!

    //fontawesome
    wp_register_style('fontawesome','//maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css', array(), '1.0', 'all');
    wp_enqueue_style('fontawesome'); // Enqueue it!
    

    wp_register_style('slickstyle', '//cdn.jsdelivr.net/jquery.slick/1.5.9/slick.css', array());
    wp_enqueue_style('slickstyle'); // Enqueue it!
}

// Register HTML5 Blank Navigation
function register_html5_menu()
{
    register_nav_menus(array( // Using array to specify more menus if needed
        'header-menu' => __('Header Menu', 'html5blank') // Main Navigation
        
    ));
}

// Remove the <div> surrounding the dynamic navigation to cleanup markup
function my_wp_nav_menu_args($args = '')
{
    $args['container'] = false;
    return $args;
}

// Remove Injected classes, ID's and Page ID's from Navigation <li> items
function my_css_attributes_filter($var)
{
    return is_array($var) ? array() : '';
}

// Remove invalid rel attribute values in the categorylist
function remove_category_rel_from_category_list($thelist)
{
    return str_replace('rel="category tag"', 'rel="tag"', $thelist);
}

// Add page slug to body class, love this - Credit: Starkers Wordpress Theme
function add_slug_to_body_class($classes)
{
    global $post;
    if (is_home()) {
        $key = array_search('blog', $classes);
        if ($key > -1) {
            unset($classes[$key]);
        }
    } elseif (is_page()) {
        $classes[] = sanitize_html_class($post->post_name);
    } elseif (is_singular()) {
        $classes[] = sanitize_html_class($post->post_name);
    }

    return $classes;
}

// If Dynamic Sidebar Exists
if (function_exists('register_sidebar'))
{
    // Define Sidebar Widget Area 1
    register_sidebar(array(
        'name' => __('Widget Area 1', 'html5blank'),
        'description' => __('Description for this widget-area...', 'html5blank'),
        'id' => 'widget-area-1',
        'before_widget' => '<div id="%1$s" class="%2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3>',
        'after_title' => '</h3>'
    ));

    // Define Sidebar Widget Area 2
    register_sidebar(array(
        'name' => __('Widget Area 2', 'html5blank'),
        'description' => __('Description for this widget-area...', 'html5blank'),
        'id' => 'widget-area-2',
        'before_widget' => '<div id="%1$s" class="%2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3>',
        'after_title' => '</h3>'
    ));
}

// Remove wp_head() injected Recent Comment styles
function my_remove_recent_comments_style()
{
    global $wp_widget_factory;
    remove_action('wp_head', array(
        $wp_widget_factory->widgets['WP_Widget_Recent_Comments'],
        'recent_comments_style'
    ));
}

// Pagination for paged posts, Page 1, Page 2, Page 3, with Next and Previous Links, No plugin
function html5wp_pagination()
{
    global $wp_query;
    $big = 999999999;
    echo paginate_links(array(
        'base' => str_replace($big, '%#%', get_pagenum_link($big)),
        'format' => '?paged=%#%',
        'current' => max(1, get_query_var('paged')),
        'total' => $wp_query->max_num_pages
    ));
}

// Custom Excerpts
function html5wp_index($length) // Create 20 Word Callback for Index page Excerpts, call using html5wp_excerpt('html5wp_index');
{
    return 20;
}

// Create 40 Word Callback for Custom Post Excerpts, call using html5wp_excerpt('html5wp_custom_post');
function html5wp_custom_post($length)
{
    return 40;
}

// Create the Custom Excerpts callback
function html5wp_excerpt($length_callback = '', $more_callback = '')
{
    global $post;
    if (function_exists($length_callback)) {
        add_filter('excerpt_length', $length_callback);
    }
    if (function_exists($more_callback)) {
        add_filter('excerpt_more', $more_callback);
    }
    $output = get_the_excerpt();
    $output = apply_filters('wptexturize', $output);
    $output = apply_filters('convert_chars', $output);
    $output = '<p>' . $output . '</p>';
    echo $output;
}

// Custom View Article link to Post
function html5_blank_view_article($more)
{
    global $post;
    return '... <a class="view-article" href="' . get_permalink($post->ID) . '">' . __('View Article', 'html5blank') . '</a>';
}

// Remove Admin bar
function remove_admin_bar()
{
    return false;
}

// Remove 'text/css' from our enqueued stylesheet
function html5_style_remove($tag)
{
    return preg_replace('~\s+type=["\'][^"\']++["\']~', '', $tag);
}

// Remove thumbnail width and height dimensions that prevent fluid images in the_thumbnail
function remove_thumbnail_dimensions( $html )
{
    $html = preg_replace('/(width|height)=\"\d*\"\s/', "", $html);
    return $html;
}

// Custom Gravatar in Settings > Discussion
function html5blankgravatar ($avatar_defaults)
{
    $myavatar = get_template_directory_uri() . '/img/gravatar.jpg';
    $avatar_defaults[$myavatar] = "Custom Gravatar";
    return $avatar_defaults;
}

// Threaded Comments
function enable_threaded_comments()
{
    if (!is_admin()) {
        if (is_singular() AND comments_open() AND (get_option('thread_comments') == 1)) {
            wp_enqueue_script('comment-reply');
        }
    }
}

// Custom Comments Callback
function html5blankcomments($comment, $args, $depth)
{
	$GLOBALS['comment'] = $comment;
	extract($args, EXTR_SKIP);

	if ( 'div' == $args['style'] ) {
		$tag = 'div';
		$add_below = 'comment';
	} else {
		$tag = 'li';
		$add_below = 'div-comment';
	}
?>
    <!-- heads up: starting < for the html tag (li or div) in the next line: -->
    <<?php echo $tag ?> <?php comment_class(empty( $args['has_children'] ) ? '' : 'parent') ?> id="comment-<?php comment_ID() ?>">
	<?php if ( 'div' != $args['style'] ) : ?>
	<div id="div-comment-<?php comment_ID() ?>" class="comment-body">
	<?php endif; ?>
	<div class="comment-author vcard">
	<?php if ($args['avatar_size'] != 0) echo get_avatar( $comment, $args['180'] ); ?>
	<?php printf(__('<cite class="fn">%s</cite> <span class="says">says:</span>'), get_comment_author_link()) ?>
	</div>
<?php if ($comment->comment_approved == '0') : ?>
	<em class="comment-awaiting-moderation"><?php _e('Your comment is awaiting moderation.') ?></em>
	<br />
<?php endif; ?>

	<div class="comment-meta commentmetadata"><a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>">
		<?php
			printf( __('%1$s at %2$s'), get_comment_date(),  get_comment_time()) ?></a><?php edit_comment_link(__('(Edit)'),'  ','' );
		?>
	</div>

	<?php comment_text() ?>

	<div class="reply">
	<?php comment_reply_link(array_merge( $args, array('add_below' => $add_below, 'depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
	</div>
	<?php if ( 'div' != $args['style'] ) : ?>
	</div>
	<?php endif; ?>
<?php }

/*------------------------------------*\
	Actions + Filters + ShortCodes
\*------------------------------------*/

// Add Actions
add_action('init', 'html5blank_header_scripts'); // Add Custom Scripts to wp_head
add_action('wp_print_scripts', 'html5blank_conditional_scripts'); // Add Conditional Page Scripts
add_action('get_header', 'enable_threaded_comments'); // Enable Threaded Comments
add_action('wp_enqueue_scripts', 'html5blank_styles'); // Add Theme Stylesheet
add_action('init', 'register_html5_menu'); // Add HTML5 Blank Menu
//add_action('init', 'create_post_type_html5'); // Add our HTML5 Blank Custom Post Type
add_action('widgets_init', 'my_remove_recent_comments_style'); // Remove inline Recent Comment Styles from wp_head()
add_action('init', 'html5wp_pagination'); // Add our HTML5 Pagination

// Remove Actions
remove_action('wp_head', 'feed_links_extra', 3); // Display the links to the extra feeds such as category feeds
remove_action('wp_head', 'feed_links', 2); // Display the links to the general feeds: Post and Comment Feed
remove_action('wp_head', 'rsd_link'); // Display the link to the Really Simple Discovery service endpoint, EditURI link
remove_action('wp_head', 'wlwmanifest_link'); // Display the link to the Windows Live Writer manifest file.
remove_action('wp_head', 'index_rel_link'); // Index link
remove_action('wp_head', 'parent_post_rel_link', 10, 0); // Prev link
remove_action('wp_head', 'start_post_rel_link', 10, 0); // Start link
remove_action('wp_head', 'adjacent_posts_rel_link', 10, 0); // Display relational links for the posts adjacent to the current post.
remove_action('wp_head', 'wp_generator'); // Display the XHTML generator that is generated on the wp_head hook, WP version
remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);
remove_action('wp_head', 'rel_canonical');
remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0);

// Add Filters
add_filter('avatar_defaults', 'html5blankgravatar'); // Custom Gravatar in Settings > Discussion
add_filter('body_class', 'add_slug_to_body_class'); // Add slug to body class (Starkers build)
add_filter('widget_text', 'do_shortcode'); // Allow shortcodes in Dynamic Sidebar
add_filter('widget_text', 'shortcode_unautop'); // Remove <p> tags in Dynamic Sidebars (better!)
add_filter('wp_nav_menu_args', 'my_wp_nav_menu_args'); // Remove surrounding <div> from WP Navigation
// add_filter('nav_menu_css_class', 'my_css_attributes_filter', 100, 1); // Remove Navigation <li> injected classes (Commented out by default)
// add_filter('nav_menu_item_id', 'my_css_attributes_filter', 100, 1); // Remove Navigation <li> injected ID (Commented out by default)
// add_filter('page_css_class', 'my_css_attributes_filter', 100, 1); // Remove Navigation <li> Page ID's (Commented out by default)
add_filter('the_category', 'remove_category_rel_from_category_list'); // Remove invalid rel attribute
add_filter('the_excerpt', 'shortcode_unautop'); // Remove auto <p> tags in Excerpt (Manual Excerpts only)
add_filter('the_excerpt', 'do_shortcode'); // Allows Shortcodes to be executed in Excerpt (Manual Excerpts only)
add_filter('excerpt_more', 'html5_blank_view_article'); // Add 'View Article' button instead of [...] for Excerpts
add_filter('show_admin_bar', 'remove_admin_bar'); // Remove Admin bar
add_filter('style_loader_tag', 'html5_style_remove'); // Remove 'text/css' from enqueued stylesheet
add_filter('post_thumbnail_html', 'remove_thumbnail_dimensions', 10); // Remove width and height dynamic attributes to thumbnails
add_filter('image_send_to_editor', 'remove_thumbnail_dimensions', 10); // Remove width and height dynamic attributes to post images

// Remove Filters
remove_filter('the_excerpt', 'wpautop'); // Remove <p> tags from Excerpt altogether

// Shortcodes
add_shortcode('html5_shortcode_demo', 'html5_shortcode_demo'); // You can place [html5_shortcode_demo] in Pages, Posts now.
add_shortcode('html5_shortcode_demo_2', 'html5_shortcode_demo_2'); // Place [html5_shortcode_demo_2] in Pages, Posts now.

// Shortcodes above would be nested like this -
// [html5_shortcode_demo] [html5_shortcode_demo_2] Here's the page title! [/html5_shortcode_demo_2] [/html5_shortcode_demo]



//Function to get page ID from slug
function get_ID_by_slug($page_slug) {
    $page = get_page_by_path($page_slug);
    if ($page) {
        return $page->ID;
    } else {
        return null;
    }
}



//SETUP BLANK SITE
if (isset($_GET['activated']) && is_admin()){

    // Don't Organize Uploads by Date
    update_option('uploads_use_yearmonth_folders',0);
 
     // Update Permalinks
     update_option('selection','custom');
     update_option('permalink_structure','/%postname%/');
     $wp_rewrite->flush_rules();

     //delete hello dolly
    require_once(ABSPATH . 'wp-admin/includes/plugin.php');
    require_once(ABSPATH . 'wp-admin/includes/file.php');
    if (file_exists(WP_PLUGIN_DIR . '/hello.php'))
        delete_plugins(array('hello.php'));
    if (file_exists(WP_PLUGIN_DIR . '/akismet/akismet.php'))
        delete_plugins(array('/akismet/akismet.php'));

    //REMOVE SAMPLE CONTENT
    wp_delete_post(1, TRUE);
    wp_delete_post(2, TRUE);



    //Add Homepage

    $new_page_title = "Home";

    $new_page_content = "";

    $new_page_template = "page-home.php"; //ex. template-custom.php. Leave blank if you don't want a custom page template.



    //don't change the code below, unless you know what you're doing



    $page_check = get_page_by_title($new_page_title);

    $new_page = array(

        'post_type' => 'page',

        'post_title' => $new_page_title,

        'post_content' => $new_page_content,

        'post_status' => 'publish',

        'post_author' => 1,

    );

    if(!isset($page_check->ID)){

        $new_page_id = wp_insert_post($new_page);

        if(!empty($new_page_template)){

            update_post_meta($new_page_id, '_wp_page_template', $new_page_template);

        }

    }

    

    //Add Details Page

    $new_page_title = "Details";

    $new_page_content = "";

    $new_page_template = "page-details.php"; //ex. template-custom.php. Leave blank if you don't want a custom page template.



    //don't change the code below, unless you know what you're doing



    $page_check = get_page_by_title($new_page_title);

    $new_page = array(

        'post_type' => 'page',

        'post_title' => $new_page_title,

        'post_content' => $new_page_content,

        'post_status' => 'publish',

        'post_author' => 1,

    );

    if(!isset($page_check->ID)){

        $new_page_id = wp_insert_post($new_page);

        if(!empty($new_page_template)){

            update_post_meta($new_page_id, '_wp_page_template', $new_page_template);

        }

    }

    

    //Add Gallery Page

    $new_page_title = "Gallery";

    $new_page_content = "";

    $new_page_template = "page-gallery.php"; //ex. template-custom.php. Leave blank if you don't want a custom page template.



    //don't change the code below, unless you know what you're doing



    $page_check = get_page_by_title($new_page_title);

    $new_page = array(

        'post_type' => 'page',

        'post_title' => $new_page_title,

        'post_content' => $new_page_content,

        'post_status' => 'publish',

        'post_author' => 1,

    );

    if(!isset($page_check->ID)){

        $new_page_id = wp_insert_post($new_page);

        if(!empty($new_page_template)){

            update_post_meta($new_page_id, '_wp_page_template', $new_page_template);

        }

    }

    

    //Add Location Page

    $new_page_title = "Location";

    $new_page_content = "";

    $new_page_template = "page-location.php"; //ex. template-custom.php. Leave blank if you don't want a custom page template.



    //don't change the code below, unless you know what you're doing



    $page_check = get_page_by_title($new_page_title);

    $new_page = array(

        'post_type' => 'page',

        'post_title' => $new_page_title,

        'post_content' => $new_page_content,

        'post_status' => 'publish',

        'post_author' => 1,

    );

    if(!isset($page_check->ID)){

        $new_page_id = wp_insert_post($new_page);

        if(!empty($new_page_template)){

            update_post_meta($new_page_id, '_wp_page_template', $new_page_template);

        }

    }

    //Add Aerial Tour Page

    $new_page_title = "Aerial Tour";

    $new_page_content = "";

    $new_page_template = "page-aerial.php"; //ex. template-custom.php. Leave blank if you don't want a custom page template.



    //don't change the code below, unless you know what you're doing



    $page_check = get_page_by_title($new_page_title);

    $new_page = array(

        'post_type' => 'page',

        'post_title' => $new_page_title,

        'post_content' => $new_page_content,

        'post_status' => 'publish',

        'post_author' => 1,

    );

    if(!isset($page_check->ID)){

        $new_page_id = wp_insert_post($new_page);

        if(!empty($new_page_template)){

            update_post_meta($new_page_id, '_wp_page_template', $new_page_template);

        }

    }




}

//CUSTOM POST TYPES

include_once('custom-post-type-ui/custom-post-type-ui.php');

add_action('init', 'cptui_register_my_cpt_properties');
function cptui_register_my_cpt_properties() {
register_post_type('properties', array(
'label' => 'Properties',
'description' => '',
'public' => true,
'show_ui' => true,
'show_in_menu' => true,
'capability_type' => 'post',
'map_meta_cap' => true,
'hierarchical' => false,
'rewrite' => array('slug' => 'properties', 'with_front' => true),
'query_var' => true,
'supports' => array('title'),
'labels' => array (
  'name' => 'Properties',
  'singular_name' => 'Property',
  'menu_name' => 'Properties',
  'add_new' => 'Add Property',
  'add_new_item' => 'Add New Property',
  'edit' => 'Edit',
  'edit_item' => 'Edit Property',
  'new_item' => 'New Property',
  'view' => 'View Property',
  'view_item' => 'View Property',
  'search_items' => 'Search Properties',
  'not_found' => 'No Properties Found',
  'not_found_in_trash' => 'No Properties Found in Trash',
  'parent' => 'Parent Property',
)
) ); }

add_action('init', 'cptui_register_my_cpt_agents');
function cptui_register_my_cpt_agents() {
register_post_type('agents', array(
'label' => 'Agents',
'description' => '',
'public' => true,
'show_ui' => true,
'show_in_menu' => true,
'capability_type' => 'post',
'map_meta_cap' => true,
'hierarchical' => false,
'rewrite' => array('slug' => 'agents', 'with_front' => true),
'query_var' => true,
'supports' => array('title'),
'labels' => array (
  'name' => 'Agents',
  'singular_name' => 'Agent',
  'menu_name' => 'Agents',
  'add_new' => 'Add Agent',
  'add_new_item' => 'Add New Agent',
  'edit' => 'Edit',
  'edit_item' => 'Edit Agent',
  'new_item' => 'New Agent',
  'view' => 'View Agent',
  'view_item' => 'View Agent',
  'search_items' => 'Search Agents',
  'not_found' => 'No Agents Found',
  'not_found_in_trash' => 'No Agents Found in Trash',
  'parent' => 'Parent Agent',
)
) ); }

//CUSTOM FIELDS
define( 'ACF_LITE', true );
include_once('advanced-custom-fields/acf.php');
include_once('acf-gallery/acf-gallery.php');
include_once('acf-repeater/acf-repeater.php');
include_once('acf-options-page/acf-options-page.php');


if(function_exists("register_field_group"))
{
    register_field_group(array (
        'id' => 'acf_agent-fields',
        'title' => 'Agent Fields',
        'fields' => array (
            array (
                'key' => 'field_51c2365013bdb',
                'label' => 'Name',
                'name' => 'name',
                'type' => 'text',
                'default_value' => '',
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
                'formatting' => 'html',
                'maxlength' => '',
            ),
            array (
                'key' => 'field_51c2365913bdc',
                'label' => 'Title',
                'name' => 'title',
                'type' => 'text',
                'instructions' => 'EX: "Broker Associate"',
                'default_value' => 'REALTOR&reg;',
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
                'formatting' => 'html',
                'maxlength' => '',
            ),
            array (
                'key' => 'field_51c322d69059c',
                'label' => 'Elite25?',
                'name' => 'elite_25',
                'type' => 'true_false'
            ),
            array (
                'key' => 'field_52dd8310e2a10',
                'label' => 'Agent Office Phone',
                'name' => 'agent_office_phone',
                'type' => 'text',
                'default_value' => '(512) 480-0848',
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
                'formatting' => 'html',
                'maxlength' => '',
            ),
            array (
                'key' => 'field_52dd8331e2a11',
                'label' => 'Agent Mobile Phone',
                'name' => 'agent_mobile_phone',
                'type' => 'text',
                'default_value' => '',
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
                'formatting' => 'html',
                'maxlength' => '',
            ),
            array (
                'key' => 'field_52dd8344e2a12',
                'label' => 'Agent Email',
                'name' => 'agent_email',
                'type' => 'text',
                'default_value' => '',
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
                'formatting' => 'html',
                'maxlength' => '',
            ),
            array (
                'key' => 'field_52dd8354e2a13',
                'label' => 'Agent Website',
                'name' => 'agent_website',
                'type' => 'text',
                'default_value' => '',
                'placeholder' => '',
                'prepend' => 'http://',
                'append' => '',
                'formatting' => 'html',
                'maxlength' => '',
            ),
            array (
                'key' => 'field_51c2366b13bdd',
                'label' => 'Agent Headshot',
                'name' => 'agent_image',
                'type' => 'image',
                'default_value' => '',
                'save_format' => 'url',
                'preview_size' => 'thumbnail',
                'library' => 'all',
            ),
            
            array (
                'key' => 'field_52dd843db00f6',
                'label' => 'Agency Website',
                'name' => 'agency_website',
                'type' => 'text',
                'default_value' => 'moreland.com',
                'placeholder' => '',
                'prepend' => 'http://',
                'append' => '',
                'formatting' => 'html',
                'maxlength' => '',
            ),
        ),
        'location' => array (
            array (
                array (
                    'param' => 'post_type',
                    'operator' => '==',
                    'value' => 'agents',
                    'order_no' => 0,
                    'group_no' => 0,
                ),
            ),
        ),
        'options' => array (
            'position' => 'normal',
            'layout' => 'no_box',
            'hide_on_screen' => array (
            ),
        ),
        'menu_order' => 0,
    ));
    register_field_group(array (
        'id' => 'acf_homepage-gallery-fields',
        'title' => 'Homepage Gallery Fields',
        'fields' => array (
            array (
                'key' => 'field_56fd75a489628',
                'label' => 'Homepage Gallery',
                'name' => 'homepage_gallery',
                'type' => 'gallery',
                'preview_size' => 'thumbnail',
                'library' => 'all',
            ),
        ),
        'location' => array (
            array (
                array (
                    'param' => 'options_page',
                    'operator' => '==',
                    'value' => 'acf-options',
                    'order_no' => 0,
                    'group_no' => 0,
                ),
            ),
        ),
        'options' => array (
            'position' => 'normal',
            'layout' => 'no_box',
            'hide_on_screen' => array (
            ),
        ),
        'menu_order' => 0,
    ));
    register_field_group(array (
        'id' => 'acf_aerial-tour-fields',
        'title' => 'Aerial Tour Fields',
        'fields' => array (
            array (
                'key' => 'field_56fd746a3358d',
                'label' => 'Video Embed Code',
                'name' => 'video_url',
                'type' => 'text',
                'default_value' => '',
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
                'formatting' => 'html',
                'maxlength' => '',
            ),
        ),
        'location' => array (
            array (
                array (
                    'param' => 'page',
                    'operator' => '==',
                    'value' => '12',
                    'order_no' => 0,
                    'group_no' => 0,
                ),
            ),
        ),
        'options' => array (
            'position' => 'acf_after_title',
            'layout' => 'no_box',
            'hide_on_screen' => array (
                0 => 'permalink',
                1 => 'the_content',
                2 => 'excerpt',
                3 => 'custom_fields',
                4 => 'discussion',
                5 => 'comments',
                6 => 'revisions',
                7 => 'slug',
                8 => 'author',
                9 => 'format',
                10 => 'featured_image',
                11 => 'categories',
                12 => 'tags',
                13 => 'send-trackbacks',
            ),
        ),
        'menu_order' => 0,
    ));
    register_field_group(array (
        'id' => 'acf_background-images',
        'title' => 'Background Images',
        'fields' => array (
            array (
                'key' => 'field_52d8576afe57a',
                'label' => 'Details Page Background Image',
                'name' => 'details_page_background_image',
                'type' => 'image',
                'save_format' => 'url',
                'preview_size' => 'large',
                'library' => 'all',
            ),
            array (
                'key' => 'field_52d858831797b',
                'label' => 'Gallery Page Background Image',
                'name' => 'gallery_page_background_image',
                'type' => 'image',
                'save_format' => 'url',
                'preview_size' => 'large',
                'library' => 'all',
            ),
            array (
                'key' => 'field_52d85767fe579',
                'label' => 'Location Page Background Image',
                'name' => 'location_page_background_image',
                'type' => 'image',
                'save_format' => 'url',
                'preview_size' => 'large',
                'library' => 'all',
            ),
            array (
                'key' => 'field_56fd7530061f7',
                'label' => 'Aerial Tour Page Background Image',
                'name' => 'aerial_tour_page_background_image',
                'type' => 'image',
                'save_format' => 'url',
                'preview_size' => 'large',
                'library' => 'all',
            ),
        ),
        'location' => array (
            array (
                array (
                    'param' => 'options_page',
                    'operator' => '==',
                    'value' => 'acf-options',
                    'order_no' => 0,
                    'group_no' => 0,
                ),
            ),
        ),
        'options' => array (
            'position' => 'normal',
            'layout' => 'no_box',
            'hide_on_screen' => array (
            ),
        ),
        'menu_order' => 0,
    ));

    register_field_group(array (
        'id' => 'acf_gallery-page-fields',
        'title' => 'Gallery Page Fields',
        'fields' => array (
            array (
                'key' => 'field_52dd8e266ffdc',
                'label' => 'Property Gallery',
                'name' => 'gallery',
                'type' => 'gallery',
                'preview_size' => 'thumbnail',
                'library' => 'all',
            ),
        ),
        'location' => array (
            array (
                array (
                    'param' => 'page',
                    'operator' => '==',
                    'value' => get_ID_by_slug('gallery'),
                    'order_no' => 0,
                    'group_no' => 0,
                ),
            ),
        ),
        'options' => array (
            'position' => 'acf_after_title',
            'layout' => 'no_box',
            'hide_on_screen' => array (
                0 => 'permalink',
                1 => 'the_content',
                2 => 'excerpt',
                3 => 'custom_fields',
                4 => 'discussion',
                5 => 'comments',
                6 => 'revisions',
                7 => 'slug',
                8 => 'author',
                9 => 'format',
                10 => 'featured_image',
                11 => 'categories',
                12 => 'tags',
                13 => 'send-trackbacks',
            ),
        ),
        'menu_order' => 0,
    ));
    register_field_group(array (
        'id' => 'acf_property-fields',
        'title' => 'Property Fields',
        'fields' => array (
            array (
                'key' => 'field_52dd8398694fb',
                'label' => 'Address',
                'name' => 'address',
                'type' => 'text',
                'default_value' => '',
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
                'formatting' => 'html',
                'maxlength' => '',
            ),
            array (
                'key' => 'field_52dd83aa694fc',
                'label' => 'City',
                'name' => 'city',
                'type' => 'text',
                'default_value' => 'Austin',
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
                'formatting' => 'html',
                'maxlength' => '',
            ),
            array (
                'key' => 'field_52dd83b2694fd',
                'label' => 'State',
                'name' => 'state',
                'type' => 'text',
                'default_value' => 'TX',
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
                'formatting' => 'html',
                'maxlength' => 2,
            ),
            array (
                'key' => 'field_52dd83bd694fe',
                'label' => 'ZIP',
                'name' => 'zip',
                'type' => 'text',
                'default_value' => '',
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
                'formatting' => 'html',
                'maxlength' => 5,
            ),
            array (
                'key' => 'field_pricetext',
                'label' => 'Price Display Text',
                'name' => 'price_display_text',
                'type' => 'text',
                'default_value' => 'Listed at',
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
                'formatting' => 'html'
                
            ),
            array (
                'key' => 'field_52dd83c6694ff',
                'label' => 'Price',
                'name' => 'price',
                'type' => 'text',
                'default_value' => '',
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
                'formatting' => 'html',
                'maxlength' => '',
            ),
            array (
                'key' => 'field_52dd83d469500',
                'label' => 'Status',
                'name' => 'status',
                'type' => 'radio',
                'choices' => array (
                    'soon' => 'Coming Soon',
                    'active' => 'For Sale',
                    'sold' => 'Sold',
                    'pending' => 'Pending'
                ),
                'other_choice' => 1,
                'save_other_choice' => 1,
                'default_value' => 'active',
                'layout' => 'vertical',
            ),
            array (
                'key' => 'field_56fd7a5344a86',
                'label' => 'Details',
                'name' => 'details',
                'type' => 'repeater',
                'sub_fields' => array (
                    array (
                        'key' => 'field_56fd7a7044a87',
                        'label' => 'Detail Title',
                        'name' => 'detail_title',
                        'type' => 'text',
                        'column_width' => '',
                        'default_value' => '',
                        'placeholder' => '',
                        'prepend' => '',
                        'append' => '',
                        'formatting' => 'html',
                        'maxlength' => '',
                    ),
                    array (
                        'key' => 'field_56fd7a7e44a88',
                        'label' => 'Detail Value',
                        'name' => 'detail_value',
                        'type' => 'text',
                        'column_width' => '',
                        'default_value' => '',
                        'placeholder' => '',
                        'prepend' => '',
                        'append' => '',
                        'formatting' => 'html',
                        'maxlength' => '',
                    ),
                ),
                'row_min' => '',
                'row_limit' => '',
                'layout' => 'table',
                'button_label' => 'Add Detail',
            ),

            array (
                'key' => 'field_52dd8595b99b1',
                'label' => 'Property Description',
                'name' => 'property_description',
                'type' => 'wysiwyg',
                'default_value' => '',
                'toolbar' => 'full',
                'media_upload' => 'yes',
            ),
            array (
                'key' => 'field_553fa4d786546',
                'label' => 'Downloads',
                'name' => 'additional_pdfs',
                'type' => 'repeater',
                'sub_fields' => array (
                    array (
                        'key' => 'field_553fa65686547',
                        'label' => 'File Title',
                        'name' => 'file_title',
                        'type' => 'text',
                        'column_width' => '',
                        'default_value' => '',
                        'placeholder' => '',
                        'prepend' => '',
                        'append' => '',
                        'formatting' => 'html',
                        'maxlength' => '',
                    ),
                    array (
                        'key' => 'field_553fa66b86548',
                        'label' => 'PDF File',
                        'name' => 'pdf_file',
                        'type' => 'file',
                        'column_width' => '',
                        'save_format' => 'url',
                        'library' => 'all',
                    ),
                ),
                'row_min' => '',
                'row_limit' => '',
                'layout' => 'table',
                'button_label' => 'Add File',
            ),
            array (
                'key' => 'field_52dd85e3b99b6',
                'label' => 'Virtual Tour URL',
                'name' => 'virtual_tour_url',
                'type' => 'text',
                'default_value' => '',
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
                'formatting' => 'html',
                'maxlength' => '',
            ),
            array (
                'key' => 'field_52dd90815c862',
                'label' => 'Lifestyle Video Title',
                'name' => 'lifestyle_video_title',
                'type' => 'text',
                'default_value' => '',
                'placeholder' => '',
                'prepend' => 'View Our',
                'append' => 'Lifestyle Video',
                'formatting' => 'html',
                'maxlength' => '',
            ),
            array (
                'key' => 'field_52dd85f5b99b7',
                'label' => 'Lifestyle Video',
                'name' => 'lifestyle_video',
                'type' => 'select',
                'choices' => array (
                    'http://www.youtube.com/embed/R9NR6cxOAMQ?rel=0' => 'Westlake and Barton Creek',
                    'http://www.youtube.com/embed/BDFdC5UWODs?rel=0' => 'West Austin',
                    'http://www.youtube.com/embed/rrgu5ewlYTw?rel=0' => 'Lakeway and Lake Travis',
                    'http://www.youtube.com/embed/R7BKUbwU6Uc?rel=0' => 'Lake Austin',
                    'http://www.youtube.com/embed/O-mpWRbFopc?rel=0' => 'Central Austin',
                    'http://www.youtube.com/embed/3O28H1Pzilg?rel=0' => 'UT and Hyde Park',
                    'http://www.youtube.com/embed/X3lQLuOmI5c?rel=0' => 'South Central and Travis Heights',
                    'http://www.youtube.com/embed/-XGy0g6GoaI?rel=0' => 'Northwest Hills',
                    'http://www.youtube.com/embed/_1pqAux1T3Q?rel=0' => 'Downtown',
                ),
                'default_value' => 'http://www.youtube.com/embed/R9NR6cxOAMQ?rel=0',
                'allow_null' => 0,
                'multiple' => 0,
            ),
        ),
        'location' => array (
            array (
                array (
                    'param' => 'post_type',
                    'operator' => '==',
                    'value' => 'properties',
                    'order_no' => 0,
                    'group_no' => 0,
                ),
            ),
        ),
        'options' => array (
            'position' => 'acf_after_title',
            'layout' => 'no_box',
            'hide_on_screen' => array (
                0 => 'permalink',
                1 => 'the_content',
                2 => 'excerpt',
                3 => 'custom_fields',
                4 => 'discussion',
                5 => 'comments',
                6 => 'revisions',
                7 => 'slug',
                8 => 'author',
                9 => 'format',
                10 => 'featured_image',
                11 => 'categories',
                12 => 'tags',
                13 => 'send-trackbacks',
            ),
        ),
        'menu_order' => 0,
    ));
    register_field_group(array (
        'id' => 'acf_show-agent',
        'title' => 'Agent Visibility',
        'fields' => array (
            array (
                    'key' => 'field_showagent',
                    'label' => 'Always Show Agent Contact Info?',
                    'name' => 'always_show_agent',
                    'type' => 'true_false'
                    ),
            ),
        'location' => array (
            array (
                array (
                    'param' => 'options_page',
                    'operator' => '==',
                    'value' => 'acf-options',
                    'order_no' => 0,
                    'group_no' => 0,
                ),
            ),
        ),
        'options' => array (
            'position' => 'normal',
            'layout' => 'no_box',
            'hide_on_screen' => array (
            ),
        ),
        'menu_order' => 4,
    ));
    register_field_group(array (
        'id' => 'acf_logo-link',
        'title' => 'Logo Link Field',
        
        'fields' => array (
            array (
                    'key' => 'field_logolink',
                    'label' => 'Logo Link',
                    'instructions' => 'If you would like the Moreland logo in the header to link somewhere other than moreland.com, enter that URL here.',
                    'name' => 'logo_link',
                    'type' => 'text',
                    'default_value' => '',
                    'placeholder' => '',
                    'prepend' => '',
                    'append' => '',
                    'formatting' => 'none',
                    'maxlength' => ''
                    ),
            ),
        'location' => array (
            array (
                array (
                    'param' => 'options_page',
                    'operator' => '==',
                    'value' => 'acf-options',
                    'order_no' => 0,
                    'group_no' => 0,
                ),
            ),
        ),
        'options' => array (
            'position' => 'normal',
            'layout' => 'no_box',
            'hide_on_screen' => array (
            ),
        ),
        'menu_order' => 5,
    ));
}


function get_property_id() {
    global $wpdb;
    $prop_id = $wpdb->get_var("SELECT ID from wp_posts WHERE post_type = 'properties' LIMIT 1");
    return $prop_id;
}

?>
