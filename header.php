<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" <?php language_attributes(); ?>> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" <?php language_attributes(); ?>> <!--<![endif]-->

<head>
  <meta charset="utf-8">
  <title><?php wp_title('|', true, 'right'); ?><?php echo get_bloginfo('name'); ?></title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="Sitio web dedicado a la difusión del son jarocho. Aquí encontrará una amplía variedad de contenidos multimedia para para disfrutar en línea." />
  <link rel="stylesheet" type="text/css" media="all" href="http://musicajarocha.com/wp-content/themes/musicaJarocha/style.css" />
  <?php wp_head(); ?>

  <link rel="alternate" type="application/rss+xml" title="<?php echo get_bloginfo('name'); ?> Feed" href="<?php echo home_url(); ?>/feed/">
  <link href='http://fonts.googleapis.com/css?family=Bitter' rel='stylesheet' type='text/css'>
  <link rel="icon" type="image/png" href="http://musicajarocha.com/wp-content/themes/musicaJarocha/images/favicon.png" />
</head>
<div id="wrapper">
<div id="header" class="banner" role="banner">
  <div class="inner">
    <div id="logo">
      <h1><a class="brand" href="<?php echo home_url(); ?>/"><span class="hidden"><?php bloginfo('name'); ?></span></a></h1>
    </div>
    <p id="descr"><?php bloginfo('description'); ?></p>
  </div>
</div>
<div id="nav" class="nav-main" role="navigation">
  <div class="inner">
      <?php wp_nav_menu(); ?>
      <?php get_search_form(); ?>
  </div>
</div>