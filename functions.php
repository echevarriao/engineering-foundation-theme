<?php

add_action('wp_enqueue_scripts', 'engr_load_css_js_foundation');

function engr_load_css_js_foundation(){
    
    $path = get_template_directory_uri();
    
    wp_enqueue_style('normalize-style', "$path/css/normalize.css");
    wp_enqueue_style('foundation-style', "$path/css/foundation.min.css");
    wp_enqueue_style('fonts-style', "$path/css/fonts.css");
    wp_enqueue_style('style', get_stylesheet_uri());
    wp_enqueue_style('foundation-custom-style', "$path/css/app.css");

    wp_enqueue_script('foundation-lib-jquery',  "$path/js/vendor/jquery.js");
    wp_enqueue_script('foundation-jquery',  "$path/js/foundation.min.js");
    wp_enqueue_script('modernizr',  "$path/js/vendor/modernizr.js");
    wp_enqueue_script('uconn-alert', 'http://alert.uconn.edu/alert.js');

}

function engr_widgets_init() {

    for($itl_regWidget = 1; $itl_regWidget < 11; $itl_regWidget++){

    register_sidebar(
		 
      array(
    'name' => __( "Page Widget $itl_regWidget", 'engr_foundation' ),
    'id' => "widget-$itl_regWidget",
    'description' => __("Widget that displays specific content."),
    'before_title' => '<h3 class = "fp-column-titles">',
    'after_title' => '</h3>',
    'before_widget' => '',
    'after_widget' => '',

    ));

    }

	register_sidebar( array(
		'name' => __( 'Main Sidebar', 'engr_foundation' ),
		'id' => 'sidebar-1',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	register_sidebar( array(
		'name' => __( 'Showcase Sidebar', 'engr_foundation' ),
		'id' => 'sidebar-2',
		'description' => __( 'The sidebar for the optional Showcase Template', 'engr_foundation' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	register_sidebar( array(
		'name' => __( 'Footer Area One', 'engr_foundation' ),
		'id' => 'footer-area-1',
		'description' => __( 'An optional widget area for your site footer', 'engr_foundation' ),
		'before_widget' => '<div id="%1$s" class="%2$s large-3 footer-section left columns">',
		'after_widget' => "</div>",
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	register_sidebar( array(
		'name' => __( 'Footer Area Two', 'engr_foundation' ),
		'id' => 'footer-area-2',
		'description' => __( 'An optional widget area for your site footer', 'engr_foundation' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	register_sidebar( array(
		'name' => __( 'Footer Area Three', 'engr_foundation' ),
		'id' => 'footer-area-3',
		'description' => __( 'An optional widget area for your site footer', 'engr_foundation' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	register_sidebar( array(
		'name' => __( 'Footer Site Map', 'engr_foundation' ),
		'id' => 'footer-sitemap',
		'description' => __( 'An optional widget area for your site map footer', 'engr_foundation' ),
		'before_widget' => '<li class = "footer-sitemap-objs">',
		'after_widget' => '</li>',
		'before_title' => '<p><b><span class = "footer-column-titles">',
		'after_title' => '</span></b></p>',
	) );
	
	register_sidebar( array(
		'name' => __( 'Left Sub-Section', 'engr_foundation' ),
		'id' => 'left-subsection-bottom',
		'description' => __( 'An optional widget area for your site left sub-section', 'engr_foundation' ),
		'before_widget' => '',
		'after_widget' => '',
		'before_title' => '<h2 class = "subsection-title">',
		'after_title' => '</h2>',
	) );

		register_sidebar( array(
		'name' => __( 'Right Sub-Section', 'engr_foundation' ),
		'id' => 'right-subsection-bottom',
		'description' => __( 'An optional widget area for your site right sub-section', 'engr_foundation' ),
		'before_widget' => '',
		'after_widget' => '',
		'before_title' => '<h2 class = "subsection-title">',
		'after_title' => '</h2>',
	) );


	register_sidebar( array(
		'name' => __( 'Footer Address Section', 'engr_foundation' ),
		'id' => 'footer-address-area',
		'description' => __( 'An optional widget area for your site footer address', 'engr_foundation' ),
		'before_widget' => '',
		'after_widget' => '',
		'before_title' => '',
		'after_title' => '',
	) );
	
}

add_action( 'widgets_init', 'engr_widgets_init' );

require(get_template_directory() . "/widgets/widget.class.php");

if(!function_exists("uconn_reDirectPage")){

// add functionality to the HEAD tag

/*
 * @param void
 * @version 0.5
 * @return void
 * @description allows user to redirect page to a different website or page
 * 
 */

add_action('wp_head','uconn_reDirectPage');

function uconn_reDirectPage() {

    global $post;
    
    $redirect = get_post_meta($post->ID, 'redirect', true);
    $url = get_post_meta($post->ID, 'redirecturl', true);

    if((strtolower($redirect) == "yes" || strtolower($redirect) == "true" || strtolower($redirect) == "y") && filter_var($url, FILTER_VALIDATE_URL) == true && !is_archive()){
	
    print "<meta http-equiv=\"refresh\" content=\"0;url=$url\" />\n\r";
	
    } else {
	
    print "<!--  -->\n\r";
	
    }

}

}

// if the function does not exist
// lets define the function

// add functionality to content section
// allows short code [uconn_gotourl link = "http://www.example.com"]

/*
 * @param void
 * @version 0.2
 * @return void
 * @description allows user to redirect page to a different website or page using a shortcode
 * 
 */

add_shortcode( 'uconn_gotonewurl', 'gotonewurl_shortcode' );

function gotonewurl_shortcode( $atts ) {

    $url = "";

     extract( shortcode_atts( array(
	      'url' => ''), $atts ) );

    $url = $atts['url'];

    if(filter_var($url, FILTER_VALIDATE_URL)){
    
?>
<p>You will now be redirected momentarily to <a href="<?php print $url; ?>"><?php print $url; ?></a>. If you are not redirected within the next 10 seconds, please <a href="<?php print $url; ?>">click here</a>.</p>
<script language = "javascript">

gotoURL(); // execute function

// function that triggers web browser
// to go to new web site

function gotoURL(){
    
    location.href = "<?php print $url; ?>";
    
}
    
</script>    
<?php } else { ?>
<p>The page is trying redirect you to a URL(<?php print $url; ?>) that is not a valid URL. Please contact the website administrator.</p>
<?php }

}



add_action( 'after_setup_theme', 'engr_foundation_setup' );

function engr_foundation_setup(){
    
	// Add default posts and comments RSS feed links to <head>.

	add_theme_support( 'automatic-feed-links' );

	// This theme uses wp_nav_menu() in one location.

	register_nav_menu( 'primary', __( 'Primary Menu', 'engr_foundation' ) );

	// Add support for a variety of post formats

	add_theme_support( 'post-formats', array( 'aside', 'link', 'gallery', 'status', 'quote', 'image', 'video' ) );
    
	// This theme uses Featured Images (also known as post thumbnails) for per-post/per-page Custom Header images

	add_theme_support( 'post-thumbnails' );
    
}


add_action('init', 'engr_load_menus');

function engr_load_menus(){
    
    register_nav_menus(array(

    'top-menu' => 'Top Menu',                             
    'left-menu' => 'Left Menu',                             
    'right-menu' => 'Right Menu',                             
    'footer-menu' => 'Footer Menu',                             

    ));
    
}

// for foundation

if (!function_exists('GC_menu_set_dropdown')) :

function GC_menu_set_dropdown($sorted_menu_items, $args) {
  $last_top = 0;
  foreach ($sorted_menu_items as $key => $obj) {
    // it is a top lv item?
    if (0 == $obj->menu_item_parent) {
      // set the key of the parent
      $last_top = $key;
    } else {
      $sorted_menu_items[$last_top]->classes['dropdown'] = 'has-dropdown';
    }
  }

  return $sorted_menu_items;
}
endif;

add_filter('wp_nav_menu_objects', 'GC_menu_set_dropdown', 10, 2);

class GC_walker_nav_menu extends Walker_Nav_Menu {

  // add classes to ul sub-menus
  function start_lvl(&$output, $depth) {
    // depth dependent classes
    $indent = ( $depth > 0 ? str_repeat("\t", $depth) : '' ); // code indent

    // build html
    $output .= "\n" . $indent . '<ul class="dropdown">' . "\n";
  }
}

?>