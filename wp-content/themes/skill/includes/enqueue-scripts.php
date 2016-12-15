<?php
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