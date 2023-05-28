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
}

//The following three register_nav_menu functions were from Lesson 20
//register_nav_menu('headerMenuLocation', 'Header Menu Location'); //This function adds the "Menu" option in the WordPress Admin area under Appearance
//register_nav_menu('footerLocationOne', 'Footer Location One');
//register_nav_menu('footerLocationTwo', 'Footer Location Two');
add_action('after_setup_theme', 'university_features');

?>