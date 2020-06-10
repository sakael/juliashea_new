<article class="property-item clearfix">
    <?php
    if(has_post_thumbnail($post->ID)){
        ?>
        <figure>
            <a href="<?php the_permalink() ?>" title="<?php the_title(); ?>">
                <?php
                the_post_thumbnail('grid-view-image',array(
                    'alt'	=> get_the_title(),
                    'title'	=> get_the_title()
                ));
                ?>
            </a>

            <figcaption>
                <?php
                $status_terms = get_the_terms( $post->ID,"property-status" );
                if(!empty( $status_terms )){
                    foreach( $status_terms as $status_term ){
                        echo $status_term->name;
                        break;
                    }
                }
                ?>
            </figcaption>
        </figure>
        <?php
    }
    ?>

    <h4><a href="<?php the_permalink() ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h4>
    <p><?php framework_excerpt(10); ?> <a class="more-details" href="<?php the_permalink() ?>"><?php _e('More Details ','framework'); ?><i class="fa fa-caret-right"></i></a></p>
    <span><?php property_price(); ?></span>
</article>