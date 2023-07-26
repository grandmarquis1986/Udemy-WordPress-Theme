<?php 
function university_post_types() {
    register_post_type('event', array(
        'supports' => array('title', 'editor', 'excerpt'), //here editor is referring to the modern WP editor
        'rewrite' => array('slug' => 'events'), //this rewrites the slug for his post type
        'has_archive' => true,
        'public' => true,
        'show_in_rest' => true,
        'labels' => array(
            'name' => 'Events',
            'add_new_item' => 'Add New Event',
            'edit_item' => 'Edit Event',
            'all_items' => 'All Events',
            'singular_name' => 'Event'
        ),
        'menu_icon' => 'dashicons-calendar'
    ));
}

add_action('init', 'university_post_types') //this function initializes a new function: university_post_types()

?>