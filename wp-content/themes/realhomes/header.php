<!doctype html>
<!--[if lt IE 7]> <html class="lt-ie9 lt-ie8 lt-ie7" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 7]>    <html class="lt-ie9 lt-ie8" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 8]>    <html class="lt-ie9" <?php language_attributes(); ?>> <![endif]-->
<!--[if gt IE 8]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
<meta charset="<?php bloginfo('charset'); ?>">
<title>
<?php wp_title('|', true, 'right'); ?>
<?php bloginfo('name'); ?>
</title>
<?php
  $favicon = get_option('theme_favicon');
  if (!empty($favicon)) {
      ?>
<link rel="shortcut icon" href="<?php echo $favicon; ?>" />
<?php
  }
  ?>
<!-- Define a viewport to mobile devices to use - telling the browser to assume that the page is as wide as the device (width=device-width) and setting the initial page zoom level to be 1 (initial-scale=1.0) -->
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="format-detection" content="telephone=no">
<!-- Style Sheet-->
<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>"/>
<!-- Pingback URL -->
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
<!-- RSS -->
<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?>" href="<?php bloginfo('rss2_url'); ?>" />
<link rel="alternate" type="application/atom+xml" title="<?php bloginfo('name'); ?>" href="<?php bloginfo('atom_url'); ?>" />
<!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
<!--[if lt IE 9]>
  <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
  <![endif]-->
<?php
  // Google Analytics From Theme Options
  echo stripslashes(get_option('theme_google_analytics'));
  wp_head();
  ?>
</head>
<body <?php body_class(); ?>>
<!-- Start Header -->
<div class="header-wrapper">
  <div class="container"><!-- Start Header Container -->
    <header id="header" class="clearfix">
      <div id="header-top" class="clearfix">
        <?php
                      /* WPML Language Switcher */
                      if (function_exists('icl_get_languages')) {
                          $wpml_lang_switcher = get_option('theme_wpml_lang_switcher');
                          if ($wpml_lang_switcher == 'true') {
                              do_action('icl_language_selector');
                          }
                      }
$header_email = get_option('theme_header_email');
                  /*    $header_email = get_option('theme_header_email');
                      if(!empty($header_email)){
                          ?>
                          <h2 id="contact-email">
                                                              <i class="email"></i> <?php _e('Email us at', 'framework'); ?> : <a href="mailto:<?php echo antispambot($header_email); ?>"><?php echo antispambot($header_email); ?></a>
                          </h2>
                          <?php
                      }

*/                      ?>
        <!-- <h2 id="contact-email" style="position:relative;"> <a style="position: absolute;

