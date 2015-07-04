<?php
/*
  Plugin Name: WP Responsive Slider
  Plugin URI: http://www.e2soft.com/blog/wp-sesponsive-slider/
  Description: WP Responsive Slider is a wordpress responsive slider plugin. Use this shortcode <strong>[WPRS-SLIDER]</strong> in the post/page" where you want to display slider.
  Version: 1.0
  Author: S M Hasibul Islam
  Author URI: http://www.e2soft.com
  Copyright: 2015 S M Hasibul Islam http:/`/www.e2soft.com
  License URI: license.txt
 */


#######################	WP Responsive Slider ###############################

// Register Custom Post Type
function wprs_post_type() {
	$labels = array(
		'name'                => _x( 'WP Responsive Sliders', 'Post Type General Name', 'wprs' ),
		'singular_name'       => _x( 'WP Responsive Slider', 'Post Type Singular Name', 'wprs' ),
		'menu_name'           => __( 'WPRS Slider', 'wprs' ),
		'name_admin_bar'      => __( 'WP Responsive Slider', 'wprs' ),
		'parent_item_colon'   => __( 'Parent Item:', 'wprs' ),
		'all_items'           => __( 'All Items', 'wprs' ),
		'add_new_item'        => __( 'Add New Item', 'wprs' ),
		'add_new'             => __( 'Add New', 'wprs' ),
		'new_item'            => __( 'New Item', 'wprs' ),
		'edit_item'           => __( 'Edit Item', 'wprs' ),
		'update_item'         => __( 'Update Item', 'wprs' ),
		'view_item'           => __( 'View Item', 'wprs' ),
		'search_items'        => __( 'Search Item', 'wprs' ),
		'not_found'           => __( 'Not found', 'wprs' ),
		'not_found_in_trash'  => __( 'Not found in Trash', 'wprs' ),
	);
	$args = array(
		'label'               => __( 'wp-responsive-slider', 'wprs' ),
		'description'         => __( 'WP Responsive Slider Description', 'wprs' ),
		'labels'              => $labels,
		'supports'            => array( 'title', 'editor', 'thumbnail', ),
		'hierarchical'        => false,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'menu_position'       => 5,
		'show_in_admin_bar'   => true,
		'show_in_nav_menus'   => true,
		'can_export'          => true,
		'has_archive'         => true,
		'exclude_from_search' => false,
		'publicly_queryable'  => true,
		'capability_type'     => 'page',
	);
	register_post_type( 'wp-responsive-slider', $args );
}
// Hook into the 'init' action
add_action( 'init', 'wprs_post_type', 0 );

function register_wprs_script() {
    wp_enqueue_script('wprs-min', plugins_url('/js/wprs-min.js', __FILE__), array('jquery'));
    wp_enqueue_style('wprs-style', plugins_url('/css/wprs-style.css', __FILE__));
}
add_action('wp_enqueue_scripts', 'register_wprs_script');

function wprs_admin_script() {
    wp_enqueue_style('wprs-admin', plugins_url('/css/wprs-admin.css', __FILE__));
	wp_enqueue_style( 'wp-color-picker' );
    wp_enqueue_script( 'iris', admin_url( 'js/iris.min.js' ), array( 'jquery-ui-draggable', 'jquery-ui-slider', 'jquery-touch-punch' ), false, 1 );
	wp_enqueue_script( 'cp-active', plugins_url('/js/cp-active.js', __FILE__), array('jquery'), '', true );
}
add_action('admin_enqueue_scripts', 'wprs_admin_script');

function wprs_post_slide_loop() {
	//lightSlider
    echo '<div id="wprs_slider"><ul class="bxslider clearfix">';
    $wprs_args = array(
        'post_type' => 'wp-responsive-slider',
        'orderby' => 'date',
        'order' => 'DESC'
    );
    $wprs_query = new WP_Query($wprs_args);
    while ($wprs_query->have_posts()) : $wprs_query->the_post();
        $thumb_id = get_post_thumbnail_id();
        $thumb_url = wp_get_attachment_image_src($thumb_id, 'full', true);
        ?>
        <li><img src="<?php echo $thumb_url[0]; ?>" alt="<?php the_title(); ?>" /></li>
        <?php
    endwhile;
    echo '</ul></div>';
    wp_reset_query();
}

function wprs_slide_script() {
    ?>
    <script type="text/javascript">
    	 jQuery(document).ready(function(){
			jQuery('.bxslider').bxSlider({
			  auto: true,
			});
		 });
    </script>
    <?php
}
add_action('wp_footer', 'wprs_slide_script', 100);

function wprs_resesponsive_slider() {
    return wprs_post_slide_loop();
}
add_shortcode('WPRS-SLIDER', 'wprs_post_slide_loop');

foreach ( glob( plugin_dir_path( __FILE__ )."lib/*.php" ) as $wprsfile )
    include_once $wprsfile;
	
register_activation_hook(__FILE__, 'wprs_plugin_activate');
add_action('admin_init', 'wprs_plugin_redirect');

function wprs_plugin_activate() {
    add_option('wprs_plugin_do_activation_redirect', true);
}

function wprs_plugin_redirect() {
    if (get_option('wprs_plugin_do_activation_redirect', false)) {
        delete_option('wprs_plugin_do_activation_redirect');
        if(!isset($_GET['activate-multi']))
        {
            wp_redirect("edit.php?post_type=wp-responsive-slider&page=wprs");
        }
    }
}