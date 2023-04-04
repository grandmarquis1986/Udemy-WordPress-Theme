<?php
    function greet($name, $color) {
        echo "<p>Hi, my name is $name and my favorite color is $color.</p>";
    }

    greet('John', 'blue');
    greet('Jane', 'green');
?>

<h1><?php bloginfo('name'); ?></h1> <!-- name comes from the WordPress dashboard under Settings > Site Title -->
<p><?php bloginfo('description'); ?></p> <!-- description comes from the WordPress dashboard under Settings > Tagline -->