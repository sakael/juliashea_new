<?php get_template_part("template-parts/carousel_partners"); ?>



<!-- Start Footer -->

<footer id="footer-wrapper">
       <div id="footer" class="container">
                <div class="row">
                        <div class="span3">
                            <div class="footer-contact widget-new">
                                <h4>Contact</h4>
                                <ul>
                                    <li>
                                        Phone: <a href="tel:757-971-6221">(757) 971-6221</a>
                                    </li>
                                    <li>
                                        Email: <a href="mailto:julia@juliashea.com">julia@juliashea.com</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="footer-about widget-new">
                                <h4>About</h4>
                                <ul>
                                <li>
                                       <a href="http://juliashea.com/about-julia/">About Julia</a>
                                    </li>
                                    <li>
                                         <a href="http://juliashea.com/julias-dog-pages/">Julia's Dogs</a>
                                    </li>
                                    <li>
                                        Licensed in Virginia
                                    </li>
                                </ul>
                            </div>
                            <div class="footer-icons widget-new">
                                <a href="http://www.nancychandler.com/" id="chandler-logo" target="_blank"><img src="http://staging.juliashea.com/wp-content/uploads/2020/06/output-onlinepngtools.png" alt=""></a>
                                <img id="equal-housing-logo" src="http://staging.juliashea.com/wp-content/uploads/2020/06/48-483685_equal-housing-logo-png-download-equal-housing-logo.jpg" alt="">
                            </div>
                            <?php if ( ! dynamic_sidebar( __('Footer First Column','framework') )) : ?>

                            <?php endif; ?>

                        </div>


                        <div class="span1"></div>
                        <div class="span8">
                            <div class="footer-contact widget-new">
                                <h4>OFFICE</h4>
                                <ul>
                                    <li>
                                    Chandler Realty</br> 701 W 21st Street</br> Norfolk, VA 23517
                                    </li>
                                </ul>
                            </div>
                            <div class="footer-map">
                                <div id="map_canvas_footer"></div>
                            </div>
                            
                            <?php if ( ! dynamic_sidebar( __('Footer Second Column','framework') )) : ?>

                            <?php endif; ?>

                        </div>



                        <div class="span3">

                            <?php if ( ! dynamic_sidebar( __('Footer Third Column','framework') )) : ?>

                            <?php endif; ?>

                        </div>



                        <div class="span3">

                            <?php if ( ! dynamic_sidebar( __('Footer Fourth Column','framework') )) : ?>

                            <?php endif; ?>

                        </div>

                </div>



       </div>



        <!-- Footer Bottom -->

        <div id="footer-bottom" class="container">



                <div class="row">
<?php /*
                        <div class="span6">

                            <?php

                            $copyright_text = get_option('theme_copyright_text');

                            echo ( $copyright_text ) ? '<p class="copyright">'.$copyright_text.'</p>' : '';

                            ?>

                        </div>

                        <div class="span6">

                            <?php

                            $designed_by_text = get_option('theme_designed_by_text');

                            echo ( $designed_by_text ) ? '<p class="designed-by">'.$designed_by_text.'</p>' : '';

                            ?>

                      </div>*/?>
                      <?php /*
   <div class="span12">
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="footertable">
                    <tbody><tr>
                      <td width="15%" align="center" valign="middle"><a href="http://www.nancychandler.com/" target="_blank"><img src="http://juliashea.com/wp-content/uploads/2019/11/CR_100_Black_Logo-JPEG.jpg" alt=""></a></td>
                      <td align="center" valign="middle">
                          <p class="black-text" style="    margin-right: 46px;">
                          Chandler Realty<br>

701 W 21st Street<br>

Norfolk, VA 23517<br>

Licensed in VA
                          </p>
                        <p class="black-text" style="display:none">
All Rights Reserved. Copyright © 2017 Julia Shea Inc. Norfolk Virginia Real Estate <br/>
Julia Shea, <a href="http://www.nancychandler.com" target="_blank">Chandler Realty Inc. ® </a> 701 W 21st Street Norfolk, VA 23517. Licensed in VA</p>

                      </td>
                      <td width="15%" align="center" valign="middle"><img src="<?php echo  get_stylesheet_directory_uri();?>/images/footer-img2.gif" alt=""></td>
                    </tr>
                  </tbody></table>
                  </div> */?>
                </div>



        </div>

        <!-- End Footer Bottom -->



</footer><!-- End Footer -->



<?php wp_footer(); ?>


<script type="text/javascript">

jQuery(function(){
    if(navigator.userAgent.match(/(iPhone|Android.*Mobile)/i))
    {
        jQuery('a[data-tel]').each(function(){
            jQuery(this).prop('href', 'tel:' + jQuery(this).data('tel'));
        });
    }
})
</script>

<?php
$map_lati = get_option('theme_map_lati');
$map_longi = get_option('theme_map_longi');
$map_zoom = get_option('theme_map_zoom');

$contact_address = stripslashes(get_option('theme_contact_address'));
$contact_cell = get_option('theme_contact_cell');
$contact_phone = get_option('theme_contact_phone');
?>

<script type='text/javascript' src='//maps.google.com/maps/api/js?key=AIzaSyCVhaFXR6f3DbxxthmrlR545G-F09CgLm4'></script>
<script type="text/javascript">
    // Google Map
    function initializeContactMap()
    {
        var officeLocation = new google.maps.LatLng(<?php echo $map_lati; ?>, <?php echo $map_longi; ?>);
        var contactMapOptions = {
            center: officeLocation,
            zoom: <?php echo $map_zoom; ?>,
            mapTypeId: google.maps.MapTypeId.ROADMAP,
            scrollwheel: false
        };
        var contactMap = new google.maps.Map(document.getElementById("map_canvas_footer"), contactMapOptions);
        var contactMarker = new google.maps.Marker({
            position: officeLocation,
            map: contactMap
        });
    }

    window.onload = initializeContactMap();
</script>
</body>

</html>
