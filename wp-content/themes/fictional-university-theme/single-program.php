<?php

get_header();

while (have_posts()) {
    the_post();
    pageBanner();
    ?>

    <div class="container container--narrow page-section">
        <div class="metabox metabox--position-up metabox--with-home-link">
            <p>
                <a class="metabox__blog-home-link" href="<?php echo get_post_type_archive_link('program') ?>"><i
                        class="fa fa-home" aria-hidden="true"></i> All Programs
                </a>
                <span class="metabox__main">
                    <?php the_title(); ?>
                </span>
            </p>
        </div>
        <div class="generic-content">
            <?php

            the_content();

            ?>
        </div>

        <?php

        $relatedProfessors = new WP_Query(
            array(
                'post_per_page' => -1,
                'post_type' => 'professor',
                'orderby' => 'title',
                'order' => 'ASC',
                'meta_query' => array(
                    array(
                        'key' => 'related_programs',
                        'compare' => 'LIKE',
                        'value' => '"' . get_the_ID() . '"' //the ID # of the program post
                        //The reason the quotes have to be used is because of the way the 
                        //data is stored. WordPress doesn't store a true array in the database.
                        //Instead it stores the data in a serialized format.
                    )
                )
            )
        );

        if ($relatedProfessors->have_posts()) {
            echo '<hr class="section-break">';
            echo '<h2 class="headline headline--medium">' . get_the_title() . ' Professors</h2>';

            echo '<ul class="professor-cards">';
            while ($relatedProfessors->have_posts()) {
                $relatedProfessors->the_post(); ?>
                <li class="professor-card__list-item">
                    <a class="professor-card" href="<?php the_permalink(); ?>">
                        <img class="professor-card__image" src="<?php the_post_thumbnail_url('professorLandscape'); ?>">
                        <span class="professor-card__name">
                            <?php the_title(); ?>
                        </span>
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