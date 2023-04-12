<?php

function university_files() {
    wp_enqueue_script('main-university-js', get_theme_file_uri('/build/index.js'), array('jquery'), '1.0', true);  /*When loading scripts, the array is for any 
                                                                                                                    dependencies such as jquery. If there are no 
                                                                                                                    dependencies, instead of array you can simply 
                                                                                                                    put NULL*/
    wp_enqueue_style('custom-google-fonts', '//fonts.googleapis.com/css?family=Roboto+Condensed:300,300i,400,400i,700,700i|Roboto:100,300,400,400i,700,700i');
    wp_enqueue_style('font-awesome', '//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css');
    wp_enqueue_style('university_main_styles', get_theme_file_uri('/build/style-index.css'));   //This function takes 2 arguments. The first is simply a nickname that
                                                                                                //will make sense to the developer. The second points to the location
                                                                                                //of the stylesheet.
    wp_enqueue_style('university_main_styles', get_theme_file_uri('/build/index.css'));    
}

add_action('wp_enqueue_scripts','university_files'); //This function is looking for 2 arguments. The first is a specific WordPress hook.
                                                     //the second is the function that you create. Be sure to actually create this function
                                                     //as in the example above.

?>