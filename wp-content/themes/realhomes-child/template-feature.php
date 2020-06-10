<?php

/*

*   Template Name: Feature Template

*/

get_header();



        get_template_part('banners/default_page_banner');



?>



    <!-- Content -->

    <div class="container contents">

        <div class="row">



            <div class="span12">



                <!-- Main Content -->

                <div class="main">

                    <?php

                    /* Advance Search Form for Homepage */

                  //  get_template_part('template-parts/advance-search');



                    if ( have_posts() ) :

                        while ( have_posts() ) :

                            the_post();

                            $content = get_the_content('');

                        /*    if(!empty($content)){*/

                                ?>

                                <div class="inner-wrapper">

                                    <article id="post-<?php the_ID(); ?>" <?php post_class("clearfix"); ?>>
 <h3 class="post-title"><?php the_title(); ?></h3>

                                      

                                        <?php the_content(); ?>

                                    </article>

                                </div>

                                <?php

                           /* }*/

                        endwhile;

                    endif;



                    ?>



                    <section class="property-items">



                        <?php

                        /* Slogan Title and Text */

                        $slogan_title = get_option('theme_slogan_title');

                        $slogan_text = get_option('theme_slogan_text');



                        ?>

                      <?php /*  <div class="narrative">

                            <?php

                            if(!empty($slogan_title)){

                                ?><h2><?php echo $slogan_title; ?></h2><?php

                            }



                            if(!empty($slogan_text)){

                                ?><p><?php echo $slogan_text; ?></p><?php

                            }

                            ?>

                        </div> */?>



                        <div class="property-items-container clearfix">

                            <?php

                            /* List of Properties on Homepage */
/*              $number_of_properties = intval(get_option('theme_properties_on_home'));

                            if(!$number_of_properties){

                                $number_of_properties = 4;

                            }
    $number_of_properties=-1;


                         //   if ( is_front_page()  ) {

                                //$paged = (get_query_var('page')) ? get_query_var('page') : 1;

                         //   }



                            $home_args = array(

                                'post_type' => 'property',

                                'posts_per_page' => $number_of_properties,

                                'paged' => $paged

                            );



                            /* Modify home query arguments based on theme options */

                    /*        $home_properties = get_option('theme_home_properties');

                            if(!empty($home_properties) && ($home_properties == 'based-on-selection') ){



                                $types_for_homepage = get_option('theme_types_for_homepage');

                                $statuses_for_homepage = get_option('theme_statuses_for_homepage');

                                $cities_for_homepage = get_option('theme_cities_for_homepage');



                                $tax_query = array();



                                if(!empty($types_for_homepage) && is_array($types_for_homepage)){

                                    $tax_query[] = array(

                                        'taxonomy' => 'property-type',

                                        'field' => 'slug',

                                        'terms' => $types_for_homepage

                                    );

                                }



                                if(!empty($statuses_for_homepage) && is_array($statuses_for_homepage)){

                                    $tax_query[] = array(

                                        'taxonomy' => 'property-status',

                                        'field' => 'slug',

                                        'terms' => $statuses_for_homepage

                                    );

                                }



                                if(!empty($cities_for_homepage) && is_array($cities_for_homepage)){

                                    $tax_query[] = array(

                                        'taxonomy' => 'property-city',

                                        'field' => 'slug',

                                        'terms' => $cities_for_homepage

                                    );

                                }



                                $tax_count = count( $tax_query );   // count number of taxonomies

                                if( $tax_count > 1 ){

                                    $tax_query['relation'] = 'AND';  // add OR relation if more than one

                                }

                                if( $tax_count > 0 ){

                                    $home_args['tax_query'] = $tax_query;   // add taxonomies query to home query arguments

                                }

                            }



                            $sorty_by = get_option('theme_sorty_by');

                            if( !empty($sorty_by) ){

                                if( $sorty_by == 'low-to-high' ){

                                    $home_args['orderby'] = 'meta_value_num';

                                    $home_args['meta_key'] = 'REAL_HOMES_property_price';

                                    $home_args['order'] = 'ASC';

                                }elseif( $sorty_by == 'high-to-low' ){

                                    $home_args['orderby'] = 'meta_value_num';

                                    $home_args['meta_key'] = 'REAL_HOMES_property_price';

                                    $home_args['order'] = 'DESC';

                                }

                            }

*/
$home_args = array(

    'post_type' => 'property',

    'posts_per_page' => -1,

    'meta_query' => array(

        array(

            'key' => 'REAL_HOMES_featured',

            'value' => 1,

            'compare' => '=',

            'type'  => 'NUMERIC'

        )

    )

);


 $sorty_by = get_option('theme_sorty_by');

                            if( !empty($sorty_by) ){

                                if( $sorty_by == 'low-to-high' ){

                                    $home_args['orderby'] = 'meta_value_num';

                                    $home_args['meta_key'] = 'REAL_HOMES_property_price';

                                    $home_args['order'] = 'ASC';

                                }elseif( $sorty_by == 'high-to-low' ){

                                    $home_args['orderby'] = 'meta_value_num';

                                    $home_args['meta_key'] = 'REAL_HOMES_property_price';

                                    $home_args['order'] = 'DESC';

                                }

                            }



                            $home_properties_query = new WP_Query( $home_args );

                            if ( $home_properties_query->have_posts() ) :

                                $post_count = 0;

                                while ( $home_properties_query->have_posts() ) :

                                    $home_properties_query->the_post();



                                    /* Display Property for Home Page */

                                    get_template_part('template-parts/property-for-home');



                                    $post_count++;

                                    if(0 == ($post_count % 2)){

                                        echo '<div class="clearfix"></div>';

                                    }

                                endwhile;

                                wp_reset_query();

                            else:

                                ?>

                                <div class="alert-wrapper">

                                    <h4><?php _e('No Properties Found!', 'framework') ?></h4>

                                </div>

                                <?php

                            endif;

                            ?>

                        </div>



                        <?php theme_pagination( $home_properties_query->max_num_pages); ?>



                    </section>



                    <?php

                    /* Featured Properties */

                    $show_featured_properties = get_option('theme_show_featured_properties');

                    if($show_featured_properties == 'true'){

                        get_template_part("template-parts/carousel") ;

                    }

                    ?>

                </div><!-- End Main Content -->



            </div> <!-- End span12 -->



        </div><!-- End  row -->



    </div><!-- End content -->



<?php get_footer(); ?>