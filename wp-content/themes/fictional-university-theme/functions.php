<?php

function university_files() {
    wp_enqueue_style('university_main_styles',get_stylesheet_uri()); //This function takes 2 arguments. The first is simply a nickname that
                                                                       //will make sense to the developer. The second points to the location
                                                                       //of the stylesheet.
}

add_action('wp_enqueue_scripts','university_files'); //This function is looking for 2 arguments. The first is a specific WordPress hook.
                                                     //the second is the function that you create. Be sure to actually create this function
                                                     //as in the example above.

?>