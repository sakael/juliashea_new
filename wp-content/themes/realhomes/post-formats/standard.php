<?php
if ( has_post_thumbnail() ){
    $image_id = get_post_thumbnail_id();
    $image_url = wp_get_attachment_url($image_id);
    ?>
    <figure>
        <span class="format-icon image"></span>
        <a href="<?php echo $image_url; ?>" class="<?php echo get_lightbox_plugin_class(); ?>" title="<?php the_title(); ?>">
            <?php
            the_post_thumbnail('post-featured-image',array(
                'alt'	=> $post->post_title,
                'title'	=> $post->post_title
            ));
            ?>
        </a>
    </figure>
<?php
}
?>