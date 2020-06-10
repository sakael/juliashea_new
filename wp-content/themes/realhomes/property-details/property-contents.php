<article class="property-item clearfix">
    <div class="wrap clearfix">
        <h4 class="title">
            <?php


            /* Property ID if exists */
            $property_id = get_post_meta($post->ID, 'REAL_HOMES_property_id', true);
            if(!empty($property_id)){
                echo __('Property ID','framework').' : '.$property_id;
            }

            ?>
        </h4>
        <h5 class="price">
            <span class="status-label">
                <?php
                /* Property Status. For example: For Sale, For Rent */
                $status_terms = get_the_terms( $post->ID,"property-status" );
                if(!empty($status_terms)){
                    foreach($status_terms as $st_trm){
                        echo $st_trm->name;
                        break;
                    }
                }else{
                    echo '&nbsp;';
                }
                ?>
            </span>
            <span>
                <?php
                /* Property Price */
                property_price();

                /* Property Type. For example: Villa, Single Family Home */
                $type_terms = get_the_terms( $post->ID,"property-type" );
                $type_count = count($type_terms);
                if(!empty($type_terms)){
                    echo '<small> - ';
                    $loop_count = 1;
                    foreach($type_terms as $typ_trm){
                        echo $typ_trm->name;
                        if($loop_count < $type_count && $type_count > 1){
                            echo ', ';
                        }
                        $loop_count++;
                    }
                    echo '</small>';
                }else{
                    echo '&nbsp;';
                }
                ?>
            </span>
        </h5>
    </div>

    <div class="property-meta clearfix">
        <?php
        /* Property Icons */
        get_template_part('property-details/property-metas');
        ?>
        <!-- Print Icon -->
        <span class="printer-icon"><a href="javascript:window.print()"><?php _e('Print this page', 'framework'); ?></a></span>
    </div>

    <div class="content clearfix">
        <?php
        the_content();

        $detail_titles = get_post_meta($post->ID,'REAL_HOMES_detail_titles',true);
        if( !empty($detail_titles) ){
            $detail_values = get_post_meta($post->ID,'REAL_HOMES_detail_values',true);
            if( !empty($detail_values) ){
                $details = array_combine($detail_titles, $detail_values);
                echo '<h4 class="additional-title">'.__('Additional Details', 'framework').'</h4>';
                echo '<ul class="additional-details clearfix">';
                foreach($details as $title => $value ){
                    ?>
                    <li>
                        <strong><?php echo $title; ?>:</strong>
                        <span><?php echo $value; ?></span>
                    </li>
                    <?php
                }
                echo '</ul>';
            }
        }
        ?>
    </div>

    <div class="features">
        <h4 class="title"><?php _e('Features', 'framework'); ?></h4>
        <ul class="arrow-bullet-list clearfix">
            <?php
            /* Property Features */
            $features_terms = get_the_terms( $post->ID,"property-feature" );
            if(!empty($features_terms)){
                foreach($features_terms as $fet_trms){
                    echo '<li><a href="'.get_term_link($fet_trms->slug, 'property-feature').'">'.$fet_trms->name.'</a></li>';
                }
            }
            ?>
        </ul>
    </div>
</article>