top: 5px;" href="<?php echo site_url();?>/pdfs/Angies.pdf" target="_blank"><img src="<?php echo get_stylesheet_directory_uri();?>/images/angi.png"></a> </h2>--> <!-- Social Navigation -->
        <?php  get_template_part('template-parts/social-nav') ;    ?>
        <?php
                      $enable_user_nav = get_option('theme_enable_user_nav');
                      if ($enable_user_nav == 'true') {
                          ?>
        <div class="user-nav clearfix">
          <?php
                              if (is_user_logged_in()) {
                                  $submit_url = get_option('theme_submit_url');
                                  $my_properties_url = get_option('theme_my_properties_url');
                                  if (!empty($submit_url)) {?>
          <a href="<?php echo $submit_url; ?>"><i class="fa fa-plus-circle"></i>
          <?php _e('Submit Property', 'framework'); ?>
          </a>
          <?php
                                  }
                                  if (!empty($my_properties_url)) {?>
          <a href="<?php echo $my_properties_url; ?>"><i class="fa fa-th-list"></i>
          <?php _e('My Properties', 'framework'); ?>
          </a>
          <?php } ?>
          <a href="<?php echo admin_url('profile.php'); ?>"><i class="fa fa-user"></i>
          <?php _e('Profile', 'framework'); ?>
          </a> <a class="last" href="<?php echo wp_logout_url(home_url()); ?>"><i class="fa fa-sign-out"></i>
          <?php _e('Logout', 'framework'); ?>
          </a>
          <?php
                              } else {
                                  $theme_login_url = get_option('theme_login_url');

                                  if (!empty($theme_login_url)) {
                                      ?>
          <a href="<?php echo $theme_login_url; ?>"><i class="fa fa-sign-in"></i>
          <?php _e('Login', 'framework'); ?>
          </a> <a class="last" href="<?php echo $theme_login_url; ?>">
          <?php _e('Register', 'framework'); ?>
          </a>
          <?php
                                  }
                              } ?>
        </div>
        <?php
                      }

                      ?>
      </div>
      <!-- Logo -->
      <div id="logo">
        <div class="row">
          <div class="span4 mobile-hidden">
            <img style="max-width: 142px;" src="http://juliashea.com/wp-content/uploads/2019/11/Shea-Julia-0491.jpg" alt="Julia Shea - Agent with Nancy Chandler Associates"/>
          </div>
          <div  class="super" > 
          </div>
            <?php
            $logo_path = get_option('theme_sitelogo');
            if (!empty($logo_path)) {?>
              <div class="span4">
                <a  class="link_web" title="<?php  bloginfo('name'); ?>" href="<?php echo home_url(); ?>"> <img src="<?php echo $logo_path; ?>" alt="<?php  bloginfo('name'); ?>"> </a> <a class="link_mobile" title="<?php  bloginfo('name'); ?>" href="<?php echo home_url(); ?>"> <img src="<?php echo get_stylesheet_directory_uri();?>/images/logn.png" alt="<?php  bloginfo('name'); ?>"> </a>
              
                      
              <h2 class="logo-heading only-for-print"> <a href="<?php echo home_url(); ?>"  title="<?php bloginfo('name'); ?>">
                <?php  bloginfo('name'); ?>
                </a> </h2>
            </div>
              <?php
              } else {
                  ?>
              <div class="span4">
                    <h2 class="logo-heading"> <a href="<?php echo home_url(); ?>"  title="<?php bloginfo('name'); ?>">
                      <?php  bloginfo('name'); ?>
                      </a> </h2>
              </div>
                <?php
              }

                   ?>
              <div class="span4 mobile-hidden">
                <div class="right-icons-header" style="">
                  <a style="" href="http://www.zillow.com/profile/Julia-Shea/#reviews" target="_blank">
                    <img src="<?php echo get_stylesheet_directory_uri();?>/images/Picture1.jpg" style="width: 200px;
margin-top: 57px;"alt="Julia Shea - Agent with Nancy Chandler Associates"/>
                  </a> 
                 <!-- <a class="super-icon" href="http://juliashea.com/pdfs/Angies.pdf" target="_blank">
                    <img style="max-height: 130px;" src="http://juliashea.com/wp-content/uploads/2019/11/Angies-List-2017-PNG-125x125-2.png" title="">
                  </a> -->
                </div>
              </div>
</div>
      </div>
      <div class="menu-and-contact-wrap">
        <?php

                      $header_phone = get_option('theme_header_phone');

                      if (!empty($header_phone)) {
                          echo '<h2  class="contact-number"><i class="fa fa-phone"></i><a data-tel="' . $header_phone . '" href="tel:' . $header_phone . '">' . $header_phone . ' </a><span class="outer-strip"></span><a href="mailto:' . $header_email . '" target="_blank" id="header-email">' . $header_email . '</a>

</h2>';
                      }

                      ?>
        <!-- Start Main Menu-->
        <nav class="main-menu">
          <?php
                          wp_nav_menu([
                              'theme_location' => 'primary',
                              'menu_class' => 'clearfix',
                              'walker' => new themeslug_walker_nav_menu
                          ]);

                          ?>

        </nav>
        <!-- End Main Menu --> </div>
    </header>
  </div>
  <!-- End Header Container -->

</div>

<!-- End Header -->
