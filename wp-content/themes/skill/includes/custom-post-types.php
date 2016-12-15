<?php
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