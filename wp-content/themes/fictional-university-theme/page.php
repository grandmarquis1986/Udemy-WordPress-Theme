<?php

get_header();

while (have_posts()) {
  the_post(); 
  pageBanner(array(
    'photo' => 'https://external-content.duckduckgo.com/iu/?u=https%3A%2F%2Fwww.up.com%2Fcs%2Fgroups%2Fpublic%2F%40uprr%2F%40corprel%2Fdocuments%2Fdigitalmedia%2Fimg_up_media-4014-150-cele.jpg&f=1&nofb=1&ipt=4af2ead29cbf570207a7ed9269eece6e64f8cf3c202cefb6d7fd6aab14d9525e&ipo=images',
  ));
  ?>  

  <div class="container container--narrow page-section">
    <?php

    $theParent = wp_get_post_parent_id(get_the_ID());
    // $theParent returns the ID of the parent page, or it will return 0 if it is a parent page.
  
    if ($theParent) { ?>

      <div class="metabox metabox--position-up metabox--with-home-link">
        <p>
          <a class="metabox__blog-home-link" href="<?php echo get_permalink($theParent) ?>"><i class="fa fa-home"
              aria-hidden="true"></i> Back to
            <?php echo get_the_title($theParent); ?>
          </a>
          <span class="metabox__main">
            <?php the_title(); ?>
          </span>
        </p>
      </div>

    <?php }

    ?>



    <?php
    $testArray = get_pages(
      array(
        'child_of' => get_the_ID()
        /*This function looks at the ID of the current page, and if the page has children it will return a collection
        of any and all children pages. If it has no children then function will return NULL or false or 0*/
      )
    );
    if ($theParent or $testArray) { ?>
      <!-- This 'if' statement is used to determine if the child pages menu will appear. First it checks $theParent. If $theParent evaluates to a number
      greater than zero the it will display the menu. However, if it is a parent page and evaluates to of false, then you want to check if it has 
      children. That is what the 'or' part of the statement is for. If it returns false or zero for no children then the menu will not appear.-->
      <div class="page-links">
        <h2 class="page-links__title"><a href="<?php echo get_permalink($theParent); ?>"><?php echo get_the_title($theParent); ?></a></h2>
        <ul class="min-list">
          <?php

          if ($theParent) { //This only runs if the page is a parent page or has a parent (see Line 55)
            /*If this is not a parent page (has evaluated to a number larger than zero), 
            then it sets $findChildrenOf to the value of the parent page ID*/
            $findChildrenOf = $theParent;
          } else {
            /*This section only runs if $theParent has evaluated to zero and therefore is a parent page.
            Then, $findChildrenOf is set to the ID of the current page (i.e. the ID of the parent page)*/
            $findChildrenOf = get_the_ID();
          }

          wp_list_pages(
            //This functions lists all the children pages in the menu
            array(
              'title_li' => NULL,
              'child_of' => $findChildrenOf,
              'sort_column' => 'menu_order'
            )
          );

          ?>
        </ul>
      </div>
    <?php } ?>


    <div class="generic-content">
      <?php the_content(); ?>
    </div>
  </div>

<?php }

get_footer();

?>