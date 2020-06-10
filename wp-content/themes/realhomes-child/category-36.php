<?php

get_header();



    /* Page Head */

    $banner_image_path = get_default_banner();



    $banner_title = __('Archives', 'framework');

    $banner_details = "";



    $post = $posts[0]; // Hack. Set $post so that the_date() works.

    if (is_category())

    {

        $banner_title = __('Video Categories', 'framework');

        $banner_details = single_cat_title('',false);

    }

    elseif( is_tag() )

    {

        $banner_title = __('All Posts in Tag', 'framework');

        $banner_details = single_tag_title('',false);

    }

    elseif (is_day())

    {

        $banner_title = __('Archives', 'framework');

        $banner_details = get_the_date();

    }

    elseif (is_month())

    {

        $banner_title = __('Archives', 'framework');

        $banner_details = get_the_date('F Y');

    }

    elseif (is_year())

    {

        $banner_title = __('Archives', 'framework');

        $banner_details = get_the_date('Y');

    }

    elseif (is_author())

    {

        $curauth = $wp_query->get_queried_object();

        $banner_title = __('All Posts By', 'framework');

        $banner_details = $curauth->display_name;

    }

    elseif (isset($_GET['paged']) && !empty($_GET['paged']))

    {

        $banner_title = __('Archives', 'framework');

        $banner_details = "";

    }

    ?>



    <div class="page-head" style="background-repeat: no-repeat;background-position: center top;background-image: url('<?php echo $banner_image_path; ?>'); ">

        <div class="container">

            <div class="wrap clearfix">

                <h1 class="page-title"><span><?php echo $banner_title; ?></span></h1>

                <?php if(!empty($banner_details)){ ?>

                <p><?php echo $banner_details; ?></p>

                <?php } ?>

            </div>

        </div>

    </div><!-- End Page Head -->



    <!-- Content -->

    <div class="container contents lisitng-grid-layout">

        <div class="row">

            <div class="span12 main-wrap">

                <!-- Main Content -->

                <div class="main">



                    <section class="listing-layout">
                    <h3 class="title-heading">Real Estate Videos</h3>
                    <div id="gallery-container">
                    <div class="gallery-3-columns isotope clearfix">
<?php 

$categories =  get_categories('child_of=36');  
foreach  ($categories as $category) {
	$category_link = get_category_link( $category->cat_ID );
	?>
    <div class="post-<?php echo $category->cat_ID;?> property type-property status-publish has-post-thumbnail hentry gallery-item isotope-item on-rent ">
                                                                                        <figure>
                                                
                                               <a class="link" href="<?php echo esc_url( $category_link ); ?>" > <img class="img-border" src="<?php echo z_taxonomy_image_url($category->term_id);?>" alt="15421 Southwest 39th Terrace">  </a>                                          </figure>
                                            <h5 class="item-title"><a href="<?php echo esc_url( $category_link ); ?>" title="<?php echo $category->name?>"><?php echo $category->name?></a></h5>
                                        </div>
    <?php }?>
</div></div>
                    </section>



                </div><!-- End Main Content -->



            </div> <!-- End span12 -->



   



        </div><!-- End contents row -->

    </div><!-- End Content -->



<?php get_footer(); ?>