<?php
//current page
if (!in_array(current_page_table, dis_allowed)) {
  $_SESSION['current_page'] = substr($_SERVER['REQUEST_URI'], strlen(base_path));
}
require_once '../app.extensions/app.front.extension.php';
require_once '../controlers/navbarControler.php';

// $frontEnd->track_ip();
if (!isAjax) {
  // get navbar data
?>
  <!DOCTYPE html>
  <html class="disable-transition">

  <head>
    <!-- dynamics -->
    <title><?php echo $page_title . " | " . $og_sitename;  ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

    <meta name="keywords" content="<?php echo $page_keywords; ?>" />
    <meta name="description" content="<?php echo $page_description; ?>">
    <meta property="og:site_name" content="<?php echo $site_title; ?>">
    <meta property="og:type" content="<?php echo $og_type; ?>">
    <meta property="og:title" content="<?php echo $page_title; ?>">
    <meta property="og:description" content="<?php echo $page_description; ?>">
    <meta property="og:url" content="<?php echo $ogurl; ?>">
    <meta property="og:image" <?php $element->is_editable(current_page_table, 'page_icon', 'image'); ?> content="<?php echo $ICON = (substr($page_icon, 0, 4) !== 'http' ? scheme . $_SERVER['SERVER_NAME'] . base_path . $page_icon : $page_icon); ?>">
    <meta property="og:image:url" <?php $element->is_editable(current_page_table, 'page_icon', 'image'); ?> content="<?php echo $ICON; ?>">
    <meta name="twitter:image" content="<?php echo $ICON; ?>">
    <meta name="twitter:title" content="<?php echo $page_title; ?>">
    <meta name="twitter:text:title" content="<?php echo $page_title; ?>">
    <meta name="twitter:description" content="<?php echo $page_description; ?>">
    <meta property="twitter:card" content="<?php echo $og_type; ?>">
    <meta content="<?php echo $theme_color; ?>" name="theme-color">




    <!-- app css  -->
    <link href="<?php echo base_path; ?>css/app.css/original.css?v=1.35" rel="stylesheet" type="text/css" media="all" />
    <script src="<?php echo base_path; ?>plugins/anime/lib/anime.min.js"> </script>
    <link <?php $element->is_editable(current_page_table, 'page_icon', 'image'); ?> href="<?php echo $ICON; ?>" rel="icon" />
    <!-- <link href="<?php echo base_path; ?>plugins/apk/manifest.json?v=3" rel="manifest"> -->
    <!-- app css  -->


    <!-- user cusrom css  -->
    <!-- dynamic user colors  -->
    <style>
      :root {
        --padding-x: 20px;
        --padding-y: 16px;
        --grid-gutter: 20px;
        --site-primary-color: <?php echo $site_primary_c;  ?>;
        --site-secondary-color: <?php echo $site_secondary_c;  ?>;
        --site-tertiary-color: <?php echo $site_tertiary_c;  ?>;
        --site-more-color-1: <?php echo $site_more_c_1;  ?>;
        --site-more-color-2: <?php echo $site_more_c_2;  ?>;
        --site-more-color-3: <?php echo $site_more_c_3;  ?>;
      }
    </style>


    <!-- dynamic site colors  -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_path; ?>css/style.css?v=1.7">
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@400;900&amp;display=block" rel="stylesheet">
    <!-- user cusrom css  -->


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="<?php echo base_path; ?>js/index.min.js" defer></script>

  </head>

  <body id="header_main" class="resources-page post-page" style="width: 100%; overflow-x: hidden;">
    <input type="hidden" id="base_path" name="in1" value="<?php echo base_path; ?>">
    <input type="hidden" name="csrf_token" value="<?php echo csrf_token; ?>">

    <!-- navbar set -->
    <div class="header">
      <div class="header__fixed">
        <header class="header__inner row">
          <nav class="header-nav-menu">
            <ul class="any-menu">

              <li>
                <a class="menu-item relocator" href="#how_it_works">
                  How it works
                </a>
              </li>

              <li>
                <a class="menu-item relocator" href="#samples">
                  Samples
                </a>
              </li>

              <?php
              if (!isset($_SESSION['email'])) {
              ?>
                <li>
                  <a class="menu-item" href="<?php echo base_path . "pricing"; ?>">
                    Pricing
                  </a>
                </li>

              <?php
              }




              if (isset($_SESSION['admin_edits'])) {
                echo '
              <li><a class="menu-item" href="' . base_path . 'admin">Admin</a></li>
              <li><a class="menu-item non_spa" href="' . base_path . 'home/logout/true">Logout</a></li>
              <li><a class="btn-base btn--teal-border" href="' . base_path . 'my_account">My account </a></li>';
              } elseif (isset($_SESSION['email'])) {
                echo '<li><a class="menu-item non_spa" href="' . base_path . 'home/logout/true">Logout</a></li>
                <li><a class="btn-base btn--teal-border" href="' . base_path . 'my_account">My account </a></li>
                ';
              } else {
                echo '
              <li><a class="menu-item" href="' . base_path . 'sign_in">Login</a></li>
              <li><a class="btn-base btn--teal-border" href="' . base_path . 'view_users">Start Free Trial </a></li>
              ';
              }

              ?>


            </ul>
          </nav>
        </header>
      </div>


      <a class="header-logo" href="<?php echo base_path  ?>home" onclick='$("html").attr("class",""); '>
        <img <?php $element->is_editable('navbar', 'site_icon', 'image'); ?> src="<?php echo base_path . $site_icon; ?>" alt="<?php echo $site_title; ?>">
      </a>
      <button class="header-menu-btn" data-toggle-mobile-menu>
      </button>
      <span class="mobile-menu-button-bg">
      </span>
    </div>
    <div class="mobile-menu">
      <div class="mobile-menu-inner">
        <nav class="mobile-menu-nav-menu">
          <ul class="any-menu">




            <li>
              <a data-close-mobile-menu class="relocator" href="#how_it_works">
                How it works
              </a>
            </li>

            <li>
              <a data-close-mobile-menu class="relocator" href="#samples">
                Samples
              </a>
            </li>


            <?php
            if (!isset($_SESSION['email'])) {
            ?>
              <li>
                <a data-close-mobile-menu href="<?php echo base_path . "pricing"; ?>">
                  Pricing
                </a>
              </li>

            <?php
            }



            if (isset($_SESSION['admin_edits'])) {
              echo '
              <li><a data-close-mobile-menu href="' . base_path . 'admin">Admin</a></li>
              <li><a data-close-mobile-menu class="non_spa" href="' . base_path . 'home/logout/true">Logout</a></li>
              <li><a data-close-mobile-menu  class="btn-base btn--teal-ghost" href="' . base_path . 'my_account">My account </a></li>';
            } elseif (isset($_SESSION['email'])) {
              echo '<li><a data-close-mobile-menu class="non_spa" href="' . base_path . 'home/logout/true">Logout</a></li>
                    <li><a data-close-mobile-menu class="btn-base btn--teal-ghost" href="' . base_path . 'my_account">My account </a></li>';
            } else {
              echo '
              <li><a data-close-mobile-menu href="' . base_path . 'sign_in">Login</a></li>
              <li><a data-close-mobile-menu class="btn-base btn--teal-ghost" href="' . base_path . 'new_document">Start Free Trial </a></li>
              ';
            }

            ?>

          </ul>
        </nav>
      </div>
    </div>

    <main class="field main home-page" id="main_field" style="min-height:88vh; padding-top:10px;">
    <?php
  }


  if ($element->page_editable) {
    echo   '<div class="edit_div">
              <a class="non_spa" href="' . close_edit . '">Close Edit</a>
          </div>';
  } elseif (isset($_SESSION['admin_edits'])) {
    echo   '<div class="edit_div">
              <a class="non_spa" href="' . close_edit . '/edit/true">Edit page</a>
          </div>';
  }
    ?>
    <!-- used by spa  -->
    <input type="hidden" value="<?php echo $page_title." | ". $og_sitename;  ?>" id="page_title_holder">
    <input type="hidden" value="<?php echo (substr($page_icon, 0, 4) !== 'http' ? scheme . $_SERVER['SERVER_NAME'] . base_path . $page_icon : $page_icon)  ?>" id="page_icon_holder">
    <input type="hidden" value="<?php echo $page_description;  ?>" id="page_description_holder">
    <input type="hidden" value="<?php echo current_page_table;  ?>" id="current_page">
    <!-- used by spa  -->