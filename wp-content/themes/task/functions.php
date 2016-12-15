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

if (!isset($content_width))
{
    $content_width = 900;
}

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
    }
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
    wp_register_style('normalize', get_template_directory_uri() . '/normalize.css', array(), '1.0', 'all');
    wp_enqueue_style('normalize'); // Enqueue it!

    wp_register_style('html5blank', get_template_directory_uri() . '/style.css', array(), '1.0', 'all');
    wp_enqueue_style('html5blank'); // Enqueue it!
}

// Register HTML5 Blank Navigation
function register_html5_menu()
{
    register_nav_menus(array( // Using array to specify more menus if needed
        'header-menu' => __('Header Menu', 'html5blank'), // Main Navigation
        'sidebar-menu' => __('Sidebar Menu', 'html5blank'), // Sidebar Navigation
        'extra-menu' => __('Extra Menu', 'html5blank') // Extra Navigation if needed (duplicate as many as you need!)
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



/*------------------------------------*\
	ShortCode Functions
\*------------------------------------*/

// Shortcode Demo with Nested Capability
function html5_shortcode_demo($atts, $content = null)
{
    return '<div class="shortcode-demo">' . do_shortcode($content) . '</div>'; // do_shortcode allows for nested Shortcodes
}

// Shortcode Demo with simple <h2> tag
function html5_shortcode_demo_2($atts, $content = null) // Demo Heading H2 shortcode, allows for nesting within above element. Fully expandable.
{
    return '<h2>' . $content . '</h2>';
}
















/*------------------------------------*\
    Custom Post Types
\*------------------------------------*/

// Create 1 Custom Post type skill
function create_post_type_html5()
{
    register_post_type('skill', // Register Custom Post Type
        array(
        'labels' => array(
            'name' => __('Skills', 'html5blank'), // Rename these to suit
            'singular_name' => __('Skill', 'html5blank'),
            'add_new' => __('Add New', 'html5blank'),
            'add_new_item' => __('Add New Skill', 'html5blank'),
            'edit' => __('Edit', 'html5blank'),
            'edit_item' => __('Edit Skill', 'html5blank'),
            'new_item' => __('New Skill', 'html5blank'),
            'view' => __('View Skill', 'html5blank'),
            'view_item' => __('View Skill', 'html5blank'),
            'search_items' => __('Search Skill', 'html5blank'),
            'not_found' => __('No Skill found', 'html5blank'),
            'not_found_in_trash' => __('No Skill found in Trash', 'html5blank')
        ),
        'public' => true,
        'hierarchical' => false, // Allows your posts to behave like Hierarchy Pages
        'has_archive' => false,
        'supports' => array(
            'title'
        ), // Go to Dashboard Custom HTML5 Blank post for supports
        'can_export' => true, // Allows export in Tools > Export
        'taxonomies' => array(
        ), // Add Category and Post Tags support
        'publicly_queryable'  => false,
        'query_var'           => false,
        'show_in_nav_menus'   => false,
        'exclude_from_search' => true,
    ));
}


add_action('init', 'create_post_type_html5'); // Add skill Custom Post Type









/**
 * Add skill meta box
 *
 * @param post $post The post object
 */
function skill_add_meta_boxes( $post ){
    add_meta_box( 'skill_meta_box', __( 'Skill Details', 'html5blank' ), 'skill_build_meta_box', 'skill' );
}
add_action( 'add_meta_boxes', 'skill_add_meta_boxes' );








/**
 * Build skill meta box
 *
 * @param post $post The post object
 */
function skill_build_meta_box( $post ){
    // make sure the form request comes from WordPress
    wp_nonce_field( basename( __FILE__ ), 'skill_meta_box_nonce' );

    // get skill name current value
    $skill_name = get_post_meta( $post->ID, '_skill_name', true );

    // get skill result current value
    $skill_result = get_post_meta( $post->ID, '_skill_result', true );
    
    ?>
    <div class='inside'>

        <h3><?php _e( 'Skill Name', 'html5blank' ); ?></h3>
        <p>
            <input class="regular-text" type="text" name="skill_name" value="<?php echo $skill_name; ?>" required> 
        </p>

        <h3><?php _e( 'Skill Result', 'html5blank' ); ?></h3>
        <p>
            <input class="regular-text" type="number" min="0" max="100" step="1" name="skill_result" value="<?php echo $skill_result; ?>" required> %
        </p>
        
    </div>
    <?php
}










/**
 * Store skill custom field meta box data
 *
 * @param int $post_id The post ID.
 */
function skill_save_meta_box_data( $post_id ){
    // verify taxonomies meta box nonce
    if ( !isset( $_POST['skill_meta_box_nonce'] ) || !wp_verify_nonce( $_POST['skill_meta_box_nonce'], basename( __FILE__ ) ) ){
        return;
    }
    // return if autosave
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ){
        return;
    }
    // Check the user's permissions.
    if ( ! current_user_can( 'edit_post', $post_id ) ){
        return;
    }

    // store skill name
    if ( isset( $_REQUEST['skill_name'] ) ) {
        update_post_meta( $post_id, '_skill_name', sanitize_text_field( $_POST['skill_name'] ) );
    }
    
    // store skill result
    if ( isset( $_REQUEST['skill_result'] ) ) {
        update_post_meta( $post_id, '_skill_result', sanitize_text_field( $_POST['skill_result'] ) );
    }
    
}
add_action( 'save_post_skill', 'skill_save_meta_box_data' );










/**
 * Generate skills shortcode
 *
 *
 */
function skills_shortcode( $atts ) 
{
    // enqueue when shorcode is present
    wp_enqueue_script('jquery-2');
    wp_enqueue_script('ajax-skills');
    
    $output = '<ul class="skills-list"></ul>';
    return $output;
}
add_shortcode( 'skills', 'skills_shortcode' );










/**
 * Generate skills shortcode
 *
 *
 */
function skills_result_shortcode( $atts ) 
{
    // enqueue when shorcode is present
    wp_enqueue_script('jquery-2');
    wp_enqueue_script('ajax-skills');

    $output = '
            <!-- Main Div Starts Here
            ========================= -->    
            <div id="main">
                <!-- table -->
                <div class="skill-container table">
                    <!-- Tbale-cell -->
                    <div class="table-cell">
                        <!-- Container-->
                        <div class="container">

                            <!-- Result Portion Starts Here 
                            =============================== -->
                            <div class="result">
                                <h2>Result</h2>

                                <!-- Percentage Circle Bar -->
                                <div id="cont" data-pct="0">
                                    <div class="total-text">total</div>
                                    <svg id="svg" width="200" height="200" viewPort="0 0 100 100" version="1.1" xmlns="http://www.w3.org/2000/svg">
                                      <circle r="70" cx="100" cy="80" fill="transparent" stroke-dasharray="439.82" stroke-dashoffset="0"></circle>
                                      <circle id="bar" r="70" cx="100" cy="80" fill="transparent" stroke-dasharray="439.82" stroke-dashoffset="0" transform="rotate(-90,100,80)"></circle>
                                    </svg>
                                </div>
                                <!-- Percentage Circle Bar -->

                                <!-- Percentage Bar Data -->
                                <div class="percentage-data">
                                    <div class="tp-text">
                                        <strong>status:</strong>
                                        <span>fail</span>
                                        <a href="#" title="">change</a>
                                    </div>
                                    
                                    <div class="bt-text">
                                        <p>Time: <span>2h 2min</span> </p>
                                    </div>
                                    
                                    <p>(of max 1h 50min)</p>    
                                </div>
                                <!-- Percentage Bar Data -->
                                
                            </div>
                            <!-- Result Portion ENds Here 
                            =============================== -->

                            <!-- BreakDown Portion Starts Here 
                            ================================== -->
                            <div class="breakdown">
                                <h2>Breakdown</h2>
                                <ul class="skills-list"></ul>
                            </div>
                            <!-- BreakDown Portion Ends Here 
                            ================================== -->

                            <!-- History Portion Starts Here 
                            ================================== -->
                            <div class="history-sec">
                                <h2>history</h2>
                                <p>Invitation email on aug 15</p>
                                <p>Candidate started the test on aug 15</p>
                                <p>Candidate completed the test on aug 15</p>

                            </div>
                            <!-- History Portion ENds Here 
                            ================================== -->  
                        </div>
                        <!-- Container -->
                    </div>
                    <!-- table-cell-->
                </div>
               <!--table-->
            </div>
            <!-- Main Div Ends Here
            ======================= -->

        ';
    return $output;
}
add_shortcode( 'skills-result', 'skills_result_shortcode' );








/**
 * Enqueue skills scripts
 *
 *
 */
function enqueue_skills() 
{
    wp_register_script('jquery-2', get_template_directory_uri() . '/js/lib/jquery-2.1.3.min.js', array(), '2.1.3');

    wp_register_script('ajax-skills', get_template_directory_uri() . '/js/ajax.js', array('jquery-2'), '1.0.0');
    

    wp_localize_script( 
        'ajax-skills',
        'wp_ajax',
        array( 
            'ajaxurl'      => admin_url( 'admin-ajax.php' ),
            'ajaxnonce'   => wp_create_nonce( 'ajax_post_validation' )
        ) 
    );
}
add_action( 'wp_enqueue_scripts', 'enqueue_skills' );








/**
 * Get ajax request for skills
 *
 *
 */
function query_skills_posts()
{
    check_ajax_referer( 'ajax_post_validation', 'security' );

    // Processing request
    $response_data = array();
    $response_data['skills_list'] = '';
    $total_skills = 0;
    $total_results = 0;
    $args = array(
        'post_type' => 'skill',
        'post_status' => 'publish',
        'posts_per_page' => -1
    );

    $skill_query = new WP_Query( $args );

    if( $skill_query->have_posts() ) : while ( $skill_query->have_posts() ) : $skill_query->the_post();


        
        $post_skill_name = get_post_meta(get_the_ID(), '_skill_name', true);
        $post_skill_result = get_post_meta(get_the_ID(), '_skill_result', true);

        $response_data['skills_list'] .= '
            <li>
                <p>'.$post_skill_name.'</p>
                <div class="progress-bar">
                    <div class="progress-bar-inner" style="width:'.(int)$post_skill_result.'%;">        
                    </div>
                </div>
                <span>'.$post_skill_result.'%</span>
            </li>
        ';

        // counting total average score
        $total_skills++; 
        $total_results += (int) $post_skill_result;

    endwhile; else :

        wp_send_json_error( array( 'error' => '<p>No skill found.</p>' ) );

    endif;
    wp_reset_postdata();


    $response_data['skills_total'] = ceil($total_results / ($total_skills)); 

    wp_send_json_success( $response_data );
    
}

add_action( 'wp_ajax_query_skills_posts', 'query_skills_posts' );
add_action( 'wp_ajax_nopriv_query_skills_posts', 'query_skills_posts' );



?>
