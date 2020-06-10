<?php

if ( have_posts() ) :

    while ( have_posts() ) :

        the_post();

        get_template_part("template-parts/article-for-listing");
 $format = get_post_format();

    endwhile;

    theme_pagination( $wp_query->max_num_pages);
if($format=='video'){?><a class="real-btn" href="<?php echo site_url().'/category/real-estate-videos/'; ?>"  ><?php _e('Back', 'framework'); ?></a> <?php }else{}

else :

    ?><p class="nothing-found"><?php _e('No Posts Found!', 'framework'); ?></p><?php

endif;

?>