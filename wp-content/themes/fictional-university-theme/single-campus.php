<?php

get_header();

while (have_posts()) {
    the_post();
    pageBanner();
    ?>

    <div class="container container--narrow page-section">
        <div class="metabox metabox--position-up metabox--with-home-link">
            <p>
                <a class="metabox__blog-home-link" href="<?php echo get_post_type_archive_link('campus') ?>"><i
                        class="fa fa-home" aria-hidden="true"></i> All Campuses
                </a>
                <span class="metabox__main">
                    <?php the_title(); ?>
                </span>
            </p>
        </div>

        <div class="generic-content">
            <?php the_content(); ?>
        </div>

        <div class="acf-map">
            <?php
            $mapLocation = get_field('map_location');
            ?>
            <div class="marker" data-lat="<?php echo $mapLocation['lat'] ?>" data-lng="<?php echo $mapLocation['lng'] ?>">
                <h3>
                    <?php the_title(); ?>
                </h3>
                <?php echo $mapLocation['address']; ?>
            </div>

        </div>

        <?php

        $relatedPrograms = new WP_Query(
            array(
                'post_per_page' => -1,
                'post_type' => 'program',
                'orderby' => 'title',
                'order' => 'ASC',
                'meta_query' => array(
                    array(
                        'key' => 'related_campus',
                        'compare' => 'LIKE',
                        'value' => '"' . get_the_ID() . '"' //the ID # of the program post
                        //The reason the quotes have to be used is because of the way the 
                        //data is stored. WordPress doesn't store a true array in the database.
                        //Instead it stores the data in a serialized format.
                    )
                )
            )
        );

        if ($relatedPrograms->have_posts()) {
            echo '<hr class="section-break">';
            echo '<h2 class="headline headline--medium">Programs Available At This Campus</h2>';

            echo '<ul class="min-list link-list">';
            while ($relatedPrograms->have_posts()) {
                $relatedPrograms->the_post(); ?>
                <li>
                    <a href="<?php the_permalink(); ?>">

                        <?php the_title(); ?>

                    </a>
                </li>
            <?php }
            echo '</ul>';
        }

        wp_reset_postdata(); /* Whenever you're going to run multiple queries on the same page
you're going to want to use this function to reset the global post object back to the default query*/

        $today = date('Ymd');
        $homePageEvents = new WP_Query(
            array(
                'post_per_page' => 2,
                //-1 means: give me all posts that meet these conditions
                'post_type' => 'event',
                'meta_key' => 'event_date',
                'orderby' => 'meta_value_num',
                'order' => 'ASC',
                'meta_query' => array(
                    //this section is used to filter out events that have already happened
                    array(
                        'key' => 'event_date',
                        'compare' => '>=',
                        'value' => $today,
                        'type' => 'numeric'
                    ),
                    array(
                        //if the array of related programs contains the ID # of the program post
                        'key' => 'related_programs',
                        //if the array of related programs
                        'compare' => 'LIKE',
                        //contains
                        'value' => '"' . get_the_ID() . '"' //the ID # of the program post
                        //The reason the quotes have to be used is because of the way the 
                        //data is stored. WordPress doesn't store a true array in the database.
                        //Instead it stores the data in a serialized format.
                    )
                )
            )
        );

        if ($homePageEvents->have_posts()) {
            echo '<hr class="section-break">';
            echo '<h2 class="headline headline--medium">Upcoming ' . get_the_title() . ' Events</h2>';

            while ($homePageEvents->have_posts()) {
                $homePageEvents->the_post();
                get_template_part('template-parts/content-event');
            }
        }

        ?>

    </div>

<?php }

get_footer();

?>