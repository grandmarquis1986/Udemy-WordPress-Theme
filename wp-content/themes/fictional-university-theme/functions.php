<?php

function university_files() {
    wp_enqueue_script('main-university-js', get_theme_file_uri('/build/index.js'), array('jquery'), '1.0', true);
    wp_enqueue_style('custom-google-fonts', '//fonts.googleapis.com/css?family=Roboto+Condensed:300,300i,400,400i,700,700i|Roboto:100,300,400,400i,700,700i');
    wp_enqueue_style('font-awesome', '//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css');
    wp_enqueue_style('university_main_styles', get_theme_file_uri('/build/style-index.css')); //This function takes 2 arguments. The first is simply a nickname that
                                                                       //will make sense to the developer. The second points to the location
                                                                       //of the stylesheet.
    wp_enqueue_style('university_extra_styles', get_theme_file_uri('/build/index.css'));
}

add_action('wp_enqueue_scripts','university_files'); //This function is looking for 2 arguments. The first is a specific WordPress hook.
                                                     //the second is the function that you create. Be sure to actually create this function
                                                     //as in the example above.

function university_features() {
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails'); //This enables Featured Images on Blog post types
    add_image_size('professorLandscape', 400, 260, true);
    add_image_size('professorPortrait', 480, 650, true);
    add_image_size('pageBanner', 1500, 350, true);
}

//The following three register_nav_menu functions were from Lesson 20
//register_nav_menu('headerMenuLocation', 'Header Menu Location'); //This function adds the "Menu" option in the WordPress Admin area under Appearance
//register_nav_menu('footerLocationOne', 'Footer Location One');
//register_nav_menu('footerLocationTwo', 'Footer Location Two');
add_action('after_setup_theme', 'university_features');

function university_adjust_queries($query) { //when this function runs it is going to take the query object
    //Program Query
    if (!is_admin() AND is_post_type_archive('program') AND $query->is_main_query()) {
        $query->set('orderby','title');
        $query->set('order','ASC');
        $query->set('posts_per_page', -1);
    }

    //Event Query
    if (!is_admin() AND is_post_type_archive('event') AND $query->is_main_query()) {
        $today = date('Ymd');
        $query->set('meta_key','event_date');
        $query->set('orderby','meta_value_num');
        $query->set('order','ASC');
        $query->set('meta_query', array( //this section is used to filter out events that have already happened
            array(
                'key' => 'event_date',
                'compare' => '>=',
                'value' => $today,
                'type' => 'numeric'
            )
        ));
    }
 }
add_action('pre_get_posts','university_adjust_queries') //the first argument says when the action should happen; the second argument is what to do

?>