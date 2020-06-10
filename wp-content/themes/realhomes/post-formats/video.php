<?php
    global $post;
    $embed_code = get_post_meta($post->ID, 'REAL_HOMES_embed_code', true);

    if(!empty($embed_code))
    {
        ?>
        <div class="post-video">
            <span class="format-icon video"></span>
            <div class="video-wrapper">
                <?php echo stripslashes(htmlspecialchars_decode($embed_code)); ?>
            </div>
        </div>
        <?php
    }
    elseif(has_post_thumbnail())
    {
        $image_id = get_post_thumbnail_id();
        $image_url = wp_get_attachment_url($image_id);

        ?>
        <div class="post-video">
            <span class="format-icon video"></span>
            <a href="<?php echo $image_url; ?>" class="pretty-photo" title="<?php the_title(); ?>">
                <?php
                the_post_thumbnail('post-featured-image',array(
                    'alt'	=> $post->post_title,
                    'title'	=> $post->post_title
                ));
                ?>
            </a>
        </div>
        <?php
    }
    ?>