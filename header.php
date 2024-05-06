<!DOCTYPE html>
<!--[if IE 6]>
<html id="ie6" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 7]>
<html id="ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html id="ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 9]>
<html id="ie9" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 10]>
<html id="ie10" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 6) | !(IE 7) | !(IE 8) | !(IE 9) | !(IE 10) ]><!-->
<html lang="en-US">
<!--<![endif]-->
<head>
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
<title><?php wp_title(); ?></title>
<?php wp_head(); ?>
</head>
<body>
<div id = "wrapper">
    <div class = "long-row uc-bluebg uc-blue-gradient" id = "bannerID">
        <div class = "row">
            <div class = "large-6 left columns">
                <ul id = "bannertop">
                    <li>
                        <div id = "uc-sig">
                            <span id = "uconn-signature"><a href = "http://www.uconn.edu/">UCONN</a></span>
                        </div>
                    </li>
                    <li>
                        <div id = "uc-sep">
                            <span id = "separator">|</span>
                        </div>
                    </li>
                    <li>
                        <div id = "uc-fn">
                            <span id = "uconn-fullname"><a href = "http://www.uconn.edu/">University of Connecticut</a></span>
                        </div>
                    </li>
                </ul>
            </div>
            <div class = "large-6 right columns" id = "search-index-box">
                <ul id = "iconsbox">
                    <li>
                        <div>
                            <a href = "http://www.uconn.edu/search/"><img src = "<?php print get_template_directory_uri() . "/images/m-icons_0000_search-white.png" ?>" /></a>
                        </div>
                    </li>
                    <li>
                        <div>
                            <a href = "http://www.uconn.edu/az">A-Z</a>
                        </div>
                    </li>
                </ul>
                
            </div>
        </div>
    </div>
    <div class = "long-row uc-orange">
        <div class = "row">
            <div class = "large-14 left header-top-padding header-bottom-padding columns">
                <h2 id = "site-title-section"><span id = "parent-org"><a href = "http://www.engr.uconn.edu/">Engineering the Future</a></span><br />
                <span id = "site-name"><a href = "<?php bloginfo("url"); ?>"><?php bloginfo("name"); ?></a></span></h2>
            </div>
        </div>
    </div>
    <div class = "long-row uc-orange">
        <div class = "row">
            <div class = "large-12 left">
<nav class="top-bar" data-topbar role="navigation">
  <ul class="title-area">
    <li class="name"></li>
    <li class="toggle-topbar menu-icon"><a href="#"><span>Menu</span></a></li>
  </ul>
  <section class="top-bar-section">
<?php if(has_nav_menu('top-menu')): ?>
<?php

$options = array(
  'theme_location' => 'top-menu',
  'container' => false,
  'depth' => 2,
  'items_wrap' => '<ul id="%1$s" class="left %2$s">%3$s</ul>',
  'walker' => new GC_walker_nav_menu()
);

wp_nav_menu($options); 

?>
<?php else: ?>
<ul class = "left menu">
    <li><a href = "/">Home</a></li>
</ul>
<?php endif; ?>
  </section>
</nav>
            </div>
        </div>
    </div>
    <?php if(!is_front_page()): ?>
    <div class = "long-row uc-whitebg">
    <div class = "row">
        <div class = "large-12 column content-section">
    <?php else: ?>
    <div class = "long-row">
    <?php endif; ?>